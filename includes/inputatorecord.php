<?PHP
//include the main validation script
require_once "../formvalidator.php";
$_POST['recordic']=trim($_POST['recordic']);
$validator = new FormValidator();
$validator->addValidation("recordic","req","请输入学员ic");
$validator->addValidation("rlupdated_at","req","请输入考试日期");
$validator->addValidation("recordic","minlen=9","学员ic应该是9位");
$validator->addValidation("recordic","maxlen=9","学员ic应该是9位");
$validator->addValidation("ELrec","dontselect=0","请选择听力EL成绩");
$validator->addValidation("ERrec","dontselect=0","请选择阅读ER成绩");
$validator->addValidation("ENrec","dontselect=0","请选择数学EN成绩");
$validator->addValidation("ESrec","dontselect=0","请选择会话ES成绩");
$validator->addValidation("EWrec","dontselect=0","请选择写作EW成绩");
$validator->addValidation("CMP","dontselect=0","请选择综合CMP等级");
$validator->addValidation("CON","dontselect=0","请选择会话CON等级");
$validator->addValidation("WRI","dontselect=0","请选择写作WRI等级");
$validator->addValidation("WPN","dontselect=0","请选择数学WPN等级");
if($validator->ValidateForm())
{
  include("conn.php");
  include("link1.php");
  $recordic=mysqli_real_escape_string($link, $_POST['recordic']);
  $icArray=str_split($recordic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    print "你的学员IC输错了吧，格式不对呀。";
  }
  else
  {
    print "<h2>输入有效</h2>";
    $match = mysqli_query($link, "SELECT ic, name FROM student_info WHERE ic='$recordic'")
    or die ("Could not match data because ".mysqli_error());
    $num_rows = mysqli_num_rows($match);
    if ($num_rows<1) 
    {
      print "请先输入学员的基本信息。";
    }
    else
    {
      $getname=mysqli_fetch_array($match);
      $name=$getname['name'];
      $branch=$_POST['hiddenbranch'];
      $branchop=$_POST['hiddenbranchop'];
      $ELrec=$_POST['ELrec'];
      $ERrec=$_POST['ERrec'];
      $ENrec=$_POST['ENrec'];
      $ESrec=$_POST['ESrec'];
      $EWrec=$_POST['EWrec'];
      $CMP=$_POST['CMP'];
      $CON=$_POST['CON'];
      $WRI=$_POST['WRI'];
      $WPN=$_POST['WPN'];
      $rlupdated_at=strtotime($_POST['rlupdated_at']);
      $remark=isset($_POST['remark'])?
      mysqli_real_escape_string($link, trim($_POST['remark'])):"";
      $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
        WHERE ic='$recordic' AND status!='delete'")
      or die ("Could not match data because ".mysqli_error());
      $numrecord = mysqli_num_rows($checkrecord);
      if($numrecord>0)
      {
        $sql=mysqli_query($link, "UPDATE student_record SET name='$name', 
        ELBest='$ELrec', ERBest='$ERrec', ENBest='$ENrec',
        ESBest='$ESrec', EWBest='$EWrec', CMP='$CMP', CON='$CON', 
        WRI='$WRI', WPN='$WPN', remark='$remark', 
        rlupdated_at=FROM_UNIXTIME($rlupdated_at) WHERE ic='$recordic'")
        or die ("Could not match data because ".mysqli_error());
        print "成功更新IC为".$recordic." 的学员成绩";
      }
      else
      {
        $sql=mysqli_query($link, "INSERT INTO student_record (name, ic, 
          ELBest, ERBest, ENBest, ESBest, EWBest, CMP, CON, WRI, WPN, 
          branch, branchop, remark, rlupdated_at) VALUES ('$name', '$recordic', '$ELrec', 
          '$ERrec', '$ENrec', '$ESrec', '$EWrec', '$CMP', '$CON', 
          '$WRI', '$WPN', '$branch', '$branchop', '$remark', FROM_UNIXTIME($rlupdated_at))")
        or die ("Could not match data because ".mysqli_error());
        print "成功输入IC为".$recordic." 的学员成绩";
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