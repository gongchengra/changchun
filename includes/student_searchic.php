<?PHP
if(isset($_GET['basic'])&&$_GET['basic']!='')
{
  $_POST['ic']=$_GET["basic"];
  $_POST['searchic']=true;
}
if(isset($_POST['searchic']))
{
  $_POST['ic']=trim($_POST['ic']);
  if(strlen($_POST['ic'])!=9)
  {
    echo "ic长度应该是9位";
    return;
  }
  include("includes/conn.php");
  $link = mysql_connect($dbhost, $dbuser, $dbpass)
  or die ("Could not connect to mysql because ".mysql_error());
  // select the database
  mysql_select_db($dbname)
  or die ("Could not select database because ".mysql_error());
  mysql_query("SET NAMES UTF8");
  $ic=mysql_real_escape_string(trim($_POST['ic']));
  $icArray=str_split($ic);
  include("includes/ic.php");
  if ($icArray[8]!=$theAlpha) 
  {
    echo "你的学员IC输错了吧，格式不对呀。";
    unset($_POST);
  }
  else
  {
    $checkic = mysql_query("SELECT * FROM student_info WHERE 
      ic='$ic' AND status!='delete'")or die ("Could not match data because ".mysql_error());
    $numic = mysql_num_rows($checkic);
    if($numic>0)
    {
      $getic = mysql_fetch_array($checkic);
      if($getic['surname']=='SSA')
      {
        $_POST['studentname']=$getic['name'];
        $_POST['SSA']='1';
        $_POST['tel']=$getic['tel'];
      }
      else
      {
        $_POST['SSA']='2';
        $_POST['idtype']=$getic['idtype'];
        $_POST['gender']=$getic['gender'];
        $_POST['surname']=$getic['surname'];
        $_POST['givename']=$getic['givename'];
        $_POST['studentname']=$getic['name'];
        $_POST['othername']=$getic['othername'];
        $_POST['tel']=$getic['tel'];
        $_POST['tel_home']=$getic['tel_home'];
        $_POST['salutation']=$getic['salutation'];
        $_POST['dobyear']=date('Y',strtotime($getic['dateofbirth']));
        $_POST['dobmonth']=date('m',strtotime($getic['dateofbirth']));
        $_POST['dobday']=date('d',strtotime($getic['dateofbirth']));
        $_POST['block']=$getic['block'];
        $_POST['street']=$getic['street'];
        if(!empty($getic['floorno']))
        {
          $floor=explode('#',$getic['floorno']);
          $floorsplit=explode('-',$floor[1]);
          $_POST['floorno1']=$floorsplit[0];
          $_POST['floorno2']=$floorsplit[1];
        }
        $_POST['building']=$getic['building'];
        $_POST['postcode']=$getic['postcode'];
        $_POST['address']=$getic['address'];
        $_POST['citizenship']=$getic['citizenship'];
        $_POST['expireyear']=date('Y',strtotime($getic['expirydate']));
        $_POST['expiremonth']=date('m',strtotime($getic['expirydate']));
        $_POST['expireday']=date('d',strtotime($getic['expirydate']));
        if($_POST['expireyear']=='2038')
        {
          $_POST['expireyear']='';
          $_POST['expiremonth']='';
          $_POST['expireday']='';
        }
        $_POST['nationality']=$getic['nationality'];
        $_POST['race']=$getic['race'];
        $_POST['lang']=$getic['lang'];
        $_POST['cnlevel']=$getic['cnlevel'];
        $_POST['edulevel']=$getic['edulevel'];
        $_POST['gov_letter']=$getic['gov_letter'];
        $_POST['employstatus']=$getic['employstatus'];
        $_POST['salaryrange']=$getic['salaryrange'];
        $_POST['companyname']=htmlspecialchars($getic['companyname']);
        $_POST['companyregno']=$getic['companyregno'];
        $_POST['industry']=$getic['industry'];
        $_POST['designation']=$getic['designation'];
        $_POST['intro']=htmlspecialchars($getic['intro'],ENT_QUOTES);
      }
    }
    else
    {
      echo "没有IC为".$ic." 的学员信息。";
      unset($_POST);
      $_POST['ic']=$ic;
    }
  }
}
?>