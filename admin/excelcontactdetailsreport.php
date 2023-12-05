<?
ini_set('memory_limit', '2048M');

include('../functions/phpfunctions.php');

//PHPExcel
require_once '../phpgeneration/PHPExcel.php';

//PHPExcel_IOFactory
require_once '../phpgeneration/PHPExcel/IOFactory.php';

$state = $_POST['state'];
$district = $_POST['district'];
$region = $_POST['region'];
$uniquerecords = $_POST['uniquerecords'];
$loggedin = $_POST['loggedin'];

$id = $_GET['id'];


$statepiece = ($state == "")?(""):(" AND  regions.statecode = '".$state."' ");
$districtpiece = ($district == "")?(""):(" AND  regions.distcode = '".$district."' ");
$regionpiece = ($region == "")?(""):(" AND  regions.slno = '".$region."' ");
$loggedinpiece = ($loggedin == "")?(""):(" AND  users.logincount > 0 ");


$query = "select users.emailid, users.name,users.company,users.address,users.place, users.phone,users.cell,users.refer,regions.managedarea,usercategory.businesstype,usertype.customertype,regions.distname,regions.statename from users left join regions on regions.slno = users.regionid left join usercategory on usercategory.slno = users.categoryofuser
left join usertype on usertype.slno = users.typeofuser where users.subnewsletter = 'yes' ".$statepiece.$districtpiece.$regionpiece.$loggedinpiece."";

$result = runmysqlquery($query);

