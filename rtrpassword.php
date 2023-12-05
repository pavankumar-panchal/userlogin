<?
$secquestion = "";

include("./functions/phpfunctions.php");

if($_POST['send'] == "Send Password")
{
	$email1 = $_POST['usremailid1'];
	if($email1 == "")
		$errormessage1 = "Please enter your registered email ID";
	else
	{
		require_once("functions/RSLMAIL_MAIL.php");
		$email1 = trim($email1);
		$query = "SELECT * FROM users WHERE emailid = '".$email1."'";
		$result = runmysqlquery($query);
		$resultcount = mysqli_num_rows($result);
		//Check whether user is registered or not.
		if($resultcount == 0)
			$errormessage1 = "This email ID is not registered.";
		else
		{
			$emailrow = mysqli_fetch_array($result);
			$password = $emailrow['password'];
			$name = $emailrow['name'];
			//email Password to user
			/*$MailSubject = "Relyonsoft.com account password retrival.";
			$headers .= 'From: Relyon <subscriptions@relyonsoft.com>' . "\r\n";
			$msg = "Your Password for the user ID ".$email1." is '".$password."'.";
			mail($name." <".$email1.">", $MailSubject, $msg, $headers);
			$message1 = "Your password has been emailed successfully to ".$email1.".";*/
			$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
			$subject = "Relyonsoft.com account password retrival.";
			
			$fromname = "Relyon";
			$fromemail = "imax@relyon.co.in";
			$toarray[$name] = $email1; 
			//$toarray[$name] = 'meghana.b@relyonsoft.com';
			$msg = "Your Password for the user ID ".$email1." is '".$password."'.";
			rslmail($fromname,$fromemail,$toarray,$subject,$text,$msg,null,null,null);
			$message1 = "Your password has been emailed successfully to ".$email1.".";
		}

	}
}
elseif($_POST['getquestion'] == "Get Security Question")
{
	$email = $_POST['usremailid2'];
	if($email == "")
		$errormessage2 = "Please enter your registered email ID";
	else
	{
		$email = trim($email);
		$query = "SELECT * FROM users WHERE emailid = '".$email."'";
		$result = runmysqlquery($query);
		$resultcount = mysqli_num_rows($result);
		//Check whether user is registered or not.
		if($resultcount == 0)
			$errormessage2 = "This email ID is not registered.";
/*		elseif($emailrow['logincount'] == '0')
			$errormessage2 = "You should have logged in atleast once to retrive in this method.<br> You can use only above option [1] in this case.";*/	
		else
		{
			$emailrow = mysqli_fetch_array($result);
			$secquestion = $emailrow['secquestion'];
		}
	}
}
elseif($_POST['retrive'] == "Retrive")
{
	$email = $_POST['usremailid2'];
	$secquestion = $_POST['secquestion'];
	$secanswer = $_POST['secanswer'];
	if($email == "")
	{
		$errormessage2 = "Please enter your registered email ID";
		$secquestion = "";
	}
	elseif($secanswer == "")
	{
		$errormessage2 = "Please Answer your security question.";
	}
	else
	{
		$email = trim($email);
		$query = "SELECT * FROM users WHERE emailid = '".$email."'";
		$result = runmysqlquery($query);
		$resultcount = mysqli_num_rows($result);
		//Check whether user is registered or not.
		if($resultcount == 0)
			$errormessage2 = "This email ID is not registered.";
		else
		{
			$emailrow = mysqli_fetch_array($result);
			if($emailrow['secanswer'] <> $secanswer)
				$errormessage2 = "Incorrect answer for security question.";
			else
			{
				$password = generatepwd();
	
				//Update password to database
				$query = "UPDATE users SET password = '".$password."' WHERE emailid = '".$email."'";
				$result = runmysqlquery($query);
				$message2 = "Your password has been reset to '".$password."'.";
			}
		}
		
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Retrive your Password</title>
<meta name="keywords" content="Subscription">
<meta name="description" content="Subscription confirmation">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<script src="functions/jsfunctions.js" language="javascript"></script>
</head>
<body>
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
<tr valign="top"><td><? include("./inc/header.php"); ?></td>
</tr>
<tr valign="top">
<td><div>&nbsp;</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" style="padding-right:10px"><div align="right"><a href="http://userlogin.relyonsoft.net">Home</a></div></td>
</tr>
<tr>
<td width="550" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><strong>Retrive Password </strong></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td>Option 1: </td>
  </tr>
  <tr>
    <td>Enter your registered email ID and your password will be emailed to you. </td>
  </tr>
  <tr>
    <td>
	<form action="" method="post" name="rtrpassword1" id="rtrpassword1">
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
<?  
if($message1 <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message1.'</font></div></td>
  </tr>');
elseif($errormessage1 <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#FF0000">'.$errormessage1.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>');
?>
      <tr>
        <td width="22%"><strong>eMail ID </strong>:</td>
        <td colspan="2"><input name="usremailid1" type="text" class="formfields" id="usremailid1" value="" size="30" maxlength="50" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="24%">&nbsp;</td>
        <td width="54%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="send" type="submit" class="formbutton" id="send" value="Send Password" />
  &nbsp;&nbsp;
  <input name="reset" type="reset" class="formbutton" id="reset" value="Clear" /></td>
      </tr>
    </table>
	</form></td>
  </tr>
  <tr>
    <td style="border-top: #3f7c5f solid 1px">Option 2: </td>
  </tr>
  <tr>
    <td>Answer your security question and your Password will be reset and displayed. </td>
  </tr>
  <tr>
    <td><form action="" method="post" name="rtrpassword2" id="rtrpassword2">
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
<?  
if($message2 <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message2.'</font></div></td>
  </tr>');
elseif($errormessage2 <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#FF0000">'.$errormessage2.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>');
?>
        <tr>
          <td width="22%"><strong>eMail ID </strong>:</td>
          <td colspan="2"><input name="usremailid2" type="text" class="formfields" id="usremailid2" value="<? echo($email); ?>" size="30" maxlength="50" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2"><input name="getquestion" type="submit" class="formbutton" id="getquestion" value="Get Security Question" /></td>
        </tr>
        <tr>
          <td><strong>Security Question  </strong>:</td>
          <td colspan="2"><input name="secquestion" type="text" class="formfields" id="secquestion" value="<? echo($secquestion); ?>" size="30" maxlength="50" readonly="true" /></td>
        </tr>
        <tr>
          <td><strong>Security Answer </strong>:</td>
          <td colspan="2"><input name="secanswer" type="password" class="formfields" id="secanswer" value="" size="30" maxlength="50" autocomplete = "off" /></td>
        </tr>

        <tr>
          <td>&nbsp;</td>
          <td width="24%">&nbsp;</td>
          <td width="54%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td><? if($secquestion <> "") echo('<input name="retrive" class="formbutton" type="submit" id="retrive" value="Retrive" />'); ?>
            &nbsp;&nbsp;
            <input name="reset2" type="reset" class="formbutton" id="reset2" value="Clear" /></td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
<td class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("./inc/incmemberbenifits.php"); ?></td>
</tr>
</table>	
<div>&nbsp;</div><BR>
</td>
</tr>
<tr valign="top"><td><? include("./inc/footer.php"); ?></td>
</tr>
</table>
</body>
</html>
