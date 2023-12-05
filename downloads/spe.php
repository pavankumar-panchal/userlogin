<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

//Assign Values to Content
$productname = "Saral PFESI";
$version = "6.03";
$releasedate = "28 April 2007";
$filesize = "19.31 MB";
$downloadlink = "http://www.etds-payroll-salary-software-india.com/downloads/saralpfesi/setupex.exe";
$productrefid = "9";

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
<title> <? echo($productname);?>  Download</title>
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
<td width="550" rowspan="3" valign="top" class="pagebody"><table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Download <? echo($productname);?> </strong></font></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="Specifications">
      <?  
if($message <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>');
?>
      <tr>
        <td width="33%"><font size="-1"><? echo($productname);?></font></td>
        <td colspan="2">Version <? echo($version);?></td>
      </tr>
      <tr>
        <td>Release Dated</td>
        <td colspan="2"><? echo($releasedate);?></td>
      </tr>
      <tr>
        <td>Size</td>
        <td colspan="2"><? echo($filesize);?></td>
      </tr>
      <tr>
        <td>Downlaod Time** </td>
        <td width="44%">14 Mins @ 56kbps </td>
        <td width="23%" rowspan="2"><form action="" method="post" name="download" id="download">
          <input type="hidden" value="download" name="download"  />
          <input name="download1" type="image" src="../images/downloadbutton.gif" style="cursor:hand" alt="Click here to download"/>
        </form></td>
      </tr>
      <tr>
        <td>License***</td>
        <td>Evaluation Cum Registered version </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="justify"><font size="1">**Download time provided is for standard download rate of 56 kbps. However the download time may vary as per your service provider. While downloading, screen may show the time in hours, but it takes very much less time than that. 
      If you are not able to complete download successfully, kindly let us know the problem in written email. </font></div></td>
  </tr>
  <tr class="content">
    <td><div align="justify"><font size="1">***If <? echo($productname);?> is already registered in the system, installing evaluation copy will automatically get registered</font></div></td>
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
