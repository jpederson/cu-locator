<?php


/**************************************************************

    DATABASE OBJECT:
    Instantiate this object and it opens our SQLite database
    and is ready for queries.

 **************************************************************/


class db {
	protected $cn='';
	public $result='';
	public $show_errors=true;

	function __construct() {
		$this->cn=@mysqli_connect( DB_HOST, DB_USER, DB_PASS);
		mysqli_select_db( $this->cn, DB_NAME );
	}

	function query( $query ) {
		$select=mysqli_query( $this->cn,$query );
		while ( $rowselect=mysqli_fetch_object( $select ) ) {
			$results[]=$rowselect;
		}
		if ( !empty( $results ) ) {
			return $results;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function query_one( $query ) {
		$select=mysqli_query( $this->cn,$query );
		while ( $rowselect=mysqli_fetch_object( $select ) ) {
			$results[]=$rowselect;
		}
		if ( !empty( $results ) ) {
			return $results[0];
		} else {
			$this->handle_error();
			return false;
		}
	}

	function update( $query ) {
		$update=mysqli_query( $this->cn,$query );
		if ( $update ) {
			return true;
		} else {
			$this->handle_error();
			return false;
		}
	}

	function insert( $query ) {
		$update=mysqli_query( $this->cn, $query );
		if ( $update ) {
			return mysqli_insert_id( $this->cn );
		} else {
			$this->handle_error();
			return false;
		}
	}

	function handle_error() {
		$error=mysqli_error( $this->cn );
		if ( !empty( $error ) && $this->show_errors ) {
			print $error;
			die;
		}
	}

	function escape( $string ) {
		return mysqli_real_escape_string( $this->cn, $string );
	}
}


global $db;
$db=new db();

