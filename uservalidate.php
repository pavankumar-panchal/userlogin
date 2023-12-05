<?php
include("./functions/phpfunctions.php");

//Check whether freshly loaded page or Submitted page
if($_GET['u'] <> "" && $_GET['p'] <> "")
{
	$email = $_GET['u'];
	$password = $_GET['p'];
	$errormessage = "";
	$query = "SELECT * FROM users WHERE emailid = '".$email."'";
	$result = runmysqlquery($query);
	$emailpresence = mysqli_num_rows($result);

	if($emailpresence == 0)
		$errormessage = "0^This User ID is not registered.";
	else
	{
		$emailrow = runmysqlqueryfetch($query);
		if($emailrow['password'] <> $password)
			$errormessage = "0^Invalid Password.";
	}
	if($errormessage == "")
	{
		$errormessage = "1^Validation Successfull.";
	}
	echo($errormessage);
}

?>