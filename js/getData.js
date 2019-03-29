function getData() {
		//window.open('/src/load_artists_data.php?'+dta,'_self');
		$.ajax({
		     type: "POST",
		     url: 'load_artists_data.php',
		     data: {mode:"FULL_NETWORK"},
		     //dataType: "json",
		     success: function(response) {
		     	// console.log(response);
		     	
		     	// data_array = $.parseJSON(data_array);
		     	// console.log(data_array);
		     	var names = new Array();

		     	var image_dir = "data/images/";
		     	var jsonData = JSON.parse(response);
				for (var i = 0; i < jsonData.length; i++) {
					
					jsonData[i].artist_photo_path = image_dir + jsonData[i].artist_photo_path
					names.push({label: jsonData[i].artist_first_name, lastName: jsonData[i].artist_last_name, email: jsonData[i].artist_email_address, website: jsonData[i].artist_website, icon: jsonData[i].artist_photo_path});
				}
				var fArr = new Array();
				var lArr = new Array();
				var eArr = new Array();
				for (var i = 0; i < names.length; i++) {
					//console.log(names[i]);
					fArr[i] = names[i].firstName;
					lArr[i] = names[i].lastName;
					eArr[i] = names[i].email;
				}
		          //success message mybe...
		          //alert("SUCCESS"); 
		         
				 $searchbox = $("#artist_first_name-1");
				 $lastNameBox = $("#artist_last_name-1");
				 $email = $("#artist_email_address-1");
				 $website = $("#artist_website-1");
				      
			      $searchbox.autocomplete({

			        minLength: 1, // minimum of 2 characters to be entered before suggesting artist names
			        source: names,
			        select: function (event, ui) {
			            $searchbox.val(ui.item.label); // display the selected text
						$lastNameBox.val(ui.item.lastName);
						//console.log(ui.item.email);
						$email.val(ui.item.email);
						$website.val(ui.item.website);
			           // $("#searchbox_node_id").val(ui.item.node_id); // save selected node_id to hidden input
			        }        
			      });

			      // method to make images appear along with names in autocomplete
			      $searchbox.data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			        //console.log("IN DATA");
			       // console.log(item);
			         var $li = $('<li>');
			         var $img = $('<img style="width:32px;height:32px;">');
			        
			        $img.attr({
			          src: item.icon, // path to image of the artist
			          alt: "" // none used in case artist image is unavailable
			        });

			       // console.log(item.firstName);

			         $li.append('<a href="#">');
			         $li.find('a').append($img).append(item.label);  
			         $li.find('a').css("display", "block");
			        // console.log($li.outerHTML);
			         return $li.appendTo(ul);

			         // return $("<li type=\"none\"></li>")
		          //   .data("item.autocomplete", item)
		          //   .append("<a><img src=\"" + item.icon + "\" /> " + item.firstName + "</a>")
		          //   .appendTo(ul);

			      };     

			      $searchbox.keypress(function(e) {
			      });
		     }
		});

}