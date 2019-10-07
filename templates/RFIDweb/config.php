<?php 

if(session_status() == PHP_SESSION_NONE)
{
	session_start();//start session if session not start
}


//class includes here
include_once("database/Database.php");//
include_once("class/FormatNumber.php");//decimal places

function printQuery($res){
	echo '<pre>';
		print_r($res);
	echo '</pre>';
}


 ?>