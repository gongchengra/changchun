<?PHP
//include the main validation script
require_once "../formvalidator.php";
$_POST['branchic']=trim($_POST['branchic']);
$validator = new FormValidator();
$validator->addValidation("branchic","req","请输入学员ic");
$validator->addValidation("branchic","minlen=9","学员ic应该是9位");
$validator->addValidation("branchic","maxlen=9","学员ic应该是9位");
$validator->addValidation("branch","dontselect=0","请选择分部");
if($validator->ValidateForm())
{
  include("conn.php");
  include("link1.php");
  $recordic=mysqli_real_escape_string($link, $_POST['branchic']);
  $icArray=str_split($recordic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    print "你的学员IC输错了吧，格式不对呀。";
  }
  else
  {
    $branch=$_POST['branch'];
    $hiddenbranch=$_POST['hiddenbranch'];
    $role=$_POST['hiddenrole'];
    if($role<3)
    {
      $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
      WHERE ic='$recordic' AND status!='delete'")
      or die ("Could not match data because ".mysqli_error($link));
      $numrecord = mysqli_num_rows($checkrecord);
      if($numrecord>0)
      {
        $sql=mysqli_query($link, "UPDATE student_record 
          SET branch='$branch' WHERE ic='$recordic'")
        or die ("Could not match data because ".mysqli_error($link));
        print "成功更新IC为".$recordic." 的学员分部信息";
      }
      else
      {
        print "没有IC为".$recordic." 的学员成绩";
      }
    }
    else
    {
      $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
      WHERE ic='$recordic' AND status!='delete'")
      or die ("Could not match data because ".mysqli_error($link));
      $numrecord = mysqli_num_rows($checkrecord);
      if($numrecord>0)
      {
        $getbranch=mysqli_fetch_array($checkrecord);
        $oribranch=$getbranch['branch'];
        if($oribranch!=$hiddenbranch)
        {
          echo "该学员属于".$oribranch."分部，你无权更改。";
          return;
        }
        else
        {
          $sql=mysqli_query($link, "UPDATE student_record 
          SET branch='$branch' WHERE ic='$recordic'")
          or die ("Could not match data because ".mysqli_error($link));
          print "成功更新IC为".$recordic." 的学员分部信息";
        }
      }
      else
      {
        print "没有IC为".$recordic." 的学员成绩";
      }
    }
  }  
}
else
{
  print "<B>输入错误:</B>";
  $error_hash = $validator->GetErrors();
  foreach($error_hash as $inpname => $inp_err)
  {
      print "<p>$inpname : $inp_err</p>\n";
  }
}//else
?>