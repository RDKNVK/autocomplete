<?php 

//  
//  Autocomplete form in PHP, MySQL and jQuery's AJAX.
//  
//  --------------------------------------------------
//  use with for example:
//  
//  <div id="autocomplete">
//  	<input list="words" type="text" id="in">
//  	<div id="results"></div>
//  </div>
//  

/*

vyzkouset soundex:
select * from search_table where strcmp(soundex(search_title), soundex('searchterm')) = 0;

*/
class Database {
	public $link;
	public $conn_error;
	public $result;
	public $result_rows = array();

	public function __construct($location, $login, $pass, $db) {
		$this->link = mysqli_connect($location, $login, $pass, $db);

		if ( $this->link ) {
			$this->conn_error = false;
		} else {
			$this->conn_error = mysqli_error($link);
		}
	}

	public function query( $q ){
		$data = mysqli_query( $this->link, $q );
		while( $line = mysqli_fetch_array($data)){
			array_push($this->result_rows, array_slice($line, 0, count($line)/2, true));
		}
	}

	public function col( $col ){
		$ret = array();
		for ($i=0; $i < count($this->result_rows); $i++) { 
			array_push( $ret, $this->result_rows[$i][$col]);
		}
		return $ret;
	}
}
?>
