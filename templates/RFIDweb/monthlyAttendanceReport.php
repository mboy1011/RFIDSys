<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();

	if(!isset($_SESSION['loginUserStatus'])){
		header('location: index.php');
	}//go to login


 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login System</title>


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

	<body onload="currentYear()">

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
						<div class="panel panel-info">
							<div class="panel-heading">
								<?php 
									$sql = "SELECT DISTINCT DATE_FORMAT(`logb_login`, '%Y') as year FROM logged_book";
								 	$res = $db->getRows($sql);
								 ?>
								<h3 class="panel-title">Monthly Attendance Report of 2019
									
								</h3>
							</div>
							<div class="panel-body">

									<div class="pull-right">
										<button type="button"  id="print" class="btn btn-success btn-xs"
											
											>Print Report
												<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
										</button>
									</div>

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
	    	function yearPick(){
	    		// alert("allright");
	    		var yearPick = $('#yearPick').val();
	    		$.ajax({
	    			type: "GET",
	    			url: "getMonthlyAttendanceReport.php?yearPick="+yearPick
	    		}).done(function(data){
	    			$('#display').html(data);
	    		});


	    	}//end viewPrevious

	    	function currentYear(){
	    		var currentYear = '<?php echo date('Y'); ?>';
	    		// alert(currentYear);
	    		$.ajax({
	    			type: "GET",
	    			url: "getMonthlyAttendanceReport.php?currentYear="+currentYear
	    		}).done(function(data){
	    			$('#display').html(data);
	    		});
	    	}//end currentYear

	    	// target="popup" onclick="window.open('monthlyAttendanceReportPrint.php','name','width=auto,height=auto')"
	    	$(document).ready(function(){
	    		$('#print').click(function(){

	    			var yearPick = $('#yearPick').val();
	    			var url = 'monthlyAttendanceReportPrint.php?yearPick='+yearPick;

	    			window.open(url, 'windowName', "height=500,width=700");
	    		});
	    	});
	    </script>

	</body>
</html>	
<?php 
$db->Disconnect();
 ?>