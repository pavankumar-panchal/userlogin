<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

//Assign Values to Content
$productname = "IvyOffice";
$version = "10";
$releasedate = "14 November 2007";
$filesize = "17.83 MB";
$downloadlink = "http://www.relyonsoft.com/downloads/ivyoffice/setupex.exe";
$productrefid = "20";

$message="";
if(isset($_REQUEST['download']))
{
	include("../inc/downloadmis.php"); 
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Training Program for Income Tax and TDS</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
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
    <td width="100%" class="pagebodyheading"><strong>Training Program for Income Tax eFiling and TDS Provisions</strong></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>The Training Program:</strong></td>
    </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><p align="justify">With continuing requests from various segment, we are glad  to announce the detailed Training on Income Tax Filing as well as on TDS  provisions. </p>
      <p align="justify">This is a bundled package with a <strong><font color="#663333">Detailed Training</font></strong> PLUS <strong><font color="#006666">Full version of Saral IncomeTax and Saral TDS Professional software</font></strong>.</p></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="center"><font color="#CC3300"><strong>Registration Charges per Participant: <font color="#FF0000">Rs. 3310/-</font></strong></font></div></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/training/pay.php" target="_blank"><font color="#006699">Proceed for Payment&gt;&gt;</font></a></strong></div></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
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
