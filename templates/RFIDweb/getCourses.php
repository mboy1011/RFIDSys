<?php 
	require_once('../config.php');
	require_once('loginSession.php');
	$db = new Database();

	//query to get the course the student
	$getCourse = "SELECT * FROM course;";
	$getCourseResult = $db->getRows($getCourse);

	// echo "<pre>";
	// echo print_r($getCourseResult);
	// echo "</pre>";
 ?>