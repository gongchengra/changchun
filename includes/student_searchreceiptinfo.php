<?php
if(isset($_POST['searchreceiptinfo1']))
{
  include("includes/conn.php");
  include("includes/link.php");
  //echo $_POST['findCMP'];
  //echo empty($_POST['findCMP']);
  //echo isset($_POST['findCON']);
  $convert1 = array('10' => '退款', '11' =>'工资', '12'=>'交通费',
    '13'=>'提成', '14'=>'加班费','15'=>'其他补贴','16'=>'办公支出',
    '17'=>'校长临时支出','18'=>'其他');
  $receipt_startdate=strtotime($_POST['receipt_startdate']);
  $receipt_enddate=strtotime($_POST['receipt_enddate']);
  $branch=$_SESSION['branch'];
  $checkreceiptinfo=mysql_query("SELECT * FROM receipt_info where UNIX_TIMESTAMP(receipt_date)>='$receipt_startdate' 
      AND UNIX_TIMESTAMP(receipt_date)<='$receipt_enddate' AND 
      (branch='$branch' OR '$branch'='changchun') AND status!='delete' 
      ORDER BY branch, receipt_type, receipt_date DESC, receiptid DESC")
  or die ("Could not match data because ".mysql_error());
  $numreceipt=mysql_num_rows($checkreceiptinfo);
  if($numreceipt>0)
  {
    // print "<div STYLE='height: 600px; width: 800px; font-size: 18px; overflow: auto; overflow-x: auto;'>";
    print "<table class=\"scrollContent\">";
    print "<tr><th width='10%'>收据id</th><th width='10%'>学员IC</th>
    <th width='15%'>学员姓名</th><th width='10%'>收据类型</th>
    <th width='10%'>收费金额</th><th width='10%'>收据号码</th>
    <th width='15%'>日期</th><th width='10%'>收款人</th></tr>";
    while ($getreceiptinfo = mysql_fetch_array($checkreceiptinfo)) 
    {
      $receiptype= $getreceiptinfo['receipt_type'];
      if($receiptype<10)
      {
        $receiptype=($getreceiptinfo['receipt_type']==1)?'Link1':'Changchun';
      }
      else
      {
        $receiptype= $convert1[$receiptype];
      }
      print "<tr><td><a href='student.php?receiptid=$getreceiptinfo[receiptid]'>
      $getreceiptinfo[receiptid]</a>&nbsp</td><td>$getreceiptinfo[receiptic]&nbsp</td>
      <td>$getreceiptinfo[receiptname]&nbsp</td><td>$receiptype&nbsp</td>
      <td>$getreceiptinfo[amount]&nbsp</td><td>$getreceiptinfo[receipt_no]&nbsp</td>
      <td>$getreceiptinfo[receipt_date]&nbsp</td><td>$getreceiptinfo[receiptop]&nbsp</td></tr>";
    }
    print "</table>";
    // print "</div>";
  }
  echo "<script LANGUAGE='javascript'>document.location.href=
  'student.php#tabs-3'</script>";
}
?>
