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
<title>Buy Relyon Products Online</title>
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
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="content">
  <tr>
    <td width="100%" class="pagebodyheading"><strong>Buy Relyon Products/Services</strong></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td><div align="justify">
      <p>You can purchase  new license for below Relyon products over here. You can proceed for respective product and make the payment through CREDIT / DEBIT card. On successfull payment, a PIN Number will be isued, against which you can download and register the software.</p>
      <p>Kindly make sure your profile is up-to-date. (Visible on Right Bottom of this page). You can also <a href="/profile"><font color="#FF0000">edit your profile</font></a>, before making the purchase.</p>
      <p>Note: Only new licenses can be purchased over here for Single User usage. If you are an existing customer of that product, please <a href="http://www.relyonsoft.com/contactus.php">contact Relyon</a> for Updation.</p>
    </div></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:16px; background-color:#FFFFCC; border: 1px solid #333333"><font color="#006633"><strong>Saral TDS Professional</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="23%" valign="top"><img src="../images/tds-box-prof.jpg" alt="SaralTDS Professional" width="100" height="100" border="0" /></td>
        <td width="77%" valign="top"><div align="justify">
          <div align="justify">Saral TDS - Professional edition automates the  preperation in TDS Returns. This version comes with basic needs towards  TDS returns, such as, <strong>eTDS Returns for Salaries, Non-Salaries, TCS Returns, efiling [fvu output], TDS/TCS Certificates</strong> and so on..</div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/buyonline/pay.php?prd=tdsp" target="_blank">Proceed (Saral TDS Professional : Rs. 2600/-) &gt;&gt;</a></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:16px; background-color:#FFFFCC; border: 1px solid #333333"><font color="#006633"><strong>Saral TDS Corporate</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="23%" valign="top"><img src="../images/tds-box-corp.jpg" alt="SaralTDS Corporate" width="100" height="100" border="0" /></td>
        <td width="77%" valign="top"><div align="justify">
          <div align="justify">Saral TDS - Corporate edition enhanses the  automation in preperation of TDS Returns. This version comes with added  features for eTDS returns, such as<strong> Tax Estimation for upto 100 Employees, Versatile MIS Reports</strong> and so on...</div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/buyonline/pay.php?prd=tdsc" target="_blank">Proceed (Saral TDS Corporate : Rs. 4550/-) &gt;&gt;</a></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:16px; background-color:#FFFFCC; border: 1px solid #333333"><font color="#006633"><strong>Saral TDS Institutional</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="23%" valign="top"><img src="../images/tds-box-inst.jpg" alt="SaralTDS Institutional" width="100" height="100" border="0" /></td>
        <td width="77%" valign="top"><div align="justify">
          <div align="justify">Saral TDS - Institutional edition enhanses the  automation in preperation of TDS Returns. This version comes with added  features for eTDS returns, such as <strong>Tax Estimation for unlimited number of Employees</strong>, Versatile MIS Reports and so on...</div>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/buyonline/pay.php?prd=tdsi" target="_blank">Proceed (Saral TDS Institutional : Rs. 8450/-)&gt;&gt;</a></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:16px; background-color:#FFFFCC; border: 1px solid #333333"><font color="#FF0000"><strong>Saral  IncomeTax</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="23%" valign="top"><img src="../images/logo-sit.gif" alt="SaralTDS Professional" width="149" height="60" border="0" /></td>
        <td width="77%" valign="top"><div align="justify">Saral IncomeTax is the software for filing of Indian ITR Forms [ITR-1  to ITR-8] easily from offline/online computer. This covers Computation  of Income Tax as well as generation of ITR, either by the way of XML  [eFiling] or a print out [Paper Filing].</div></td>
      </tr>
    </table></td>
  </tr>
  <tr></tr>
  <tr>
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/buyonline/pay.php?prd=sit" target="_blank">Proceed (Saral IncomeTax : Rs. 3250/-) &gt;&gt;</a></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="font-size:16px; background-color:#FFFFCC; border: 1px solid #333333"><font color="#FF3300"><strong>Saral  TaxOffice</strong></font></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="23%" valign="top"><img src="../images/logo-sto.gif" alt="SaralTDS Professional" width="128" height="60" border="0" /></td>
        <td width="77%" valign="top"><div align="justify">Saral TaxOffice is a complete Taxation software solution for a  Chartered Accountant [CA] or any Tax Practitioner. It automates all the  activities related to Tax Compliance and Back office.</div></td>
      </tr>
    </table></td>
  </tr>
  <tr></tr>
  <tr>
    <td><div align="right" style="font-size:16px"><strong><a href="http://userlogin.relyonsoft.com/buyonline/pay.php?prd=sto" target="_blank">Proceed (Saral TaxOffice : Rs. 5200/-) &gt;&gt;</a></strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
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
