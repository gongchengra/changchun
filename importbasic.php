<?php

error_reporting(E_ALL);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
if ( $_FILES['file']['tmp_name'] )
{
  $inputFileType = 'Excel5'; 
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
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    mysql_query("SET NAMES UTF8");

    for ($row = 1; $row <= $highestRow; ++ $row) 
    {
      $val=array();
      for ($col = 0; $col < $highestColumnIndex; ++ $col) 
      {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val[] = $cell->getValue();
      }
      
      $salutation=$val[14];
      $idtype=$val[15];
      $ic=trim($val[16]);
      $surname=mysql_real_escape_string($val[18]);
      $givename=mysql_real_escape_string($val[19]);
      $name=mysql_real_escape_string($val[20]);
      $gender=$val[21];
      $dateofbirth = PHPExcel_Style_NumberFormat::toFormattedString($val[22], "YYYY-M-D");
      // echo $receipt_date;
      $dateofbirth = date('Y-m-d',strtotime($dateofbirth));
      $citizenship=$val[24];
      $nationality=$val[25];
      $race=$val[26];
      $cnlevel=$val[27];
      $edulevel=$val[28];
      $lang=$val[29];
      $block=$val[30];
      $street=mysql_real_escape_string($val[31]);
      $floorno=$val[32];
      $building=$val[33];
      $address="Blk ".$block." ".$street." ".$floorno;
      $postcode=$val[34];
      $tel=$val[35];
      $employstatus=$val[37];
      $companystatus=$val[38];
      $companyname=mysql_real_escape_string($val[39]);
      $companyregno=$val[40];
      $industry=$val[41];
      $designation=$val[42];
      $salaryrange=$val[43];
      $updated_at = PHPExcel_Style_NumberFormat::toFormattedString($val[2], "YYYY-M-D");
      // echo $receipt_date;
      $updated_at = date('Y-m-d',strtotime($updated_at));

      $match = mysql_query("SELECT ic,UNIX_TIMESTAMP(updated_at) as oldupdate FROM student_info WHERE ic='$ic' AND status!='delete'")
        or die ("Could not match data because ".mysql_error());
      $num_rows = mysql_num_rows($match);
      if ($num_rows<1) 
      {
        $sql=mysql_query("INSERT INTO student_info (ic, name, surname, givename,
          tel, gender, salutation, dateofbirth, idtype,
          citizenship, nationality, race, cnlevel, edulevel, employstatus,
          companyname, companystatus, companyregno, industry, designation, salaryrange,
          lang, block, street, floorno, building, address, postcode,
          updated_at) VALUES ('$ic', '$name', '$surname', '$givename',
          '$tel', '$gender', '$salutation', '$dateofbirth', '$idtype',
          '$citizenship', '$nationality', '$race', '$cnlevel', '$edulevel', '$employstatus',
          '$companyname', '$companystatus', '$companyregno', '$industry', '$designation', '$salaryrange',
          '$lang', '$block', '$street', '$floorno', '$building', '$address', '$postcode',
          '$updated_at')")or die('Error: ' . mysql_error());
      }
      else
      {
        $getime=mysql_fetch_array($match);
        $oldupdate=$getime['oldupdate'];
        if($updated_at>$oldupdate)
        {
          $sql=mysql_query("UPDATE student_info SET name='$name', surname='$surname',
          givename='$givename', tel='$tel', gender='$gender', salutation='$salutation', 
          dateofbirth='$dateofbirth', idtype='$idtype',
          citizenship='$citizenship', nationality='$nationality', 
          race='$race', cnlevel='$cnlevel', edulevel='$edulevel', employstatus='$employstatus',
          companyname='$companyname', companystatus='$companystatus', companyregno='$companyregno', 
          industry='$industry', designation='$designation', salaryrange='$salaryrange',
          lang='$lang', block='$block', street='$street', floorno='$floorno', building='$building', 
          address='$address', postcode='$postcode', updated_at='$updated_at', status='A' WHERE ic='$ic'")
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
}
?>


