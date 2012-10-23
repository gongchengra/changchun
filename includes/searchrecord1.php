<?php
include("conn.php");
include("link1.php");
if(empty($_POST['classid2']))
{
  echo "请输入班级id。";
  return;
}
elseif(empty($_POST['classtype1']))
{
  echo "请输入班级类型";
  return;
}
elseif(empty($_POST['availabletime']))
{
  echo "请输入上课时间。";
}
else
{
  $branch=$_POST['hiddenbranch'];
  $classid=$_POST['classid2'];
  $classtype=$_POST['classtype1'];
  $availabletime=serialize($_POST['availabletime']);
  
  $showstudent=mysqli_query($link, "SELECT ic FROM 
    (sub_class_info LEFT JOIN class_info on sub_class_info.classid
        =class_info.classid) WHERE sub_class_info.classid='$classid' 
    AND (branch='$branch' OR '$branch'='changchun') AND sub_class_info.status!='delete'")
    or die ("Could not match data because ".mysqli_error($link));
  $num_student = mysqli_num_rows($showstudent);
  $allstudent=array();
  $i=0;
  if ($num_student > 0) 
  {
    while ($getstudent = mysqli_fetch_array($showstudent)) 
    {
      $allstudent[$i]=$getstudent['ic'];
      $i=$i+1;
    }
  }
  $checkresult=mysqli_query($link, "SELECT * FROM receipt_info 
  WHERE course_type='$classtype' AND (branch='$branch' OR branch='changchun') 
  AND status!='delete' GROUP BY receiptic ORDER BY receipt_date DESC")
  or die ("Could not match data because ".mysqli_error($link));
  $numresult=mysqli_num_rows($checkresult);
  if($numresult>0)
  {
    print "<center>";
    print "<table class=\"resulttable\">";
    print "<tr><th width='10%'>IC</th><th width='10%'>学员姓名</th>
    <th width='10%'>学员电话</th><th width='10%'>收费时间</th>
    <th width='40%'>Remark</th></tr>";
    while ($getresult = mysqli_fetch_array($checkresult)) 
    {
      $color='white';
      foreach($allstudent as $value)
      {
        if($value==$getresult['ic'])
        {
          $color='yellow';
        }
      }
    print "<tr bgcolor='$color'><td><a href='includes/getall.php?id=$getresult[receiptic]' 
    target='_blank'>$getresult[receiptic]</a></td><td>$getresult[receiptname]</td>
    <td>$getresult[receiptel]</td><td>$getresult[receipt_date]</td>
    <td>$getresult[remarks]</td>
    <td><a href='class.php?ic=$getresult[receiptic]&classid=$classid'>Add</a></td></tr>";
    }
    print "</table>";
    print "</center>";
  }
  else
  {
    echo "没有满足条件的学员。";
  }
}
?>