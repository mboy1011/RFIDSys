<?php
 require_once('config.php');
require_once('loginSession.php');
 
 $db = new Database();

	if(isset($_POST['newRFID']) && isset($_POST['id'])){
		// echo 'good';
		$newRFID = $_POST['newRFID'];
		$id = $_POST['id'];
		
		//check first and newRFID kung ge gamit naba
		$sql = "SELECT * FROM students WHERE stud_RFID = ?";
		$res = $db->getRow($sql, [$newRFID]);
		if($res > 0){
			// echo 'exist';
			echo '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> ID already in used. . .
				</div>';			
		}else{
			// echo 'not exist';
			
			$sql = "UPDATE students SET stud_RFID = ? WHERE stud_id = ?";
			$res = $db->updateRow($sql, [$newRFID, $id]);
	

			echo '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> ID Updated Successfully. . .
				</div>';
		}
		
	?>
	
<?php
	}else{
?>
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Error</strong> Security Breach. . .
	</div>
<?php
	}	

$db->Disconnect();
 ?>

 