

// set the heights of the search div and the widget
var set_heights = function(){

    // grab the window height
    var window_height = $(window).height(),
        window_width = $(window).width(),
        search = $( "#search" ),
        search_title = search.find( "header" ),
        widget = $( "#widget" ),
        search_padding = parseInt( search.css( "padding-top" ) ) + parseInt( search.css( "padding-bottom" ) ),
        search_height = window_height - search_padding;

    widget.height( window_height*0.6 );
    search.height( search_height );
    if ( window_width > 767 ) { search_title.css( "padding-top", window_height*0.05 ); }
  
}


$(function(){

    // set heights on things
    set_heights();


    // and again if the window resizes
    $(window).resize( set_heights );


    // parallax effect
    if ( $(window).width()>600 ) {
        $(".scroll-effect").each(function(){
            var container_obj = $(this); // assigning the object
            
            $(window).scroll(function() {
                var distance_to_top = $(window).scrollTop();
                var bg_position = distance_to_top/-2;
                 
                // Put together our final background position
                var coords = '50% '+bg_position+'px';
     
                // Move the background
                container_obj.css({ backgroundPosition: coords });

            }); 
        });   
    }

}); 