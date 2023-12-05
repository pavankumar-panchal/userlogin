<?
	$query = "select distinct statecode,statename from regions;";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['statecode'].'">'.$fetch['statename'].'</option>');
	}
?>
