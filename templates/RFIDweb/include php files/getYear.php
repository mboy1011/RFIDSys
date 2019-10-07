<?php 
	require_once('config.php');
	$db = new Database();

	//query to get the course the student
	$getYear = "SELECT * FROM year ORDER by year_description ASC;";
	$getYearResult = $db->getRows($getYear);

	// echo "<pre>";
	// echo print_r($getYearResult);
	// echo "</pre>";
 ?>