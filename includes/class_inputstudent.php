<?PHP
if(isset($_GET['ic'])&&$_GET['ic']!='')
{
  $_POST['ic']=$_GET["ic"];
  $_POST['classid1']=$_GET['classid'];
  $_POST['inputstudent']=true;
}
//include the main validation script
if(isset($_POST['inputstudent']))
{// The form is submitted
  //Setup Validations
  if(empty($_POST['classid1'])||empty($_POST['ic']))
  {
    echo "<br>"."请先输入班级id和学员ic。";
    echo "<script LANGUAGE='javascript'>document.location.href=
                    'class.php#tabs-2'</script>";
    return;
  }
  include("includes/conn.php");
  include("includes/link.php");
  $ic=mysql_real_escape_string(trim($_POST['ic']));
  $classid1=mysql_real_escape_string(trim($_POST['classid1']));
  $branch=$_SESSION['branch'];
  $icArray=str_split($ic);
  include("includes/ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    echo "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
  }
  else
  {
    $checkclassid = mysql_query("SELECT * FROM class_info WHERE 
    classid='$classid1' AND status!='delete'")
    or die ("Could not match data because ".mysql_error());
    $numclassid = mysql_num_rows($checkclassid);
    if($numclassid>0)
    {
      $getclassid = mysql_fetch_array($checkclassid);
      if(($getclassid['classtype']=='encmp')||($getclassid['classtype']=='encon'))
      {
        $checkrecord=mysql_query("SELECT * FROM student_record 
          where ic='$ic' AND (branch='$branch' OR branch='changchun') 
          AND status!='delete'")
          or die ("Could not match data because ".mysql_error());
        $numrecord=mysql_num_rows($checkrecord);
        if($numrecord<1)
        {
          echo "<script LANGUAGE='javascript'>alert('没有学员的成绩信息，
            或者该学员属于其他分部。不能添加学员。');</script>";
          echo "<script LANGUAGE='javascript'>document.location.href=
                        'class.php?classid=$classid1#tabs-2'</script>";
        }
        else
        {
          $getrecord=mysql_fetch_array($checkrecord);
          $ELRec=$getrecord['ELBest'];
          $ERRec=$getrecord['ERBest'];
          $ENRec=$getrecord['ENBest'];
          $ESRec=$getrecord['ESBest'];
          $EWRec=$getrecord['EWBest'];
          $CMP=$getrecord['CMP'];
          $CON=$getrecord['CON'];
          $WRI=$getrecord['WRI'];
          $WPN=$getrecord['WPN'];
          $rlupdated_at=(!empty($getrecord['rlupdated_at']))?$getrecord['rlupdated_at']:date('Y-m-d');
          $swupdated_at=(!empty($getrecord['swupdated_at']))?$getrecord['swupdated_at']:date('Y-m-d');
          $notes=$getrecord['remark'];
          $match = mysql_query("SELECT tel, tel_home, name FROM student_info WHERE ic='$ic'")
          or die ("Could not match data because ".mysql_error());
          $num_rows = mysql_num_rows($match);
          if ($num_rows<1) 
          {
            echo "<script LANGUAGE='javascript'>alert('请先输入学员的基本信息。');</script>";
            echo "<script LANGUAGE='javascript'>document.location.href=
            'class.php?classid=$classid1#tabs-2'</script>";
          }
          else
          {
            $getictel=mysql_fetch_array($match);
            $tel=$getictel['tel'];
            $name=$getictel['name'];
            $_POST['attendance']=(isset($_POST['attendance']))?trim($_POST['attendance']):100;
            if(!is_numeric($_POST['attendance']))
            {
              echo "<script LANGUAGE='javascript'>alert('出勤率必须是数字！');</script>";
              echo "<script LANGUAGE='javascript'>document.location.href=
                'class.php?classid=$classid1#tabs-2'</script>";
              return;
            }
            $attendance=$_POST['attendance'];
            $matchsub = mysql_query("SELECT * FROM sub_class_info WHERE ic='$ic' 
              AND classid='$classid1' AND status!='delete'")or die ("Could not match data because ".mysql_error());
            $num_rowsub = mysql_num_rows($matchsub);
            if($num_rowsub>0)
            {
              $update_subclass=mysql_query("UPDATE sub_class_info 
                SET notes='$notes', attendance='$attendance', status='A'
                WHERE ic='$ic' AND classid='$classid1'")
                or die("Could not match data because ".mysql_error());
              echo "<script LANGUAGE='javascript'>alert('成功更新学员信息。');</script>";
              echo "<script LANGUAGE='javascript'>document.location.href=
              'class.php?classid=$classid1#tabs-2'</script>";
              // echo "<script LANGUAGE='javascript'>document.searchstudent.submit();</script>";
            }
            else
            {
              $input_subclass=mysql_query("INSERT INTO sub_class_info
                (classid, ic, name, tel, ELRec, ERRec, ENRec, ESRec, EWRec, 
                  CMP, CON, WRI, WPN, rlupdated_at, swupdated_at, notes, attendance) 
                VALUES ('$classid1', '$ic', '$name', '$tel', '$ELRec', '$ERRec', '$ENRec',
                 '$ESRec', '$EWRec', '$CMP','$CON','$WRI','$WPN','$rlupdated_at','$swupdated_at'
                 ,'$notes', '$attendance')")
              or die("Could not match data because ".mysql_error());
              echo "<script LANGUAGE='javascript'>alert('成功添加学员到id为".$classid1." 的班级。');</script>";
              echo "<script LANGUAGE='javascript'>document.location.href=
                'class.php?classid=$classid1#tabs-2'</script>";
            }
            $_POST['reg_no']=(isset($_POST['reg_no']))?trim($_POST['reg_no']):'';
            $_POST['receipt_no']=(isset($_POST['receipt_no']))?trim($_POST['receipt_no']):'';
            $reg_no=mysql_real_escape_string($_POST['reg_no']);
            $receipt_no=mysql_real_escape_string($_POST['receipt_no']);
            if(!empty($reg_no))
            {
              $checkreg=mysql_query("SELECT * FROM reg_info WHERE 
              ic='$ic' AND reg_no='$reg_no' AND status!='delete'")
              or die ("Could not match data because ".mysql_error());
              $num_reg = mysql_num_rows($checkreg);
              if($num_reg<1)
              {
                echo "<script LANGUAGE='javascript'>alert('没有找到报名表号为".$reg_no."。');</script>";
                echo "<script LANGUAGE='javascript'>document.location.href=
                  'class.php?classid=$classid1#tabs-2'</script>";
                return;
              }
              else
              {
                $getreg=mysql_fetch_array($checkreg);
                $reg_date=$getreg['reg_date'];
                $update_subclass=mysql_query("UPDATE sub_class_info
                  SET reg_no='$reg_no', reg_date='$reg_date' 
                  WHERE ic='$ic' AND classid='$classid1' AND status!='delete'")
                or die ("Could not update data because ".mysql_error());
              }
            }
            if(!empty($receipt_no))
            {
              $receipts=explode('+', $receipt_no);
              $newreceipt='';
              $newamount='';
              foreach ($receipts as $receipt) 
              {
                $receipt=trim($receipt);
                $checkreceipt=mysql_query("SELECT * FROM receipt_info WHERE 
                receiptic='$ic' AND receipt_no='$receipt' AND status!='delete'")
                or die ("Could not match data because ".mysql_error());
                $num_receipt = mysql_num_rows($checkreceipt);
                if($num_receipt<1)
                {
                  echo "<script LANGUAGE='javascript'>alert('没有找到收据号为".$receipt."。');</script>";
                  echo "<script LANGUAGE='javascript'>document.location.href=
                    'class.php?classid=$classid1#tabs-2'</script>";
                  return;
                }
                else
                {
                  $getreceipt=mysql_fetch_array($checkreceipt);
                  $getamount=$getreceipt['amount'];
                  $newreceipt=$newreceipt.$receipt.'+';
                  $newamount=$newamount.$getamount.'+';
                }
              }
              $newreceipt=explode('+',$newreceipt,-1);
              $newreceipt=implode('+',$newreceipt);
              $newamount=explode('+',$newamount,-1);
              $newamount=implode('+',$newamount);
              $update_subclass=mysql_query("UPDATE sub_class_info
                    SET relatedreceipt='$newreceipt', relatedamount='$newamount' 
                    WHERE ic='$ic' AND classid='$classid1' AND status!='delete'")
                  or die ("Could not update data because ".mysql_error());
            }
          }
        }
      }
      else
      {
        $match = mysql_query("SELECT tel, tel_home, name FROM student_info WHERE ic='$ic'")
        or die ("Could not match data because ".mysql_error());
        $num_rows = mysql_num_rows($match);
        if ($num_rows<1) 
        {
          echo "<script LANGUAGE='javascript'>alert('请先输入学员的基本信息。');</script>";
          echo "<script LANGUAGE='javascript'>document.location.href=
            'class.php?classid=$classid1#tabs-2'</script>";
        }
        else
        {
          $getictel=mysql_fetch_array($match);
          $tel=$getictel['tel'];
          $name=$getictel['name'];
          $_POST['notes']=(isset($_POST['notes']))?trim($_POST['notes']):'';
          $notes=mysql_real_escape_string($_POST['notes']);
          $_POST['attendance']=(isset($_POST['attendance']))?trim($_POST['attendance']):100;
          if(!is_numeric($_POST['attendance']))
          {
            echo "出勤率必须是数字！";
            echo "<script LANGUAGE='javascript'>document.location.href=
              'class.php?classid=$classid1#tabs-2'</script>";
            return;
          }
          $attendance=$_POST['attendance'];
          $matchsub = mysql_query("SELECT * FROM sub_class_info WHERE ic='$ic' 
            AND classid='$classid1' AND status!='delete'")
            or die ("Could not match data because ".mysql_error());
          $num_rowsub = mysql_num_rows($matchsub);
          if($num_rowsub>0)
          {
            $update_subclass=mysql_query("UPDATE sub_class_info 
              SET notes='$notes', attendance='$attendance' WHERE ic='$ic' AND classid='$classid1'
              AND status!='delete'")
              or die("Could not match data because ".mysql_error());
              echo "成功更新学员信息。";
              echo "<script LANGUAGE='javascript'>document.location.href=
              'class.php?classid=$classid1#tabs-2'</script>";
              // echo "<script LANGUAGE='javascript'>document.searchstudent.submit();</script>";
          }
          else
          {
            $input_subclass=mysql_query("INSERT INTO sub_class_info
              (classid, ic, name, tel, ELRec, ERRec, ENRec, ESRec, EWRec, notes, attendance) 
              VALUES ('$classid1', '$ic', '$name', '$tel', '', '', '',
               '', '', '$notes', '$attendance')")or die("Could not match data because ".mysql_error());
            echo "成功添加学员到id为".$classid1." 的班级。";
            echo "<script LANGUAGE='javascript'>document.location.href=
              'class.php?classid=$classid1#tabs-2'</script>";
          }
        }
      }
    }
    else
    {
      echo "没有id为".$classid1."的班级。";
    }
  }
}//if(isset($_POST['inputbasic']))
?>