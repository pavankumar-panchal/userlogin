<?php

include("../functions/phpfunctions.php"); 

//Configuration
require_once("java/Java.inc");
$strMerchantId="00004074";
$astrFileName="/home/testkey/00004074.key";
$astrClearData;

//Validation by ICICI
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

//Validation by ICICI
function decryptMerchantKey($strData, $strMerchantId)
{
	$strMerchantId=$strMerchantId.$strMerchantId;
	$strDecryptData=decryptData($strData,$strMerchantId);
	return $strDecryptData;
}

//Validation by ICICI
function decryptData($strData,$strKey)
{
	$oEPGCryptLib= new Java('com.opus.epg.sfa.java.EPGCryptLib');
	$decryptData=$oEPGCryptLib->Decrypt($strKey,$strData);
	return $decryptData;
}

//Validation by ICICI and Relyon
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
	
	//Validation of Refresh or Back button
	if(isset($_COOKIE['relyoncctransaction']))
	{
		if($_COOKIE['relyoncctransaction'] == $TxnID)
		{
			echo("You have either hit on Refresh or Back. The page has been expired.");
			exit;
		}
	}
	
	//Set the cookie for Refresh or Back button validation
	setcookie(relyoncctransaction,$TxnID,time()+3600, "/", ".relyonsoft.com");
	
}
else
{
	echo("Invalid Entry");
	exit;
}

//Update the transactions table
$query = "update transactions set responsecode = '".$ResponseCode."', responsemessage = '".$Message."', pgtxnid = '".$ePGTxnID."', authidcode = '".$AuthIdCode."', rrn = '".$RRN."', cvrespcode = '".$CVRespCode."', fdmsscore = '".$FDMSScore."', fdmsresult = '".$FDMSResult."', cookievalue = '".$Cookie."' where id = '".$TxnID."'";
$result = runicicidbquery($query);

//Select the values from transation table
$query = "select * from transactions where id = '".$TxnID."'";
$result = runicicidbquery($query);
$transaction = mysqli_fetch_array($result);

//Select the main data through record-reference
$query = "select * from payacc where uniquecode = '".$transaction['recordreference']."'";
$result = runmysqlquery($query);
$userdetails = mysqli_fetch_array($result);

$date = datetimelocal('Y-m-d');
$time = datetimelocal('H:i:s');
$slno = $userdetails['slno'];
$company = $userdetails['company'];
$contactperson = $userdetails['contactperson'];
$place = $userdetails['place'];
$phone = $userdetails['phone'];
$emailid = $userdetails['emailid'];
$productname = $userdetails['productname'];
$paymentamount = $userdetails['paymentamount'];

