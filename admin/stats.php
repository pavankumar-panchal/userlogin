<?php
//Check whether logged in and cookies are present
session_start();
if(isset($_SESSION['verifyid']))
{
	$adminuser = $_COOKIE['validemailid'];
	//If cookies are wrong, redirect back to login
	if($_SESSION['verifyid'] <> "10101102")
		header("Location:./index.php");
}
else //If cookies are not available redirect back to login
	header("Location:./index.php");


//Get Current Date
$differencetolocaltime=0;
$new_U=date("U")+$differencetolocaltime*3600;
$today = date("Y-m-d", $new_U);


//Split it to day, month and year
list($cyear,$cmonth,$cday)=split("[-.]",$today);

//connect to Server and database
mysqli_connect("176.9.19.244","relyon_newuser","hotelleela28") or die(mysqli_error());
mysqli_select_db("relyon_userlogin2") or die(mysqli_error());

/* Details of registrations*/
$reglastmonth = mysqli_num_rows(mysqli_query("select * from users where LEFT(`createdondate`,7) < LEFT('".$today."',7)"));
$regcurmonth = mysqli_num_rows(mysqli_query("select * from users where LEFT(`createdondate`,7) = LEFT('".$today."',7)"));
$regtoday = mysqli_num_rows(mysqli_query("select * from users where `createdondate` = '".$today."'"));

//Pick total count of Downloads [for all products] and assign it for All Time, Till Last Month, Current Month and Today.
$tottotal_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads"));
$totlastmonth_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where LEFT(`date`,7) < LEFT('".$today."',7)"));
$totcurmonth_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where LEFT(`date`,7) = LEFT('".$today."',7)"));
$tottoday_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where `date` = '".$today."'"));

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Relyon Registrations and Download Stats</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="/img/favicon.ico" />
<meta name="verify-v1" content="gBwvVqcU7Ol0vs0kLK/O3gBbLYq7Q+WXxlFJCtOfp6s=" />
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
	<a href="http://www.relyonsoft.com/aboutus/index.htm">Company</a> | 
	<a href="http://www.relyonsoft.com/products.htm">Relyon Products</a> | 
	<a href="http://www.relyonsoft.com/contactus.php">Contact Us</a>
		</TD></TR>
        <TR>
          <TD bgColor=#3f7c5f colSpan=2 height=1><IMG height=1 alt="" 
          width=1></TD></TR></TABLE>
	</td>
  </tr>
</table>
</td></tr>
<tr valign="top">
<td><div>&nbsp;
  <div align="right"><a href="logout.php">Logout</a></div>
</div>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="550" class="pagebody">
<table width="100%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="100%" class="pagebodyheading"><font size="-1"><strong>Registration and Download Stats</strong></font></td>
    </tr>
  <tr>
    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="141"><div align="center"><img src="../images/admin.gif" width="49" height="53" border="0"/></div></td>
        <td width="391" valign="middle"><div align="justify">Statistics of registrations and downloads through USERLOGIN...</div></td>
        </tr>
      
    </table></td>
  </tr>
  <tr>
    <td class="pagebodyheading"><font size="-1"><strong>Tabular view of Statistics</strong></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>	 	</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="2">

      <tr>
        <td width="30%" class="pagebodyheading"><strong>Registrations:</strong></td>
        <td width="17%" nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Total</strong></div></td>
        <td width="17%" nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Till Last Month</strong></div></td>
        <td width="17%" nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>This Month</strong></div></td>
        <td width="17%" nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Today</strong></div></td>
      </tr>
      <tr>
        <td>New Registrations</td>
        <td><div align="center"><? echo($reglastmonth + $regcurmonth); ?></div></td>
        <td><div align="center"><? echo($reglastmonth); ?></div></td>
        <td><div align="center"><? echo($regcurmonth); ?></div></td>
        <td><div align="center"><? echo($regtoday); ?></div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="pagebodyheading"><strong>Downloads Unique:</strong></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Total</strong>**</div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Till Last Month</strong></div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>This Month</strong></div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Today</strong></div></td>
      </tr>
