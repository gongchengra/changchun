<?PHP
//include the main validation script
require_once "formvalidator.php";
if(isset($_POST['book']))
{// The form is submitted
  $validator = new FormValidator();
  $validator->addValidation("bookexamdate","req","请输入考试日期");
  $validator->addValidation("examlocation","dontselect=请选择","请选择考试地点");
  $validator->addValidation("examtime","dontselect=请选择","请选择考试时间");
  $validator->addValidation("prepost","dontselect=请选择","请选择考试类型");
  $validator->addValidation("atoic","req","请输入学员ic");
  //Now, validate the form
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    include("includes/link.php");
    $bookdate=strtotime($_POST['bookexamdate'])+(3600*$_POST['examtime']);
    $location=$_POST['examlocation'];
    $ic=mysql_real_escape_string(trim($_POST['atoic']));
    $icArray=str_split($ic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
        'exam.php#inputatohead'</script>";
    }
    else
    {
      if(empty($_POST['EL'])||empty($_POST['ER'])||empty($_POST['EN'])
        ||empty($_POST['ES'])||empty($_POST['EW']))
      {
        echo "<h2>请选择考不考".(empty($_POST['EL'])?"听力":'').
        (empty($_POST['ER'])?"阅读":'').(empty($_POST['EN'])?"数学":'').
        (empty($_POST['ES'])?"会话":'').(empty($_POST['EW'])?"写作":'')."</h2>";
        return;
      }
      if(($_POST['EL']=='N')&&($_POST['ER']=='N')&&($_POST['EN']=='N')
        &&($_POST['ES']=='N')&&($_POST['EW']=='N'))      
      {
        echo "<h2>你好像没选考试科目</h2>";
        return;
      }
        $book='book';
      // $match = mysql_query("SELECT ic, tel, tel_home, name FROM student_info WHERE ic='$ic'")
      // or die ("Could not match data because ".mysql_error());
      // $num_rows = mysql_num_rows($match);
      // if ($num_rows<1) 
      // {
      //   $book='book';
      // }
      // else
      // {
      //   $book='atoentered';
      // }
      $prepost=$_POST['prepost'];
      $start_date=strtotime($_POST['bookexamdate']);
      $end_date=$start_date;
      $coursecode='Etest Training';
      $attendance='100';
      $recommend='Waiting for the result';
      $EL=$_POST['EL'];
      $ER=$_POST['ER'];
      $EN=$_POST['EN'];
      $ES=$_POST['ES'];
      $EW=$_POST['EW'];
      $branch=$_POST['hiddenbranch'];
      // echo $branch;
      $branchop=$_POST['hiddenbranchop'];
      $email=$_POST['hiddenemail'];
      // $email=$branch."@changchun.edu.sg";
      $checkseat=mysql_query("SELECT * FROM exam_info WHERE 
      UNIX_TIMESTAMP(examdate)='$bookdate' AND location='$location'")
      or die ("Could not match data because ".mysql_error());
      $checkseatrow=mysql_fetch_array($checkseat);
      $checkseatnumber=$checkseatrow['seatavailable'];
      $checkonoff=$checkseatrow['finish'];
      if (($checkseatnumber<1)||($checkonoff=='off')) 
      {
        echo "没有位子了，换个时间吧。";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'exam.php#inputatohead'</script>";
      }
      else
      {
        if(empty($_POST['atoid']))
        {
          // $now=strtotime("now");
          // $checkseatbooked = mysql_query("SELECT * FROM ato_info WHERE ic='$ic' 
          // AND UNIX_TIMESTAMP(examtime)>'$now' AND status!='delete'")
          //  or die ("Could not match data because ".mysql_error());
          // $num_seatbooked = mysql_num_rows($checkseatbooked);
          // if($num_seatbooked>=2)
          // {
          //   echo "你已经为IC为".$ic."的学员订过两个座位了";
          //   return;
          // } 
          $qry = mysql_query("SELECT * FROM ato_info WHERE ic='$ic' 
          AND UNIX_TIMESTAMP(examtime)='$bookdate' AND status!='delete'")
           or die ("Could not match data because ".mysql_error());
          $num_rows = mysql_num_rows($qry); 
          if ($num_rows <= 0) 
          {
            $inputnew=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
            coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
            examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
            FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
            '$EN','$ES','$EW','$email','$location',FROM_UNIXTIME($bookdate),'$branch',
            '$branchop','$book',now())")
            or die ("Could not match data because ".mysql_error());

            // if ($prepost=='PRE') 
            // {
            $minusnumber="UPDATE exam_info SET seatavailable=seatavailable-1 WHERE 
            UNIX_TIMESTAMP(examdate)='$bookdate' AND location='$location'";
            if (!mysql_query($minusnumber,$link)){die('Error: ' . mysql_error());}
            // }
            
            // sleep(3);
            echo "<meta http-equiv='refresh' content='0;URL=exam.php'>"; 
            echo "<script LANGUAGE='javascript'>alert('预定座位成功');</script>";
            echo "<script LANGUAGE='javascript'>document.location.href=
            'exam.php#inputatohead'</script>";
          }
          else
          {
            echo "你已经为IC为".$ic."的学员订过".$_POST['bookexamdate']."号".
            $_POST['examtime']."点的座位了. 请尽快填写ato!";
            echo "<script LANGUAGE='javascript'>document.location.href=
          'exam.php#inputatohead'</script>";
          }
        }
        else
        {
          $atoid=mysql_real_escape_string(trim($_POST['atoid']));
          $checkatoid=mysql_query("SELECT atoid FROM ato_info 
            WHERE atoid='$atoid' AND (branch='$branch' OR '$branch'='changchun') 
            AND status!='delete'")
          or die ("Could not match data because ".mysql_error()); 
          $numatoid = mysql_num_rows($checkatoid);
          if($numatoid<1)
          {
            echo "没有ato id为".$atoid." 的学员报名信息或者该信息属于其他分部。";

            echo "<script LANGUAGE='javascript'>document.location.href=
            'exam.php#inputatohead'</script>";
            return;
          }
          else
          {
            $findoriexamtime=mysql_query("SELECT UNIX_TIMESTAMP(examtime) as examtime, location, branch, branchop
            FROM ato_info WHERE atoid='$atoid' AND status!='delete'")
            or die ("Could not match data because ".mysql_error());
            $getorigin = mysql_fetch_array($findoriexamtime);
            $oriexamtime = $getorigin['examtime'];
            if(($oriexamtime-strtotime("now")<8*24*3600)&&
              ($bookdate-$oriexamtime<10*24*3600))
            {
              echo "<h2>学员信息已录入SSA系统，无法更改。
              请预定比原来预定时间晚十天的座位。</h2>";
              echo "<script LANGUAGE='javascript'>document.location.href=
            'exam.php#inputatohead'</script>";
              return;
            }
            $orilocation = $getorigin['location'];
            $branch = $getorigin['branch'];
            $branchop = $getorigin['branchop'];
            if(($oriexamtime!=$bookdate)OR($orilocation!=$location))
            {
              $checkavailable=mysql_query("SELECT seatavailable FROM exam_info 
                WHERE UNIX_TIMESTAMP(examdate)='$bookdate' AND location='$location' AND status!='delete'")
              or die ("Could not match data because ".mysql_error());
              $numavailable=mysql_num_rows($checkavailable);
              if($numavailable<1)
              {
                echo "你要的时间座位还没有开放预订，请联系管理员。";
                echo "<script LANGUAGE='javascript'>document.location.href=
                'exam.php#inputatohead'</script>";
                return;
              }
              $getavailable=mysql_fetch_array($checkavailable);
              $newavailable=$getavailable['seatavailable'];
              if($newavailable<1)
              {
                echo "你要的时间已经没有位子了，请联系管理员。";
                echo "<script LANGUAGE='javascript'>document.location.href=
                'exam.php#inputatohead'</script>";
                return;
              }

              $plusavailable=mysql_query("UPDATE exam_info SET seatavailable=seatavailable+1 
                WHERE UNIX_TIMESTAMP(examdate)='$oriexamtime' AND location='$orilocation' 
                AND status!='delete'")or die ("Could not match data because ".mysql_error());
              $deleteori=mysql_query("UPDATE ato_info SET status='delete', updated_at=now() WHERE atoid='$atoid'")
                or die ("Could not match data because ".mysql_error());

              $minusavailable=mysql_query("UPDATE exam_info SET seatavailable=seatavailable-1 
              WHERE UNIX_TIMESTAMP(examdate)='$bookdate' AND location='$location' 
              AND status!='delete'")or die ("Could not match data because ".mysql_error());
              
              $inputnew=mysql_query("INSERT INTO ato_info (ic, prepost, start_date, end_date,
              coursecode, attendance, recommend, EL, ER, EN, ES, EW, email, location,
              examtime, branch, branchop, status, updated_at) VALUES ('$ic','$prepost',FROM_UNIXTIME($start_date),
              FROM_UNIXTIME($end_date),'$coursecode','$attendance','$recommend','$EL','$ER',
              '$EN','$ES','$EW','$email','$location',FROM_UNIXTIME($bookdate),'$branch',
              '$branchop','$book', now())")
              or die ("Could not match data because ".mysql_error());

              echo "成功输入IC为".$ic."的学员ato信息。";
              echo "<script LANGUAGE='javascript'>document.location.href=
                'exam.php#inputatohead'</script>";
            }
            else
            {
              $updateato=mysql_query("UPDATE ato_info SET ic='$ic',
              prepost='$prepost', start_date=FROM_UNIXTIME($bookdate), 
              end_date=FROM_UNIXTIME($bookdate),coursecode='$coursecode',
              attendance='$attendance',recommend='$recommend',EL='$EL',ER='$ER',EN='$EN', 
              ES='$ES',EW='$EW',status='$book',updated_at=now() WHERE atoid='$atoid'")
              or die ("Could not match data because ".mysql_error());
            
              echo "成功更新IC为".$ic."的学员ato信息。";
              echo "<script LANGUAGE='javascript'>document.location.href=
                'exam.php#inputatohead'</script>";
            }
          }
        }
      }
    }
    // unset($_POST);
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
        'exam.php#inputatohead'</script>";
  }//else
}//if(isset($_POST['Submit']))
?>