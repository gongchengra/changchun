<center><h1>过去一个星期订位信息</h1>
<form action="exam.php" method="post">
  起始日期：
  <input type="text" id="datepicker1" name="ato_startdate"
  value="<?php if (isset($_POST['ato_startdate'])) {
  print stripslashes($_POST['ato_startdate']);} else 
  {print date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-7, date("Y")));} ?>">
  截止日期：
  <input type="text" id="datepicker2" name="ato_enddate"
  value="<?php if (isset($_POST['ato_enddate'])) {
  print stripslashes($_POST['ato_enddate']);} 
  else {print date('Y-m-d');} ?>">
  <input type="submit" name="searchatoinfo" value="搜索">
</form>
</center>
<?php
include("includes/conn.php"); 
// connect to the mysql server
include("includes/link.php");
$branch=$_SESSION['branch'];
if(!isset($_POST['searchatoinfo']))
{
  $ato_startdate=mktime(0, 0, 0, date("m"), date("d")-7, date("Y"));
  $ato_enddate=strtotime("now");
}
else
{
  $ato_startdate=strtotime($_POST['ato_startdate']);
  $ato_enddate=strtotime($_POST['ato_enddate'])+24*3600;
}
$checkato = mysql_query("SELECT * FROM ato_info WHERE 
    UNIX_TIMESTAMP(updated_at)>'$ato_startdate' AND 
    UNIX_TIMESTAMP(updated_at)<'$ato_enddate'
    AND (branch='$branch' OR '$branch'='changchun')")
or die ("Could not match data because ".mysql_error());
$numato = mysql_num_rows($checkato);
if ($numato>0) 
{
  echo "<center>";
  echo "<table>";
  print "<tr><th width='12%'>No.</th><th width='12%'>学员IC</th>
  <th width='12%'>类型</th><th width='12%'>时间</th>
  <th width='12%'>地点</th><th width='12%'>科目</th>
  <th width='12%'>订位时间</th><th width='12%'>分部</th></tr>";
  $i=0;
  while ($row = mysql_fetch_array($checkato)) 
  {
    $i=$i+1;
    $type=(($row['EN']=='Y')?'N':'').(($row['ER']=='Y')?'R':'').
    (($row['EL']=='Y')?'L':'').(($row['ES']=='Y')?'S':'').
    (($row['EW']=='Y')?'W':'');
    $delete=($row['status']=='delete')?'已删除':'';
    print "<tr><td>$i</td><td><a href='includes/getall.php?id=$row[ic]' target='_blank'>$row[ic]</a>&nbsp</td>
    <td>$row[prepost]&nbsp</td><td>$row[examtime]&nbsp</td>
    <td>$row[location]&nbsp</td><td>$type&nbsp</td><td>$row[updated_at]&nbsp</td>
    <td>$row[branch]&nbsp</td><td>$delete</td></tr>";
  }
  echo "</table>";
  echo "</center>";
}
?>

<center><h1>已订座位未填基本信息</h1></center>

<?php
include("includes/conn.php"); 
// connect to the mysql server
$link = mysql_connect($dbhost, $dbuser, $dbpass)
or die ("Could not connect to mysql because ".mysql_error());
// select the database
mysql_select_db($dbname)
or die ("Could not select database because ".mysql_error());
$branch=$_SESSION['branch'];
$result = mysql_query("SELECT * FROM ato_info where 
    (branch='$branch' OR '$branch'='changchun') AND status='book' 
    ORDER BY examtime,atoid DESC")
or die ("Could not match data because ".mysql_error());
print "<table class=\"atotable\">";
print "<tr><th width='12%'>ato id</th><th width='12%'>学员IC</th>
<th width='12%'>Pre or Post</th><th width='12%'>课程代码</th>
<th width='12%'>考试时间</th><th width='12%'>考试科目</th>
<th width='12%'>考试地点</th><th width='12%'>分部</th></tr>";
while ($getatoinfo = mysql_fetch_array($result)) 
{
  $atoype=(($getatoinfo['EN']=='Y')?'N':'').(($getatoinfo['ER']=='Y')?'R':'').
		  (($getatoinfo['EL']=='Y')?'L':'').(($getatoinfo['ES']=='Y')?'S':'').
          (($getatoinfo['EW']=='Y')?'W':'');
  $getatoinfo['location']=($getatoinfo['location']=='JE')?'Jurong East':'Eunos';
  print "<tr><td><a href='student.php?atoid=$getatoinfo[atoid]'>$getatoinfo[atoid]
  </a>&nbsp</td><td><a href='includes/getall.php?id=$getatoinfo[ic]' target='_blank'>$getatoinfo[ic]</a>&nbsp</td>
  <td>$getatoinfo[prepost]&nbsp</td><td>$getatoinfo[coursecode]&nbsp</td>
  <td>$getatoinfo[examtime]&nbsp</td><td>$atoype&nbsp</td><td>$getatoinfo[location]&nbsp</td>
  <td>$getatoinfo[branch]&nbsp</td></tr>";
}
print "</table>";
mysql_close($link);
?>

<!-- <center><h1>全部已订座位</h1></center> -->
<?php
// include("includes/conn.php");
// $link = mysql_connect($dbhost, $dbuser, $dbpass)
// or die ("Could not connect to mysql because ".mysql_error());
// // select the database
// mysql_select_db($dbname)
// or die ("Could not select database because ".mysql_error());
// mysql_query("SET NAMES UTF8");
// $ato_startdate=mktime(0, 0, 0, date("m"), date("d")+7, date("Y"));
// $branch=$_SESSION['branch'];
// $checkatoinfo=mysql_query("SELECT * FROM ato_info where UNIX_TIMESTAMP(examtime)>'$ato_startdate' 
//     AND (branch='$branch' OR '$branch'='changchun') AND status!='delete' ORDER BY examtime,atoid DESC")
// or die ("Could not match data because ".mysql_error());
// $numato=mysql_num_rows($checkatoinfo);
// if($numato>0)
// {
//   print "<table class=\"atotable\">";
//   print "<tr><th width='12%'>ato id</th><th width='12%'>学员IC</th>
//   <th width='12%'>Pre or Post</th><th width='12%'>课程代码</th>
//   <th width='12%'>考试时间</th><th width='12%'>考试科目</th>
//   <th width='12%'>考试地点</th><th width='12%'>分部</th></tr>";
//   while ($getatoinfo = mysql_fetch_array($checkatoinfo)) 
//   {
//     $atoype=(($getatoinfo['EL']=='Y')?'听力':'').(($getatoinfo['ER']=='Y')?'阅读':'').
//             (($getatoinfo['EN']=='Y')?'数学':'').(($getatoinfo['ES']=='Y')?'会话':'').
//             (($getatoinfo['EW']=='Y')?'写作':'');
//     $getatoinfo['location']=($getatoinfo['location']=='JE')?'Jurong East':'Eunos';
//     print "<tr><td><a href='student.php?atoid=$getatoinfo[atoid]'>$getatoinfo[atoid]
//     </a>&nbsp</td><td><a href='includes/getall.php?id=$getatoinfo[ic]' target='_blank'>$getatoinfo[ic]</a>&nbsp</td>
//     <td>$getatoinfo[prepost]&nbsp</td><td>$getatoinfo[coursecode]&nbsp</td>
//     <td>$getatoinfo[examtime]&nbsp</td><td>$atoype&nbsp</td><td>$getatoinfo[location]</td>
//     <td>$getatoinfo[branch]&nbsp</td></tr>";
//   }
//   print "</table>";
// }
?>
