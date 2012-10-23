<div id="showreceipt">
  <?php
  if(!isset($_POST['searchatoinfo'])&&!isset($_POST['generateato']))
  {
    include("includes/conn.php");
    include("includes/link.php");
    echo "<center><h1>未来两个月ato信息</h1></center>";
    $ato_startdate=mktime(0, 0, 0, date("m"), date("d")+7, date("Y"));
    $ato_enddate=mktime(0, 0, 0, date("m")+2, date("d"), date("Y"));
    $branch=$_SESSION['branch'];
    $checkatoinfo=mysql_query("SELECT * FROM ato_info where UNIX_TIMESTAMP(examtime)>'$ato_startdate' 
        AND UNIX_TIMESTAMP(examtime)<'$ato_enddate' AND (branch='$branch' OR '$branch'='changchun') 
        AND status!='delete' ORDER BY examtime, atoid DESC")
    or die ("Could not match data because ".mysql_error());
    $numato=mysql_num_rows($checkatoinfo);
    if($numato>0)
    {
      print "<table class=\"atotable\">";
      print "<tr><th width='10%'>ato id</th><th width='12%'>学员IC</th>
      <th width='8%'>Pre or Post</th><th width='12%'>课程代码</th>
      <th width='12%'>考试时间</th><th width='12%'>考试科目</th>
      <th width='12%'>考试地点</th><th width='12%'>分部</th></tr>";
      while ($getatoinfo = mysql_fetch_array($checkatoinfo)) 
      {
        $atoype=(($getatoinfo['EN']=='Y')?'N':'').(($getatoinfo['ER']=='Y')?'R':'').
                (($getatoinfo['EL']=='Y')?'L':'').(($getatoinfo['ES']=='Y')?'S':'').
                (($getatoinfo['EW']=='Y')?'W':'');
        $getatoinfo['location']=($getatoinfo['location']=='JE')?'Jurong East':'Eunos';
        print "<tr><td><a href='student.php?atoid=$getatoinfo[atoid]'>$getatoinfo[atoid]
        </a>&nbsp</td><td><a href='includes/getall.php?id=$getatoinfo[ic]' target='_blank'>$getatoinfo[ic]</a>&nbsp</td>
        <td>$getatoinfo[prepost]&nbsp</td><td>$getatoinfo[coursecode]&nbsp</td>
        <td>$getatoinfo[examtime]&nbsp</td><td>$atoype&nbsp</td><td>$getatoinfo[location]</td>
        <td>$getatoinfo[branch]&nbsp</td></tr>";
      }
      print "</table>";
    }
  }
  ?>
</div>