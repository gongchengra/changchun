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
        echo "<table>";
        echo "<tr><th>报名id</th><th>报名时间</th><th>报名地点</th><th>报名表号码
        </th><th>操作员</th></tr>";
        while ($row = mysql_fetch_array($checkreg)) {
        echo "<tr><td>$row[regid]</td><td>$row[reg_date]</td><td>$row[reg_location]
        </td><td>$row[reg_no]</td><td>$row[reg_op]</td></tr>";
        }
        echo "</table>";
        echo "</center>";
      }
      else
      {
        echo "没有IC为".$regic." 的学员报名信息。<br>";
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