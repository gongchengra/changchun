<?PHP
//include the main validation script
if(isset($_POST['inputclass']))
{// The form is submitted
  //Setup Validations
  include("includes/conn.php");
  include("includes/link.php");
  $classid=(isset($_POST['classid']))?
  mysql_real_escape_string(trim($_POST['classid'])):'';
  // $classname=mysql_real_escape_string(trim($_POST['classname']));
  $coursecode=mysql_real_escape_string(trim($_POST['coursecode']));
  $classtype=$_POST['classtype'];
  $classlevel =$_POST['classlevel'];
  $finish=$_POST['finish'];
  $location=mysql_real_escape_string(trim($_POST['location']));
  $class_startdate=(!empty($_POST['class_startdate']))?
  strtotime($_POST['class_startdate']):strtotime('2038-01-01');
  $class_endate=(!empty($_POST['class_endate']))?
  strtotime($_POST['class_endate']):strtotime('2038-01-01');
  $class_startime=mysql_real_escape_string(trim($_POST['class_startime']));
  $class_endtime=mysql_real_escape_string(trim($_POST['class_endtime']));
  $teacher=mysql_real_escape_string(trim($_POST['teacher']));
  $teacher_tel=mysql_real_escape_string(trim($_POST['teacher_tel']));
  $postcatlr=(!empty($_POST['lrdate'])&&!empty($_POST['lrtime']))?
  (strtotime($_POST['lrdate'])+(3600*$_POST['lrtime'])):strtotime('2038-01-01');
  $lrlocation=(!empty($_POST['lrlocation']))?$_POST['lrlocation']:'';
  $postcatsw=(!empty($_POST['swdate'])&&!empty($_POST['swtime']))?
  (strtotime($_POST['swdate'])+(3600*$_POST['swtime'])):strtotime('2038-01-01');
  $swlocation=(!empty($_POST['swlocation']))?$_POST['swlocation']:'';
  $branch=$_SESSION['branch'];
  $branchop=$_SESSION['username'];
  if(empty($classid))
  {
    $insertclass=mysql_query("INSERT INTO class_info (coursecode,
      classtype, classlevel, class_startdate, class_endate, class_startime,
      class_endtime, teacher, teacher_tel, location, postcatlr, lrlocation,
      postcatsw, swlocation, branch, branchop, finish) VALUES (
      '$coursecode', '$classtype', '$classlevel', FROM_UNIXTIME($class_startdate), 
      FROM_UNIXTIME($class_endate), '$class_startime', '$class_endtime', 
      '$teacher', '$teacher_tel', '$location', FROM_UNIXTIME($postcatlr), 
      '$lrlocation', FROM_UNIXTIME($postcatsw), '$swlocation', '$branch', 
      '$branchop', '$finish')")or die('Error: ' . mysql_error());
    echo "成功添加新班级！";
  }
  else
  {
    $checkclassid=mysql_query("SELECT * FROM class_info WHERE 
    classid='$classid' AND (branch='$branch' OR '$branch'='changchun') 
    AND status!='delete'")
    or die ("Could not match data because ".mysql_error());
    $num_rows = mysql_num_rows($checkclassid);
    if($num_rows<1)
    {
      echo "你的class id 输入错误，没有id为".$classid." 的班级";
    }
    else
    {
      $getclassid = mysql_fetch_array($checkclassid);
      // echo $getclassid['postcatlr'].'<br/>';
      $oldlr=strtotime($getclassid['postcatlr']);
      // echo $oldlr;
      $oldsw=strtotime($getclassid['postcatsw']);
      $updateclass=mysql_query("UPDATE class_info SET 
      coursecode='$coursecode', classtype='$classtype', classlevel='$classlevel', 
      class_startdate=FROM_UNIXTIME($class_startdate), 
      class_endate=FROM_UNIXTIME($class_endate),
      class_startime='$class_startime', class_endtime='$class_endtime',
      teacher='$teacher', teacher_tel='$teacher_tel', location='$location',
      postcatlr=FROM_UNIXTIME($postcatlr), lrlocation='$lrlocation', 
      postcatsw=FROM_UNIXTIME($postcatsw), swlocation='$swlocation', finish='$finish' 
      WHERE classid='$classid'")or die('Error: ' . mysql_error());
      echo "<script LANGUAGE='javascript'>alert('成功更新班级信息！');</script>";
      // echo "成功更新班级信息！"."<br>";
      if(($classtype=='encon'||$classtype=='encmp')&&($finish=='waitexam'))
      {
        // $prepost='POST';
        // $attendance='100';
        $branch=$_SESSION['branch'];
        $branchop=$_SESSION['username'];
        $email=$_SESSION['email'];
        if(empty($_POST['class_startdate']))
        {
          echo "<script LANGUAGE='javascript'>alert('请输入开课日期。');</script>";
          return;
          // echo "请输入开课日期。";
          // return;
        }
        $start_date=(isset($class_startdate))?$class_startdate:'';
        if(empty($_POST['class_endate']))
        {
          echo "<script LANGUAGE='javascript'>alert('请输入结课日期。');</script>";
          return;
          // echo "请输入结课日期。";
          // return;
        }
        $end_date=(isset($class_endate))?$class_endate:'';
        if(empty($_POST['coursecode']))
        {
          echo "<script LANGUAGE='javascript'>alert('请输入班级代码。');</script>";
          return;
          // echo "请输入班级代码。";
          // return;
        }
        $coursecode=(isset($coursecode))?$coursecode:'';
        if(empty($_POST['classtype']))
        {
          echo "<script LANGUAGE='javascript'>alert('请输入班级类型。');</script>";
          return;
          // echo "请输入班级类型。";
          // return;
        }
        $class_type=(isset($classtype))?$classtype:'';
        if(empty($_POST['classlevel']))
        {
          echo "<script LANGUAGE='javascript'>alert('请输入班级等级。');</script>";
          return;
          // echo "请输入班级等级。";
          // return;
        }
        $recommend=(isset($classlevel))?$classlevel:'';
        $examtime1=(isset($postcatlr))?$postcatlr:'';
        $location1=(isset($lrlocation))?$lrlocation:'';
        $examtime2=(isset($postcatsw))?$postcatsw:'';
        $location2=(isset($swlocation))?$swlocation:'';
        if($classtype=='encmp')
        {
          // $EL='Y'; $ER='Y'; $EN='N'; $ES='Y'; $EW='Y';
          if(empty($_POST['lrdate'])||empty($_POST['lrtime']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入听力阅读考试时间。');</script>";
            return;
            // echo "请输入听力阅读考试时间。";
            // return;
          }
          if(empty($_POST['lrlocation']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入听力阅读考试地点。');</script>";
            return;
            // echo "请输入听力阅读考试地点。";
            // return;
          }
          if(empty($_POST['swdate'])||empty($_POST['swtime']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入会话阅读考试时间。');</script>";
            return;
            // echo "请输入会话阅读考试时间。";
            // return;
          }
          if(empty($_POST['swlocation']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入会话阅读考试地点。');</script>";
            return;
            // echo "请输入会话阅读考试地点。";
            // return;
          }
        }
        if($classtype=='encon')
        {
          if(empty($_POST['lrdate'])||empty($_POST['lrtime']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入听力阅读考试时间。');</script>";
            return;
            // echo "请输入听力阅读考试时间。";
            // return;
          }
          if(empty($_POST['lrlocation']))
          {
            echo "<script LANGUAGE='javascript'>alert('请输入听力阅读考试地点。');</script>";
            return;
            // echo "请输入听力阅读考试地点。";
            // return;
          }
        }
        $showstudent=mysql_query("SELECT * FROM sub_class_info WHERE
        classid='$classid' AND status!='delete'")
        or die ("Could not match data because ".mysql_error());
        $num_student = mysql_num_rows($showstudent);
        if ($num_student > 0) 
        {
         while ($getstudent = mysql_fetch_array($showstudent)) 
          {
            $ic=$getstudent['ic'];
            $attendance=$getstudent['attendance'];
            $ESRec=$getstudent['ESRec'];
            $EWRec=$getstudent['EWRec'];
            $match = mysql_query("SELECT ic FROM student_info WHERE ic='$ic'")
            or die ("Could not match data because ".mysql_error());
            $num_rows = mysql_num_rows($match);
            if ($num_rows<1) 
            {
              echo "请先输入ic为".$ic." 的学员基本信息。"."<br>";
              continue;
            }
            else
            {
              if($classtype=='encon')
              {
                if(empty($_POST['EL1'])||empty($_POST['ER1'])||empty($_POST['EN1'])
                  ||empty($_POST['ES1'])||empty($_POST['EW1']))
                {
                  echo "<h2>请选择考不考".(empty($_POST['EL1'])?"听力":'').
                  (empty($_POST['ER1'])?"阅读":'').(empty($_POST['EN1'])?"数学":'').
                  (empty($_POST['ES1'])?"会话":'').(empty($_POST['EW1'])?"写作":'')."</h2>";
                  return;
                }
                $EL=$_POST['EL1']; $ER=$_POST['ER1']; $EN=$_POST['EN1']; 
                $ES=$_POST['ES1']; $EW=$_POST['EW1'];
                $checkato = mysql_query("SELECT * FROM ato_info WHERE ic='$ic' 
                AND UNIX_TIMESTAMP(examtime)='$oldlr' AND status!='delete'")
                or die ("Could not match data because ".mysql_error());
                $numato=mysql_num_rows($checkato);
                if($numato>0)
                {
                  while($getatoid=mysql_fetch_array($checkato))
                  {
                    $atoid=$getatoid['atoid'];
                    $atoES=$getatoid['ES'];
                    $atoEW=$getatoid['EW'];
                    $updateato=mysql_query("UPDATE ato_info SET start_date=FROM_UNIXTIME($start_date), 
                      end_date=FROM_UNIXTIME($end_date),coursecode='$coursecode',
                      attendance='$attendance',recommend='$recommend',EL='$EL',ER='$ER',EN='$EN', 
                      ES='$atoES',EW='$atoEW',location='$location1',examtime=FROM_UNIXTIME($examtime1),
                      updated_at=now() WHERE atoid='$atoid'")
                    or die ("Could not match data because ".mysql_error());
                  }
                  echo "成功更新IC为".$ic."的学员ato信息。"."<br>";
                }
                else
                {
                  if($ESRec=='EXE'||$ESRec=='NA')
                  {
                    $prepost='POST'; $ES='N';
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location1',FROM_UNIXTIME($examtime1),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());

                    $prepost='PRE'; $ES='Y';
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location1',FROM_UNIXTIME($examtime1),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  else
                  {
                    $prepost='POST';
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location1',FROM_UNIXTIME($examtime1),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  echo "成功输入IC为".$ic."的学员ato信息。"."<br>";
                }
              }
              if($classtype=='encmp')
              {
                if(empty($_POST['EL1'])||empty($_POST['ER1'])||empty($_POST['EN1'])
                  ||empty($_POST['ES1'])||empty($_POST['EW1'])||empty($_POST['EL2'])
                  ||empty($_POST['ER2'])||empty($_POST['EN2'])
                  ||empty($_POST['ES2'])||empty($_POST['EW2']))
                {
                  echo "<h2>请选择考不考".(empty($_POST['EL1'])?"听力":'').
                  (empty($_POST['ER1'])?"阅读":'').(empty($_POST['EN1'])?"数学":'').
                  (empty($_POST['ES1'])?"会话":'').(empty($_POST['EW1'])?"写作":'').
                  (empty($_POST['EL2'])?"听力":'').
                  (empty($_POST['ER2'])?"阅读":'').(empty($_POST['EN2'])?"数学":'').
                  (empty($_POST['ES2'])?"会话":'').(empty($_POST['EW2'])?"写作":'')."</h2>";
                  return;
                }
                $EL=$_POST['EL1']; $ER=$_POST['ER1']; $EN=$_POST['EN1']; 
                $ES=$_POST['ES1']; $EW=$_POST['EW1'];
                $checkato1 = mysql_query("SELECT atoid FROM ato_info WHERE ic='$ic' 
                AND UNIX_TIMESTAMP(examtime)='$oldlr' AND status!='delete'")
                or die ("Could not match data because ".mysql_error());
                $numato1=mysql_num_rows($checkato1);
                if($numato1>0)
                {
                  $getatoid=mysql_fetch_array($checkato1);
                  $atoid=$getatoid['atoid'];
                  $updateato=mysql_query("UPDATE ato_info SET start_date=FROM_UNIXTIME($start_date), 
                    end_date=FROM_UNIXTIME($end_date),coursecode='$coursecode',
                    attendance='$attendance',recommend='$recommend',EL='$EL',ER='$ER',EN='$EN', 
                    ES='$ES',EW='$EW',location='$location1',examtime=FROM_UNIXTIME($examtime1),
                    updated_at=now()
                    WHERE atoid='$atoid'")or die ("Could not match data because ".mysql_error());
                  
                  echo "成功更新IC为".$ic."的学员ato信息。"."<br>";
                }
                else
                {
                  $prepost='POST';
                  $insertato1=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                  coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                  examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                  FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                  '$EN','$ES','$EW','$email','$location1',FROM_UNIXTIME($examtime1),
                  '$branch','$branchop','atoentered',now())")
                  or die ("Could not match data because ".mysql_error());
                  echo "成功输入IC为".$ic."的学员ato信息。"."<br>";
                }

                $EL=$_POST['EL2']; $ER=$_POST['ER2']; $EN=$_POST['EN2']; 
                $ES=$_POST['ES2']; $EW=$_POST['EW2'];
                $checkato2 = mysql_query("SELECT * FROM ato_info WHERE ic='$ic' 
                AND UNIX_TIMESTAMP(examtime)='$oldsw' AND status!='delete'")
                or die ("Could not match data because ".mysql_error());
                $numato2=mysql_num_rows($checkato2);
                if($numato2>0)
                {
                  while($getatoid=mysql_fetch_array($checkato2))
                  {
                    $atoid=$getatoid['atoid'];
                    $atoES=$getatoid['ES'];
                    $atoEW=$getatoid['EW'];
                    // $oldprepost=$getatoid['prepost'];
                    $updateato=mysql_query("UPDATE ato_info SET start_date=FROM_UNIXTIME($start_date), 
                      end_date=FROM_UNIXTIME($end_date),coursecode='$coursecode',
                      attendance='$attendance',recommend='$recommend',EL='$EL',ER='$ER',EN='$EN', 
                      ES='$atoES',EW='$atoEW',location='$location2',examtime=FROM_UNIXTIME($examtime2),
                      updated_at=now()
                      WHERE atoid='$atoid'")or die ("Could not match data because ".mysql_error());
                  }
                  echo "成功更新IC为".$ic."的学员ato信息。"."<br>";
                }
                else
                {
                  if(($ESRec=='EXE'||$ESRec=='NA')&&($EWRec=='EXE'||$EWRec=='NA'))
                  {
                    $prepost='PRE'; 
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  elseif(($ESRec=='EXE'||$ESRec=='NA')&&(!($EWRec=='EXE'||$EWRec=='NA')))
                  {
                    $prepost='POST'; $ES='N'; $EW='Y';
                    $insertato1=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),
                    '$branch','$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());

                    $prepost='PRE'; $ES='Y'; $EW='N';
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  elseif((!($ESRec=='EXE'||$ESRec=='NA'))&&($EWRec=='EXE'||$EWRec=='NA'))
                  {
                    $prepost='POST'; $EW='N'; $ES='Y';
                    $insertato1=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),
                    '$branch','$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());

                    $prepost='PRE'; $EW='Y'; $ES='N';
                    $insertato=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),'$branch',
                    '$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  else
                  {
                    $prepost='POST';
                    $insertato2=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
                    coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
                    examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
                    FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
                    '$EN','$ES','$EW','$email','$location2',FROM_UNIXTIME($examtime2),
                    '$branch','$branchop','atoentered',now())")
                    or die ("Could not match data because ".mysql_error());
                  }
                  echo "成功输入IC为".$ic."的学员ato信息。"."<br>";
                }
              }
            }
          }
        }
        else
        {
          echo "这个班一个人都没有。";
        }
      }
    } 
  }
}//if(isset($_POST['inputbasic']))
?>