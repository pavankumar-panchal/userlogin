function getdistrict(divid,statecode)
{
    var districtcode = document.getElementById('district2').value;
	if(checkdistrictlist(districtcode, statecode) == true)
        return false;

	switch(statecode)
	{
		case '':
			districtlist = '<select name="district2" class="swiftselect" id="district2" style="width: 180px;"><option value="">ALL</option></select>';
			break;
<?
include('../functions/phpfunctions.php');

$querystate = "select distinct statecode from regions order by statename;";
$resultstate = runmysqlquery($querystate);
while($fetchstate = mysqli_fetch_array($resultstate))
{
	echo('case "'.$fetchstate['statecode'].'": districtlist = \'');
	$query = "select distinct distcode,distname from regions WHERE statecode = '".$fetchstate['statecode']."' order by distname;";
	$result = runmysqlquery($query);
	echo('<select name="district2" class="swiftselect" id="district2" style="width:180px;"><option value="">ALL</option>');
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['distcode'].'">'.$fetch['distname'].'</option>');
	}
	echo('</select>\'; break; ');
}

?>
	}
    alert('jjj');
	document.getElementById(divid).innerHTML = districtlist;
    return true;
}

function checkdistrictlist(districtcode, statecode)
{
    var fullstatearray = new Array();

<?
		$query1 = "select distinct statecode from regions order by statename";
		$result = runmysqlquery($query1);
		while($fetchstate = mysqli_fetch_array($result))
		{
			$statecode =$fetchstate['statecode'];
			echo("\n");
			echo("fullstatearray['".$statecode."'] = new Array(");
			$query = "SELECT distinct distcode FROM regions WHERE statecode = '".$statecode."' order by distname;";
			$result2 = runmysqlquery($query);
			$count = 1;
			while($fetch = mysqli_fetch_array($result2))
			{
				if($count > 1)
					echo(",");
				echo("'");
				echo($fetch['districtcode']);
				echo("'");
				$count++;
			}
			echo(");");
			echo("\n");
		}
?>
    if(in_array(districtcode,fullstatearray[statecode]))
		return true;
    else
		return false;
}

