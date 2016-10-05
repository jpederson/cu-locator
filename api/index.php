<?php

require( "../functions.php" );

$action=request( "action" );
if ( !empty( $action ) ) do_api_hooks( $action );

?>