<?php
//Check whether logged in and cookies are present
include("cookiecheck.php"); 
//Connect to server and database. Fetch and assign all fields from database related to login email ID
include("allfields.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Buy Relyon Products Online...</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/main.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
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
	<a href="http://www.relyonsoft.com/aboutus/index.htm" target="_blank">Company</a> | 
	<a href="http://www.relyonsoft.com/products.htm" target="_blank">Relyon Products</a> | 
	<a href="http://www.relyonsoft.com/contactus.php" target="_blank">Contact Us</a>		</TD>
        </TR>
        <TR>
          <TD bgColor=#3f7c5f colSpan=2 height=1><IMG height=1 alt="" 
          width=1></TD></TR></TABLE>
	</td>
  </tr>
</table>
</td></tr>
<tr valign="top">
<td><div>&nbsp;</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" style="padding-right:10px"><div align="right"><a href="logout.php">Logout</a></div></td>
</tr>
<tr>
<td width="550" rowspan="3" valign="top" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Buy Relyon Products - Single User Online</strong></font></td>
    </tr>

  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td style="border:solid 1px #999999"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td><font color="#FF3300"><strong>ivyOffice - Siingle User Version | $179 Only</strong></font></td>
      </tr>
      <tr>
        <td><font color="#009933">[For Limited countries only..!! - Such as: India, Thailand, Srilanka, Saudi Arabia, etc]</font></td>
      </tr>
      <tr>
        <td>
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <div align="right">
  <input type="hidden" name="cmd" value="_s-xclick">
  <input type="image" src="../images/ivy_proceed_buy.jpg" border="0" name="submit" alt="Purchase ivyOffice">
  <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
  <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
          </div>
        </form>        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td style="border:solid 1px #999999"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr class="content">
        <td><font color="#FF3200"><strong>Saral ITR Single User License Online - $40** Only </strong></font></td>
      </tr>
      <tr>
        <td>The cost is approximate Rs. 1500/- [INR] plus taxes. </td>
      </tr>
      <tr class="content">
        <td><form action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <div align="right">
  <input type="hidden" name="cmd" value="_s-xclick">
  <input type="image" src="../images/buy_itr.jpg" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
  <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
  <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
          </div>
        </form></td>
      </tr>
      <tr class="content">
        <td>&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="justify"> 
      <p>Notes: </p>
      <ol>
        <li>No shipping of the product will be done for ONLINE PURCHASES. </li>
        <li>On request shipping is available &quot;Once&quot; through a written email with ORDER ID and shipping address to info@relyonsoft.com.</li>
        <li>The amount paid for particular product, cannot be adjusted for any other  product or service of, either Relyon or others.</li>
        <li>The payment once processed cannot be refund.</li>
      </ol>
    </div></td>
  </tr>
</table></td>
<td rowspan="3" class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px">
<? include("incnavigation.php"); ?></td>
</tr>
<tr>
  <td valign="top" style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; height: 2px; PADDING-TOP: 0px"></td>
  </tr>
<tr>
  <td width="218" height="100%" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td colspan="2" style="border-bottom: solid 1px #3f7c5f"><div align="center"><strong>Your Profile </strong></div></td>
      </tr>
      <tr>
        <td valign="top" style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; height: 4px; PADDING-TOP: 0px"></td>
      </tr>
      <tr>
        <td colspan="2"><? echo($name); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize"><? echo($company); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize"><? echo($address); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize"><? echo($place); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize"><? echo($state); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize">Phone: <? echo($phone); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize">Email : <? echo($emailid); ?></td>
      </tr>
      <tr>
        <td colspan="2" class="elevensize">Existing Customer : <? echo($existingcust); ?></td>
      </tr>
      <tr>
        <td width="10%">&nbsp;</td>
        <td width="90%">&nbsp;</td>
      </tr>
  </table>
  
  </td>
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
