<?php 
	require_once('config.php');
	$db = new Database();

	//query to get the course the student
	$getSection = "SELECT * FROM section ORDER by sect_description ASC;";
	$getSectionResult = $db->getRows($getSection);

	// echo "<pre>";
	// echo print_r($getCourseResult);
	// echo "</pre>";
 ?>