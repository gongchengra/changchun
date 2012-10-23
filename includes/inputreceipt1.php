<?PHP
//include the main validation script
require_once "../formvalidator.php";
include("conn.php");
include("link1.php");
if(empty($_POST['debitype']))
{
  echo "<script LANGUAGE='javascript'>alert('请选择支出类型。');</script>";
}
else
{
  if(empty($_POST['receiptop1'])||empty($_POST['amount1']))
  {
    echo "<script LANGUAGE='javascript'>alert('请输入支出人和支出金额。');</script>";
  }
  elseif (!is_numeric(trim($_POST['amount1']))) 
  {
    echo "<script LANGUAGE='javascript'>alert('支出金额应该是数字');</script>";
  }
  else
  {
    $receiptic='NA';
    $receiptname=(!empty($_POST['receiptname1']))?
    mysqli_real_escape_string($link, trim($_POST['receiptname1'])):'';
    $receiptel='NA';
    $receipt_no='NA';
    $receipt_type=$_POST['debitype'];;
    $receiptop=$_POST['receiptop1'];
    $receipt_date=strtotime($_POST['receipt_date1']);
    $amount=0-floatval(mysqli_real_escape_string($link, trim($_POST['amount1'])));
    $remarks=(!empty($_POST['remarks1']))?$_POST['remarks1']:'';
    $branch=$_POST['hiddenbranch'];
    $branchop=$_POST['hiddenbranchop'];
    if(empty($_POST['receiptid']))
    {
      $insertreceipt=mysqli_query($link, "INSERT INTO receipt_info (receipt_type, 
      receipt_no, receipt_date, amount, receiptic, receiptname, receiptel,
      remarks, receiptop, branch, branchop) VALUES ('$receipt_type','$receipt_no', 
      FROM_UNIXTIME($receipt_date), '$amount', '$receiptic', '$receiptname', 
      '$receiptel', '$remarks','$receiptop', '$branch','$branchop')")
      or die('Error: ' . mysqli_error());
      echo "<script LANGUAGE='javascript'>alert('成功输入支出信息');</script>";
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
        receiptel='$receiptel', receiptop='$receiptop',remarks='$remarks' 
        WHERE receiptid='$receiptid'")
      or die("Could not match data because ".mysqli_error());

      echo "<script LANGUAGE='javascript'>alert('成功更新支出信息。');</script>";
    }
  }
}
?>