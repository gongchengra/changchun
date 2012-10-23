<?php
if(isset($_POST['send']))
{
  $id=$_POST['id'];
  $storetime=$_POST['storetime'];
  $storelocation=$_POST['storelocation'];
  $storefinish=$_POST['finish'];
  // print_r($id);
  // print_r($storetime);
  // print_r($storefinish);
  include("includes/conn.php"); 
  // connect to the mysql server
  include("includes/link.php");


  $mon_num=0;
  while($row = mysql_fetch_array($result))
  {
    $montharr[$mon_num]['examdate']=$row['examdate'];
    $montharr[$mon_num]['location']=$row['location'];
    $montharr[$mon_num]['seatavailable']=$row['seatavailable'];
    $montharr[$mon_num]['finish']=$row['finish'];
    $mon_num++;
  }
  // print_r($montharr);
  for ($i=0; $i <count($id) ; $i++) 
  {
    $examdate=$storetime[$i];
    $finish=($storefinish[$i/6]);
    $location=$storelocation[$i];
    // $seatavailable=($finish=='on')?$id[$i]:0;
    $seatavailable=$id[$i];
    $deadline=$examdate-3600*24*4;
    if (strtotime('now')>$deadline) 
    {
      $finish='off';
      $seatavailable=0;
    }
    $result = mysql_query("SELECT UNIX_TIMESTAMP(examdate) as examdate, 
      location,seatavailable,finish FROM exam_info where 
      UNIX_TIMESTAMP(examdate)='$examdate' AND 
      location='$location' AND status='A'")
      or die ("Could not match data because ".mysql_error());
    $num_result = mysql_num_rows($result);
    if($num_result>0)
    {
     $query = mysql_query("UPDATE exam_info SET finish='$finish', 
        seatavailable='$seatavailable' WHERE UNIX_TIMESTAMP(examdate)='$examdate' 
        AND location='$location'") or die('Error: ' . mysql_error());
    }
    else
    {
      $query = mysql_query("INSERT INTO exam_info (examdate, deadline, finish, location,
       seatavailable) VALUES (FROM_UNIXTIME($examdate),
       FROM_UNIXTIME($deadline),'$finish','$location','$seatavailable')")
      or die('Error: ' . mysql_error());
    }
  } 
  echo "<meta http-equiv='refresh' content='0';URL=exam.php'>";
}
?>
