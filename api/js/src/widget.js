


// generic logging function just to avoid errors
// in browsers that don't have the console available
// when devtools is closed.
var log = function( message ) {
	if ( window.console ) {
		console.log( message );
	}
}




$(function(){

	// Load the initial map.
	$('#map').gmap({
		'center': new google.maps.LatLng( 39.736762,-98.745117 ),
		'zoom': 4
	});

	// show overlay and toolbox initially.
	show_overlay();
	show_toolbox();

	toolbox_icon.click(function(){
		show_overlay();
		show_toolbox()
	});

	// Load up the map on click.
	$(".get-results").click(function(){
		get_locations_by_zip();
	});

	$(document).keyup(function(e){
		if ( e.keyCode==13 ) {
			get_locations_by_zip();
		}
	});

	$(".get-location").click(function(){

		// Check to see if this browser supports geolocation.
		if ( navigator.geolocation ) {
		 
	 		// hide toolbox
			hide_toolbox();

			// This is the location marker that we will be using
			// on the map. Let's store a reference to it here so
			// that it can be updated in several places.
			var locationMarker = null;
			 
			// Get the location of the user's browser using the
			// native geolocation service. When we invoke this method
			// only the first callback is requied. The second
			// callback - the error handler - and the third
			// argument - our configuration options - are optional.
			navigator.geolocation.getCurrentPosition(
				function( position ){

					// Check to see if there is already a location.
					// There is a bug in FireFox where this gets
					// invoked more than once with a cahced result.
					if (locationMarker){
						return;
					}
															
					get_locations_by_coords( position.coords.latitude, position.coords.longitude );

				},
				function( error ){
					log( "Something went wrong: " + error );
				},
				{
					timeout: (5 * 1000),
					maximumAge: (1000 * 60 * 15),
					enableHighAccuracy: true
				}
			);
		 
		}

	});

});