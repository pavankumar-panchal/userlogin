<?
	$query = "SELECT slno,customertype FROM usertype ORDER BY customertype";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['slno'].'">'.$fetch['customertype'].'</option>');
	}
?>
