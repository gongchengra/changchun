<?php
  include("conn.php");
  include("link1.php");
  $classid=mysqli_real_escape_string($link, trim($_POST['classid']));
  $branch=$_POST['hiddenbranch'];
  $showclasses=mysqli_query($link, "SELECT * FROM class_info 
  WHERE (branch='$branch' OR '$branch'='changchun')
  AND classid='$classid' AND status!='delete' ORDER BY classid DESC")
  or die ("Could not match data because ".mysqli_error($link));
  $num_classes = mysqli_num_rows($showclasses);
  if ($num_classes < 1) 
  {
    echo "没有id为".$classid."的班级，或者该班级属于其他分部。";
  }
  else
  {
    $getype = mysqli_fetch_array($showclasses);
    $type = $getype['classtype'];
    if($type=='encmp'||$type=='encon')
    {
      $style='1';
    }
    else
    {
      $style='2';
    }
    $showstudent=mysqli_query($link, "SELECT * FROM 
      (sub_class_info LEFT JOIN class_info on sub_class_info.classid
        =class_info.classid) WHERE sub_class_info.classid='$classid' 
    AND (branch='$branch' OR '$branch'='changchun') AND sub_class_info.status!='delete'")
    or die ("Could not match data because ".mysqli_error($link));
    $num_student = mysqli_num_rows($showstudent);
    if ($num_student > 0) 
    {
      if($style=='1')
      {
        $i=0;
        print "<table class=\"studentable\">";
        print "<tr><th></th><th>学员ic</th><th>学员姓名</th><th>学员电话</th><th>R</th>
        <th>L</th><th>S</th><th>W</th><th>N</th><th>出勤率</th><th>报名号</th><th>收据号</th></tr>";
        while ($getstudent = mysqli_fetch_array($showstudent)) 
        {
          $i=$i+1;
          print "<tr><td>$i&nbsp&nbsp&nbsp</td><td>
          <a href='getall.php?id=$getstudent[ic]' target='_blank'>
          $getstudent[ic]</a>&nbsp</td><td>
          <a href='student.php?record=$getstudent[ic]' target='_blank'>
          $getstudent[name]&nbsp</td><td>$getstudent[tel]&nbsp</td>
          <td>$getstudent[ERRec]&nbsp</td><td>$getstudent[ELRec]&nbsp</td>
          <td>$getstudent[ESRec]&nbsp</td><td>$getstudent[EWRec]&nbsp</td><td>$getstudent[ENRec]&nbsp</td>
          <td><a href='class.php?atdic=$getstudent[ic]&classid=$classid#tabs-2'>$getstudent[attendance]</a>&nbsp</td>
          <td>$getstudent[reg_no]&nbsp</td><td>$getstudent[relatedreceipt]&nbsp</td>
          <td><a href='class.php?delic=$getstudent[ic]&classid=$classid#tabs-2'>Del</a></td></tr>";
        }
        print "</table>";
      }
      else
      {
        print "<table class=\"studentable\">";
        print "<tr><th>学员ic</th><th>学员姓名</th><th>学员电话</th><th>出勤率</th><th>备注</th></tr>";
        while ($getstudent = mysqli_fetch_array($showstudent)) 
        {
          print "<tr>
          <td><a href='getall.php?id=$getstudent[ic]' target='_blank'>
          $getstudent[ic]</a>&nbsp</td>
          <td><a href='student.php?record=$getstudent[ic]' target='_blank'>
          $getstudent[name]&nbsp</td><td>$getstudent[tel]&nbsp</td>
          <td>$getstudent[attendance]&nbsp</td><td>$getstudent[notes]&nbsp</td>
          <td><a href='class.php?delic=$getstudent[ic]&classid=$classid#tabs-2'>Del</a></td></tr>";
        }
        print "</table>";
      }
      echo "<center><form action='namelist.php' method='post'>";
      echo "<input type='hidden' name='hiddenclassid' value='$classid'>";
      echo "<input type='hidden' name='hiddenbranch' value='".$_SESSION['branch']."'>";
      echo "<input type='submit' name='generatelist' value='生成namelist'>";
      echo "</form>";
      echo "<form action='postato.php' method='post' target='_blank'>";
      echo "<input type='hidden' name='hiddenclassid' value='$classid'>";
      echo "<input type='hidden' name='hiddenbranch' value='".$_SESSION['branch']."'>";
      echo "<input type='submit' name='generateato' value='生成ato'>";
      echo "</form></center>";
    }
  }
?>
