<?php 
	  session_start();
	  // unset session variables
	  session_unset();
      // destroy the session
      session_destroy(); 
      header('Location: ../index.php');
 ?>