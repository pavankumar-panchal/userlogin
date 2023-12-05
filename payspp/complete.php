<?php

include("../functions/phpfunctions.php"); 

require_once("java/Java.inc");
$strMerchantId="00004074";
$astrFileName="/home/testkey/00004074.key";
$astrClearData;

function validateEncryptedData($astrResponseData,$astrFileName,$strMerchantId)
{
	$fp = fopen ($astrFileName,"r");
	$strModulus = fgets($fp,1024);
	$strModulus=decryptMerchantKey(trim($strModulus),$strMerchantId);
	$strExponent =fgets($fp,1024);
	$strExponent =decryptMerchantKey(trim($strExponent),$strMerchantId);
	$oEncryptionLib =new Java('com.opus.epg.sfa.java.EPGMerchantEncryptionLib');
	$astrClearData=$oEncryptionLib->decryptDataWithPrivateKeyContents($astrResponseData,$strModulus,$strExponent);
	return $astrClearData;
}

function decryptMerchantKey($strData, $strMerchantId)
{
	$strMerchantId=$strMerchantId.$strMerchantId;
	$strDecryptData=decryptData($strData,$strMerchantId);
	return $strDecryptData;
}

function decryptData($strData,$strKey)
{
	$oEPGCryptLib= new Java('com.opus.epg.sfa.java.EPGCryptLib');
	$decryptData=$oEPGCryptLib->Decrypt($strKey,$strData);
	return $decryptData;
}

if($_POST)
{
	if($_POST['DATA']==null)
	{
		print "null is the value";
		exit;
	}

	$astrResponseData=$_POST['DATA'];
	$astrClearData=validateEncryptedData($astrResponseData,$astrFileName,$strMerchantId);
	#print $astrClearData;
	parse_str($astrClearData, $output);
	$ResponseCode = java_values($output['RespCode']);
	$Message = java_values($output['Message']);
	$TxnID=java_values($output['TxnID']);
	$ePGTxnID=java_values($output['ePGTxnID']);
	$AuthIdCode=java_values($output['AuthIdCode']);
	$RRN = java_values($output['RRN']);
	$CVRespCode=java_values($output['CVRespCode']);
	$FDMSScore=java_values($output['FDMSScroe']);
	$FDMSResult=java_values($output['FDMSResult']);
	$Cookie=java_values($output['Cookie']);
	
	
	if(isset($_COOKIE['relyoncctransaction']))
	{
		if($_COOKIE['relyoncctransaction'] == $TxnID)
		{
			echo("You have either hit on Refresh or Back. The page has been expired.");
			exit;
		}
	}
	
	setcookie(relyoncctransaction,$TxnID,time()+3600, "/", ".relyonsoft.com");
	
}
else
{
	echo("Invalid Entry");
	exit;
}

$query = "update transactions set responsecode = '".$ResponseCode."', responsemessage = '".$Message."', pgtxnid = '".$ePGTxnID."', authidcode = '".$AuthIdCode."', rrn = '".$RRN."', cvrespcode = '".$CVRespCode."', fdmsscore = '".$FDMSScore."', fdmsresult = '".$FDMSResult."', cookievalue = '".$Cookie."' where id = '".$TxnID."'";
$result = runicicidbquery($query);

$query = "select * from transactions where id = '".$TxnID."'";
$result = runicicidbquery($query);
$transaction = mysqli_fetch_array($result);

$query = "select * from update09_customers where inventorycode = '".$transaction['recordreference']."'";
$result = runsppdbquery($query);
$userdetails = mysqli_fetch_array($result);

$date = datetimelocal('Y-m-d');
$time = datetimelocal('H:i:s');
$slno = $userdetails['slno'];
$company = $userdetails['company'];
$contactperson = $userdetails['contactperson'];
$place = $userdetails['place'];
$phone = $userdetails['phone'];
$emailid = $userdetails['emailid'];
$cardno = $userdetails['cardno'];
$paymentamount = $userdetails['paymentamount'];

