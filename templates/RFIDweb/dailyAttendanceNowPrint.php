<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();
	$fNum = new FormatNumber();

	include_once('include php files/includePrint.php');

 ?>

<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme-min.css">


			 <!--pagination-->
	    <link rel="stylesheet" href="bootstrap/css/jquery.dataTables.css"><!--searh box positioning-->


	</head>

	<body>

<div class="container">	
	<br />
	<div class="row">
		<div class="panel panel-info">
			<div class="panel-heading" style="font:bold 20px 'Aleo';">
			<center> Gingoog City Colleges</center>
			<center>Paz Village Subd Gingoog City, Brgy 24-A</center>
			<center> Students Report</center>
				<h3 align="center"class="panel-title" style="font:bold 30px 'Aleo';">Daily Attendance of
					<?php  
						if(isset($_GET['datePick'])){
							echo $_GET['datePick'];
						}else{
							echo date('M d, Y');
						}
					?>
				</h3>
			</div>
			<div class="panel-body">
				<table id="myTable" class="table table-striped" >  
					<thead>
						<th>Category</th>
						<?php 
							for($i = 8; $i < 13; $i++){
								echo "<th>$i:00</th>";
							}

							for($i = 1; $i < 10; $i++){
								echo "<th>$i:00</th>";
							}
						 ?>
						 <th><center>Sub Total</center></th>
					</thead>
					<tbody>
						<?php 
							//query category
							$sql = "SELECT * FROM course;";
							$res = $db->getRows($sql);
							// echo "<pre>";
							// echo print_r($res);
							// echo "</pre>";

							$overAllCount = 0;//over all total
							//loop row
							$booleanGreen = false;//pag activate sa ! nga green

							foreach ($res as $r) {
								# code...
								$cat  = $r['cour_description'];
								$catID  = $r['cour_id'];

								echo "<tr>";
									echo "<td>$cat</td>";

									$dateNow = date("Y-m-d");
									if(isset($_GET['datePick'])){
										$datePick = $_GET['datePick'];
										$dateNow = $datePick;
									}

									//query time 8 to 12;
									$count = 0;//count para sa ni login ana nga time
									for($i = 8; $i < 13; $i++){
										$first = "$dateNow $i";
										$second = "$dateNow $i:59:59";
										// $sql = "SELECT COUNT(*) as loginCount FROM logged_book
										// 		WHERE date(`logb_login`) LIKE ? AND time(`logb_login`) >= ? AND time(`logb_login`) < ?; 
										// 		";

										$sql = "SELECT COUNT(*) as loginCount 
												FROM logged_book lb 
												INNER JOIN students s 
												ON s.stud_id = lb.stud_id
												INNER JOIN course c 
												ON c.cour_id = s.cour_id
												WHERE s.cour_id = ? 
												AND logb_login BETWEEN ? AND ?;  
												";
										$res = $db->getRow($sql, [$catID, $first, $second]);
										// echo "<pre>";
										// 	echo print_r($res);
										// echo "</pre>";
										$logCount = $res['loginCount'];
										$count += $logCount;//sub total
										$logCount = $fNum->putComma($logCount);
										$count = $fNum->putComma($count);

										if($logCount != 0){
											//check if the totalLoginCount change and compare sa session
											$sql = "SELECT COUNT(*) as loginCountNow FROM logged_book 
													WHERE date(logb_login) = ?";
											$res = $db->getRow($sql, [$dateNow]);
											$loginCountNow = $res['loginCountNow'];//new query sa total log in count now
											
											//query the current row's cour_id para mai compare sa catID/courID if mo
											//true gani e print and glyphicon
											$sql = "SELECT c.cour_id, DATE_FORMAT(time(logb_login),'%k') as hourLog
													FROM logged_book lb
													INNER JOIN students s
													ON s.stud_id = lb.stud_id
													INNER JOIN course c 
													ON c.cour_id = s.cour_id
													ORDER BY lb.logb_id DESC LIMIT 1
													";
											$rsql = $db->getRow($sql);
											$courIDrsql = $rsql['cour_id'];
											$hourLog = $rsql['hourLog'];

											//compare the session and the new login count query
											if($loginCountNow == $_SESSION['totalLoginNow']){
												//no changes = no login
												echo "<td>$logCount</td>";//print ang ni login 
											}else{
												//naay changes
												if($catID == $courIDrsql && $i == $hourLog){
													$_SESSION['totalLoginNow'] = $loginCountNow;//reassign	
													echo "<td>$logCount 
													<span style='color:green' class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													</td>";//print ang ni login
												}else{
													echo "<td>$logCount</td>";//print ang ni login 
												} 
											}//end if else of loginCountNow == $session

										}else{
											echo "<td></td>";
										}
									}//for 8 - 13

									//query time alas 1 to 9 13=1 and so on
									for($i = 13; $i < 22; $i++){
										$first = "$dateNow $i";
										$second = "$dateNow $i:59:59";

										$sql = "SELECT COUNT(*) as loginCount 
												FROM logged_book lb 
												INNER JOIN students s 
												ON s.stud_id = lb.stud_id
												INNER JOIN course c 
												ON c.cour_id = s.cour_id
												WHERE s.cour_id = ? 
												AND logb_login BETWEEN ? AND ?;  
												";
										$res = $db->getRow($sql, [$catID, $first, $second]);
										// echo "<pre>";<span style='color:green' class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
										// 	echo print_r($res);
										// echo "</pre>";
										$logCount = $res['loginCount'];
										$count += $logCount;
										$logCount = $fNum->putComma($logCount);
										$count = $fNum->putComma($count);
										
										if($logCount != 0){
											//check if the totalLoginCount change and compare sa session
											$sql = "SELECT COUNT(*) as loginCountNow FROM logged_book 
													WHERE date(logb_login) = ?";
											$res = $db->getRow($sql, [$dateNow]);
											$loginCountNow = $res['loginCountNow'];//new query sa total log in count now
											
											//query the current row's cour_id para mai compare sa catID/courID if mo
											//true gani e print and glyphicon
											$sql = "SELECT c.cour_id, DATE_FORMAT(time(logb_login),'%k') as hourLog
													FROM logged_book lb
													INNER JOIN students s
													ON s.stud_id = lb.stud_id
													INNER JOIN course c 
													ON c.cour_id = s.cour_id
													ORDER BY lb.logb_id DESC LIMIT 1
													";
											$rsql = $db->getRow($sql);
											$courIDrsql = $rsql['cour_id'];
											$hourLog = $rsql['hourLog'];

											//compare the session and the new login count query
											if($loginCountNow == $_SESSION['totalLoginNow']){
												//no changes = no login
												echo "<td>$logCount</td>";//print ang ni login 
											}else{
												//naay changes
												if($catID == $courIDrsql && $i == $hourLog){
													$_SESSION['totalLoginNow'] = $loginCountNow;//reassign	
													echo "<td>$logCount 
													<span style='color:green' class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
													</td>";//print ang ni login
												}else{
													echo "<td>$logCount</td>";//print ang ni login 
												} 
											}//end if else of loginCountNow == $session

										}else{
											echo "<td></td>";
										}
									}//for 1 - 10

									echo "<td align='right'>$count</td>";
								echo "</tr>";
								$overAllCount += $count;//over all total
								$overAllCount = $fNum->putComma($overAllCount);
							}//end foreach
						 ?>
