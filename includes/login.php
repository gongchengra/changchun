<?PHP
//include the main validation script
require_once "formvalidator.php";
// $show_form=true;
// ini_set('session.gc_maxlifetime', 3600*2);
// echo ini_get("session.gc_maxlifetime"); 
if(isset($_POST['login']))
{// The form is submitted
  //Setup Validations
  $validator = new FormValidator();
  $validator->addValidation("username","req","请输入帐号");
  $validator->addValidation("password","req","请输入密码");
  // $validator->addValidation("branch","dontselect=Please select","请选择分部");
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
    include("includes/link1.php");
    $username=mysqli_real_escape_string($link, $_POST['username']);
    $password=mysqli_real_escape_string($link, $_POST['password']);
    // $branch=mysql_real_escape_string($_POST['branch']);
    $crypt_password =crypt($password,md5($username));
    $qry = mysqli_query($link, "select username from admin_user 
      where username = '$username' and password = '$crypt_password' 
      and status='A'")
    or die ("Could not match data because ".mysqli_error());
    $num_rows = mysqli_num_rows($qry); 
    if ($num_rows <= 0) 
    { 
    echo "Sorry, there is no username $username with the specified password.
    ";
    echo "Try again";
    exit; 
    } else {
    $result = mysqli_query($link, "SELECT * FROM admin_user where username = '$username'")
    or die ("Could not match data because ".mysqli_error());
    $row = mysqli_fetch_array($result);
    $email=$row['email'];
    $role=$row['roleid'];
    $branch=$row['branch'];
    mysqli_close($link);
    // session_start();
    include("includes/sessions.php");
    error_reporting(0);
    @define("CORE",dirname(__FILE__)."/");  
    $_SESSION['username']=$username;
    $_SESSION['branch']=$branch;
    $_SESSION['email']=$email;
    $_SESSION['role']=$role;
    header('Location:student.php');
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

  }//else
}//if(isset($_POST['Submit']))
?>
