<?php
$receipt_no=(!empty($_POST['receipt_no']))?trim($_POST['receipt_no']):'';
$arr = array();
if(empty($receipt_no))
{
  $arr['err']="请输入收据号再点搜索。";
  // print "请输入收据id再点搜索。";
  print json_encode($arr);
  return;
}
include("conn.php");
include("link.php");
$searchreceiptno=mysql_real_escape_string(trim($_POST['receipt_no']));
$checkreceiptinfo=mysql_query("SELECT * FROM receipt_info 
  WHERE receipt_no='$searchreceiptno' AND status!='delete'")
or die ("Could not match data because ".mysql_error());
$numreceipt=mysql_num_rows($checkreceiptinfo);
if($numreceipt>0)
{
  $getreceipt = mysql_fetch_array($checkreceiptinfo);
  // $_SESSION['receiptid']=$receiptid;
  $arr['receipt_type']=$getreceipt['receipt_type'];
  $arr['receiptid']=$getreceipt['receiptid'];
  $receiptid=$getreceipt['receiptid'];
  $arr['receiptop']=$getreceipt['receiptop'];
  $arr['receipt_date']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
  $arr['amount']=$getreceipt['amount'];
  $arr['receiptic']=$getreceipt['receiptic'];
  $arr['receiptname']=$getreceipt['receiptname'];
  $arr['receiptel']=$getreceipt['receiptel'];
  $arr['secondornot']=$getreceipt['secondornot'];
  $arr['newstudent']=$getreceipt['newstudent'];
  $arr['course_type']=$getreceipt['course_type'];
  $arr['lettertype']=$getreceipt['lettertype'];
  $arr['coursecode']=$getreceipt['coursecode'];
  $arr['relatedreceipt']=$getreceipt['relatedreceipt'];
  $arr['relatedamount']=$getreceipt['relatedamount'];
  $arr['remarks']=$getreceipt['remarks'];
  // echo "<script LANGUAGE='javascript'>document.location.href=
  // 'student.php?receiptid=".$receiptid."#tabs-3'</script>";
}
else
{
  $arr['err']="没找到收据号为".$searchreceiptno."的收据信息。";
}
print json_encode($arr);
?>