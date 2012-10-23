<?PHP
//include the main validation script
require_once "../formvalidator.php";
include("conn.php");
include("link1.php");
$receiptic=mysqli_real_escape_string($link, trim($_POST['receiptic']));
if(strlen($receiptic)!=9)
{
  echo "<script LANGUAGE='javascript'>alert('学员ic应该是9位。');</script>";
}
else
{
  $icArray=str_split($receiptic);
  include("ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    echo "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
  }
  else
  {
    if(empty($_POST['receiptname'])||empty($_POST['receiptel'])||empty($_POST['receipt_no']))
    {
      echo "<script LANGUAGE='javascript'>alert('请输入学员姓名电话和退款收据号码。');</script>";
    }
    elseif (empty($_POST['receiptop1'])||empty($_POST['amount1'])) 
    {
      echo "<script LANGUAGE='javascript'>alert('请输入支出人和支出金额');</script>";
    }
    elseif (!is_numeric(trim($_POST['amount1']))) 
    {
      echo "<script LANGUAGE='javascript'>alert('支出金额应该是数字');</script>";
    }
    else
    {
      $receiptname=mysqli_real_escape_string($link, trim($_POST['receiptname']));
      $receiptel=mysqli_real_escape_string($link, trim($_POST['receiptel']));
      $receipt_no=mysqli_real_escape_string($link, trim($_POST['receipt_no']));
      $receipt_type='10';
      $receiptop=$_POST['receiptop1'];
      $receipt_date=strtotime($_POST['receipt_date1']);
      $amount=0-floatval(mysqli_real_escape_string($link, trim($_POST['amount1'])));
      $relatedreceipt=(!empty($_POST['relatedreceipt']))?$_POST['relatedreceipt']:'';
      $relatedamount=(!empty($_POST['relatedamount']))?$_POST['relatedamount']:'';
      $remarks=(!empty($_POST['remarks1']))?$_POST['remarks1']:'';
      $branch=$_POST['hiddenbranch'];
      $branchop=$_POST['hiddenbranchop'];
      if(empty($_POST['receiptid']))
      {
        $insertreceipt=mysqli_query($link, "INSERT INTO receipt_info (receipt_type, 
        receipt_no, receipt_date, amount, receiptic, receiptname, receiptel,
        relatedreceipt, relatedamount, remarks, receiptop, branch, branchop) 
        VALUES ('$receipt_type','$receipt_no', 
        FROM_UNIXTIME($receipt_date), '$amount', '$receiptic', '$receiptname', 
        '$receiptel', '$relatedreceipt','$relatedamount','$remarks','$receiptop', 
        '$branch','$branchop')")or die('Error: ' . mysqli_error());
        echo "<script LANGUAGE='javascript'>alert('成功输入退款信息');</script>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php#tabs-3'</script>";
        unset($_POST);
      }
      else
      {
        $receiptid=mysqli_real_escape_string($link, trim($_POST['receiptid']));

        $checkreceiptid=mysqli_query($link, "SELECT receiptid FROM receipt_info 
          WHERE receiptid='$receiptid' AND (branch='$branch' OR '$branch'='changchun') 
          AND status!='delete'")
          or die ("Could not match data because ".mysqli_error()); 
        $numreceiptid = mysqli_num_rows($checkreceiptid);
        if($numreceiptid<1)
        {
          echo "<script LANGUAGE='javascript'>alert('没有收据id为".$receiptid." 的退款信息，或者该信息属于其它分部。');</script>";
          return;
        }

        $updatereceipt = mysqli_query($link, "UPDATE receipt_info 
          SET receipt_type='$receipt_type', receipt_no='$receipt_no', 
          receipt_date=FROM_UNIXTIME($receipt_date), amount='$amount', 
          receiptic='$receiptic', receiptname='$receiptname', 
          receiptel='$receiptel', receiptop='$receiptop',  
          relatedreceipt='$relatedreceipt', relatedamount='$relatedamount', 
          remarks='$remarks' WHERE receiptid='$receiptid'")
        or die("Could not match data because ".mysqli_error());

        echo "<script LANGUAGE='javascript'>alert('成功更新IC为".$receiptic." 的学员退款信息。');</script>";
      }
    }
  }
}
?>