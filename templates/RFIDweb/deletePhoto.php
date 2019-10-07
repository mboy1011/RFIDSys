<?php 
	if(isset($_POST['photo'])){
		$photo = $_POST['photo'];
		unlink($photo);
	}

 ?>