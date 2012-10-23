<?php

error_reporting(E_ALL);

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes');

/** PHPExcel_IOFactory */
include("includes/conn.php");
include("includes/link1.php");
$tables=$_POST['tables'];
$getcolumns=mysqli_query($link, "SHOW COLUMNS from $tables")
or die ("Could not match data because ".mysqli_error($link));
$numcolumns=mysqli_num_rows($getcolumns);
$columnarr=array();
$i=0;
while($getcolname=mysqli_fetch_array($getcolumns))
{
  $columnarr[$i]=$getcolname['Field'];
  if($getcolname['Key']=='PRI'){$primaryid=$getcolname['Field'];}
  $i=$i+1;
}
// print_r($columnarr);
// $keys = array_keys($columnarr);
$valuearr=$columnarr;
$numcol=count($columnarr);
$colnamejoin='';
foreach ($columnarr as $colname) {
    $colnamejoin=$colnamejoin.$colname.',';
  }
$colnamejoin=explode(',',$colnamejoin,-1);
// echo implode(',',$newreceipt);
// echo implode(',',$colnamejoin);
$insert_statement="INSERT INTO ".$tables." (".implode(',',$colnamejoin).") VALUES (";
$update_statement="UPDATE ".$tables." SET ";
// echo $insert_statement;
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

    for ($row = 2; $row <= $highestRow; ++ $row) 
    {
      $val=array();
      for ($col = 0; $col < $highestColumnIndex; ++ $col) 
      {
        $cell = $worksheet->getCellByColumnAndRow($col, $row);
        $val[] = $cell->getValue();
      }
      for($i=0;$i<$numcol;$i++)
      {
        $valuearr[$i]=$val[$i];
      }
      // print $valuearr['0'].'<br />';
      $checkresult=mysqli_query($link, "SELECT * FROM $tables
        WHERE $primaryid='$valuearr[0]'")
      or die('Error: ' . mysqli_error($link));
      $numresult = mysqli_num_rows($checkresult);
      if($numresult<1)
      {
        $valuejoin=$valuearr['0'];
        for($j=1;$j<$numcol;$j++)
        {
          $value=$valuearr[$j];
          $valuejoin=$valuejoin.", '$value'";
        }
        $INSERT=$insert_statement.$valuejoin.")";
        // $insertreceipt=mysqli_query($link, "INSERT INTO receipt_info (receipt_type, 
        // receipt_no, receipt_date, amount, receiptic, receiptname, receiptel,
        // receiptop, branch, branchop,coursecode) VALUES ('$receipt_type','$receipt_no', 
        // FROM_UNIXTIME($receipt_date), '$amount', '$receiptic', '$receiptname', 
        // '$receiptel', '$receiptop', '$branch','$branchop','$coursecode')")
        // or die('Error: ' . mysqli_error($link));
        // echo $INSET;
        $sql=mysqli_query($link, $INSERT)or die('Error: ' . mysqli_error($link));
      }
      else
      {
        $setjoin=$columnarr[0]."='$valuearr[0]'";
        for($j=1;$j<$numcol;$j++)
        {
          $value=$valuearr[$j];
          $setjoin=$setjoin.",".$columnarr[$j]."='$value'";
        }
        $value0=$valuearr[0];
        $UPDATE=$update_statement.$setjoin."WHERE ".$columnarr[0]."=".$value0;
        // echo $UPDATE.'<br />';
        $sql=mysqli_query($link,$UPDATE)or die('Error: ' . mysqli_error($link));
      }
    }
  }
}
?>


