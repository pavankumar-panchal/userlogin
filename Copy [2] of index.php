<?php
//Check whether already logged in. If so redirect to valid user page
session_start();
if(isset($_SESSION['verifyid']) && isset($_COOKIE['validemailid']))
{
	if($_SESSION['verifyid'] == "3643564356")
		//Check Redirecting special request
		if($_REQUEST['link'] <> '')
		header("Location:".$_REQUEST['link']);
		else
		header("Location:./home/index.php");
}

include("./functions/phpfunctions.php");

/*//Check whether cookies are enabled in the browser or not. If not, then display a warning stating, Please enable cookies to proceed
setcookie("cookieenabled","yes",time() +"3600");
if (isset($_COOKIE["cookieenabled"])) 
$cookieenabled = 1;
else
$cookieenabled = 0;*/

//Check whether freshly loaded page or Submitted page
if($_POST['login'] <> "")
{
	$email = $_POST['lgnemail'];
	$password = $_POST['lgnpassword'];
	$errormessage = "";

	if($email == "" or $password == "")
		$errormessage = "Please enter your email address and/or Password";

	if($errormessage == "")
	{
		$query = "SELECT * FROM users WHERE emailid = '".$email."'";
		$result = runmysqlquery($query);
		$emailpresence = mysqli_num_rows($result);

		if($emailpresence == 0)
			$errormessage = "This User ID is not registered.";
		else
		{
			$emailrow = runmysqlqueryfetch($query);
			if($emailrow['password'] <> $password)
				$errormessage = "Invalid Password.";
		}
		if($errormessage == "")
		{
			//Set Cookie for validusers page
			//setcookie(validemailid, $email); 
			setcookie(validemailid,$email,time()+3600, "/", ".relyonsoft.com");
			//Start login Session
			session_start();  
			$_SESSION['verifyid'] = "3643564356";
			
			//Add 1 to login count
			$logincount = $emailrow['logincount'] + 1;
			
			//Record Login IP and Date
			$lastlogindate = datetimelocal("Y-m-d"); 
			$lastloginip = getenv("REMOTE_ADDR");
			
			//Insert Login Date, IP and Count to database
			$query = "UPDATE users SET lastlogindate = '".$lastlogindate."',lastloginip = '".$lastloginip."',logincount = '".$logincount."' WHERE emailid = '".$email."'";
			$result = runmysqlquery($query);
			
			//Check Redirecting special request
			if($_REQUEST['link'] <> '')
			header("Location:".$_REQUEST['link']);
			else
			header("Location:./home/index.php");
		}

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon User Login | V2 Beta</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<meta name="verify-v1" content="gBwvVqcU7Ol0vs0kLK/O3gBbLYq7Q+WXxlFJCtOfp6s=" />
<script src="functions/jsfunctions.js" language="javascript"></script>
<script src="functions/cookies.js" language="javascript"></script>
<script type="text/javascript">
Set_Cookie( 'test', 'none', '', '/', '', '' );
if ( Get_Cookie( 'test' ) )
{
//	document.write( 'cookies are currently enabled.' );
	cookie_set = true;
	Delete_Cookie('test', '/', '');
}
else
{
	cookie_set = false;
}
</script>
<script>
function dofocus(fieldid)
{
	var fieldname = document.getElementById(fieldid);
	fieldname.focus();
}
</script>
</head>
<body onload="dofocus('lgnemail');">
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr valign="top">
    <td><? include("./inc/header.php"); ?></td>
  </tr>
  <tr valign="top">
    <td><div>&nbsp;</div>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="550" class="pagebody"><form method="post" action="index.php">
              <table width="100%" border="0" cellpadding="2" cellspacing="0">
                <tr>
                  <td colspan="3" class="pagebodyheading"><font size="-1"><strong>Relyon Subscribed Services</strong></font></td>
                </tr>
                <tr>
                  <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="159"><div align="center"><img src="images/userlogin-home-welcome.jpg" alt="Register for free account" width="105" height="105" border="0"/></div></td>
                        <td width="373" valign="middle"><div align="justify">Registering as a member, you will have access to  Relyon Subscribed Services (which includes Newsletters, Product Downloads and Much More) as well as all the resources available to Relyonsoft.com members.</div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td colspan="3" class="pagebodyheading"><font size="-1"><strong>Login to your Relyon Account  - OR - Signup for a Free Account </strong></font></td>
                </tr>
                <tr>
                  <td colspan="3"><noscript>
                  <font color="#FF0000">This page requires JavaScript to function. Please enable it in your browser and reopen the page.</font>
                  </noscript>
                  &nbsp;</td>
                </tr>
                <?  
if($errormessage <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#FF0000">'.$errormessage.'</font></div></td>
  </tr>');
?>
                <tr>
                  <td colspan="3"></td>
                </tr>
                <tr>
                  <td width="24%"><strong>Your Email Address</strong>: </td>
                  <td colspan="2"><input name="lgnemail" type="text" class="formfields" id="lgnemail" size="30" maxlength="50" alt="Enter the email ID registered with Relyon Soft.com. If new User, click on Signup link below."></td>
                </tr>
                <tr>
                  <td colspan="3">Use your Email address that has been registered with Relyonsoft.com </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td><strong>Your Password</strong>: </td>
                  <td width="48%"><input name="lgnpassword" type="password" class="formfields" id="lgnpassword" size="30" maxlength="15" />
                    <input name="link" type="hidden" id="link" value="<? if($_REQUEST['link'] <> '') echo($_REQUEST['link']); else echo("./home/index.php");?>" /></td>
                  <td width="28%">
<script type="text/javascript">
if (cookie_set)
{
	document.write( '<input name="login" type="submit" class="formbutton" id="login" value="Login" />' );
}
</script>
                    
                    </td>
                </tr>
                <tr>
                  <td height="20" colspan="3">
<script type="text/javascript">
if (!cookie_set)
{
	document.write( '<div align="center"><font color="#FF0000"><strong>Caution</strong>: Cookies are disabled in your browser. Please enable cookies to continue. <br />[From Privacy Options in Option Settings]</font></div>' );
}
</script>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" <? if($errormessage <> "")
echo('class="pagebodyheading"'); ?>><div align="center"><strong><a href="signup.php">New Users - Click Here to Register for Free</a></strong> </div></td>
                </tr>
                <tr>
                  <td colspan="3"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
                      <TR vAlign=top>
                        <TD noWrap>&nbsp;</TD>
                        <TD><div align="right">[<a href="rtrpassword.php">Forgot Password?</a>] </div></TD>
                      </TR>
                    </TABLE></td>
                </tr>
              </table>
            </form></td>
          <td class="columnBorder">&nbsp;</td>
          <td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("./inc/incmemberbenifits.php"); ?></td>
        </tr>
      </table>
      <div>&nbsp;</div>
      <BR>
    </td>
  </tr>
  <tr valign="top">
    <td><? include("./inc/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
