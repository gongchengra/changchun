<?php
include("includes/conn.php"); 
// connect to the mysql server
include("includes/link.php");
$branch=$_SESSION['branch'];
$result = mysql_query("SELECT atoid, examtime, location, prepost, ic FROM ato_info where 
    branch='$branch' AND status='book' ORDER BY examtime")
or die ("Could not match data because ".mysql_error());
$numato = mysql_num_rows($result);
if($numato>0)
{
  echo "<center>";
  echo "<h1>你的ato信息不全！</h1>\n 
  <h2> 请检查学员基本信息和更新考试项目来完成ato。
  输入学员信息之前请搜索学员ic以免重复。</h2>";
  print "<table class=\"atoprecat\">";
  print "<tr><th>ID</th><th>考试时间</th><th>考试地点</th><th>类型</th><th>学员IC</th></tr>";
  while ($row = mysql_fetch_array($result)) 
  {
    print "<tr><td><a href='student.php?atoid=$row[atoid]'>$row[atoid]
      </a>&nbsp</td><td>$row[examtime]&nbsp</td>
    <td>$row[location]&nbsp</td><td>$row[prepost]&nbsp&nbsp</td>
    <td><a href='student.php?basic=$row[ic]'>$row[ic]</a></td></tr>";
  }
  print "</table>";
  echo "</center>";
}
mysql_close($link);
?>