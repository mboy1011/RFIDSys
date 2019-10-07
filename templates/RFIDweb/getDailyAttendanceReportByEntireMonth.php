<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();


	if(isset($_GET['date'])){
		$date = $_GET['date'];


		if(empty($date)){
			echo '<strong class="text-danger">Please Select Date.</strong>';
		}else{
			

			$dateBreak = explode('-', $date);

			$month = $dateBreak[1];
			$year = $dateBreak[0];

			$numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
			


			//select all course
			$sql = "SELECT * FROM course";
			$resultCourse = $db->getRows($sql);

	?>
			<table id="myTable" class="table table-striped" >  
				<thead>
					<th>Days</th>
				<?php 
					for($i = 1; $i <= $numberOfDaysInMonth; $i++){
						echo "<th>$i</th>";
					}
				 ?>
				</thead>
				<tbody>
					<tr>
						<th>Total</th>
				<?php 
						//loop days of month
						for ($day = 1; $day <=  $numberOfDaysInMonth; $day++) { 
							# code...
							$sql = 'SELECT COUNT(*) AS monthCount FROM logged_book WHERE DATE(`logb_login`) = ?';

							$dateFind = $year.'-'.$month.'-'.$day;
							$res = $db->getRow($sql, [$dateFind]);

							echo '<td>';
								echo $res['monthCount'];
							echo '</td>';
							// printQuery($res);
							
						}//end for of days of month
				 ?>
					</tr>
				</tbody>
			</table>

	<?php

		}//end if else empty
	}//end if else isset date
 ?>



