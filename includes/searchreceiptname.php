<?php
$_POST['receiptic']=trim($_POST['receiptic']);
$arr = array();
include("conn.php");
include("link1.php");
$receiptic=mysqli_real_escape_string($link, trim($_POST['receiptic']));
$icArray=str_split($receiptic);
include("ic.php");
if ($icArray[8]!=$theAlpha) 
{
  $arr['err']='你的学员IC输错了吧，格式不对呀。';
}
else
{
  $checkreceipt = mysqli_query($link, "SELECT * FROM receipt_info WHERE receiptic='$receiptic' AND status!='delete'")
  or die ("Could not match data because ".mysqli_error($link));
  $numreceipt = mysqli_num_rows($checkreceipt);
  if ($numreceipt>0) 
  {
    while ($row = mysqli_fetch_array($checkreceipt)) 
    {
      $tmpname=$row['receiptname'];
      $tmptel=$row['receiptel'];
    }
    $arr['receiptname']=$tmpname;
    $arr['receiptel']=$tmptel;
  }
  else
  {
    $match = mysqli_query($link, "SELECT ic, tel, tel_home, name FROM student_info WHERE ic='$receiptic'")
      or die ("Could not match data because ".mysqli_error($link));
    $num_rows = mysqli_num_rows($match);
    if ($num_rows>0) 
    {
      $row = mysqli_fetch_array($match);
      $arr['receiptname']=$row['name'];
      $arr['receiptel']=$row['tel'];
    }
    else
    {
      $arr['err']='No result was found!';
    }
  }
}
print json_encode($arr);
?>