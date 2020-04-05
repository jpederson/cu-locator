<?php


// function for the 'search' API endpoint
function api_search() {

	// get request parameters
	$radius=request( "radius", 25 );
	$zipcode=request( "zipcode" );
	$latitude=request( "latitude" );
	$longitude=request( "longitude" );

	// zipcode search
	if ( !empty( $zipcode ) ) {
		$results = get_locations_by_zipcode( $zipcode, $radius );
	}

	// latitude and longitude search
	if ( !empty( $latitude ) && !empty( $longitude ) ) {
		$results = get_locations_by_coords( $latitude, $longitude, $radius );
	}

	// add the input parameters to the results for reference
	$results->parameters = array(
		'radius' => $radius,
		'zipcode' => $zipcode,
		'latitude' => $latitude,
		'longitude' => $longitude
	);

	// if we have results
	if ( isset( $results->branches ) && isset( $results->atms ) ) {

		// if the results are empty
		if ( empty( $results->branches ) && empty( $results->atms ) ) {

			// return no results message
			print "No results.";

		} else { // if we've got results

			// return the results object
			print json_encode( $results );

		}
	} else {

		// if no input was sent, provide a message to say what's missing.
		print "Incomplete API Request: You must pass either a 'zipcode' or 'latitude' and 'longitude' parameters to get results.";
	}

}
api_hook( "search", "api_search" );


// function for the 'stats' endpoint
function api_stats() {

	// output the stats in json 
	print json_encode( get_location_stats() );

}
api_hook( "stats", "api_stats" );


// get stats about the number of atms and branches.
function get_location_stats() {		
	global $db;

	// get counts
	$branch_count=$db->query_one( "SELECT count(*) AS `count` FROM `branch`;" );
	$atm_count=$db->query_one( "SELECT count(*) AS `count` FROM `atm`;" );

	// return them in an object
	return (object) array(
		"branch_count" => $branch_count->count,
		"atm_count" => $atm_count->count
	);
}


// get locations by zipcode
function get_locations_by_zipcode( $zipcode, $radius=10 ) {
	global $db;

	// get zipcode info so that we know the latitude and longitude of the zipcode
	$zip_info=$db->query_one( "SELECT * FROM `zipcode` WHERE `zipcode`=\"" . $zipcode . "\" LIMIT 1;" );

	// calculate range based on radius
	$range = ( $radius / 69.172 );

	// set up min and max variables for our query
	$lat_min = $zip_info->latitude-$range;
	$lat_max = $zip_info->latitude+$range;
	$long_min = $zip_info->longitude-$range;
	$long_max = $zip_info->longitude+$range;

	// get the results
	$response = new stdClass;
	$response->branches=$db->query( "SELECT * FROM `branch` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );
	$response->atms=$db->query( "SELECT * FROM `atm` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );
	return $response;
}


// get atm and branch locations by geographical coordinates
function get_locations_by_coords( $latitude, $longitude, $radius=10 ) {
	global $db;

	// calculate range based on radius
	$range = ( $radius / 69.172 );

	// set up min and max variables for our query
	$lat_min = $latitude-$range;
	$lat_max = $latitude+$range;
	$long_min = $longitude-$range;
	$long_max = $longitude+$range;

	// get the results
	$response = new stdClass;
	$response->branches=$db->query( "SELECT * FROM `branch` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );
	$response->atms=$db->query( "SELECT * FROM `atm` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );

	// return the response variable
	return $response;
}


// display the widget.
function widget() {

	// get a custom stylesheet if it's been specified.
	$custom_css=request( "custom-css" );

	// get the api key so we can check it.
	$api_key=request( "api-key", "trial" );
	// $user_info=get_user_by_api_key( $api_key );

	$show_ads=true;

?><!DOCTYPE html>
<html>
  <head>
    <title>Credit Union Search Tool</title>
    <link href="css/widget.css?v=2" rel="stylesheet" rel="stylesheet" media="screen" />
    <?php if ( !empty( $custom_css ) ) { ?>
    <link href="<?php print $custom_css ?>" rel="stylesheet" rel="stylesheet" media="screen" />
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
	<div class="widget">
		<div class="toolbox">
			<p class="small">Branch &amp; ATM Search</p>
			<p><label>Within (radius)
			<select id="radius">
				<option value="5">5 miles</option>
				<option value="10" selected>10 miles</option>
				<option value="25">25 miles</option>
				<option value="50">50 miles</option>
				<option value="75">75 miles</option>
			</select></label></p>
			<p><label>ZIP Code:
			<input type="text" id="zipcode" value="" /></label>
			<p><button class="get-results">Search by ZIP</button></p>
			<div class="location-enabled">
				<p class="small">- OR -</p>
				<p><button class="get-location" title="Current Location">Current Location</button></p>
			</div>
		</div>
		<button class="toolbox-icon">Show Toolbar</button>
		<div id="map" class="map"></div>
		<div class="overlay"></div>
		<div class="no-results">
			No results found.
		</div>
	</div>
    <script src="//maps.google.com/maps/api/js?key=<?php print GMAP_API_KEY ?>"></script>
    <script src="js/widget.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-614793-7', 'creditunion.io');
	  ga('send', 'pageview');
	</script>
  </body>
</html><?php
}
api_hook( "widget", "widget" );

