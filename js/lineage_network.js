  function draw() {
  // display  loading div on start of the page
  $("#load").show();

  // initialize colors for each type of relationship between artists
  var edge_colors_dict = {default_color: "#C0C0C0", studied_with_color: "#FF1C1C", collaborated_with_color: "#FFA807", danced_for_color: "#50B516", influenced_by_color: "#3033CE"};

  //default value of node id before search for artist is performed
  var nodes;
  var edges;
  var totalNodes = [];
  var totalEdges = [];
  var inquiry_text = document.getElementById('search_text');
  // ajax request to fetch the nodes, edges and border color of nodes from backend
  $.ajax({
    type: "POST",
    url: 'artistcontroller.php',
    data: JSON.stringify({"action": "getCompleteArtistProfile"}),
    success:function(response) {
      response = JSON.stringify(response);
      json_object = $.parseJSON(response);
      allNodes=json_object.artist_profile;
      // get the artist ids, names and images for search suggestions for textbox used to search for artists
      var artist_names = new Array();
      var university_names = new Array();
      var state_names = new Array();
      var country_names = new Array();
      var major_names = new Array();
      var degree_names = new Array();
      var ethnicity_names = new Array();
      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getArtistNames"}),
        success:function(response) {
          response = JSON.stringify(response);
          artistNames = $.parseJSON(response);
          finalNames = artistNames.artist_name;
          if(finalNames)
          {
              for(var i=0; i <finalNames.length; i++) {
              fullName= finalNames[i].artist_first_name + " " +finalNames[i].artist_last_name;
              artist_names.push({label: fullName, node_id: finalNames[i].artist_profile_id, image: finalNames[i].artist_photo_path});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch artist names");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getUniversityNames"}),
        success:function(response) {
          response = JSON.stringify(response);
          universityNames = $.parseJSON(response);
          finalUniversity = universityNames.university;
          if(finalUniversity)
          {
            for(var i=0; i <finalUniversity.length; i++) {
              university_names.push({label: finalUniversity[i].institution_name});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch university names");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getStateNames"}),
        success:function(response) {
          response = JSON.stringify(response);
          stateNames = $.parseJSON(response);
          finalStates = stateNames.state_names;
          if(finalStates)
          {
            for(var i=0; i <finalStates.length; i++) {
              state_names.push({label: finalStates[i].artist_residence_state});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch state names");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getCountryNames"}),
        success:function(response) {
          response = JSON.stringify(response);
          countryNames = $.parseJSON(response);
          finalCountry = countryNames.country_names;
          if(finalCountry)
          {
            for(var i=0; i <finalCountry.length; i++) {
              country_names.push({label: finalCountry[i].artist_residence_country});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch country names");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getMajor"}),
        success:function(response) {
          response = JSON.stringify(response);
          majorNames = $.parseJSON(response);
          finalMajor = majorNames.major_names;
          if(finalMajor)
          {
            for(var i=0; i <finalMajor.length; i++) {
              major_names.push({label: finalMajor[i].major});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch major");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getDegree"}),
        success:function(response) {
          response = JSON.stringify(response);
          degreeNames = $.parseJSON(response);
          finalDegree = degreeNames.degree_names;
          if(finalDegree)
          {
            for(var i=0; i <finalDegree.length; i++) {
              degree_names.push({label: finalDegree[i].degree});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch degree");
        }
      });

      $.ajax({
        type: "POST",
        url: 'artistcontroller.php',
        data: JSON.stringify({"action": "getEthnicity"}),
        success:function(response) {
          response = JSON.stringify(response);
          ethnicityNames = $.parseJSON(response);
          finalEthnicity = ethnicityNames.ethnicity_names;
          if(finalEthnicity)
          {
            for(var i=0; i <finalEthnicity.length; i++) {
              ethnicity_names.push({label: finalEthnicity[i].artist_ethnicity});
            }
          }
        },
        error:function(response) {
          console.log("Unable to fetch degree");
        }
      });

      if(allNodes){
        for (var i = 0; i<allNodes.length; i++){
          var nodeDetails= {};
          nodeDetails['id']=allNodes[i].artist_profile_id;
          nodeDetails['title']=allNodes[i].artist_first_name+" "+allNodes[i].artist_last_name;
          nodeDetails['shape']= "circularImage";
          nodeDetails['label']=allNodes[i].artist_first_name+" "+allNodes[i].artist_last_name;
          if(allNodes[i].artist_biography_text){
            nodeDetails['biography']=allNodes[i].artist_biography_text;
          }else if(allNodes[i].artist_biography)
          {
            nodeDetails['biography']=allNodes[i].artist_biography;
          }
          if(allNodes[i].artist_dob){
            nodeDetails['dob']=allNodes[i].artist_dob;
          }
          if(allNodes[i].artist_dod)
          {
            nodeDetails['dod']=allNodes[i].artist_dod;
          }
          if(allNodes[i].artist_photo_path)
          {
            nodeDetails['image']= allNodes[i].artist_photo_path;
          }else{
            nodeDetails['image']= "upload/photo_upload_data/missing_image.jpg";
          }

          nodeDetails['size']= "20";
          if(allNodes[i].is_user_artist === "artist")
          {
            nodeDetails['color']='#da0067';
          }else{
            nodeDetails['color']='#025457';
          }

          if(allNodes[i].artist_gender)
          {
            nodeDetails['gender']=allNodes[i].artist_gender;
          }else
          {
            nodeDetails['gender']="";
          }

          if(allNodes[i].genre)
          {
            nodeDetails['genre']=allNodes[i].genre;
          }else
          {
            nodeDetails['genre']="";
          }

          if(allNodes[i].artist_education)
          {
            eduNodes = allNodes[i].artist_education;
            for(var j = 0; j<eduNodes.length; j++)
            {
              if(eduNodes[j].education_type === "main"){
                nodeDetails['university_main']=eduNodes[j].institution_name;
              } else if(eduNodes[j].education_type === "other")
              {
                nodeDetails['university_other']=eduNodes[j].institution_name;
              }
            }
          }else{
            nodeDetails['university_main']="";
            nodeDetails['university_other']="";
          }

          if(allNodes[i].artist_relation)
          {
            var relNodes = allNodes[i].artist_relation;
            var artist_relation = [];
            for(var j = 0; j<relNodes.length; j++)
            {
              var relation = {};
              relation['artist_name'] = relNodes[j].artist_name_2;
              relation['relationship'] = relNodes[j].artist_relation;
              artist_relation.push(relation);
            }
            nodeDetails["artist_relation"] = artist_relation;
          }else{
            nodeDetails["artist_relation"]= "";
          }

          totalNodes.push(nodeDetails);
         // console.log(totalNodes);
      }
      }

      //console.log(totalNodes);
      if(allNodes)
      {
        for(var i=0; i <allNodes.length; i++) {
          var artistRelation= allNodes[i].artist_relation;
          if(artistRelation){
            for (var j = 0; j<artistRelation.length; j++){
              var edgeDetails= {};
              edgeDetails['id']=artistRelation[j].relation_id;
              edgeDetails['to']=artistRelation[j].artist_profile_id_1;
              edgeDetails['from']= artistRelation[j].artist_profile_id_2;
              edgeDetails['width']="0";
              edgeDetails['label']= artistRelation[j].artist_relation;
              totalEdges.push(edgeDetails);
            }
          }
        }
      }
      
      // store the nodes and edges in corresponding vis js objects
      nodes = new vis.DataSet(totalNodes);
      edges = new vis.DataSet(totalEdges);


      // initialize the div in which the network should be displayed
      var container = document.getElementById('my_network');

      // add nodes and edges to network data
      var data = {
        nodes: nodes,
        edges: edges
      };

      // define options for nodes, edges, interaction, physics
      options = {
        nodes: {
          borderWidth: 10, // thickness of border around nodes
          color: {
            background: '#FFFFFF', // default background color of node, visible when artist doesn't have an image
            hover: {
              background:'#89082f', // background color of node on hover
              border: '#000000' // border color of node on hover
            }
          },
          size: 10 // size of node
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
          "enabled": true,
          stabilization: {
            iterations: 200, // maximum number of iteration to stabilize
            updateInterval: 10, // defines how many iterations the stabilizationProgress event is triggered
            onlyDynamicEdges: false, // can be set to true if nodes have predefined positions
            fit: true // forces view to fit all nodes and edges after stabilization
          },
          barnesHut: {
            gravitationalConstant: -30000, // setting repulsion (negative value) between the nodes
            centralGravity: 0.5,
            avoidOverlap: 5 // pulls entire network to the center
          }
        }
      };

      // initialize the network object
      network = new vis.Network(container, data, options);

      // set physics to false after stabilization iterations
      network.on("stabilizationIterationsDone", function () {
        network.setOptions( { physics: false} );
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
        var artist_status = document.getElementById("artist_status");
        var artist_education = document.getElementById("artist_education");
        var artist_genre = document.getElementById("artist_genre");
        var artist_bio_div = document.getElementById("artist_bio_div");
        var bio_text_val = document.getElementById("bioTextValue");
        var artist_lineage_text = document.getElementById("artist_lineage_text");
        var artist_lineals = document.getElementById("artist_lineals");
        artist_bio_div.style.visibility="hidden";
        for (var i = 0; i < totalNodes.length; i++) {
          var cur_node = totalNodes[i].id;
          if(selected_node[0] === cur_node)
          {
            if(totalNodes[i].image === "upload/photo_upload_data/missing_image.jpg")
            {
              artist_pic.src="upload/photo_upload_data/NoImageAvailable.jpg";
            }else{
              artist_pic.src= totalNodes[i].image;
            }
            artist_name.innerHTML= totalNodes[i].label ;
            if(totalNodes[i]["gender"] === "male" || totalNodes[i]["gender"] === "Male")
            {
              artist_gender.innerHTML= "Male";
            }else if(totalNodes[i]["gender"] ==="") {
              artist_gender.innerHTML= "";
            }else if(totalNodes[i]["gender"] === "female" || totalNodes[i]["gender"] === "Female")
            {
              artist_gender.innerHTML= "Female";
            }
            var dobDate = new Date(totalNodes[i]["dob"]);
            var dodDate = new Date(totalNodes[i]["dod"]);
            if(dobDate == "Invalid Date")
            {
              artist_status.innerHTML="";
            } else if(dodDate == "Invalid Date")
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              artist_status.innerHTML= dobDate + "-"+" Present";
            }
            else if(dobDate && dodDate)
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              dodDate = (dodDate.getMonth()+2) + '/' + dodDate.getDate() + '/' +  dodDate.getFullYear();
              artist_status.innerHTML= dobDate+ "-" +dodDate;
            }
            if(totalNodes[i]["biography"])
            {
              artist_bio_div.style.visibility="visible";
              if(totalNodes[i]["biography"].startsWith("upload/"))
              {
                url = "http://stark.cse.buffalo.edu/choreographiclineage/"+totalNodes[i]["biography"];
                bio_text_val.innerHTML= url;
              }else if(totalNodes[i]["biography"]){
                bioText= totalNodes[i]["biography"];
                bio_text_val.innerHTML= bioText;
              }
            }

            if(totalNodes[i]["genre"])
            {
              genreVal = totalNodes[i]["genre"];
              artist_genre.innerHTML= "<b>Genres: </b>"+genreVal.substr(1);
            }else{
              artist_genre.innerHTML= "";
            }

            if(totalNodes[i]["university_main"])
            {
              artist_education.innerHTML= "<b>University: </b>"+totalNodes[i]["university_main"];
            }else{
              artist_education.innerHTML= "";
            }

            displaydata = totalNodes[i]["artist_relation"];
            if(displaydata)
            {
              artist_lineage_text.style.visibility="visible";
              artist_lineals.style.visibility="visible";
              table = $("#artist_lineals").DataTable({
                paging: false,
                searching: false,
                scrollY: 400,
                info: false,
                data:displaydata,
                columns:[
                  {"data": "relationship"},
                  {"data": "artist_name" }
                ],
                "bDestroy": true
              });
            } else
            {
              artist_lineage_text.style.visibility="hidden";
              artist_lineals.style.visibility="hidden";
            }
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
        if(this.id === "full_network_tab") {
          inquiry_text.style.visibility="hidden";
          document.getElementById('searchbox').value = "";
          document.getElementById('university-search-box').value = "";
          document.getElementById('state-search-box').value = "";
          document.getElementById('country-search-box').value = "";
          document.getElementById('major-search-box').value = "";
          document.getElementById('degree-search-box').value = "";
          document.getElementById('ethnicity-search-box').value = "";
          $('input:checkbox').removeAttr('checked');

          for (var i = 0; i < totalNodes.length; i++){
            totalNodes[i]['hidden'] = false;
          }
          for (var i = 0; i < totalEdges.length; i++){
            totalEdges[i]['hidden'] = false;
            totalEdges[i]['color'] = "#C0C0C0";
          }
          nodes = new vis.DataSet(totalNodes);
          edges = new vis.DataSet(totalEdges);
          var data = {
            nodes: nodes,
            edges: edges
          };
          createWholeNetwork(container, data, options);
        }
        // if a relationship tab is selected then display only the edges of that relationship
        else {
          var relationship_selected_array = this.id.split("_");
          var relationship_selected = (relationship_selected_array[0] + " " + relationship_selected_array[1]).toLowerCase();
          // get color of the edge based on type of relationship
          for (var i = 0; i < totalNodes.length; i++){
            totalNodes[i]['hidden'] = false;
          }
          for (var i = 0; i < totalEdges.length; i++){
            totalEdges[i]['hidden'] = false;
            totalEdges[i]['color'] = "#C0C0C0";
          }
          nodes = new vis.DataSet(totalNodes);
          edges = new vis.DataSet(totalEdges);
          var data = {
            nodes: nodes,
            edges: edges
          };
          createWholeNetwork(container, data, options);
          var edge_color = edge_colors_dict[(relationship_selected_array[0] + "_" + relationship_selected_array[1] + "_color").toLowerCase()];
              inquiry_text.style.visibility="hidden";
              document.getElementById('searchbox').value = "";
              document.getElementById('university-search-box').value = "";
              document.getElementById('state-search-box').value = "";
              document.getElementById('country-search-box').value = "";
              document.getElementById('major-search-box').value = "";
              document.getElementById('degree-search-box').value = "";
              document.getElementById('ethnicity-search-box').value = "";
               $('input:checkbox').removeAttr('checked');

          var req_edges= [];
          var edges_to_update = [];
          for (var i = 0; i < totalEdges.length; i++) {
            var curr_edge = totalEdges[i];
            if(this.id === "studied_with_tab") {
              if(curr_edge.label.toLowerCase() === "studied under") {
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
              if(curr_edge.label.toLowerCase() === "danced in the work of") {
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
          edges.update(edges_to_update);
          connected_node = totalNodes;
          for (var i = 0; i < totalNodes.length; i++){
            if(req_edges.includes(totalNodes[i].id))
            {
              connected_node[i]['hidden'] = false;
            }
            else{
              connected_node[i]['hidden'] = true;
            }
        }
        nodes.update(connected_node);
        }
      });

      // code for the autocomplete searchbox
      $('#searchbox').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#searchTextValue").val("");
          $("#searchbox_node_id").val("");
        }
      });

      $searchbox = $("#searchbox");
      $searchbox.autocomplete({
        minLength: 1, // minimum of 1 characters to be entered before suggesting artist names
        source: artist_names,
        select: function (event, ui) {
          if(isNaN(this.value)){
            $searchbox.val(ui.item.label); // display the selected text
            $("#searchTextValue").val(ui.item.label);
            $("#searchbox_node_id").val(ui.item.node_id); // save selected node_id to hidden input
          } else{
            $("#searchTextValue").val("");
            $("#searchbox_node_id").val("");
          }
      },
      change: function( event, ui ) {
        if(!ui.item){
          $("#searchTextValue").val("");
          $("#searchbox_node_id").val("");
        }else{
          $("#searchTextValue").val(ui.item.label);
          $("#searchbox_node_id").val(ui.item.node_id);
        }
      }
      });

       // method to make images appear along with names in autocomplete
       $searchbox.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        var $li = $('<li>');
        var $img = $('<img style="width:32px;height:32px;">');
        $img.attr({
          src: item.image, // path to image of the artist
          alt: "" // none used in case artist image is unavailable
        });
        $li.append('<a href="#">');
        $li.find('a').append($img).append(item.label);
        $li.find('a').css("display", "block");
        return $li.appendTo(ul);
      };

      // method to focus network on the node based on artist name searched for
      $searchbox.keypress(function(e) {
        if ((e.keyCode || e.which) == 13) {
          var searched_node_id = $("#searchbox_node_id").val();
          var search_text = $("#searchTextValue").val();
          inquiry_text.style.visibility="visible";
          //console.log(searched_node_id);
          if(!searched_node_id)
          {
            $('#search_text').html('&nbsp&nbsp'+"No Results Found. Please change your search criteria.");
          } else{
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+'</span>');
            network.focus(
              searched_node_id, // which node to focus on
              {
                scale: 0.8, // level of zoom while focussing on node
                animation: {
                  duration: 1000, // animation duration in milliseconds (Number)
                  easingFunction: "easeInQuad" // type of animation while focussing
                }
              });
            }
        }
      });

      $('#university-search-box').on('change',function(){
        if(!isNaN(this.value))
        {
          $("#uniTextValue").val("");
        }
      });
        // code for the autocomplete university searchbox
        $university_search_box = $("#university-search-box");
        $university_search_box.autocomplete({
          minLength: 1, // minimum of 1 characters to be entered before suggesting university names
          source: university_names,
          select: function (event, ui) {
              $university_search_box.val(ui.item.label); // display the selected text
              $("#uniTextValue").val(ui.item.label);
          },
          change: function( event, ui ) {
            if(!ui.item){
              $("#uniTextValue").val("");
            }else{
              $("#uniTextValue").val(ui.item.label);
            }
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
          minLength: 1, // minimum of 1 characters to be entered before suggesting state names
          source: state_names,
          select: function (event, ui) {
              $state_search_box.val(ui.item.label); // display the selected text
              $("#stateTextValue").val(ui.item.label);
          },
          change: function( event, ui ) {
            if(!ui.item){
              $("#stateTextValue").val("");
            }else{
              $("#stateTextValue").val(ui.item.label);
            }
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
          minLength: 1, // minimum of 1 characters to be entered before suggesting country names
          source: country_names,
          select: function (event, ui) {
              $country_search_box.val(ui.item.label); // display the selected text
              $("#countryTextValue").val(ui.item.label);
          },
          change: function( event, ui ) {
            if(!ui.item){
              $("#countryTextValue").val("");
            }else{
              $("#countryTextValue").val(ui.item.label);
            }
          }
        });

        $('#major-search-box').on('change',function(){
          if(!isNaN(this.value))
          {
            $("#majorTextValue").val("");
          }
        });
          // code for the autocomplete country searchbox
          $major_search_box = $("#major-search-box");
          $major_search_box.autocomplete({
            minLength: 1, // minimum of 1 characters to be entered before suggesting major names
            source: major_names,
            select: function (event, ui) {
                $major_search_box.val(ui.item.label); // display the selected text
                $("#majorTextValue").val(ui.item.label);
            },
            change: function( event, ui ) {
              if(!ui.item){
                $("#majorTextValue").val("");
              }else{
                $("#majorTextValue").val(ui.item.label);
              }
            }
          });

          $('#degree-search-box').on('change',function(){
            if(!isNaN(this.value))
            {
              $("#degreeTextValue").val("");
            }
          });
            // code for the autocomplete country searchbox
            $degree_search_box = $("#degree-search-box");
            $degree_search_box.autocomplete({
              minLength: 1, // minimum of 1 characters to be entered before suggesting degree names
              source: degree_names,
              select: function (event, ui) {
                  $degree_search_box.val(ui.item.label); // display the selected text
                  $("#degreeTextValue").val(ui.item.label);
              },
              change: function( event, ui ) {
                if(!ui.item){
                  $("#degreeTextValue").val("");
                }else{
                  $("#degreeTextValue").val(ui.item.label);
                }
              }
            });


            $('#ethnicity-search-box').on('change',function(){
              if(!isNaN(this.value))
              {
                $("#ethnicityTextValue").val("");
              }
            });
              // code for the autocomplete country searchbox
              $ethnicity_search_box = $("#ethnicity-search-box");
              $ethnicity_search_box.autocomplete({
                minLength: 1, // minimum of 1 characters to be entered before suggesting ethnicity names
                source: ethnicity_names,
                select: function (event, ui) {
                    $ethnicity_search_box.val(ui.item.label); // display the selected text
                    $("#ethnicityTextValue").val(ui.item.label);
                },
                change: function( event, ui ) {
                  if(!ui.item){
                    $("#ethnicityTextValue").val("");
                  }else{
                    $("#ethnicityTextValue").val(ui.item.label);
                  }
                }
              });

      // clearing the input fields
      clear = document.getElementById('clear');
      clear.addEventListener('click',(function(e) {
          document.getElementById('searchbox').value = "";
          document.getElementById('university-search-box').value = "";
          document.getElementById('state-search-box').value = "";
          document.getElementById('country-search-box').value = "";
          document.getElementById('major-search-box').value = "";
          document.getElementById('degree-search-box').value = "";
          document.getElementById('ethnicity-search-box').value = "";
          $('input:checkbox').removeAttr('checked');
      }));

      submit = document.getElementById('submit');
      submit.addEventListener('click',(function(e) {
        for (var i = 0; i < totalNodes.length; i++){
          totalNodes[i]['hidden'] = false;
        }
        for (var i = 0; i < totalEdges.length; i++){
          totalEdges[i]['hidden'] = false;
          totalEdges[i]['color'] = "#C0C0C0";
        }
        nodes = new vis.DataSet(totalNodes);
        edges = new vis.DataSet(totalEdges);
        var data = {
          nodes: nodes,
          edges: edges
        };
        inquiry_text.style.visibility="visible";
        createWholeNetwork(container, data, options);
          var searched_node_id = $("#searchbox_node_id").val();
          var search_text = $("#searchTextValue").val();
          var university_text = $("#uniTextValue").val();
          var state_text = $("#stateTextValue").val();
          var country_text = $("#countryTextValue").val();
          var major_text = $("#majorTextValue").val();
          var degree_text = $("#degreeTextValue").val();
          var ethnicity_text = $("#ethnicityTextValue").val();
          $('.checkbox_living').click(function() {
            $('.checkbox_living').not(this).prop('checked', false);
        });
          var living_val=$("input:checkbox[class=checkbox_living]:checked").val();
          $('.checkbox_gender').click(function() {
            $('.checkbox_gender').not(this).prop('checked', false);
        });
        var gender_val=$("input:checkbox[class=checkbox_gender]:checked").val();
              if(!living_val)
              {
                living_val = "";
              }
              if(!gender_val)
              {
                gender_val = "";
              }
          // console.log(searched_node_id);
          // console.log(university_text);
          // console.log(state_text);
          // console.log(country_text);
          // console.log(major_text);
          // console.log(degree_text);
          // console.log(living_val);
          // console.log(gender_val);
          // console.log(ethnicity_text);
          if(!searched_node_id && !university_text && !state_text && !country_text
            && !major_text && !degree_text && !ethnicity_text && !living_val
           && !gender_val){
            $('#search_text').html('&nbsp&nbsp'+"No Results Found. Please change your search criteria.");
            var emptyNodes = [];
            var emptyEdges = [];
            var data = {
              nodes: emptyNodes,
              edges: emptyEdges
            };
            createVisNetwork(container, data, options);
            }
            else{
              $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+" "+
              university_text+" "+living_val+" "+gender_val+" "+state_text+" "+country_text+" "+major_text
              +" "+degree_text+" "+ethnicity_text+'</span>');
            }

          if(searched_node_id && !university_text && !state_text && !country_text
            && !major_text && !degree_text && !ethnicity_text && !living_val
           && !gender_val)
          {
            network.focus(
              searched_node_id, // which node to focus on
              {
                scale: 0.6, // level of zoom while focussing on node
                animation: {
                  duration: 1000, // animation duration in milliseconds (Number)
                  easingFunction: "easeInOutQuart" // type of animation while focussing
                }
              }
            );
          }else{
            if(major_text || degree_text || university_text)
            {
              $.ajax({
                type: "POST",
                url: 'artistcontroller.php',
                data: JSON.stringify({"action": "getArtistProfileForNetwork",
                                        "artistprofileid": searched_node_id,
                                        "institutionname":university_text,
                                        "artistlivingstatus":living_val,
                                        "artistgender":gender_val,
                                        "artistresidencestate":state_text,
                                        "artistresidencecountry":country_text,
                                        "artistmajor":major_text,
                                        "artistdegree":degree_text,
                                        "artistethnicity":ethnicity_text
                                      }),
                success:function(response)
                {
                  $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+" "+
                  university_text+" "+living_val+" "+gender_val+" "+state_text+" "+country_text+" "+major_text
                  +" "+degree_text+" "+ethnicity_text+'</span>');
                    ({ response, nodes } = createFilteredNetwork(response, nodes, createVisNetwork, container));
                },
                error:function(response)
                {
                  console.log("Error");
                }
              });
            } else if(searched_node_id || living_val|| gender_val||
            state_text|| country_text || ethnicity_text){
              $.ajax({
                type: "POST",
                url: 'artistcontroller.php',
                data: JSON.stringify({"action": "getArtistProfile",
                                        "artistprofileid": searched_node_id,
                                        "artistlivingstatus":living_val,
                                        "artistgender":gender_val,
                                        "artistresidencestate":state_text,
                                        "artistresidencecountry":country_text,
                                        "artistethnicity":ethnicity_text
                                      }),
                success:function(response)
                {
                      $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+search_text+" "+
              university_text+" "+living_val+" "+gender_val+" "+state_text+" "+country_text+" "+major_text
              +" "+degree_text+" "+ethnicity_text+'</span>');
                    ({ response, nodes } = createFilteredNetwork(response, nodes, createVisNetwork, container));
                },
                error:function(response)
                {
                  console.log("Error");
                }
              });
            }

          }
      }));
    }
  });

  function createWholeNetwork(container, data, options)
  {
      options = {
        nodes: {
          borderWidth: 10, // thickness of border around nodes
          color: {
            background: '#FFFFFF', // default background color of node, visible when artist doesn't have an image
            hover: {
              background:'#89082f', // background color of node on hover
              border: '#000000' // border color of node on hover
            }
          },
          size: 5 // size of node
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

        var container = document.getElementById('my_network');
        network = new vis.Network(container, data, options);
        network.on("stabilizationIterationsDone", function () {
          network.setOptions( { physics: false } );
          });

        network.on('dragging', function(obj){
          $("#my_network").css("cursor", "-webkit-grabbing");
        });

        network.on('selectNode', function (obj) {
        var side_nav = document.getElementById("mySidenav");
        side_nav.style.width = "300px";
        side_nav.style.display = "block";
        var selected_node = obj.nodes;
        var artist_pic = document.getElementById("artist_pic");
        var artist_name = document.getElementById("artist_name");
        var artist_gender = document.getElementById("artist_gender");
        var artist_status = document.getElementById("artist_status");
        var artist_education = document.getElementById("artist_education");
        var artist_genre = document.getElementById("artist_genre");
        var artist_bio_div = document.getElementById("artist_bio_div");
        var bio_text_val = document.getElementById("bioTextValue");
        var artist_lineage_text = document.getElementById("artist_lineage_text");
        var artist_lineals = document.getElementById("artist_lineals");
        artist_bio_div.style.visibility="hidden";
        for (var i = 0; i < totalNodes.length; i++) {
          var cur_node = totalNodes[i].id;
          if(selected_node[0] === cur_node)
          {
            if(totalNodes[i].image === "upload/photo_upload_data/missing_image.jpg")
            {
              artist_pic.src="upload/photo_upload_data/NoImageAvailable.jpg";
            }else{
              artist_pic.src= totalNodes[i].image;
            }
            artist_name.innerHTML= totalNodes[i].label ;
            if(totalNodes[i]["gender"] === "male" || totalNodes[i]["gender"] === "Male")
            {
              artist_gender.innerHTML= "Male";
            }else if(totalNodes[i]["gender"] ==="") {
              artist_gender.innerHTML= "";
            }else if(totalNodes[i]["gender"] === "female" || totalNodes[i]["gender"] === "Female")
            {
              artist_gender.innerHTML= "Female";
            }
            var dobDate = new Date(totalNodes[i]["dob"]);
            var dodDate = new Date(totalNodes[i]["dod"]);
            if(dobDate == "Invalid Date")
            {
              artist_status.innerHTML="";
            } else if(dodDate == "Invalid Date")
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              artist_status.innerHTML= dobDate + "-"+" Present";
            }
            else if(dobDate && dodDate)
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              dodDate = (dodDate.getMonth()+2) + '/' + dodDate.getDate() + '/' +  dodDate.getFullYear();
              artist_status.innerHTML= dobDate+ "-" +dodDate;
            }
            if(totalNodes[i]["biography"])
            {
              artist_bio_div.style.visibility="visible";
              if(totalNodes[i]["biography"].startsWith("upload/"))
              {
                url = "http://stark.cse.buffalo.edu/choreographiclineage/"+totalNodes[i]["biography"];
                bio_text_val.innerHTML= url;
              }else if(totalNodes[i]["biography"]){
                bioText= totalNodes[i]["biography"];
                bio_text_val.innerHTML= bioText;
              }
            }

            if(totalNodes[i]["genre"])
            {
              genreVal = totalNodes[i]["genre"];
              artist_genre.innerHTML= "<b>Genres: </b>"+genreVal.substr(1);
            }else{
              artist_genre.innerHTML= "";
            }

            if(totalNodes[i]["university_main"])
            {
              artist_education.innerHTML= "<b>University: </b>"+totalNodes[i]["university_main"];
            }else{
              artist_education.innerHTML= "";
            }

            displaydata = totalNodes[i]["artist_relation"];
            if(displaydata)
            {
              artist_lineage_text.style.visibility="visible";
              artist_lineals.style.visibility="visible";
              table = $("#artist_lineals").DataTable({
                paging: false,
                searching: false,
                scrollY: 400,
                info: false,
                data:displaydata,
                columns:[
                  {"data": "relationship"},
                  {"data": "artist_name" }
                ],
                "bDestroy": true
              });
            } else
            {
              artist_lineage_text.style.visibility="hidden";
              artist_lineals.style.visibility="hidden";
            }
          }
        }
      });
  }

  function createVisNetwork(container, data, options)
  {
    inquiry_text.style.visibility="visible";
        options = {
          nodes: {
            borderWidth: 10, // thickness of border around nodes
            color: {
              background: '#FFFFFF', // default background color of node, visible when artist doesn't have an image
              hover: {
                background:'#89082f', // background color of node on hover
                border: '#000000' // border color of node on hover
              }
            },
            size: 10 // size of node
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
        var container = document.getElementById('my_network');
        network = new vis.Network(container, data, options);
        if(data.nodes==0)
        {
          $('#search_text').html('&nbsp&nbsp'+"No Results Found. Please change your search criteria.");
        }
        network.on("stabilizationIterationsDone", function () {
        network.setOptions( { physics: false } );
        });

        network.on('dragging', function(obj){
          $("#my_network").css("cursor", "-webkit-grabbing");
        });

        network.on('selectNode', function (obj) {
        var side_nav = document.getElementById("mySidenav");
        side_nav.style.width = "300px";
        side_nav.style.display = "block";
        var selected_node = obj.nodes;
        var artist_pic = document.getElementById("artist_pic");
        var artist_name = document.getElementById("artist_name");
        var artist_gender = document.getElementById("artist_gender");
        var artist_status = document.getElementById("artist_status");
        var artist_education = document.getElementById("artist_education");
        var artist_genre = document.getElementById("artist_genre");
        var artist_bio_div = document.getElementById("artist_bio_div");
        var bio_text_val = document.getElementById("bioTextValue");
        var artist_lineage_text = document.getElementById("artist_lineage_text");
        var artist_lineals = document.getElementById("artist_lineals");
        artist_bio_div.style.visibility="hidden";
        for (var i = 0; i < totalNodes.length; i++) {
          var cur_node = totalNodes[i].id;
          if(selected_node[0] === cur_node)
          {
            if(totalNodes[i].image === "upload/photo_upload_data/missing_image.jpg")
            {
              artist_pic.src="upload/photo_upload_data/NoImageAvailable.jpg";
            }else{
              artist_pic.src= totalNodes[i].image;
            }
            artist_name.innerHTML= totalNodes[i].label ;
            if(totalNodes[i]["gender"] === "male" || totalNodes[i]["gender"] === "Male")
            {
              artist_gender.innerHTML= "Male";
            }else if(totalNodes[i]["gender"] ==="") {
              artist_gender.innerHTML= "";
            }else if(totalNodes[i]["gender"] === "female" || totalNodes[i]["gender"] === "Female")
            {
              artist_gender.innerHTML= "Female";
            }
            var dobDate = new Date(totalNodes[i]["dob"]);
            var dodDate = new Date(totalNodes[i]["dod"]);
            if(dobDate == "Invalid Date")
            {
              artist_status.innerHTML="";
            } else if(dodDate == "Invalid Date")
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              artist_status.innerHTML= dobDate + "-"+" Present";
            }
            else if(dobDate && dodDate)
            {
              dobDate = (dobDate.getMonth()+2) + '/' + dobDate.getDate() + '/' +  dobDate.getFullYear();
              dodDate = (dodDate.getMonth()+2) + '/' + dodDate.getDate() + '/' +  dodDate.getFullYear();
              artist_status.innerHTML= dobDate+ "-" +dodDate;
            }
            if(totalNodes[i]["biography"])
            {
              artist_bio_div.style.visibility="visible";
              if(totalNodes[i]["biography"].startsWith("upload/"))
              {
                url = "http://stark.cse.buffalo.edu/choreographiclineage/"+totalNodes[i]["biography"];
                bio_text_val.innerHTML= url;
              }else if(totalNodes[i]["biography"]){
                bioText= totalNodes[i]["biography"];
                bio_text_val.innerHTML= bioText;
              }
            }

            if(totalNodes[i]["genre"])
            {
              genreVal = totalNodes[i]["genre"];
              artist_genre.innerHTML= "<b>Genres: </b>"+genreVal.substr(1);
            }else{
              artist_genre.innerHTML= "";
            }

            if(totalNodes[i]["university_main"])
            {
              artist_education.innerHTML= "<b>University: </b>"+totalNodes[i]["university_main"];
            }else{
              artist_education.innerHTML= "";
            }

            displaydata = totalNodes[i]["artist_relation"];
            if(displaydata)
            {
              artist_lineage_text.style.visibility="visible";
              artist_lineals.style.visibility="visible";
              table = $("#artist_lineals").DataTable({
                paging: false,
                searching: false,
                scrollY: 400,
                info: false,
                data:displaydata,
                columns:[
                  {"data": "relationship"},
                  {"data": "artist_name" }
                ],
                "bDestroy": true
              });
            } else
            {
              artist_lineage_text.style.visibility="hidden";
              artist_lineals.style.visibility="hidden";
            }
          }
        }
        });
  }
}

function createFilteredNetwork(response, nodes, createVisNetwork, container) {
  var inquiry_text = document.getElementById('search_text');
  inquiry_text.style.visibility="visible";
  response = JSON.stringify(response);
  console.log(response);
  jsonData = $.parseJSON(response);
  profiles = jsonData.artist_profile;
  //console.log(profiles);
  var finalNodes = [];
  if (profiles) {
    for (var i = 0; i < profiles.length; i++) {
      var nodeDetails = {};
      nodeDetails['id'] = profiles[i].artist_profile_id;
      nodeDetails['title'] = profiles[i].artist_first_name + " " + profiles[i].artist_last_name;
      nodeDetails['shape'] = "circularImage";
      nodeDetails['label'] = profiles[i].artist_first_name + " " + profiles[i].artist_last_name;
      if (profiles[i].artist_photo_path) {
        nodeDetails['image'] = profiles[i].artist_photo_path;
      }
      else {
        nodeDetails['image'] = "upload/photo_upload_data/missing_image.jpg";
      }
      nodeDetails['size'] = "10";
      if (profiles[i].is_user_artist === "artist") {
        nodeDetails['color'] = '#da0067';
      }
      else {
        nodeDetails['color'] = '#025457';
      }
      finalNodes.push(nodeDetails);
    }
  }else{
    $('#search_text').html('&nbsp&nbsp'+"No Results Found. Please change your search criteria.");
  }
      nodes = {};
      var data = {
        nodes: finalNodes
      };
      createVisNetwork(container, data, options);
      return { response, nodes };
}