$fetchcount =  mysqli_num_rows($result);
$quotient = $fetchcount/5000;
$totallooprun = ($fetchcount % 5000 == 0)?($fetchcount/5000):(ceil($fetchcount/5000));
$slno =0;
$limit = 5000;
$slno1 =0;
for($i = 0; $i < $totallooprun ; $i++)
{
	if($i == 0)
	{
		$startlimit = 0;
		$slno1 = 0;
	}
	else
	{
		$startlimit = $slno1;
	}
	$addlimit = " LIMIT ".$startlimit.",".$limit."; ";
	$query1 = $query.$addlimit;
	$result1 = runmysqlquery($query1);
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	//Set Active Sheet	
	$mySheet = $objPHPExcel->getActiveSheet();
		
	//Define Style for header row
	$styleArray = array(
						'font' => array('bold' => true,),
						'fill'=> array('type'=> PHPExcel_Style_Fill::FILL_SOLID,'color'=> array('argb' => 'FFCCFFCC')),
						'borders' => array('allborders'=> array('style' => PHPExcel_Style_Border::BORDER_MEDIUM))
					);
	//Apply style for header Row
	$mySheet->getStyle('A3:K3')->applyFromArray($styleArray);
	
	//Merge the cell
	$mySheet->mergeCells('A1:K1');
	$mySheet->mergeCells('A2:K2');
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Relyon Softech Limited, Bangalore')
				->setCellValue('A2', 'Contact Details');
	$mySheet->getStyle('A1:A2')->getFont()->setSize(12); 	
	$mySheet->getStyle('A1:A2')->getFont()->setBold(true); 
	$mySheet->getStyle('A1:A2')->getAlignment()->setWrapText(true);
	
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A3', 'Sl No')
				->setCellValue('B3', 'Company Name')
				->setCellValue('C3', 'Address')
				->setCellValue('D3', 'Place')
				->setCellValue('E3', 'Phone')
				->setCellValue('F3', 'Cell')
				->setCellValue('G3', 'Email')
				->setCellValue('H3', 'Reference')
				->setCellValue('I3', 'Region')
				->setCellValue('J3', 'District')
				->setCellValue('K3', 'State');
	
	
	$j =4;
	$slno = 0;
	while($fetch = mysqli_fetch_array($result))
	{
		
		switch($uniquerecords)
			{
				
			case 'uniquecellno':
				{
					$splitcell = explode(',',$fetch['cell']);
					$countcell = count($splitcell);
					for($i=0;$i<$countcell;$i++)
					{
							$slno1++;
							$address = str_replace('=',' ',$fetch['address']);
							$mySheet->setCellValue('A' . $j,$slno)
									->setCellValue('B' . $j,$fetch['name'])
									->setCellValue('C' . $j,$address)
									->setCellValue('D' . $j,$fetch['place'])
									->setCellValue('E' . $j,$fetch['phone'])
									->setCellValue('F' . $j,$splitcell[$i])
									->setCellValue('G' . $j,$fetch['emailid'])
									->setCellValue('H' . $j,$fetch['refer'])
									->setCellValue('I' . $j,$fetch['managedarea'])
									->setCellValue('J' . $j,$fetch['distname'])
									->setCellValue('K' . $j,$fetch['statename']);
							$j++;
					}
				break;
				}
				default:
							
						$slno++;
						$slno1++;
						$address = str_replace('=',' ',$fetch['address']);
						$mySheet->setCellValue('A' . $j,$slno)
								->setCellValue('B' . $j,$fetch['name'])
								->setCellValue('C' . $j,$address)
								->setCellValue('D' . $j,$fetch['place'])
								->setCellValue('E' . $j,$fetch['phone'])
								->setCellValue('F' . $j,$fetch['cell'])
								->setCellValue('G' . $j,$fetch['emailid'])
								->setCellValue('H' . $j,$fetch['refer'])
								->setCellValue('I' . $j,$fetch['managedarea'])
								->setCellValue('J' . $j,$fetch['distname'])
								->setCellValue('K' . $j,$fetch['statename']);
						$j++;
	
		}
		
	}
	
	
	
	//Define Style for content area
	$styleArrayContent = array(
						'borders' => array('allborders'=> array('style' => PHPExcel_Style_Border::BORDER_THIN))
					);
	//Get the last cell reference
	$highestRow = $mySheet->getHighestRow(); 
	$highestColumn = $mySheet->getHighestColumn(); 
	$myLastCell = $highestColumn.$highestRow;
	
	//Deine the content range
	$myDataRange = 'A4:'.$myLastCell;
	if(mysqli_num_rows($result) <> 0)
	{
	//Apply style to content area range
		$mySheet->getStyle($myDataRange)->applyFromArray($styleArrayContent);
	}
	
	//set the default width for column
	$mySheet->getColumnDimension('A')->setWidth(6);
	$mySheet->getColumnDimension('B')->setWidth(30);
	$mySheet->getColumnDimension('C')->setWidth(17);
	$mySheet->getColumnDimension('D')->setWidth(31);
	$mySheet->getColumnDimension('E')->setWidth(13);
	$mySheet->getColumnDimension('F')->setWidth(16);
	$mySheet->getColumnDimension('G')->setWidth(13);
	$mySheet->getColumnDimension('H')->setWidth(30);
	$mySheet->getColumnDimension('I')->setWidth(30);
	$mySheet->getColumnDimension('J')->setWidth(16);
	$mySheet->getColumnDimension('K')->setWidth(12);
	
	$filebasename = 'Userlogin-Admin-user'.$i.'.xls';
	if($_SERVER['HTTP_HOST'] == 'rashmihk' || $_SERVER['HTTP_HOST'] == 'meghanab')  
	{
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/filecreated/'.$filebasename;
	}
	else
	{
		$filepath = $_SERVER['DOCUMENT_ROOT'].'/filecreated/'.$filebasename;

	}
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save($filepath);
	
	$filearray[] = $filebasename;
	$filepatharray[] = $filepath;
}

$filezipname = "Userlogin-Admin-user".$date.".zip";
if($_SERVER['HTTP_HOST'] == 'rashmihk' || $_SERVER['HTTP_HOST'] == 'meghanab')  
{
	$filezipnamepath = $_SERVER['DOCUMENT_ROOT'].'/userlogin/filecreated/'.$filezipname;
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/userlogin/filecreated/'.$filezipname;
}
else
{
	$filezipnamepath = $_SERVER['DOCUMENT_ROOT'].'/filecreated/'.$filezipname;
	$downloadlink = 'http://'.$_SERVER['HTTP_HOST'].'/filecreated/'.$filezipname; 
}
	
$zip = new ZipArchive;
$newzip = $zip->open($filezipnamepath, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
if ($newzip === TRUE)
 {
		for($i = 0;$i <count($filearray);$i++)
		{
			$zip->addFile($filepatharray[$i], $filearray[$i]);
		}
		$zip->close();
}
for($i = 0;$i <count($filearray);$i++)
{
	unlink($filepatharray[$i]) ;
}
downloadfile($downloadlink);

?>
