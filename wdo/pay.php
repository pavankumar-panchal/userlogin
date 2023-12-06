<?php
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

/***
	Created by		:Lawrence G J.
	Creation Date 	: 
	Last Modified	: 
	Modified by		: Lawrence G J.
	Version			: 
	Remarks			:
***/


$referurl = parse_url($_SERVER['HTTP_REFERER']);
$referhost = $referurl['host'];

if (isset($_POST["hidClientRegName"], $_POST["billing_cust_name"], $_POST["Tran_Amount"], $_POST["hidClientID"]) == false || ($referhost <> 'www.saralefile.com' && $referhost <> 'saralefile.com' && $referhost <> 'itr.saralefile.com' && $referhost <> 'www.itr.saralefile.com')) {
	echo ("Invalid Information.");
	exit;
}
include("../functions/phpfunctions.php");

include("functions/wdodbcon.php");

/*$uname = $_REQUEST['UNAME'];
   $asstyear = $_REQUEST['ASSTYEAR'];
   
   $query = "SELECT
`com_clientdet`.`PAYMENTAMOUNT` as paymentamount,
`com_clientdet`.`COMPANY` as company,
`mas_clientinfo`.`CLIENTLNAME` as contactperson,
`mas_clientinfo`.`EMAILID` as emailid,
`crm_finaddress`.`ADDRESSL1` as address,
`crm_finaddress`.`PLACE` as place,
`crm_finaddress`.`CITY` as city,
`crm_phone`.`PHONENUM` as phone,
`crm_finaddress`.`PINCODE` as pincode
FROM
`com_clientdet`
Inner Join `mas_clientinfo` ON `com_clientdet`.`CLIENTID` = `mas_clientinfo`.`CLIENTID`
Inner Join `crm_finaddress` ON `crm_finaddress`.`CLIENTID` = `mas_clientinfo`.`CLIENTID`
Inner Join `crm_phone` ON `crm_finaddress`.`CLIENTID` = `crm_phone`.`CLIENTID`
Inner Join `mas_state` ON `crm_finaddress`.`STATEID` = `mas_state`.`STATECODE`
where `com_clientdet`.`ASSYEAR`='".$asstyear."' and `com_clientdet`.`REQUESTPAYMENT`='Y' and `com_clientdet`.`PAYMENTSTATUS`='UNPAID' and `com_clientdet`.`UNAME`='".$uname."' ";
   //$result = runstidbquery($query);
   $result = runwdodbquery($query);
   $resultcount = mysqli_num_rows($result);
   if($resultcount == 0)
   {
	   echo("Invalid Information (".$uname." | ".$asstyear.")");
	   exit;
   }
   else
   {
	   $userdetails = mysqli_fetch_array($result);
   }*/


$query = "SHOW TABLE STATUS like 'transactions'";
$result = runicicidbquery($query);
$row = mysqli_fetch_array($result);
$nextautoincrementid = $row['Auto_increment'];

//Main Details
$merchatid = "00004074";
$date = datetimelocal('Y-m-d');
$time = datetimelocal('H:i:s');
$userip = $_SERVER["REMOTE_ADDR"];
$userbrowserlanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$userbrowseragent = $_SERVER["HTTP_USER_AGENT"];
$relyontransactionid = $nextautoincrementid;
$orderid = ""; //Optional
$responseurl = "http://userlogin.relyonsoft.com/wdo/complete.php"; //Should not exceed 80 Chars
$invoicenumber = ""; //Optional

$amount = $_POST["Tran_Amount"];


//User Details
$company = substr($_POST["hidClientRegName"], 0, 80); //Optional
$contactperson = substr($_POST["billing_cust_name"], 0, 50);
$address1 = substr($_POST["billing_cust_address"], 0, 50);
$address2 = ""; //Optional
$address3 = ""; //Optional
$city = substr($_POST["billing_City"], 0, 30);
$state = substr($_POST["billing_State"], 0, 30);
;
$country = "IND";
$pincode = $_POST["billing_zip_code"];
$phone = substr($_POST["billing_cust_tel"], 0, 15); //Optional
$emailid = substr($_POST["billing_cust_email"], 0, 80); //Optional
$customerid = ""; //Optional
$recordreference = $_POST["hidClientID"];


