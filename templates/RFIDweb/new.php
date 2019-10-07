<?php 
	require_once('config.php');
	require_once('loginSession.php');
	

	$showModal = false;

	if(!isset($_SESSION['loginUserStatus'])){
		header('location: index.php');
	}//end if of session

	$db = new Database();
	
	if(isset($_POST['buttonSave'])){
		// echo 'test';

		$studID = $_POST['studID'];
		$rfID = $_POST['scnId'];
		$fN = $_POST['fN'];
		$mN = $_POST['mN'];
		$lN = $_POST['lN'];
		$nEx = $_POST['nEx'];
		$address = $_POST['address'];
		$course = $_POST['course'];
		$year = $_POST['year'];
		$section = $_POST['section'];

		$fN = ucfirst($fN);
		$mN = ucfirst($mN);
		$lN = ucfirst($lN);
		$nEx = ucfirst($nEx);
		$address = ucwords($address);

		$photoPathLocation = $_SESSION['photoPathLocation'];
		// unset($_SESSION['photoPathLocation']);//destroy session

		if(empty($photoPathLocation)){
			$photoPathLocation = "images/nophoto.png";
		}


		//check first if ID tag already exist
		$searchRFID = "SELECT * FROM students WHERE stud_RFID = ?";

		$searchResultRFID = $db->getRow($searchRFID, [$rfID]);

		if(!$searchResultRFID > 0){

				//check if student ID alaready exist
				$searchStudID = "SELECT * FROM students WHERE stud_studentID = ?";

				$searchResultStudID = $db->getRow($searchStudID, [$studID]);

				if(!$searchResultStudID > 0){
					$insertSQL = "INSERT INTO students (stud_studentID, stud_RFID, stud_fName, stud_mName, stud_lName, 
												stud_nEx, stud_photo, stud_address, year_id, sect_id, cour_id )
								  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);
					";

					$db->Begin();//begin transaction
						$insertToDB = $db->insertRow($insertSQL, [$studID, $rfID, $fN, $mN, $lN, $nEx, $photoPathLocation, $address, $year, $section, $course]);

						//delete ang iyang photo or last captured. kay mao to ang final photo niya
						$deleteSQL = "DELETE FROM trash_photos
									  WHERE trash_location = ?;
									 ";
						$deleteNow = $db->deleteRow($deleteSQL, [$photoPathLocation]);

						$showModal = true;//decision if message will be displayed
						// header('location: new.php');

						//delete all the photos nga naa sa trash_photos then delete
						//e select all sa ang table nga tash_photos
						$selectAllTrashPhotos = "SELECT * FROM trash_photos;";
						$resultTrashPhotos = $db->getRows($selectAllTrashPhotos);

						foreach ($resultTrashPhotos as $p) {
							# code...
							$trashPhoto = $p['trash_location'];
							unlink($trashPhoto);
						}//end foreach of $resultTrashPhotos

						$delAllTrash = "DELETE FROM trash_photos;";
						$db->deleteRow($delAllTrash);
						

					$db->Commit();//execute 
				}else{
					$errorID = "STUDID";//student id exist
				}
			}else{
				// echo 'RFID tag already in used.';
				$errorID = "RFID";
			}

	}//end if of isset buttonSave

 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Student registration</title>


		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">




<script type="text/javascript" src="webcam.js"></script>
    <script>
    	setInterval(function (){
			$('#studentCounts').load('studentCounts.php').fadeIn("slow");
		}, 1000); // refresh every 10000 milliseconds

        webcam.set_api_url( 'upload.php' );
        webcam.set_quality( 90 ); // JPEG quality (1 - 100)
        webcam.set_shutter_sound( true ); // play shutter click sound
        
        webcam.set_hook( 'onComplete', 'my_completion_handler' );
        
        function take_snapshot() {
            // take snapshot and upload to server
            document.getElementById('upload_results').innerHTML = 'Snapshot<br>'+
            '<img src="uploading.gif">';
            webcam.snap();

             $('#scnId').focus();//e focus ang inputbox
             $('.capturedPhoto').show();//hide ang captured photo at first

             $('#buttonTryAgain').click(function(){
				$('#scnId').val("");
				$('.capturedPhoto').hide();

			});

        }
        
        function my_completion_handler(msg) {
            // extract URL out of PHP output
            if (msg.match(/(http\:\/\/\S+)/)) {
                var image_url = RegExp.$1;
                // show JPEG image in page
                document.getElementById('upload_results').innerHTML = 
                    'Snapshot<br>' + 
                    '<a href="'+image_url+'" target"_blank"><img src="' + image_url + '"></a>';
                
                // reset camera for another shot
                webcam.reset();
            }
            else alert("PHP Error: " + msg);
        }

    </script>


