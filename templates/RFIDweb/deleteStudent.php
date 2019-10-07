<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();

	if(isset($_GET['id'])){
		$studID = $_GET['id'];
		$photo = $_POST['photo'];

		$deleteSql = "DELETE FROM students WHERE stud_id = ?";
		$db->deleteRow($deleteSql, [$studID]) or die(mysql_error());
	}

	$db->Disconnect();
 ?>

