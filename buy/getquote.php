<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
$tobedisabled="";
$success = "";
if(isset($_POST['spponline']) || isset($_POST['sppdesktop']))
{
	$requestdate = datetimelocal("Y-m-d"); 
	$requesttime = datetimelocal("H:i");
	$fromname = "Relyon";
	$fromemail = "imax@relyon.co.in";
	
	$toarray = array($name => $emailid);
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Shashidhar M S' => 'shashidharms@relyonsoft.com', 'Relyonimax' => 'relyonimax@gmail.com');
	if($_POST['spponline'] <> "")
	{
		// Check if the lead exists for this user
		$productid = '23';
		$productname = 'Online SPP';
		$query = "SELECT * FROM leads WHERE userid = '".$userid."' and productid = '".$productid."' and leaddatetime > DATE_ADD(CURDATE(),INTERVAL -365  DAY)";
		$result = runmysqlquery($query);
		$leadpresence = mysqli_num_rows($result);
		if($leadpresence == 0)
		{
			//Get the category of the product
			$query = "SELECT * FROM products WHERE id = '".$productid."'";
			$result = runmysqlqueryfetch($query);
			$prdcategory = $result['category'];
				
			//If not in the lead table, check, is it present for some other product in lead table for any dealer [other than unmapped contact]
			$query = "SELECT dealers.id AS id, dealers.dlrname AS dlrname, dealers.dlrcompanyname AS dlrcompanyname, dealers.dlraddress AS dlraddress, dealers.dlrcell AS dlrcell, dealers.dlrphone AS dlrphone, dealers.dlremail AS dlremail FROM leads left join dealers on leads.dealerid = dealers.id left join products on leads.productid = products.id left join lms_users on dealers.id = lms_users.referenceid WHERE userid = '".$userid."' AND dealerid <> '999999' AND lms_users.type = 'Dealer' AND products.category = '".$prdcategory."' AND lms_users.disablelogin <> 'yes'";
			
			$result = runmysqlquery($query);
			$leadpresence2 = mysqli_num_rows($result);
			if($leadpresence2 > 0)
			{
				//if present, then assign the lead to the same dealer, who has got the first product. Take him as dealer ID
				$fetch = mysqli_fetch_array($result);
				$dwndlrid = $fetch['id'];
				$dwndlrname = $fetch['dlrname'];
				$dwndlrcompanyname = $fetch['dlrcompanyname'];
				$dwndlraddress = $fetch['dlraddress'];
				$dwndlrcell = $fetch['dlrcell'];
				$dwndlrphone = $fetch['dlrphone'];
				$dwndlremail = $fetch['dlremail'];
			}
			else
			{
				//if not, then check the mapping table for respective product category/region and pick respective dealer ID.
				$query = "SELECT * FROM mapping WHERE regionid = '".$regionid."' AND prdcategory = '".$prdcategory."'";
				$result = runmysqlquery($query);
				$mappingcount = mysqli_num_rows($result);
				
				//echo($query); echo('here'); exit;
				//If mapping exists for that region and product, pick respective dealer address
				if($mappingcount == 1)
				{
					$result = runmysqlqueryfetch($query);
					//$query = "SELECT * FROM dealers WHERE id = '".$result['dealerid']."'";
					$query = "SELECT *,dealers.id as dwndlrid FROM dealers left join lms_users on dealers.id = lms_users.referenceid
		 WHERE dealers.id =  '".$result['dealerid']."' AND lms_users.type = 'Dealer'  AND lms_users.disablelogin <> 'yes' ;";
					$result = runmysqlquery($query);
					$checkcount = mysqli_num_rows($result);
					if($checkcount > '0')
					{
						$result = runmysqlqueryfetch($query);
						$dwndlrid = $result['dwndlrid'];
						$dwndlrname = $result['dlrname'];
						$dwndlrcompanyname = $result['dlrcompanyname'];
						$dwndlraddress = $result['dlraddress'];
						$dwndlrcell = $result['dlrcell'];
						$dwndlrphone = $result['dlrphone'];
						$dwndlremail = $result['dlremail'];
					}
					else
					{			
						//If mapping is not available for that product category/region, take unmapped contact as its dealer ID
						$query = "SELECT * FROM unmappedcontact WHERE managedarea = '".$managedarea."' and prdcategory = '".$prdcategory."'";
						$result = runmysqlqueryfetch($query);
						$dwndlrid = "999999";
						$dwndlrname = $result['dlrname'];
						$dwndlrcompanyname = $result['dlrcompanyname'];
						$dwndlraddress = $result['dlraddress'];
						$dwndlrcell = $result['dlrcell'];
						$dwndlrphone = $result['dlrphone'];
						$dwndlremail = $result['dlremail'];
					}
				}
				else
				{			
					//If mapping is not available for that product category/region, take unmapped contact as its dealer ID
					$query = "SELECT * FROM unmappedcontact WHERE managedarea = '".$managedarea."' and prdcategory = '".$prdcategory."'";
					$result = runmysqlqueryfetch($query);
					$dwndlrid = "999999";
					$dwndlrname = $result['dlrname'];
					$dwndlrcompanyname = $result['dlrcompanyname'];
					$dwndlraddress = $result['dlraddress'];
					$dwndlrcell = $result['dlrcell'];
					$dwndlrphone = $result['dlrphone'];
					$dwndlremail = $result['dlremail'];
				}
			}
		
			//Update the download information to lead table for above said dealer
			$query = "insert into `leads` (userid, dealerid, productid, source, company, name, address, place, regionid, phone, emailid, refer, leadstatus,leadremarks, dealernativeid,cell,initialcontactname,initialaddress,initialphone,initialcellnumber,initialemailid,leaddatetime) values('".$userid."', '".$dwndlrid."', '".$productid."', 'Product Download', '".$company."', '".$name."', '".$address."', '".$place."', '".$regionid."', '".$phone."', '".$emailid."', '".$refer."', 'Quote Sent','Added automatically through \'SPP - Get Quote\' provision in userlogin','".$dwndlrid."','".$cell."','".$name."','".$address."','".$phone."','".$cell."','".$emailid."','".$requestdate.' '.$requesttime."')";
			$result = runmysqlquery($query);
			
			 //Fetch new lead id to insert into updatelogs.
			$query2 = "SELECT id,leadstatus FROM leads where source = 'Product Download' and company = '".$company."' and name = '".$name."' and  productid = '".$productid."' and leaddatetime = '".$requestdate.' '.$requesttime."' ";
			
			$result2 = runmysqlqueryfetch($query2);
						
			//Insert Details to lms_updatelogs
			$query5 = "insert into lms_updatelogs(leadid,leadstatus,updatedate,updatedby) values('".$result2['id']."','".$result2['leadstatus']."','".$requestdate.' '.$requesttime."','151')";
			$result5 = runmysqlquery($query5);
		}	
		$product = "Saral PayPack - with Online Module";
		require_once("../functions/RSLMAIL_MAIL.php");
		$msg = file_get_contents("../inc/mail-quote-spponline.htm");
		$array = array();
		$array[] = "##DATE##%^%".changedateformat($requestdate);
		$array[] = "##NAME##%^%".$name;
		$array[] = "##COMPANY##%^%".$company;
		$array[] = "##PLACE##%^%".$place;
		$array[] = "##DISTRICT##%^%".$district;
		$array[] = "##STATE##%^%".$state;
		$array[] = "##PHONE##%^%".$phone;
		$array[] = "##ID##%^%".$userid;
		$array[] = "##PRODINITIAL##%^%".'SPPON';
		$array[] = "##EMAILID##%^%".$emailid;

		$filearray = array(
			array('../images/userlogin-relyon-logo.jpg','inline','1234567890'),
			array('../inc/SPP-Online-Product-Profile.pdf','attachment','1234567891'),
			array('../inc/Customer-Check-List.pdf','attachment','1234567892')
		);
		$msg = replacemailvariablenew($msg,$array);
		$subject = "Quotation of ".$product." for ".$company;
		$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
		$html = $msg;
	}
	elseif($_POST['sppdesktop'] <> "")
	{
		$productname = 'Saral Pay Pack';
		// Check if the lead exists for this user
		$productid = '1';
		$query = "SELECT * FROM leads WHERE userid = '".$userid."' and productid = '".$productid."' and leaddatetime > DATE_ADD(CURDATE(),INTERVAL -365  DAY)";
		$result = runmysqlquery($query);
		$leadpresence = mysqli_num_rows($result);
		if($leadpresence == 0)
		{
			//Get the category of the product
			$query = "SELECT * FROM products WHERE id = '".$productid."'";
			$result = runmysqlqueryfetch($query);
			$prdcategory = $result['category'];
				
			//If not in the lead table, check, is it present for some other product in lead table for any dealer [other than unmapped contact]
			$query = "SELECT dealers.id AS id, dealers.dlrname AS dlrname, dealers.dlrcompanyname AS dlrcompanyname, dealers.dlraddress AS dlraddress, dealers.dlrcell AS dlrcell, dealers.dlrphone AS dlrphone, dealers.dlremail AS dlremail FROM leads left join dealers on leads.dealerid = dealers.id left join products on leads.productid = products.id left join lms_users on dealers.id = lms_users.referenceid WHERE userid = '".$userid."' AND dealerid <> '999999' AND lms_users.type = 'Dealer' AND products.category = '".$prdcategory."' AND lms_users.disablelogin <> 'yes'";
			
			$result = runmysqlquery($query);
			$leadpresence2 = mysqli_num_rows($result);
			if($leadpresence2 > 0)
			{
				//if present, then assign the lead to the same dealer, who has got the first product. Take him as dealer ID
				$fetch = mysqli_fetch_array($result);
				$dwndlrid = $fetch['id'];
				$dwndlrname = $fetch['dlrname'];
				$dwndlrcompanyname = $fetch['dlrcompanyname'];
				$dwndlraddress = $fetch['dlraddress'];
				$dwndlrcell = $fetch['dlrcell'];
				$dwndlrphone = $fetch['dlrphone'];
				$dwndlremail = $fetch['dlremail'];
			}
			else
			{
				//if not, then check the mapping table for respective product category/region and pick respective dealer ID.
				$query = "SELECT * FROM mapping WHERE regionid = '".$regionid."' AND prdcategory = '".$prdcategory."'";
				$result = runmysqlquery($query);
				$mappingcount = mysqli_num_rows($result);
				
				//If mapping exists for that region and product, pick respective dealer address
				if($mappingcount == 1)
				{
					$result = runmysqlqueryfetch($query);
					//$query = "SELECT * FROM dealers WHERE id = '".$result['dealerid']."'";
					$query = "SELECT *,dealers.id as dwndlrid FROM dealers left join lms_users on dealers.id = lms_users.referenceid
		 WHERE dealers.id =  '".$result['dealerid']."' AND lms_users.type = 'Dealer'  AND lms_users.disablelogin <> 'yes' ;";
					$result = runmysqlqueryfetch($query);
					if(count($result) > '0')
					{
						$dwndlrid = $result['dwndlrid'];
						$dwndlrname = $result['dlrname'];
						$dwndlrcompanyname = $result['dlrcompanyname'];
						$dwndlraddress = $result['dlraddress'];
						$dwndlrcell = $result['dlrcell'];
						$dwndlrphone = $result['dlrphone'];
						$dwndlremail = $result['dlremail'];
					}
					else
					{			
						//If mapping is not available for that product category/region, take unmapped contact as its dealer ID
						$query = "SELECT * FROM unmappedcontact WHERE managedarea = '".$managedarea."' and prdcategory = '".$prdcategory."'";
						$result = runmysqlqueryfetch($query);
						$dwndlrid = "999999";
						$dwndlrname = $result['dlrname'];
						$dwndlrcompanyname = $result['dlrcompanyname'];
						$dwndlraddress = $result['dlraddress'];
						$dwndlrcell = $result['dlrcell'];
						$dwndlrphone = $result['dlrphone'];
						$dwndlremail = $result['dlremail'];
					}
				}
				else
				{			
					//If mapping is not available for that product category/region, take unmapped contact as its dealer ID
					$query = "SELECT * FROM unmappedcontact WHERE managedarea = '".$managedarea."' and prdcategory = '".$prdcategory."'";
					$result = runmysqlqueryfetch($query);
					$dwndlrid = "999999";
					$dwndlrname = $result['dlrname'];
					$dwndlrcompanyname = $result['dlrcompanyname'];
					$dwndlraddress = $result['dlraddress'];
					$dwndlrcell = $result['dlrcell'];
					$dwndlrphone = $result['dlrphone'];
					$dwndlremail = $result['dlremail'];
				}
			}
		
			//Update the download information to lead table for above said dealer
			$query = "insert into `leads` (userid, dealerid, productid, source, company, name, address, place, regionid, phone, emailid, refer, leadstatus,leadremarks, dealernativeid,cell,initialcontactname,initialaddress,initialphone,initialcellnumber,initialemailid,leaddatetime) values('".$userid."', '".$dwndlrid."', '".$productid."', 'Product Download', '".$company."', '".$name."', '".$address."', '".$place."', '".$regionid."', '".$phone."', '".$emailid."', '".$refer."', 'Quote Sent','Added automatically through \'SPP - Get Quote\' provision in userlogin','".$dwndlrid."','".$cell."','".$name."','".$address."','".$phone."','".$cell."','".$emailid."','".$requestdate.' '.$requesttime."')";
			$result = runmysqlquery($query);
			
			 //Fetch new lead id to insert into updatelogs.
			$query2 = "SELECT id,leadstatus FROM leads where source = 'Product Download' and company = '".$company."' and name = '".$name."' and  productid = '".$productid."' and leaddatetime = '".$requestdate.' '.$requesttime."' ";
			
			$result2 = runmysqlqueryfetch($query2);
						
			//Insert Details to lms_updatelogs
			$query5 = "insert into lms_updatelogs(leadid,leadstatus,updatedate,updatedby) values('".$result2['id']."','".$result2['leadstatus']."','".$requestdate.' '.$requesttime."','151')";
			$result5 = runmysqlquery($query5);
		}	
		
			
		// Send Quote
		$product = "Saral PayPack - Offline Package";
		require_once("../functions/RSLMAIL_MAIL.php");
		$msg = file_get_contents("../inc/mail-quote-spp.htm");
		$array = array();
		$array[] = "##DATE##%^%".changedateformat($requestdate);
		$array[] = "##NAME##%^%".$name;
		$array[] = "##COMPANY##%^%".$company;
		$array[] = "##PLACE##%^%".$place;
		$array[] = "##DISTRICT##%^%".$district;
		$array[] = "##STATE##%^%".$state;
		$array[] = "##PHONE##%^%".$phone;
		$array[] = "##ID##%^%".$userid;
		$array[] = "##PRODINITIAL##%^%".'SPPOFF';
		$array[] = "##EMAILID##%^%".$emailid;
			$filearray = array(
				array('../images/userlogin-relyon-logo.jpg','inline','1234567890'),
				array('../inc/SPP-Desktop-Product-Profile.pdf','attachment','1234567891'),
				array('../inc/Customer-Check-List.pdf','attachment','1234567892')
			);
			$msg = replacemailvariablenew($msg,$array);
			$subject = "Quotation of ".$product." for ".$company;
			$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
			$html = $msg;
	}
	//Send SMS to concerned dealer about the lead
	$servicename = 'LEAD from Userlogin';
	$tonumber = $dwndlrcell;
	$smstext = "Relyon LMS: ".substr($name, 0, 29)." of ".substr($company, 0, 29)." requires ".substr($productname, 0, 29).". Call ".substr($phone, 0, 29).".";
	$senddate = $requestdate;
	$sendtime = $requesttime;
	sendsms($servicename, $tonumber, $smstext, $senddate, $sendtime);
		
	$query = "insert into `getquote` (userid, emailid, productname, requestdate, requesttime)values('".$userid."', '".$emailid."', '".$product."', '".$requestdate."', '".$requesttime."')";
	$result = runmysqlquery($query);
	//if(rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,null,$bccarray,$filearray))
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,null,$bccarray,$filearray);
	$success = "<div style='background-color:#FFCC00; padding:2px; color:#000000'>Quote has been successfully sent to <strong>".$emailid."</strong>.Please check your Inbox for the Quotation of <strong>".$product."<strong>.</div>";
	//else
	//	$success = "We are unable to process the request. Please try after few minutes.";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Get Quote for Relyon Products</title>
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
<td colspan="3" style="padding-right:10px"><div align="right"><a href="../logout.php">Logout</a></div></td>
</tr>
<tr>
<td width="550" rowspan="3" valign="top" class="pagebody"><table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><strong>Get Quote for Relyon Products</strong></td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td><div align="center" style="color:#FF0000"> 
          <? echo($success); ?></div></td>
      </tr>
      <tr>
        <td><div align="justify">Below products are available for quotes. Once you request a quote, a quotation will be processed and reaching you in a few miutes via email.</div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><table width="99%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="40%" class="getquotebox"><form action="" method="post" name="sppgetquote" id="sppgetquote"><div align="center">
              <p><span style="font-size:16px; color:#006699; font-weight:bold">Saral PayPack </span><br />
                Desktop Edition</p>
              <p><input name="sppdesktop" type="submit" style="cursor:hand" value="Get Quote" alt="Click here to Place the request" /></p>
            </div></form></td>
            <td width="20%">&nbsp;</td>
            <td width="40%" class="getquotebox"><form action="" method="post" name="sppgetquote1" id="sppgetquote1"><div align="center">
              <p><span style="font-size:16px; color:#FF6600; font-weight:bold">Saral PayPack </span><br />
                With EIP</p>
              <p>
                <input name="spponline" type="submit" style="cursor:hand" value="Get Quote" alt="Click here to Place the request" <? echo($tobedisabled);?>/>
              </p>
            </div></form></td>
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
  <tr class="content">
    <td><div align="justify"><strong>Note: </strong><br />
    This demo request will be placed to Relyon and will be desiganted to nearest Relyon representative in a short while. The visiting person for demonstration will contact you and fix an appointment before coming.</div></td>
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
