<?php 
include_once('config.php');
require_once('loginSession.php');

$db = new Database();

$db->Disconnect();//disconnect connection

// session_destroy();
unset($_SESSION['loginUserStatus']);
session_destroy();
header("location:index.php");

 ?>