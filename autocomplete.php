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

require 'db_obj.php';

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

	// change these
	$db = new Database('your_db_host', 'your_db_login', 'your_db_password', 'your_db_name');


	$db->query($query_string);

	echo json_encode($db->col(0));	
} else {
	echo "{}";
}

?>