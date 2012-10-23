<?php
  $receiptid=(!empty($_POST['receiptid']))?trim($_POST['receiptid']):'';
  $arr = array();
  if(empty($receiptid))
  {
    $arr['err']="请输入收据id再点搜索。";
    // print "请输入收据id再点搜索。";
    print json_encode($arr);
    return;
  }
  include("conn.php");
  include("link.php");
  $receiptid=mysql_real_escape_string(trim($_POST['receiptid']));
  $checkreceipt = mysql_query("SELECT * FROM receipt_info 
    WHERE receiptid='$receiptid' AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numreceipt = mysql_num_rows($checkreceipt);
  if($numreceipt>0)
  {
    $getreceipt = mysql_fetch_array($checkreceipt);
    // $_SESSION['receiptid']=$receiptid;
    $arr['receipt_type']=$getreceipt['receipt_type'];
    // print $getreceipt['receipt_type'];
    if($arr['receipt_type']<10)
    {
      $arr['receipt_no']=$getreceipt['receipt_no'];
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
    }
    else if($arr['receipt_type']==10)
    {
      $arr['debitype']=10;
      $arr['receipt_no']=$getreceipt['receipt_no'];
      $arr['receiptop']=$getreceipt['receiptop'];
      $arr['receiptop1']=$getreceipt['receiptop'];
      $arr['receipt_date']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $arr['receipt_date1']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $arr['amount']=0-$getreceipt['amount'];
      $arr['amount1']=0-$getreceipt['amount'];
      $arr['receiptic']=$getreceipt['receiptic'];
      $arr['receiptname']=$getreceipt['receiptname'];
      $arr['receiptname1']=$getreceipt['receiptname'];
      $arr['receiptel']=$getreceipt['receiptel'];
      $arr['relatedreceipt']=$getreceipt['relatedreceipt'];
      $arr['relatedamount']=$getreceipt['relatedamount'];
      $arr['remarks']=$getreceipt['remarks'];
      $arr['remarks1']=$getreceipt['remarks'];
    }
    else
    {
      $arr['debitype']=$getreceipt['receipt_type'];
      $arr['receiptop1']=$getreceipt['receiptop'];
      $arr['receipt_date1']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $arr['amount1']=0-$getreceipt['amount'];
      $arr['receiptname1']=$getreceipt['receiptname'];
      $arr['remarks1']=$getreceipt['remarks'];
    }
  }
  else
  {
    $arr['err']="没有找到Id为".$receiptid." 的学员收据信息，或者该信息属于其它分部。";
    // print "没有找到Id为".$receiptid." 的学员收据信息，或者该信息属于其它分部。";
  }
  print json_encode($arr);
?>