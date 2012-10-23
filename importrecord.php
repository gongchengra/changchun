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
  /**  Create a new Reader of the type defined in $inputFileType  **/ 
  $objReader = PHPExcel_IOFactory::createReader($inputFileType); 
  /**  Advise the Reader of which WorkSheets we want to load  **/ 
  /**  Load $inputFileName to a PHPExcel Object  **/ 
  $objPHPExcel = $objReader->load($inputFileName);

  echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using PHPExcel_Reader_Excel5<br />';
  $objReader = new PHPExcel_Reader_Excel2007();
  //  $objReader = new PHPExcel_Reader_Excel2007();
  //  $objReader = new PHPExcel_Reader_Excel2003XML();
  //  $objReader = new PHPExcel_Reader_OOCalc();
  //  $objReader = new PHPExcel_Reader_SYLK();
  //  $objReader = new PHPExcel_Reader_Gnumeric();
  //  $objReader = new PHPExcel_Reader_CSV();
  $objPHPExcel = $objReader->load($inputFileName);
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
      $name=mysql_real_escape_string(trim($val[0]));
      $recordic=mysql_real_escape_string(trim($val[1]));

      $rlupdateat =empty($val[2])?'1970-01-01':PHPExcel_Style_NumberFormat::toFormattedString($val[2], "YYYY-M-D");
      // echo $receipt_date;
      $rlupdated_at = strtotime($rlupdateat);
      $ENrec=empty($val[3])?'NA':trim($val[3]);
      $ERrec=empty($val[4])?'NA':trim($val[4]);
      $ELrec=empty($val[5])?'NA':trim($val[5]);
      $swupdateat = empty($val[6])?'1970-01-01':PHPExcel_Style_NumberFormat::toFormattedString($val[6], "YYYY-M-D");
      // echo $receipt_date;
      $swupdated_at = strtotime($swupdateat);
      $ESrec=empty($val[7])?'NA':trim($val[7]);
      $EWrec=empty($val[8])?'NA':trim($val[8]);
      $CMP=empty($val[9])?'NA':trim($val[9]);
      $CON=empty($val[10])?'NA':trim($val[10]);
      $WRI=empty($val[11])?'NA':trim($val[11]);
      $WPN=empty($val[12])?'NA':trim($val[12]);
      $tel=empty($val[13])?'NA':trim($val[13]);
      $branch=empty($val[14])?'changchun':trim($val[14]);
      $remark=empty($val[15])?'':mysql_real_escape_string(trim($val[15]));

      $checkrecord=mysql_query("SELECT * FROM student_record 
          WHERE ic='$recordic' AND status!='delete'")
        or die ("Could not match data because ".mysql_error());
      $numrecord = mysql_num_rows($checkrecord);
      if($numrecord<1)
      {
        $sql=mysql_query("INSERT INTO student_record (name, ic, 
          ELBest, ERBest, ENBest, ESBest, EWBest, CMP, CON, WRI, WPN, 
          branch, branchop, tel, remark, rlupdated_at, swupdated_at ) 
          VALUES ('$name', '$recordic', '$ELrec', 
          '$ERrec', '$ENrec', '$ESrec', '$EWrec', '$CMP', '$CON', 
          '$WRI', '$WPN', '$branch', 'gongcheng','$tel','$remark',
          FROM_UNIXTIME($rlupdated_at),FROM_UNIXTIME($swupdated_at))")
        or die ("Could not match data because ".mysql_error());
        
      }
      else
      {
        $getrecord = mysql_fetch_array($checkrecord);
        $oldrl=empty($getrecord['rlupdated_at'])?
        strtotime('1970-01-01'):strtotime($getrecord['rlupdated_at']);
        $oldsw=empty($getrecord['swupdated_at'])?
        strtotime('1970-01-01'):strtotime($getrecord['swupdated_at']);
        $oldremark=$getrecord['remark'];
        $remark=(empty($oldremark))?$oldremark:($oldremark.' '.$remark);
        if($oldrl<$rlupdated_at||$oldsw<$swupdated_at)
        {
          $sql=mysql_query("UPDATE student_record SET name='$name', 
          ELBest='$ELrec', ERBest='$ERrec', ENBest='$ENrec',
          ESBest='$ESrec', EWBest='$EWrec', CMP='$CMP', CON='$CON', 
          WRI='$WRI', WPN='$WPN', tel='$tel', branch='$branch', 
          branchop='gongcheng', remark='$remark',
          rlupdated_at=FROM_UNIXTIME($rlupdated_at),
          swupdated_at=FROM_UNIXTIME($swupdated_at) WHERE ic='$recordic'")
          or die ("Could not match data because ".mysql_error());
        }
      }
    }
  }
}
?>


