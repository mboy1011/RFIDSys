<?php 
							// echo date('D F d, Y g:i:s');
							$dateNow = date('Y-m-d');
							$sql = "SELECT COUNT(*) as studentCount FROM logged_book WHERE date(`logb_login`) = ?";
							$res = $db->getRow($sql, [$dateNow]);
							$studentCount = $res['studentCount'];
						 	// echo '<pre>';
						 	// 	echo print_r($res);
						 	// echo '</pre>';
						 ?>
							<a href="#">Today Student Count's:
							<strong><?php echo $studentCount; ?></strong>
							</a>