<style>

/*hide scroll down and side*/
html { overflow-y: hidden; } 


.main
{
    margin-left: auto;
    margin-right: auto;
    width: 690px;
}
.snap
{
    color: white;
    border-radius: 4px;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    background: rgb(28, 184, 65);
    font-family: inherit;
    font-size: 100%;
    padding: .5em 1em;
    border: 0 hsla(0, 0%, 0%, 0);
    text-decoration: none;
}
.border
{
    border: 3px rgb(28, 184, 65) solid;
    padding: 5px;
    width: 320px;
    height: 258px;
}

.liveWebCam { 
	float: left;
	position: relative;
 } 
.capturedPhoto { 
	position: absolute;
	top: 0;  
} 
</style>

	</head>

<?php if($showModal == true){ ?>
  <script type="text/javascript">
  	alert("Record Added Successfully!");
  	window.location.assign("new.php");//header location
  </script>
<?php 
	// header('location: new.php');
?>
<?php
	} 
?>

<div class="modal fade" id="modalMessageSuccess">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>

	<body>

		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="viewallstudents.php">Students</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li>
							<a href="viewallstudents.php">View All Students
								<span class="glyphicon glyphicon-list" aria-hidden="true"></span>
							</a>
						</li>
						<li class="active"><a href="#"> 
								New
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="scanRFID.php"> 
								LogIn
								<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="reports.php"> 
								Reports
								<span class="glyphicon glyphicon-file" aria-hidden="true"></span>
							</a>
						</li>
					</ul>
					
					<ul class="nav navbar-nav navbar-right">
						<li id="studentCounts"></li>
						<li><a href="logout.php">Logout
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
							</a>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>

		<div class="container-fluid">
			<?php 
				if(isset($errorID)){
					if($errorID == 'RFID'){
						echo '
						 <div class="alert alert-danger">
						 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 	<strong>Note:</strong> RFID tag already in used.
						 </div>
						';
					}else{
						echo '
						 <div class="alert alert-danger">
						 	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 	<strong>Note:</strong> Student ID is already in used.
						 </div>
						';
					}
					// unset($errorID);//ge transfer naku sa ubos ang unset para ma apil ang inputbox og gamit sa variable before e unset
				}

			 ?>

			<div class="row">
				<div class="col-md-8">
					<div class="well well-lg">
						<legend>Student's Information</legend>
						<div class="row">
							<div class="col-md-5">
							 <form action="" method="post">
								<div class="form-group">
								  <label for="studID">1. Student ID:</label>
								  <input type="number" class="form-control" id="studID" name="studID" required
								  	<?php 
								  		if(isset($errorID)){
								  			if($errorID == 'RFID'){
								  				echo "value = '$studID'";
								  			}//inner if
								  		}else{
								  			echo 'autofocus';
								  		}
								  	 ?>
								  >
								</div>
								<div class="form-group">
								  <label for="fN">2. First Name:</label>
								  <input type="text" class="form-control" id="fN" name="fN" required
								  	<?php 
								  		if(isset($_POST['buttonSave'])){
								  			echo "value = '$fN'";
								  		}
								  	 ?>
								  >
								</div>
								<div class="form-group">
								  <label for="mN">3. Middle Name:</label>
								  <input type="text" class="form-control" id="mN" name="mN"
								  	<?php 
								  		if(isset($_POST['buttonSave'])){
								  			echo "value = '$mN'";
								  		}
								  	 ?>
								  >
								</div>
								<div class="form-group">
								  <label for="lN">4. Last Name:</label>
								  <input type="text" class="form-control" id="lN" name="lN" required
								  	<?php 
								  		if(isset($_POST['buttonSave'])){
								  			echo "value = '$lN'";
								  		}
								  	 ?>
								  >
								</div>
								<div class="form-group">
								  <label for="nEx">5. Name Extension:</label>
								  <input type="text" class="form-control" id="nEx" name="nEx" placeholder="Jr., 2nd,  3rd"
								  	<?php 
								  		if(isset($_POST['buttonSave'])){
								  			echo "value = '$nEx'";
								  		}
								  	 ?>
								  >
								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
								  <label for="addrs">6. Address:</label>
								  <input type="text" class="form-control" id="address" name="address" required
								  	<?php 
								  		if(isset($_POST['buttonSave'])){
								  			echo "value = '$address'";
								  		}
								  	 ?>
								  >
								</div>
								<div class="row">
									<div class="col-md-7">
									<div class="form-group">
										  <label for="cour">7. Course / Position:</label>
										  <select class="btn-lg" name="course">
										  	<?php 
										  		include_once('include php files/getCourses.php');
										  		foreach ($getCourseResult as $cour) {
										  			# code...
										  			$courID = $cour['cour_id'];
										  			$courDesc = $cour['cour_description'];
												?>
													<option value="<?php echo $courID; ?>"
														<?php if(isset($_POST['buttonSave'])){ echo 'selected';} ?>
														><?php echo $courDesc; ?></option>
												<?php										  			
										  		}//end foreach loop
										  	 ?>
										  </select>
										</div>
										<div class="form-group">
										  <label for="yearSec">8. Year & Section:</label>
										  <br />
											<select class="btn-lg" name="year">
											 	<?php 
											  		include_once('include php files/getYear.php');
											  		foreach ($getYearResult as $year) {
											  			# code...
											  			$yearID = $year['year_id'];
											  			$yearDesc = $year['year_description'];
													?>
														<option value="<?php echo $yearID; ?>"
															<?php if(isset($_POST['buttonSave'])){ echo 'selected';} ?>
															><?php echo $yearDesc; ?></option>
													<?php										  			
											  		}//end foreach loop
											  	 ?>
											</select>
											<select class="btn-lg" name="section">
											 	 <?php 
											  		include_once('include php files/getSection.php');
											  		foreach ($getSectionResult as $section) {
											  			# code...
											  			$sectionID = $section['sect_id'];
											  			$sectionDesc = $section['sect_description'];
													?>
														<option value="<?php echo $sectionID; ?>"
															<?php if(isset($_POST['buttonSave'])){ echo 'selected';} ?>
															><?php echo $sectionDesc; ?></option>
													<?php										  			
											  		}//end foreach loop
											  	 ?>
											</select>
										</div>
									</div>
									<div class="col-md-5"></div>
								</div>
							</div>
								
						</div>
					</div>
				</div>

				<div class="col-md-4">
			            <div class="liveWebCam" valign="top">
				            <div class="border" id="liveWebCamText">
			                Snapshot<br>
			                <script>
			                document.write( webcam.get_html(300, 220) );
			                </script>
			                </div>
			                <br/><button type="button" class="btn btn-success btn-sm" onClick="take_snapshot()">
			                	CAPTURE
			    				&nbsp;
			                	<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			                </button>

			            </div>
			            <div hidden class="capturedPhoto" valign="top">
			                <div id="upload_results" class="border">
			                    Snapshot<br>
			                    <img src="logo.jpg" width="300" height="220" />
			                </div>
			                	<br/>
			    				<button type="button" class="btn btn-sm btn-danger" id="buttonTryAgain">TRY AGAIN
			    				&nbsp;
			    					<span class="glyphicon glyphicon-camera" aria-hidden="true"></span>
			    				</button>
			            </div>

					    <br /><br /><br /><br /><br /><br />
					    <br /><br /><br /><br /><br /><br />
					    <br /><br /><br /><br />
			            <div class="alert alert-danger">
			            	<strong>Note:</strong> Please scan the ID after taking photo otherwise the data would not be save.
			            </div>
					    <br /><br /><br /><br /><br /><br />
					    <br /><br /><br /><br /><br /><br />
					    <br /><br /><br /><br /><br /><br />
					    <br /><br />
					    
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="well well-sm">
									<div class="form-group">
									  <label for="scnId">10. Scan ID:</label>
									  <input type="number" class="form-control" id="scnId" name="scnId"
									  	<?php 
									  		if(isset($errorID)){
									  			if($errorID == 'RFID'){
									  				echo 'autofocus';
									  			}
									  		}
									  		unset($errorID);
									  	 ?>
									  >
									</div>
									<button class="btn btn-success " type="submit" id="buttonSave" name="buttonSave">
								  		save
								    </button>
						   </form>
								</div>
							</div>
							<div class="col-md-6"></div>
						</div>
					</div>
				</div>


			</div>
		</div>

 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

 		<script type="text/javascript">

 			//disable scroll or freeze
 			window.onscroll = function () {
			window.scrollTo(0,0);
			}

			// $('#buttonSave').click(function(){
				// var rfid = $('#scnId').val();
				// alert(rfid);
		        // $('#modalMessageSuccess').modal('show');
			// });
		
			//if buttonSearch is click
			$('#buttonSearch').click(function(){
				alert("under construction pa");
			});

 		</script>
	</body>
</html>

<?php 
	$db->Disconnect();//close connection
 ?>