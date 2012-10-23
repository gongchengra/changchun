<?php
$atoid=(!empty($_POST['atoid']))?trim($_POST['atoid']):'';
$arr = array();
if(empty($atoid))
{
  $arr['err']="请输入ato id再点搜索。";
  print json_encode($arr);
  return;
}
include("conn.php");
include("link1.php");
$atoid=mysqli_real_escape_string($link, trim($_POST['atoid']));
$checkato = mysqli_query($link, "SELECT * FROM ato_info WHERE atoid='$atoid' 
  AND status!='delete' ")or die ("Could not match data because ".mysqli_error());
$numato = mysqli_num_rows($checkato);
if($numato>0)
{
  $getato = mysqli_fetch_array($checkato);
  $arr['atoic']=$getato['ic'];
  $arr['prepost']=$getato['prepost'];
  if($arr['prepost']=='PRE')
  {
    $arr['start_date']=date('Y-m-d',strtotime($getato['examtime']));
    $arr['end_date']=$arr['start_date'];
    $arr['coursecode1']='Etest Training';
    $arr['attendance']='100';
    $arr['recommend']='Waiting for the result';
  }
  else if($arr['prepost']=='POST')
  {
    $arr['start_date']=($getato['start_date'])?
    date('Y-m-d',strtotime($getato['start_date'])):'';
    $arr['end_date']=($getato['end_date'])?
    date('Y-m-d',strtotime($getato['end_date'])):'';
    $arr['coursecode1']=$getato['coursecode'];
    $arr['attendance']=$getato['attendance'];
    $arr['recommend']=$getato['recommend'];
  }
    $arr['EL']=$getato['EL'];
    $arr['ER']=$getato['ER'];
    $arr['EN']=$getato['EN'];
    $arr['ES']=$getato['ES'];
    $arr['EW']=$getato['EW'];
    $arr['atoremark']=str_replace(' ', '&nbsp;', $getato['remark']);
    // $arr['atoremark']=$getato['remark'];
    $arr['location']=$getato['location'];
    $arr['atodate']=date('Y-m-d',strtotime($getato['examtime']));
    $arr['atotime']=date('H',strtotime($getato['examtime']));
}
else
{
  $arr['err']="没有找到Id为".$atoid." 的ato信息。";
}
print json_encode($arr);
?>