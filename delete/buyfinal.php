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
<title>Saral ITR Purchase</title>
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
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Saral ITR Purchase...</strong></font></td>
    </tr>

  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td>
	<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$auth_token = "FKirx51HF1psWsWkKuQkq3pTN2B8_GBIWY8Qk6KiVjhyHLaDA3qcfyJHAAa";
$req .= "&tx=".$tx_token."&at=".$auth_token;

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

	if (!$fp) 
		{
		// HTTP ERROR
		} 
	else 
		{
		fputs ($fp, $header . $req);
		// read the body data
		$res = '';
		$headerdone = false;
			while (!feof($fp)) 
				{
				$line = fgets ($fp, 1024);
					if (strcmp($line, "\r\n") == 0) 
						{
						// read the header
						$headerdone = true;
						}
					else if ($headerdone)
						{
						// header has been read. now read the contents
						$res .= $line;
						}
				}
		
		// parse the data
		$lines = explode("\n", $res);
		$keyarray = array();
			if (strcmp ($lines[0], "SUCCESS") == 0) 
				{
					for ($i=1; $i<count($lines);$i++)
						{
						list($key,$val) = explode("=", $lines[$i]);
						$keyarray[urldecode($key)] = urldecode($val);
						}

				//Check if the transaction ID is already present in the system
				$rslfetch1 = mysqli_query("SELECT COUNT(*) AS count FROM scratchcards WHERE transid = '".$tx_token."'") or die(mysqli_error());
				$rslrow1 = mysqli_fetch_array($rslfetch1);
				if($rslrow1['count'] <> "0")
				{
					echo ("<p><h3>The requested details have already been generated. If you have any problem, please email us at webmaster@relyonsoft.com</h3></p>");
				}
				else
				{
					//Get date and time
					$differencetolocaltime=10.5;
					$new_U=date("U")+$differencetolocaltime*3600;
					$buydate = date("Y-m-d", $new_U); 
					$buytime = date("H:i", $new_U); 

					//Assign the array elements to variables.
					$firstname = $keyarray['first_name'];
					$lastname = $keyarray['last_name'];
					$itemname = $keyarray['item_name'];
					$amount = $keyarray['payment_gross'];


					//Find the least slno of cardid which can be provided and is not assigned to any customer from scratchcards table and also Assign the scratch card number and Card ID, Order ID, etc for variables
					$rslfetch22 = mysqli_query("SELECT MIN(slno) AS orderid FROM scratchcards WHERE customer is null AND product = '".$itemname."'") or die(mysqli_error());
					$rslrow22 = mysqli_fetch_array($rslfetch22);
					$orderid = $rslrow22['orderid'];
					$rslfetch2 = mysqli_query("SELECT cardid, pinno FROM scratchcards WHERE slno = ".$orderid."") or die(mysqli_error());
					$rslrow2 = mysqli_fetch_array($rslfetch2);
					$cardid = $rslrow2['cardid'];
					$pinno = $rslrow2['pinno'];

					//Put the details to scratchcards table for above id
					mysqli_query("UPDATE scratchcards SET customer = '".$email."', transid = '".$tx_token."', `date` = '".$buydate."', `time` = '".$buytime."' WHERE slno = '".$orderid."'") or die(mysqli_error());
				
					// check the payment_status is Completed
					// check that txn_id has not been previously processed
					// check that receiver_email is your Primary PayPal email
					// check that payment_amount/payment_currency are correct
					// process payment

					$details = "<p><h3>Thank you for your purchase!</h3></p>
					<b>Payment Details</b><br><br>
					Customer Name: ".$email."<br>
					Transaction ID: ".$tx_token."<br>
					Item: ".$itemname."<br>
					Order ID: ".$orderid."<br>
					<b>PIN NUMBER for Registration from www.relyonsoft.com: <font color='#FF0000'>".$pinno."</font></b></li><br>
					Amount [USD]: $".$amount."<br>
					<br>
					<font color='#FF0000'> Please Keep these details SAVED / PRINTED.</font><br>";

					echo('
					<table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="18%">&nbsp;</td>
                    <td width="82%" style="border:2px solid #999999">'.$details.'</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td style="border:2px solid #999999"><p align="justify"><strong>After noting the about Details, follow the below:</strong></p>
                      <p align="justify">1. <strong>Download</strong>:<br />
                      Visit <em><strong>http://userlogin.relyonsoft.com</strong></em> and download the product.</p>
                      <p align="justify">2. <strong>Install</strong>:<br />
                      After downloading the product, Install it with the istructions shown on-screen.</p>
                      <p align="justify">3. <strong>Register</strong>:<br />
                      After successfull installation, visit <em><strong>www.relyonsoft.com</strong></em> and click on &quot;Product Registration&quot;. Provide your details along with Computer ID and Computer Sign [available in the software, registration window]. Enter your Scratch Card PIN Number, mentioned above and click on generate button. Note the Softkey genereated and and enter it in software. Click on register button. Thus, you are successfully registered the product.</p>
                      <p>&nbsp;</p></td>
                  </tr>
                </table>
					');
					
				}
				}
			else if (strcmp ($lines[0], "FAIL") == 0) 
				{
					echo ("<b>Payment authentication failed... Please try again.</b>");
				}
		
		}

fclose ($fp);

?></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><div align="justify"><font color="#FF6600"> Note: No shipping of the product will be done for ONLINE PURCHASES. On request shipping is available &quot;Once&quot; through a written email with ORDER ID and shipping address to register@relyonsoft.com.</font></div></td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
  </tr>
  <tr class="content">
    <td><strong>Registering your product:</strong></td>
  </tr>
  <tr class="content">
    <td>Visit www.relyonsoft.com and click on &quot;Product Registration&quot; in Left Side. Then provide the details and avail registration. Any doubts, mail us at register@relyonsoft.com</td>
  </tr>
  <tr class="content">
    <td>&nbsp;</td>
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
