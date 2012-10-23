<?PHP
//include the main validation script
require_once "../formvalidator.php";
$_POST['receiptic']=trim($_POST['receiptic']);
$_POST['amount']=trim($_POST['amount']);
$_POST['receiptel']=trim($_POST['receiptel']);
$validator = new FormValidator();
$validator->addValidation("receiptic","req","请输入学员ic");
$validator->addValidation("receiptic","minlen=9","学员ic应该是9位");
$validator->addValidation("receiptic","maxlen=9","学员ic应该是9位");
$validator->addValidation("receiptname","req","请输入学员姓名");
$validator->addValidation("receiptel","req","请输入学员电话");
$validator->addValidation("receiptel","num","学员电话应该是数字");
$validator->addValidation("receiptel","minlen=8","学员电话应该是8位数字");
$validator->addValidation("receiptel","maxlen=8","学员电话应该是8位数字");
$validator->addValidation("receipt_type","dontselect=0","请选择收据类型");
$validator->addValidation("receiptop","dontselect=0","请选择收款人");
$validator->addValidation("secondornot","dontselect=0","请选择是否补交学费");
$validator->addValidation("newstudent","dontselect=0","请选择是否老学员");
$validator->addValidation("receipt_no","req","请输入收据号码");
$validator->addValidation("receipt_date","req","请输入收据日期");
$validator->addValidation("amount","req","请输入收费金额");
//Now, validate the form
if($validator->ValidateForm())
{
  if(!is_numeric($_POST['amount']))
  {
    echo "<script LANGUAGE='javascript'>alert('收费金额应该是数字。');</script>";
    return;
  }
  include("conn.php");
  include("link1.php");
  $receiptic=mysqli_real_escape_string($link, trim($_POST['receiptic']));
  $icArray=str_split($receiptic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    echo "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
  }
  else
  {
    $receiptname=mysqli_real_escape_string($link, trim($_POST['receiptname']));
    $receiptel=mysqli_real_escape_string($link, trim($_POST['receiptel']));
    $receipt_type=$_POST['receipt_type'];
    $receiptop=$_POST['receiptop'];
    $receiptop=mysqli_real_escape_string($link, trim($_POST['receiptop']));
    $receiptop=str_replace(' ', '', $receiptop);
    $receiptop=strtolower($receiptop);
    $receipt_no=mysqli_real_escape_string($link, trim($_POST['receipt_no']));
    if(($receipt_type=='2')&&(strlen($receipt_no)!=7))
    {
      if(strlen($receipt_no)==6)
      {
        $receipt_no='B'.$receipt_no;
      }
      if(strlen($receipt_no)==5)
      {
        $receipt_no='B0'.$receipt_no;
      }
      if(strlen($receipt_no)==4)
      {
        $receipt_no='B00'.$receipt_no;
      }
    }
    $receipt_date=strtotime($_POST['receipt_date']);
    $amount=floatval(mysqli_real_escape_string($link, trim($_POST['amount'])));
    $secondornot=(!empty($_POST['secondornot']))?$_POST['secondornot']:'';
    $newstudent=(!empty($_POST['newstudent']))?$_POST['newstudent']:'';
    $course_type=(!empty($_POST['course_type']))?$_POST['course_type']:'';
    $lettertype=(!empty($_POST['lettertype']))?$_POST['lettertype']:'';
    $coursecode=(!empty($_POST['coursecode']))?$_POST['coursecode']:'';
    $relatedreceipt=(!empty($_POST['relatedreceipt']))?$_POST['relatedreceipt']:'';
    $relatedamount=(!empty($_POST['relatedamount']))?$_POST['relatedamount']:'';
    $remarks=(!empty($_POST['remarks']))?$_POST['remarks']:'';
    if(($secondornot=='Y')&&((empty($_POST['course_type']))||(empty($_POST['lettertype']))))
    {
      echo "<script LANGUAGE='javascript'>alert('补交学费时请选择课程类型和政府信类型。');</script>";
      return;
    }
    $branch=$_POST['hiddenbranch'];
    $branchop=$_POST['hiddenbranchop'];
      // echo $_POST['hiddenbranch'];
    
    if(empty($_POST['receiptid']))
    {
      $checkreceiptno=mysqli_query($link, "SELECT * FROM receipt_info 
        WHERE receipt_no='$receipt_no' AND receipt_type='$receipt_type' 
        AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
        or die ("Could not match data because ".mysqli_error($link)); 
      $numreceiptno = mysqli_num_rows($checkreceiptno);
      if($numreceiptno<1)
      {
        $insertreceipt=mysqli_query($link, "INSERT INTO receipt_info (receipt_type, 
        receipt_no, receipt_date, amount, receiptic, receiptname, receiptel,
        secondornot, newstudent, course_type, lettertype, coursecode, relatedreceipt, relatedamount, 
        remarks, receiptop, branch, branchop) VALUES ('$receipt_type','$receipt_no', 
        FROM_UNIXTIME($receipt_date), '$amount', '$receiptic', '$receiptname', 
        '$receiptel', '$secondornot', '$newstudent', '$course_type', '$lettertype', '$coursecode', 
        '$relatedreceipt','$relatedamount','$remarks','$receiptop', '$branch','$branchop')")
        or die('Error: ' . mysqli_error($link));
        // echo "成功输入IC为".$receiptic." 的学员收据信息。收据号码为 ".$receipt_no."。";
        echo "<script LANGUAGE='javascript'>alert('成功输入IC为".$receiptic." 的学员收据信息。收据号码为 ".$receipt_no."。');</script>";
      }
      else
      {
        $getreceipt = mysqli_fetch_array($checkreceiptno);
        echo "该收据号码已经存在，请速速联系管理员。";
        echo "对应id为".$getreceipt['receiptid']."属于".$getreceipt['branch'];
      }
    }
    else
    {
      $receiptid=mysqli_real_escape_string($link, trim($_POST['receiptid']));

      $checkreceiptid=mysqli_query($link, "SELECT receiptid FROM receipt_info 
        WHERE receiptid='$receiptid' AND (branch='$branch' OR '$branch'='changchun') 
        AND status!='delete'")
        or die ("Could not match data because ".mysqli_error($link)); 
      $numreceiptid = mysqli_num_rows($checkreceiptid);
      if($numreceiptid<1)
      {
        // echo "没有收据id为".$receiptid." 的学员收据信息，或者该信息属于其它分部。";
        echo "<script LANGUAGE='javascript'>alert('没有收据id为".$receiptid." 的学员收据信息，或者该信息属于其它分部。');</script>";
        return;
      }

      $updatereceipt = mysqli_query($link, "UPDATE receipt_info 
        SET receipt_type='$receipt_type', receipt_no='$receipt_no', 
        receipt_date=FROM_UNIXTIME($receipt_date), amount='$amount', 
        receiptic='$receiptic', receiptname='$receiptname', 
        receiptel='$receiptel', secondornot='$secondornot', newstudent='$newstudent', 
        course_type='$course_type', lettertype='$lettertype',
        receiptop='$receiptop', coursecode='$coursecode', 
        relatedreceipt='$relatedreceipt', relatedamount='$relatedamount', 
        remarks='$remarks' WHERE receiptid='$receiptid'")
      or die("Could not match data because ".mysqli_error($link));

      echo "<script LANGUAGE='javascript'>alert('成功更新IC为".$receiptic." 的学员收据信息。收据号码为 ".$receipt_no."。');</script>";
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
}//else
?>