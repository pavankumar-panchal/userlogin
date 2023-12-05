<?php

include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
$errormessage = "";
	$message = "";
if(isset($_POST['update']))
{
if($_POST['update'] == "Update")
{
	//Assign all the submitted records and trim it
	$oldpwd = trim($_POST['oldpwd']);
	$newpwd = trim($_POST['newpwd']);
	$conpwd = trim($_POST['conpwd']);
	
	
	//Check whether all fields are filled
	if($oldpwd == "" or $newpwd == "" or $conpwd == "") 
	$errormessage = "Fill in all the fields.";
	//Check whether New and confirm password are matching
	elseif($newpwd <> $conpwd) 
	$errormessage = "New Password and Confirm Password are not matching.";
	//Check whether New and confirm password are matching
	elseif($oldpwd <> $password) 
	$errormessage = "Invalid Old Password.";

	if($errormessage == "")
	{
		$password = $newpwd;

		//Update records in database
		$query = "UPDATE users SET password = '".$password."' WHERE emailid = '".$email."'";
		$result = runmysqlquery($query);

		//Success message
		$message = "Password for ".$emailid." changed successfully.";
	}
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon User - Change Password</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
<script src="../functions/editprofile.js" language="javascript"></script>
</head>
<body>
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
<tr valign="top"><td><? include("../inc/header2.php"); ?></td>
</tr>
<tr valign="top">
<td><div>&nbsp;</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" style="padding-right:10px"><div align="right"><a href="../logout.php">Logout</a></div></td>
</tr>
<tr>
<td width="550" rowspan="3" valign="top" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Change Password  for  <? echo($emailid); ?></strong></font></td>
    </tr>
  <tr>
    <td valign="top">
	<form action="" method="post" name="changepwd" id="changepwd">

	<table width="100%" border="0" cellpadding="2" cellspacing="0">
<?  
if($message <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message.'</font></div></td>
  </tr>');
elseif($errormessage <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#FF0000">'.$errormessage.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>');
?>
 <tr>
        <td width="29%" valign="middle"><strong>Enter old Password </strong>:</td>
        <td colspan="2"><input name="oldpwd" type="password" class="formfields" id="oldpwd" size="30" maxlength="15"/></td>
      </tr>
      
      <tr>
        <td valign="middle"><strong>New Password </strong>:</td>
        <td colspan="2"><input name="newpwd" type="password" class="formfields" id="newpwd" size="30" maxlength="15"/></td>
      </tr>
      <tr>
        <td valign="middle"><strong>Confirm New Password  </strong>:</td>
        <td colspan="2"><input name="conpwd" type="password" class="formfields" id="conpwd" size="30" maxlength="15"/></td>
      </tr>
      <tr>

        <td colspan="3">&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="30%">&nbsp;</td>
        <td width="41%"><input name="update" type="submit" class="formbutton" id="update" value="Update" />
  &nbsp;&nbsp;
  <input name="reset" type="reset" class="formbutton" id="reset" value="Clear" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</form>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>	 	</td>
  </tr>
</table></td>
<td rowspan="3" class="columnBorder">&nbsp;</td>
<td width="218" height="20" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("../inc/navigation.php"); ?></td>
</tr>
<tr>
  <td valign="top" style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; height: 2px; PADDING-TOP: 0px"></td>
  </tr>
<tr>
  <td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("../inc/profilecard.php"); ?></td>
  </tr>
</table>	
<div>&nbsp;</div><BR>
</td>
</tr>
<tr valign="top"><td><? include("../inc/footer.php"); ?></td>
</tr>
</table>
</body>
</html>
