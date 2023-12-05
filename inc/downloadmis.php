<?php

//Get download date and time
$downloaddate = datetimelocal("Y-m-d"); 
$downloadtime = datetimelocal("H:i");

//Insert this record to Database 'downloads'
$query = "INSERT INTO downloads (userid,emailid,productid,product,date,time) VALUES ('".$userid."', '".$emailid."','".$productrefid."','".$productname."','".$downloaddate."','".$downloadtime."')";
$result = runmysqlquery($query);
	
//Check if the user for respective product is already in the lead table. If not available then add it as a new lead
$query = "SELECT * FROM leads WHERE userid = '".$userid."' and productid = '".$productrefid."' and leaddatetime > DATE_ADD(CURDATE(),INTERVAL -250  DAY)";
$result = runmysqlquery($query);
$leadpresence = mysqli_num_rows($result);
if($leadpresence == 0)
{
	//Get the category of the product
	$query = "SELECT * FROM products WHERE id = '".$productrefid."'";
	$result = runmysqlqueryfetch($query);
	$prdcategory = $result['category'];
		
	//If not in the lead table, check, is it present for some other product in lead table for any dealer [other than unmapped contact]
	//$query = "SELECT dealers.id AS id, dealers.dlrname AS dlrname, dealers.dlrcompanyname AS dlrcompanyname, dealers.dlraddress AS dlraddress, dealers.dlrcell AS dlrcell, dealers.dlrphone AS dlrphone, dealers.dlremail AS dlremail FROM leads JOIN dealers ON leads.dealerid = dealers.id JOIN products on leads.productid = products.id WHERE userid = '".$userid."' AND dealerid <> '999999' AND products.category = '".$prdcategory."'";
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
	$query = "insert into `leads` (userid, dealerid, productid, source, company, name, address, place, regionid, phone, emailid, refer, leadstatus, dealernativeid,cell,initialcontactname,initialaddress,initialphone,initialcellnumber,initialemailid,leaddatetime) values('".$userid."', '".$dwndlrid."', '".$productrefid."', 'Product Download', '".$company."', '".$name."', '".$address."', '".$place."', '".$regionid."', '".$phone."', '".$emailid."', '".$refer."', 'Not Viewed', '".$dwndlrid."','".$cell."','".$name."','".$address."','".$phone."','".$cell."','".$emailid."','".$downloaddate.' '.$downloadtime."')";
	$result = runmysqlquery($query);
	
	 //Fetch new lead id to insert into updatelogs.
	$query2 = "SELECT id,leadstatus FROM leads where source = 'Product Download' and company = '".$company."' and name = '".$name."' and  productid = '".$productrefid."' and leaddatetime = '".$downloaddate.' '.$downloadtime."' ";
	
	$result2 = runmysqlqueryfetch($query2);
				
	//Insert Details to lms_updatelogs
	$query5 = "insert into lms_updatelogs(leadid,leadstatus,updatedate,updatedby) values('".$result2['id']."','".$result2['leadstatus']."','".$downloaddate.' '.$downloadtime."','151')";
	$result5 = runmysqlquery($query5);
	

	//Send SMS to concerned dealer about the lead
	$servicename = 'LEAD from Userlogin';
	$tonumber = $dwndlrcell;
	$smstext = "Relyon LMS: ".substr($name, 0, 29)." of ".substr($company, 0, 29)." requires ".substr($productname, 0, 29).". Call ".substr($phone, 0, 29).".";
	$senddate = $downloaddate;
	$sendtime = $downloadtime;
	sendsms($servicename, $tonumber, $smstext, $senddate, $sendtime);

}
else
//If already in the leads for same product then get the dealer details to send
{
	$query = "SELECT dealers.id AS id, dealers.dlrname AS dlrname, dealers.dlrcompanyname AS dlrcompanyname, dealers.dlraddress AS dlraddress, dealers.dlrcell AS dlrcell, dealers.dlrphone AS dlrphone, dealers.dlremail AS dlremail FROM leads JOIN dealers ON leads.dealerid = dealers.id WHERE userid = '".$userid."' AND dealerid <> '999999' AND productid = '".$productrefid."'";
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
		//Get the category of the product
		$query = "SELECT * FROM products WHERE id = '".$productrefid."'";
		$result = runmysqlqueryfetch($query);
		$prdcategory = $result['category'];
		
		//Get the dealer details for unmapped contact
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

/*//Put the details to UserAdmin Program through calling Capture.php
//----------------------------------------------------------------------------------

if($existingcust == 'Yes') $existingcustint = '1';
else $existingcustint = '0';

$arg = "email=".urlencode($emailid)."&state=".urlencode($state)."&district=".urlencode($district)."&telno=".urlencode($phone)."&organization=".urlencode($company)."&dealer=".urlencode($dwndlrcompanyname)."&customer=".urlencode($existingcustint)."&referance=".urlencode($refer)."&product=".urlencode($productname)."&cperson=".urlencode($name);

file('http://useradmin.relyonsoft.com/capture.php?'.$arg);
//----------------------------------------------------------------------------------
*/

//echo($cell);

//Email download information to user
require_once("../functions/RSLMAIL_MAIL.php");
$FromAddress=  "BigMail@relyonsoft.com";
/*$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$FromName.' <'.$FromAddress.'>' . "\r\n";
*/if($is_it_a_demo_request <> "yes")
{
	$MailSubject = "Dear ".$name.", Thank you for Downloading Relyon ".$productname.".";
	$msg = file_get_contents("../inc/mail-download-user.htm");
}
else
{
	
	$MailSubject = "Dear ".$name.", Thank you for Demo Request for Relyon ".$productname.".";
	$msg = file_get_contents("../inc/mail-demorequest-user.htm");
}
	$array = array();
	$array[] = "##NAME##%^%".$name;
	$array[] = "##PRODUCTNAME##%^%".$productname;
	$array[] = "##DLRCOMPANYNAME##%^%".$dwndlrcompanyname;
	$array[] = "##DLRNAME##%^%".$dwndlrname;
	$array[] = "##DISTRICT##%^%".$district;
	$array[] = "##DLRPHONE##%^%".$dwndlrphone;
	$array[] = "##DLRCELL##%^%".$dwndlrcell;
	$array[] = "##DLREMAIL##%^%".$dwndlremail;
	$fromname = "Relyon";
	$toarray[$name] = $emailid;
	//$toarray['Archana'] = 'archana.ab@relyonsoft.com';
	//$toarray['Rashmi'] = 'rashmi.hk@relyonsoft.com';
	$text = "This is a HTML format email. Please enable HTML viewing in your email client.";	
/*$array = array(
	"##NAME##" => $name,
	"##PRODUCTNAME##" => $productname,
	"##DLRCOMPANYNAME##" => $dwndlrcompanyname,
	"##DLRNAME##" => $dwndlrname,
	"##DISTRICT##" => $district,
	"##DLRPHONE##" => $dwndlrphone,
	"##DLRCELL##" => $dwndlrcell,
	"##DLREMAIL##" => $dwndlremail
);*/
$msg = replacemailvariablenew($msg,$array);
$html = $msg;
if(rslmail($fromname,$FromAddress,$toarray,$MailSubject,$text,$html,null,null,null))
{
	$bccarray['bigmail'] = 'bigmail@relyonsoft.com';
	$bccarray['Relyonimax'] ='relyonimax@gmail.com';
	if($is_it_a_demo_request <> "yes")
	{
		$MailSubject = $productname." download by " . $name;
		$msg = file_get_contents("../inc/mail-download-relyon.htm");
	}
	else
	{
		$MailSubject = $productname." demo requested by " . $name;
		$msg = file_get_contents("../inc/mail-demorequest-relyon.htm");
	}
	
	$array = array();
	$array[] = "##NAME##%^%".$name;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##DISTRICT##%^%".$district;
	$array[] = "##STATE##%^%".$state;
	$array[] = "##PHONE##%^%".$phone;
	
	$array[] = "##CELL##%^%".$cell;
	$array[] = "##EMAILID##%^%".$emailid;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##EXISTINGCUST##%^%".$existingcust;
	$array[] = "##REFER##%^%".$refer;
	$array[] = "##PRODUCTNAME##%^%".$productname;
	$array[] = "##DLREMAIL##%^%".$dwndlremail;
	$array[] = "##DOWNLOADDATE##%^%".$downloaddate;
	$array[] = "##DOWNLOADTIME##%^%".$downloadtime;
	$msg = replacemailvariablenew($msg,$array);
	$toarray[$name] = $dwndlremail;
	//$toarray[$name] = 'archana.ab@relyonsoft.com';
	//$toarray['Rashmi'] = 'rashmi.hk@relyonsoft.com';
	rslmail($fromname,$FromAddress,$toarray,$MailSubject,$text,$msg,$bccarray,null,null);
	
	//mail("Relyon WebDownload <".$dwndlremail.">", $MailSubject , $msg, $headers."Reply-To: ".$emailid."\r\n")
}


/*if (mail($name." <".$emailid.">", $MailSubject, $msg, $headers."Reply-To: ".$dwndlremail."\r\n"))
{

	$headers .= 'Bcc: <bigmail@relyonsoft.com>';
	$headers .= "\r\n";
	
	if($is_it_a_demo_request <> "yes")
	{
		$MailSubject = $productname." download by " . $name;
		$msg = file_get_contents("../inc/mail-download-relyon.htm");
	}
	else
	{
		$MailSubject = $productname." demo requested by " . $name;
		$msg = file_get_contents("../inc/mail-demorequest-relyon.htm");
	}
	
	$array = array();
	$array[] = "##NAME##%^%".$name;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##DISTRICT##%^%".$district;
	$array[] = "##STATE##%^%".$state;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##CELL##%^%".$cell;
	$array[] = "##EMAILID##%^%".$emailid;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##EXISTINGCUST##%^%".$existingcust;
	$array[] = "##REFER##%^%".$refer;
	$array[] = "##PRODUCTNAME##%^%".$productname;
	$array[] = "##DLREMAIL##%^%".$dwndlremail;
	$array[] = "##DOWNLOADDATE##%^%".$downloaddate;
	$array[] = "##DOWNLOADTIME##%^%".$downloadtime;

	
	/*$array = array(
			"##NAME##" => $name,
			"##PLACE##" => $place,
			"##DISTRICT##" => $district,
			"##STATE##" => $state,
			"##PHONE##" => $phone,
			"##EMAILID##" => $emailid,
			"##COMPANY##" => $company,
			"##EXISTINGCUST##" => $existingcust,
			"##REFER##" => $refer,
			"##PRODUCTNAME##" => $productname,
			"##DLREMAIL##" => $dwndlremail,
			"##DOWNLOADDATE##" => $downloaddate,
			"##DOWNLOADTIME##" => $downloadtime
			
	);
	$msg = replacemailvariablenew($msg,$array);
	mail("Relyon WebDownload <".$dwndlremail.">", $MailSubject , $msg, $headers."Reply-To: ".$emailid."\r\n");
}
*/
//if($productname == "Saral Accounts")
//echo("I'm here.".$downloadlink);
//Divert to download link
if($is_it_a_demo_request <> "yes")
	header("Location:".$downloadlink);

?>