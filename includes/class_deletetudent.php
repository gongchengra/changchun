<?PHP
//include the main validation script
if(isset($_GET['delic'])&&$_GET['delic']!='')
{
  $_POST['ic']=$_GET["delic"];
  $_POST['classid1']=$_GET['classid'];
  $_POST['deletestudent']=true;
}
if(isset($_POST['deletestudent']))
{// The form is submitted
  //Setup Validations
  if(empty($_POST['classid1'])||empty($_POST['ic']))
  {
    echo "<br>"."请先输入班级id和学员ic。";
    echo "<script LANGUAGE='javascript'>document.location.href=
                    'class.php?classid=$classid#tabs-2'</script>";
    return;
  }
  // echo "<script LANGUAGE='javascript'>alert ('Are you sure you want to delete this student?');</script>";
  include("includes/conn.php");
  include("includes/link.php");
  $ic=mysql_real_escape_string(trim($_POST['ic']));
  $classid1=mysql_real_escape_string(trim($_POST['classid1']));
  $branch=$_SESSION['branch'];
  $icArray=str_split($ic);
  include("includes/ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    echo "你的学员IC输错了吧，格式不对呀。";
    echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php?classid=$classid#tabs-2'</script>";
  }
  else
  {
    $matchsub = mysql_query("SELECT * FROM sub_class_info WHERE ic='$ic' 
      AND classid='$classid1' AND status!='delete'")
      or die ("Could not match data because ".mysql_error());
    $num_rowsub = mysql_num_rows($matchsub);
    if($num_rowsub>0)
    {
      $update_subclass=mysql_query("UPDATE sub_class_info 
        SET status='delete' WHERE ic='$ic' AND classid='$classid1'")
        or die("Could not match data because ".mysql_error());
        echo "成功删除学员信息。";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php?classid=$classid#tabs-2'</script>";
    }
    else
    {
      echo "id为".$classid1." 的班级里面没有ic为".$ic." 的学员。";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php?classid=$classid#tabs-2'</script>";
    }
  }
}//if(isset($_POST['inputbasic']))
?>