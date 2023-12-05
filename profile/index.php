<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 
$errormessage = "";
$message = "";
if(isset($_POST['update']))
{
if($_POST['update'] == "Update")
{
	//Assign all the submitted records and trim it. Use same variables used in fetching from database, so that it gets updated with latest.
	$secquestion = trim($_POST['usrsecquestion']);
	$secanswer = trim($_POST['usrsecanswer']);
	$name = trim($_POST['usrname']);
	$company = trim($_POST['usrcompany']);
	$address = trim($_POST['usraddress']);
	$place = trim($_POST['usrplace']);
	$cell = trim($_POST['usrcell']);
	$usrdistrictid = trim($_POST['district']);
	$phone = trim($_POST['usrphone']);
	$stdcode = trim($_POST['usrstdcode']);
	$existingcust = trim($_POST['usrexistingcust']);
	$subnewsletter = trim($_POST['subscribe']);
	
	//Record Updation Date
	$lastprofileupdate = datetimelocal("Y-m-d"); 
	
	//Update records in database
	$query = "UPDATE users SET secquestion = '".$secquestion."',secanswer = '".$secanswer."',name = '".$name."',company = '".$company."',address = '".$address."',place = '".$place."',stdcode = '".$stdcode."',phone = '".$phone."',cell = '".$cell."',existingcust = '".$existingcust."',subnewsletter = '".$subnewsletter."',lastprofileupdate = '".$lastprofileupdate."' WHERE emailid = '".$email."'";
	$result = runmysqlquery($query);
	//echo($query);
	//Success message
	$message = "Profile for ".$emailid." updated successfully.";

}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon User - Edit Profile</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script>
<script src="../functions/editprofile.js" language="javascript"></script>
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
<td width="550" rowspan="3" valign="top" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Edit profile for  <? echo($emailid); ?></strong></font></td>
    </tr>
  <tr>
    <td valign="top">
	<form action="" method="post" name="editprofile" id="editprofile" onSubmit="return valid(this)">

	<table width="100%" border="0" cellpadding="2" cellspacing="0">
<?  
if($message <> "")
echo('<tr>
    <td bgcolor="#FFFFCC" style="border: dashed 1px #999999" colspan="3"><div align="center"><font color="#339900">'.$message.'</font></div></td>
  </tr>');
else
echo('  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>');
?>
 <tr>
        <td width="23%"><strong>Your Name </strong>:</td>
        <td colspan="2"><input name="usrname" type="text" class="formfields" id="usrname" value="<? echo($name); ?>" size="30" maxlength="50"/></td>
      </tr>
      <tr>
        <td><strong>eMail ID </strong>:</td>
        <td colspan="2"><? echo($emailid); ?></td>
      </tr>
      
      <tr>
        <td><strong>Company </strong>:</td>
        <td colspan="2"><input name="usrcompany" type="text" class="formfields" id="usrcompany" value="<? echo($company); ?>" size="30" maxlength="50"/></td>
      </tr>
      <tr>
        <td><strong>Address </strong>:</td>
        <td colspan="2"><input name="usraddress" type="text" class="formfields" id="usraddress" value="<? echo($address); ?>" size="30" maxlength="80"/></td>
      </tr>
            <tr>
        <td><strong>STD Code</strong>:</td>
        <td colspan="2"><input name="usrstdcode" type="text" class="formfields" id="usrstdcode" value="<? echo($stdcode); ?>" size="30" maxlength="80"/></td>
      </tr>
      <tr>
        <td><strong>Phone </strong>:</td>
        <td colspan="2"><input name="usrphone" type="text" class="formfields" id="usrphone" value="<? echo($phone); ?>" size="30" maxlength="30"/></td>
      </tr>
      <tr>
        <td><strong>cell </strong>:</td>
        <td colspan="2"><input name="usrcell" type="text" class="formfields" id="usrcell" value="<? echo($cell); ?>" size="30" maxlength="30"/></td>
      </tr>
      <tr>
        <td><strong>Place </strong>:</td>
        <td colspan="2"><input name="usrplace" type="text" class="formfields" id="usrplace" value="<? echo($place); ?>" size="30" maxlength="30"/></td>
      </tr>
      <tr>
        <td><strong>State </strong>:</td>
        <td colspan="2"><? echo($state); ?></td>
      </tr>
      <tr>
        <td><strong>District </strong>:</td>
        <td colspan="2"><? echo($district); ?></td>
      </tr>
      <tr>
        <td><strong>Region </strong>:</td>
        <td colspan="2"><? echo($region); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
            <tr>
        <td><strong>Type </strong>:</td>
        <td colspan="2"><? echo($usrtype); ?></td>
      </tr>
      <tr>
        <td><strong>Category </strong>:</td>
        <td colspan="2"><? echo($usrcategory); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Security Question </strong>:</td>
        <td colspan="2"><input name="usrsecquestion" type="text" class="formfields" id="usrsecquestion" value="<? echo($secquestion); ?>" size="30" maxlength="50"/></td>
      </tr>
      <tr>
        <td><strong>Security Answer </strong>:</td>
        <td colspan="2"><input name="usrsecanswer" type="text" class="formfields" id="usrsecanswer" value="<? echo($secanswer); ?>" size="30" maxlength="15"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="36%">&nbsp;</td>
        <td width="41%">&nbsp;</td>
      </tr>
      <tr>
        <td><strong>Existing Customer </strong>:</td>
        <td colspan="2"><select name="usrexistingcust" size="1" class="formfields" id="usrexistingcust">
            <option value="Yes" <? if($existingcust == "Yes") echo(" selected='selected'"); ?> >Yes</option>
            <option value="No" <? if($existingcust == "No") echo(" selected='selected'"); ?> >No</option>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><input name="subscribe" type="checkbox" id="subscribe" value="yes" <? if($subnewsletter == "yes") echo(" checked='checked'"); ?> />
              <label for="subscribe">Receive  Newsletters</label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><div align="justify">By updating, you here by authenticate the updated information is correct and best of your knowledge. You also hereby admit, the information provided is nowhere phishing, spamming or related to fraud. </div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><input name="agree" type="checkbox" value="agree" id="agree"/><label for="agree">Yes, I'm ready to update my profile.</label></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input name="update" type="submit" class="formbutton" id="update" value="Update" />
  &nbsp;&nbsp;
  <input name="reset" type="reset" class="formbutton" id="reset" value="Clear" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
	</form>	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>	 	</td>
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
