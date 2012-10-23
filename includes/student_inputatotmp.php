<?PHP
//include the main validation script
require_once "formvalidator.php";
if(isset($_POST['inputato']))
{
  $_POST['atoic']=trim($_POST['atoic']);
  $validator = new FormValidator();
  $validator->addValidation("atoic","req","请输入学员ic");
  $validator->addValidation("atoic","minlen=9","学员ic应该是9位");
  $validator->addValidation("atoic","maxlen=9","学员ic应该是9位");
  $validator->addValidation("prepost","dontselect=请选择","请选择考试类型");
  $validator->addValidation("start_date","req","请输入课程开始日期");
  $validator->addValidation("end_date","req","请输入课程截止日期");
  $validator->addValidation("coursecode","req","请输入班级代码");
  $validator->addValidation("attendance","req","请输入出勤率");
  $validator->addValidation("recommend","dontselect=请选择","请选择推荐等级");
  $validator->addValidation("EL","dontselect=请选择","请选择考不考听力EL");
  $validator->addValidation("ER","dontselect=请选择","请选择考不考阅读ER");
  $validator->addValidation("EN","dontselect=请选择","请选择考不考数学EN");
  $validator->addValidation("ES","dontselect=请选择","请选择考不考会话ES");
  $validator->addValidation("EW","dontselect=请选择","请选择分部");
  $validator->addValidation("branch","dontselect=0","请选择考不考写作EW");
  $validator->addValidation("location","dontselect=请选择","请选择考试地点");
  $validator->addValidation("atodate","req","请输入考试日期");
  $validator->addValidation("atotime","dontselect=请选择","请选择考试时间");
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $atoic=mysql_real_escape_string(trim($_POST['atoic']));
    $icArray=str_split($atoic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-4'</script>";
    }
    else
    {
      echo "<h2>输入有效</h2>";
      $prepost=$_POST['prepost'];
      $start_date=strtotime($_POST['start_date']);
      $end_date=strtotime($_POST['end_date']);
      $coursecode=mysql_real_escape_string(trim($_POST['coursecode']));
      $attendance=mysql_real_escape_string(trim($_POST['attendance']));
      $recommend=$_POST['recommend'];
      $EL=$_POST['EL'];
      $ER=$_POST['ER'];
      $EN=$_POST['EN'];
      $ES=$_POST['ES'];
      $EW=$_POST['EW'];
      $location=$_POST['location'];
      $atodate=strtotime($_POST['atodate']);
      $atotime=$_POST['atotime'];
      $examtime=$atodate+3600*$atotime;
      $branch=$_POST['branch'];
      $email=$branch.'@changchun.edu.sg';
      $branchop=$_SESSION['username'];
      $inputnew=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
      coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
      examtime, branch, branchop, status) VALUES ('$atoic','$prepost',FROM_UNIXTIME($start_date),
      FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
      '$EN','$ES','$EW','$email','$location',FROM_UNIXTIME($examtime),'$branch',
      '$branchop','book')")
      or die ("Could not match data because ".mysql_error());
      echo "成功更新IC为".$atoic."的学员ato信息。";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'studentmp.php#tabs-4'</script>";
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
            'studentmp.php#tabs-4'</script>";
  }//else
}//if(isset($_POST['inputato']))
?>