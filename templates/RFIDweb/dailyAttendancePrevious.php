<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();

	if(!isset($_SESSION['loginUserStatus'])){
		header('location: index.php');
	}

	$dateNow = date("Y-m-d");
	//count ang total number sa ni login karong adlawa
	//then e butang og session para makahibaw ko kung pila ang max.
	$sql = "SELECT COUNT(*) as totalLogin FROM logged_book WHERE date(logb_login) = ?";
	$res = $db->getRow($sql, [$dateNow]);
	// echo "<pre>";
	// echo print_r($res);
	// echo "</pre>";
 	$_SESSION['totalLoginNow'] = $res['totalLogin'];//see code dailyAttendance.php line 81
 	// unset($_SESSION['totalLoginNow']);

 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Student Login System</title>


		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">


			 <!--pagination-->
	    <link rel="stylesheet" href="bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->

 <script type="text/javascript">
	setInterval(function (){
	$('#studentCounts').load('studentCounts.php').fadeIn("slow");
	}, 1000); // refresh every 10000 milliseconds

</script>

	</head>

	<body onload="currentDate()">

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
						<li><a href="new.php"> 
								New
								<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
							</a>
						</li>
						<li><a href="scanRFID.php"> 
								LogIn
								<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
							</a>
						</li>
						<li  class="active"><a href="reports.php"> 
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

		<div>
			<span class="input-group-btn" align="center">
				<a href="reports.php" class="btn btn-info">Daily Attendance</a>
				<a href="dailyAttendancePrevious.php" class="btn btn-warning">Daily Attendance Records</a>
				<!-- <a href="dailyAttendanceReportByEntireMonth.php" class="btn btn-danger">Daily Attendance Report by entire month</a> -->
				<a href="monthlyAttendanceReport.php" class="btn btn-primary">Monthly Attendance Report</a>
			</span>	

			<br />
				<!--main  -->
				<div class="container">
					<div class="row">
						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title">Daily Attendance of
									<input type="date" class="btn-xs" id="datePick" value="<?php echo date('Y-m-d'); ?>" onchange="datePick()"/>
								</h3>
							</div>
							<div class="panel-body">
								<div id="display"></div>
							</div>
						</div>
					</div>
				</div>

		</div><!-- container end -->


 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>
 			 <!--pagination-->
	    <script src="bootstrap/js/jquery.dataTables2.js"></script>

	    <script type="text/javascript">
	    	function datePick(){
	    		// alert("allright");
	    		var datePick = $('#datePick').val();
	    		$.ajax({
	    			type: "GET",
	    			url: "getDailyAttendancePrevious.php?datePick="+datePick
	    		}).done(function(data){
	    			$('#display').html(data);
	    		});
	    	}//end viewPrevious

	    	function currentDate(){
	    		var currentDate = '<?php echo date('Y-m-d'); ?>';
	    		// alert(currentDate);
	    		$.ajax({
	    			type: "GET",
	    			url: "getDailyAttendancePrevious.php?datePick="+currentDate
	    		}).done(function(data){
	    			$('#display').html(data);
	    		});
	    	}//end currentDate


	    </script>

	</body>
</html>	