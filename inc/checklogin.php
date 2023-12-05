<?php

include("../functions/phpfunctions.php"); 

$currenturl = fullurl();
$loginfailureurl = "../index.php?link=".$currenturl;

$login = true;
session_start();
if(isset($_SESSION['verifyid']) && isset($_COOKIE['validemailid']))
{
	$email = $_COOKIE['validemailid'];
	$_SESSION['itr_emailid']=$email;
	//If cookies are wrong, redirect back to login
	if($_SESSION['verifyid'] <> "3643564356")
		$login = false;
}
else //If cookies are not available redirect back to login
	$login = false;

if($login == false)
	header("Location:".$loginfailureurl);




	

?>