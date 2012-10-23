<?php
  $_POST['regic']=trim($_POST['regic']);
  require_once "../formvalidator.php";
  $validator = new FormValidator();
  $validator->addValidation("regic","req","请输入学员ic");
  $validator->addValidation("regic","minlen=9","学员ic应该是9位");
  $validator->addValidation("regic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $regic=mysql_real_escape_string($_POST['regic']);
    $icArray=str_split($regic);
    include("ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
    }
    else
    {
      $checkreg = mysql_query("SELECT * FROM reg_info WHERE ic='$regic' 
        AND status!='delete' ORDER BY reg_no")
      or die ("Could not match data because ".mysql_error());
      $numreg = mysql_num_rows($checkreg);
      if ($numreg>0) 
      {
        echo "<center>";
        echo "<table class=\"regtable\">";
        echo "<tr><th>报名id</th><th>学员IC</th><th>报名时间</th><th>报名地点</th><th>报名表号码
                </th><th>分部</th></tr>";
        while ($getreginfo = mysql_fetch_array($checkreg)) 
        {
          echo "<tr><td><a href='student.php?regid=$getreginfo[regid]' target='_blank'>$getreginfo[regid]</a>&nbsp</td><td>
          <a href='includes/getall.php?id=$getreginfo[ic]' target='_blank'>$getreginfo[ic]</a>&nbsp</td><td>$getreginfo[reg_date]&nbsp</td>
          <td>$getreginfo[reg_location]&nbsp</td><td>$getreginfo[reg_no]</td><td>$getreginfo[branch]&nbsp</td></tr>";
        }
        echo "</table>";
        echo "</center>";
      }
      else
      {
        echo "没有IC为".$regic." 的学员报名信息。<br>";
      }
      $checkreceipt = mysql_query("SELECT * FROM receipt_info 
        WHERE receiptic='$regic' AND status!='delete'")
      or die ("Could not match data because ".mysql_error());
      $numreceipt = mysql_num_rows($checkreceipt);
      if ($numreceipt>0) 
      {
        echo "<center>";
        echo "<table>";
        echo "<tr><th width='10%'>收据id</th><th width='10%'>学员IC</th>
        <th width='15%'>学员姓名</th><th width='10%'>收据类型</th>
        <th width='10%'>收费金额</th><th width='10%'>收据号码</th>
        <th width='15%'>日期</th><th width='10%'>收款人</th></tr>";
        while ($getreceiptinfo = mysql_fetch_array($checkreceipt)) 
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
          echo "<tr><td><a href='student.php?receiptid=$getreceiptinfo[receiptid]' target='_blank'>
          $getreceiptinfo[receiptid]</a>&nbsp</td><td>$getreceiptinfo[receiptic]&nbsp</td>
          <td>$getreceiptinfo[receiptname]&nbsp</td><td>$receiptype&nbsp</td>
          <td>$getreceiptinfo[amount]&nbsp</td><td>$getreceiptinfo[receipt_no]</td>
          <td>$getreceiptinfo[receipt_date]&nbsp</td><td>$getreceiptinfo[receiptop]&nbsp</td></tr>";
        }
        echo "</table>";
        echo "</center>";
      }
      else
      {
        echo "没有IC为".$regic." 的学员收据信息。<br>";
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
  }
?>