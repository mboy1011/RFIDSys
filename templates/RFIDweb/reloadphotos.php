<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
 	$db = new Database();

 ?>
<div class="col-md-6" align="center">
					<!-- main picture -->
							<?php 
								$sql = "SELECT * FROM 
										logged_book lb 
										INNER JOIN students s
										ON s.stud_id = lb.stud_id
										INNER JOIN year y
										ON y.year_id = s.year_id
										INNER JOIN section st
										ON st.sect_id = s.sect_id
										INNER JOIN course c 
										ON c.cour_id = s.cour_id
										ORDER BY logb_id DESC LIMIT 1"
										;
								$res = $db->getRow($sql);
								// echo '<pre>';
								// echo print_r($res);
								// echo '</pre>';

								//var
								$fN = $res['stud_fName'];
								$mN = $res['stud_mName'];
								$lN = $res['stud_lName'];
								$nEx = $res['stud_nEx'];

								if(empty($mN)){
									$fullName = "$lN, $fN $nEx";//full name
								}else{
									$fullName = "$lN, $fN $mN[0]. $nEx";//full name
								}


								$studID = $res['stud_studentID'];//student ID #

								$course = $res['cour_description'];
								$year = $res['year_description'];
								if($year == "None"){$year = " ";}
								$sect = $res['sect_description'];
								if($sect == "None"){$sect = " ";}

								$photo = $res['stud_photo'];

							 ?>
					<img src="<?php echo $photo; ?>" class="img-thumbnail" alt="Cinque Terre" width="380" height="300">
						<div class="row bg-primary">

							<!-- description main -->
							<h4>
								<?php echo $fullName; ?>
							</h4>
							<h4>
								<?php echo $studID; ?>  &nbsp;&nbsp;&nbsp;<?php echo "$course $year - $sect"; ?>
							</h4>
						</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<!-- sub 2 picture -->
						<div class="col-md-6">
							<!-- sub1 -->
							<?php 
								$sql = "SELECT * FROM 
										logged_book lb 
										INNER JOIN students s
										ON s.stud_id = lb.stud_id
										INNER JOIN year y
										ON y.year_id = s.year_id
										INNER JOIN section st
										ON st.sect_id = s.sect_id
										INNER JOIN course c 
										ON c.cour_id = s.cour_id
										ORDER BY logb_id DESC LIMIT 1,1"
										;
								$res = $db->getRow($sql);
								// echo '<pre>';
								// echo print_r($res);
								// echo '</pre>';

								//var
								$fN = $res['stud_fName'];
								$mN = $res['stud_mName'];
								$lN = $res['stud_lName'];
								$nEx = $res['stud_nEx'];

								$fullName = "$lN, $fN $mN[0]. $nEx";//full name

								$studID = $res['stud_studentID'];//student ID #

								$course = $res['cour_description'];
								$year = $res['year_description'];
								$sect = $res['sect_description'];

								$photo = $res['stud_photo'];

							 ?>
							<img src="<?php echo $photo; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
							<div class="row bg-primary" align="center">
								<!-- description main -->
								<h5>
									<?php echo $fullName; ?> 
								</h5>
								<h5>
									<?php echo $studID; ?>  &nbsp;&nbsp;&nbsp;<?php echo "$course $year - $sect"; ?>
								</h5>
							</div>
						</div>
						<div class="col-md-6">
							<!-- sub2 -->
							<?php 
								$sql = "SELECT * FROM 
										logged_book lb 
										INNER JOIN students s
										ON s.stud_id = lb.stud_id
										INNER JOIN year y
										ON y.year_id = s.year_id
										INNER JOIN section st
										ON st.sect_id = s.sect_id
										INNER JOIN course c 
										ON c.cour_id = s.cour_id
										ORDER BY logb_id DESC LIMIT 1 OFFSET 2"
										;
								$res = $db->getRow($sql);
								// echo '<pre>';
								// echo print_r($res);
								// echo '</pre>';

								//var
								$fN = $res['stud_fName'];
								$mN = $res['stud_mName'];
								$lN = $res['stud_lName'];
								$nEx = $res['stud_nEx'];

								$fullName = "$lN, $fN $mN[0]. $nEx";//full name

								$studID = $res['stud_studentID'];//student ID #

								$course = $res['cour_description'];
								$year = $res['year_description'];
								$sect = $res['sect_description'];

								$photo = $res['stud_photo'];

							 ?>
							<img src="<?php echo $photo; ?>" class="img-thumbnail" alt="Cinque Terre" width="304" height="236">
							<div class="row bg-primary" align="center">
								<!-- description main -->
								<h5>
									<?php echo $fullName; ?> 
								</h5>
								<h5>
									<?php echo $studID; ?>  &nbsp;&nbsp;&nbsp;<?php echo "$course $year - $sect"; ?>
								</h5>
							</div>
						</div>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						<br /><br />
					</div>
				</div>