


// OVERLAY FUNCTIONS
// grab the overlay element in an object
var overlay = $(".overlay");


// show hidden overlay
var show_overlay = function(){

	// transitions setting
	var overlay_transition = "all 1s ease-in-out";
	
	// show the overlay if it's hidden
	if ( !overlay.hasClass( "open" ) ) {
		overlay.addClass( "open" );
		
		// check if transition is set, and set if not.
		if ( overlay.css( "transition" )!==overlay_transition ) {
			overlay.delay(500).css( "transition", overlay_transition );
		}
	}

}


// hide visible overlay
var hide_overlay = function(){
	if ( overlay.hasClass( "open" ) ) {
		overlay.removeClass( "open" );
	}
}


