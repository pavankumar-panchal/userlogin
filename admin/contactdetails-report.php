<?php
include('../functions/phpfunctions.php');

//Check whether logged in and cookies are present
session_start();

if(isset($_SESSION['verifyid']))
{
	$adminuser = $_COOKIE['validemailid'];
	//If cookies are wrong, redirect back to login
	if($_SESSION['verifyid'] <> "10101102")
		header("Location:./index.php");
}
else //If cookies are not available redirect back to login
	header("Location:./index.php");




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Registrations and Download Stats</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
<meta name="verify-v1" content="gBwvVqcU7Ol0vs0kLK/O3gBbLYq7Q+WXxlFJCtOfp6s=" />
<script>
var rotateMsg = true;
function MsgStatus() 
{
	if(rotateMsg) 
	{
		window.status = '';
		window.defaultStatus = ' Relyon User Login Area';
	}
	if(!rotateMsg) 
	{
		window.status = '';
		window.defaultStatus = ' All rights reserved for Relyon Softech Ltd';
	}
	setTimeout("MsgStatus();rotateMsg=!rotateMsg", 1500);
}
MsgStatus();
</SCRIPT>
<script src="../functions/contactdetailsreport.js" language="javascript"></script>
<script src="../functions/jsfunctions.js" language="javascript"></script>

</head>
<body>
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
<tr valign="top"><td>
  <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  
  <tr>
    <td width="17%"><div align="left"><a href="http://userlogin.relyonsoft.com"><img src="../images/logo.jpg" alt="Relyon Softech Ltd" border="0"/></a></div></td>
    <td width="83%" valign="top"><div>&nbsp;</div><div>&nbsp;</div>
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TR vAlign=top>
          <TD valign="middle" noWrap>
            <H4 style="MARGIN-BOTTOM: 4px"><FONT size=-1>IT's For Your Convenience </FONT></H4>
			</TD>
          <TD noWrap align=right style="padding-right:10px">
	<a href="http://www.relyonsoft.com/aboutus/index.htm">Company</a> | 
	<a href="http://www.relyonsoft.com/products.htm">Relyon Products</a> | 
	<a href="http://www.relyonsoft.com/contactus.php">Contact Us</a>
		</TD></TR>
        <TR>
          <TD bgColor=#3f7c5f colSpan=2 height=1><IMG height=1 alt="" 
          width=1></TD></TR></TABLE>
	</td>
  </tr>
</table>
</td></tr>
<tr valign="top">
<td><div>&nbsp;
  <div align="right"><a href="logout.php">Logout</a></div>
</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="550" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Contact Details Report</strong></font></td>
    </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="141"><div align="center"><img src="../images/admin.gif" width="49" height="53" border="0"/></div></td>
        <td width="391" valign="middle"><div align="justify">Contact Details from Userlogin</div></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="submitform" id="submitform" onsubmit="return false"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      
      <tr>
        <td width="16%">State:</td>
        <td width="29%"> <select name="state" class="formfields" id="state" onchange="districtselect('state','districtdiv')">
          <option value="">Select A State</option>
          <? include('../inc/state.php'); ?>
        </select></td>
        <td width="13%">District:</td>
        <td width="42%" >
        <div id="districtdiv">
                <select name="district" class="formfields" id="district" >
                  <option value = "">- - - -Select a State First - - - -</option>
                </select>
                </div></td>
      </tr>
      <tr>
        <td height="27">Region:</td>
        <td height="27"><select name="region" id="region"  style="width:180px"  class="formfields">
          <option value="" selected="selected"> All</option>
          <option value="Bangalore" > Bangalore</option>
          <option value="CSD" > CSD</option>
          <option value="KKG" > KKG</option>
        </select></td>
        <td colspan="2">Logged in at least once:
            <input type="checkbox" name="loggedin" id="loggedin" checked="checked" />
       </td>
        </tr>
      <tr><td colspan="2"><strong>Unique records by: </strong>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
        <tr><td><label for="none"><input type="radio" name="uniquerecords" id="none" value="none" checked="checked" /> 
          None</label></td>
          <td><label for="uniquecellno"><input type="radio" name="uniquerecords" id="uniquecellno" value="uniquecellno" />
            Cell Number</label></td>
          <td>&nbsp;</td><td>&nbsp;</td></tr>
      <tr><td colspan="4" id="form-error" height="35px">&nbsp;</td></tr>
      <tr>
        <td colspan="4"><div align="center">
          <input name="download" type="submit" class="formbutton" id="download" value="Download"  onclick="formsubmit('toexcel')" />
        </div></td>
        </tr>
    </table>
    </form></td>
    </tr>
  <tr>
    <td>	 	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
<td class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("incadminnav.php"); ?></td>
</tr>
</table>	
<div>&nbsp;</div><BR>
</td>
</tr>
<tr valign="top"><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="BORDER-TOP: #3f7c5f 1px solid; MARGIN: 0px; WIDTH: 100%; HEIGHT: 45px"> 
<tr>
<td colspan="2" style="padding-left:20px"><font color="#999999">Copyright &copy; 2007 Relyon Softech Ltd; All Right Reserved.</font></td>
<td width="43%" style="padding-right:20px"><div align="right" class="footer"><font color="#999999"><a href="#">Company</a> | <a href="#">Legal</a> |  <a href="#">Site Index</a> |  <a href="#">Links</a></font></div></td>
</tr>

  
</table>
</td>
</tr>
</table>
</body>
</html>
