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
<script src="../functions/contactdetailsreport-leads.js" language="javascript"></script>
<script src="../functions/jsfunctions.js" language="javascript"></script>
<script src="../functions/datepickercontrol.js" language="javascript"></script>
<link rel="stylesheet" type="text/css" href="../css/datepickercontrol.css">
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
        <td width="391" valign="middle"><div align="justify">Contact details from LMS.</div></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td><form action="" method="post" name="submitform" id="submitform" onsubmit="return false"><table width="100%" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td colspan="5"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border: 1px solid #CCCCCC">
          <tr>
            <td width="9%" align="left"><label>
              <input type="checkbox" name="leaddate" id="leaddate" value="leaddate"  onclick="enabledisableleaddate()" />
            </label></td>
            <td width="91%" align="left"><strong> Consider lead Date</strong></td>
          </tr>
          <tr>
            <td colspan="2" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                  <td width="27%" align="left">From Date:</td>
                  <td width="73%" align="left"><input name="fromdate" type="text" class="diabledatefield" id="DPC_fromdate" size="30" autocomplete="off" value="<? echo(datetimelocal('d-m-Y')); ?>" readonly="readonly" disabled="disabled" /></td>
                </tr>
                <tr>
                  <td align="left">To Date:</td>
                  <td align="left"><input name="todate" type="text" class="diabledatefield" id="DPC_todate" size="30" autocomplete="off" value="<? echo(datetimelocal('d-m-Y')); ?>"  readonly="readonly" disabled="disabled" /></td>
                </tr>

            </table></td>
          </tr>
        </table></td>
        </tr>
      
      <tr>
        <td width="18%" valign="top">State:</td>
        <td width="37%" valign="top"> <select name="state" class="formfields" id="state" onchange="districtselect('state','districtdiv')">
          <option value="">Select A State</option>
          <? include('../inc/state.php'); ?>
        </select></td>
        <td colspan="3" rowspan="5" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2" style="border:1px solid #CCCCCC">
        <tr>
          <td width="15"><strong>Products:</strong></td>
        </tr>
          <tr>
            <td><div style="height:160px; overflow:scroll">
                <? include('../inc/product-report.php'); ?>
            </div></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td valign="top">District:</td>
        <td valign="top"><div id="districtdiv">
          <select name="district" class="formfields" id="district" style="width:180px;">
            <option value = "">Select a State First</option>
          </select>
        </div></td>
        </tr>
      <tr>
        <td valign="top">Region:</td>
        <td valign="top"><select name="region" id="region"  style="width:180px"  class="formfields">
          <option value="" selected="selected"> All</option>
          <option value="Bangalore" > Bangalore</option>
          <option value="CSD" > CSD</option>
          <option value="KKG" > KKG</option>
        </select></td>
        </tr>
      <tr><td colspan="2"><strong>Unique records by: </strong>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
        <tr><td valign="top"><label for="none"><input type="radio" name="uniquerecords" id="none" value="none" checked="checked" /></label> 
          None</td>
          <td valign="top"><label for="uniquecellno"><input type="radio" name="uniquerecords" id="uniquecellno" value="uniquecellno" />
            Cell Number</label></td>
          </tr>
          <tr><td>&nbsp;</td><td>&nbsp;</td><td width="5%"><input type="checkbox" name="selectordeselect" id="selectordeselect" onclick="selectdeselectall()" />
              </td>
            <td width="40%"><strong><label for="selectordeselect">Select All</label></strong></td>
          </tr>
      <tr><td colspan="5" id="form-error" height="35">&nbsp;</td></tr>
      <tr>
        <td colspan="5"><div align="center">
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
