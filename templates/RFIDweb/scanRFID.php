<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();
	if(isset($_POST['doneScanning'])){
		$rfID = $_POST['scanedID'];//rfID na ge scanned

		$sqlSelectID = "SELECT * FROM students WHERE stud_RFID = ?";
		$sqlResult = $db->getRow($sqlSelectID, [$rfID]);

		if($sqlResult > 0){
			//rfid exist
			$studID = $sqlResult['stud_id'];
		 	$timeNow = date("Y-m-d H:i:s");
			$sqlInsert = "insert into logged_book (stud_id, logb_login)
						values(?, ?);";

			$db->insertRow($sqlInsert, [$studID, $timeNow]);
		}else{
		?>
			<script type="text/javascript">
				alert("ID Not Registered.");
			</script>
		<?php
		}//end else


	}//end if isset
 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>LogIn</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">

		<style type="text/css">
			body {
			    background-color: #000000;
			}
		</style>

		<script type="text/javascript">
			setInterval(function (){
			$('#time').load('time.php').fadeIn("slow");
			}, 1000); // refresh every 10000 milliseconds
		</script>
	</head>
	<body>
		<nav class="navbar navbar-success navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<br />
				<div class="alert alert-info">
					<strong>
					<a class="btn btn-success" href="viewallstudents.php" role="button">Back</a>
					</strong> 
					<center>
						<h1>
								Please hold the tag to log in
						</h1>
						
					</center>
				</div>	
					<div align="center" id="time"></div>
				<ul class="nav navbar-nav">
				</ul>
			</div>
		</nav>
		
<br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br >
<br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br ><br >
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="POST" role="form">
					<input type="text"  name="scanedID" class="form-control" autofocus>
					<button type="submit" class="btn btn-primary" name="doneScanning">Submit</button>
			</form>
		</div>
		<div class="col-md-4"></div>


		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

 		<script type="text/javascript">
 			//disable scroll or freeze
 			window.onscroll = function () {
			window.scrollTo(0,0);
			}
 		</script>
	</body>
</html>

<?php 
$db->Disconnect();
 ?>