<div id="showreceipt">
<?php
if(!isset($_POST['searchreceiptinfo1']))
{
  include("includes/conn.php");
  include("includes/link.php");
  $branch=$_SESSION['branch'];
  echo "<div style='text-align: center'><h1>本月收费信息</h1></div>";
  $receipt_startdate=mktime(0, 0, 0, date("m"),1, date("Y"));
  $receipt_enddate=mktime(0, 0, 0, date("m"), date("d")+1, date("Y"));
  $checkreceiptinfo=mysql_query("SELECT * FROM receipt_info where UNIX_TIMESTAMP(receipt_date)>='$receipt_startdate' 
    AND UNIX_TIMESTAMP(receipt_date)<='$receipt_enddate' AND receipt_type<'10' AND
    (branch='$branch' OR '$branch'='changchun') AND status!='delete' 
    ORDER BY branch, receipt_type, receipt_date DESC, receiptid DESC")
  or die ("Could not match data because ".mysql_error());
  $numreceipt=mysql_num_rows($checkreceiptinfo);
  $totalin=0;
  $totalout=0;
  if($numreceipt>0)
  {
    // print "<div STYLE=' height: 1000px; width: 100%; font-size: 15px; overflow: auto;'>";
    print "<table class=\"scrollContent\">";
    print "<tr><th style='width:10%'>收据id</th><th style='width:10%'>学员IC</th>
    <th style='width:15%'>学员姓名</th><th style='width:10%'>收据类型</th>
    <th style='width:10%'>收费金额</th><th style='width:10%'>收据号码</th>
    <th style='width:15%'>日期</th><th style='width:10%'>收款人</th></tr>";
    while ($getreceiptinfo = mysql_fetch_array($checkreceiptinfo)) 
    {
      $totalin=$totalin+$getreceiptinfo['amount'];
      $receiptype=($getreceiptinfo['receipt_type']==1)?'Link1':'Changchun';
      print "<tr><td><a href='student.php?receiptid=$getreceiptinfo[receiptid]'>
      $getreceiptinfo[receiptid]</a>&nbsp</td><td>
      <a href='includes/getall.php?id=$getreceiptinfo[receiptic]' target='_blank'>$getreceiptinfo[receiptic]</a>&nbsp</td>
      <td>$getreceiptinfo[receiptname]&nbsp</td><td>$receiptype&nbsp</td>
      <td>$getreceiptinfo[amount]&nbsp</td><td>$getreceiptinfo[receipt_no]&nbsp</td>
      <td>$getreceiptinfo[receipt_date]&nbsp</td><td>$getreceiptinfo[receiptop]&nbsp</td></tr>";
    }
    print "</table>";
    // print "</div>";
    print "本月合计收入".$totalin."元。";
  }
  
  echo "<div style='text-align:center'><h1>本月支出信息</h1></div>";
  $checkreceiptinfo=mysql_query("SELECT * FROM receipt_info where UNIX_TIMESTAMP(receipt_date)>='$receipt_startdate' 
    AND UNIX_TIMESTAMP(receipt_date)<='$receipt_enddate' AND receipt_type>'9' AND
    (branch='$branch' OR '$branch'='changchun') AND status!='delete' ORDER BY branch, receipt_type, receipt_date")
  or die ("Could not match data because ".mysql_error());
  $numreceipt=mysql_num_rows($checkreceiptinfo);
  if($numreceipt>0)
  {
    // print "<div STYLE=' height: 1000px; width: 100%; font-size: 15px; overflow: auto;'>";
    $convert1 = array('10' => '退款', '11' =>'工资', '12'=>'交通费',
    '13'=>'提成', '14'=>'加班费','15'=>'其他补贴','16'=>'办公支出',
    '17'=>'校长临时支出','18'=>'其他');
    print "<table class=\"scrollContent\">";
    print "<tr><th style='width:10%'>支出id</th><th style='width:10%'>支出类型</th>
    <th style='width:10%'>支出金额</th><th style='width:10%'>支出人</th><th style='width:10%'>签收人</th>
    <th style='width:15%'>支出日期</th><th style='width:20%'>备注</th></tr>";
    while ($getreceiptinfo = mysql_fetch_array($checkreceiptinfo)) 
    {
      $totalout=$totalout+$getreceiptinfo['amount'];
      $receiptype= $getreceiptinfo['receipt_type'];
      $convertype= $convert1[$receiptype];
      print "<tr><td><a href='student.php?receiptid=$getreceiptinfo[receiptid]'>
      $getreceiptinfo[receiptid]</a>&nbsp</td><td>$convertype&nbsp</td>
      <td>$getreceiptinfo[amount]&nbsp</td><td>$getreceiptinfo[receiptop]&nbsp</td>
      <td>$getreceiptinfo[receiptname]&nbsp</td><td>$getreceiptinfo[receipt_date]&nbsp</td>
      <td>$getreceiptinfo[remarks]&nbsp</td></tr>";
    }
    print "</table>";
    // print "</div>";
    print "本月合计支出".$totalout."元。<br />";
  }
}
?>
</div>