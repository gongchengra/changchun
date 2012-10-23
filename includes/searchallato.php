<?php
  $_POST['atoic']=trim($_POST['atoic']);
  require_once "../formvalidator.php";
  $validator = new FormValidator();
  $validator->addValidation("atoic","req","请输入学员ic");
  $validator->addValidation("atoic","minlen=9","学员ic应该是9位");
  $validator->addValidation("atoic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $atoic=mysql_real_escape_string($_POST['atoic']);
    $icArray=str_split($atoic);
    include("ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
    }
    else
    {
      $checkato = mysql_query("SELECT * FROM ato_info WHERE ic='$atoic' 
      ORDER BY examtime")or die ("Could not match data because ".mysql_error());
      $numato = mysql_num_rows($checkato);
      if ($numato>0) 
      {
        echo "<center>";
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
        echo "<tr><td>$row[atoid]</td><td>$row[prepost]</td>
        <td>$row[examtime]</td><td>$row[location]</td><td>$type</td><td>$delete</td></tr>";
        }
        echo "</table>";
        echo "</center>";
        unset($_POST['atoid']);
        unset($_POST['start_date']);
        unset($_POST['end_date']);
        unset($_POST['coursecode']);
        unset($_POST['attendance']);
        unset($_POST['recommend']);
        unset($_POST['location']);
        unset($_POST['atodate']);
      }
      else
      {
        echo "没有IC为".$atoic." 的学员ato信息。<br>";
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