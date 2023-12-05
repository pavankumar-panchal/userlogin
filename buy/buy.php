<?php
include("../inc/checklogin.php"); 
include("../inc/userallfields.php"); 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Buy Relyon Products Online</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon user login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link rel="shortcut icon" type="image/x-icon" href="../images/favicon.ico" />
<script src="../functions/jsfunctions.js" language="javascript"></script></head>
<script src="../functions/buyonline.js" language="javascript"></script></head>
<body onload="productselection();">
<table width="771" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr valign="top">
    <td><? include("../inc/header2.php"); ?></td>
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
                <td width="100%" class="pagebodyheading"><strong>Buy Relyon Products/Services</strong></td>
              </tr>
              <tr>
                <td valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="buy_form" id="buy_form" onsubmit="return false;"><table width="99%" border="0" align="center" cellpadding="2" cellspacing="0">
                          <tr>
                            <td width="40%" class="buyonlinebox">
                                <div>
                                  <p align="left"><span style="font-size:16px; color:#006699; font-weight:bold">1. Select a Product/Service</span></p>
                                  <p>
                                    <strong>Products</strong><br />
                                    <label>
                                    <input name="buy_product" type="radio" id="buy_product1" value="tdsp" checked="checked" onclick="productselection()" />
                                    Saral TDS Professional</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsc" id="buy_product2" onclick="productselection()" />
                                    Saral TDS Corporate</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="tdsi" id="buy_product3" onclick="productselection()" />
                                    Saral TDS Institutional</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="sit" id="buy_product4" onclick="productselection()" />
                                    Saral IncomeTax</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="sto" id="buy_product5" onclick="productselection()" />
                                    Saral TaxOffice</label>
                                    <br />
                                    <label>
                                    <input type="radio" name="buy_product" value="ses" id="buy_product6" onclick="productselection()" />
Saral eSign</label>
                                  </p>
                                  <p><strong>Services</strong><br />
                                    <label>
                                    <input type="radio" name="buy_product" value="sppamc" id="buy_product7" onclick="productselection()" />
                                    Saral PayPack - Annual Maintenance Contract</label>
                                    <br />
                                  </p>
                                </div>                              </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="buyonlinebox"><p style="font-size:16px; color:#006699; font-weight:bold">2. Product Type <span id="buy_applicability" style="color:#FF0000"></span></p>
                              
                              <p><strong>Type of Usage:</strong> 
                                <label>
                                <input name="buy_usage" type="radio" id="buy_usage1" value="su" checked="checked" onclick="productselection()" />
Single User</label>
                                
                                <label>
                                <input type="radio" name="buy_usage" value="mu" id="buy_usage2" onclick="productselection()" />
Multi User (Network Usage)</label>
                                </p>
                              <p><strong>Type of Purchase: 
                                  <label>                                  </label>
                              </strong>
                                <label>
                                <input name="buy_purchase" type="radio" id="buy_purchase1" value="new" checked="checked" onclick="productselection()" />
New Purchase</label>
                                <label>
                                <input type="radio" name="buy_purchase" value="update" id="buy_purchase2" onclick="productselection()" />
Updation of Existing Verion</label>
                              </p></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="buyonlinebox"><p style="font-size:16px; color:#006699; font-weight:bold">3. Pricing</p>
                              <p>Price for the license:  <span id="buy_licensecost" style="color:#FF0000"></span><br />
                              Tax @ 12.3%: <span id="buy_tax" style="color:#FF0000"></span><br />
                              Total Value of the purchase: <span id="buy_totalprice" style="color:#FF0000"></span>
                              <input type="hidden" name="buy_totalprice_hidden" id="buy_totalprice_hidden" value="" />
                              </p>                              </td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="buyonlinebox"><p style="font-size:16px; color:#006699; font-weight:bold">4. Type of Payment</p>
                              <p><strong>Pay through:</strong> 
                                <label>
                                <input type="radio" name="buy_paymenttype" value="cc" id="buy_paymenttype1" disabled="disabled" />
Credit / Debit Card</label>
                                <label>
                                <input name="buy_paymenttype" type="radio" id="buy_paymenttype2" value="rc" checked="checked" />
Relyon Currency</label>
                                <br />
                              </p></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><div align="right">
                              <input name="buy_proceed" type="button" class="formbutton" style="cursor:hand" value="Proceed for Purchase" alt="Click here to Proceed" onclick="buyformsubmit();" />
                            </div></td>
                          </tr>
                        </table>
                      </form></td>
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
                    <ol>
                      <li>No shipping of the product will be done for ONLINE PURCHASES. </li>
                      <li>The amount paid for particular product, cannot be adjusted for any other  product or service of, either Relyon or others.</li>
                      <li>The payment once processed cannot be refund.</li>
                      <li>An Invoice for the Payment and the PIN Number of Registration will be delivered to your email ID.</li>
                    </ol>
                  </div></td>
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
      <div>&nbsp;</div>
      <BR>
    </td>
  </tr>
  <tr valign="top">
    <td><? include("../inc/footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
