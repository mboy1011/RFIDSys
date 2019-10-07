<?php 
	require_once('config.php');

	$db = new Database();

	if(isset($_SESSION['loginUserStatus'])){
		header('location: viewallstudents.php');
	}

	//if ge lick ang login button do this
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$password = md5($password);//convert password to md5

		$userLogin = new Database();

		$sql = "SELECT * FROM users
				WHERE user_name = ? AND user_password = ?
				";

		$userExist = $userLogin->getRow($sql, [$username, $password]);//check if user exist

		if($userExist > 0)//if fetch naay na kit an
		{
			$_SESSION['loginUserStatus'] = true;
			header('location: viewallstudents.php');
		}else{
			$invalidUserNameOrPassword = true;
		}

	}//end of if isset login

 ?>
<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>RFID student monitoring</title>

		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">	

	</head>



	<body>
		<br/ >
<br/ >
<br/ >
<br/ >
<br/ >
<br/ >
<br/ >
<br/ >
<br/ >

	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<?php 
				if(isset($invalidUserNameOrPassword)){
				?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Error: </strong> Invalid Username or Password!
					</div>
				<?php
				}
			 ?>
			<div class="panel panel-info">
				  <div class="panel-heading">
						<h3 class="panel-title">LogIn</h3>
				  </div>
				  <div class="panel-body">
						<form action="" method="POST" role="form">
						
							<div class="col-md-4 col-sm-4 col-xs-4">
								<img src="images/user-login.jpg" width="150" height="110">
							</div>
							<div class="col-md-8 col-sm-8 col-xs-8">

								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										</div>	
										<input type="text" name="username" class="form-control" autocomplete="off" placeholder="Username" required="required"
										<?php 
											if(isset($username)){
												echo "value = '$username'";
											}else{
												echo "autofocus";
											}
										 ?>
										/>
									</div>
								</div>

								<div class="form-group">
									<div class="input-group">
										<div class="input-group-addon">
											<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										</div>	
										<input type="password" name="password" class="form-control" autocomplete="off" placeholder="Password" required="required"
										<?php 
											if(isset($username)){
												echo "autofocus";
											}
										 ?>	
										/>
									</div>
								</div>
							
								<div class="form-group">
									<center>
										<button type="submit"  name="login" class="btn btn-success">Login  
											<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
										</button>
									</center>
								</div>
							</div>

						</form>
				  </div>
			</div>
		</div>
		<div class="col-md-4 col-sm-3 col-xs-3"></div>
	</div>


	
</div>

 		<script src="bootstrap/js/jquery-1.11.1.min.js"></script>s
 		<script src="bootstrap/js/bootstrap.js"></script>

	</body>
</html>

<?php 
	$db->Disconnect();//disconnect connection
 ?>