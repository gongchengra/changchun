<?PHP
//include the main validation script
require_once "formvalidator.php";
if(isset($_POST['add-submit']))
{// The form is submitted
  //Setup Validations
  $validator = new FormValidator();
  $validator->addValidation("username","req","请输入帐号");
  $validator->addValidation("password","req","请输入密码");
  $validator->addValidation("password","alnum","密码必须包含字母");
  $validator->addValidation("password","minlen=8","密码至少要8位数学或字母");
  $validator->addValidation("email","email","邮箱格式不对");
  $validator->addValidation("email","req","请输入邮箱");
  $validator->addValidation("branch","dontselect=Please select","请选择分部");
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
    $userid=(!empty($_POST['userid']))?mysql_real_escape_string(trim($_POST['userid'])):'';
    $username=mysql_real_escape_string(trim($_POST['username']));
    $password=mysql_real_escape_string(trim($_POST['password']));
    $crypt_password =crypt($password,md5($username));
    $email=mysql_real_escape_string(trim($_POST['email']));
    $roleid=$_POST['roleid'];
    $branch=$_POST['branch'];
    if (empty($_POST['userid'])) 
    {
      $sql=
      "INSERT INTO admin_user (username, password, email, roleid, created_at, updated_at, branch)
      VALUES ('$username','$crypt_password','$email','$roleid',NOW(),NOW(),'$branch')";
      if (!mysql_query($sql,$link))
        {
        die('Error: ' . mysql_error());
        }
      echo "<script LANGUAGE='javascript'>document.location.href=
      'system.php#adduser'</script>";
      echo "成功添加用户".$_POST['username'];
    }
    else
    {
      $checkid=mysql_query("SELECT * FROM admin_user WHERE id='$userid'")
      or die ("Could not match data because ".mysql_error());
      $numid=mysql_num_rows($checkid);
      if($numid<1)
      {
        // echo "<meta http-equiv='refresh' content='0;URL=system.php'>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'system.php#adduser'</script>";
        echo "你的id输入有误，没有id为".$userid." 的用户";
      }
      else
      {
        $sql=mysql_query("UPDATE admin_user SET username='$username', 
        password='$crypt_password', email='$email', roleid='$roleid',
        updated_at=now(), branch='$branch', status='A' WHERE id='$userid'")
        or die ("Could not match data because ".mysql_error());

        echo "<script LANGUAGE='javascript'>document.location.href=
        'system.php#adduser'</script>";
        echo "成功更新用户".$_POST['username'];
        }
      }
    // echo "<meta http-equiv='refresh' content='0;URL=system.php'>";
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

    echo "<script LANGUAGE='javascript'>document.location.href=
            'system.php#adduser'</script>";

  }//else
}//if(isset($_POST['Submit']))
?>