<?PHP
//include the main validation script
if(isset($_POST['delclass']))
{// The form is submitted
  //Setup Validations
  if(empty($_POST['del_class']))
  {
    echo "<br>"."请输入要删除的班级id。";
    echo "<script LANGUAGE='javascript'>document.location.href=
                    'class.php#tabs-2'</script>";
    return;
  }
  include("includes/conn.php");
  include("includes/link.php");
  $del_class=mysql_real_escape_string(trim($_POST['del_class']));
  $branch=$_SESSION['branch'];
  $matchdel = mysql_query("SELECT * FROM class_info WHERE 
    classid='$del_class' AND branch='$branch' AND status!='delete'")
    or die ("Could not match data because ".mysql_error());
  $num_del = mysql_num_rows($matchdel);
  if($num_del>0)
  {
    $getclassid = mysql_fetch_array($matchdel);
    $oldlr=(!empty($getclassid['postcatlr']))?strtotime($getclassid['postcatlr']):'';
    $oldlrlocation=(!empty($getclassid['lrlocation']))?$getclassid['lrlocation']:'';
    $oldsw=(!empty($getclassid['postcatsw']))?strtotime($getclassid['postcatsw']):'';
    $oldswlocation=(!empty($getclassid['swlocation']))?$getclassid['swlocation']:'';
    $showstudent=mysql_query("SELECT * FROM sub_class_info WHERE
        classid='$del_class' AND status!='delete'")
        or die ("Could not match data because ".mysql_error());
    $num_student = mysql_num_rows($showstudent);
    if ($num_student > 0) 
    {
     while ($getstudent = mysql_fetch_array($showstudent)) 
      {
        $ic=$getstudent['ic'];
        if((!empty($oldlr))&&(!empty($oldlrlocation)))
        {
          $delato = mysql_query("UPDATE ato_info SET status='delete' WHERE ic='$ic' 
          AND UNIX_TIMESTAMP(examtime)='$oldlr' AND location='$oldlrlocation' 
          AND status!='delete'")or die ("Could not match data because ".mysql_error());
        }
        if((!empty($oldsw))&&(!empty($oldswlocation)))
        {
          $delato = mysql_query("UPDATE ato_info SET status='delete' WHERE ic='$ic' 
          AND UNIX_TIMESTAMP(examtime)='$oldsw' AND location='$oldswlocation' 
          AND status!='delete'")or die ("Could not match data because ".mysql_error());
        }
      }
    }
    $update_class=mysql_query("UPDATE class_info
    SET status='delete' WHERE classid='$del_class'")
    or die("Could not match data because ".mysql_error());
    $update_sub_class=mysql_query("UPDATE sub_class_info 
    SET status='delete' WHERE classid='$del_class'")
    or die("Could not match data because ".mysql_error());

    echo "成功删除班级。";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'class.php#tabs-2'</script>";
  }
  else
  {
    echo "不存在id为".$classid." 的班级或者这个班级是别的地方的。";
    echo "<script LANGUAGE='javascript'>document.location.href=
      'class.php#tabs-2'</script>";
  }
}//if(isset($_POST['inputbasic']))
?>