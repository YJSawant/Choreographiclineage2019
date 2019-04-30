function getData() {
		//window.open('/src/load_artists_data.php?'+dta,'_self');


		//console.log(JSON.stringify({"action": "getGenres"}));

		$.ajax({
			type: "POST",
			url: 'genrecontroller.php',
			data: JSON.stringify({"action": "getGenres"}),
		     success: function(response) {
		     	//console.log(response);
					response = JSON.stringify(response);
		     	jsonData = $.parseJSON(response);
					console.log(jsonData.genres);
		     	jsonData = jsonData.genres;

					var genres  = new Array();
					var genreIncrementor=0;
					var category_names = new Array();

					for (var i = 0; i < jsonData.length; i++) {

						if(genres.some(e  => e.title === jsonData[i].category)){
								var tempGenre={id:jsonData[i].genre_id,title:jsonData[i].genre_name};
								var someGenre=genres.find(e => e.title === jsonData[i].category);
								someGenre.subs.push(tempGenre);
						}
						else{
							category_names.push(jsonData[i].category);
							var subs=new Array();
							var tempGenre={id:jsonData[i].genre_id,title:jsonData[i].genre_name};
							subs.push(tempGenre);
						 var objectToinsert={id:i,title:jsonData[i].category,subs:subs};
						 genres.push(objectToinsert);
						}
					}
					comboTree1=$('#lineal_genre').comboTree({
					  source : genres,
					  isMultiple: true
					});
				},
				error: function(response){
					console.log(response);
				}
		});

}
