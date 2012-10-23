<?php
  $username=$_SESSION['username'];
  $branch=$_SESSION['branch'];
  include("includes/conn.php"); 
  // connect to the mysql server
  include("includes/link.php");
  $getid=mysql_query("SELECT * FROM admin_user WHERE username='$username'
   AND branch='$branch' AND status!='D'")
  or die ("Could not match data because ".mysql_error());
  $numid=mysql_num_rows($getid);
  if($numid<1)
  {
    // echo "<meta http-equiv='refresh' content='0;URL=system.php'>";
    echo "你的id输入有误，没有id为".$userid." 的用户";
  }
  else
  {
    $row=mysql_fetch_array($getid);
    $_POST['userid']=$row['id'];
    $_POST['username']=$row['username'];
    $_POST['email']=$row['email'];
    $_POST['branch']=$row['branch'];
  }  
?>