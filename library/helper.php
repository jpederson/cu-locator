<?php


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


