<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

//Assign Values to Content
$productname = "Online SPP";
//$version = "1.00";
//$releasedate = "05th June 2006";
//$filesize = "13.30 MB";
//$downloadlink = "http://www.etds-payroll-salary-software-india.com/downloads/pettycash/setupex.exe";
$productrefid = "23";
$is_it_a_demo_request = "yes";

$message="";
if(isset($_REQUEST['download']))
{
	include("../inc/downloadmis.php"); 
	$requestbuttonvalue = "Thank you for placing the request.";
	$tobedisabled = "disabled";
}
else
{
	$requestbuttonvalue = "Click here to Place the Demo request for " . $productname;
	$tobedisabled = "";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title><? echo($productname);?>  Demo Request</title>
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
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Place a demo request for <? echo($productname);?> </strong></font></td>
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
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="77%"><form action="" method="post" name="downloadform" id="downloadform">
            <div align="center">
              <input type="hidden" value="download" name="download"  />
              <input name="download1" type="submit" style="cursor:hand" value="<? echo($requestbuttonvalue);?>" alt="Click here to Place the request" <? echo($tobedisabled);?>/>
            </div>
        </form></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="justify"><strong>Note: </strong><br />
    This demo request will be placed to Relyon and will be desiganted to nearest Relyon representative in a short while. The visiting person for demonstration will contact you and fix an appointment before coming.</div></td>
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