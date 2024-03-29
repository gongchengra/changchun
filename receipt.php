<?php 
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes');
require_once 'PHPExcel.php';
require_once 'PHPExcel/Writer/Excel2007.php';

$objExcel = new PHPExcel();

$objWriter = new PHPExcel_Writer_Excel2007($objExcel);    // 用于其他版本格式

$objProps = $objExcel->getProperties();
$objProps->setCreator("GONG CHENG");
$objProps->setLastModifiedBy("GONG CHENG");
$objProps->setTitle("Office XLS Test Document");
$objProps->setSubject("Office XLS Test Document, Demo");
$objProps->setDescription("Test document, generated by PHPExcel.");
$objProps->setKeywords("office excel PHPExcel");
$objProps->setCategory("Test");

$objExcel->setActiveSheetIndex(0);

$objActSheet = $objExcel->getActiveSheet();

$objActSheet->setCellValue('A1',"收入");
$objActSheet->setCellValue('A2',"收据类型");
$objActSheet->setCellValue('B2',"收据时间");
$objActSheet->setCellValue('C2',"收据号码");
$objActSheet->setCellValue('D2',"收费金额");
$objActSheet->setCellValue('E2',"学员IC");
$objActSheet->setCellValue('F2',"学员姓名");
$objActSheet->setCellValue('G2',"学员电话");
$objActSheet->setCellValue('H2',"是否补交学费");
$objActSheet->setCellValue('I2',"是否老学员");
$objActSheet->setCellValue('J2',"课程类型");
$objActSheet->setCellValue('K2',"课程代码");
$objActSheet->setCellValue('L2',"相关收据");
$objActSheet->setCellValue('M2',"相关收据金额");
$objActSheet->setCellValue('N2',"收款人");
$objActSheet->setCellValue('O2',"分部");
$objActSheet->setCellValue('P2',"备注");

include("includes/conn.php");
include("includes/link1.php");
$receipt_startdate=strtotime($_POST['receipt_startdate']);
$receipt_enddate=strtotime($_POST['receipt_enddate']);
$branch=$_POST['hiddenbranch'];
$totalin=0;
$totalout=0;
$i=2;
$convert1 = array('1' => 'Link1','2' => 'Changchun','3' => 'SSA',
  '10' => '退款', '11' =>'工资', '12'=>'交通费',
  '13'=>'提成', '14'=>'加班费','15'=>'其他补贴','16'=>'办公支出',
  '17'=>'校长临时支出','18'=>'其他');