<tr>
						 	<td></td>
					 	 	<?php 
						 		for($i = 8; $i < 13; $i++){
									$first = "$dateNow $i";
									$second = "$dateNow $i:59:59";
									$sql = "SELECT COUNT(*) as countPerHour
											FROM logged_book lb
											INNER JOIN students s
											ON s.stud_id = lb.stud_id
											INNER JOIN course c
											ON c.cour_id = s.cour_id
											WHERE lb.logb_login BETWEEN ? AND ?";
									$perHour = $db->getRow($sql,[$first, $second]);
								?>
									<td><?= $perHour['countPerHour']; ?></td>
								<?php
								}

								for($i = 13; $i < 22; $i++){
									$first = "$dateNow $i";
									$second = "$dateNow $i:59:59";
									$sql = "SELECT COUNT(*) as countPerHour
											FROM logged_book lb
											INNER JOIN students s
											ON s.stud_id = lb.stud_id
											INNER JOIN course c
											ON c.cour_id = s.cour_id
											WHERE lb.logb_login BETWEEN ? AND ?";
									$perHour = $db->getRow($sql,[$first, $second]);
								?>	
									<td><?= $perHour['countPerHour']; ?></td>
								<?php
								}
						 	 ?>
						 	<td align="center"><strong>TOTAL: <?php echo $overAllCount; ?> </strong></td>
						 </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end row -->
</div>



 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>
 		<script src="bootstrap/js/bootstrap.js"></script>
 			 <!--pagination-->
	    <script src="bootstrap/js/jquery.dataTables2.js"></script>

	</body>
</html>	