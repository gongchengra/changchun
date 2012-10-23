<?php
if(isset($_GET['regid'])&&$_GET['regid']!='')
{
  $_POST['regid']=$_GET["regid"];
  $_POST['searchregic']=true;
}
if(isset($_POST['searchregic']))
{
  $regid=(!empty($_POST['regid']))?trim($_POST['regid']):'';
  if(empty($regid))
  {
    echo "请输入报名id， 再点搜索。";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-2'</script>";
    return;
  }
  include("includes/conn.php");
  include("includes/link.php");
  $regid=mysql_real_escape_string(trim($_POST['regid']));
  $branch=$_SESSION['branch'];
  $checkregid = mysql_query("SELECT * FROM reg_info WHERE regid='$regid' 
    AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numregid = mysql_num_rows($checkregid);
  if($numregid>0)
  {
      $getreg = mysql_fetch_array($checkregid);
      $_POST['regic']=$getreg['ic'];
      $_POST['reg_date']=date('Y-m-d',strtotime($getreg['reg_date']));
      $_POST['reg_location']=$getreg['reg_location'];
      $_POST['reg_no']=$getreg['reg_no'];
      $_POST['reg_op']=$getreg['reg_op'];
      $_POST['classtime']=date('Y-m-d',strtotime($getreg['classtime']));
      if($_POST['classtime']=='2038-01-01')
      {
          $_POST['classtime']='';
      }
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?regid=".$regid."#tabs-2'</script>";
  }
  else
  {
      echo "没有找到Id为".$regid." 的学员报名信息。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?regid=".$regid."#tabs-2'</script>";
      unset($_POST);
  }
}
if(isset($_POST['searchallreg']))
{
  $_POST['regic']=trim($_POST['regic']);
  $validator = new FormValidator();
  $validator->addValidation("regic","req","请输入学员ic");
  $validator->addValidation("regic","minlen=9","学员ic应该是9位");
  $validator->addValidation("regic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $regic=mysql_real_escape_string($_POST['regic']);
    $icArray=str_split($regic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-2'</script>";
    }
    else
    {
      $checkreg = mysql_query("SELECT * FROM reg_info WHERE ic='$regic' 
        AND status!='delete' ORDER BY reg_no")
      or die ("Could not match data because ".mysql_error());
      $numreg = mysql_num_rows($checkreg);
      if ($numreg>0) 
      {
        echo "<center>";
        echo "<table>";
        echo "<tr><th>报名id</th><th>报名时间</th><th>报名地点</th><th>报名表号码
        </th><th>操作员</th></tr>";
        while ($row = mysql_fetch_array($checkreg)) {
        echo "<tr><td>$row[regid]</td><td>$row[reg_date]</td><td>$row[reg_location]
        </td><td>$row[reg_no]</td><td>$row[reg_op]</td></tr>";
        }
        echo "</table>";
        echo "</center>";
        echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-2'</script>";
        unset($_POST['regid']);
        unset($_POST['reg_date']);
        unset($_POST['reg_location']);
        unset($_POST['reg_op']);
        unset($_POST['reg_no']);
      }
      else
      {
        echo "没有IC为".$regic." 的学员报名信息。<br>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php#tabs-2'</script>";
      }
    }
  }
  else
  {
    echo "<B>输入错误:</B>";
    $error_hash = $validator->GetErrors();
    foreach($error_hash as $inpname => $inp_err)
    {
        echo "<p>$inpname : $inp_err</p>\n";
    }
    echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-2'</script>";
  }
}
?>