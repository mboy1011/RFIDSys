
<?php 
	require_once('config.php');
	require_once('loginSession.php');
	
	$db = new Database();
							// echo date('D F d, Y g:i:s');
							$dateNow = date('Y-m-d');
							$sql = "SELECT COUNT(*) as studentCount FROM logged_book WHERE date(`logb_login`) = ?";
							$res = $db->getRow($sql, [$dateNow]);
							$studentCount = $res['studentCount'];
						 	// echo '<pre>';
						 	// 	echo print_r($res);
						 	// echo '</pre>';
						 ?>
							<a href="#">LogIn Count's:
							<strong><?php echo $studentCount; ?></strong>
							</a>
