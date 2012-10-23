<?PHP
//include the main validation script
require_once "../formvalidator.php";
$_POST['regic']=trim($_POST['regic']);
$validator = new FormValidator();
$validator->addValidation("regic","req","请输入学员ic");
$validator->addValidation("regic","minlen=9","学员ic应该是9位");
$validator->addValidation("regic","maxlen=9","学员ic应该是9位");
$validator->addValidation("reg_date","req","请输入报名日期");
$validator->addValidation("reg_location","req","请输入报名地点");
$validator->addValidation("reg_no","req","请输入报名表号码");
$validator->addValidation("reg_op","req","请输入报名人");
if($validator->ValidateForm())
{
  include("conn.php");
  include("link1.php");
  $regic=mysqli_real_escape_string($link, $_POST['regic']);
  $icArray=str_split($regic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    print "你的学员IC输错了吧，格式不对呀。";
  }
  else
  {
    print "<h2>输入有效</h2>";
    $reg_date=strtotime($_POST['reg_date']);
    $reg_location=mysqli_real_escape_string($link, trim($_POST['reg_location']));
    $reg_no=mysqli_real_escape_string($link, trim($_POST['reg_no']));
    $reg_op=mysqli_real_escape_string($link, trim($_POST['reg_op']));
    $reg_op=str_replace(' ', '', $reg_op);
    $reg_op=strtolower($reg_op);
    $classtime=(!empty($_POST['classtime']))?strtotime($_POST['classtime'])
    :strtotime('01/01/2038');
    $match = mysqli_query($link, "SELECT ic, tel, tel_home, name FROM student_info WHERE ic='$regic'")
    or die ("Could not match data because ".mysqli_error($link));
    $num_rows = mysqli_num_rows($match);
    if ($num_rows<1) 
    {
      $checkreceiptform=mysqli_query($link, "SELECT * FROM receipt_info WHERE
        receiptic='$regic' AND status!='delete'")
      or die ("Could not match data because ".mysqli_error($link));
      $num_receipt=mysqli_num_rows($checkreceiptform);
      if($num_receipt<1)
      {
        print "要填写报名信息，系统需要知道学员的基本信息。"."<br>";
        print "如果是英文课程，请先输入学员基本信息。
        如果是其他课程，请先输入学员的收费信息。";
      }
      else
      {
        $row = mysqli_fetch_array($checkreceiptform);
        $branch=$_POST['hiddenbranch'];
        $branchop=$_POST['hiddenbranchop'];
        if (empty($_POST['regid'])) 
        {
          $checkregno=mysqli_query($link, "SELECT * FROM reg_info 
            WHERE reg_no='$reg_no' AND (branch='$branch' OR '$branch'='changchun') 
            AND status!='delete'")
            or die ("Could not match data because ".mysqli_error($link)); 
          $numregno = mysqli_num_rows($checkregno);
          if($numregno<1)
          {
            //insert register information
            $insertreg = mysqli_query($link, "INSERT INTO reg_info (ic, reg_date, reg_location, reg_op,
            reg_no, classtime, branch, branchop) VALUES ('$regic', FROM_UNIXTIME($reg_date), 
            '$reg_location','$reg_op','$reg_no',FROM_UNIXTIME($classtime),'$branch','$branchop')")
            or die ("Could not insert data because ".mysqli_error($link));
            
            print "成功输入IC为".$regic." 的学员报名信息。报名表号码为 ".$reg_no."。";
            $checkregid=mysqli_query($link, "SELECT regid FROM reg_info 
              WHERE ic='$regic' AND reg_no='$reg_no' AND status!='delete'")
              or die("Could not match data because ".mysqli_error($link));
            $getregid=mysqli_fetch_array($checkregid);
            $_POST['regid']=$getregid['regid'];
          }
          else
          {
            $getreg = mysqli_fetch_array($checkregno);
            echo "该报名表号码已经存在，请速速联系管理员。";
            echo "对应id为".$getreg['regid']."属于".$getreg['branch'];
          }
        }
        else
        {
          // $getrefid = mysqli_query($link, "SELECT regid FROM reg_info WHERE reg_no='$reg_no'")
          // or die ("Could not match data because ".mysqli_error($link));
          // $getref = mysqli_fetch_array($getrefid);
          // $refid = $getref['regid'];
          $regid=mysqli_real_escape_string($link, trim($_POST['regid']));

          $checkregid=mysqli_query($link, "SELECT regid FROM reg_info WHERE regid='$regid' 
            AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
          or die ("Could not match data because ".mysqli_error($link)); 
          $numregid = mysqli_num_rows($checkregid);
          if($numregid<1)
          {
            print "没有报名id为".$regid." 的学员报名信息或者该信息属于别的分部。";
            return;
          }
          
          $updatereg = mysqli_query($link,"UPDATE reg_info SET ic='$regic', reg_date=FROM_UNIXTIME($reg_date), 
          reg_location='$reg_location', reg_op='$reg_op', reg_no='$reg_no', 
          classtime=FROM_UNIXTIME($classtime) WHERE regid='$regid'")
          or die('Could not update because '.mysqli_error($link));

          print "成功更新IC为".$regic." 的学员报名信息。报名表号码为 ".$reg_no."。";
        }
      }
    }
    else
    {
      $row = mysqli_fetch_array($match);
      $name = $row['name'];
      $tel = $row['tel'];
      $tel_home = $row['tel_home'];
      $branch=$_POST['hiddenbranch'];
      $branchop=$_POST['hiddenbranchop'];
      if (empty($_POST['regid'])) 
      {
        $checkregno=mysqli_query($link, "SELECT * FROM reg_info 
          WHERE reg_no='$reg_no' AND (branch='$branch' OR '$branch'='changchun') 
          AND status!='delete'")
          or die ("Could not match data because ".mysqli_error($link)); 
        $numregno = mysqli_num_rows($checkregno);
        if($numregno<1)
        {
        //insert register information
          $insertreg = mysqli_query($link, "INSERT INTO reg_info (ic, reg_date, reg_location, reg_op,
          reg_no, classtime, branch, branchop) VALUES ('$regic', FROM_UNIXTIME($reg_date), 
          '$reg_location','$reg_op','$reg_no',FROM_UNIXTIME($classtime),'$branch','$branchop')")
          or die("Could not match data because ".mysqli_error($link));
          
          print "成功输入IC为".$regic." 的学员报名信息。报名表号码为 ".$reg_no."。";
          $checkregid=mysqli_query($link, "SELECT regid FROM reg_info 
            WHERE ic='$regic' AND reg_no='$reg_no' AND status!='delete'")
            or die("Could not match data because ".mysqli_error($link));
          $getregid=mysqli_fetch_array($checkregid);
          $_POST['regid']=$getregid['regid'];
        }
        else
        {
          $getreg = mysqli_fetch_array($checkregno);
          echo "该报名表号码已经存在，请速速联系管理员。";
          echo "对应id为".$getreg['regid']."属于".$getreg['branch'];
        }
      }
      else
      {
        // $getrefid = mysqli_query($link, "SELECT regid FROM reg_info WHERE reg_no='$reg_no'")
        // or die ("Could not match data because ".mysqli_error($link));
        // $getref = mysqli_fetch_array($getrefid);
        // $refid = $getref['regid'];
        $regid=mysqli_real_escape_string($link, trim($_POST['regid']));

        $checkregid=mysqli_query($link, "SELECT regid FROM reg_info WHERE regid='$regid' 
          AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
        or die ("Could not match data because ".mysqli_error($link)); 
        $numregid = mysqli_num_rows($checkregid);
        if($numregid<1)
        {
          print "没有报名id为".$regid." 的学员报名信息或者该信息属于别的分部。";
          return;
        }
        
        $updatereg = mysqli_query($link, "UPDATE reg_info SET ic='$regic', reg_date=FROM_UNIXTIME($reg_date), 
        reg_location='$reg_location', reg_op='$reg_op', reg_no='$reg_no', 
        classtime=FROM_UNIXTIME($classtime) WHERE regid='$regid'")
        or die("Could not match data because ".mysqli_error($link));

        print "成功更新IC为".$regic." 的学员报名信息。报名表号码为 ".$reg_no."。";
      }
      unset($_POST);
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