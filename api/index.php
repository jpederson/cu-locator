<?php


// include the function library
require( "../functions.php" );

// get the action parameter from the URL
$action=request( "action" );

// if we have an action, process the action via the api hook functions
if ( !empty( $action ) ) do_api_hooks( $action );

