<?php
include("../functions/phpfunctions.php");

$type = $_REQUEST['type'];
$code = $_REQUEST['code'];

switch($type)
{
	case "state":
		$query = "Select distinct distname, distcode from regions where statecode = '".$code."'";
		$result = runmysqlquery($query);
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			echo('<select name="district" id="district" onchange="districtselect(\'district\',\'regiondiv\')">');
			echo('<option value="" selected="selected"> - Make Selection - </option>');
			while($array = mysqli_fetch_array($result))
			{
				echo('<option value="'.$array['distcode'].'" >'.$array['distname'].'</option>');
			}
			echo('</select>');
		}
		else
		{
			echo('<select name="district" id="district" onchange="districtselect(\'district\',\'regiondiv\')">');
			echo('<option value="" selected="selected">- - - -Select a State First - - - -</option>');
			echo('</select>');
		}
		break;


	case "district":
		$query = "Select subdistname, subdistcode from regions where distcode = '".$code."'";
		$result = runmysqlquery($query);
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			echo('<select name="region" id="region">');
			echo('<option value="" selected="selected"> - Make Selection - </option>');
			while($array = mysqli_fetch_array($result))
			{
				echo('<option value="'.$array['subdistcode'].'" >'.$array['subdistname'].'</option>');
			}
			echo('</select>');
		}
		else
		{
			echo('<select name="region" id="region">');
			echo('<option value="" selected="selected">- - - -Select a District First - - - -</option>');
			echo('</select>');
		}
		break;
		case "statenew":
		$query = "Select distinct distname, distcode from regions where statecode = '".$code."'";
		$result = runmysqlquery($query);
		$count = mysqli_num_rows($result);
		if($count > 0)
		{
			echo('<select name="district" id="district" style = "width: 180px">');
			echo('<option value="" selected="selected"> - Make Selection - </option>');
			while($array = mysqli_fetch_array($result))
			{
				echo('<option value="'.$array['distcode'].'" >'.$array['distname'].'</option>');
			}
			echo('</select>');
		}
		else
		{
			echo('<select name="district" id="district" >');
			echo('<option value="" selected="selected">- - - -Select a State First - - - -</option>');
			echo('</select>');
		}
		break;
		
}
?>