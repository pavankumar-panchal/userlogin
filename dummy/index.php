
<?
if($_GET['phoneno'] == '') exit;

if(checkrelyondnd($_GET['phoneno']))
	echo("LISTED");
else
	echo("NOT LISTED");



function checkrelyondnd($phoneno)
{
	$req = "&phoneno=".$phoneno;
	$fp = @fsockopen ('ndncregistry.gov.in', 80, $errno, $errstr, 5);
	
	if($fp)
	{
		$header = "POST /ndncregistry/saveSearchSub.misc HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		fputs ($fp, $header . $req);
		// read the body data
		$res = '';
		$headerdone = false;
		while (!feof($fp)) 
		{
			$line = fgets ($fp, 1024);
			if (strcmp($line, "\r\n") == 0) 
			{
				// read the header
				$headerdone = true;
			}
			else if ($headerdone)
			{
				// header has been read. now read the contents
				if(strstr($line, "in NDNC Registry Database"))
				{
					if(strpos($line,"is Registered"))
						return true;
					else
						return false;
				}
			}
		}
	}
}
?>