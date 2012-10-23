<?PHP
//include the main validation script
require_once "../formvalidator.php";
$_POST['atoic']=trim($_POST['atoic']);
$validator = new FormValidator();
$validator->addValidation("atoic","req","请输入学员ic");
$validator->addValidation("atoic","minlen=9","学员ic应该是9位");
$validator->addValidation("atoic","maxlen=9","学员ic应该是9位");
$validator->addValidation("prepost","dontselect=请选择","请选择考试类型");
$validator->addValidation("start_date","req","请输入课程开始日期");
$validator->addValidation("end_date","req","请输入课程截止日期");
$validator->addValidation("coursecode1","req","请输入班级代码");
$validator->addValidation("attendance","req","请输入出勤率");
$validator->addValidation("recommend","dontselect=请选择","请选择推荐等级");
$validator->addValidation("EL","dontselect=请选择","请选择考不考听力EL");
$validator->addValidation("ER","dontselect=请选择","请选择考不考阅读ER");
$validator->addValidation("EN","dontselect=请选择","请选择考不考数学EN");
$validator->addValidation("ES","dontselect=请选择","请选择考不考会话ES");
$validator->addValidation("EW","dontselect=请选择","请选择考不考写作EW");
$validator->addValidation("location","dontselect=请选择","请选择考试地点");
$validator->addValidation("atodate","req","请输入考试日期");
$validator->addValidation("atotime","dontselect=请选择","请选择考试时间");
if($validator->ValidateForm())
{
  include("conn.php");
  include("link1.php");
  $atoic=mysqli_real_escape_string($link, trim($_POST['atoic']));
  $icArray=str_split($atoic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    print "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
  }
  else
  {
    print "<h2>输入有效</h2>";
    $prepost=$_POST['prepost'];
    $start_date=strtotime($_POST['start_date']);
    $end_date=strtotime($_POST['end_date']);
    $coursecode=mysqli_real_escape_string($link, trim($_POST['coursecode1']));
    $attendance=mysqli_real_escape_string($link, trim($_POST['attendance']));
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
    $remark=mysqli_real_escape_string($link, trim($_POST['atoremark']));
    $match = mysqli_query($link, "SELECT ic, tel, tel_home, name FROM student_info WHERE ic='$atoic'")
    or die ("Could not match data because ".mysqli_error($link));
    $num_rows = mysqli_num_rows($match);
    if ($num_rows<1) 
    {
      print "<script LANGUAGE='javascript'>alert('请先输入学员的基本信息。');</script>";
    }
    else
    {
      $email=$_POST['hiddenemail'];
      $branch=$_POST['hiddenbranch'];
      $branchop=$_POST['hiddenbranchop'];
      if(empty($_POST['atoid']))
      {
        print "<script LANGUAGE='javascript'>alert('请输入ato id.');</script>";
        // print "<script LANGUAGE='javascript'>document.location.href=
        //   'exam.php'</script>";
        return;
      }
      else
      {
        $atoid=mysqli_real_escape_string($link, trim($_POST['atoid']));
        $checkatoid=mysqli_query($link, "SELECT atoid FROM ato_info 
          WHERE atoid='$atoid' AND (branch='$branch' OR '$branch'='changchun') 
          AND status!='delete'")
        or die ("Could not match data because ".mysqli_error($link)); 
        $numatoid = mysqli_num_rows($checkatoid);
        if($numatoid<1)
        {
          print "没有ato id为".$atoid." 的学员报名信息或者该信息属于其他分部。";
          return;
        }
        else
        {
          $findoriexamtime=mysqli_query($link, "SELECT UNIX_TIMESTAMP(examtime) as examtime,
           location, branch, branchop
          FROM ato_info WHERE atoid='$atoid' AND status!='delete'")
          or die ("Could not match data because ".mysqli_error($link));
          $getorigin = mysqli_fetch_array($findoriexamtime);
          $oriexamtime = $getorigin['examtime'];
          if(($oriexamtime-strtotime("now")<8*24*3600)||
            ($examtime-strtotime("now")<8*24*3600))
          {
            print "<h2>学员信息已录入SSA系统，无法更改。</h2>";
            return;
          }
          $orilocation = $getorigin['location'];
          $branch = $getorigin['branch'];
          $branchop = $getorigin['branchop'];
          if(($oriexamtime!=$examtime)OR($orilocation!=$location))
          {
            $checkavailable=mysqli_query($link, "SELECT seatavailable FROM exam_info 
              WHERE UNIX_TIMESTAMP(examdate)='$examtime' AND location='$location' AND status!='delete'")
            or die ("Could not match data because ".mysqli_error($link));
            $numavailable=mysqli_num_rows($checkavailable);
            if($numavailable<1)
            {
              print "你要的时间座位还没有开放预订，请联系管理员。";
              return;
            }
            $getavailable=mysqli_fetch_array($checkavailable);
            $newavailable=$getavailable['seatavailable'];
            if($newavailable<1)
            {
              print "你要的时间已经没有位子了，请联系管理员。";
              return;
            }

            $plusavailable=mysqli_query($link, "UPDATE exam_info SET seatavailable=seatavailable+1 
              WHERE UNIX_TIMESTAMP(examdate)='$oriexamtime' AND location='$orilocation' 
              AND status!='delete'")or die ("Could not match data because ".mysqli_error($link));
            

            $minusavailable=mysqli_query($link, "UPDATE exam_info SET seatavailable=seatavailable-1 
            WHERE UNIX_TIMESTAMP(examdate)='$examtime' AND location='$location' 
            AND status!='delete'")or die ("Could not match data because ".mysqli_error($link));
            
            $getoriid=mysqli_query($link, "SELECT * FROM ato_info WHERE ic='$atoic' AND location='$orilocation' 
              AND UNIX_TIMESTAMP(examtime)='$oriexamtime' AND status!='delete'")
              or die ("Could not match data because ".mysqli_error($link));
            // print "SELECT * FROM ato_info WHERE ic='".$atoic."' AND location='".$orilocation."' 
            //   AND UNIX_TIMESTAMP(examdate)='".$oriexamtime."' AND status!='delete'";
            while ($row=mysqli_fetch_array($getoriid)) 
            {
              $atoid=$row['atoid'];

              $prepost=$row['prepost'];

              $deleteori=mysqli_query($link, "UPDATE ato_info SET status='delete', updated_at=now() WHERE atoid='$atoid'")
              or die ("Could not match data because ".mysqli_error($link));
              
              $inputnew=mysqli_query($link, "INSERT INTO ato_info (ic, prepost, start_date, end_date,
              coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
              examtime, branch, branchop, status, remark, updated_at) VALUES ('$atoic','$prepost',FROM_UNIXTIME($start_date),
              FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
              '$EN','$ES','$EW','$email','$location',FROM_UNIXTIME($examtime),'$branch',
              '$branchop','atoentered','$remark', now())")
              or die ("Could not match data because ".mysqli_error($link));
              print "成功更新IC为".$atoic."的学员ato信息。<br />";
            }
          }
          else
          {
            $updateato=mysqli_query($link, "UPDATE ato_info SET start_date=FROM_UNIXTIME($start_date), 
              end_date=FROM_UNIXTIME($end_date),coursecode='$coursecode',prepost='$prepost',
              attendance='$attendance',recommend='$recommend',EL='$EL',ER='$ER',EN='$EN', 
              ES='$ES',EW='$EW',status='atoentered',remark='$remark',updated_at=now() WHERE atoid='$atoid'")
              or die ("Could not match data because ".mysqli_error($link));
            print "成功更新IC为".$atoic."的学员ato信息。";
          }
        }
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