<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
include "prd_function.php";
//Assign Values to Content
$productname = "Saral TDS.Professional";
$product ='Saral TDS.Professional';
main_product($product);
/*$version = "12.04";
$releasedate = "01 August 2012";
$filesize = "64.10 MB";
$downloadlink = "http://www.etds-payroll-salary-software-india.com/downloads/saraltds/setupex.exe";*/
$productrefid = "5";

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
<style>
#Specifications2:nth-child(2) {
	display : none !important;
	}
</style>
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
    <td valign="top" style="border:solid 1px #999999"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="Specifications">
      <tr>
        <td colspan="3"><strong>Product Download:</strong></td>
      </tr>
      <?  
if($message <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message.'</font></div></td>
  </tr>');
?>
      <tr>
        <td width="33%"><font size="-1"><? echo($productname);?></font></td>
        <td width="30%">Version <? echo($version);?></td>
        <td width="37%" rowspan="2"><form action="" method="post" name="download" id="download">
          <input type="hidden" value="download" name="download"  />
          <input name="download1" type="image" src="../images/downloadbutton.gif" style="cursor:hand" alt="Click here to download"/>
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
        <td>License</td>
        <td colspan="2">Evaluation cum Licensed Version</td>
      </tr>
    </table></td>
  </tr>
<?php
 //product($product);
?>



<!-- Dot Professional -->
 <tr><td>&nbsp;</td></tr> 
<tr>
    <td bgcolor="#D2E1F0" style="border:solid 1px #D2E1F0"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="Specifications2">
        <tbody><tr>
          <td colspan="3"><strong>1. Product Upgrade</strong></td>
        </tr>
        <tr>
          <td width="33%">Version</td>
          <td width="30%"><strong><font color="#FF3300"> 17.00 </font></strong></td>
          <td width="37%" rowspan="2"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saraltds.prof/stds-dotprof-1605-to-1700.exe"><img src="../images/downloadbutton.gif" alt="Upgrade" width="38" height="39" border="0" kasperskylab_antibanner="on"></a></td>
        </tr>
        <tr>
          <td>Release Dated</td>
          <td> 02 Jan 2017 </td>
        </tr>
        <tr>
          <td>Applicable to </td>
          <td colspan="2">Version 16.05 </td>
        </tr>
  <tr>
    <td bgcolor="#D2E1F0" style="border:solid 0px #999999">
        </td></tr><tr bgcolor="#ECF2F9">
          <td colspan="3"><font color="#FF3300"><strong> Hotfix </strong></font></td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td width="33%">Version</td>
          <td width="30%"><strong><font color="#FF3300"> 1 </font></strong></td>
          <td width="37%" rowspan="2"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saraltds.prof/hf-tds-dotprof-1700-1.exe"><img src="../images/downloadbutton.gif" alt="Upgrade" width="38" height="39" border="0" kasperskylab_antibanner="on"></a></td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td>Release Dated</td>
          <td>20 Jan 2017</td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td>Applicable to </td>
          <td colspan="2">v17.00</td>
        </tr>
    
  
    </tbody></table></td>
  </tr>


<!-- Dot Professional -->


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