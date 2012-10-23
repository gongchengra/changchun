<?php
if(isset($_GET['record'])&&$_GET['record']!='')
{
  $_POST['recordic']=$_GET["record"];
  $_POST['searchatorecord']=true;
}
if(isset($_POST['searchatorecord']))
  {
    include("includes/conn.php");
    include("includes/link1.php");
    $recordic=mysqli_real_escape_string($link, trim($_POST['recordic']));
    $icArray=str_split($recordic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php?record=".$recordic."#tabs-6'</script>";
    }
    else
    {
      $checkrecord = mysqli_query($link, "SELECT * FROM student_record WHERE ic='$recordic' 
        AND status!='delete'")or die ("Could not match data because ".mysql_error());
      $numrecord = mysqli_num_rows($checkrecord);
      if($numrecord>0)
      {
        $getrecord = mysqli_fetch_array($checkrecord);
        $_POST['ELrec']=$getrecord['ELBest'];
        $_POST['ERrec']=$getrecord['ERBest'];
        $_POST['ENrec']=$getrecord['ENBest'];
        $_POST['ESrec']=$getrecord['ESBest'];
        $_POST['EWrec']=$getrecord['EWBest'];
        $_POST['CMP']=$getrecord['CMP'];
        $_POST['CON']=$getrecord['CON'];
        $_POST['WRI']=$getrecord['WRI'];
        $_POST['WPN']=$getrecord['WPN'];
        $_POST['rlupdated_at']=date('Y-m-d',strtotime($getrecord['rlupdated_at']));
        if($_POST['rlupdated_at']=='1970-01-01'){$_POST['rlupdated_at']='';}
        $_POST['remark']=str_replace(' ', '&nbsp;', $getrecord['remark']);
        // echo $getrecord['remark'];
        echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?record=".$recordic."#tabs-6'</script>";
      }
      else
      {
        echo "没有找到IC为".$recordic." 的学员成绩。";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php?record=".$recordic."#tabs-6'</script>";
      }
    }
  }
?>