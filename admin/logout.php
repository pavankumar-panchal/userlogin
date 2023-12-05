<?php

	//Delete emailid cookie and destroy the session
	setcookie(validemailid, "");
	session_start(); 
	session_destroy();
	//Redirect to login page
	header("Location:./index.php");

?>