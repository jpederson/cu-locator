

// MARKER FUNCTIONS

// set up the map jquery object in a variable.
var cuio_map = $( "#map" );


// create map markers for the branch list
var add_branch_markers = function( branches ) {

	// create a lat/long bounds object
	var latlngbounds = new google.maps.LatLngBounds();

	// if we have branches
	if ( branches.length>0 ) {

		// loop through
		$.each( branches, function( i, branch ) {

			// create the marker at the branch coordinates
			cuio_map.gmap('addMarker', { 
				'position': new google.maps.LatLng( branch.latitude, branch.longitude ), 
				'bounds': true,
				'icon': "./img/marker-branch.png"
			}).click(function(){

				// bind an info window click event to the new marker
				cuio_map.gmap( 'openInfoWindow', { 
					'content': 
						'<h5>Shared Branch</h5>'+
						'<h3>'+branch.name+'</h3>'+
						'<p>'+branch.address1+( branch.address2.length>0 ? "<br />"+
							branch.address2 : '' )+"<br />"+
						branch.city+", "+branch.state+" "+branch.zip+'</p>' 
				}, this);

			});

			// extend the map boundaries to fit the new pin
			latlngbounds.extend( new google.maps.LatLng( branch.latitude, branch.longitude ) );
		});

		// resize the map
		cuio_map.gmap("get", "map").fitBounds( latlngbounds );
	}

}



// create map markers for the atm list
var add_atm_markers = function( atms ) {

	// create a lat/long bounds object
	var latlngbounds = new google.maps.LatLngBounds();

	// if we have ATMs
	if ( atms.length>0 ) {

		// loop through them suckas
		$.each( atms, function( i, atm ) {

			// add the marker at the our ATM coordinates
			cuio_map.gmap('addMarker', { 
				'position': new google.maps.LatLng( atm.latitude, atm.longitude ), 
				'bounds': true,
				'icon': "./img/marker-atm.png"
			}).click(function(){

				// click event for info window on this pin
				cuio_map.gmap('openInfoWindow', { 
					'content': '<h5>ATM</h5><h3>'+atms[i].description.replace(/USA-/g,"")+'</h3>' 
				}, this);

			});

			// extend the map boundaries to fit our pin
			latlngbounds.extend( new google.maps.LatLng( atm.latitude, atm.longitude ) );
		});

		// resize the map
		cuio_map.gmap("get", "map").fitBounds( latlngbounds );
	}
}


