<center><h1>用户名单</h1></center>
<?php
include("includes/conn.php"); 
// connect to the mysql server
include("includes/link.php");
$result = mysql_query("SELECT * FROM admin_user where roleid >1 ORDER BY roleid, id")
or die ("Could not match data because ".mysql_error());
print "<table id=\"usertable\">";
print "<tr><th>id</th><th>用户名</th><th>邮箱</th><th>分部</th>
<th>身份</th><th></th></tr>";
while ($row = mysql_fetch_array($result)) 
{
  if ($row['roleid']==2) {
      $identity='管理员';
  }
  if ($row['roleid']==3) {
      $identity='操作员';
  }
  $delete=($row['status']=='D')?'已删':'';
  print "<tr><td>$row[id]</td><td>$row[username]</td><td>$row[email]</td>
  <td>$row[branch]</td><td>$identity</td><td>$delete</td></tr>";
}
print "</table>";
mysql_close($link);
?>