if($ResponseCode == 0)
{
	//Update payment details to SPP Customer table
	$query = "update update09_customers set paymentstatus = 'PAID', paymentdate = '".$date."', paymenttime = '".$time."' where slno = '".$slno."'";
	$result = runsppdbquery($query);
	
	//Attach the card number, if it is not attached
	if($cardno == "")
	{
		$query = "select MIN(cardno) AS cardno, pinno from update09_scratchcards where attached = 'N' group by attached";
		$result = runsppdbquery($query);
		$cardresult = mysqli_fetch_array($result);
		$cardno = $cardresult['cardno'];
		$pinno = $cardresult['pinno'];
		
		$query = "update update09_customers set cardno = '".$cardno."' where slno = '".$slno."'";
		$result = runsppdbquery($query);

		$query = "update update09_customers set attached = 'Y' where cardno = '".$cardno."'";
		$result = runsppdbquery($query);
	}
	else //Get the PIN number of already attached card
	{
		$query = "select pinno from update09_scratchcards where cardno = '".$cardno."'";
		$result = runsppdbquery($query);
		$cardresult = mysqli_fetch_array($result);
		$pinno = $cardresult['pinno'];
	}
	
	$fromname = "Relyon";
	$fromemail = "emails@relyonsoft.com";
	$toarray = array($contactperson => $emailid);
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Vidyananda' => 'vidyananda.csd@relyonsoft.com', 'Relyonimax' => 'relyonimax@gmail.com');
	require_once("../functions/RSLMAIL_MAIL.php");
	$msg = file_get_contents("../inc/mail-spp-success-payment.htm");
	$array = array(
		"##AMOUNT##" => $paymentamount,
		"##COMPANY##" => $company,
		"##PLACE##" => $place,
		"##PINNO##" => $pinno,
		"##CARDNO##" => $cardno,
	);
	$msg = replacemailvariable($msg,$array);
	$subject = "Saral PayPack (Updation/AMC) Payment Successfull by ".$company;
	$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
	$html = $msg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, null);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment for Saral PayPack - Updation / AMC</title>
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
    <td width="100%" class="pagebodyheading"><strong>Payment Status</strong></td>
    </tr>
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  
  <tr>
    <td valign="top" class="buyonlinebox"><p align="center">Transaction Status: <? echo($Message); ?><br />
      Relyon Transaction ID: <? echo($TxnID); ?><br />
      ICICI Transaction reference Number: <? echo($ePGTxnID); ?><br />
    <? if($ResponseCode == 0) { ?>Authorization ID: <? echo($AuthIdCode); ?> <br /> 
    <strong>---------------SUCCESSFULL---------------</strong>
    <? }?></p>      </td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <? if($ResponseCode == 0) { ?>
  <tr class="content">
    <td class="buyonlinebox"><p align="center"><strong>Delivery Sheet</strong></p>
      <p>Company Name: <? echo($company); ?><br />
      Place: <? echo($place); ?></p>
      <p>PIN Number: <? echo($pinno); ?><br />
      (PIN Reference: <? echo($cardno); ?>)</p>
      <p>You have been successfully paid for Rs. <? echo($paymentamount); ?>. An email also have been sent to <font color="#FF0000"><? echo($emailid); ?> </font>with the information and procedure. Please use the above mentioned Card Number to proceed for registering Saral PayPack.</p>
      <p><strong>Procedure:</strong></p>
      <ol>
        <li>If you have not installed Saral PayPack version 3.60 (or above), you have to downlaod the it from http://userlogin.relyonsoft.com.
          <ol>
            <li>After installing the latest version, you have to open the software and Go to the registration screen. </li>
            <li>Note down the <strong>Computer ID</strong> displayed over there.</li>
          </ol>
        </li>
        <li>Visit http://www.saralpaypack.com/update09/ to generate your license Key.
          <ol>
            <li>Step 1: Enter the PIN Number mentioned above and Continue.</li>
            <li>Step 2: Enter the Computer ID and continue.</li>
            <li>Step 3: Note your Soft Key generated.</li>
            </ol>
        </li>
        <li>Come back to your software and enter the Soft key in the registration screen.</li>
        </ol>      
      <p>Please make sure, you have made no mistake while entering your Computer ID. Any mistake at that point may complicate the whole process. </p>
      <p align="right"><strong><a href="http://www.saralpaypack.com/update09/"><font color="#006699">If you have already installed new version, proceed for Product Registration&gt;&gt;</font></a></strong></p></td>
  </tr>
   <? }?>
  <tr class="content">
    <td>&nbsp;</td>
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
