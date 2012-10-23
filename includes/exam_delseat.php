<?php
if(isset($_POST['delbook']))
{
  include("includes/conn.php"); 
  // connect to the mysql server
  include("includes/link.php");
  if (empty($_POST['del_ato'])) 
  {
      echo "请输入要删除座位的ID，见下表.";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'exam.php#inputatohead'</script>";
  }
  else
  {
    $branch=$_SESSION['branch'];
    $del_ato=mysql_real_escape_string(trim($_POST['del_ato']));
    $checkatoid=mysql_query("SELECT * FROM ato_info WHERE atoid='$del_ato'
      and (branch='$branch' OR '$branch'='changchun') and status!='delete' ")
    or die ("Could not match data because ".mysql_error());
    $num_rows = mysql_num_rows($checkatoid); 
    if ($num_rows <= 0) 
    {
      echo "你的ＩＤ输错了吧，没找到。";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'exam.php#inputatohead'</script>";
    }
    else
    {
      $getic=mysql_fetch_array($checkatoid);
      $delic=$getic['ic'];
      $delato="UPDATE ato_info SET status='delete' WHERE atoid = $del_ato";
      if (!mysql_query($delato,$link)){die('Error: ' . mysql_error());}
      $plusnumber="UPDATE exam_info SET seatavailable=seatavailable+1 WHERE
      examdate=(SELECT examtime FROM ato_info WHERE atoid='$del_ato') 
      AND location=(SELECT location FROM ato_info WHERE atoid='$del_ato')";
      if (!mysql_query($plusnumber,$link)){die('Error: ' . mysql_error());}
      echo "<script LANGUAGE='javascript'>alert('ID为".$delato.", IC为".$delic."的座位已经删除。');</script>";
      // echo "<meta http-equiv='refresh' content='0';URL=exam.php'>"; 
    }
  }
}
?>