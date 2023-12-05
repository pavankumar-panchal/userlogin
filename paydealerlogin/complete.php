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

if($ResponseCode == 0)
{
	//Update payment details to iMax Credits table
	$query = "insert into `inv_credits`(dealerid, credittype, creditamount, creditdate, remarks, createdby)values('".$transaction['recordreference']."', 'creditcard', '".$transaction['amount']."', '".$transaction['date']." ".$transaction['time']."', 'Payment made by credit card at ".$transaction['time']."', '2')";
	$result = runimaxdbquery($query);

	$fromname = "Relyon";
	$fromemail = "emails@relyonsoft.com";
	$toarray = array('Vijay' => 'vijaykumar@relyonsoft.com');
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com');
	require_once("../functions/RSLMAIL_MAIL.php");
	$msg = "One Payment has been made just now.";
	$subject = "Saral iMax | Payment Successfull";
	$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
	$html = $msg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, null);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment for Saral eFile</title>
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
