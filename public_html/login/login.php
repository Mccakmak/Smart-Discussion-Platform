<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="../libraries/sweetalert2.css">	

	<link rel="shortcut icon" href="../css/favicon.png" type="image/x-icon" />

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="">
					<span class="login100-form-title">
						Login
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Please enter your password">
						<input class="input100" type="password" name="password" placeholder="Password" minlength="5">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							Forgot
						</span>

						<a href="../reset/reset.php" class="txt2" id="forget_part">
							Username / Password?
						</a>
					</div>

					<div class="container-login100-form-btn">
						<button name="sign_in_user" class="login100-form-btn">
							Login
						</button>
					</div>

					<a class="container-login100-form-btn login100-form-btn" href="../index.php">Return main site</a>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							Don’t have an account?
						</span>

						<a href="../register/register.php" class="txt3">
							Sign up now
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

	if(isset($_POST['sign_in_user']))
	{
		$username = mysqli_real_escape_string($connection, $_POST['username']); 
		$password = mysqli_real_escape_string($connection, $_POST['password']);
		$username = strtolower($username);
		$sql = "SELECT * FROM user";
		$result = mysqli_query($connection, $sql);
		$users = mysqli_fetch_all($result, MYSQLI_ASSOC);


		$user_found = 'false';
		foreach ($users as $user ) {
			if( $username == $user['username'] && $password == $user['password'])
			{
				$user_found = 'true';
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $user['email'];
				$_SESSION['password'] = $password;

				echo 
				'<script>
					Swal.fire({icon: "success",title: "Login success!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "../main.php";}); 
				</script>';
				break;
			}
			elseif($username == 'adminmedipol' && $password == 'adminadmin')
			{
				$user_found = 'true';
				echo 
				'<script>
					Swal.fire({icon: "success",title: "Login success!",showConfirmButton: false,timer: 1200}).then(function(){window.location = "../admin/follow.php";}); 
				</script>';
			}
		}

		if($user_found == 'false')
		{
			echo 
			'<script>
				Swal.fire({icon: "error",title: "Username or password is wrong!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "login.php";}); 
			</script>';
		}
	}


 ?>