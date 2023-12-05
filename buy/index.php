<?php

include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

if($_POST['send'] == "Place the Order Now")
{
	//Get the product name
	$productname = $_POST['productname'];
	
	//Get Request date and time
	$requestdate = datetimelocal("Y-m-d"); 
	$requesttime = datetimelocal("H:i");
	
	//Get the IP Address
	$requestip = getenv("REMOTE_ADDR");
	
	//Insert this record to Database 'buyonline'
	$query = "INSERT INTO buyonline (userid,emailid,product,date,time,ip) VALUES ('".$userid."','".$emailid."','".$productname."','".$requestdate."','".$requesttime."','".$requestip."')";
	$result = runmysqlquery($query);
	
	$FromName = "Relyon";
	$FromAddress =  "bigmail@relyonsoft.com";
	$MailSubject = "Dear ".$name.", Thank you for Placing order for purchase of ".$productname.".";
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$FromName.' <'.$FromAddress.'>' . "\r\n";
	$msg = file_get_contents("../inc/mail-po-user.htm");
	$array = array();
	$array[] = "##NAME##%^%".$name;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##ADDRESS##%^%".$address;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##DISTRICT##%^%".$district;
	$array[] = "##STATE##%^%".$state;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##EMAILID##%^%".$emailid;
	$array[] = "##REQUESTDATE##%^%".$requestdate;
	$array[] = "##REQUESTTIME##%^%".$requesttime;
	$array[] = "##REQUESTIP##%^%".$requestip;
	$array[] = "##PRODUCTNAME##%^%".$productname;
/*	$array = array(
		"##NAME##" => $name,
		"##COMPANY##" => $company,
		"##ADDRESS##" => $address,
		"##PLACE##" => $place,
		"##DISTRICT##" => $district,
		"##STATE##" => $state,
		"##PHONE##" => $phone,
		"##EMAILID##" => $emailid,
		"##REQUESTDATE##" => $requestdate,
		"##REQUESTTIME##" => $requesttime,
		"##REQUESTIP## " => $requestip ,
		"##PRODUCTNAME##" => $productname,
	);*/
	$msg = replacemailvariablenew($msg,$array);
	$RelyonToemail = "webmaster@relyonsoft.com";
	if (mail($name." <".$emailid.">", $MailSubject, $msg, $headers."Reply-To: ".$RelyonToemail."\r\n"))
	{
		//Send a master BCC to bigmail@relyonsoft.com
		$headers .= 'Bcc: <bigmail@relyonsoft.com>';
		$headers .= "\r\n";
		
		//Body for the Relyon Softech
		$msg = file_get_contents("../inc/mail-po-relyon.htm");
		$msg = replacemailvariablenew($msg,$array);
		mail("Online Purchase Order <".$RelyonToemail.">", $productname." Purchase Order by " . $company , $msg, $headers."Reply-To: ".$emailid."\r\n");
	}
	$message = "Thank you for Giving 'Purchase Order' for ".$productname.". We will get back to you shortly with acceptance.";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title> Relyon Product Purchase Order</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
<script src="../functions/po.js" language="javascript"></script>
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
    <td width="100%" class="pagebodyheading"><strong>Relyon Product Purchase Order** </strong></td>
    </tr>
<?  
$style1 = "none";
$style2 = "none";
if($message <> "")
$style1 = "block";
?> 
<tr class="content" style="display: <? echo($style1); ?>">
    <td>&nbsp;</td>
  </tr>
<tr style="display: <? echo($style1); ?>">
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999"><div align="center"><font color="#339900"><? echo($message); ?></font></div></td>
  </tr>
  <tr class="content" style="display: <? echo($style1); ?>">
    <td>&nbsp;</td>
  </tr>

<?    
if($message == "")
$style2 = "block";
?>
  <tr class="content" style="display: <? echo($style2); ?>">
    <td><div align="justify">Please select a product to order it online. Ordering a Relyon Product through here, confirms your &quot;Order of Purchase&quot; for the selected product. </div></td>
  </tr>
  
  <tr style="display: <? echo($style2); ?>">
    <td valign="top">&nbsp;</td>
  </tr>
  
  <tr style="display: <? echo($style2); ?>">
    <td valign="top">
	<form action="" method="post" name="Buyonline" id="Buyonline" onsubmit="return valid(this)">
	<table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="90">&nbsp;</td>
        <td width="434">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Product: </strong></td>
        <td><select name="productname" class="formfields" id="productname">
        <option value="" selected="selected"> - Select a Product - </option>
        <option value="Saral IncomeTax" >Saral IncomeTax</option>
        <option value="Saral PayPack" >Saral PayPack</option>
		<option value="SaralTDS Professional" >SaralTDS Professional</option>
		<option value="SaralTDS Corporate" >SaralTDS Corporate</option>
		<option value="SaralTDS Institutional" >SaralTDS Institutional</option>
		<option value="Saral VAT100" >Saral VAT100</option>
		<option value="Saral VATInfo" >Saral VATInfo</option>
		<option value="Saral AIR" >Saral AIR</option>
		<option value="Saral TaxOffice">Saral TaxOffice</option>
		<option value="SaralVAT XML">SaralVAT XML</option>
          </select>
&nbsp;	  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input name="process" type="checkbox" id="process"  onclick="confirmdisplay('confirmdisplay',this)"/> <label for="process"> Confirm. </label></td>
      </tr>
      <tr><td colspan="2"><table width="100%" cellpadding="2" cellspacing="0" id="confirmdisplay" style="display:none">
	  <tr>
        <td colspan="2"><div align="justify"><font color="#FF0000">By Clicking &quot;Order Now&quot;, you confirm for purchase of selected product and authorise Relyon to supply the same at its Price. If you wish to continue placing the order, click on "Order Now".</font> </div></td>
        </tr>
      <tr>
        <td width="90">&nbsp;</td>
        <td width="428"><input name="send" type="submit" class="formbutton" id="send" value="Place the Order Now" /></td>
      </tr>
	  </table></td></tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</form>	</td>
  </tr>
  
  <tr style="display: <? echo($style2); ?>">
    <td valign="top">&nbsp;</td>
  </tr>


  <tr class="content">
    <td><div align="justify">
      <p>**Note: </p>
      <ol>
        <li>Submitting your order here is equivalent to manually signing and sending a "Purchase Order" to Relyon. </li>
        <li>For fraud prevention purposes, your IP and submitted details are noted during ordering. </li>
        <li>&quot;<em>Once ordered online cannot be cancelled</em>&quot;. </li>
      </ol>
    </div></td>
  </tr>
  <tr class="content">
    <td><div align="justify"><font size="1">&nbsp;</font></div></td>
  </tr>
</table></td>
<td rowspan="3" class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px">
  <? include("../inc/navigation.php"); ?></td>
</tr>
<tr>
  <td valign="top" style="PADDING-RIGHT: 0px; PADDING-LEFT: 0px; PADDING-BOTTOM: 0px; height: 2px; PADDING-TOP: 0px"></td>
  </tr>
<tr>
  <td width="218" height="100%" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("../inc/profilecard.php"); ?></td>
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
