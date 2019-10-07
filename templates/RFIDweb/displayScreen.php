<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
 	$db = new Database();

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
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme-min.css">

		<style type="text/css">
			.banner {
			    /*background-color: #07DB1F;*/
			}
		</style>


<script type="text/javascript">
	setInterval(function (){
	$('#time').load('time.php').fadeIn("slow");
	}, 1000); // refresh every 10000 milliseconds


	setInterval(function (){
		$('#photos').load('reloadphotos.php').fadeIn("slow");
	}, 1000); // refresh every 10000 milliseconds

</script>

	</head>
	<body class="bg-primary">
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2" align="left">
					<img src="images/logo.png" width="250" height="180">
				</div>
				<div class="col-md-10" align="center">
					<h1>Gingoog City Colleges</h1>
					<h4>Paz Village Subd Gingoog City, Brgy 24-A</h4>
					<div id="time">
					 </div>
				</div>
			</div>

			<div id="photos" class="row container-fluid">
				
			</div>
			<!-- end row -->
		</div>


		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>

 		<script type="text/javascript">
			// setTimeout(function(){
			//    window.location.reload(1);
			// }, 1000);
		</script>

	</body>
</html>