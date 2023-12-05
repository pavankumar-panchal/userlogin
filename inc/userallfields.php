<?php
$query = "SELECT * FROM users WHERE emailid = '".$email."'";
$result = runmysqlqueryfetch($query);

$userid = $result['slno'];
$emailid = $result['emailid'];
$password = $result['password'];
$secquestion = $result['secquestion'];
$secanswer = $result['secanswer'];
$name = $result['name'];
$company = $result['company'];
$address = $result['address'];
$place = $result['place'];
$regionid = $result['regionid'];
$phone = $result['phone'];
$cell = $result['cell'];
$stdcode = $result['stdcode'];
$typeofuser = $result['typeofuser'];
$categoryofuser = $result['categoryofuser'];
$existingcust = $result['existingcust'];
$refer = $result['refer'];
$createdondate = $result['createdondate'];
$createdonip = $result['createdonip'];
$lastlogindate = $result['lastlogindate'];
$lastloginip = $result['lastloginip'];
$logincount = $result['logincount'];
$subnewsletter = $result['subnewsletter'];
$lastprofileupdate = $result['lastprofileupdate'];

$query = "SELECT * FROM usertype WHERE slno = '".$typeofuser."'";
$result = runmysqlquery($query);
if(mysqli_fetch_row($result) > 0)
{
	$resultfetch = runmysqlqueryfetch($query);
	$usrtype = $resultfetch['customertype'];
}
else
	$usrtype = '';

$query = "SELECT * FROM usercategory WHERE slno = '".$categoryofuser."'";
$result = runmysqlquery($query);
if(mysqli_fetch_row($result) > 0)
{
	$resultfetch = runmysqlqueryfetch($query);
	$usrcategory = $resultfetch['businesstype'];
}
else
	$usrcategory = '';

$query = "SELECT * FROM regions WHERE subdistcode = '".$regionid."'";
$result = runmysqlqueryfetch($query);

$district = $result['distname'];
$state =  $result['statename'];
$region =  $result['subdistname'];
$districtid = $result['distcode'];
$stateid =  $result['statecode'];
$managedarea =  $result['managedarea'];

$buyonlinestates = array("32","1","3","2","4","30","29","26","7","8","34","9","10","28","13","14","15","16","36","27","20","22","33","24","18");

?>