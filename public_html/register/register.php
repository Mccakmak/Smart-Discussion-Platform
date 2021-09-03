<?php 
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Register</title>
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
				<form id="register_form" class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="register.php">
					<span class="login100-form-title">
						Sign Up
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your username">
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your email">
						<input class="input100" type="email" name="email" placeholder="Email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Please enter your password with minimum length 5">
						<input class="input100" type="password" name="password" placeholder="Password" minlength="5">
						<span class="focus-input100"></span>
					</div>

					
					<div class="p-t-13 p-b-23" style="text-align: center;">
						  <input type="checkbox" value="" id="link" required>
						  <span id="terms_link" class="txt1">
						    I agree to the Terms & Conditions
						  </span>
					</div>

					<div class="container-login100-form-btn">
						<button name="sign_up_user" class="login100-form-btn" id="sign_up_user">
							Sign up
						</button>
					</div>

					<a class="container-login100-form-btn login100-form-btn" href="../index.php">Return main site</a>


					<div class="flex-col-b p-t-15 p-b-40">
						<span class="txt1 p-b-9">
							Do you have an account?
						</span>

						<a href="../login/login.php" class="txt3">
							Sign in now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

					<!-- Modal -->
					<div class="modal fade" id="terms" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-scrollable" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalScrollableTitle">Terms & Conditions</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
								The rules and other legal issues you are subject to when you become a registered user of Smart Discussion Platform are as follows.
								<br><br>
								<h5 style="font-weight: bold">Being a registered user </h5>
								<br>
								We apply the age limit of 18, so it is unfortunately not possible for people under 18 to be users.

								In order to become a registered user in Smart Discussion Platform, you need to enter the information requested from you. After this process is completed, we will send you an e-mail for activation.

								<br><br>
								<h5 style="font-weight: bold">Functioning and Your Responsibilities</h5>
								<br>								

								The content you create must comply with the rules of the sour dictionary and the law. Please make sure that the content you create is not illegal, as the content you create is published under your sole responsibility and without any preliminary control. Since your legal responsibility begins as soon as the content is published, you or the content you create later on, complaint / notification etc. The fact that it has been deleted by Smart Discussion Platform will not relieve you of your responsibility.

								The rules of the platform, the reasons for the deletion of the entries and other sanctions are announced to the users on the site, it is your responsibility to follow them.

								Your entries may be removed from publication because they do not comply with the rules of the platform because they are against the law. Your usership may be temporarily suspended or your user account may be closed due to violations of the rules or the law. All other rights reserved.

								We reserve the right to partially or completely unpublish any content, cancel your authorship, and delete your user registration, if we deem it necessary and without giving any reason.

								All the responsibility regarding the security of your account belongs to you. We recommend that you create your password in a way that it cannot be guessed easily and that you do not share it with third parties, and that you do not enter your username and password on third-party websites and/or mobile applications.

								For the security of the information you have given to Smart Discussion Platform shows its best care, however, Smart Discussion Platform does not have any obligation other than due diligence, in cases such as hosting services and similar service companies fail to provide security or accessing the information illegally, or directly or indirectly. We do not accept any liability for any indirect damages.

								Although we make regular backups, we make no commitment that your data (entries, messages, notes and any similar content) on the site will not be partially or completely lost. We also reserve the right to permanently delete this data. Therefore, we do not accept any responsibility in case of data loss or corruption for any reason. If you are worried about data loss, we recommend that you back up your data in Sour Dictionary with your own means.

								<br><br>
								<h5 style="font-weight: bold">Privacy</h5>
								<br>	

								It may be possible to place cookies, also called 'cookies', and similar elements on your computer during your stay at Smart Discussion Platform. Cookies consist of simple text files and do not contain identity and other private information, although they do not contain such personal information, session information and similar data are stored and can be used to recognize you again. You can get more information on this subject at http://en.wikipedia.org/wiki/http_cookie and http://tr.wikipedia.org/wiki/cookie. (We are not responsible for the reliability of the content you will access from the links provided.)

								In addition, we have the right to store, process and use all kinds of data collected by you in the form of automatic recording (unannounced) of your transactions during your registration and during your use of the site, but we have the right to store, process and use any data that we request from you directly (informed) or during your use of the site, but not otherwise specified in this contract. conditions are reserved.

								The data we collect from you will be kept confidential. These data can be used in the development works of Smart Discussion Platform, used as statistical.

								Unless otherwise approved by you, your contact information will only be used for informational and promotional purposes regarding the brand and/or services of Smart Discussion Platform, and your contact information will not be used or given to third parties in any way.

								In case of legal obligation and duly requested by the competent authorities, your information may be shared with the relevant authority. In accordance with the current legislation, only the last 12 months IP information of all registered users is stored.

								Smart Discussion Platform has no responsibility for your information that you share via messaging or make public with your entries at your own request. We recommend that you pay attention to the information you share through personal correspondence or in the entries you publish.

								<br><br>
								<h5 style="font-weight: bold">Copyright</h5>
								<br>

								You own the copyrights of the content you create/publish on Smart Discussion Platform. For this reason, you can compile and use your content (entries) that you have published Smart Discussion Platform, even for commercial purposes. However, if you publish your content that is published in Smart Discussion Platform, on another site on the internet, you must provide an active link to Smart Discussion Platform. The use of the brands sour, sourtimes, sour things and sour dictionary is subject to the written permission of sour technology.

								Although the copyrights belong to you, reproduction, copying, processing and printed media, radio-television, satellite and cable broadcasting organizations such as radio-television, satellite and cable or internet and other forms of digital transmission are provided to Smart Discussion Platform for all the content you publish on the website. You hereby grant the right (license) to use all financial rights without any geographical limitation, indefinitely and free of charge, including but not limited to the right to broadcast by means of signs, sound and/or image transmission, and any other means.

								As long as the content you create is live in Smart Discussion Platform will have the right to use these contents for commercial purposes, especially in Sour Things, under the brands it uses and/or on other websites in all environments it deems appropriate. To prevent this, it is sufficient to delete the content you do not want to be used or close your account, but these actions are only forward-looking and will not give you the right to remove your entries from previous works, request royalties or similar. A reprint or publication of previous work is therefore always possible.

								It is accepted that the content you publish on Smart Discussion Platform belongs to you or you have the right to use it within the framework of the law on intellectual and artistic works. It is possible to publish the content that does not belong to you, only in accordance with the procedure specified in the law and on the condition that you make a reference. Otherwise, we want to indicate that you will be responsible for any losses we may incur in.

					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
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
		                    <form method="POST" action="register.php">
		                      <div class="form-group">
		                        <label for="recipient-name" class="col-form-label">Verification Code(Check Spam too):</label>
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

