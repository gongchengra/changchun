<?php
if(isset($_GET['receiptid'])&&$_GET['receiptid']!='')
{
  $_POST['receiptid']=$_GET["receiptid"];
  $_POST['searchreceiptic']=true;
}
if(isset($_POST['searchreceiptic']))
{
  $receiptid=(!empty($_POST['receiptid']))?trim($_POST['receiptid']):'';
  if(empty($receiptid))
  {
    echo "请输入收据id再点搜索。";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php#tabs-3'</script>";
    return;
  }
  include("includes/conn.php");
  include("includes/link.php");
  $receiptid=mysql_real_escape_string(trim($_POST['receiptid']));
  $checkreceipt = mysql_query("SELECT * FROM receipt_info WHERE receiptid='$receiptid' 
  AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numreceipt = mysql_num_rows($checkreceipt);
  if($numreceipt>0)
  {
    $getreceipt = mysql_fetch_array($checkreceipt);
    // $_SESSION['receiptid']=$receiptid;
    $_POST['receipt_type']=$getreceipt['receipt_type'];
    if($_POST['receipt_type']<10)
    {
      $_POST['receipt_no']=$getreceipt['receipt_no'];
      $_POST['receiptop']=$getreceipt['receiptop'];
      $_POST['receipt_date']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $_POST['amount']=$getreceipt['amount'];
      $_POST['receiptic']=$getreceipt['receiptic'];
      $_POST['receiptname']=$getreceipt['receiptname'];
      $_POST['receiptel']=$getreceipt['receiptel'];
      $_POST['secondornot']=$getreceipt['secondornot'];
      $_POST['course_type']=$getreceipt['course_type'];
      $_POST['lettertype']=$getreceipt['lettertype'];
      $_POST['coursecode']=$getreceipt['coursecode'];
      $_POST['relatedreceipt']=$getreceipt['relatedreceipt'];
      $_POST['relatedamount']=$getreceipt['relatedamount'];
      $_POST['remarks']=$getreceipt['remarks'];
      echo "";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?receiptid=".$receiptid."#tabs-3'</script>";
    }
    else if($_POST['receipt_type']==10)
    {
      $_POST['debitype']=10;
      $_POST['receipt_no']=$getreceipt['receipt_no'];
      $_POST['receiptop']=$getreceipt['receiptop'];
      $_POST['receiptop1']=$getreceipt['receiptop'];
      $_POST['receipt_date']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $_POST['receipt_date1']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $_POST['amount']=0-$getreceipt['amount'];
      $_POST['amount1']=0-$getreceipt['amount'];
      $_POST['receiptic']=$getreceipt['receiptic'];
      $_POST['receiptname']=$getreceipt['receiptname'];
      $_POST['receiptname1']=$getreceipt['receiptname'];
      $_POST['receiptel']=$getreceipt['receiptel'];
      $_POST['relatedreceipt']=$getreceipt['relatedreceipt'];
      $_POST['relatedamount']=$getreceipt['relatedamount'];
      $_POST['remarks']=$getreceipt['remarks'];
      $_POST['remarks1']=$getreceipt['remarks'];
      echo "";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?receiptid=".$receiptid."#tabs-3'</script>";
    }
    else
    {
      $_POST['debitype']=$getreceipt['receipt_type'];
      $_POST['receiptop1']=$getreceipt['receiptop'];
      $_POST['receipt_date1']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $_POST['amount1']=0-$getreceipt['amount'];
      $_POST['receiptname1']=$getreceipt['receiptname'];
      $_POST['remarks1']=$getreceipt['remarks'];
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php?receiptid=".$receiptid."#tabs-3'</script>";
    }
  }
  else
  {
    echo "没有找到Id为".$receiptid." 的学员收据信息，或者该信息属于其它分部。";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'student.php?receiptid=".$receiptid."#tabs-3'</script>";
    unset($_POST);
  }
}
if(isset($_POST['searchallreceipt']))
{
  $_POST['receiptic']=trim($_POST['receiptic']);
  $validator = new FormValidator();
  $validator->addValidation("receiptic","req","请输入学员ic");
  $validator->addValidation("receiptic","minlen=9","学员ic应该是9位");
  $validator->addValidation("receiptic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $receiptic=mysql_real_escape_string(trim($_POST['receiptic']));
    $icArray=str_split($receiptic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-3'</script>";
    }
    else
    {
      $checkreceipt = mysql_query("SELECT * FROM receipt_info WHERE receiptic='$receiptic' AND status!='delete'")
      or die ("Could not match data because ".mysql_error());
      $numreceipt = mysql_num_rows($checkreceipt);
      if ($numreceipt>0) 
      {
        echo "<center>";
        echo "<table>";
        echo "<tr><th>收据id</th><th>收据类型</th><th>收据号码</th><th>收费金额</th>
        <th>收据时间</th><th>分部</th><th>收款人</th><th>课程</th></tr>";
        while ($row = mysql_fetch_array($checkreceipt)) 
        {
          $convert = array('encmp' => '综合', 'encon' =>'会话',
           'eness'=>'ESS','encos' => 'COS','encom'=>'英文电脑','chcom'=>'华文电脑',
           'chpin'=>'拼音','enpho'=>'音标','engra'=>'语法',
           'chwri'=>'华文作文','others'=>'其他', ''=>'');
          $course_type=$convert[$row['course_type']];
          $type=($row['receipt_type']==1)?'Link1':'Changchun';
          echo "<tr><td><a href='student.php?receiptid=$row[receiptid]'>
          $row[receiptid]</a></td><td>$type</td><td>$row[receipt_no]
          </td><td>$row[amount]</td><td>$row[receipt_date]&nbsp</td>
          <td>$row[branch]&nbsp</td><td>$row[receiptop]&nbsp</td>
          <td>$course_type&nbsp</td></tr>";
          $tmpname=$row['receiptname'];
          $tmptel=$row['receiptel'];
        }
        echo "</table>";
        echo "</center>";
        echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-3'</script>";
        $_POST['receiptname']=$tmpname;
        $_POST['receiptel']=$tmptel;
        unset($_POST['receiptid']);
        unset($_POST['receipt_no']);
        unset($_POST['amount']);
        unset($_POST['receipt_date']);
      }
      else
      {
        echo "没有IC为".$receiptic." 的学员收据信息。<br>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php#tabs-3'</script>";
      }
      $match = mysql_query("SELECT ic, tel, tel_home, name FROM student_info WHERE ic='$receiptic'")
        or die ("Could not match data because ".mysql_error());
      $num_rows = mysql_num_rows($match);
      if ($num_rows>0) 
      {
        $row = mysql_fetch_array($match);
        $_POST['receiptname']=$row['name'];
        $_POST['receiptel']=$row['tel'];
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
    echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#tabs-3'</script>";
  }
}
if(isset($_POST['searchreceiptinfo2']))
{
  include("includes/conn.php");
  $link = mysql_connect($dbhost, $dbuser, $dbpass)
  or die ("Could not connect to mysql because ".mysql_error());
  // select the database
  mysql_select_db($dbname)
  or die ("Could not select database because ".mysql_error());
  //echo $_POST['findCMP'];
  //echo empty($_POST['findCMP']);
  //echo isset($_POST['findCON']);
  if(empty($_POST['receipt_no']))
  {
    echo "请输入收据号码";
  }
  else
  {
    $searchreceiptno=mysql_real_escape_string(trim($_POST['receipt_no']));
    $checkreceiptinfo=mysql_query("SELECT * FROM receipt_info 
      WHERE receipt_no='$searchreceiptno' AND status!='delete'")
    or die ("Could not match data because ".mysql_error());
    $numreceipt=mysql_num_rows($checkreceiptinfo);
    if($numreceipt>0)
    {
      $getreceipt = mysql_fetch_array($checkreceiptinfo);
      // $_SESSION['receiptid']=$receiptid;
      $_POST['receipt_type']=$getreceipt['receipt_type'];
      $_POST['receiptid']=$getreceipt['receiptid'];
      $receiptid=$getreceipt['receiptid'];
      $_POST['receiptop']=$getreceipt['receiptop'];
      $_POST['receipt_date']=date('Y-m-d',strtotime($getreceipt['receipt_date']));
      $_POST['amount']=$getreceipt['amount'];
      $_POST['receiptic']=$getreceipt['receiptic'];
      $_POST['receiptname']=$getreceipt['receiptname'];
      $_POST['receiptel']=$getreceipt['receiptel'];
      $_POST['secondornot']=$getreceipt['secondornot'];
      $_POST['course_type']=$getreceipt['course_type'];
      $_POST['lettertype']=$getreceipt['lettertype'];
      $_POST['coursecode']=$getreceipt['coursecode'];
      $_POST['relatedreceipt']=$getreceipt['relatedreceipt'];
      $_POST['relatedamount']=$getreceipt['relatedamount'];
      $_POST['remarks']=$getreceipt['remarks'];
      // echo "<script LANGUAGE='javascript'>document.location.href=
      // 'student.php?receiptid=".$receiptid."#tabs-3'</script>";
    }
    else
    {
      echo "没找到收据号为".$searchreceiptno."的收据信息。";
      unset($_POST);
    }
  }
  echo "<script LANGUAGE='javascript'>document.location.href=
  'student.php#tabs-3'</script>";
}
?>