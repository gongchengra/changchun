<?PHP

if(empty($_POST['classid1'])||empty($_POST['ic']))
{
  echo "<br>"."请先输入班级id和学员ic。";
  return;
}
include("conn.php");
include("link1.php");
$ic=mysqli_real_escape_string($link, trim($_POST['ic']));
if (strlen($ic)!=9) 
{
  echo "<script LANGUAGE='javascript'>alert('你的学员IC位数不对。');</script>";
  return;
}
$classid1=mysqli_real_escape_string($link, trim($_POST['classid1']));
$branch=$_POST['hiddenbranch'];
$icArray=str_split($ic);
include("ic.php");
if ($icArray[8]!=$theAlpha) 
{
  echo "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
}
else
{
  $checkclassid = mysqli_query($link, "SELECT * FROM class_info WHERE 
  classid='$classid1' AND status!='delete'")
  or die ("Could not match data because ".mysqli_error($link));
  $numclassid = mysqli_num_rows($checkclassid);
  if($numclassid>0)
  {
    $getclassid = mysqli_fetch_array($checkclassid);
    if(($getclassid['classtype']=='encmp')||($getclassid['classtype']=='encon'))
    {
      // $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
      //   where ic='$ic' AND (branch='$branch' OR branch='changchun') 
      //   AND status!='delete'")
      $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
        where ic='$ic' AND status!='delete'")
        or die ("Could not match data because ".mysqli_error($link));
      $numrecord=mysqli_num_rows($checkrecord);
      if($numrecord<1)
      {
        echo "没有学员的成绩信息，不能添加学员。";
      }
      else
      {
        $getrecord=mysqli_fetch_array($checkrecord);
        $recbranch=$getrecord['branch'];
        if($branch!==$recbranch)
        {
          echo "该学员属于".$recbranch."分部，请联系总部或者该分部人员修改分部信息。";
          return;
        }
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
        $match = mysqli_query($link, "SELECT tel, tel_home, name FROM student_info WHERE ic='$ic'")
        or die ("Could not match data because ".mysqli_error($link));
        $num_rows = mysqli_num_rows($match);
        if ($num_rows<1) 
        {
          echo "<script LANGUAGE='javascript'>alert('请先输入学员的基本信息。');</script>";
        }
        else
        {
          $getictel=mysqli_fetch_array($match);
          $tel=$getictel['tel'];
          $name=$getictel['name'];
          $_POST['attendance']=(isset($_POST['attendance']))?trim($_POST['attendance']):100;
          if(!is_numeric($_POST['attendance']))
          {
            echo "<script LANGUAGE='javascript'>alert('出勤率必须是数字！');</script>";
            return;
          }
          $attendance=$_POST['attendance'];
          $matchsub = mysqli_query($link, "SELECT * FROM sub_class_info WHERE ic='$ic' 
            AND classid='$classid1' AND status!='delete'")or die ("Could not match data because ".mysqli_error($link));
          $num_rowsub = mysqli_num_rows($matchsub);
          if($num_rowsub>0)
          {
            $update_subclass=mysqli_query($link, "UPDATE sub_class_info 
              SET notes='$notes', attendance='$attendance', status='A'
              WHERE ic='$ic' AND classid='$classid1'")
              or die("Could not match data because ".mysqli_error($link));
            echo "<script LANGUAGE='javascript'>alert('成功更新学员信息。');</script>";
            // echo "<script LANGUAGE='javascript'>document.searchstudent.submit();</script>";
          }
          else
          {
            $input_subclass=mysqli_query($link, "INSERT INTO sub_class_info
              (classid, ic, name, tel, ELRec, ERRec, ENRec, ESRec, EWRec, 
                CMP, CON, WRI, WPN, rlupdated_at, swupdated_at, notes, attendance) 
              VALUES ('$classid1', '$ic', '$name', '$tel', '$ELRec', '$ERRec', '$ENRec',
               '$ESRec', '$EWRec', '$CMP','$CON','$WRI','$WPN','$rlupdated_at','$swupdated_at'
               ,'$notes', '$attendance')")
            or die("Could not match data because ".mysqli_error($link));
            echo "<script LANGUAGE='javascript'>alert('成功添加学员到id为".$classid1." 的班级。');</script>";
          }
          $_POST['reg_no']=(isset($_POST['reg_no']))?trim($_POST['reg_no']):'';
          $_POST['receipt_no']=(isset($_POST['receipt_no']))?trim($_POST['receipt_no']):'';
          $reg_no=mysqli_real_escape_string($link, $_POST['reg_no']);
          $receipt_no=mysqli_real_escape_string($link, $_POST['receipt_no']);
          if(!empty($reg_no))
          {
            $checkreg=mysqli_query($link, "SELECT * FROM reg_info WHERE 
            ic='$ic' AND reg_no='$reg_no' AND status!='delete'")
            or die ("Could not match data because ".mysqli_error($link));
            $num_reg = mysqli_num_rows($checkreg);
            if($num_reg<1)
            {
              echo "<script LANGUAGE='javascript'>alert('没有找到报名表号为".$reg_no."。');</script>";
              return;
            }
            else
            {
              $getreg=mysqli_fetch_array($checkreg);
              $reg_date=$getreg['reg_date'];
              $update_subclass=mysqli_query($link, "UPDATE sub_class_info
                SET reg_no='$reg_no', reg_date='$reg_date' 
                WHERE ic='$ic' AND classid='$classid1' AND status!='delete'")
              or die ("Could not update data because ".mysqli_error($link));
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
              $checkreceipt=mysqli_query($link, "SELECT * FROM receipt_info WHERE 
              receiptic='$ic' AND receipt_no='$receipt' AND status!='delete'")
              or die ("Could not match data because ".mysqli_error($link));
              $num_receipt = mysqli_num_rows($checkreceipt);
              if($num_receipt<1)
              {
                echo "<script LANGUAGE='javascript'>alert('没有找到收据号为".$receipt."。');</script>";
                return;
              }
              else
              {
                $getreceipt=mysqli_fetch_array($checkreceipt);
                $getamount=$getreceipt['amount'];
                $newreceipt=$newreceipt.$receipt.'+';
                $newamount=$newamount.$getamount.'+';
              }
            }
            $newreceipt=explode('+',$newreceipt,-1);
            $newreceipt=implode('+',$newreceipt);
            $newamount=explode('+',$newamount,-1);
            $newamount=implode('+',$newamount);
            $update_subclass=mysqli_query($link, "UPDATE sub_class_info
                  SET relatedreceipt='$newreceipt', relatedamount='$newamount' 
                  WHERE ic='$ic' AND classid='$classid1' AND status!='delete'")
                or die ("Could not update data because ".mysqli_error($link));
          }
        }
      }
    }
    else
    {
      $match = mysqli_query($link, "SELECT tel, tel_home, name FROM student_info WHERE ic='$ic'")
      or die ("Could not match data because ".mysqli_error($link));
      $num_rows = mysqli_num_rows($match);
      if ($num_rows<1) 
      {
        echo "<script LANGUAGE='javascript'>alert('请先输入学员的基本信息。');</script>";
      }
      else
      {
        $getictel=mysqli_fetch_array($match);
        $tel=$getictel['tel'];
        $name=$getictel['name'];
        $_POST['notes']=(isset($_POST['notes']))?trim($_POST['notes']):'';
        $notes=mysqli_real_escape_string($link, $_POST['notes']);
        $_POST['attendance']=(isset($_POST['attendance']))?trim($_POST['attendance']):100;
        if(!is_numeric($_POST['attendance']))
        {
          echo "出勤率必须是数字！";
          return;
        }
        $attendance=$_POST['attendance'];
        $matchsub = mysqli_query($link, "SELECT * FROM sub_class_info WHERE ic='$ic' 
          AND classid='$classid1' AND status!='delete'")
          or die ("Could not match data because ".mysqli_error($link));
        $num_rowsub = mysqli_num_rows($matchsub);
        if($num_rowsub>0)
        {
          $update_subclass=mysqli_query($link, "UPDATE sub_class_info 
            SET notes='$notes', attendance='$attendance' WHERE ic='$ic' AND classid='$classid1'
            AND status!='delete'")
            or die("Could not match data because ".mysqli_error($link));
            echo "成功更新学员信息。";
            // echo "<script LANGUAGE='javascript'>document.searchstudent.submit();</script>";
        }
        else
        {
          $input_subclass=mysqli_query($link, "INSERT INTO sub_class_info
            (classid, ic, name, tel, ELRec, ERRec, ENRec, ESRec, EWRec, notes, attendance) 
            VALUES ('$classid1', '$ic', '$name', '$tel', '', '', '',
             '', '', '$notes', '$attendance')")or die("Could not match data because ".mysqli_error($link));
          echo "成功添加学员到id为".$classid1." 的班级。";
        }
      }
    }
  }
  else
  {
    echo "没有id为".$classid1."的班级。";
  }
}
?>