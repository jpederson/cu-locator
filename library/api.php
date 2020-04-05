<?php


// process API hooks for a specified action (usually pulled from the 
// 'action' URL parameter)
function do_api_hooks( $action ) {
	global $api_hooks;
	if ( !empty( $api_hooks[$action] ) ) {
		foreach ( $api_hooks[$action] as $hook ) {
			if ( function_exists( $hook ) ) {
				$hook();
			}
		}
	}
}


// add an api hook - takes two parameters:
// - action: matches a URL parameter
// - function: specify the function to execute when action is called
function api_hook( $action, $function ) {
	global $api_hooks;
	if ( !is_array( $api_hooks ) ) $api_hooks=array(); 
	if ( !isset( $api_hooks[$action] ) ) $api_hooks[$action]=array();
	if ( !is_array( $api_hooks[$action] ) ) $api_hooks[$action]=array();
	$api_hooks[$action][]=$function;
}

