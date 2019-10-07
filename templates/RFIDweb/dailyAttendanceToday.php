<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();

 ?>
<div class="container">	
	<br />
	<div class="row">
		<div class="col-md-6">
			<!-- daily attendance blue -->
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Daily Attendance</h3>
				</div>
				<div class="panel-body">
					<table id="myTable" class="table table-striped" >  
						<thead>
							<th>Category</th>
							<th>Time</th>
							<th>Count's</th>
							<th>Daily Total</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Monthly Attendance</h3>
					</div>
					<div class="panel-body">
						<table id="myTable" class="table table-striped" >  
							<thead>
								<th>Category</th>
								<th>Month</th>
								<th>Count's</th>
								<th>Monthly Total</th>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
		</div>
		<!-- end 2nd col md -->
	</div>
	<!-- end row -->
</div>

