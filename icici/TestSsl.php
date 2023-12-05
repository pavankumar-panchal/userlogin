<?php



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


//Main Details
$merchatid = "00004074";
$userip = $_SERVER["REMOTE_ADDR"];
$relyontransactionid = "12501";
$orderid = ""; //Optional
$responseurl = "http://userlogin.relyonsoft.com/icici/SFAResponse.php";
$invoicenumber = ""; //Optional
$amount = "10";

//User Details
$company = "ANC Company"; //Optional
$contactperson = "Vijay Kumar";
$address1 = "#101/2, Malleshwaram";
$address2 = ""; //Optional
$address3 = ""; //Optional
$city = "BANGALORE";
$state = "KARNATAKA";
$country = "IND";
$pincode = "560003";
$phone = "9449599733"; //Optional
$emailid = "vijaykumar@relyonsoft.com"; //Optional
$customerid = ""; //Optional


$productname = "Saral TDS";
$quantity = "1";



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
$oSessionDetails -> setSessionDetails($userip, "", "", $_SERVER["HTTP_ACCEPT_LANGUAGE"], "", $_SERVER["HTTP_USER_AGENT"]);


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