<?
	//Pick the list of products and write the rows for each product with Toal, Till Last Month, Current Month and Today's download Count.
	$prodfetch = mysqli_query("SELECT DISTINCT `product` FROM downloads") or die(mysqli_error());
	while($prodrow = mysqli_fetch_array($prodfetch))
		{
			$prodname = $prodrow['product'];
			$prodtotal_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where `product` = '".$prodname."'"));
			$prodlastmonth_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where `product` = '".$prodname."' AND LEFT(`date`,7) < LEFT('".$today."',7)"));
			$prodcurmonth_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where `product` = '".$prodname."' AND LEFT(`date`,7) = LEFT('".$today."',7)"));
			$prodtoday_unq = mysqli_num_rows(mysqli_query("select DISTINCT `emailid` from downloads where `product` = '".$prodname."' AND `date` = '".$today."'"));
			
			echo("<tr><td>".$prodname."</td><td><div align=center>".$prodtotal_unq."</div></td><td><div align=center>".$prodlastmonth_unq."</div></td><td><div align=center>".$prodcurmonth_unq."</div></td><td><div align=center>".$prodtoday_unq."</div></td></tr>");
		}
?>
      <tr>
        <td>Total**</td>
        <td><div align="center"><? echo($tottotal_unq); ?></div></td>
        <td><div align="center"><? echo($totlastmonth_unq); ?></div></td>
        <td><div align="center"><? echo($totcurmonth_unq); ?></div></td>
        <td><div align="center"><? echo($tottoday_unq); ?></div></td>
      </tr>
      <tr>
        <td colspan="5">**Total of Unique downloads wont match with total of individual products as one user might have downloaded multiple products or may have downloaded in multiple months</td>
        </tr>
      <!--<tr>
        <td class="pagebodyheading"><strong>Downloads all:</strong></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Total</strong></div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Till Last Month</strong></div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>This Month</strong></div></td>
        <td nowrap="nowrap" class="pagebodyheading"><div align="center"><strong>Today</strong></div></td>
      </tr>
      <tr>
        <td>Saral ITR</td>
        <td><div align="center"><? echo($sitrlastmonth + $sitrcurmonth + $sitrtoday); ?></div></td>
        <td><div align="center"><? echo($sitrlastmonth); ?></div></td>
        <td><div align="center"><? echo($sitrcurmonth); ?></div></td>
        <td><div align="center"><? echo($sitrtoday); ?></div></td>
      </tr>
      <tr>
        <td>Saral TaxOffice</td>
        <td><div align="center"><? echo($stolastmonth + $stocurmonth + $stotoday); ?></div></td>
        <td><div align="center"><? echo($stolastmonth); ?></div></td>
        <td><div align="center"><? echo($stocurmonth); ?></div></td>
        <td><div align="center"><? echo($stotoday); ?></div></td>
      </tr>
      <tr>
        <td>Saral CompTax</td>
        <td><div align="center"><? echo($sclastmonth + $sccurmonth + $sctoday); ?></div></td>
        <td><div align="center"><? echo($sclastmonth); ?></div></td>
        <td><div align="center"><? echo($sccurmonth); ?></div></td>
        <td><div align="center"><? echo($sctoday); ?></div></td>
      </tr>
      <tr>
        <td>Saral PayPack</td>
        <td><div align="center"><? echo($spplastmonth + $sppcurmonth + $spptoday); ?></div></td>
        <td><div align="center"><? echo($spplastmonth); ?></div></td>
        <td><div align="center"><? echo($sppcurmonth); ?></div></td>
        <td><div align="center"><? echo($spptoday); ?></div></td>
      </tr>
      <tr>
        <td>Others</td>
        <td><div align="center"><? echo($otherslastmonth + $otherscurmonth + $otherstoday); ?></div></td>
        <td><div align="center"><? echo($otherslastmonth); ?></div></td>
        <td><div align="center"><? echo($otherscurmonth); ?></div></td>
        <td><div align="center"><? echo($otherstoday); ?></div></td> 
      </tr>
      <tr>
        <td>Total</td>
        <td><div align="center"><? echo($totlastmonth + $totcurmonth + $tottoday); ?></div></td>
        <td><div align="center"><? echo($totlastmonth); ?></div></td>
        <td><div align="center"><? echo($totcurmonth); ?></div></td>
        <td><div align="center"><? echo($tottoday); ?></div></td>
      </tr>-->
    </table></td>
    </tr>
</table>
</td>
<td class="columnBorder">&nbsp;</td>
<td width="218" valign="top" style="padding:5px; border-left: #3f7c5f solid 1px; border-right: #3f7c5f solid 1px; border-top: #3f7c5f solid 1px; border-bottom: #3f7c5f solid 2px"><? include("incadminnav.php"); ?></td>
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
