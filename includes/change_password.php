<?PHP
//include the main validation script
require_once "formvalidator.php";
if(isset($_POST['update']))
{// The form is submitted
  //Setup Validations
  $validator = new FormValidator();
  $validator->addValidation("username","req","请输入帐号");
  $validator->addValidation("password1","req","请输入密码");
  $validator->addValidation("password1","alnum","密码必须包含字母");
  $validator->addValidation("password1","minlen=8","密码至少要8位数学或字母");
  $validator->addValidation("password2","req","请输入密码");
  $validator->addValidation("password2","alnum","密码必须包含字母");
  $validator->addValidation("password2","minlen=8","密码至少要8位数学或字母");
  //Now, validate the form
  if($validator->ValidateForm())
  {
    //Validation success. 
    //Here we can proceed with processing the form 
    //(like sending email, saving to Database etc)
    // In this example, we just display a message
    echo "<h2>输入有效</h2>";
    //$show_form=false;
    include("includes/conn.php"); 
    // connect to the mysql server
    include("includes/link.php");
    $userid=$_POST['userid'];
    $username=mysql_real_escape_string(trim($_POST['username']));
    $password1=mysql_real_escape_string(trim($_POST['password1']));
    $password2=mysql_real_escape_string(trim($_POST['password2']));
    if($password1!=$password2)
    {
      echo "两次输入的密码不一致";
      return;
    }
    else
    {
      $crypt_password =crypt($password1,md5($username));
      $sql=mysql_query("UPDATE admin_user SET username='$username', 
        password='$crypt_password', updated_at=now() WHERE id='$userid'")
        or die ("Could not match data because ".mysql_error());
      echo "成功更新用户".$_POST['username']."的密码";
    }
    mysql_close($link);
  }
  else
  {
    echo "<B>输入错误:</B>";

    $error_hash = $validator->GetErrors();
    foreach($error_hash as $inpname => $inp_err)
    {
        echo "<p>$inpname : $inp_err</p>\n";
    }

  }//else
}//if(isset($_POST['Submit']))
?>