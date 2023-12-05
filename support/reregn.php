<?php
//Check whether logged in and cookies are present
include("cookiecheck.php"); 
//Connect to server and database. Fetch and assign all fields from database related to login email ID
include("allfields.php"); 
include("dealerfields.php"); 

if($_REQUEST['send'] <> "")
{
	//get the details
	$productname = $_REQUEST['product'];
	$version = $_REQUEST['version'];
	$lockcardno = $_REQUEST['slno'];
	$pinno = $_REQUEST['pinno'];
	$computerid = $_REQUEST['computerid'];
	$computersign = $_REQUEST['computersign'];
	$purchasedealer = $_REQUEST['purchasedealer'];
	$problem = $_REQUEST['problem'];
	$type = "R"; //S for Support Request, R for Re-Regn

	//If it is CSD Region, send it to CSD
	if($managedarea == "3" || $managedarea == "4")
	{
		$Toemail = "dealers@relyonsoft.com";
		$dept = "RCSD";
	}
	//If it is other Region, send it to general
	else
	{
		$Toemail = "info@relyonsoft.com";
		$dept = "RGeneral";
	}
	
	//Get Request date and time
	$differencetolocaltime=0;
	$new_U=date("U")+$differencetolocaltime*3600;
	$requestdate = date("Y-m-d", $new_U); 
	$requesttime = date("H:i", $new_U); 
	
	//Insert this record to Database 'support'
	
	mysqli_query("INSERT INTO support (emailid,productname,version,lockcardno,pinno,computersign,computerid,purchasedealer,problem,date,type,dept) 	VALUES 	('".$emailid."','".$productname."','".$version."','".$lockcardno."','".$pinno."','".$computersign."','".$computerid."','".$purchasedealer."','".$problem."','".$requestdate."','".$type."','".$dept."')");

	
	//Get complaint Number checking the maximum entered number
	$complaintfetch = mysqli_query("SELECT MAX(compid) AS compid FROM support") or die(mysqli_error());
	$row = mysqli_fetch_array($complaintfetch);
	$compid = $row['compid'];
	
	//Send email to Relyon Along with CC to respective Dealer
	$FromName = "Relyon Web";
	$FromAddress =  $emailid;
	$MailSubject = "Re-Registration Request Number for ".$productname." - ".$compid.".";
	$msg = "<body style='font-family:Arial, Helvetica, sans-serif; font-size:12px'>
	Below is the Re-Registration request submitted through Relyonsoft.com<br>
	&nbsp;<br>
	<strong>Name: </strong>".$name."<br>
	<strong>Company: </strong>".$company."<br>
	<strong>Address: </strong> ".$address.", ".$place.", ".$state.",<br>
	<strong>Phone: </strong>".$phone."<br>
	&nbsp;<br>
	<strong>Product: </strong>".$productname."<br>
	<strong>Version: </strong>".$version."<br>
	&nbsp;<br>
	<strong>Scratch Card No: </strong>".$lockcardno."<br>
	<strong>PIN Number: </strong>".$pinno."<br>
	<strong>Computer ID: </strong>".$computerid."<br>
	<strong>Computer Sign: </strong>".$computersign."<br>
	&nbsp;<br>
	<strong>Dealer Name: </strong>".$purchasedealer."<br>
	&nbsp;<br>
	<strong>Reason:</strong><br>
	".$problem."<br>
	&nbsp;<br>
	With Thanks,<br>
	&nbsp;<br>
	".$name."<br>
	</body>";
	
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$FromName.' <'.$FromAddress.'>' . "\r\n";
	$headers .= 'Cc: <'.$dlremail.'>';
	$headers .= "\r\n";
	if (mail("Relyon <".$Toemail.">", $MailSubject, $msg, $headers))
	{
	
		//Send email to Customer
		$FromName = "Relyon Web";
		$FromAddress =  $Toemail;
		$MailSubject = "Re-Registration Request Number for ".$productname." - ".$compid.".";
		$msg = "<body style='font-family:Arial, Helvetica, sans-serif; font-size:12px'>
		Dear ".$name.",<br>
		&nbsp;<br>
		Thanks for contacting Relyon. Your Re-Registration Request Number Number is ".$compid.".<br>
		&nbsp;<br>
		Please Call Relyon, in case if you don’t receive any reply with in next 24 hours. Dont forget to quote the complaint number for these interactions with Relyon.<br>
		&nbsp;<br>
		Relyon Operations Department<br>
		</body>";
		mail($name." <".$emailid.">", $MailSubject, $msg, $headers);
	}
	
	$message = "Your  request is successfully submitted to Relyon Operations Department. Please note your Request Request Number Number - ".$compid.".";
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title> Re-Registration Requests from Customers</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
<script src="../functions/reregn.js" language="javascript"></script>
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
    <td class="pagebodyheading"><strong>Re-Registration for Relyon Product</strong> - We at your service. </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr style="display: <? if($message <> "") echo("block"); else echo("none"); ?>">
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999"><div align="center"><font color="#339900"><? echo($message); ?></font></div></td>
  </tr>
  <tr style="display: <? if($message == "") echo("block"); else echo("none"); ?>">
    <td>
	<form action="#" method="post" name="supportform" id="supportform" onSubmit="return valid(this)">

	<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" valign="top"><div align="justify"><font color="#FF9900">Note: This section is only for our customers. You should provide proper serial number of Hardware lock/Scratch card. Giving junk/dummy details will be considered to be kind of fraud and may be questioned later. For the same reason, We will be noting your IP address and Time of support request. </font></div></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="43%" valign="top" nowrap="nowrap">Product Name: </td>
    <td width="57%" valign="top"><select name="product" id="product">
        <option value="" selected="selected"> - Select a Product - </option>
        <option value="Saral PayPack">Saral PayPack</option>
        <option value="Saral eIT">Saral eIT</option>
        <option value="SaralTDS - Professional">SaralTDS - Professional</option>
        <option value="SaralTDS - Corporate">SaralTDS - Corporate</option>
        <option value="SaralTDS - Institutional">SaralTDS - Institutional</option>
        <option value="Saral VAT100">Saral VAT100</option>
        <option value="Saral VATInfo">Saral VATInfo</option>
        <option value="Survey Design">Survey Design</option>
        <option value="Survey Aid">Survey Aid</option>
        <option value="Saral FBT">Saral FBT</option>
        <option value="Saral AIR">Saral AIR</option>
        <option value="Vethanam">Vethanam</option>
        <option value="Saral CompTax">Saral CompTax</option>
        <option value="Saral PFESI">Saral PFESI</option>
        <option value="Petty Cash">Petty Cash</option>
      </select></td>
    </tr>
  <tr>
    <td valign="top" nowrap="nowrap">Version No of Product</td>
    <td valign="top"><input name="version" type="text" id="version" size="30" maxlength="5"/></td>
    </tr>
  <tr>
    <td valign="top" nowrap="nowrap">Scratch Card No. </td>
    <td valign="top"><input name="slno" type="text" id="slno" size="30" maxlength="5"/></td>
    </tr>
   <tr>
    <td valign="top" nowrap="nowrap">Scratch Card Pin Number </td>
    <td valign="top"><input name="pinno" type="text" id="pinno" size="30" maxlength="14"/></td>
    </tr>
   <tr>
    <td valign="top" nowrap="nowrap">Computer ID</td>
    <td valign="top"><input name="computerid" type="text" id="computerid" size="30" maxlength="15"/></td>
    </tr>
   <tr>
    <td valign="top" nowrap="nowrap">Computer Sign</td>
    <td valign="top"><input name="computersign" type="text" id="computersign" size="30" maxlength="17"/></td>
    </tr>
   <tr>
    <td valign="top" nowrap="nowrap">Dealer Name</td>
    <td valign="top"><input name="purchasedealer" type="text" id="purchasedealer" size="30" maxlength="50"/></td>
    </tr>
  <tr>
    <td valign="top" nowrap="nowrap">&nbsp;</td>
    <td valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td valign="top" nowrap="nowrap">Justification/Reason: </td>
    <td valign="top"><textarea name="problem" cols="40" rows="5" id="problem"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input name="send" type="submit" id="send" value="Send to Relyon" style="border:#b0b0b0 solid 1px; background-color:#dbe6de" /> &nbsp;&nbsp;<input name="reset" type="reset" id="reset" value="Clear" style="border:#b0b0b0 solid 1px; background-color:#dbe6de" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form></td>
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
