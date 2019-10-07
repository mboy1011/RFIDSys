<?php
 require_once('config.php');
 require_once('loginSession.php');
 
 $db = new Database();

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */

$filename = date('YmdHis') . '.jpg';
$pathLocation = $_SESSION['photoPathLocation'] = "images/$filename"; //session to my file path

//captured photo nga walay mga gamit temporary store sa trash photo table then delete afterwards
$sql = "INSERT INTO trash_photos (trash_location)
		VALUES (?);
";

$insertPhoto = $db->insertRow($sql, [$pathLocation]);

if(!$insertPhoto){
	print "ERROR: Failed to store temporary photo.\n";
	exit();
}

$result = file_put_contents( 'images/'.$filename, file_get_contents('php://input') );//upload

if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}

$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/images/' . $filename;
print "$url\n";

?>
