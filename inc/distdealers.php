<?

$distdealers = "";

//If the user is not from Goa and not for CSD then check for mapping records
if($stateid <> "26" && $managedarea <> "CSD")
{
	$query = "select distinct dealers.id, dealers.dlrname, dealers.dlrcompanyname, dealers.dlraddress, dealers.district, dealers.dlrcell, dealers.dlrphone, dealers.dlremail from dealers 
	join mapping on mapping.dealerid = dealers.id 
	join regions on regions.subdistcode = mapping.regionid 
	inner join lms_users on lms_users.referenceid=dealers.id 
	where regions.distcode = '".$districtid."' and lms_users.disablelogin='no'";
	$result = runmysqlquery($query);
	$presence = mysqli_num_rows($result);
	if($presence > 0)
	//If mapping is available then pick it from mapping records
	{
		$distdealers = "<ol>";
		while($fetch = mysqli_fetch_array($result))
		{
			$distdealers .= "<li>";
			$distdealers .= $fetch['dlrname']."<br />";
			$distdealers .= $fetch['dlrcompanyname']."<br />";
			$distdealers .= $fetch['dlraddress']."<br />";
			$distdealers .= $fetch['district']."<br />";
			$distdealers .= "Cell No: ".$fetch['dlrcell']."<br />";
			$distdealers .= "Phone: ".$fetch['dlrphone']."<br />";
			$distdealers .= "Email: ".$fetch['dlremail']."<br /><br />";
			$distdealers .= "</li>";
			
		}
		$distdealers .= "</ol>";
	}
	//If mapping is not available, then take it from unmapped contacts
	else
	{
		$query = "SELECT * FROM unmappedcontact WHERE managedarea = '".$managedarea."'";
		$result = runmysqlqueryfetch($query);
		$distdealers = "<ol>";
		while($fetch = mysqli_fetch_array($result))
		{
			$distdealers .= "<li>";
			$distdealers .= $fetch['dlrname']."<br />";
			$distdealers .= $fetch['dlrcompanyname']."<br />";
			$distdealers .= $fetch['dlraddress']."<br />";
			$distdealers .= $district."<br />";
			$distdealers .= "Cell No: ".$fetch['dlrcell']."<br />";
			$distdealers .= "Phone: ".$fetch['dlrphone']."<br />";
			$distdealers .= "Email: ".$fetch['dlremail']."<br /><br />";
			$distdealers .= "</li>";
			
		}
		$distdealers .= "</ol>";
	}
}
//If the user is from GOA then take all the dealers present in dealer database for state of Goa.
elseif($stateid == "26")
{
	$query = "select distinct dealers.id, dealers.dlrname, dealers.dlrcompanyname, dealers.dlraddress, dealers.district, dealers.dlrcell, dealers.dlrphone, dealers.dlremail from dealers where stateid = '26'";
	$result = runmysqlquery($query);
	$presence = mysqli_num_rows($result);
	$distdealers = "<ol>";
	while($fetch = mysqli_fetch_array($result))
	{
		$distdealers .= "<li>";
		$distdealers .= $fetch['dlrname']."<br />";
		$distdealers .= $fetch['dlrcompanyname']."<br />";
		$distdealers .= $fetch['dlraddress']."<br />";
		$distdealers .= $fetch['district']."<br />";
		$distdealers .= "Cell No: ".$fetch['dlrcell']."<br />";
		$distdealers .= "Phone: ".$fetch['dlrphone']."<br />";
		$distdealers .= "Email: ".$fetch['dlremail']."<br /><br />";
		$distdealers .= "</li>";
		
	}
	$distdealers .= "</ol>";
}

if($distdealers == "")
$distdealers = "No Data available at this point of time.";
?>