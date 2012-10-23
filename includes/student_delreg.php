<?php
if(isset($_POST['delreg']))
{
  include("includes/conn.php");
  include("includes/link.php");
  $branch=$_SESSION['branch'];
  $del_reg=mysql_real_escape_string(trim($_POST['del_reg']));
  $checkreg = mysql_query("SELECT * FROM reg_info WHERE regid='$del_reg' AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numreg = mysql_num_rows($checkreg);
  if($numreg>0)
  {
    $delreg = mysql_query("UPDATE reg_info SET status='delete' 
        WHERE regid='$del_reg'")or die ("Could not match data because ".mysql_error());
    echo "id为".$del_reg." 的学员报名信息已删除";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-2'</script>";
  }
  else
  {
    echo "没有id为".$del_reg." 的学员报名信息或者该信息属于其他分部。";
    unset($_POST);
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-2'</script>";
  }
}
?>
