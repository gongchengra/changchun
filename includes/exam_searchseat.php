<?php
if(isset($_POST['searchatoic']))
{
  $atoid=(!empty($_POST['atoid']))?trim($_POST['atoid']):'';
  if(empty($atoid))
  {
      echo "请输入ato id。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'student.php#inputatohead'</script>";
      return;
  }
  include("includes/conn.php");
  include("includes/link.php");
  $atoid=mysql_real_escape_string($_POST['atoid']);
  $checkato = mysql_query("SELECT * FROM ato_info WHERE atoid='$atoid' 
    AND status!='delete' ")or die ("Could not match data because ".mysql_error());
  $numato = mysql_num_rows($checkato);
  if($numato>0)
  {
    $getato = mysql_fetch_array($checkato);
    $_POST['atoic']=$getato['ic'];
    $_POST['bookexamdate']=date('Y-m-d',strtotime($getato['examtime']));
    $_POST['examtime']=date('H',strtotime($getato['examtime']));
    $_POST['prepost']=$getato['prepost'];
    $_POST['examlocation']=$getato['location'];
    $_POST['EL']=$getato['EL'];
    $_POST['ER']=$getato['ER'];
    $_POST['EN']=$getato['EN'];
    $_POST['ES']=$getato['ES'];
    $_POST['EW']=$getato['EW'];
    echo "";
    echo "<script LANGUAGE='javascript'>document.location.href=
  'exam.php#inputatohead'</script>";
  }
  else
  {
    echo "没有找到Id为".$atoid." 的ato信息。";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'exam.php#inputatohead'</script>";
    unset($_POST);
  }
}
if(isset($_POST['searchallato']))
{
  $_POST['atoic']=trim($_POST['atoic']);
  require_once "formvalidator.php";
  $validator = new FormValidator();
  $validator->addValidation("atoic","req","请输入学员ic");
  $validator->addValidation("atoic","minlen=9","学员ic应该是9位");
  $validator->addValidation("atoic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    $link = mysql_connect($dbhost, $dbuser, $dbpass)
    or die ("Could not connect to mysql because ".mysql_error());
    // select the database
    mysql_select_db($dbname)
    or die ("Could not select database because ".mysql_error());
    $atoic=mysql_real_escape_string($_POST['atoic']);
    $icArray=str_split($atoic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'exam.php#inputatohead'</script>";
      unset($_POST);
    }
    else
    {
      $checkato = mysql_query("SELECT * FROM ato_info WHERE ic='$atoic' 
      ORDER BY examtime")
      or die ("Could not match data because ".mysql_error());
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
        echo "<script LANGUAGE='javascript'>document.location.href=
      'exam.php#inputatohead'</script>";
        unset($_POST['atoid']);
        unset($_POST['atodate']);
        unset($_POST['bookexamdate']);
        unset($_POST['examtime']);
        unset($_POST['prepost']);
        unset($_POST['examlocation']);
      }
      else
      {
        echo "没有IC为".$atoic." 的学员ato信息。<br>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'exam.php#inputatohead'</script>";
        unset($_POST['atoid']);
        unset($_POST['atodate']);
        unset($_POST['bookexamdate']);
        unset($_POST['examtime']);
        unset($_POST['prepost']);
        unset($_POST['examlocation']);
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
      'exam.php#inputatohead'</script>";
  }
}
?>