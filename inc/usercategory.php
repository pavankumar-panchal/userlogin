<?php
	$query = "SELECT slno,businesstype FROM usercategory ORDER BY businesstype";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['slno'].'">'.$fetch['businesstype'].'</option>');
	}
?>
