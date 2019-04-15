


// ERROR FUNCTIONS
var no_results_div = $(".no-results");

// show the no results div.
var show_no_results_error = function() {

	// if it isn't already showing
	if ( !no_results_div.hasClass( "visible" ) ) {

		// fade it in, wait 5 seconds, fade it out
		no_results_div.addClass("visible");
		setTimeout( function(){
			no_results_div.removeClass("visible");
		}, 7000 );

	}
}


