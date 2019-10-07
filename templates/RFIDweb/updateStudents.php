<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();
	$message = "";

	if(isset($_GET['id'])){
		// echo 'set';
		$id = $_GET['id'];
		$studID = $_POST['studID'];
		$fN = $_POST['fN']; $fN = ucfirst($fN);
		$mN = $_POST['mN']; $mN = ucfirst($mN);
		$lN = $_POST['lN']; $lN = ucfirst($lN);
		$nEx = $_POST['nEx']; $nEx = ucfirst($nEx);
		$address = $_POST['address']; $address = ucwords($address);
		$year = $_POST['year'];
		$section = $_POST['section'];
		$course = $_POST['course'];

		//select ID # from databa if nag exist
		$sqlCheckID = "SELECT * FROM students WHERE stud_studentID = ? AND stud_id != ?";
		$existID = $db->getRow($sqlCheckID, [$studID, $id]);

		if($existID > 0){
			//that id is naa na
			$message = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> Student ID is Already Used. . .
					</div>';
		}else{
			//continue and save if no error
			if(empty($studID) || $studID == ' '){
				$message = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> Student ID is Required. . .
					</div>';
			}else if(empty($fN) || $fN == ' '){
				$message = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> Enter First Name. . .
					</div>';
			}else if(empty($lN) || $lN == ' '){
				$message = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> Enter Last Name. . .
					</div>';
			}else if(empty($address) || $address == ' '){
				$message = '<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Warning!</strong> Address is Required. . .
					</div>';
			}else{
				//add query here
				$updateStudent = "UPDATE students SET stud_studentID = ?, stud_fName = ?, stud_mName = ?, 
					stud_lName = ?, stud_nEx = ?, stud_address = ?, year_id = ?, sect_id = ?, cour_id = ?
					WHERE stud_id = ?
				";

				$save = $db->insertRow($updateStudent, [$studID, $fN, $mN, $lN, $nEx, $address, $year, $section, $course, $id]) or die(mysql_error());

				$message = '<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> Updated Successfully. . .
					</div>';
			}//end else of if else
		}//end if else of existedID

		
		
	}//end if isset ang id
	echo $message;
 ?>

<?php 
	$db->Disconnect();
 ?>