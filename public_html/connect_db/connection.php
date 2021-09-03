<?php 
	
	$connection = mysqli_connect('localhost', 'admin', 'h3l8Ig1jUZTA', 'website');

	

	$connection -> set_charset('utf8');
	
	//if not connected
	if(!$connection)
	{
		echo "<script>console.log('Connection error');</script>";
		$_SESSION['connection'] = 'false';
	}
	else
	{
	    $_SESSION['connection'] = 'true';
	}
 ?>