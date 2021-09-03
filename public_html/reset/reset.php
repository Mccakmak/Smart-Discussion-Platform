<?php 
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reset</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<script type="text/javascript" src="../libraries/jquery-3.5.1.js"></script>
	<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../libraries/bootstrap_bundle.js"></script>

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
				<form id="reset_form" class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="reset.php">
					<span class="login100-form-title">
						Reset Password
					</span>


					<div class="wrap-input100 validate-input m-b-72" data-validate="Please enter your email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<button name="reset_password" class="login100-form-btn" id="reset_password">
							Reset
						</button>
					</div>

					<a class="container-login100-form-btn login100-form-btn" href="../index.php">Return Main Site</a>


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

			       <div class="modal fade" id="code_modal" tabindex="-1" aria-labelledby="add_entry_label" aria-hidden="true">
		              <div class="modal-dialog" style="padding-top: 12.5%;">
		                <div class="modal-content">
		                  <div class="modal-header">
		                    <h5 class="modal-title" id="add_entry_label">Enter Sent Verification Code</h5>
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                      <span aria-hidden="true">&times;</span>
		                    </button>
		                  </div>
		                  <div class="modal-body">
		                    <form method="POST" action="reset.php">
		                      <div class="form-group">
		                        <label for="recipient-name" class="col-form-label">Verification Code:</label>
		                          <input name="code" type="text" class="form-control " id="recipient-name" maxlength="8" required>
		                      </div>

		                      <div class="modal-footer">
		                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                        <button name="crate_topic" type="submit" class="btn btn-primary">Enter</button>
		                      </div>
		                    </form>
		                  </div>

		                </div>
		              </div>
		            </div> 
	
	<script src="../login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../login/js/main.js"></script>
	<script src="../libraries/sweetalert2.all.js"></script>
</body>
</html>


<?php  


include("../connect_db/connection.php");


$is_code_correct == 'false';

if(isset($_POST['reset_password']))
{?>
	<input type="hidden" name="check_form" id="check_form" value="passed">

<?php 

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$email = strtolower($email);

	$_SESSION['Register_email'] = $email;


	$sql = "SELECT * FROM user";
	$result = mysqli_query($connection, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);


	$user_found = "false";



	foreach ($users as $user ) {
		if( $email == $user['email'] )
		{ ?>
			
		<?php 
			$user_found = "true";
			break;
		}
	}


	if($user_found == 'true')
	{ ?>
		<input type="hidden" name="user_check" id="user_check" value="passed">
		<?php 


		include "../mail_confirmation.php";
	}
	elseif($user_found == 'false')
	{
	echo 
	'<script>
		Swal.fire({icon: "error",title: "Email does not exist!",showConfirmButton: false,timer: 1200}).then(function(){window.location = "reset/reset.php";}); 
	</script>';
	}

}


// Check email confirmation


if(isset($_POST['code']))
{
	$entered_code = $_POST['code'];


	$sql = "SELECT * FROM verification";
	$result = mysqli_query($connection, $sql);
	$codes = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$is_code_correct = 'false';

	$email = $_SESSION['Register_email'];



	foreach($codes as $code)
	{
		if($code['code'] == $entered_code && $email == $code['mail'])
		{
			$is_code_correct = 'true';
		}
	}

	if($is_code_correct == 'true')
	{
		echo 
		'<script>
    		Swal.fire({icon: "success",title: "Code is correct! You may reset your password now.",showConfirmButton: false,timer: 1200}).then(function(){window.location = "reset_password.php";}); 
		</script>';

	}
	elseif($is_code_correct == 'false')
	{
		echo 
		'<script>
    		Swal.fire({icon: "error",title: "Code is wrong! Try again.",showConfirmButton: false,timer: 1000}); 
		</script>';
	}
		
}



?>

<script type="text/javascript">

jQuery.noConflict(); 	


if($('#check_form').val() == "passed" && $('#user_check').val() == "passed")
{
	$('#code_modal').modal('show'); 
}


</script>

