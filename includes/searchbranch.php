<?php
$_POST['branchic']=trim($_POST['branchic']);
$arr = array();
// print $_POST['ic'];
if(strlen($_POST['branchic'])!=9)
{
  $arr['err']="ic长度应该是9位";
  print json_encode($arr);
  return;
}
include("conn.php");
include("link1.php");
$recordic=mysqli_real_escape_string($link, trim($_POST['branchic']));
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
    $arr['branch']=$getrecord['branch'];
  }
  else
  {
    $arr['err']="没有找到IC为".$recordic." 的学员成绩。";
  }
}
print json_encode($arr);
return;
?>