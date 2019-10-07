<?php 
	require_once('config.php');
	$db = new Database();

	//query to get the course the student
	$getCourse = "SELECT * FROM course ORDER by cour_description ASC;";
	$getCourseResult = $db->getRows($getCourse);

	// echo "<pre>";
	// echo print_r($getCourseResult);
	// echo "</pre>";
 ?>