<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="../login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../login/css/main.css">
	<link rel="stylesheet" type="text/css" href="../libraries/sweetalert2.css">

	<link rel="shortcut icon" href="../css/favicon.png" type="image/x-icon" />

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="">
					<span class="login100-form-title">
						Reset Password
					</span>

					<div class="wrap-input100 validate-input m-b-72" data-validate = "Please enter your password">
						<input class="input100" type="password" name="password" placeholder="Password" minlength="5">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<button name="change_password" class="login100-form-btn">
							Change password
						</button>
					</div>

					<a class="container-login100-form-btn login100-form-btn" href="../index.php">Return main site</a>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Remember your password?
						</span>

						<a href="../login/login.php" class="txt3">
							Sign in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
	<script src="../libraries/sweetalert2.all.js"></script>
</body>
</html>


<?php 
	include("../connect_db/connection.php");

	if(isset($_POST['change_password']))
	{
		$email = $_SESSION['Register_email'];
		$password = mysqli_real_escape_string($connection, $_POST['password']);

		$sql = "UPDATE user SET password = '$password' WHERE email = '$email' ";
		

		if(mysqli_query($connection, $sql))
		{
			echo 
			'<script>
				Swal.fire({icon: "success",title: "Password has been changed!",showConfirmButton: false,timer: 1200}).then(function(){window.location = "../login/login.php";}); 
			</script>';			
		}
		else
		{
			echo 
			'<script>
				Swal.fire({icon: "error",title: "Something happened! Password could not change.",showConfirmButton: false,timer: 1500}).then(function(){window.location = "../main.php";}); 
			</script>';				
		}

	
	}


 ?>