<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();
 ?>
	<div class="container">
			<table id="myTable" class="table table-striped" >  
					<thead>
						<th>ID #</th>
						<th>Name</th>
						<th>Address</th>
						<th>Course</th>
						<th><center>Year & Section</center></th>
						<th><center>Action</center></th>
					</thead>
					<tbody>
						<?php 
							$searchAllStudentsSQL = "
											SELECT *
											FROM students s
											INNER JOIN course c
											ON s.cour_id = c.cour_id
											INNER JOIN year y
											ON y.year_id = s.year_id
											INNER JOIN section sec
											ON sec.sect_id = s.sect_id
											ORDER by s.stud_fName;
							";
						 	$resultAllStudents = $db->getRows($searchAllStudentsSQL);
						 	
						 // 	echo '<3>';
							// echo print_r($resultAllStudents);
							// echo '</pre>';
						 	foreach ($resultAllStudents as $r) {
						 		# code...

						 		$id = $r['stud_id'];//student ID sa database
						 		$studID = $r['stud_studentID'];
						 		$rfID = $r['stud_RFID'];
						 		$fN = $r['stud_fName'];
						 		$mN = $r['stud_mName'];
						 		$lM = $r['stud_lName'];
						 		$nEx = $r['stud_nEx'];
						 		$photo = $r['stud_photo'];
						 		$address = $r['stud_address'];
						 		$year =  $r['year_id'];
						 		$yearDesc =  $r['year_description'];
						 		if($yearDesc == "None"){$yearDesc = " ";}
						 		$section =  $r['sect_id'];
						 		$sectionDesc =  $r['sect_description'];
						 		if($sectionDesc == "None"){$sectionDesc = " ";}
						 		$courseDesc = $r['cour_description'];
						 		$stud_courID = $r['cour_id'];

						 		$yearSec = "$year-$section";

						 		$fullName = "$fN $mN $lM $nEx";
						 	?>
						 		<tr>
						 			<td><?php echo $studID; ?></td>
						 			<td><?php echo $fullName; ?></td>
						 			<td><?php echo $address; ?></td>
						 			<td><?php echo $courseDesc; ?></td>
						 			<td align="center"><?php echo "$yearDesc-$sectionDesc"; ?></td>
						 			<td align="center">
						 				<button class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModalChangeID<?php echo $id; ?>" onclick="focusChangeID('<?php echo $id; ?>')">
						 					Change ID
						 					<span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
						 				</button>
						 				<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal<?php echo $id; ?>" onclick="updateData('<?php echo $id; ?>')">Update
						 					<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
						 				</button>
						 				<button class="btn btn-danger btn-xs"  onclick="deletedata('<?php echo $id; ?>', '<?php echo $photo; ?>')" >
						 					Delete
						 					<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
						 				</button>

						 				<!-- modal update -->
						 				<div align="left" class="modal fade" id="myModal<?php echo $id; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title">Update Student</h4>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																  <label for="studID<?php echo $id; ?>">Student ID:</label>
																  <input type="text" class="form-control" id="studID<?php echo $id; ?>" value="<?php echo $studID; ?>">
																</div>
																<div class="form-group">
																  <label for="fN<?php echo $id; ?>">First Name:</label>
																  <input type="text" class="form-control" id="fN<?php echo $id; ?>" value="<?php echo $fN; ?>">
																</div>
																<div class="form-group">
																  <label for="mN<?php echo $id; ?>">Middle Name:</label>
																  <input type="text" class="form-control" id="mN<?php echo $id; ?>" value="<?php echo $mN; ?>">
																</div>
																<div class="form-group">
																  <label for="lN<?php echo $id; ?>">Last Name:</label>
																  <input type="text" class="form-control" id="lN<?php echo $id; ?>" value="<?php echo $lM ; ?>">
																</div>
																<div class="form-group">
																  <label for="nEx<?php echo $id; ?>">Name Extension:</label>
																  <input type="text" class="form-control" id="nEx<?php echo $id; ?>" placeholder="Jr., 2nd, 3rd" value="<?php echo $nEx; ?>">
																</div>
															</div>
															<div class="col-md-8">
																<br /><br />
																<div class="well well-lg" align="center">
																<img src="<?php echo $photo; ?>" class="img-responsive" alt="Image">
																<?php echo "location: $photo"; ?>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-5">
																
																
																
																<div class="row">
																	<div class="col-md-8">
																		
																	</div>
																	<div class="col-md-4"></div>
																</div>
															</div>
															<div class="col-md-7"></div>
														</div>
														<div class="row container-fluid">
																<div class="form-group">
																  <label for="address<?php echo $id; ?>">Address:</label>
																  <input type="text" class="form-control" id="address<?php echo $id; ?>" value="<?php echo $address; ?>">
																</div>
														</div>
														<div class="row">
															<div class="col-md-4">
																 <label for="course<?php echo $id; ?>">Course:</label>
																<select id="course<?php echo $id; ?>" class="form-control" required="required">
																	<?php 
																	 require_once('include php files/getCourses.php');
																		foreach ($getCourseResult as $course) {
																			$courID = $course['cour_id'];
																			$courDescription = $course['cour_description'];
																	?>
																			<option value="<?php echo $courID; ?>"
																				<?php if($courID == $stud_courID){echo 'selected';} ?>
																				><?php echo $courDescription; ?></option>
																	<?php
																		}//end foreach
																	 ?>
																</select>
															</div>
															<div class="col-md-3">
																<label for="year<?php echo $id; ?>">Year:</label>
																<select id="year<?php echo $id; ?>" class="form-control" required="required">
																	<?php 
																	 require_once('include php files/getYear.php');
																	 foreach ($getYearResult as $y) {
																	 	$yID = $y['year_id'];
																	 	$yDesc = $y['year_description'];
																	 ?>
																	 	<option value="<?php echo $yID; ?>"
																	 		<?php if($yID == $year){ echo 'selected'; } ?>
																	 		><?php echo $yDesc; ?></option>
																	 <?php
																	 }//end for each		
																	?>
																</select>
															</div>
															<div class="col-md-2">
																<label for="section<?php echo $id; ?>">section:</label>
																<select id="section<?php echo $id; ?>" class="form-control" required="required">
																	<?php 
																	 require_once('include php files/getSection.php');
																	 foreach ($getSectionResult as $s) {
																	 	$sID = $s['sect_id'];
																	 	$sDesc = $s['sect_description'];
																	 ?>
																	 	<option value="<?php echo $sID; ?>"
																	 		<?php if($sID == $section){ echo 'selected'; } ?>
																	 		><?php echo $sDesc; ?></option>
																	 <?php
																	 }//end for each		
																	?>
																</select>
															</div>
															<div class="col-md-5">
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close
															<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
														</button>
														<button type="button" data-dismiss="modal" onclick="updatedata('<?php echo $id; ?>')" class="btn btn-success">Save changes
															<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
														</button>
														<script type="text/javascript">
															$('#myModal<?php echo $id; ?>').appendTo("body");
														</script>
													</div>
												</div>
											</div>
										</div>
										<!-- end modal update -->

										<!-- modal change id -->
										<div align="left" id="myModalChangeID<?php echo $id; ?>" class="modal fade" role="dialog">
										  <div class="modal-dialog">

										    <!-- Modal content-->
										    <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title text-danger"><strong>Scan ID</strong></h4>
										      </div>
										      <div class="modal-body">
										        <p class="text-danger"><b>Are you sure you want to change the ID of &nbsp;</b><kbd><?php echo $fullName; ?></kbd>&nbsp;<b>?</b></p>
										     
										        <input type="text" id="newRFID<?php echo $id; ?>"  class="form-control" autofocus>
										        <br />
										        <button type="button" data-dismiss="modal" id="buttonNewRFID<?php echo $id; ?>" onclick="changeRFID('<?php echo $id; ?>')" class="btn btn-info btn-sm">Save Changes
										        	<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
										        </button>
								       			<script type="text/javascript">
													$('#myModalChangeID<?php echo $id; ?>').appendTo("body");
												</script>
										      </div>
										      <div class="modal-footer">
										   
										      </div>
										    </div>

										  </div>
									   </div>
									   <!-- end modal change ID -->
						 			</td>
						 		</tr>
						 	<?php
						 	}//end foreach loop
						 ?>
					</tbody>
				</table>
		</div>



<script type="text/javascript">
	//script for pagination
	$(document).ready(function(){
	    $('#myTable').dataTable();
	});

	//focus on search box
	$('div.dataTables_filter input').focus();

</script>
