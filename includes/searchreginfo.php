<?php
include("conn.php");
include("link.php");
//echo $_POST['findCMP'];
//echo empty($_POST['findCMP']);
//echo isset($_POST['findCON']);
$reg_startdate=strtotime($_POST['reg_startdate']);
$reg_enddate=strtotime($_POST['reg_enddate']);
$branch=$_POST['hiddenbranch'];
$checkreginfo=mysql_query("SELECT * FROM reg_info where UNIX_TIMESTAMP(reg_date)>'$reg_startdate' 
    AND UNIX_TIMESTAMP(reg_date)<='$reg_enddate' AND (branch='$branch' OR '$branch'='changchun') AND status!='delete'
    ORDER BY branch, UNIX_TIMESTAMP(reg_date) desc, regid desc")
or die ("Could not match data because ".mysql_error());
$numreg=mysql_num_rows($checkreginfo);
if($numreg>0)
{
  print "<center>";
  print "<table class=\"regtable\">";
  print "<tr><th>报名id</th><th>学员IC</th><th>报名时间</th><th>报名地点</th><th>报名表号码
          </th><th>分部</th></tr>";
  while ($getreginfo = mysql_fetch_array($checkreginfo)) 
  {
    print "<tr><td><a href='student.php?regid=$getreginfo[regid]'>$getreginfo[regid]</a>&nbsp</td><td>
    <a href='includes/getall.php?id=$getreginfo[ic]' target='_blank'>$getreginfo[ic]</a>&nbsp</td><td>$getreginfo[reg_date]&nbsp</td>
    <td>$getreginfo[reg_location]&nbsp</td><td>$getreginfo[reg_no]&nbsp</td><td>$getreginfo[branch]&nbsp</td></tr>";
  }
  print "</table>";
  print "</center>";
}
?>
