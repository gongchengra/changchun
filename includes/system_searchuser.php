<?php
if(isset($_POST['searchuserid']))
{
  $userid=(isset($_POST['userid']))?trim($_POST['userid']):'';
  if(empty($userid))
  {
    echo "请输入id再点搜索。";
    return;
  }
  include("includes/conn.php"); 
  // connect to the mysql server
  include("includes/link.php");
  $userid=mysql_real_escape_string($userid);
  $getid=mysql_query("SELECT * FROM admin_user WHERE id='$userid' AND status!='D'")
  or die ("Could not match data because ".mysql_error());
  $numid=mysql_num_rows($getid);
  if($numid<1)
  {
    // echo "<meta http-equiv='refresh' content='0;URL=system.php'>";
    echo "<script LANGUAGE='javascript'>document.location.href=
    'system.php#adduser'</script>";
    echo "你的id输入有误，没有id为".$userid." 的用户";
  }
  else
  {
    $row=mysql_fetch_array($getid);
    $_POST['username']=$row['username'];
    $_POST['email']=$row['email'];
    $_POST['roleid']=$row['roleid'];
    $_POST['branch']=$row['branch'];
    echo "<script LANGUAGE='javascript'>document.location.href=
        'system.php#adduser'</script>";
  }  
}
?>