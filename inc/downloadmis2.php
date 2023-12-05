<?php

//Get download date and time
$downloaddate = datetimelocal("Y-m-d"); 
$downloadtime = datetimelocal("H:i");

$emailid = 'vijaykumar@relyonsoft.com';

//Insert this record to Database 'downloads'
$query = "INSERT INTO downloads (userid,emailid,productid,product,date,time) VALUES ('".$userid."', '".$emailid."','".$productrefid."','".$productname."','".$downloaddate."','".$downloadtime."')";
$result = runmysqlquery($query);
	
//Check if the user for respective product is already in the lead table. If not available then add it as a new lead
$query = "SELECT * FROM leads WHERE userid = '".$userid."' and productid = '".$productrefid."' and leaddatetime > DATE_ADD(CURDATE(),INTERVAL -250  DAY)";
$result = runmysqlquery($query);
$leadpresence = mysqli_num_rows($result);
if($leadpresence == 0)
{
	//If not in the lead table, check, is it present for some other product in lead table for any dealer [other than unmapped contact]
	$query = "SELECT dealers.id AS id, dealers.dlrname AS dlrname, dealers.dlrcompanyname AS dlrcompanyname, dealers.dlraddress AS dlraddress, dealers.dlrcell AS dlrcell, dealers.dlrphone AS dlrphone, dealers.dlremail AS dlremail FROM leads JOIN dealers ON leads.dealerid = dealers.id WHERE userid = '".$userid."' AND dealerid <> '999999'";
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
		
		//if not, then check the mapping table for respective product category/region and pick respective dealer ID.
		$query = "SELECT * FROM mapping WHERE regionid = '".$regionid."' AND prdcategory = '".$prdcategory."'";
		$result = runmysqlquery($query);
		$mappingcount = mysqli_num_rows($result);
		
		//If mapping exists for that region and product, pick respective dealer address
		if($mappingcount == 1)
		{
			$result = runmysqlqueryfetch($query);
			$query = "SELECT * FROM dealers WHERE id = '".$result['dealerid']."'";
			$result = runmysqlqueryfetch($query);
			
			$dwndlrid = $result['id'];
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

	//Update the download information to lead table for above said dealer
//	$query = "insert into `leads` (userid, dealerid, productid, dateoflead, source) values('".$userid."', '".$dwndlrid."', '".$productrefid."', '".$downloaddate."', 'Product Download')";
	$query = "insert into `leads` (userid, dealerid, productid, dateoflead, source, company, name, address, place, regionid, phone, emailid, refer) values('".$userid."', '".$dwndlrid."', '".$productrefid."', '".$downloaddate."', 'Product Download', '".$company."', '".$name."', '".$address."', '".$place."', '".$regionid."', '".$phone."', '".$emailid."', '".$refer."')";
	$result = runmysqlquery($query);
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

//Put the details to UserAdmin Program through calling Capture.php
//----------------------------------------------------------------------------------

if($existingcust == 'Yes') $existingcustint = '1';
else $existingcustint = '0';

$arg = "email=".urlencode($emailid)."&state=".urlencode($state)."&district=".urlencode($district)."&telno=".urlencode($phone)."&organization=".urlencode($company)."&dealer=".urlencode($dwndlrcompanyname)."&customer=".urlencode($existingcustint)."&referance=".urlencode($refer)."&product=".urlencode($productname)."&cperson=".urlencode($name);

file('http://useradmin.relyonsoft.com/capture.php?'.$arg);
//----------------------------------------------------------------------------------


//Email download information to user
$FromName = "Relyon";
$FromAddress =  "BigMail@relyonsoft.com";
$MailSubject = "Dear ".$name.", Thank you for Downloading Relyon ".$productname.".";
$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$FromName.' <'.$FromAddress.'>' . "\r\n";
$msg = file_get_contents("../inc/mail-download-user.htm");
$array = array(
	"##NAME##" => $name,
	"##PRODUCTNAME##" => $productname,
	"##DLRCOMPANYNAME##" => $dwndlrcompanyname,
	"##DLRNAME##" => $dwndlrname,
	"##DISTRICT##" => $district,
	"##DLRPHONE##" => $dwndlrphone,
	"##DLRCELL##" => $dwndlrcell,
	"##DLREMAIL##" => $dwndlremail
);
//echo($downloaddate." done");
$msg = replacemailvariable($msg,$array);

if (mail($name." <".$emailid.">", $MailSubject, $msg, $headers."Reply-To: ".$dwndlremail."\r\n"))
{

$headers .= 'Bcc: <bigmail@relyonsoft.com>';
$headers .= "\r\n";

$msg = file_get_contents("../inc/mail-download-relyon.htm");
$array = array(
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
$msg = replacemailvariable($msg,$array);
mail("Relyon WebDownload <".$dwndlremail.">", $productname." download by " . $name , $msg, $headers."Reply-To: ".$emailid."\r\n");
}

//Divert to download link
header("Location:".$downloadlink);

?>