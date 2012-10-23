<?php
if(isset($_POST['generateato']))
{
  include("includes/conn.php");
  include("includes/link.php");
  $ato_date=strtotime($_POST['ato_date']);
  $ato_date1=$ato_date+24*3600;
  $branch=$_SESSION['branch'];
  $generate=mysql_query("SELECT * FROM ato_info where UNIX_TIMESTAMP(examtime)>'$ato_date' 
    AND UNIX_TIMESTAMP(examtime)<='$ato_date1' 
    AND (branch='$branch' OR '$branch'='changchun')
    AND status!='delete' ORDER BY examtime, atoid DESC")
    or die ("Could not match data because ".mysql_error());
  $numgenerate=mysql_num_rows($generate);
  if($numgenerate>0)
  {
    print "<table class=\"generate\">";
    print "<tr><th width='10%'>ato id</th><th width='12%'>学员IC</th>
    <th width='8%'>Pre or Post</th><th width='12%'>课程代码</th>
    <th width='12%'>考试时间</th><th width='12%'>考试科目</th>
    <th width='12%'>考试地点</th><th width='12%'>分部</th></tr>";
    while ($generateato = mysql_fetch_array($generate)) 
    {
      $atoype=(($generateato['EN']=='Y')?'N':'').(($generateato['ER']=='Y')?'R':'').
              (($generateato['EL']=='Y')?'L':'').(($generateato['ES']=='Y')?'S':'').
              (($generateato['EW']=='Y')?'W':'');
      $generateato['location']=($generateato['location']=='JE')?'Jurong East':'Eunos';
      print "<tr><td><a href='student.php?atoid=$generateato[atoid]'>$generateato[atoid]
      </a>&nbsp</td><td><a href='includes/getall.php?id=$generateato[ic]' target='_blank'>$generateato[ic]</a>&nbsp</td>
      <td>$generateato[prepost]&nbsp</td><td>$generateato[coursecode]&nbsp</td>
      <td>$generateato[examtime]&nbsp</td><td>$atoype&nbsp</td><td>$generateato[location]</td>
      <td>$generateato[branch]&nbsp</td></tr>";
    }
    print "</table>";
  }
  echo "<script LANGUAGE='javascript'>document.location.href=
              'student.php#tabs-4'</script>";
}
?>