$productname = "Saral eFile";
$quantity = "1";

$query = "insert into `transactions` (date, time, userip, orderid, responseurl, invoicenumber, amount, company, contactperson, address1, address2, address3, city, state, pincode, phone, emailid, customerid, productname, quantity, userbrowserlanguage, userbrowseragent,recordreference)	values('" . $date . "', '" . $time . "', '" . $userip . "', '" . $orderid . "', '" . $responseurl . "', '" . $invoicenumber . "', '" . $amount . "', '" . $company . "', '" . $contactperson . "', '" . $address1 . "', '" . $address2 . "', '" . $address3 . "', '" . $city . "', '" . $state . "', '" . $pincode . "', '" . $phone . "', '" . $emailid . "', '" . $customerid . "', '" . $productname . "', '" . $quantity . "', '" . $userbrowserlanguage . "', '" . $userbrowseragent . "', '" . $recordreference . "')";
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

$oMPI = new MPIData();
$oCI = new CardInfo();
$oPostLibphp = new PostLibPHP();
$oMerchant = new Merchant();
$oBTA = new BillToAddress();
$oSTA = new ShipToAddress();
$oPGResp = new PGResponse();
$oPGReserveData = new PGReserveData();

$oSessionDetails = new SessionDetail();
$oCustomerDetails = new CustomerDetails();
$oOfficeAddress = new Address();
$oHomeAddress = new Address();
$oMerchanDise = new MerchanDise();
$oAirLineTransaction = new AirLineTransaction();


# Merchant ID,  Merchant ID(O), Merchant ID(O), UserIpAddress, TransactionID, OrderReference(O), ResponseURL, ResponseMethod(POST), Currency(INR), InvoiceNo(O), AuthorizationType(req.Preauthorization/req.Sale), Amount, GMTOffset(O), Extra1(O), Extra2(true), Extra3(O), Extra4(O), Extra5(O)
$oMerchant->setMerchantDetails($merchatid, $merchatid, $merchatid, $userip, $relyontransactionid, $orderid, $responseurl, "POST", "INR", $invoicenumber, "req.Sale", $amount, "", "", "true", "", "", "");

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oSTA->setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# CustomerID(O), CustomerName(O), Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oBTA->setAddressDetails($customerid, $company, $address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oHomeAddress->setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oOfficeAddress->setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# FirstName, LastName(O), OfficeAddress(O), HomeAddress(O), Mobile(O), RegistrationDate(O), BillingShippingSame(Y/N)
$oCustomerDetails->setCustomerDetails($contactperson, "", $oOfficeAddress, $oHomeAddress, $phone, "", "Y");

# ItemName, Quantity, Brand(O), Model(O), CustomerName(O), CardNameCustomerNameSame(O)
$oMerchanDise->setMerchanDiseDetails($productname, $quantity, "", "", $company, "");

# UserIP, CookieValue(O), BrowserCountry(O), BrowserLocalLanguage, BrowserLocalLangVariant(O), BrowserUserAgent
$oSessionDetails->setSessionDetails($userip, "", "", $userbrowserlanguage, "", $userbrowseragent);


# call a postSSL function
# for passing null for any parameter, just pass null
# eg to pass null for merchandise
# eg ->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);

$oPGResp = $oPostLibphp->postSSL($oBTA, $oSTA, $oMerchant, $oMPI, $oPGReserveData, $oCustomerDetails, $oSessionDetails, $oAirLineTransaction, $oMerchanDise);

if (java_values($oPGResp->getRespCode()) == '000') {
	$url = java_values($oPGResp->getRedirectionUrl());
	redirect($url);
} else {
	print "Error Occured.<br>";
	print "Error Code:" . java_values($oPGResp->getRespCode()) . "<br>";
	print "Error Message:" . java_values($oPGResp->getRespMessage()) . "<br>";
}

function redirect($url)
{
	if (headers_sent()) {
		?>
		<html>

		<head>
			<script language="javascript" type="text/javascript">
				window.self.location = '<?php print($url); ?>';
			</script>
		</head>

		</html>
		<?php
		exit;
	} else {
		header("Location: " . $url);
		exit;
	}
}








?>