if($ResponseCode == 0) //Success
{
	//Update payment details to Payment request table
	$query = "update payacc set paymentstatus = 'PAID', paymentdate = '".$date."', paymenttime = '".$time."' where slno = '".$slno."'";
	$result = runmysqlquery($query);
	
	
	$fromname = "Relyon";
	$fromemail = "emails@relyonsoft.com";
	//Mail to customer
	$toarray = array($contactperson => $emailid); 
	//Copy of email to Accounts / Vijay Kumar / Bigmails
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Accounts' => 'accounts@relyonsoft.com', 'Relyonimax' => 'relyonimax@gmail.com'); 
	require_once("../functions/RSLMAIL_MAIL.php");
	$msg = file_get_contents("../inc/mail-acc-success-payment.htm");
	$array = array(
		"##AMOUNT##" => $paymentamount,
		"##COMPANY##" => $company,
		"##PLACE##" => $place,
	);
	$msg = replacemailvariable($msg,$array);
	$subject = $productname." payment Successfull by ".$company;
	$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
	$html = $msg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, null);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment to Relyon Accounts</title>
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
<tr><td>&nbsp;</td></tr>
<tr><td><table width="771px" border="0" align="center" cellpadding="0" cellspacing="0" >
          <? if($ResponseCode == 0) { ?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                      <tr>
                        <td ><table width="100%" border="0" cellspacing="0" cellpadding="5"  >
                            <tr>
                              <td colspan="2" class="subheading-font">Payment Status</td>
                            </tr>
                            <tr>
                              <td height="3px" colspan="2" class="blueline" ></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="paymentbg">
                                  <tr>
                                    <td width="61%" class="subfonts" style="padding-left:15px" >Transaction Successful</td>
                                    <td width="39%" class="subfonts" height="37"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                                  <tr>
                                    <td width="45%" valign="top" class="displayfont"><strong>Payment from :</strong><br />
                                      <? echo($company)?><br />
                                      <? echo('('.$contactperson.')')?><br />
                                      <? echo($address)?><br />
                                      <? echo($place)?>  </td>
                                    <td width="45%"  valign="top" class="displayfont"><strong>Payment To :</strong><br />
                                      Relyon Softech Ltd<br />
                                      No. 73, Shreelekha Complex, <br />
                                      WOC Road,Bangalore :560 086<br />
                                      Phone: 1860-425-5570 <br />
                                      Email: support@relyonsoft.com</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for Rs. <? echo($paymentamount.'.00')?>. An email also have been sent to <font color="#FF0000"><? echo($emailid)?></font> with the confirmation.<br />
                                </p></td>
                            </tr>
                           
                            <tr>
                              <td colspan="2"><table width="600px" border="0" cellspacing="0" cellpadding="5" bgcolor="#eeeeee" align="center">
                              <tr>
                              <td height="10px"></td>
                            </tr>
                                  <tr>
                                    <td><table width="400px" border="0" cellspacing="0" cellpadding="3" align="center" style="border:solid 1px #D4D4D4">
                                        <tr>
                                          <td class="displayfont"><p align="center"><strong>Transaction Status:</strong> <? echo($Message); ?><br />
                                              <strong>Relyon Transaction ID:</strong> <? echo($TxnID); ?><br />
                                              <strong>ICICI Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
                                              <strong>Authorization ID: </strong> <? echo($AuthIdCode) ?> <br />
                                            </p></td>
                                        </tr>
                                        
                                      </table></td>
                                  </tr>
                                  <tr>
                              <td height="10px"></td>
                            </tr>
                                
                                 
                                </table></td>
                            </tr>
                            <tr>
                              <td height="10px"></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="border-top:solid 2px #8e8e8e" height="10px"></td>
                            </tr>
                            <tr>
                              <td width="65%">&nbsp;</td>
                              <td width="35%"><div align="center">
                                  <input type="button" id="print" name="print" value="Print" onclick="window.print()"/>
                                  &nbsp;&nbsp;&nbsp;
                                  <input type="button" id="update" name="update" value="Go to Home Page" onclick="returnhomepage()"  />
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <? }else{?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                <tr>
                  <td >&nbsp;</td>
                </tr>
                <tr>
                  <td ><table width="100%" border="0" cellspacing="0" cellpadding="5"  >
                      <tr>
                        <td colspan="2" class="subheading-font">Payment Status</td>
                      </tr>
                      <tr>
                        <td height="10px" colspan="2"></td>
                      </tr>
                      <tr>
                        <td height="3px" colspan="2" class="blueline" ></td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="paymentbg">
                            <tr>
                              <td width="61%" class="subfonts" style="padding-left:15px" >Transaction Failure</td>
                              <td width="39%" class="subfonts" height="37"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="fontstyle" ><p align="left">The transaction was NOT successful due to rejection by Gateway / Card issuing Authority. Please try again. </td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="600px" border="0" cellspacing="0" cellpadding="5" bgcolor="#eeeeee" align="center">
                            <tr>
                              <td height="10px"></td>
                            </tr>
                            <tr>
                              <td><table width="400px" border="0" cellspacing="0" cellpadding="3" align="center" style="border:solid 1px #D4D4D4" >
                                  <tr>
                                    <td class="displayfont"><p align="center"><strong>Transaction Status:</strong><? echo($Message); ?><br />
                                        <strong>Relyon Transaction ID:</strong> <? echo($TxnID); ?><br />
                                        <strong>ICICI Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
                                      </p></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td height="10px"></td>
                            </tr>
                          </table></td>
                      </tr>
                     
                      <tr>
                        <td colspan="2" style="border-top:solid 2px #8e8e8e" height="10px"></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <? }?>
          <tr>
            <td></td>
          </tr>
        </table></td></tr>
<tr><td>&nbsp;</td></tr>
<tr valign="top">
<td>
</td>
</tr>
<tr valign="top"><td><? include("../inc/footer.php"); ?></td>
</tr>
</table>
</body>
</html>
