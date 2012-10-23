<?PHP
if(isset($_GET['classid'])&&$_GET['classid']!='')
{
  $_POST['classid']=$_GET["classid"];
  $_POST['searchclass']=true;
}
if(isset($_POST['searchclass']))
{
  include("includes/conn.php");
  include("includes/link.php");
  $classid=mysql_real_escape_string(trim($_POST['classid']));
  $branch=$_SESSION['branch'];
  $checkclassid = mysql_query("SELECT * FROM class_info WHERE 
    classid='$classid' AND (branch='$branch' OR '$branch'='changchun')
     AND status!='delete'")
  or die ("Could not match data because ".mysql_error());
  $numclassid = mysql_num_rows($checkclassid);
  if($numclassid>0)
  {
    $getclassid = mysql_fetch_array($checkclassid);
    // $_POST['classname']=(!empty($getclassid['classname']))?$getclassid['classname']:'';
    $_POST['coursecode']=(!empty($getclassid['coursecode']))?$getclassid['coursecode']:'';
    $_POST['classtype']=(!empty($getclassid['classtype']))?$getclassid['classtype']:'';
    $_POST['classlevel']=(!empty($getclassid['classlevel']))?$getclassid['classlevel']:'';
    $_POST['classtype1']=(!empty($getclassid['classtype']))?$getclassid['classtype']:'';
    $_POST['classlevel1']=(!empty($getclassid['classlevel']))?$getclassid['classlevel']:'';
    $_POST['finish']=(!empty($getclassid['finish']))?$getclassid['finish']:'';
    $_POST['location']=(!empty($getclassid['location']))?$getclassid['location']:'';
    // $_POST['coursecode']=$getclassid['coursecode'];
    // $_POST['classtype']=$getclassid['classtype'];
    // $_POST['classlevel']=$getclassid['classlevel'];
    // $_POST['finish']=$getclassid['finish'];
    // $_POST['location']=$getclassid['location'];
    // echo $getclassid['class_startdate'];
    if($_POST['classtype']=='encmp')
    {
      $_POST['EL1']='Y';
      $_POST['ER1']='Y';
      $_POST['ES1']='N';
      $_POST['EW1']='N';
      $_POST['EN1']='N';
      $_POST['ES2']='Y';
      $_POST['EW2']='Y';
      $_POST['EL2']='N';
      $_POST['ER2']='N';
      $_POST['EN2']='N';
    }
    if($_POST['classtype']=='encon')
    {
      $_POST['EL1']='Y';
      $_POST['ER1']='Y';
      $_POST['ES1']='Y';
      $_POST['EW1']='N';
      $_POST['EN1']='N';
    }
    $_POST['class_startdate']=($getclassid['class_startdate']!='2038-01-01')?
    date('Y-m-d',strtotime($getclassid['class_startdate'])):'';
    // echo $getclassid['class_endate'];
    $_POST['class_endate']=($getclassid['class_endate']!='2038-01-01')?
    date('Y-m-d',strtotime($getclassid['class_endate'])):'';
    $_POST['class_startime']=$getclassid['class_startime'];
    $_POST['class_endtime']=$getclassid['class_endtime'];
    $_POST['teacher']=$getclassid['teacher'];
    $_POST['teacher_tel']=$getclassid['teacher_tel'];
    // echo $getclassid['postcatlr'];
    $_POST['lrdate']=($getclassid['postcatlr']!='2038-01-01 00:00:00')?
    date('Y-m-d',strtotime($getclassid['postcatlr'])):'';
    $_POST['lrtime']=date('H',strtotime($getclassid['postcatlr']));
    $_POST['lrlocation']=$getclassid['lrlocation'];
    $_POST['swdate']=($getclassid['postcatsw']!='2038-01-01 00:00:00')?
    date('Y-m-d',strtotime($getclassid['postcatsw'])):'';
    $_POST['swtime']=date('H',strtotime($getclassid['postcatsw']));
    $_POST['swlocation']=$getclassid['swlocation'];
    // echo "<script LANGUAGE='javascript'>document.location.href=
    //     'class.php'</script>";
  }
  else
  {
    echo "没有class id为".$classid." 的班级信息。";
    unset($_POST);
  }
}
?>