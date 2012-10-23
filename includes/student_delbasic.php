<?php
if(isset($_POST['delbasic']))
{
  $_POST['del_basic']=trim($_POST['del_basic']);
  $validator = new FormValidator();
  $validator->addValidation("del_basic","req","请输入学员ic");
  $validator->addValidation("del_basic","minlen=9","学员ic应该是9位");
  $validator->addValidation("del_basic","maxlen=9","学员ic应该是9位");
  if($validator->ValidateForm())
  {
    include("includes/conn.php");
    include("includes/link.php");
    $del_basic=mysql_real_escape_string(trim($_POST['del_basic']));
    $icArray=str_split($del_basic);
    include("includes/ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      echo "你的学员IC输错了吧，格式不对呀。";
      unset($_POST);
      echo "<script LANGUAGE='javascript'>document.location.href=
          'student.php#tabs-3'</script>";
    }
    else
    {
      $checkbasic = mysql_query("SELECT * FROM student_info WHERE ic='$del_basic' AND status!='delete'")
      or die ("Could not match data because ".mysql_error());
      $numbasic = mysql_num_rows($checkbasic);
      if($numbasic>0)
      {
        $delbasic = mysql_query("UPDATE student_info SET status='delete' WHERE ic='$del_basic'")or die ("Could not match data because ".mysql_error());
      }
      else
      {
        echo "没有IC为".$del_basic." 的学员信息。";
        unset($_POST);
        echo "<script LANGUAGE='javascript'>document.location.href=
        'student.php#tabs-3'</script>";
      }
    }
  }else
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
?>