$checkreceiptinfo=mysqli_query($link, "SELECT * FROM receipt_info where UNIX_TIMESTAMP(receipt_date)>='$receipt_startdate' 
    AND UNIX_TIMESTAMP(receipt_date)<='$receipt_enddate' AND receipt_type<'10' AND
    (branch='$branch' OR '$branch'='changchun') AND status!='delete' 
    ORDER BY branch,receipt_type, receipt_date, receipt_no")
or die ("Could not match data because ".mysqli_error());
$numreceipt=mysqli_num_rows($checkreceiptinfo);
if($numreceipt>0)
{
  $convert = array('encmp' => '综合', 'encon' =>'会话', 'eness'=>'ESS', 'encos'=>'COS',
    'encom'=>'英文电脑', 'chcom'=>'华文电脑','chpin'=>'拼音','enpho'=>'音标',
    'engra'=>'语法','chwri'=>'华文作文','others'=>'其他', '' =>' ');
  while ($getreceiptinfo = mysqli_fetch_array($checkreceiptinfo)) 
  {
    $i=$i+1;
    $totalin=$totalin+$getreceiptinfo['amount'];
    $receiptype= $getreceiptinfo['receipt_type'];
    $convertype= $convert1[$receiptype];
    $objActSheet->setCellValue('A'.$i,$convertype);
    $receiptno=$getreceiptinfo['receipt_no'];
    if(($convertype=='changchun')&&(strlen($receiptno)!=7))
    {
        if(strlen($receiptno)==6)
        {
            $receiptno='B'.$receiptno;
        }
        if(strlen($receiptno)==5)
        {
            $receiptno='B0'.$receiptno;
        }
        if(strlen($receiptno)==4)
        {
            $receiptno='B00'.$receiptno;
        }
    }
    $objActSheet->setCellValue('B'.$i,$getreceiptinfo['receipt_date']);
    $objActSheet->setCellValue('C'.$i,$receiptno);
    $objActSheet->setCellValue('D'.$i,$getreceiptinfo['amount']);
    $objActSheet->setCellValue('E'.$i,$getreceiptinfo['receiptic']);
    $objActSheet->setCellValue('F'.$i,$getreceiptinfo['receiptname']);
    $objActSheet->setCellValue('G'.$i,$getreceiptinfo['receiptel']);
    $secondornot=($getreceiptinfo['secondornot']=='Y')?"是":"否";
    $objActSheet->setCellValue('H'.$i,$secondornot);
    $newstudent=($getreceiptinfo['newstudent']=='')?'':(($getreceiptinfo['newstudent']=='Y')?"是":"否");
    $objActSheet->setCellValue('I'.$i,$newstudent);
    $course_type= $getreceiptinfo['course_type'];
    $convertype= $convert[$course_type];
    $objActSheet->setCellValue('J'.$i,$convertype);
    $objActSheet->setCellValue('K'.$i,$getreceiptinfo['coursecode']);
    $objActSheet->setCellValue('L'.$i,$getreceiptinfo['relatedreceipt']);
    $objActSheet->setCellValue('M'.$i,$getreceiptinfo['relatedamount']);
    $objActSheet->setCellValue('N'.$i,$getreceiptinfo['receiptop']);
    $objActSheet->setCellValue('O'.$i,$getreceiptinfo['branch']);
    $objActSheet->setCellValue('P'.$i,$getreceiptinfo['remarks']);
  }
}

$i=$i+2;
$objActSheet->setCellValue('A'.$i,"支出");
$i=$i+1;
$objActSheet->setCellValue('A'.$i,"收据类型");
$objActSheet->setCellValue('B'.$i,"支出时间");
$objActSheet->setCellValue('C'.$i,"收据号码");
$objActSheet->setCellValue('D'.$i,"支出金额");
$objActSheet->setCellValue('E'.$i,"学员IC");
$objActSheet->setCellValue('F'.$i,"学员姓名");
$objActSheet->setCellValue('G'.$i,"学员电话");
$objActSheet->setCellValue('H'.$i,"是否补交学费");
$objActSheet->setCellValue('I'.$i,"是否老学员");
$objActSheet->setCellValue('J'.$i,"课程类型");
$objActSheet->setCellValue('K'.$i,"课程代码");
$objActSheet->setCellValue('L'.$i,"相关收据");
$objActSheet->setCellValue('M'.$i,"相关收据金额");
$objActSheet->setCellValue('N'.$i,"收款人");
$objActSheet->setCellValue('O'.$i,"分部");
$objActSheet->setCellValue('P'.$i,"备注");

$checkreceiptinfo1=mysqli_query($link, "SELECT * FROM receipt_info where UNIX_TIMESTAMP(receipt_date)>='$receipt_startdate' 
    AND UNIX_TIMESTAMP(receipt_date)<='$receipt_enddate' AND receipt_type>'9' AND
    (branch='$branch' OR '$branch'='changchun') AND status!='delete' ORDER BY branch,receipt_type")
or die ("Could not match data because ".mysqli_error());
$numreceipt1=mysqli_num_rows($checkreceiptinfo1);
if($numreceipt1>0)
{
  while ($getreceiptinfo = mysqli_fetch_array($checkreceiptinfo1)) 
  {
    $i=$i+1;
    $totalout=$totalout+$getreceiptinfo['amount'];
    $objActSheet->setCellValue('A'.$i,$getreceiptinfo['receiptid']);
    $receiptype= $getreceiptinfo['receipt_type'];
    $convertype= $convert1[$receiptype];
    $objActSheet->setCellValue('A'.$i,$convertype);
    $objActSheet->setCellValue('B'.$i,$getreceiptinfo['receipt_date']);
    $objActSheet->setCellValue('C'.$i,$getreceiptinfo['receipt_no']);
    $objActSheet->setCellValue('D'.$i,$getreceiptinfo['amount']);
    $objActSheet->setCellValue('E'.$i,$getreceiptinfo['receiptic']);
    $objActSheet->setCellValue('F'.$i,$getreceiptinfo['receiptname']);
    $objActSheet->setCellValue('G'.$i,$getreceiptinfo['receiptel']);
    $secondornot=($getreceiptinfo['secondornot']=='Y')?"是":"否";
    $objActSheet->setCellValue('H'.$i,$secondornot);
    $newstudent=($getreceiptinfo['newstudent']=='')?'':(($getreceiptinfo['newstudent']=='Y')?"是":"否");
    $objActSheet->setCellValue('I'.$i,$newstudent);
    $course_type= $getreceiptinfo['course_type'];
    $convertype= $convert[$course_type];
    $objActSheet->setCellValue('J'.$i,$convertype);
    $objActSheet->setCellValue('K'.$i,$getreceiptinfo['coursecode']);
    $objActSheet->setCellValue('L'.$i,$getreceiptinfo['relatedreceipt']);
    $objActSheet->setCellValue('M'.$i,$getreceiptinfo['relatedamount']);
    $objActSheet->setCellValue('N'.$i,$getreceiptinfo['receiptop']);
    $objActSheet->setCellValue('O'.$i,$getreceiptinfo['branch']);
    $objActSheet->setCellValue('P'.$i,$getreceiptinfo['remarks']);
  }
}


$outputFileName = "receipt.xlsx";
//到文件
// $objWriter->save($outputFileName);
//or
//到浏览器
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header('Content-Disposition:inline;filename="'.$outputFileName.'"');
header("Content-Transfer-Encoding: binary");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
$objWriter->save('php://output');


?>