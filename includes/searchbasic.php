<?PHP
$_POST['ic']=trim($_POST['ic']);
$arr = array();
// print $_POST['ic'];
if(strlen($_POST['ic'])!=9)
{
  $arr['err']="ic长度应该是9位";
  print json_encode($arr);
  return;
}
include("conn.php");
include("link1.php");
$ic=mysqli_real_escape_string($link, $_POST['ic']);
$icArray=str_split($ic);
include("ic.php");
if ($icArray[8]!=$theAlpha) 
{
  $arr['err']="你的学员IC输错了吧，格式不对呀。";
}
else
{
  $checkic = mysqli_query($link, "SELECT * FROM student_info WHERE 
    ic='$ic' AND status!='delete'")
  or die ("Could not match data because ".mysqli_error());
  $numic = mysqli_num_rows($checkic);
  if($numic>0)
  {
    $getic = mysqli_fetch_array($checkic);
    if($getic['surname']=='SSA')
    {
      $arr['studentname']=$getic['name'];
      $arr['SSA']='1';
      $arr['tel']=$getic['tel'];
    }
    else
    {
      $arr['SSA']='2';
      $arr['idtype']=$getic['idtype'];
      $arr['gender']=$getic['gender'];
      $arr['surname']=$getic['surname'];
      $arr['givename']=$getic['givename'];
      $arr['studentname']=$getic['name'];
      $arr['othername']=$getic['othername'];
      $arr['tel']=$getic['tel'];
      $arr['tel_home']=$getic['tel_home'];
      $arr['salutation']=$getic['salutation'];
      $arr['dobyear']=date('Y',strtotime($getic['dateofbirth']));
      $arr['dobmonth']=date('m',strtotime($getic['dateofbirth']));
      $arr['dobday']=date('d',strtotime($getic['dateofbirth']));
      $arr['block']=$getic['block'];
      $arr['street']=$getic['street'];
      if(!empty($getic['floorno']))
      {
        $floor=explode('#',$getic['floorno']);
        $floorsplit=explode('-',$floor[1]);
        $arr['floorno1']=$floorsplit[0];
        $arr['floorno2']=$floorsplit[1];
      }
      $arr['building']=$getic['building'];
      $arr['postcode']=$getic['postcode'];
      $arr['address']=$getic['address'];
      $arr['citizenship']=$getic['citizenship'];
      $arr['expireyear']=date('Y',strtotime($getic['expirydate']));
      $arr['expiremonth']=date('m',strtotime($getic['expirydate']));
      $arr['expireday']=date('d',strtotime($getic['expirydate']));
      if($arr['expireyear']=='2038')
      {
        $arr['expireyear']='';
        $arr['expiremonth']='';
        $arr['expireday']='';
      }
      $arr['nationality']=$getic['nationality'];
      $arr['race']=$getic['race'];
      $arr['lang']=$getic['lang'];
      $arr['cnlevel']=$getic['cnlevel'];
      $arr['edulevel']=$getic['edulevel'];
      $arr['gov_letter']=$getic['gov_letter'];
      $arr['employstatus']=$getic['employstatus'];
      $arr['salaryrange']=$getic['salaryrange'];
      $arr['companyname']=htmlspecialchars($getic['companyname']);
      $arr['companyregno']=$getic['companyregno'];
      $arr['industry']=$getic['industry'];
      $arr['designation']=$getic['designation'];
      $arr['intro']=htmlspecialchars($getic['intro'],ENT_QUOTES);
      // $availableArray=str_split($getic['availabletime']);
      // foreach($availableArray as $value)
      // {
      //   if($value=='1'){$arr['availabletime1']='1';}
      //   if($value=='2'){$arr['availabletime2']='2';}
      //   if($value=='3'){$arr['availabletime3']='3';}
      //   if($value=='4'){$arr['availabletime4']='4';}
      //   if($value=='5'){$arr['availabletime5']='5';}
      //   if($value=='6'){$arr['availabletime6']='6';}
      //   if($value=='7'){$arr['availabletime7']='7';}
      // }
      $arr['availabletime']=$getic['availabletime'];
    }
  }
  else
  {
    $arr['err']="没有IC为".$ic." 的学员信息。";
  }
}
print json_encode($arr);
?>