<?
//Read email ID from Cookie
if(isset($_COOKIE['confirmemailid']))
	$confirmemailid = $_COOKIE['confirmemailid']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Signup Confirmation</title>
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
<td colspan="3" style="padding-right:10px"><div align="right"><a href="http://userlogin.relyonsoft.com">Home</a></div></td>
</tr>

<tr>
<td width="550" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><strong>Congratulations!</strong></td>
    </tr>
  <tr>
    <td valign="top">You have successfully signed up for a Relyonsoft.com subscription account.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Your account  password has been sent over email to <? echo($confirmemailid); ?>.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Go through the email and login to your account through <a href="http://userlogin.relyonsoft.com">http://userlogin.relyonsoft.com</a>. In case of any problems, let us know at <a href="mailto:subscriptions@relyonsoft.com">support@relyonsoft.com</a>. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Thank you for registering with us... </td>
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
