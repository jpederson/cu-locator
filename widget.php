<?php


function search() {

	$type=request( "type" );
	$format=request( "format", "json" );
	$radius=request( "radius", 25 );
		
	// zipcode search
	$zipcode=request( "zipcode" );
	if ( !empty( $zipcode ) ) {
		$results=get_locations_by_zipcode( $zipcode, $radius );
	}

	// latitude and longitude search
	$latitude=request( "latitude" );
	$longitude=request( "longitude" );
	if ( !empty( $latitude ) && !empty( $longitude ) ) {
		$results=get_locations_by_coords( $latitude, $longitude, $radius );
	}

	if ( isset( $results ) ) {
		if ( empty( $results->branches ) && empty( $results->atms ) ) {
			print "No results.";
		} else {
			switch ( $format ) {
				case "json":
					print json_encode( $results );
				break;
			}
		}
	} else {
		print "Invalid API Request.";
	}

}
api_hook( "search", "search" );




function get_location_stats() {
	global $db;
	$branch_count=$db->query_one( "SELECT count(*) AS `count` FROM `branch`;" );
	$atm_count=$db->query_one( "SELECT count(*) AS `count` FROM `atm`;" );
	return (object) array(
		"branch_count" => $branch_count->count,
		"atm_count" => $atm_count->count
	);
}




function get_locations_by_zipcode( $zipcode, $radius=10, $type="branch,atm" ) {
	global $db;

	// get zipcode info so that we know the latitude and longitude of the zipcode
	$zip_info=$db->query_one( "SELECT * FROM `zipcode` WHERE `zipcode`=\"" . $zipcode . "\" LIMIT 1;" );

	// calculate range based on radius
	$range=($radius/69.172);

	// set up min and max variables for our query
	$lat_min=$zip_info->latitude-$range;
	$lat_max=$zip_info->latitude+$range;
	$long_min=$zip_info->longitude-$range;
	$long_max=$zip_info->longitude+$range;

	// get the results
	$response=new stdClass;
	if ( stristr( $type, "branch" ) ) $response->branches=$db->query( "SELECT * FROM `branch` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );
	if ( stristr( $type, "atm" ) ) $response->atms=$db->query( "SELECT * FROM `atm` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" );
	return $response;
}



function get_locations_by_coords( $latitude, $longitude, $radius=10 ) {
	global $db;
	// calculate range based on radius
	$range=$radius/69.172;

	// set up min and max variables for our query
	$lat_min=$latitude-$range;
	$lat_max=$latitude+$range;
	$long_min=$longitude-$range;
	$long_max=$longitude+$range;

	// get the results
	$response=(object) array(
		"branches" => $db->query( "SELECT * FROM `branch` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" ),
		"atms" => $db->query( "SELECT * FROM `atm` WHERE ( `latitude`>$lat_min AND `latitude`<$lat_max ) AND ( `longitude`>$long_min AND `longitude`<$long_max );" )
	);
	return $response;
}



function widget() {
	// get a custom stylesheet if it's been specified.
	$custom_css=request( "custom-css" );

	// get the api key so we can check it.
	$api_key=request( "api-key", "trial" );
	$user_info=get_user_by_api_key( $api_key );

	$show_ads=true;

	// check if it's a pro customer
	if ( $user_info->type=="pro" ) {
		$show_ads=false;
	}

?><!DOCTYPE html>
<html>
  <head>
    <title>Credit Union Search Tool</title>
    <link href="/api/css/widget.css?v=2" rel="stylesheet" rel="stylesheet" media="screen" />
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
		<?php if ( $user_info->type!="pro" ) { ?>
		<div class="ad">
			<a href="https://mycu.rocks/" target="_blank">powered by<br>
				<strong>mycu.rocks</strong></a>
		</div>
		<?php } ?>
	</div>
    <script src="//maps.google.com/maps/api/js?key=<?php print GMAP_API_KEY ?>"></script>
    <script src="/api/js/widget.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-614793-7', 'creditunion.io');
	  ga('send', 'pageview');

	</script>
  </body>
</html>
<?php
}
api_hook( "widget", "widget" );


?>