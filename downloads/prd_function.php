<?php
include_once ('prd_config.php');


function product($product)
{	
	$query = "SELECT * FROM prdupdate WHERE product='".$product."' AND updatetype = 'versionupdate' AND showinweb = '1' ORDER BY slno DESC";
	$result = fetchhb($query);
	
$serial = 1;

	while ($row = mysqli_fetch_array($result)) 
	{
		$version = $row['patchversion'];
?>
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
    <td bgcolor="#D2E1F0" style="border:solid 1px #D2E1F0"><table width="100%" border="0" cellpadding="2" cellspacing="0" id="Specifications2">
        <tr>
          <td colspan="3"><strong><?php echo $serial++;?>. Product Upgrade</strong></td>
        </tr>
        <tr>
          <td width="33%">Version</td>
          <td width="30%"><strong><font color="#FF3300"> <?php echo $row['patchversion'];?> </font></strong></td>
          <td width="37%" rowspan="2"><a href="<?php echo $row['patchurl'];?>"><img src="../images/downloadbutton.gif" alt="Upgrade" width="38" height="39" border="0" /></a></td>
        </tr>
        <tr>
          <td>Release Dated</td>
          <td> <?php echo date("d M Y",strtotime($row['reldate']));?> </td>
        </tr>
        <tr>
          <td>Applicable to </td>
          <td colspan="2">Version <?php echo $row['applicable'];?> </td>
        </tr>
<?php
  hotfix($product,$version);
?>    </table></td>
<?php
 # hotfix($product,$version);
  	 }?>
<?php				
	
}


function hotfix($product,$version)
{	
	$query = "SELECT * FROM prdupdate WHERE product='".$product."' AND patchversion='".$version."' AND updatetype = 'hotfix' AND showinweb = '1' ORDER BY slno DESC";
	#echo "testing query og hotfix funct ".$query;
	$result = mysqli_query($query) or die('MySql Error' . mysqli_error());
	
	while ($row = mysqli_fetch_array($result)) 
	{

?>
  <tr>
    <td bgcolor="#D2E1F0" style="border:solid 0px #999999">
        <tr bgcolor="#ECF2F9">
          <td colspan="3"><font color="#FF3300"><strong> Hotfix </strong></font></td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td width="33%">Version</td>
          <td width="30%"><strong><font color="#FF3300"> <?php echo $row['hotfixno'];?> </font></strong></td>
          <td width="37%" rowspan="2"><a href="<?php echo $row['patchurl'];?>"><img src="../images/downloadbutton.gif" alt="Upgrade" width="38" height="39" border="0" /></a></td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td>Release Dated</td>
          <td><?php echo date("d M Y",strtotime($row['reldate']));?></td>
        </tr>
        <tr bgcolor="#ECF2F9">
          <td>Applicable to </td>
          <td colspan="2">v<?php echo $row['patchversion'];?></td>
        </tr>
    </td>
  </tr>
<?php }				
}
function main_product($product)
{	
	global $version;
	global $releasedate;
	global $filesize;
	global $downloadlink;
	
	$query_main = "SELECT * FROM saral_update WHERE product='".$product."' ORDER BY pid DESC LIMIT 1";
	$result = fetchhb($query_main);
	
	$row = mysqli_fetch_array($result);
	
	$version = $row['version'];
	$releasedate =  date("d F Y",strtotime($row['date']));
	$filesize = $row['size']." KB";
	$downloadlink = $row['url'];
}
?>