if(isset($_POST['sign_up_user']))
{?>
	<input type="hidden" name="check_form" id="check_form" value="passed">

<?php 

	
	$username = mysqli_real_escape_string($connection, $_POST['username']); 
	$username = strtolower($username);

	$_SESSION['Register_username'] = $username;

	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$email = strtolower($email);

	$_SESSION['Register_email'] = $email;

	$password = mysqli_real_escape_string($connection, $_POST['password']);

	$_SESSION['Register_password'] = $password;


	$sql = "SELECT * FROM user";
	$result = mysqli_query($connection, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);


	$user_found = "false";



	foreach ($users as $user ) {
		if( ($username == $user['username']) || ($email == $user['email']))
		{ ?>
			
		<?php 
			$user_found = "true";
			echo 
			'<script>
				Swal.fire({icon: "error",title: "Username or email already exists!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "register.php";}); 
			</script>';
			break;
		}
	}

	if($user_found == 'false')
	{ ?>
		<input type="hidden" name="user_check" id="user_check" value="passed">
		<?php 


		include "../mail_confirmation.php";
	}

}


// Check email confirmation


if(isset($_POST['code']))
{
	$entered_code = mysqli_real_escape_string($connection, $_POST['code']);


	$sql = "SELECT * FROM verification";
	$result = mysqli_query($connection, $sql);
	$codes = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$is_code_correct = 'false';

	$username = $_SESSION['Register_username'];
	$email = $_SESSION['Register_email'];
	$password = $_SESSION['Register_password'];



	foreach($codes as $code)
	{
		if($code['code'] == $entered_code && $email == $code['mail'])
		{
			$is_code_correct = 'true';
		}
	}

	if($is_code_correct == 'true')
	{
		$sql = "INSERT INTO user(username,email,password) VALUES('$username', '$email', '$password')";
		mysqli_query($connection,$sql);
		//add user to metaphone

		$user_metaphone = metaphone($username);

		$sql = "INSERT INTO metaphone_user(username,user_metaphone) VALUES('$username', '$user_metaphone')";
		mysqli_query($connection,$sql);
		
		echo 
		'<script>
    		Swal.fire({icon: "success",title: "Register has been done!",showConfirmButton: false,timer: 1500}).then(function(){window.location = "../login/login.php";}); 
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

<style type="text/css">
#terms_link:hover {
    text-decoration: underline;
    color: blue;
}
#terms_link
{
	cursor: pointer;
}
</style>

<script type="text/javascript">

jQuery.noConflict(); 	


if($('#check_form').val() == "passed" && $('#user_check').val() == "passed")
{
	$('#code_modal').modal('show'); 
}


$(document).ready(function() {
    $("#terms_link").click(function(event) {
 		$('#terms').modal('show');
    });
});



</script>



