<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

$success = "";
/*
if($_POST['spponline'] <> "" || $_POST['sppdesktop'] <> "")
{
	$requestdate = datetimelocal("Y-m-d"); 
	$requesttime = datetimelocal("H:i");
	$fromname = "Relyon";
	$fromemail = "emails@relyonsoft.com";
	$toarray = array($name => $emailid);
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Vijay Hebbar' => 'vijay@relyonsoft.com');
	if($_POST['spponline'] <> "")
	{
		$product = "Saral PayPack - with Online Module";
		require_once("../functions/RSLMAIL_MAIL.php");
		$msg = file_get_contents("../inc/mail-quote-spponline.htm");
		$array = array(
			"##DATE##" => changedateformat($requestdate),
			"##NAME##" => $name,
			"##COMPANY##" => $company,
			"##PLACE##" => $place,
			"##DISTRICT##" => $district,
			"##STATE##" => $state,
			"##PHONE##" => $phone,
			"##ID##" => $userid,
			"##PRODINITIAL##" => "SPPON",
			"##EMAILID##" => $emailid
		);
		$filearray = array(
			array('../images/userlogin-relyon-logo.jpg','inline','1234567890'),
			array('../inc/SPP_with_Online_Profile.pdf','attachment','1234567891')
		);
		$msg = replacemailvariable($msg,$array);
		$subject = "Quotation of ".$product." for ".$company;
		$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
		$html = $msg;
	}
	elseif($_POST['sppdesktop'] <> "")
	{
		$product = "Saral PayPack - Offline Package";
		require_once("../functions/RSLMAIL_MAIL.php");
		$msg = file_get_contents("../inc/mail-quote-spp.htm");
		$array = array(
			"##DATE##" => changedateformat($requestdate),
			"##NAME##" => $name,
			"##COMPANY##" => $company,
			"##PLACE##" => $place,
			"##DISTRICT##" => $district,
			"##STATE##" => $state,
			"##PHONE##" => $phone,
			"##ID##" => $userid,
			"##PRODINITIAL##" => "SPPOFF",
			"##EMAILID##" => $emailid
		);
		$filearray = array(
			array('../images/userlogin-relyon-logo.jpg','inline','1234567890'),
			array('../inc/Product-Profile_and_AMC-Updation_Terms.pdf','attachment','1234567891')
		);
		$msg = replacemailvariable($msg,$array);
		$subject = "Quotation of ".$product." for ".$company;
		$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
		$html = $msg;
	}
	$query = "insert into `getquote` (userid, emailid, productname, requestdate, requesttime)values('".$userid."', '".$emailid."', '".$product."', '".$requestdate."', '".$requesttime."')";
	$result = runmysqlquery($query);
	if(rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,null,$bccarray,$filearray))
		$success = "<div style='background-color:#FFCC00; padding:2px; color:#000000'>Quote has been successfully sent to <strong>".$emailid."</strong>.Please check your Inbox for the Quotation of <strong>".$product."<strong>.</div>";
	else
		$success = "We are unable to process the request. Please try after few minutes.";
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Buy Relyon Products Online</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
</head>
<body>
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr valign="top">
    <td><? include("../inc/header2.php"); ?></td>
  </tr>
  <tr valign="top">
    <td><div>&nbsp;</div>
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3" style="padding-right:10px"><div align="right"><a href="../logout.php">Logout</a></div></td>
        </tr>
        <tr>
          <td width="550" rowspan="3" valign="top" class="pagebody"><table width="100%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                <td width="100%" class="pagebodyheading"><strong>Buy Relyon Products</strong></td>
              </tr>
              <tr>
                <td valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td><div align="center" style="color:#FF0000"> <? echo($success); ?></div></td>
                    </tr>
                    <tr>
                      <td><div align="justify">
                          <p>Steps to get Relyon Products:</p>
                          <ol>
                            <li><strong><font color="#CC0000">Download</font></strong> the TRIAL version and Install in your system.</li>
                            <li><strong><font color="#CC0000">Pay Online</font></strong> and receive your Invoice along with PIN Number for Registration.</li>
                            <li>Visit www.relyonsoft.com and go to PRODUCT REGISTRATION option and <strong><font color="#CC0000">Register</font></strong> the product. You need to enter the PIN number and your Computer ID for receiving the license Key.</li>
                          </ol>
                        </div></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="99%" border="0" align="center" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="40%" class="buyonlinebox"><form action="" method="post" name="sespurchase" id="sespurchase">
                                <div>
                                  <p align="left"><span style="font-size:16px; color:#006699; font-weight:bold">1. Select a Product/Service</span></p>
                                  <p>
                                    <strong>Products</strong><br />
                                    <label>
                                    <input name="buy_product" type="radio" id="buy_product_0" value="tdsp" />
                                    Saral TDS Professional</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsp" id="buy_product_" />
                                    Saral TDS Corporate</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsp" id="buy_product_2" />
                                    Saral TDS Institutional</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsp" id="buy_product_3" />
                                    Saral IncomeTax</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsp" id="buy_product_4" />
                                    Saral TaxOffice</label>
                                  </p>
                                  <p><strong>Services</strong><br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsp" id="buy_product_5" />
                                    Saral PayPack - Annual Maintenance Contract</label>
                                    <br />
                                  </p>
                                  <p>&nbsp;</p>
                                </div>
                              </form></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="77%"></td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><input name="sesbuybutton" type="submit" style="cursor:hand" value="Buy Saral eSign" alt="Click here to Proceed" /></td>
              </tr>
              <tr class="content">
                <td><div align="justify"><strong>Note: </strong><br />
                    <ol>
                      <li>No shipping of the product will be done for ONLINE PURCHASES. </li>
                      <li>The amount paid for particular product, cannot be adjusted for any other  product or service of, either Relyon or others.</li>
                      <li>The payment once processed cannot be refund.</li>
                      <li>An Invoice for the Payment and the PIN Number of Registration will be delivered to your email ID.</li>
                    </ol>
                  </div></td>
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
      <div>&nbsp;</div>
      <BR>
    </td>
  </tr>
  <tr valign="top">
    <td><? include("../inc/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
