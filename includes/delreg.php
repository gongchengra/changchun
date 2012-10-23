<?php
  include("conn.php");
  include("link.php");
  $branch=$_POST['hiddenbranch'];
  $del_reg=mysql_real_escape_string(trim($_POST['del_reg']));
  $checkreg = mysql_query("SELECT * FROM reg_info WHERE regid='$del_reg' 
    AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numreg = mysql_num_rows($checkreg);
  if($numreg>0)
  {
    $delreg = mysql_query("UPDATE reg_info SET status='delete' 
        WHERE regid='$del_reg'")or die ("Could not match data because ".mysql_error());
    print "id为".$del_reg." 的学员报名信息已删除";
  }
  else
  {
    print "没有id为".$del_reg." 的学员报名信息或者该信息属于其他分部。";
  }
?>
