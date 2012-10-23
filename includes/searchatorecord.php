<?php
$_POST['recordic']=trim($_POST['recordic']);
$arr = array();
// print $_POST['ic'];
if(strlen($_POST['recordic'])!=9)
{
  $arr['err']="ic长度应该是9位";
  print json_encode($arr);
  return;
}
include("conn.php");
include("link1.php");
$recordic=mysqli_real_escape_string($link, trim($_POST['recordic']));
$icArray=str_split($recordic);
include("ic.php");
if ($icArray[8]!=$theAlpha) 
{
  $arr['err']="你的学员IC输错了吧，格式不对呀。";
}
else
{
  $checkrecord = mysqli_query($link, "SELECT * FROM student_record WHERE ic='$recordic' 
    AND status!='delete'")or die ("Could not match data because ".mysql_error());
  $numrecord = mysqli_num_rows($checkrecord);
  if($numrecord>0)
  {
    $getrecord = mysqli_fetch_array($checkrecord);
    $arr['ELrec']=$getrecord['ELBest'];
    $arr['ERrec']=$getrecord['ERBest'];
    $arr['ENrec']=$getrecord['ENBest'];
    $arr['ESrec']=$getrecord['ESBest'];
    $arr['EWrec']=$getrecord['EWBest'];
    $arr['CMP']=$getrecord['CMP'];
    $arr['CON']=$getrecord['CON'];
    $arr['WRI']=$getrecord['WRI'];
    $arr['WPN']=$getrecord['WPN'];
    $arr['rlupdated_at']=date('Y-m-d',strtotime($getrecord['rlupdated_at']));
    $arr['remark']=$getrecord['remark'];
    // echo $getrecord['remark'];
  }
  else
  {
    $arr['err']="没有找到IC为".$recordic." 的学员成绩。";
  }
}
print json_encode($arr);
return;
?>