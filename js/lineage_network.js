function draw() {
  // display  loading div on start of the page
  $("#load").show();

  // initialize colors for each type of relationship between artists
  var edge_colors_dict = {default_color: "#C0C0C0", studied_with_color: "#FF1C1C", collaborated_with_color: "#FFA807", danced_for_color: "#50B516", influenced_by_color: "#3033CE"};

  // initialize path for the directory with images for nodes
  var image_dir = "data/images/";
    //var image_dir = "/src/photo_upload_data/";

  //default value of node id before search for artist is performed
  var searched_node_id = -1;
  var connected_nodes = [];
  var edges_to_update = [];
  var network;
  var options;
  var nodes;
  var edges;
  var education_nodes;
  var artist_details;

  // ajax request to fetch the nodes, edges and border color of nodes from backend
  $.ajax({
    type: 'post',
    url: 'lineage_backend.php', 
    data: {mode:"FULL_NETWORK"},
    success:function(response)  {
      // response from 'lineage_backend.php' is stored as a JSON array in json_object
      //document.write('<div> Response : ' + response + '</div>');
      var json_object = $.parseJSON(response);
      console.log(json_object);
      // get the artist ids, names and images for search suggestions for textbox used to search for artists
      var names = new Array();
      for(var i = 0; i < json_object.nodes.length; i++) {
        names.push({node_id: json_object.nodes[i].id, label: json_object.nodes[i].title, icon: json_object.nodes[i].image});
        json_object.nodes[i].image = image_dir + json_object.nodes[i].image;
      }

      // get the university names
      var university_names = new Array();
      for(var i = 0; i < json_object.education_nodes.length; i++) {
        university_names.push({label: json_object.education_nodes[i].institution_name});
      }

      // getting state names
      var state_names = new Array();
      for(var i = 0; i < json_object.artist_details.length; i++) {
        state_names.push({label: json_object.artist_details[i].artist_residence_state});
      }

      // getting the country names
      var country_names = new Array();
      for(var i = 0; i < json_object.artist_details.length; i++) {
        country_names.push({label: json_object.artist_details[i].artist_residence_country});
      }
     // console.log(university_names);

      // store the nodes and edges in corresponding vis js objects
      nodes = new vis.DataSet(json_object.nodes);
      edges = new vis.DataSet(json_object.edges);
      education_nodes = json_object.education_nodes;
      artist_details = json_object.artist_details;
      // store the node borders which indicates whether artist's profile was filled by the same artist or by another user
      var node_borders = json_object.node_borders;

      // create network

      // initialize the div in which the network should be displayed
      var container = document.getElementById('my_network');

      // initialize the search text div
      var search_text = document.getElementById('search_text');
    
      // add nodes and edges to network data
      var data = {
        nodes: nodes,
        edges: edges
      };

      // define options for nodes, edges, interaction, physics
      options = {
        nodes: {
          borderWidth: 2, // thickness of border around nodes
          color: {
            background: '#9AC0FE', // default background color of node, visible when artist doesn't have an image
            hover: {
              background:'#89082f', // background color of node on hover
              border: '#000000' // border color of node on hover
            }
          },
          size: 30 // size of node
        },

        edges: {
          smooth: {
            enabled: true, // allows curving of edges between nodes
            type: "dynamic", // curvature of edges is associated with physics of the network when set to dynamic
          },

          color: edge_colors_dict["default_color"], // color of the edges

          font: {
            size: 0 // font size set to zero so that relationship name between nodes isn't desplayed on network
          },

          arrows: {
            to: {
              scaleFactor: 3 // defines size of arrowhead
            }
          }
        },

        interaction: {
          hover: true, // color of node and its edges change when hovered
          tooltipDelay: 0 // time delay in displaying tooltip on hovering over a node
        },
        physics: {
          stabilization: {
            iterations: 200, // maximum number of iteration to stabilize
            updateInterval: 10, // defines how many iterations the stabilizationProgress event is triggered
            onlyDynamicEdges: false, // can be set to true if nodes have predefined positions
            fit: true // forces view to fit all nodes and edges after stabilization
          },
          barnesHut: {
            gravitationalConstant: -30000, // setting repulsion (negative value) between the nodes
            centralGravity: 0.2,
            avoidOverlap: 5 // pulls entire network to the center
          }
        }
      };

      // set border color for the nodes which indicates whether artist's profile was filled by the same artist or by another user
      var nodes_to_update = [];
      for(var i = 0; i < node_borders.length; i++) {
        curr_node = nodes.get(node_borders[i].id);
        curr_node.color = {border: node_borders[i].border_color};
        nodes_to_update.push(curr_node);
      }
      nodes.update(nodes_to_update);

      // if multiple edges occur between 2 nodes then display only one of them in the full network view
      for (var i = 0; i < edges.length; i++) {
        var curr_edge = edges.get(i);
        var edge_string = curr_edge.from + "->" + curr_edge.to;

        if(connected_nodes.indexOf(edge_string) > -1) {
          curr_edge.hidden = true;
        }
        edges_to_update.push(curr_edge);
        //connected_nodes.push(edge_string);
      }
      edges.update(edges_to_update);

      // initialize the network object
      network = new vis.Network(container, data, options);

      // set physics to false after stabilization iterations
      network.on("stabilizationIterationsDone", function () {
        network.setOptions( { physics: false } );
      });

      // hide the loading div after network is fully loaded
      network.on("afterDrawing", function () {
        $("#load").css("display","none");
        $("body").css("overflow", "scroll");
      });

      // change the type of cursor to grabbing hand while dragging the network
      network.on('dragging', function(obj){
        $("#my_network").css("cursor", "-webkit-grabbing");
      });

      // change the type of cursor to hand on releasing the drag
      network.on('release', function(obj){
        //console.log("network released!");
        $("#my_network").css("cursor", "-webkit-grab");
      });

      // change the type of cursor to pointing hand when hovered over a node
      network.on('hoverNode', function (obj) {
        // console.log("node hovered");
        $("#my_network").css("cursor", "pointer");
        $("#my_network").attr('title','No. of connections= '+network.getConnectedEdges(obj.node).length);
      });

      // change the type of cursor to hand on coming out of node hover
      network.on('blurNode', function (obj) {
        $("#my_network").css("cursor", "-webkit-grab");
      });

      network.on('selectNode', function (obj) {
        var side_nav = document.getElementById("mySidenav");
        side_nav.style.width = "300px";	
        side_nav.style.display = "block"; 
        var selected_node = obj.nodes;
        var artist_pic = document.getElementById("artist_pic");
        var artist_name = document.getElementById("artist_name");
        var artist_gender = document.getElementById("artist_gender");
        var artist_university = document.getElementById("artist_university");
        for (var i = 0; i < nodes.length; i++) {
          var cur_node = Object.entries(nodes._data)[i][1]["id"];
          artist_pic.innerHTML = ''; 
          if(selected_node[0] === cur_node)
          {
            var img = document.createElement('img');            
            if(Object.entries(nodes._data)[i][1]["image"] === "data/images/missing_image.jpg")
            {
              img.src="data/images/NoImageAvailable.jpg";
            }else{
              img.src=Object.entries(nodes._data)[i][1]["image"] ;
            }
            artist_pic.appendChild(img);    
            break;
          }
        } 

        for (var i = 0; i < education_nodes.length; i++) {
          var cur_node = education_nodes[i]["id"];
          if(selected_node[0] === cur_node)
          {
            artist_university.innerHTML= education_nodes[i]["institution_name"];
            break;
          }
        }

        for (var i = 0; i < artist_details.length; i++) {
          var cur_node = artist_details[i]["id"];
          if(selected_node[0] === cur_node)
          {
            artist_name.innerHTML= artist_details[i]["artist_first_name"] +" "+ artist_details[i]["artist_last_name"];
            if(artist_details[i]["artist_gender"] === "male" || artist_details[i]["artist_gender"] === "Male")
            {
              artist_gender.innerHTML= "Male";
            }else if(artist_details[i]["artist_gender"] ==="") {
              artist_gender.innerHTML= "";
            }else
            {
              artist_gender.innerHTML= "Female";
            }
            break;
          }
        }
        
      });

      // event fired on change of tab in tab bar
      $('.tablinks').click(function() {
        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(this.id).style.display = "block";
        this.className += " active";

        var edges_to_update = [];
        var connected_nodes = [];
        if(this.id === "full_network_tab") {
          search_text.style.visibility="hidden";
          document.getElementById('searchbox').value = "";
          document.getElementById('university-search-box').value = "";
          document.getElementById('state-search-box').value = "";
          document.getElementById('country-search-box').value = "";

          var uncheck=document.getElementsByName('checkbox');
              for(var i=0;i<uncheck.length;i++)
              {
                if(uncheck[i].type=='checkbox')
                {
                uncheck[i].checked=false;
                }
              }

          var unselect=document.getElementsByName('radio');
              for(var i=0;i<unselect.length;i++)
              {
                if(unselect[i].type=='radio')
                {
                  unselect[i].checked=false;
                }
              }

          for (var i = 0; i < edges.length; i++) {
            var curr_edge = edges.get(i);
            curr_edge.hidden = false;
            if(connected_nodes.indexOf(edge_string) > -1) {
              curr_edge.hidden = true;
            }
            curr_edge.color = edge_colors_dict["default_color"];
            edges_to_update.push(curr_edge);
          }
          edges.update(edges_to_update);

          for (var i = 0; i < nodes.length; i++){
                var cur_node = Object.entries(nodes._data)[i][1]["id"]; 
                cur_node = nodes.get(node_borders[i].id);
                cur_node.color = {border: node_borders[i].border_color};
                cur_node.hidden = false; 
                cur_node.borderWidth = 2;         
                connected_nodes.push(cur_node);
            }
            nodes.update(connected_nodes);
            network = new vis.Network(container, data, options);
            network.on("stabilizationIterationsDone", function () {
              network.setOptions( { physics: false } );
            });
            // change the type of cursor to pointing hand when hovered over a node
            network.on('hoverNode', function (obj) {
              // console.log("node hovered");
              $("#my_network").css("cursor", "pointer");
              $("#my_network").attr('title','No. of connections= '+network.getConnectedEdges(obj.node).length);
            });
      
            // change the type of cursor to hand on coming out of node hover
            network.on('blurNode', function (obj) {
              $("#my_network").css("cursor", "-webkit-grab");
            });
      
            network.on('selectNode', function (obj) {
              var side_nav = document.getElementById("mySidenav");
              side_nav.style.width = "300px";	
              side_nav.style.display = "block"; 
              var selected_node = obj.nodes;
              var artist_pic = document.getElementById("artist_pic");
              var artist_name = document.getElementById("artist_name");
              var artist_gender = document.getElementById("artist_gender");
              var artist_university = document.getElementById("artist_university");
              for (var i = 0; i < nodes.length; i++) {
                var cur_node = Object.entries(nodes._data)[i][1]["id"];
                artist_pic.innerHTML = ''; 
                if(selected_node[0] === cur_node)
                {
                  var img = document.createElement('img');            
                  if(Object.entries(nodes._data)[i][1]["image"] === "data/images/missing_image.jpg")
                  {
                    img.src="data/images/NoImageAvailable.jpg";
                  }else{
                    img.src=Object.entries(nodes._data)[i][1]["image"] ;
                  }
                  artist_pic.appendChild(img);    
                  break;
                }
              } 
      
              for (var i = 0; i < education_nodes.length; i++) {
                var cur_node = education_nodes[i]["id"];
                if(selected_node[0] === cur_node)
                {
                  artist_university.innerHTML= education_nodes[i]["institution_name"];
                  break;
                }
              }
      
              for (var i = 0; i < artist_details.length; i++) {
                var cur_node = artist_details[i]["id"];
                if(selected_node[0] === cur_node)
                {
                  artist_name.innerHTML= artist_details[i]["artist_first_name"] +" "+ artist_details[i]["artist_last_name"];
                  if(artist_details[i]["artist_gender"] === "male" || artist_details[i]["artist_gender"] === "Male")
                  {
                    artist_gender.innerHTML= "Male";
                  }else if(artist_details[i]["artist_gender"] ==="") {
                    artist_gender.innerHTML= "";
                  }else
                  {
                    artist_gender.innerHTML= "Female";
                  }
                  break;
                }
              }
              
            });
            
        }
        // if a relationship tab is selected then display only the edges of that relationship
        else {
          // get name of selected relationship from id of the tab
          var relationship_selected_array = this.id.split("_");
          var relationship_selected = (relationship_selected_array[0] + " " + relationship_selected_array[1]).toLowerCase();

          // get color of the edge based on type of relationship
          var edge_color = edge_colors_dict[(relationship_selected_array[0] + "_" + relationship_selected_array[1] + "_color").toLowerCase()];

          // determine which edges to display based on type of relationship
          var req_edges= [];
          for (var i = 0; i < edges.length; i++) {
            var curr_edge = edges.get(i);
            if(this.id === "studied_with_tab") {
              search_text.style.visibility="hidden";
              document.getElementById('searchbox').value = "";
              document.getElementById('university-search-box').value = "";
              document.getElementById('state-search-box').value = "";
              document.getElementById('country-search-box').value = "";

          var uncheck=document.getElementsByName('checkbox');
              for(var i=0;i<uncheck.length;i++)
              {
                if(uncheck[i].type=='checkbox')
                {
                uncheck[i].checked=false;
                }
              }

          var unselect=document.getElementsByName('radio');
              for(var i=0;i<unselect.length;i++)
              {
                if(unselect[i].type=='radio')
                {
                  unselect[i].checked=false;
                }
              }

              if(curr_edge.label.toLowerCase() === "studied with") {
                curr_edge.hidden = false;
                curr_edge.color = edge_color;
                req_edges.push(curr_edge.from);
                req_edges.push(curr_edge.to);
              }
              else {
                curr_edge.hidden = true;
              }
              edges_to_update.push(curr_edge);
            }else if(this.id === "collaborated_with_tab")
            {
              search_text.style.visibility="hidden";
              document.getElementById('searchbox').value = "";
              document.getElementById('university-search-box').value = "";
              document.getElementById('state-search-box').value = "";
          document.getElementById('country-search-box').value = "";

          var uncheck=document.getElementsByName('checkbox');
              for(var i=0;i<uncheck.length;i++)
              {
                if(uncheck[i].type=='checkbox')
                {
                uncheck[i].checked=false;
                }
              }

          var unselect=document.getElementsByName('radio');
              for(var i=0;i<unselect.length;i++)
              {
                if(unselect[i].type=='radio')
                {
                  unselect[i].checked=false;
                }
              }

              if(curr_edge.label.toLowerCase() === "collaborated with") {
                curr_edge.hidden = false;
                curr_edge.color = edge_color;
                req_edges.push(curr_edge.from);
                req_edges.push(curr_edge.to);
              }
              else {
                curr_edge.hidden = true;
              }
              edges_to_update.push(curr_edge);
            }else if(this.id === "danced_for_tab")
            {
              search_text.style.visibility="hidden";
              document.getElementById('searchbox').value = "";
              document.getElementById('university-search-box').value = "";
              document.getElementById('state-search-box').value = "";
              document.getElementById('country-search-box').value = "";

              var uncheck=document.getElementsByName('checkbox');
                  for(var i=0;i<uncheck.length;i++)
                  {
                    if(uncheck[i].type=='checkbox')
                    {
                    uncheck[i].checked=false;
                    }
                  }

              var unselect=document.getElementsByName('radio');
                  for(var i=0;i<unselect.length;i++)
                  {
                    if(unselect[i].type=='radio')
                    {
                      unselect[i].checked=false;
                    }
                  }
              if(curr_edge.label.toLowerCase() === "danced for") {
                curr_edge.hidden = false;
                curr_edge.color = edge_color;
                req_edges.push(curr_edge.from);
                req_edges.push(curr_edge.to);
              }
              else {
                curr_edge.hidden = true;
              }
              edges_to_update.push(curr_edge);
            }else if(this.id === "influenced_by_tab")
            {
              search_text.style.visibility="hidden";
              document.getElementById('searchbox').value = "";
              document.getElementById('university-search-box').value = "";
              document.getElementById('state-search-box').value = "";
              document.getElementById('country-search-box').value = "";

              var uncheck=document.getElementsByName('checkbox');
                  for(var i=0;i<uncheck.length;i++)
                  {
                    if(uncheck[i].type=='checkbox')
                    {
                    uncheck[i].checked=false;
                    }
                  }

              var unselect=document.getElementsByName('radio');
                  for(var i=0;i<unselect.length;i++)
                  {
                    if(unselect[i].type=='radio')
                    {
                      unselect[i].checked=false;
                    }
                  }
              if(curr_edge.label.toLowerCase() === "influenced by") {
                curr_edge.hidden = false;
                curr_edge.color = edge_color;
                req_edges.push(curr_edge.from);
                req_edges.push(curr_edge.to);
              }
              else {
                curr_edge.hidden = true;
              }
              edges_to_update.push(curr_edge);
            }
            
          }
        }
        edges.update(edges_to_update);   
        for (var i = 0; i < nodes.length; i++){
          var cur_node = Object.entries(nodes._data)[i][1]["id"]; 
          cur_node = nodes.get(node_borders[i].id);
          cur_node.color = {border: node_borders[i].border_color};
          if((cur_node["id"])&& req_edges.includes(cur_node["id"])){
            cur_node.hidden = false;    
                 }else{
                   cur_node.hidden = true;
                 }                         
          connected_nodes.push(cur_node);
      }
      nodes.update(connected_nodes);
      });

      // code for the autocomplete searchbox
      $searchbox = $("#searchbox");
      $('#searchbox').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#searchTextValue").val("");
          $("#searchbox_node_id").val("");
        }    
     }); 

      $searchbox.autocomplete({
        minLength: 1, // minimum of 1 characters to be entered before suggesting artist names
        source: names,
        select: function (event, ui) {
          if(isNaN(this.value)){
            $searchbox.val(ui.item.label); // display the selected text
            $("#searchTextValue").val(ui.item.label);
            $("#searchbox_node_id").val(ui.item.node_id); // save selected node_id to hidden input
          } else{
            $("#searchTextValue").val("");
            $("#searchbox_node_id").val("");
          }           
        }
      });

      $('#university-search-box').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#uniTextValue").val("");
          $("#uni_searchbox_node_id").val("");
        }    
     }); 
       // code for the autocomplete university searchbox
       $university_search_box = $("#university-search-box"); 
       $university_search_box.autocomplete({
         minLength: 3, // minimum of 3 characters to be entered before suggesting university names
         source: university_names,
         select: function (event, ui) {
             $university_search_box.val(ui.item.label); // display the selected text
             $("#uniTextValue").val(ui.item.label);
             $("#uni_searchbox_node_id").val(ui.item.node_id); // save selected node_id to hidden input
         }
       });

       $('#state-search-box').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#stateTextValue").val("");
        }    
     }); 
       // code for the autocomplete state searchbox
       $state_search_box = $("#state-search-box"); 
       $state_search_box.autocomplete({
         minLength: 1, // minimum of 3 characters to be entered before suggesting university names
         source: state_names,
         select: function (event, ui) {
             $state_search_box.val(ui.item.label); // display the selected text
             $("#stateTextValue").val(ui.item.label);
         }
       });

       $('#country-search-box').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#countryTextValue").val("");
        }    
     }); 
       // code for the autocomplete country searchbox
       $country_search_box = $("#country-search-box"); 
       $country_search_box.autocomplete({
         minLength: 1, // minimum of 3 characters to be entered before suggesting university names
         source: country_names,
         select: function (event, ui) {
             $country_search_box.val(ui.item.label); // display the selected text
             $("#countryTextValue").val(ui.item.label);
         }
       });

      // method to make images appear along with names in autocomplete
      $searchbox.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var $li = $('<li>');
        var $img = $('<img style="width:32px;height:32px;">');

        $img.attr({
          src: image_dir + item.icon, // path to image of the artist
          alt: "" // none used in case artist image is unavailable
        });

        $li.append('<a href="#">');
        $li.find('a').append($img).append(item.label);
        $li.find('a').css("display", "block");
        return $li.appendTo(ul);
      };

      // method to focus network on the node based on artist name searched for
      $searchbox.keypress(function(e) {
        // if enter is pressed
        if ((e.keyCode || e.which) == 13) {
          // get node_id of the artist searched for
          var searched_node_id = $("#searchbox_node_id").val();
          var search_text = $("#searchTextValue").val();
          //var university_search_value = $("#university_search_val").val();
          if(!searched_node_id)
          {
            $('#search_text').html('&nbsp&nbsp'+"Please correct your search criteria.");
          } else{
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+'</span>');
            network.focus(
              searched_node_id, // which node to focus on
              {
                scale: 0.6, // level of zoom while focussing on node
                animation: {
                  duration: 1000, // animation duration in milliseconds (Number)
                  easingFunction: "easeInOutQuart" // type of animation while focussing
                }
              });
            }         
        }
      });

      submit = document.getElementById('submit');
      submit.addEventListener('click',(function(e) {
          var searched_node_id = $("#searchbox_node_id").val();
          //var uni_searched_node_id = $("#uni_searchbox_node_id").val();
          var search_text = $("#searchTextValue").val();
          var uni_search_text = $("#uniTextValue").val();
          var state_text = $("#stateTextValue").val();
          var country_text = $("#countryTextValue").val();
          var check_val=document.getElementsByName('checkbox');
          var radio_val=document.getElementsByName('radio');

          if(!searched_node_id && !uni_search_text && !state_text && !country_text &&
           !check_val && !radio_val)
          {
          // console.log("Inside both");
            $('#search_text').html('&nbsp&nbsp'+"No Results Found. Displaying full network");
          }          
          else if(searched_node_id && uni_search_text)
          {
           //console.log("Inside common");
            document.getElementById("search_text").style.visibility="visible";
            for (var i = 0; i < edges.length; i++) {
              var curr_edge = edges.get(i);
              curr_edge.hidden = false;
              if(connected_nodes.indexOf(edge_string) > -1) {
                curr_edge.hidden = true;
              }
              curr_edge.color = edge_colors_dict["default_color"];
              edges_to_update.push(curr_edge);
            }
            edges.update(edges_to_update);
  
            for (var i = 0; i < nodes.length; i++){
                  var cur_node = Object.entries(nodes._data)[i][1]["id"]; 
                  cur_node = nodes.get(node_borders[i].id);
                  cur_node.color = {border: node_borders[i].border_color};
                  cur_node.hidden = false;  
                  cur_node.borderWidth=2;        
                  connected_nodes.push(cur_node);
              }
              nodes.update(connected_nodes);
              network = new vis.Network(container, data, options);
              network.on("stabilizationIterationsDone", function () {
              network.setOptions( { physics: false } );
              });

              network.on('hoverNode', function (obj) {
                // console.log("node hovered");
                $("#my_network").css("cursor", "pointer");
                $("#my_network").attr('title','No. of connections= '+network.getConnectedEdges(obj.node).length);
              });
        
              // change the type of cursor to hand on coming out of node hover
              network.on('blurNode', function (obj) {
                $("#my_network").css("cursor", "-webkit-grab");
              });
        
              network.on('selectNode', function (obj) {
                var side_nav = document.getElementById("mySidenav");
                side_nav.style.width = "300px";	
                side_nav.style.display = "block"; 
                var selected_node = obj.nodes;
                var artist_pic = document.getElementById("artist_pic");
                var artist_name = document.getElementById("artist_name");
                var artist_gender = document.getElementById("artist_gender");
                var artist_university = document.getElementById("artist_university");
                for (var i = 0; i < nodes.length; i++) {
                  var cur_node = Object.entries(nodes._data)[i][1]["id"];
                  artist_pic.innerHTML = ''; 
                  if(selected_node[0] === cur_node)
                  {
                    var img = document.createElement('img');            
                    if(Object.entries(nodes._data)[i][1]["image"] === "data/images/missing_image.jpg")
                    {
                      img.src="data/images/NoImageAvailable.jpg";
                    }else{
                      img.src=Object.entries(nodes._data)[i][1]["image"] ;
                    }
                    artist_pic.appendChild(img);    
                    break;
                  }
                } 
        
                for (var i = 0; i < education_nodes.length; i++) {
                  var cur_node = education_nodes[i]["id"];
                  if(selected_node[0] === cur_node)
                  {
                    artist_university.innerHTML= education_nodes[i]["institution_name"];
                    break;
                  }
                }
        
                for (var i = 0; i < artist_details.length; i++) {
                  var cur_node = artist_details[i]["id"];
                  if(selected_node[0] === cur_node)
                  {
                    artist_name.innerHTML= artist_details[i]["artist_first_name"] +" "+ artist_details[i]["artist_last_name"];
                    if(artist_details[i]["artist_gender"] === "male" || artist_details[i]["artist_gender"] === "Male")
                    {
                      artist_gender.innerHTML= "Male";
                    }else if(artist_details[i]["artist_gender"] ==="") {
                      artist_gender.innerHTML= "";
                    }else
                    {
                      artist_gender.innerHTML= "Female";
                    }
                    break;
                  }
                }
                
              });  

            // combined_nodes = [];
            // for (var i = 0; i <education_nodes.length; i++){
            //   for(var j=0; j<artist_details.length; j++)
            //   {
            //     if(education_nodes[i]["id"] = artist_details[j]["id"])
            //     {
            //       combined_nodes.push
            //     }
            //   }
            

              var new_node;
              var state_val;
              var country_val;
              var gender_val;
              var living_val;
            // for (var i = 0; i <education_nodes.length; i++){
            //   var education_val = education_nodes[i]["institution_name"];
            //   var node_val = education_nodes[i]["id"];
            //   new_node = education_nodes[i]["id"]; 
            //   new_node = nodes.get(node_borders[i].id);
            //   new_node.color = {border: node_borders[i].border_color};
            //   for(var j=0; j<artist_details.length; j++){
            //     if(education_nodes[i]["id"] === artist_details[j]["id"])
            //     {
            //       state_val = artist_details[j]["artist_residence_state"];
            //       country_val = artist_details[j]["artist_residence_country"];
            //       gender_val = artist_details[j]["artist_gender"];
            //       living_val = artist_details[j]["artist_living_status"];
            //     }               
            //   }                       
            //   if(searched_node_id ===node_val  && education_val === uni_search_text  
            //     && state_val === state_text && country_val === country_text
            //     && gender_val === state_text && living_val === state_text)
            //   {
            //     $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+" "+uni_search_text+'</span>');
            //     new_node.borderWidth = 60;
            //     final_nodes.push(new_node);
            //     break;
            //   } else{
            //     new_node.borderWidth = 2;
            //     final_nodes.push(new_node);
            //     $('#search_text').html('&nbsp&nbsp'+"No results found. Displaying the full network");
            //   }           
            // }  
            final_nodes = [] 
            for (var i = 0; i <education_nodes.length; i++){
              var new_node;
              var education_val = education_nodes[i]["institution_name"];
              var node_val = education_nodes[i]["id"];
              new_node = education_nodes[i]["id"]; 
              new_node = nodes.get(node_borders[i].id);
              new_node.color = {border: node_borders[i].border_color};
              if(searched_node_id ===node_val  && education_val === uni_search_text  )
              {
                $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+" "+uni_search_text+'</span>');
                new_node.borderWidth = 60;
                final_nodes.push(new_node);
                break;
              } else{
                new_node.borderWidth = 2;
                final_nodes.push(new_node);
                $('#search_text').html('&nbsp&nbsp'+"No results found. Displaying the full network");
              }           
            }       
            nodes.update(final_nodes);
          } 
          else if(uni_search_text)
          {
            console.log("Inside university");
            document.getElementById("search_text").style.visibility="visible";
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+uni_search_text+'</span>');
            for (var i = 0; i < edges.length; i++) {
              var curr_edge = edges.get(i);
              curr_edge.hidden = false;
              if(connected_nodes.indexOf(edge_string) > -1) {
                curr_edge.hidden = true;
              }
              curr_edge.color = edge_colors_dict["default_color"];
              edges_to_update.push(curr_edge);
            }
            edges.update(edges_to_update);
  
            for (var i = 0; i < nodes.length; i++){
                  var cur_node = Object.entries(nodes._data)[i][1]["id"]; 
                  cur_node = nodes.get(node_borders[i].id);
                  cur_node.color = {border: node_borders[i].border_color};
                  cur_node.hidden = false;
                  cur_node.borderWidth=2;          
                  connected_nodes.push(cur_node);
              }
              nodes.update(connected_nodes);
        network = new vis.Network(container, data, options);
        network.on("stabilizationIterationsDone", function () {
          network.setOptions( { physics: false } );
        });
                  
        network.on('selectNode', function (obj) {
        var side_nav = document.getElementById("mySidenav");
        side_nav.style.width = "300px";	
        side_nav.style.display = "block"; 
        var selected_node = obj.nodes;
        var artist_pic = document.getElementById("artist_pic");
        var artist_name = document.getElementById("artist_name");
        var artist_gender = document.getElementById("artist_gender");
        var artist_university = document.getElementById("artist_university");
        for (var i = 0; i < nodes.length; i++) {
          var cur_node = Object.entries(nodes._data)[i][1]["id"];
          artist_pic.innerHTML = ''; 
          if(selected_node[0] === cur_node)
          {
            var img = document.createElement('img');            
            if(Object.entries(nodes._data)[i][1]["image"] === "data/images/missing_image.jpg")
            {
              img.src="data/images/NoImageAvailable.jpg";
            }else{
              img.src=Object.entries(nodes._data)[i][1]["image"] ;
            }
            artist_pic.appendChild(img);    
            break;
          }
        } 

        for (var i = 0; i < education_nodes.length; i++) {
          var cur_node = education_nodes[i]["id"];
          if(selected_node[0] === cur_node)
          {
            artist_university.innerHTML= education_nodes[i]["institution_name"];
            break;
          }
        }

        for (var i = 0; i < artist_details.length; i++) {
          var cur_node = artist_details[i]["id"];
          if(selected_node[0] === cur_node)
          {
            artist_name.innerHTML= artist_details[i]["artist_first_name"] +" "+ artist_details[i]["artist_last_name"];
            if(artist_details[i]["artist_gender"] === "male" || artist_details[i]["artist_gender"] === "Male")
            {
              artist_gender.innerHTML= "Male";
            }else if(artist_details[i]["artist_gender"] ==="") {
              artist_gender.innerHTML= "";
            }else
            {
              artist_gender.innerHTML= "Female";
            }
            break;
          }
        }       
      });    
            final_nodes = [];
            
            for (var i = 0; i < education_nodes.length; i++){
              var new_node;
              var education_val = education_nodes[i]["institution_name"];
              new_node = education_nodes[i]["id"]; 
              new_node = nodes.get(node_borders[i].id);
              new_node.color = {border: node_borders[i].border_color};
              if(education_val === uni_search_text)
              {
                new_node.borderWidth = 60;
              } else{
                new_node.borderWidth = 2;
              }           
              final_nodes.push(new_node);
            }       
            nodes.update(final_nodes);
          } else if(searched_node_id)
          {
          // console.log("Inside search");
           document.getElementById("search_text").style.visibility="visible";
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+'</span>');
            var edge_to_keep = [];
            var new_edge_string;
            var nodeId = searched_node_id;
            var edge_color = edge_colors_dict["default_color"];
            final_edges = []; final_nodes = [];
            for (var i = 0; i < edges.length; i++){
              var new_edge = edges.get(i);
              ///new_edge_string = new_edge.from + "->" + new_edge.to;
              new_edge_from = new_edge.from;
              new_edge_to = new_edge.to;
              if(new_edge_from === nodeId) {
                new_edge.hidden = false;
                new_edge.color = edge_color;
                edge_to_keep.push(new_edge_to);
             } else{
              new_edge.hidden = true;
             }
             final_edges.push(new_edge);
           }           
           edges.update(final_edges);

           edge_to_keep.push(nodeId);
           for (var i = 0; i < nodes.length; i++){
              var new_node = Object.entries(nodes._data)[i][1]["id"]; 
              new_node = nodes.get(node_borders[i].id);
              new_node.color = {border: node_borders[i].border_color};
              if(edge_to_keep.includes(new_node["id"])){
                new_node.hidden = false;
                new_node.borderWidth = 2;
              }else{
                new_node.hidden = true;
                new_node.borderWidth = 2;
              }             
              final_nodes.push(new_node);
              //final_nodes.push(new_edge_string);
          }       
          nodes.update(final_nodes);
          network.focus(
            searched_node_id, // which node to focus on
            {
              scale: 0.6, // level of zoom while focussing on node
              animation: {
                duration: 1000, // animation duration in milliseconds (Number)
                easingFunction: "easeInOutQuart" // type of animation while focussing
              }
            });
          }
       
      }));
    }
    
  });


}
