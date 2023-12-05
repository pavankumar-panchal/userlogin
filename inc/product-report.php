<?php
	$query = "SELECT id,productname,category as productgroup FROM products order by productname;";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		 echo('<label for = "'.$fetch['productname'].'"><input type="checkbox" name="productname[]" id="'.$fetch['productname'].'"  producttype = "'.$fetch['category'].'"  value ="'.$fetch['id'].'" />&nbsp;'.$fetch['productname']);
		 echo('</label>');
		 echo('<br/>');
	}
?>
