<?php

error_reporting(E_ALL);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
if ( $_FILES['file']['tmp_name'] )
{
  $inputFileType = 'Excel2007'; 
  $inputFileName = $_FILES['file']['tmp_name'];
  // $sheetnames = array('ATOUpload'); 

  /**  Create a new Reader of the type defined in $inputFileType  **/ 
  $objReader = PHPExcel_IOFactory::createReader($inputFileType); 
  /**  Advise the Reader of which WorkSheets we want to load  **/ 
  /**  Load $inputFileName to a PHPExcel Object  **/ 
  // $objReader->setLoadSheetsOnly($sheetnames); 
  $objPHPExcel = $objReader->load($inputFileName);

  echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using PHPExcel_Reader_Excel5<br />';
  // $objReader = new PHPExcel_Reader_Excel5();
  // $objReader = new PHPExcel_Reader_Excel5();
  //  $objReader = new PHPExcel_Reader_Excel2007();
  //  $objReader = new PHPExcel_Reader_Excel2003XML();
  //  $objReader = new PHPExcel_Reader_OOCalc();
  //  $objReader = new PHPExcel_Reader_SYLK();
  //  $objReader = new PHPExcel_Reader_Gnumeric();
  //  $objReader = new PHPExcel_Reader_CSV();
  // $objPHPExcel = $objReader->load($inputFileName);
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) 
  {
    $worksheetTitle = $worksheet->getTitle();
    $highestRow = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    echo "<br>File ".$worksheetTitle." has ";
    echo $nrColumns . ' columns';
    echo ' y ' . $highestRow . ' rows.';
    echo '<br>Data: <table width="100%" cellpadding="3" cellspacing="0"><tr>';
    for ($row = 1; $row <= $highestRow; ++ $row) 
    {
      echo '<tr>';
      for ($col = 0; $col < $highestColumnIndex; ++ $col) 
      {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val = $cell->getValue();
        if($row == 1)
        echo '<td style="background:#000; color:#fff;">' . $val . '</td>';
        else
        echo '<td>' . $val . '</td>';
      }
      echo '</tr>';
    }
    echo '</table>';

    include("includes/conn.php");
    include("includes/link.php");

    for ($row = 1; $row <= $highestRow; ++ $row) 
    {
      $val=array();
      for ($col = 0; $col < $highestColumnIndex; ++ $col) 
      {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val[] = $cell->getValue();
      }
      $ic=mysql_real_escape_string(trim($val[16]));
      $branch=mysql_real_escape_string($val[36]);
      $qry = mysql_query("SELECT * FROM student_record WHERE ic='$ic' AND status!='delete'")
       or die ("Could not match data because ".mysql_error());
      $num_rows = mysql_num_rows($qry); 
      if ($num_rows > 0) 
      {
        $sql=mysql_query("UPDATE student_record SET branch='$branch', 
          status='A' WHERE ic='$ic'")
          or die('Error: ' . mysql_error());
      }
    }
  }
      // $receipt_type=$val[0];
      // $receipt_no=$val[1];
      // $receipt_date = PHPExcel_Style_NumberFormat::toFormattedString($val[2], "YYYY-M-D");
      // // echo $receipt_date;
      // $receipt_date = strtotime($receipt_date);
      // $amount=$val[3];
      // $receiptic=$val[4];
      // $receiptname=$val[5];
      // $receiptel=$val[6];
      // $receiptop=$val[7];
      // $branch=$val[8];
      // $branchop=$val[9];
      // $coursecode=$val[10];
    //   $checkreceipt=mysql_query("SELECT * FROM receipt_info
    //     WHERE receiptic='$receiptic' AND receipt_no='$receipt_no' 
    //     AND receipt_type='$receipt_type' AND status!='delete'")
    //   or die('Error: ' . mysql_error());
    //   $numreceiptno = mysql_num_rows($checkreceipt);
    //   if($numreceiptno<1)
    //   {
    //     $insertreceipt=mysql_query("INSERT INTO receipt_info (receipt_type, 
    //     receipt_no, receipt_date, amount, receiptic, receiptname, receiptel,
    //     receiptop, branch, branchop,coursecode) VALUES ('$receipt_type','$receipt_no', 
    //     FROM_UNIXTIME($receipt_date), '$amount', '$receiptic', '$receiptname', 
    //     '$receiptel', '$receiptop', '$branch','$branchop','$coursecode')")
    //     or die('Error: ' . mysql_error());
    //   }
    // }
}
?>


