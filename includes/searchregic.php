<?php
  $regid=(!empty($_POST['regid']))?trim($_POST['regid']):'';
  $arr = array();
  if(empty($regid))
  {
    $arr['err']="请输入报名id， 再点搜索。";
    print json_encode($arr);
    return;
  }
  include("conn.php");
  include("link.php");
  $checkregid = mysql_query("SELECT * FROM reg_info 
    WHERE regid='$regid' AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numregid = mysql_num_rows($checkregid);
  if($numregid>0)
  {
      $getreg = mysql_fetch_array($checkregid);
      $arr['regic']=$getreg['ic'];
      $arr['reg_date']=date('Y-m-d',strtotime($getreg['reg_date']));
      $arr['reg_location']=$getreg['reg_location'];
      $arr['reg_no']=$getreg['reg_no'];
      $arr['reg_op']=$getreg['reg_op'];
      $arr['classtime']=date('Y-m-d',strtotime($getreg['classtime']));
      if($arr['classtime']=='2038-01-01')
      {
          $arr['classtime']='';
      }
  }
  else
  {
      $arr['err']="没有找到Id为".$regid." 的学员报名信息。";
  }
  print json_encode($arr);
?>