<?php
  $_POST['receiptic']=trim($_POST['receiptic']);
  require_once "../formvalidator.php";
  $validator = new FormValidator();
  $validator->addValidation("receiptic","req","请输入学员ic");
  $validator->addValidation("receiptic","minlen=9","学员ic应该是9位");
  $validator->addValidation("receiptic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $receiptic=mysql_real_escape_string(trim($_POST['receiptic']));
    $icArray=str_split($receiptic);
    include("ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "<script LANGUAGE='javascript'>alert('你的学员IC输错了吧，格式不对呀。');</script>";
    }
    else
    {
      $convert1 = array('1' => 'Link1','2' => 'Changchun','3' => 'SSA',
      '10' => '退款', '11' =>'工资', '12'=>'交通费',
      '13'=>'提成', '14'=>'加班费','15'=>'其他补贴','16'=>'办公支出',
      '17'=>'校长临时支出','18'=>'其他');
      $checkreceipt = mysql_query("SELECT * FROM receipt_info WHERE receiptic='$receiptic' AND status!='delete'")
      or die ("Could not match data because ".mysql_error());
      $numreceipt = mysql_num_rows($checkreceipt);
      if ($numreceipt>0) 
      {
        echo "<center>";
        echo "<table>";
        echo "<tr><th>收据id</th><th>收据类型</th><th>收据号码</th><th>收费金额</th>
        <th>收据时间</th><th>分部</th><th>收款人</th><th>课程</th></tr>";
        $convert = array('encmp' => '综合', 'encon' =>'会话',
       'eness'=>'ESS','encos' => 'COS','encom'=>'英文电脑','chcom'=>'华文电脑',
       'chpin'=>'拼音','enpho'=>'音标','engra'=>'语法',
       'chwri'=>'华文作文','others'=>'其他', ''=>'');
        while ($row = mysql_fetch_array($checkreceipt)) 
        {
          $receiptype= $row['receipt_type'];
          $type= $convert1[$receiptype];
          $course_type=$convert[$row['course_type']];
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
        $_POST['receiptname']=$tmpname;
        $_POST['receiptel']=$tmptel;
      }
      else
      {
        print "没有IC为".$receiptic." 的学员收据信息。";
        // echo "<script LANGUAGE='javascript'>alert('
        //   没有IC为".$receiptic." 的学员收据信息。');</script>";
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
      // echo "<center>学员姓名：".$_POST['receiptname'];
      // echo "<br/>学员电话：".$_POST['receiptel']."</center>";
      // echo "<br/>学员ic：".$_POST['receiptic']."</center>";
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