<?php

// include the config file.
require( "config.php" );



/**************************************************************
   
    REQUEST HELPER:
    Instantiate this object and it will automatically get
    information about the visiting browser/OS and return
    it in simple functions so you may customize your site
    for mobile and screen devices.
	
	NO REQUIRED CLASSES OR TABLE STRUCTURES
	
 **************************************************************/
function request( $param, $default="" ) {
	return ( isset( $_REQUEST[$param] ) ? $_REQUEST[$param] : ( !empty( $default ) ? $default : "" ) );
}




/**************************************************************
   
    SESSION HELPER:
    Instantiate this object and it will automatically get
    information about the visiting browser/OS and return
    it in simple functions so you may customize your site
    for mobile and screen devices.
	
	NO REQUIRED CLASSES OR TABLE STRUCTURES
	
 **************************************************************/
function session( $param, $default="" ) {
	return ( isset( $_SESSION[$param] ) ? $_SESSION[$param] : ( !empty( $default ) ? $default : "" ) );
}




/**************************************************************
   
    API HOOK FUNCTIONS:
    These enable modules to add new api hooks, allowing
    module developers to provide AJAX interaction in their
    features.
	
 **************************************************************/

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

function api_hook( $action, $function ) {
	global $api_hooks;
	if ( !is_array( $api_hooks ) ) $api_hooks=array(); 
	if ( !isset( $api_hooks[$action] ) ) $api_hooks[$action]=array();
	if ( !is_array( $api_hooks[$action] ) ) $api_hooks[$action]=array();
	$api_hooks[$action][]=$function;
}




/************************************
 DATABASE FUNCTIONS
************************************/

class db {
	protected $cn='';
	public $result='';
	public $show_errors=true;

	function db() {
		$this->cn=@mysql_connect( DB_HOST, DB_USER, DB_PASS);
		mysql_select_db( DB_NAME );
	}

	function query( $query ) {
		$select=mysql_query( $query,$this->cn );
		if ( is_resource( $select ) ) {
			while ( $rowselect=mysql_fetch_object( $select ) ) {
				$results[]=$rowselect;
			}
		}
		if ( !empty( $results ) ) {
			return $results;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function query_one( $query ) {
		$select=mysql_query( $query,$this->cn );
		if ( is_resource( $select ) ) {
			while ( $rowselect=mysql_fetch_object( $select ) ) {
				$results[]=$rowselect;
			}
		}
		if ( !empty( $results ) ) {
			return $results[0];
		} else {
			$this->handle_error();
			return false;
		}
	}

	function update( $query ) {
		$update=mysql_query( $query, $this->cn );
		if ( $update ) {
			return true;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function insert( $query ) {
		$update=mysql_query( $query, $this->cn );
		if ( $update ) {
			return mysql_insert_id();
		} else {
			$this->handle_error();
			return false;
		}
	}

	function handle_error() {
		$error=mysql_error();
		if ( !empty( $error ) && $this->show_errors ) {
			print $error;
			die;
		}
	}

}
$db=new db;


include( "user.php" );
include( "widget.php" );


?>