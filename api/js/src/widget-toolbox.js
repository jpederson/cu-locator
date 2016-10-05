


// TOOLBOX FUNCTIONS
// grab the toolbox element in a jQuery object
var toolbox = $(".toolbox"),
	toolbox_icon = $(".toolbox-icon");



// show hidden toolbox
var show_toolbox = function(){

	// check for toolbox status
	if ( !toolbox.hasClass( "open" ) ) {
		toolbox.addClass( "open" );
	}

	// check toolbox icon status
	if ( toolbox_icon.hasClass( "open" ) ) {
		toolbox_icon.removeClass( "open" );
	}

}


// hide visible toolbox
var hide_toolbox = function(){

	// check for toolbox
	if ( toolbox.hasClass( "open" ) ) {
		toolbox.removeClass( "open" );
	}

	// check toolbox icon status
	if ( !toolbox_icon.hasClass( "open" ) ) {
		toolbox_icon.addClass( "open" );
	}

}


