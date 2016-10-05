<?php

function get_user_by_api_key( $api_key ) {
	global $db;
	return $db->query_one( "SELECT * FROM `user` WHERE `api_key`='" . $api_key . "';" );
}


function create_user( $user_data ) {

}


?>
