<?php
include("conn.php");
include("link.php");
$del_receipt=mysql_real_escape_string(trim($_POST['del_receipt']));
$checkreceipt = mysql_query("SELECT * FROM receipt_info WHERE receiptid='$del_receipt' AND status!='delete'")
or die ("Could not match data because ".mysql_error());
$numreceipt = mysql_num_rows($checkreceipt);
if($numreceipt>0)
{
  $delreceipt = mysql_query("UPDATE receipt_info SET status='delete' 
      WHERE receiptid='$del_receipt'")or die ("Could not match data because ".mysql_error());
  print "id为".$del_receipt." 的学员收据信息已删除";
}
else
{
  print "没有id为".$del_receipt." 的学员收据信息或者该信息属于其他分部。";
}
?>
