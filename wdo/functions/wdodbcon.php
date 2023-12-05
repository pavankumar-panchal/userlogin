<?php
/***
	Created by		:Lawrence G J.
	Creation Date 	: 
	Last Modified	: 
	Modified by		: Lawrence G J.
	Version			: 
	Remarks			:
***/
	$dbhost="176.9.19.244";
	$dbusername="relyon_itruser";
	$dbuserpassword="20602061";
	$default_dbname="relyon_itr";
	
	$link_id=db_connect();
	
	function runwdodbquery($query)
	{
		global $link_id;
		$result = mysqli_query($query,$link_id);
		return ($result);
	}
	
	function db_connect($dbname="")
	{
		global $dbhost, $dbusername, $dbuserpassword, $default_dbname;
		global $mysqli_ERRNO, $mysqli_ERROR;
		
		$link_id=mysqli_connect($dbhost,$dbusername,$dbuserpassword);
		if(!$link_id)
		{
			$mysqli_ERRNO=0;
			$mysqli_ERROR='Connection failed to the host $dbhost.';
			return 0;
		}
		else if(empty($dbname) && !mysqli_select_db($default_dbname))
		{
			$mysqli_ERRNO=mysqli_errno();
			$mysqli_ERROR=mysqli_errno();
			return 0;			
		}
		else if(!empty($dbname) && !mysqli_select_db($dbname))
		{
			$mysqli_ERRNO=mysqli_error();
			$mysqli_ERROR=mysqli_error();
			return 0;
		}		
		else return $link_id;
	}
	
	function sql_error()
	{
		global $mysqli_ERRNO, $mysqli_ERROR;
		
		if(empty($mysqli_ERROR))
		{
			$mysqli_ERRNO=mysqli_errno();
			$mysqli_ERROR=mysqli_error();
		}
		return "$mysqli_ERRNO : $mysqli_ERROR";
	}
	
	
	
	

?>