<center><h1>删除用户</h1></center>
<?php
if(isset($_POST['del-submit']))
{// The form is submitted
  $link = mysql_connect($dbhost, $dbuser, $dbpass)
  or die ("Could not connect to mysql because ".mysql_error());
  // select the database
  mysql_select_db($dbname)
  or die ("Could not select database because ".mysql_error());
  $deluserid=mysql_real_escape_string(trim($_POST['deluserid']));
  $match = "select * from admin_user where id = '$deluserid' AND status!='D'";
  $qry = mysql_query($match) or die ("Could not match data because ".mysql_error());
  $num_rows = mysql_num_rows($qry);
  if ($num_rows<1) 
  {
    echo "<script LANGUAGE='javascript'>document.location.href=
            'system.php#adduser'</script>";
    echo "id为 ".$deluserid." 的用户不存在！";
  }
  else
  {
    $getusername=mysql_fetch_array($qry);
    $username=$getusername['username'];
    $sql=
    "UPDATE admin_user SET status='D' WHERE id='$deluserid'";

    if (!mysql_query($sql,$link))
      {
      die('Error: ' . mysql_error());
      }

    echo "<script LANGUAGE='javascript'>document.location.href=
            'system.php#adduser'</script>";

    echo "成功删除id为 ".$deluserid." 的用户".$username;
  }
}
?>
<div id="deluser">
  <form action="system.php" method="post" >
    <center>
      <h2>
        id: <input type="text" name="deluserid"><br>
        <input name="del-submit" type="submit" value="删除">
      </h2>
    </center>
  </form>
</div>