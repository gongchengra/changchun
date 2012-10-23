<?php
$show_seat=false;
if ($_SESSION['role']>2){
$show_seat=true;
}
if(true == $show_seat)
{
?>
<center>
  <h1>座位数目</h1>
  <table width="100%">
  <tr align="center">
  <td bgcolor="#999999" style="color:#FFFFFF">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td width="50%" align="left">  <a href="<?php echo $_SERVER["PHP_SELF"].
  "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF"
  >Previous</a></td>
  <td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"].
  "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF"
  >Next</a></td>
  </tr>
  </table>
  </td>
  </tr>
  <tr>
  <td align="center">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
  <tr align="center">
  <td colspan="6" bgcolor="#999999" style="color:#FFFFFF"><strong>
    <?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
  </tr>
  <tr>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
  <td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
  </tr>
  <?php
  // Get seat information of current month.
  $timestamp = mktime(0,0,0,$cMonth,1,$cYear);
  $maxday = date("t",$timestamp);
  $endtimestamp = mktime(0,0,0,$cMonth,($maxday+1),$cYear);
  include("includes/conn.php"); 
  // connect to the mysql server
  include("includes/link.php"); 
  $result = mysql_query("SELECT UNIX_TIMESTAMP(examdate) as examdate, 
      location,seatavailable,finish FROM exam_info where 
  UNIX_TIMESTAMP(examdate)>=$timestamp AND 
  UNIX_TIMESTAMP(examdate)<=$endtimestamp
  AND status='A'")or die ("Could not match data because ".mysql_error());
  $thismonth = getdate ($timestamp);
  $startday = $thismonth['wday'];
  $mon_num=0;
  if(isset($result))
  {
    while($row = mysql_fetch_array($result))
    {
      $montharr[$mon_num]['examdate']=$row['examdate'];
      $montharr[$mon_num]['location']=$row['location'];
      $montharr[$mon_num]['seatavailable']=$row['seatavailable'];
      $montharr[$mon_num]['finish']=$row['finish'];
      $mon_num++;
    }
  }
  mysql_close($link);

  // show the seat for operator
  for ($i=0; $i<($maxday+$startday); $i++) 
  {
    if(($i % 7) == 0 ) {echo "<tr>";$i++;}
    if($i < $startday) echo "<td></td>";
    else 
    {
      $tmpday=($i - $startday + 1);
      $examdate9=mktime(9,0,0,$cMonth,$tmpday,$cYear);
      $examdate14=mktime(14,0,0,$cMonth,$tmpday,$cYear);
      $examdate19=mktime(19,0,0,$cMonth,$tmpday,$cYear);
      if(isset($montharr))
      {
        foreach ($montharr as $monthtmp) 
        {
          if($monthtmp['examdate']==$examdate9)
          {
            if($monthtmp['location']=='JE')
            {
              $day9je=$monthtmp['seatavailable'];
              $day9jestatus=$monthtmp['finish'];
            } 
            if($monthtmp['location']=='UN') 
            {
              $day9un=$monthtmp['seatavailable'];
              $day9unstatus=$monthtmp['finish'];
            }
          }
          if($monthtmp['examdate']==$examdate14)
          {
            if($monthtmp['location']=='JE') 
            {
              $day14je=$monthtmp['seatavailable'];
              $day14jestatus=$monthtmp['finish'];
            }
            if($monthtmp['location']=='UN')
            {
              $day14un=$monthtmp['seatavailable'];
              $day14unstatus=$monthtmp['finish'];
            }
          }
          if($monthtmp['examdate']==$examdate19)
          {
            if($monthtmp['location']=='JE')
            {
              $day19je=$monthtmp['seatavailable'];
              $day19jestatus=$monthtmp['finish'];
            }
            if($monthtmp['location']=='UN')
            {
              $day19un=$monthtmp['seatavailable'];
              $day19unstatus=$monthtmp['finish'];
            }
          }
        }
      }
      
      if(!isset($day9je)){$day9je=0;}
      if(!isset($day9un)){$day9un=0;}
      if(!isset($day14je)){$day14je=0;}
      if(!isset($day14un)){$day14un=0;}
      if(!isset($day19je)){$day19je=0;}
      if(!isset($day19un)){$day19un=0;}
      if(!isset($day9jestatus)){$day9jestatus='on';}
      if(!isset($day9unstatus)){$day9unstatus='on';}
      if(!isset($day14jestatus)){$day14jestatus='on';}
      if(!isset($day14unstatus)){$day14unstatus='on';}
      if(!isset($day19jestatus)){$day19jestatus='on';}
      if(!isset($day19unstatus)){$day19unstatus='on';}
      echo "<td>";
      echo "<table border='1' width='150px'>";
      echo "<tr>";
      echo "<td colspan='3' align='center' valign='middle' height='20px'>".($tmpday)."</td>";
      echo "</tr>";
      echo "<tr>";
      echo "</tr>";
      echo "<tr><td width='50px'></td><td width='50px'>JE</td><td width='50px'>UN</td></tr>";
      echo "<tr><td>09:00</td>".(($day9jestatus!='off'&&$day9je!=0)?
      ($day9je<5?"<td bgcolor='red'>":"<td bgcolor='#00FF00'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate9&location=JE#inputatohead'>".($day9je)."</a></td>".
      (($day9unstatus!='off'&&$day9un!=0)?
      ($day9un<5?"<td bgcolor='red'>":"<td bgcolor='yellow'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate9&location=UN#inputatohead'>".($day9un)."</a></td></tr>";
      echo "<tr><td>14:00</td>".
      (($day14jestatus!='off'&&$day14je!=0)?
      ($day14je<5?"<td bgcolor='red'>":"<td bgcolor='#00FF00'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate14&location=JE#inputatohead'>".($day14je)."</a></td>".
      (($day14unstatus!='off'&&$day14un!=0)?
      ($day14un<5?"<td bgcolor='red'>":"<td bgcolor='yellow'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate14&location=UN#inputatohead'>".($day14un)."</a></td></tr>";
      echo "<tr><td>19:00</td>".
      (($day19jestatus!='off'&&$day19je!=0)?
      ($day19je<5?"<td bgcolor='red'>":"<td bgcolor='#00FF00'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate19&location=JE#inputatohead'>".($day19je)."</a></td>".
      (($day19unstatus!='off'&&$day19un!=0)?
      ($day19un<5?"<td bgcolor='red'>":"<td bgcolor='yellow'>"):"<td bgcolor='#808080'>").
      "<a href='exam.php?examdate=$examdate19&location=UN#inputatohead'>".($day19un)."</a></td></tr>";
      echo "</table>";
      echo "</td>";
    }
    if(($i % 7) == 6 ) echo "</tr>";
  }
  unset($montharr);
  ?>
  </table>
  </td>
  </tr>
  </table>
  <h1>生成EXCEL</h1>
  <form action="printexam.php" method="post">
  <input type="submit" name="printexam" value="生成">
  </form>
</center>

<?PHP
}//true == $show_seat
?>

