<?php
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
	
//connect to Server and database
mysqli_connect("176.9.19.244","relyon_newuser","hotelleela28") or die(mysqli_error());
mysqli_select_db("relyon_userlogin2") or die(mysqli_error());

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Downloader Details</title>
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
<form method="post" action="#">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="3" class="pagebodyheading"><font size="-1"><strong>Get list of email.</strong></font></td>
    </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="141"><div align="center"><img src="../images/admin.gif" width="49" height="53" border="0"/></div></td>
        <td width="391" valign="middle"><div align="justify">Here you can get the email-list for the selected product, who have downloaded that product!!</div></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td colspan="3" class="pagebodyheading"><font size="-1"><strong>Select a product and proceed..</strong></font></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
<?  
if($errormessage <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#FF0000">'.$errormessage.'</font></div></td>
  </tr>');
?>  <tr>
    <td colspan="3">	 	</td>
  </tr>
  <tr>
    <td colspan="3"><font color="#FF0000">This is not functioning properly... Inconvinience is regreted...</font></td>
    </tr>
  <tr>
    <td width="24%"><strong>Product</strong>: </td>
    <td width="35%">
    <select name="product" id="product">
      <option value="" selected="selected">Select</option>
<?
	//Pick the list of products and show it in the drop-down.
	$prodfetch = mysqli_query("SELECT DISTINCT `product` FROM downloads ORDER BY product") or die(mysqli_error());
	while($prodrow = mysqli_fetch_array($prodfetch))
		{
			$prodname = $prodrow['product'];
			echo('<option value="'.$prodname.'">'.$prodname.'</option>');
		}
?>      
            </select></td>
    <td width="41%"><input name="getlist" type="submit" id="getlist" value="Get List" style="border:#b0b0b0 solid 1px; background-color:#dbe6de" /></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
<?
//Check whether freshly loaded page or Submitted page
if($_REQUEST['getlist'] <> "")
{
	$product = $_REQUEST['product'];
	$errormessage = "";
	$list = "";

	if($product == "")
		$errormessage = "Please Select a Product";
		echo($errormessage);

	if($errormessage == "")
	{
		$listfetch = mysqli_query("SELECT DISTINCT `emailid` FROM downloads WHERE `product` = '".$product."' AND `emailid` <> ''") or die(mysqli_error());
		$count = 1;
		echo('<TABLE cellSpacing=0 cellPadding=2 width=100% border=1 style="border:#b0b0b0 solid 1px; background-color:#dbe6de">');
		echo('<TR vAlign=top><TD width=10% colspan="4"><strong>List of Email IDs Downloaded '.$product.':</strong></TD></TR>');
		echo("<TR vAlign=top><TD width=10%>Sl No</TD><TD width=30%>Email ID</TD><TD width=30%>Name</TD><TD width=30%>District</TD></TR>");
		
		while($listrow = mysqli_fetch_array($listfetch))
		  {
			  $emailfetch = mysqli_query("SELECT `name`, `district` FROM users WHERE `emailid` = '".$listrow['emailid']."'") or die(mysqli_error());
			  $emailrow = mysqli_fetch_array($emailfetch);

			  $list = "<TR vAlign=top><TD>".$count."</TD><TD>".$listrow['emailid']."</TD><TD>".$emailrow['name']."</TD><TD>".$emailrow['district']."</TD></TR>";
			  $count++;
			  echo($list);
		  }
		
		echo("</TABLE>");
	}
}
?></td>
  </tr>
  <tr>
    <td colspan="3">
<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
        <TR vAlign=top>
          <TD width="50%" noWrap>&nbsp;</TD>
		  <TD width="50%">&nbsp;</TD>
</TR>
</TABLE>	</td>
  </tr>
</table>
</form>
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
