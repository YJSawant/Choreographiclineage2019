function draw() {
  // display the loading div on start of the page
  $("#load").show();

  // initialize colors for each type of relationship between artists
  var edge_colors_dict = {default_color: "#C0C0C0", studied_with_color: "#FF1C1C", collaborated_with_color: "#FFA807", danced_for_color: "#50B516", influenced_by_color: "#3033CE"};

  // initialize path for the directory with images for nodes
  var image_dir = "data/images/";
    //var image_dir = "/src/photo_upload_data/";

  //default value of node id before search for artist is performed
  var searched_node_id = -1;

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

      // store the nodes and edges in corresponding vis js objects
      var nodes = new vis.DataSet(json_object.nodes);
      var edges = new vis.DataSet(json_object.edges);

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
      var options = {
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
            centralGravity: 0 // pulls entire network to the center
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
      var connected_nodes = [];
      var edges_to_update = [];
      for (var i = 0; i < edges.length; i++) {
        var curr_edge = edges.get(i);
        var edge_string = curr_edge.from + "->" + curr_edge.to;

        if(connected_nodes.indexOf(edge_string) > -1) {
          curr_edge.hidden = true;
        }
        edges_to_update.push(curr_edge);
        connected_nodes.push(edge_string);
      }
      edges.update(edges_to_update);

      // initialize the network object
      var network = new vis.Network(container, data, options);

      // set physics to false after stabilization iterations
      network.on("stabilizationIterationsDone", function () {
        // console.log("stabilization done");
        network.setOptions( { physics: false } );
      });

      // hide the loading div after network is fully loaded
      network.on("afterDrawing", function () {
        // console.log("going to hide loader");
        $("#load").css("display","none");
        $("body").css("overflow", "scroll");
      });

      // change the type of cursor to grabbing hand while dragging the network
      network.on('dragging', function(obj){
        // console.log("network held!");
        $("#my_network").css("cursor", "-webkit-grabbing");
      });

      // change the type of cursor to hand on releasing the drag
      network.on('release', function(obj){
        // console.log("network released!");
        $("#my_network").css("cursor", "-webkit-grab");
      });

      // change the type of cursor to pointing hand when hovered over a node
      network.on('hoverNode', function (obj) {
        // console.log("node hovered");
        $("#my_network").css("cursor", "pointer");
      });

      // change the type of cursor to hand on coming out of node hover
      network.on('blurNode', function (obj) {
        // console.log("node blurred");
        $("#my_network").css("cursor", "-webkit-grab");
      });

      network.on('selectNode', function (obj) {
        console.log("node selected");
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
        // if full network tab is clicked then display all edges in grey color
        // and if multiple edges occur between 2 nodes then display only one of them
        if(this.id === "full_network_tab") {
          for (var i = 0; i < edges.length; i++) {
            var curr_edge = edges.get(i);
            var edge_string = curr_edge.from + "->" + curr_edge.to;
            curr_edge.hidden = false;
            if(connected_nodes.indexOf(edge_string) > -1) {
              curr_edge.hidden = true;
            }
            curr_edge.color = edge_colors_dict["default_color"];
            edges_to_update.push(curr_edge);
            connected_nodes.push(edge_string);
          }
        }
        // if a relationship tab is selected then display only the edges of that relationship
        else {
          // get name of selected relationship from id of the tab
          var relationship_selected_array = this.id.split("_");
          var relationship_selected = (relationship_selected_array[0] + " " + relationship_selected_array[1]).toLowerCase();

          // get color of the edge based on type of relationship
          var edge_color = edge_colors_dict[(relationship_selected_array[0] + "_" + relationship_selected_array[1] + "_color").toLowerCase()];

          // determine which edges to display based on type of relationship
          for (var i = 0; i < edges.length; i++) {
            var curr_edge = edges.get(i);
            if(curr_edge.label.toLowerCase() === relationship_selected) {
              curr_edge.hidden = false;
              curr_edge.color = edge_color;
            }
            else {
              curr_edge.hidden = true;
            }
            edges_to_update.push(curr_edge);
          }
        }
        edges.update(edges_to_update);
      });


      // code for the autocomplete searchbox
      $searchbox = $("#searchbox");
      
      $searchbox.autocomplete({
        minLength: 1, // minimum of 1 characters to be entered before suggesting artist names
        source: names,
        select: function (event, ui) {
            $searchbox.val(ui.item.label); // display the selected text
            $("#searchTextValue").val(ui.item.label);
            $("#searchbox_node_id").val(ui.item.node_id); // save selected node_id to hidden input
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
          var final_text = $("#searchTextValue").val();
          if(final_text!=null)
          {
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+final_text+'</span>');
          }    
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
      });

      submit = document.getElementById('submit');
      submit.addEventListener('click',(function(e) {
          var searched_node_id = $("#searchbox_node_id").val();
          var final_text = $("#searchTextValue").val();
          if(final_text!=null)
          {
            $('#search_text').html('&nbsp&nbsp'+"Results for"+" "+'<span style="font-weight:bold">'+final_text+'</span>');
          }    
          network.focus(
          searched_node_id, // which node to focus on
          {
            scale: 0.6, // level of zoom while focussing on node
            animation: {
              duration: 1000, // animation duration in milliseconds (Number)
              easingFunction: "easeInOutQuart" // type of animation while focussing
            }
          });
      }));
    }
  });
}
