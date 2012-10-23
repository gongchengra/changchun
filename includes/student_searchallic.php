<?php
if(isset($_POST['searchallic']))
  {
    $_POST['allic']=trim($_POST['allic']);
    $validator = new FormValidator();
    $validator->addValidation("allic","req","请输入学员ic");
    $validator->addValidation("allic","minlen=9","学员ic应该是9位");
    $validator->addValidation("allic","maxlen=9","学员ic应该是9位");
    if($validator->ValidateForm())
    {
      include("includes/conn.php");
      include("includes/link.php");
      $allic=mysql_real_escape_string(trim($_POST['allic']));
      $icArray=str_split($allic);
      include("includes/ic.php");
      if ($icArray[8]!=$theAlpha) 
      {
        echo "你的学员IC输错了吧，格式不对呀。";
        echo "<script LANGUAGE='javascript'>document.location.href=
            'student.php#tabs-5'</script>";
      }
      else
      {
        echo "<b><h2><a href='includes/getall.php?id=$allic' target='_blank'>学员基本信息</a></h2></b>";
        $checkic = mysql_query("SELECT * FROM student_info WHERE ic='$allic'")
        or die ("Could not match data because ".mysql_error());
        $numic = mysql_num_rows($checkic);
        if($numic>0)
        {
          $getic = mysql_fetch_array($checkic);
          echo "学员姓名：".$getic['name']." ";
          switch ($getic['citizenship']) 
          {
            case 'SG':
                echo "学员准证：".'新加坡公民<br>';
                break;
            case 'PR':
                echo "学员准证：".'新加坡PR<br>';
                break;
            case 'EP':
                echo "学员准证：".'Employment pass<br>';
                break;
            case 'WP':
                echo "学员准证：".'Work permit<br>';
                break;
            case 'SP':
                echo "学员准证：".'Student pass<br>';
                break;
            case 'XX':
                echo "学员准证：".'其他<br>';
                break;
          }
          echo "学员生日：".date('Y-m-d',strtotime($getic['dateofbirth']))." ";
          echo "学员电话：".$getic['tel']."<br>";
          echo "学员地址：".$getic['address']."<br>";
          $employstatus=($getic['employstatus']=='EMP001')?'没工作':'有工作';
          echo "就业情况：".$employstatus." ";
          switch ($getic['salaryrange']) 
          {
            case '00':
                echo "薪水范围：".'没工作<br>';
                break;
            case '01':
                echo "薪水范围：".'少于$1000<br>';
                break;
            case '02':
                echo "薪水范围：".'$1,000 - $1,499<br>';
                break;
            case '03':
                echo "薪水范围：".'$1,500 - $1,999<br>';
                break;
            case '04':
                echo "薪水范围：".'$2,000 - $2,499<br>';
                break;
            case '05':
                echo "薪水范围：".'$2,500 - $2,999<br>';
                break;
            case '06':
                echo "薪水范围：".'$3,000 - $3,499<br>';
                break; 
            case '07':
                echo "薪水范围：".'高于$3,500<br>';
                break;                         
          }
          echo "备注：".$getic['intro']."<br>";
        }
        else
        {
          echo "没有IC为".$allic." 的学员基本信息。<br>";
        }

        echo "<b><h2><a href='student.php?record=$allic'>学员成绩</a></h2></b>";
        $checkrecord = mysql_query("SELECT * FROM student_record WHERE ic='$allic'")
        or die ("Could not match data because ".mysql_error());
        $numrecord = mysql_num_rows($checkrecord);
        if($numrecord>0)
        {
          $getrecord = mysql_fetch_array($checkrecord);
          echo "听力成绩：".$getrecord['ELBest']." ";
          echo "阅读成绩：".$getrecord['ERBest']." ";
          echo "数学成绩：".$getrecord['ENBest']." ";
          echo "会话成绩：".$getrecord['ESBest']." ";
          echo "写作成绩：".$getrecord['EWBest']."<br>";
          echo "学员等级：<br>";
          echo "综合等级：".$getrecord['CMP']." ";
          echo "会话等级：".$getrecord['CON']." ";
          echo "写作等级：".$getrecord['WRI']." ";
          echo "数学等级：".$getrecord['WPN']." "."<br>";
        }
        else
        {
          echo "没有学员的成绩记录。<br>";
        }

        echo "<b><h2>学员报名信息</h2></b>";
        $checkreg = mysql_query("SELECT * FROM reg_info WHERE ic='$allic' AND status!='delete'")
        or die ("Could not match data because ".mysql_error());
        $numreg = mysql_num_rows($checkreg);
        if ($numreg>0) 
        {
          echo "<table>";
          echo "<tr><th>报名id</th><th>报名时间</th><th>报名地点</th><th>报名表号码
          </th><th>操作员</th></tr>";
          while ($row = mysql_fetch_array($checkreg)) {
          echo "<tr><td><a href='student.php?regid=$row[regid]'>$row[regid]</a>
          </td><td>$row[reg_date]</td><td>$row[reg_location]
          </td><td>$row[reg_no]</td><td>$row[reg_op]</td></tr>";
          }
          echo "</table>";
        }
        else
        {
          echo "没有IC为".$allic." 的学员报名信息。<br>";
        }

        echo "<b><h2>学员收费信息</h2></b>";
        $checkreceipt = mysql_query("SELECT * FROM receipt_info WHERE receiptic='$allic'")
        or die ("Could not match data because ".mysql_error());
        $numreceipt = mysql_num_rows($checkreceipt);
        if ($numreceipt>0) 
        {
          echo "<table>";
          echo "<tr><th>收据id</th><th>收据类型</th><th>收据号码</th><th>收费金额</th>
          <th>收据时间</th><th></th></tr>";
          while ($row = mysql_fetch_array($checkreceipt)) {
              $type=($row['receipt_type']==1)?'Link1':'Changchun';
              $delete=($row['status']=='delete')?'已删除':'';
          echo "<tr><td><a href='student.php?receiptid=$row[receiptid]'>$row[receiptid]</a>
          </td><td>$type</td><td>$row[receipt_no]
          </td><td>$row[amount]</td><td>$row[receipt_date]</td><td>$delete</td></tr>";
          }
          echo "</table>";
        }
        else
        {
          echo "没有IC为".$allic." 的学员收据信息。<br>";
        }

        echo "<b><h2>学员ato信息</h2></b>";
        $checkato = mysql_query("SELECT * FROM ato_info WHERE ic='$allic'")
        or die ("Could not match data because ".mysql_error());
        $numato = mysql_num_rows($checkato);
        if ($numato>0) 
        {
          echo "<table>";
          echo "<tr><th>atoid</th><th>考试类型</th><th>考试时间</th><th>考试地点</th>
          <th>考试科目</th><th></th></tr>";
          while ($row = mysql_fetch_array($checkato)) 
          {
          $type=(($row['EN']=='Y')?'N':'').(($row['ER']=='Y')?'R':'').
          (($row['EL']=='Y')?'L':'').(($row['ES']=='Y')?'S':'').
          (($row['EW']=='Y')?'W':'');
          $row['location']=($row['location']=='JE')?'Jurong East':'Eunos';
          $delete=($row['status']=='delete')?'已删除':'';
          echo "<tr><td><a href='student.php?atoid=$row[atoid]'>$row[atoid]</a></td><td>$row[prepost]</td>
          <td>$row[examtime]</td><td>$row[location]</td><td>$type</td><td>$delete</td></tr>";
          }
          echo "</table>";
        }
        else
        {
          echo "没有IC为".$allic." 的ato信息。<br>";
        }
            
        echo "<b><h2>学员参加班级信息</h2></b>";
        $checkclass = mysql_query("SELECT * FROM 
        (sub_class_info LEFT JOIN class_info ON sub_class_info.classid=class_info.classid) 
        WHERE ic='$allic'")
        or die ("Could not match data because ".mysql_error());
        $numclass = mysql_num_rows($checkclass);
        if ($numclass>0) 
        {
          print "<table class=\"classtable\">";
          print "<tr><th>class id</th><th>课程代码</th><th>类型</th>
                  <th>等级</th><th>开课日期</th><th>结课日期</th>
                  <th>课程老师</th><th>老师电话</th><th></th></tr>";
          $convert = array('CMP' => '综合', 'CON' =>'会话', 'WRI'=>'写作','WPN'=>'数学',
          'BEGINNERS'=>'初级','INTERMEDIATE'=>'中级','ADVANCED'=>'高级','preparing'=>'未开班',
          'learning'=>'已开班','waitexam'=>'待考试','finished'=>'已结束', '0'=>'NA',
          'encmp' => '综合','encon' => '会话','eness' => 'ESS','encos' => 'COS','encom' => '英文电脑',
          'chcom' => '华文电脑','chpin' => '拼音','enpho' => '音标','engra' => '语法',
          'chwri' => '华文作文','others' => '其他');
          while ($getclass = mysql_fetch_array($checkclass)) 
          {
            $delete=($getclass['status']=='delete')?'已删除':'';
            $getclass['classtype']=$convert[($getclass['classtype'])];
            $getclass['classlevel']=$convert[($getclass['classlevel'])];
            $getclass['finish']=$convert[($getclass['finish'])];
            $getclass['class_startdate']=($getclass['class_startdate']!='2038-01-01')?
            date('Y-m-d',strtotime($getclass['class_startdate'])):'';
            $getclass['class_endate']=($getclass['class_endate']!='2038-01-01')?
            date('Y-m-d',strtotime($getclass['class_endate'])):'';
            print "<tr><td><a href='class.php?classid=$getclass[classid]'>$getclass[classid]</a>&nbsp</td>
            <td>$getclass[coursecode]&nbsp</td><td>$getclass[classtype]&nbsp</td>
            <td>$getclass[classlevel]&nbsp</td><td>$getclass[class_startdate]&nbsp</td>
            <td>$getclass[class_endate]&nbsp</td><td>$getclass[teacher]&nbsp</td>
            <td>$getclass[teacher_tel]&nbsp</td><td>$delete</td></tr>";
          }
          echo "</table>";
        }
        else
        {
          echo "没有IC为".$allic." 的学员参加班级的信息。<br>";
        }

        echo "<script LANGUAGE='javascript'>document.location.href=
            'student.php#tabs-5'</script>";
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
  }
?>