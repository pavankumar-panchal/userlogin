<?php

include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

$query = "SHOW TABLE STATUS like 'transactions'";
$result = runicicidbquery($query);
$row = mysqli_fetch_array($result);
$nextautoincrementid = $row['Auto_increment'];

$refcode = $userid;

//Main Details
$merchatid = "00004074";
$date = datetimelocal('Y-m-d');
$time = datetimelocal('H:i:s');
$userip = $_SERVER["REMOTE_ADDR"];
$userbrowserlanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$userbrowseragent = $_SERVER["HTTP_USER_AGENT"];
$relyontransactionid = $nextautoincrementid;
$orderid = ""; //Optional
$responseurl = "http://userlogin.relyonsoft.com/training/complete.php"; //Should not exceed 80 Chars
$invoicenumber = ""; //Optional
$amount = '3310.00';

//User Details
$company = substr($company,0,80); //Optional
$contactperson = substr($name['contactperson'],0,50);
$address1 = substr($address,0,50);
$address2 = substr($place,0,30); //Optional
$address3 = ""; //Optional
$city = substr($district,0,30);
$state = $state;
$country = "IND";
$pincode = "999999";
$phone = substr($phone,0,15); //Optional
$emailid = substr($emailid,0,80); //Optional
$customerid = ""; //Optional


$productname = "IncomeTax-TDS Training";
$quantity = "1";

$query = "insert into `transactions` (date, time, userip, orderid, responseurl, invoicenumber, amount, company, contactperson, address1, address2, address3, city, state, pincode, phone, emailid, customerid, productname, quantity, userbrowserlanguage, userbrowseragent,recordreference)	values('".$date."', '".$time."', '".$userip."', '".$orderid."', '".$responseurl."', '".$invoicenumber."', '".$amount."', '".$company."', '".$contactperson."', '".$address1."', '".$address2."', '".$address3."', '".$city."', '".$state."', '".$pincode."', '".$phone."', '".$emailid."', '".$customerid."', '".$productname."', '".$quantity."', '".$userbrowserlanguage."', '".$userbrowseragent."', '".$refcode."')";
$result = runicicidbquery($query);



// ICICI code begins. Do not alter anything Further - Vijay .................................................

include("Sfa/BillToAddress.php");
include("Sfa/CardInfo.php");
include("Sfa/Merchant.php");
include("Sfa/MPIData.php");
include("Sfa/ShipToAddress.php");
include("Sfa/PGResponse.php");
include("Sfa/PostLibPHP.php");
include("Sfa/PGReserveData.php");

include("Sfa/Address.php");
include("Sfa/SessionDetail.php");
include("Sfa/CustomerDetails.php");
include("Sfa/MerchanDise.php");
include("Sfa/AirLineTransaction.php");

$oMPI 			= 	new MPIData();
$oCI			=	new	CardInfo();
$oPostLibphp	=	new	PostLibPHP();
$oMerchant		=	new	Merchant();
$oBTA			=	new	BillToAddress();
$oSTA			=	new	ShipToAddress();
$oPGResp		=	new	PGResponse();
$oPGReserveData = 	new PGReserveData();

$oSessionDetails   	    =  new SessionDetail();
$oCustomerDetails   	=  new CustomerDetails();
$oOfficeAddress      	=  new Address();
$oHomeAddress    		=  new Address();
$oMerchanDise       	=  new MerchanDise();
$oAirLineTransaction 	=  new AirLineTransaction();


# Merchant ID,  Merchant ID(O), Merchant ID(O), UserIpAddress, TransactionID, OrderReference(O), ResponseURL, ResponseMethod(POST), Currency(INR), InvoiceNo(O), AuthorizationType(req.Preauthorization/req.Sale), Amount, GMTOffset(O), Extra1(O), Extra2(true), Extra3(O), Extra4(O), Extra5(O)
$oMerchant -> setMerchantDetails($merchatid, $merchatid, $merchatid, $userip, $relyontransactionid, $orderid, $responseurl, "POST", "INR", $invoicenumber, "req.Sale", $amount, "", "", "true", "", "", "");

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oSTA -> setAddressDetails ($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# CustomerID(O), CustomerName(O), Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oBTA -> setAddressDetails ($customerid, $company, $address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oHomeAddress -> setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oOfficeAddress -> setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# FirstName, LastName(O), OfficeAddress(O), HomeAddress(O), Mobile(O), RegistrationDate(O), BillingShippingSame(Y/N)
$oCustomerDetails -> setCustomerDetails($contactperson, "", $oOfficeAddress, $oHomeAddress, $phone, "", "Y");

# ItemName, Quantity, Brand(O), Model(O), CustomerName(O), CardNameCustomerNameSame(O)
$oMerchanDise -> setMerchanDiseDetails($productname, $quantity, "", "", $company, "");

# UserIP, CookieValue(O), BrowserCountry(O), BrowserLocalLanguage, BrowserLocalLangVariant(O), BrowserUserAgent
$oSessionDetails -> setSessionDetails($userip, "", "", $userbrowserlanguage, "", $userbrowseragent);


# call a postSSL function
# for passing null for any parameter, just pass null
# eg to pass null for merchandise
# eg ->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);

$oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);

if(java_values($oPGResp->getRespCode()) == '000')
{
	$url	=	java_values($oPGResp->getRedirectionUrl());
	redirect($url);
}
else
{
	print "Error Occured.<br>";
	print "Error Code:".java_values($oPGResp->getRespCode())."<br>";
	print "Error Message:".java_values($oPGResp->getRespMessage())."<br>";
}

	function redirect($url) 
	{
		if(headers_sent()) 
		{
			 ?>
			 <html><head>
			 <script language="javascript" type="text/javascript">
			  window.self.location='<?php print($url);?>';
			 </script>
			 </head></html>
			 <?php
			 exit;
		} 
		else 
		{
			 header("Location: ".$url);
			 exit;
		}
	}
 ?>