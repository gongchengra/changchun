<?php
if(isset($_POST['delato']))
{
  include("includes/conn.php");
  include("includes/link.php");
  $branch=$_POST['hiddenbranch'];
  $del_ato=mysql_real_escape_string(trim($_POST['del_ato']));
  $checkato = mysql_query("SELECT * FROM ato_info WHERE atoid='$del_ato' 
      AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numato = mysql_num_rows($checkato);
  if($numato>0)
  {
    $findoriexamtime=mysql_query("SELECT UNIX_TIMESTAMP(examtime) as examtime,
     location, branch, branchop FROM ato_info WHERE atoid='$del_ato' AND status!='delete'")
    or die ("Could not match data because ".mysql_error());
    $getorigin = mysql_fetch_array($findoriexamtime);
    $oriexamtime = $getorigin['examtime'];
    $orilocation = $getorigin['location'];
    if($oriexamtime-strtotime("now")<8*24*3600)
    {
      echo "<h2>学员信息已录入SSA系统，无法更改。</h2>";
      echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-4'</script>";
      return;
    }
    $plusavailable=mysql_query("UPDATE exam_info SET seatavailable=seatavailable+1 
      WHERE UNIX_TIMESTAMP(examdate)='$oriexamtime' AND location='$orilocation' 
      AND status!='delete'")or die ("Could not match data because ".mysql_error());
    
    $getic=mysql_fetch_array($checkato);
    $delic=$getic['ic'];
    $delato = mysql_query("UPDATE ato_info SET status='delete',
    updated_at=now() WHERE atoid='$del_ato'")
    or die ("Could not match data because ".mysql_error());
    echo "<script LANGUAGE='javascript'>alert('ID为".$delato.", IC为".$delic."的座位已经删除。');</script>";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-4'</script>";
  }
  else
  {
    echo "没有id为".$del_ato." 的学员ato信息或者该信息属于其他分部。";
    unset($_POST);
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-4'</script>";
  }
}
?>
