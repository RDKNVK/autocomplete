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
/*
if(isset($_GET['letters'])) {

	$letters = $_GET['letters'];
	$like = '';
	$s = false;
	if (isset($_GET['searchby'])){

		switch ($_GET['searchby']) {
			case 'first':
				$like = "$letters%";
				break;
			case 'any':
				$like = "%$letters%";
				break;
			case 'soundex':
				$s = true;
				break;
			
			default:
				break;
		}
	}

	$query_string = "	SELECT word 
						FROM words 
						WHERE LOWER (words.word) 
						LIKE '$like' 
						LIMIT 0, 15";

	$soundex = "SELECT word 
				FROM words 
				WHERE strcmp(soundex(word), soundex('$letters')) = 0
				LIMIT 0, 15";
	$query_string = $s ? $soundex : $query_string;

	$db = new Database('localhost', 'test', '1234', 'test');


	$db->query($query_string);

	echo json_encode($db->col(0));	
} else {
	echo "{}";
}
*/
?>