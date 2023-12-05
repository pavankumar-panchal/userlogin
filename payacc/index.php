<?php

include("../functions/phpfunctions.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment to Relyon Accounts Department</title>
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
<td colspan="2" style="padding-right:10px"><div align="right"></div></td>
</tr>
<tr>
<td width="550" height="100%" valign="top" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><strong>Payment to Relyon Accounts Department</strong></td>
    </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>

  <tr class="content">
    <td><div align="justify">Please enter the code received from Relyon representative to proceed with the payment.</div></td>
  </tr>
  
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td valign="top">
	<form action="http://userlogin.relyonsoft.com/payacc/pay.php" method="post" name="spppayment" id="spppayment" onsubmit="return false;">
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="90">&nbsp;</td>
        <td colspan="2"><font color="#FF0000"><? if($_GET['error'] <> '') echo("Invalid Code Entered."); ?>&nbsp;</font></td>
      </tr>
      <tr>
        <td><strong>Enter the Code:</strong></td>
        <td colspan="2"><label>
          <input name="inventorycode" type="text" class="formfields" id="inventorycode" maxlength="5" />
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="proceed" type="button" class="formbutton" id="proceed" value="Proceed for payment" onclick="validatecode();" />
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="549"><div align="right"><img src="../images/icicibank.gif" alt="ICICI Bank: Secure Payment Gateway" width="241" height="64" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
        <td width="99" rowspan="2"><div align="right"><a href="https://seal.verisign.com/splash?form_file=fdf/splash.fdf&amp;lang=EN&amp;dn=payseal.icicibank.com" target="_blank"><img src="../images/verisignsealwhite.gif" alt="VeriSign Secured" width="98" height="104" border="0" /></a></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><div align="right"><strong><font color="#BE340A">PAYSEAL: ICICI Bank Secure Payment Gateway</font></strong></div></td>
        </tr>
    </table>
</form>	
<script>
function validatecode()
{
	var inventorycode = document.getElementById('inventorycode');
	if(inventorycode.value == '')
	{
		alert("Code cannot be Blank");
		inventorycode.focus();
	}
	else
	{
		document.getElementById('spppayment').submit();
	}
}
</script></td>
  </tr>
</table></td>
<td class="columnBorder">&nbsp;</td>
</tr>
</table>	
<div>&nbsp;</div><br>
</td>
</tr>
<tr valign="top"><td><? include("../inc/footer.php"); ?></td>
</tr>
</table>
</body>
</html>
