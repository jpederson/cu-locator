


// SEARCH FUNCTIONS
// get locations by zipcode.
var get_locations_by_zip = function() {

	// store some jQuery objects
	var zipcode=$("#zipcode").val(),
		radius=$("#radius").val();

	// clear the markers from the map
	$('#map').gmap('clear', 'markers');

	// hide the toolbox
	hide_toolbox();

	// wait for the toolbox transition
	setTimeout( function(){

		// make the API call
		api_call( "search", "zipcode="+zipcode+"&radius="+radius, function(data){
			
			// log the data temporarily.
			log( data );

			// if error, display no-results div.
			if ( data=="No results." || data=="Invalid API Request." ) {
				
				show_no_results_error();
				show_toolbox();

			} else {

				// if there are results, hide the overlay and the toolbox.
				hide_overlay();

				// parse the response, get objects for our branches
				// and atms.
				var response=$.parseJSON( data ),
					branches=response.branches,
					atms=response.atms;

				// branch markers
				add_branch_markers( branches );

				// atm markers
				add_atm_markers( atms );

			}
		});

	}, 1000 );

}






// get locations by coordinates
function get_locations_by_coords( latitude, longitude ) {

	// clear the map first.
	$('#map').gmap('clear', 'markers');

	// grab the radius field value
	var radius=$("#radius").val();

	// wait for the toolbox transition
	setTimeout( function(){

		// call the search API the our info.
		api_call( "search", "latitude="+latitude+"&longitude="+longitude+"&radius="+radius, function(data){

			// log for debug
			log( data );

			// test for results
			if ( data=="No results." || data=="Invalid API Request." ) {
				
				// show the toolbox
				show_toolbox();

				// if no results, show error.
				show_no_results_error();

			} else {

				// if there are results, hide the overlay and the toolbox.
				hide_overlay();

				var response=$.parseJSON( data ),
					branches=response.branches,
					atms=response.atms;
				$('#map').gmap('addMarker', { 
					'position': new google.maps.LatLng( latitude, longitude ), 
					'bounds': true,
					'icon': "/img/marker-user.png"
				}).click(function(){
					$('#map').gmap('openInfoWindow', { 
						'content': '<h3>Your Location</h3><p>Latitude: '+latitude+'<br />Longitude: '+longitude+'</p>' 
					}, this);
				});
				add_atm_markers( atms );
				add_branch_markers( branches );
			}
		});

	}, 1000 );

}


