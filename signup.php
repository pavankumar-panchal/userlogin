<?php

include("./functions/phpfunctions.php");

//Check whether freshly loaded page or Submitted page
if($_POST['createuser'] == "Create User")
	{
	//Get all the fields, Trim it and assign to Variables
	$email = trim($_POST['usremailid']);
	$usrsecquestion = trim($_POST['usrsecquestion'],"'");
	$usrsecanswer = trim($_POST['usrsecanswer'],"'");
	$usrname = trim($_POST['usrname'],"'");
	$usrcompany = trim($_POST['usrcompany'],"'");
	$usraddress = trim($_POST['usraddress'],"'");
	$usrplace = trim($_POST['usrplace'],"'");
	$usrcell = trim($_POST['usrcell'],"'");
	$usrtype = trim($_POST['usrtype'],"'");
	$usrcategory = trim($_POST['usrcategory'],"'");
	$usrregionid = trim($_POST['region'],"'");
	$usrphone = trim($_POST['usrphone'],"'");
	$usrstdcode = trim($_POST['usrstdcode'],"'");
	$usrexistingcust = trim($_POST['usrexistingcust'],"'");
	$usrrefer = trim($_POST['usrrefer'],"'");
	$subscribe = trim($_POST['subscribe'],"'");
	$errormessage = "";
	
	$query = "SELECT * FROM users WHERE emailid = '".$email."'";
	$result = runmysqlquery($query);
	$emailpresence = mysqli_num_rows($result);

	if(checkemailaddress($email) == false)
	{
		$errormessage = "Invalid Email Address Format. Please check...";
	}
	elseif($emailpresence > 0)
	{
		$errormessage = "This email ID is already registered. Please use <a href='rtrpassword.php'>Retrive password</a> option to get the password.";
	}
	else
	{
		//Generate Password
		$usrpassword = generatepwd();

		//Record IP and Creation Date
		$createdondate = datetimelocal("Y-m-d"); 
		$createdonip = getenv("REMOTE_ADDR");
		
		//Insert the new record to database.
		$query = "insert into `users` (emailid, password, secquestion, secanswer, name, company, address, place, regionid, phone, existingcust, refer, createdondate, createdonip, lastlogindate, lastloginip, logincount, subnewsletter, lastprofileupdate,cell,typeofuser,categoryofuser,stdcode) values ('".$email."', '".$usrpassword."', '".$usrsecquestion."', '".$usrsecanswer."', '".$usrname."', '".$usrcompany."', '".$usraddress."', '".$usrplace."', '".$usrregionid."', '".$usrphone."', '".$usrexistingcust."', '".$usrrefer."', '".$createdondate."', '".$createdonip."', '', '', '0', '".$subscribe."', '', '".$usrcell."', '".$usrtype."', '".$usrcategory."', '".$usrstdcode."')";
		$result = runmysqlquery($query);
		
		//Get total number of users now in database
		$query = "SELECT * FROM users";
		$result = runmysqlquery($query);
		$totalusers = mysqli_num_rows($result);
		
		//Get the name of State, District and Region for region id
		$query = "SELECT * FROM regions WHERE subdistcode = '".$usrregionid."'";
		$result = runmysqlqueryfetch($query);
		$state = $result['statename'];
		$district = $result['distname'];
		$region = $result['subdistname'];

		require_once("functions/RSLMAIL_MAIL.php");
		$subject1 = "Your Relyonsoft.com subscription account has been activated.";
		$fromname = "Relyon";
		$fromemail =  "imax@relyon.co.in";
		$msg1 = file_get_contents("./inc/mail-signup-user.htm");
		$text = "This is a HTML format email. Please enable HTML viewing in your email client.";
		$toarray1[$usrname] = $email;
		//$toarray1[$usrname] = 'meghana.b@relyonsoft.com';
		$array1 = array();
		$array1[] = "##NAME##%^%".$usrname;
		$array1[] = "##EMAIL##%^%".$email;
		$array1[] = "##PASSWORD##%^%".$usrpassword;
		$msg1 = replacemailvariablenew($msg1,$array1);
		$html1 = $msg1;
		
		rslmail($fromname,$fromemail,$toarray1,$subject1,$text,$html1,null,null,null);
		
		$toarray['Subscriptions'] = 'subscriptions@relyonsoft.com';
		//$toarray[$usrname] = 'meghana.b@relyonsoft.com';
		$subject = "New Userlogin created. Total Users ".$totalusers;
		$msg = file_get_contents("./inc/mail-signup-relyon.htm");
		$array = array();
		$array[] = "##EMAIL##%^%".$email;
		$array[] = "##PASSWORD##%^%".$usrpassword;
		$array[] = "##NAME##%^%".$usrname;
		$array[] = "##COMPANY##%^%".$usrcompany;
		$array[] = "##ADDRESS##%^%".$usraddress;
		$array[] = "##STDCODE##%^%".$usrstdcode;
		$array[] = "##PHONE##%^%".$usrphone;
		$array[] = "##CELL##%^%".$usrcell;
		$array[] = "##PLACE##%^%".$usrplace;
		$array[] = "##STATE##%^%".$state;
		$array[] = "##DISTRICT##%^%".$district;
		$array[] = "##REGION##%^%".$region;
		$array[] = "##EXISTINGCUST##%^%".$usrexistingcust;
		$array[] = "##REFER##%^%".$usrrefer;
		$array[] = "##SECQUESTION##%^%".$usrsecquestion;
		$array[] = "##SECANSWER##%^%".$usrsecanswer;
		$array[] = "##CREATEDONDATE##%^%".changedateformat($createdondate);
		$array[] = "##CREATEDONIP##%^%".$createdonip;
		$array[] = "##SUBSCRIBE##%^%".$subscribe;
		$array[] = "##TOTALCOUNT##%^%".$totalusers;
		

		$msg = replacemailvariablenew($msg,$array);
		$html = $msg;
		
		rslmail($fromname,$fromemail,$toarray,$subject,$text,$html,null,null,null);
					
		//Set Cookie for confirmation page
		setcookie(confirmemailid, $email); 
		//Direct to Signup Confirmation Page
		header("Location:./createsuccess.php");
	}
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Signup for Subscribed Services</title>
<meta name="keywords" content="Registration">
<meta name="description" content="Signup for free downloads, newsletters and many more..">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
<script src="functions/jsfunctions.js" language="javascript"></script>
<script src="functions/signup.js" language="javascript"></script>
</head>
<body>
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
<tr valign="top"><td>
<?php include("./inc/header.php"); ?></td></tr>
<tr valign="top">
  <td height="20"></td>
</tr>
<tr valign="top">
<td height="20">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td colspan="3" style="padding-right:10px"><div align="right"><a href="http://userlogin.relyonsoft.net">Home</a></div></td>
</tr>
<tr>
<td width="550" class="pagebody">
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td><p><strong>Signup for  free..</strong></p>
            <p>To register for a free Relyonsoft.com Account, please complete the following form.</p>
            <p align="justify"><font color="#CC3300"><span class="elevensize">PLEASE NOTE: Account will be Registered and password will be sent over email. User can later change the password. Account left unconfirmed for more than 3 Days will be deleted automatically.</span></font></p>
            <p><span class="elevensize"><font color="#FF0000">*</font> Required fields</span></p>            </td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="20"><noscript>This requires javascript to be enabled in the browser/system.</noscript></td>
    </tr>
    <tr>
      <td><form action="signup.php" method="post" name="signupform" id="signupform" onsubmit="return valid(this)">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td colspan="4" class="pagebodyheading"><strong>Signup Information </strong></td>
          </tr>
          <?php  
if($errormessage <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="4"><div align="center"><font color="#FF0000">'.$errormessage.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td height="20" colspan="4"></td>
  </tr>');
?>
          <tr>
            <td>eMail ID : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usremailid" type="text" class="formfields" id="usremailid" size="30" maxlength="50"/></td>
          </tr>
          <tr>
            <td>Company : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usrcompany" type="text" class="formfields" id="usrcompany" size="30" maxlength="50"/></td>
          </tr>
           <tr>
            <td>Your Name : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usrname" type="text" class="formfields" id="usrname" size="30" maxlength="50"/></td>
          </tr>
         <tr>
            <td>Address : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usraddress" type="text" class="formfields" id="usraddress" size="30" maxlength="80"/></td>
          </tr>
           <tr>
            <td width="24%">STD Code : <font color="#FF0000"></font> </td>
            <td colspan="2"><input name="usrstdcode" type="text" class="formfields" id="usrstdcode" size="30"/></td>
          </tr>
          <tr>
            <td width="24%">Phone : <font color="#FF0000"></font> </td>
            <td colspan="2"><input name="usrphone" type="text" class="formfields" id="usrphone" size="30"/></td>
          </tr>
          <tr>
            <td width="24%">Cell : <font color="#FF0000">*</font></td>
            <td colspan="2"><input name="usrcell" type="text" class="formfields" id="usrcell" size="30"/></td>
          </tr>
          <tr>
            <td>Place : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usrplace" type="text" class="formfields" id="usrplace" size="30" maxlength="30"/></td>
          </tr>
          <tr>
            <td height="20"></td>
            <td colspan="2"></td>
          </tr>
                    <tr>
            <td width="24%">Type :</td>
            <td colspan="2"><select name="usrtype" class="formfields" id="usrtype" style="width:200px" >
                <option value="" selected="selected">- - -Make a Selection- - -</option><?php include('inc/usertype.php'); ?></select></td>
          </tr>
          <tr>
            <td>Category :</td>
            <td colspan="2"><select name="usrcategory" class="formfields" id="usrcategory" style="width:200px" >
                <option value="" selected="selected">- - -Make a Selection- - -</option><?php include('inc/usercategory.php'); ?></select></td>
          </tr>
          <tr>
            <td height="20"></td>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td><span class="elevensize"># </span>State : <font color="#FF0000">*</font> </td>
            <td colspan="2"><div id="statediv">
              <select name="state" class="formfields" id="state" onchange="districtselect('state','districtdiv')">
                <option value="" selected="selected">- - -Make a Selection- - -</option>
                <option value="1">ANDHRA PRADESH</option>
                <option value="2">ASSAM</option>
                <option value="3">ARUNACHAL PRADESH</option>
                <option value="4">BIHAR</option>
                <option value="5">GUJRAT</option>
                <option value="6">HARYANA</option>
                <option value="7">HIMACHAL PRADESH</option>
                <option value="8">JAMMU &amp; KASHMIR</option>
                <option value="9">KARNATAKA</option>
                <option value="10">KERALA</option>
                <option value="11">MADHYA PRADESH</option>
                <option value="12">MAHARASHTRA</option>
                <option value="13">MANIPUR</option>
                <option value="14">MEGHALAYA</option>
                <option value="15">MIZORAM</option>
                <option value="16">NAGALAND</option>
                <option value="17">ORISSA</option>
                <option value="18">PUNJAB</option>
                <option value="19">RAJASTHAN</option>
                <option value="20">SIKKIM</option>
                <option value="21">TAMIL NADU</option>
                <option value="22">TRIPURA</option>
                <option value="23">UTTAR PRADESH</option>
                <option value="24">WEST BENGAL</option>
                <option value="25">DELHI</option>
                <option value="26">GOA</option>
                <option value="27">PONDICHERY</option>
                <option value="28">LAKSHDWEEP</option>
                <option value="29">DAMAN &amp; DIU</option>
                <option value="30">DADRA &amp; NAGAR</option>
                <option value="31">CHANDIGARH</option>
                <option value="32">ANDAMAN &amp; NICOBAR</option>
                <option value="33">UTTARANCHAL</option>
                <option value="34">JHARKHAND</option>
                <option value="35">CHATTISGARH</option>
                <option value="36">OUTSIDE INDIA</option>
                <option value="37">TELANGANA</option>
              </select>
            </div></td>
          </tr>

          <tr>
            <td><span class="elevensize"># </span>District: <font color="#FF0000">*</font> </td>
            <td colspan="2">
              <div id="districtdiv">
                <select name="district" class="formfields" id="district" onchange="districtselect('district','regiondiv')">
                  <option value = "">- - - -Select a State First - - - -</option>
                </select>
                </div></td>
          </tr>

          <tr>
            <td>Region: <font color="#FF0000">*</font> </td>
            <td colspan="2">
                <div id="regiondiv">
                  <select name="region" class="formfields" id="region">
                    <option value = "">- - - -Select a District First - - - -</option>
                  </select>
                    </div></td>
          </tr>


          <tr>
            <td height="20" colspan="4"></td>
          </tr>
          <tr>
            <td><span class="elevensize">^ </span>Security Question : <font color="#FF0000">*</font> </td>
            <td colspan="2"><input name="usrsecquestion" type="text" class="formfields" id="usrsecquestion" value="Your Favourite Nick Name?" size="30" maxlength="50"/></td>
          </tr>

          <tr>
            <td><span class="elevensize">~ </span>Security Answer : <font color="#FF0000">*</font> </td>
            <td colspan="2"><strong><input name="usrsecanswer" type="password" class="formfields" id="usrsecanswer" size="30" maxlength="15" autocomplete = "off"/>
            </strong></td>
          </tr>
          <tr>
            <td height="20"></td>
            <td colspan="3"></td>
          </tr>
          <tr>
            <td>Existing Customer : <font color="#FF0000">*</font> </td>
            <td colspan="2"><strong><select name="usrexistingcust" size="1" class="formfields" id="usrexistingcust">
                <option value="" selected="selected">- - -Make a Selection- - -</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select></strong></td>
          </tr>
          <tr>
            <td>Reference : <font color="#FF0000">*</font> </td>
            <td colspan="3"><strong><select name="usrrefer" size="1" class="formfields" id="usrrefer">
                <option value="" selected="selected">- - -Make a Selection- - -</option>
                <option value="Advertisement">Advertisement</option>
                <option value="Email">Email</option>
                <option value="Existing Customer">Existing Customer</option>
                <option value="Mailer - Letter">Mailer - Letter</option>
                <option value="NSDL/Income Tax website">NSDL/Income Tax website</option>
                <option value="Reference from customer">Reference from customer</option>
                <option value="Relyon Representative">Relyon Representative</option>
                <option value="Web Search/Search Engine">Web Search/Search Engine</option>
                <option value="Others">Others</option>
            </select></strong></td>
          </tr>

          <tr>
            <td height="20" colspan="4"></td>
          </tr>

          <tr>
            <td></td>
            <td colspan="3"><input name="subscribe" type="checkbox" id="subscribe" value="yes" checked="checked" />
              <label for="subscribe">Subscribe to Newsletters</label></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="3"><input name="agreeonline" type="checkbox" value="agreeonline" id="agreeonline"/>
                <label for="agreeonline">Agree to <a href="http://www.relyonsoft.com/help/online.htm" target="_blank">Relyon Online Services Agreement</a></label></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="3"><input name="agreeprivacy" type="checkbox" value="agreeprivacy" id="agreeprivacy"/>
                <label for="agreeprivacy">Agree to <a href="http://www.relyonsoft.com/help/privacy.htm" target="_blank">Relyon Online Privacy Policy</a></label></td>
          </tr>
          <tr>
            <td height="20" colspan="4"></td>
          </tr>

          <tr>
            <td height="20" valign="top"></td>
            <td width="42%"></td>
            <td width="34%">
            
            <strong>
            
            <script> document.write('<input name="createuser" type="submit" class="formbutton" id="createuser" value="Create User" />');</script>
            
            
              &nbsp;&nbsp;
              <input name="reset" type="reset" class="formbutton" id="reset" value="Clear" /></strong></td>
          </tr>
        </table>
      </form></td>
    </tr>
    <tr>
      <td class="elevensize"><div align="justify">
        <p>Note:</p>
        <ol>
          <li>Fraud Prevention purposes, we have recorded &quot;<?php echo(getenv("REMOTE_ADDR")); ?>&quot; as your connection IP Address and also recorded the time of your submission</li>
          <li>Email ID Provided above will be your user ID for future logins. Account password will be sent to this e-mail address.</li>
          <li>By providing your information and continuing, you are agreeing to the <a href="http://www.relyonsoft.com/help/online.htm" target="_blank">Relyon Terms of Use</a> and <a href="http://www.relyonsoft.com/help/privacy.htm" target="_blank">Privacy Policy</a>, including communications from Relyon. </li>
          <li>By submitting this information, you agree that Relyon may contact you by mail, email or telephone to provide information and discuss your interest in the Relyon products and Services.</li>
        </ol>
        <p>         # Please note to select proper STATE and DISTRICT. This cannot be altered later. <br />
          ^ Authentication in case of Forgotten User ID or Password. This will be displayed in such case. Avoid providing password in this field.<br />
          ~ Remember this answer. This should be answered in case of Forgotten ID or password.</p>
      </div></td>
    </tr>
  </table>  </td>
<td class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><?php include("./inc/incmemberbenifits.php"); ?></td>
</tr>
</table>	
<div><strong>&nbsp;</strong></div><strong><BR>
</strong></td>
</tr>
<tr valign="top"><td><?php include("./inc/footer.php"); ?></td>
</tr>
</table>
</body>
</html>
