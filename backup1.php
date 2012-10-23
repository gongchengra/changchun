<?php 
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes');
require_once 'PHPExcel.php';
require_once 'PHPExcel/Writer/Excel2007.php';
require_once('MySqlExcelBuilder.class.php');

include("includes/conn.php");
include("includes/link1.php");
$mysql_xls = new MySqlExcelBuilder($dbhost,$dbname,$dbuser,$dbpass);

$tables=$_POST['tables'];
$startid=$_POST['startid'];
$endid=$_POST['endid'];
$getprimary=mysqli_query($link, "SHOW INDEX from $tables where Key_name = 'PRIMARY'")
or die ("Could not match data because ".mysqli_error($link));
$getid=mysqli_fetch_array($getprimary);
$primaryid=$getid['Column_name'];
$tableinfo=mysqli_query($link, "SELECT * FROM $tables 
  WHERE $primaryid>='$startid' AND $primaryid<='$endid'") 
or die ("Could not match data because ".mysqli_error($link));
$sql_statement = <<<END_OF_SQL
SELECT * FROM $tables 
  WHERE $primaryid>='$startid' AND $primaryid<='$endid'
END_OF_SQL;

$mysql_xls->add_page('$tables',$sql_statement,$tables,'B',2);

$phpExcel = $mysql_xls->getExcel(); 
$phpExcel->setActiveSheetIndex(0);
$sheet = $phpExcel->getActiveSheet();
$objWriter = PHPExcel_IOFactory::createWriter($phpExcel, 'Excel5');
$fname = $tables.".xls";
$objWriter->save($fname);

// $outputFileName = $tables.".xlsx";
//到文件
// $objWriter->save($outputFileName);
//or
//到浏览器
// header("Content-Type: application/force-download");
// header("Content-Type: application/octet-stream");
// header("Content-Type: application/download");
// header('Content-Disposition:inline;filename="'.$outputFileName.'"');
// header("Content-Transfer-Encoding: binary");
// header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
// header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// header("Pragma: no-cache");
// $objWriter->save('php://output');


?>