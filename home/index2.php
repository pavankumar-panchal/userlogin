<?php

include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
include("../inc/distdealers.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Valid user zone | V2 Beta</title>
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
    <td width="100%" class="pagebodyheading"><strong>You have logged in as <font color="#FF6600"><? echo($emailid); ?></font></strong></td>
    </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="112"><img src="../images/niceimage.jpg" alt="Welcome" border="0"/></td>
        <td width="420" valign="middle"><strong>Welcome 
		    <? if($logincount > 1)echo("back"); ?>  
		    <? echo($name); ?>
	! </strong>
	<div>&nbsp;</div>
	<div>
	  <? if($logincount == 1) 
echo("This is the 1st time you are logging in. We highly recommend you to <strong>change</strong> the password immediately.");
elseif($logincount > 1) 
echo("Till now, you have logged in ".$logincount." times to this area.");?>
	&nbsp;</div>
	<div align="justify">It is our pleasure to have you here. This login area offers you Free Downloads, Request for Purchase of Product, Update your profile and many more. </div></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td>Please use the Navigation area at the right to access your desire.... </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center" style="font-size:16px; border:1px solid #333333; background-color:#FFFFCC"><a href="../downloads/stdsp.php"><font color="#009933"><strong>Free Saral TDS for Quarter 1 of FY 2009-10 &gt;&gt;</strong></font></a></div></td>
  </tr>
  <tr>
    <td><div align="center"><a href="../downloads/ses.php"><strong><font color="#CC3300">Saral eSign: Digitally Sign Form 16</font></strong></a> <strong>|</strong> <a href="../buy/getquote.php"><strong><font color="#0066DD">Get Quotation:  Payroll Software</font></strong></a></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="right"><a href="../buy/pricelist.php"><strong><font color="#0066CC">Latest Product Pricing Available here &raquo;</font></strong></a></div></td>
  </tr>
  <tr>
    <td class="pagebodyheading"><strong>Other Products most downloaded:</strong></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td align="center"><div align="center"><a href="../downloads/sit.php"><img src="../images/sitricon.gif" alt="ITR" width="37" height="35" border="0" /></a></div></td>
        <td valign="middle"><div align="justify"><a href="../downloads/sit.php"><strong>Saral IncomeTax</strong> - Software for Tax Computation and ITR Forms/XML</a> for 2008-09.</div></td>
        <td align="center"><div align="center"><a href="../downloads/stdsi.php"><img src="../images/stdscicon.gif" alt="Saral TDS" width="32" height="32" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/stdsi.php"><strong>Saral TDS Institutional</strong> - eTDS Software with Automatic Tax Computation</a></td>
      </tr>
      <tr>
        <td width="40" align="center"><div align="center"><a href="../downloads/stdsc.php"><img src="../images/stdscicon.gif" alt="Saral TDS" width="32" height="32" border="0" /></a></div></td>
        <td width="225" valign="middle"><a href="../downloads/stdsc.php"><strong>Saral TDS Corporate</strong> - eTDS Software with Automatic Tax Computation<font color="#990000"> [100 Employees]</font></a></td>
        <td align="center"><div align="center"><a href="../downloads/stdsp.php"><img src="../images/stdspicon.gif" alt="Saral TDS" width="32" height="32" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/stdsp.php"><strong>Saral TDS Professional</strong> - eTDS Software</a></td>
      </tr>

      <tr>
        <td align="center"><div align="center"><a href="../downloads/sto.php"><img src="../images/stoicon.gif" alt="Saral TaxOffice" width="32" height="32" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/sto.php"><strong>Saral TaxOffice</strong> - Complete Tax Software</a></td>
        <td align="center"><div align="center"><a href="../downloads/spp.php"><img src="../images/sppicon.gif" alt="Saral PayPack" width="32" height="32" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/spp.php"><strong>Saral PayPack</strong> - Complete Payroll Solution</a></td>
      </tr>

      <tr>
        <td align="center"><div align="center"><a href="../downloads/svh.php"><img src="../images/svhicon.gif" alt="Saral VAT100" width="32" height="32" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/svh.php"><strong>Saral VAT100</strong> - Karnataka VAT return generation Software</a></td>
        <td align="center"><div align="center"><a href="../downloads/svi.php"><img src="../images/sviicon.gif" alt="Saral VATInfo" width="34" height="29" border="0" /></a></div></td>
        <td valign="middle"><a href="../downloads/svi.php"><strong>Saral VATInfo</strong> - Karnataka VAT laws in CD</a></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td valign="middle">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td valign="middle">&nbsp;</td>
      </tr>

    </table>    </td>
  </tr>
  <tr>
    <td class="pagebodyheading"><strong>Nearest contact point </strong>for you is: </td>
    </tr>
  <tr>
    <td><? echo($distdealers); ?> </td>
  </tr>
  <tr>
    <td class="pagebodyheading"><strong>Forum on Payroll.</strong></td>
  </tr>
  <tr>
    <td><div align="justify">For <strong>Free Payroll Discusion, Queries, etc visit <a href="http://www.forum.relyonsoft.com" target="_blank">www.forum.relyonsoft.com</a></strong>. This will enable you to lot of promotional offers and editorial appraisals. </div></td>
  </tr>
  <tr>
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
