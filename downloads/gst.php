<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
include "prd_function.php";
//Assign Values to Content
$productname = "Saral GST";
$product ='Saral GST';
main_product($product);
/*$version = "7.09";
$releasedate = "27 August 2012";
$filesize = "131 MB";
$downloadlink = "http://www.etds-payroll-salary-software-india.com/downloads/sto/setupex.exe";*/
//$productrefid = "17"; //Do not edit this value

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
<td width="550" rowspan="3" valign="top" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Download <? echo($productname);?> </strong></font></td>
    </tr>
  <tr>
    <td valign="top" style="border:solid 1px #999999"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="Specifications">
        <tr>
          <td colspan="3"><strong>Product Download:</strong></td>
        </tr>
        
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td width="33%"><font size="-1"><? echo($productname);?></font></td>
          <td width="30%">Version  <? echo($version);?></td>
          <td width="37%" rowspan="2"><form action="" method="post" name="download" id="download">
              <a href="http://www.etds-payroll-salary-software-india.com/downloads/saralgst/SaralGST_v5_SQL.exe" target="_self"><img src="../images/downloadbutton.gif" style="cursor:hand" alt="Click here to download"></a>
          </form></td>
        </tr>
        <tr>
          <td>Release Dated</td>
          <td><? echo($releasedate);?></td>
        </tr>
        <tr>
          <td>Size</td>
          <td colspan="2"><? echo($filesize);?></td>
        </tr>
        <tr>
          <td>Note:</td>
          <td colspan="2"><font color="#FF3300">Requires Prerequisites.<a href="#pre"> Click here</a> to get them.</font></td>
        </tr>
        <tr>
          <td>License</td>
          <td colspan="2">Evaluation cum Licensed Version</td>
        </tr>
    </table></td>
  </tr>
  
  
<?php
 product($product);
?>
 <tr><td>&nbsp;</td></tr>

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
