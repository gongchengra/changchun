<?php
include("includes/conn.php");
include("includes/link.php");
if(!isset($_POST['searchrecord']))
{
  if(isset($_GET['classid2'])&&$_GET['classid2']!='') {$classid=$_GET['classid2'];}
  elseif(isset($_GET['classid'])&&$_GET['classid']!='') {$classid=$_GET['classid'];}
  elseif(isset($_POST['classid1'])) {$classid=$_POST['classid1'];}
  elseif(isset($_POST['classid'])) {$classid=$_POST['classid'];}
  else {$classid='';}
  // $classid=(isset($_POST['classid']))?$_POST['classid']:'';
  $branch=$_SESSION['branch'];
  $classtype=(isset($_POST['classtype1']))?$_POST['classtype1']:'';
  $classlevel=(isset($_POST['classlevel1']))?$_POST['classlevel1']:'';
  $showstudent=mysql_query("SELECT ic FROM 
    (sub_class_info LEFT JOIN class_info on sub_class_info.classid
        =class_info.classid) WHERE sub_class_info.classid='$classid' 
    AND (branch='$branch' OR '$branch'='changchun') AND sub_class_info.status!='delete'")
    or die ("Could not match data because ".mysql_error());
  $num_student = mysql_num_rows($showstudent);
  $allstudent=array();
  $i=0;
  if ($num_student > 0) 
  {
    while ($getstudent = mysql_fetch_array($showstudent)) 
    {
      $allstudent[$i]=$getstudent['ic'];
      $i=$i+1;
    }
  }
  // print_r($allstudent);
  //if((!empty($classtype))&&(!empty($classlevel))&&($branch!='changchun'))
  if($classtype=='encmp'||$classtype=='encon')
  {
    if($classtype=='encmp')
    {
      $classtype1='CMP';
    } 
    if($classtype=='encon')
    {
      $classtype1='CON';
    }
    $checkresult=mysql_query("SELECT *, date(rlupdated_at) as rlupdate 
      FROM student_record WHERE $classtype1='$classlevel' 
      AND (branch='$branch' OR branch='changchun') 
    AND status!='delete' ORDER BY rlupdated_at DESC,sturecid DESC")
    or die ("Could not match data because ".mysql_error());
    $numresult=mysql_num_rows($checkresult);
    if($numresult>0)
    {
      print "<center>";
      print "<table class=\"resulttable\">";
      print "<tr><th width='10%'>IC</th><th width='10%'>学员姓名</th>
      <th width='10%'>学员电话</th><th width='10%'>考试时间</th>
      <th width='5%'>R</th><th width='5%'>L</th><th width='5%'>S</th>
      <th width='5%'>W</th><th width='40%'>Remark</th></tr>";
      while ($getresult = mysql_fetch_array($checkresult)) 
      {
        $color='white';
        foreach($allstudent as $value)
        {
          if($value==$getresult['ic'])
          {
            $color='yellow';
          }
        }
      print "<tr bgcolor='$color'><td><a href='includes/getall.php?id=$getresult[ic]' 
      target='_blank'>$getresult[ic]</a></td><td>
      <a href='student.php?record=$getresult[ic]' 
      target='_blank'>$getresult[name]</a></td>
      <td>$getresult[tel]</td><td>$getresult[rlupdate]</td>
      <td>$getresult[ERBest]</td><td>$getresult[ELBest]</td>
      <td>$getresult[ESBest]</td><td>$getresult[EWBest]</td>
      <td>$getresult[remark]</td>
      <td><a href='class.php?ic=$getresult[ic]&classid=$classid'>Add</a></td></tr>";
      }
      print "</table>";
      print "</center>";
    }
    else
    {
      echo "没有满足条件的学员。";
    }
  }
}
else
{
  if(empty($_POST['classid2']))
  {
    echo "请输入班级id。";
    return;
  }
  elseif(empty($_POST['classtype1'])||empty($_POST['classlevel1']))
  {
    echo "请输入班级类型和等级。";
    return;
  }
  elseif(empty($_POST['exam_startdate'])||empty($_POST['exam_enddate']))
  {
    echo "请输入筛选考试起止日期。";
  }
  elseif(empty($_POST['availabletime']))
  {
    echo "请输入上课时间。";
  }
  else
  {
    $branch=$_SESSION['branch'];
    $classid=$_POST['classid2'];
    $classtype=$_POST['classtype1'];
    $classlevel=$_POST['classlevel1'];
    $exam_startdate=strtotime($_POST['exam_startdate']);
    $exam_enddate=strtotime($_POST['exam_enddate'])+24*3600;
    $availabletime=serialize($_POST['availabletime']);
    if($classtype=='encmp')
    {
      $classtype1='CMP';
    } 
    if($classtype=='encon')
    {
      $classtype1='CON';
    }
    $showstudent=mysql_query("SELECT ic FROM 
      (sub_class_info LEFT JOIN class_info on sub_class_info.classid
          =class_info.classid) WHERE sub_class_info.classid='$classid' 
      AND (branch='$branch' OR '$branch'='changchun') AND sub_class_info.status!='delete'")
      or die ("Could not match data because ".mysql_error());
    $num_student = mysql_num_rows($showstudent);
    $allstudent=array();
    $i=0;
    if ($num_student > 0) 
    {
      while ($getstudent = mysql_fetch_array($showstudent)) 
      {
        $allstudent[$i]=$getstudent['ic'];
        $i=$i+1;
      }
    }
    $checkresult=mysql_query("SELECT *, date(rlupdated_at) as rlupdate 
      FROM student_record 
    WHERE UNIX_TIMESTAMP(rlupdated_at)>'$exam_startdate' 
    AND UNIX_TIMESTAMP(rlupdated_at)<='$exam_enddate'
    AND $classtype1='$classlevel' AND (branch='$branch' OR branch='changchun') 
    AND availabletime='$availabletime' AND status!='delete' 
    ORDER BY rlupdated_at DESC,sturecid DESC")
    or die ("Could not match data because ".mysql_error());
    $numresult=mysql_num_rows($checkresult);
    if($numresult>0)
    {
      print "<center>";
      print "<table class=\"resulttable\">";
      print "<tr><th width='10%'>IC</th><th width='10%'>学员姓名</th>
      <th width='10%'>学员电话</th><th width='10%'>考试时间</th>
      <th width='5%'>R</th><th width='5%'>L</th><th width='5%'>S</th>
      <th width='5%'>W</th><th width='40%'>Remark</th></tr>";
      while ($getresult = mysql_fetch_array($checkresult)) 
      {
        $color='white';
        foreach($allstudent as $value)
        {
          if($value==$getresult['ic'])
          {
            $color='yellow';
          }
        }
      print "<tr bgcolor='$color'><td><a href='includes/getall.php?id=$getresult[ic]' 
      target='_blank'>$getresult[ic]</a></td><td>
      <a href='student.php?record=$getresult[ic]' 
      target='_blank'>$getresult[name]</a></td>
      <td>$getresult[tel]</td><td>$getresult[rlupdate]</td>
      <td>$getresult[ERBest]</td><td>$getresult[ELBest]</td>
      <td>$getresult[ESBest]</td><td>$getresult[EWBest]</td>
      <td>$getresult[remark]</td>
      <td><a href='class.php?ic=$getresult[ic]&classid=$classid'>Add</a></td></tr>";
      }
      print "</table>";
      print "</center>";
    }
    else
    {
      echo "没有满足条件的学员。";
    }
    echo "<script LANGUAGE='javascript'>document.location.href=
    'class.php#tabs-2'</script>";
  }
}
?>