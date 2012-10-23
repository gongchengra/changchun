<?PHP
//include the main validation script
require_once "../formvalidator.php";
include("conn.php");
include("link1.php");
// if($_POST['SSA']=='1')
// {
//   $_POST['ic']=trim($_POST['ic']);
//   $_POST['studentname']=trim($_POST['studentname']);
//   $validator = new FormValidator();
//   $validator->addValidation("ic","req","请输入学员ic");
//   $validator->addValidation("ic","minlen=9","学员ic应该是9位");
//   $validator->addValidation("ic","maxlen=9","学员ic应该是9位");
//   $validator->addValidation("studentname","req","请输入学员姓名");
//   if($validator->ValidateForm())
//   {
//     $ic=mysqli_real_escape_string($link, $_POST['ic']);
//     $studentname=mysqli_real_escape_string($link, $_POST['studentname']);
//     $icArray=str_split($ic);
//     include("ic.php");
//     if ($icArray[8]!=$theAlpha) 
//     {
//       print "你的学员IC输错了吧，格式不对呀。";
//     }
//     else
//     {
//       print "<h2>输入有效</h2>";
//       $tel=(isset($_POST['tel']))?mysqli_real_escape_string($link, $_POST['tel']):'SSA';
//       $match = mysqli_query($link, "SELECT * FROM student_info WHERE ic='$ic'")
//       or die ("Could not match data because ".mysqli_error());
//       $num_rows = mysqli_num_rows($match);
//       if ($num_rows<1) 
//       {
//         $dateofbirth=date('Y-m-d',mktime(0,0,0,1,1,2038));
//         $sql=mysqli_query($link, "INSERT INTO student_info (ic, name, surname, givename,
//         othername, tel, tel_home, gender, salutation, dateofbirth, idtype,
//         citizenship, expirydate, nationality, race, cnlevel, edulevel, employstatus,
//         companyname, companystatus, companyregno, industry, designation, salaryrange,
//         lang, block, street, floorno, building, address, postcode, gov_letter, intro,
//         updated_at, source) VALUES ('$ic', '$studentname', 'SSA', 'SSA',
//         'SSA', '$tel', 'SSA', 'SSA', 'SSA', '$dateofbirth', '',
//         '', '$dateofbirth', 'SSA', 'SSA', 'SSA', 'SSA', 'SSA',
//         'SSA', 'SSA', 'SSA', 'SSA', 'SSA', 'SSA',
//         'SSA', 'SSA', 'SSA', 'SSA', 'SSA', 'SSA', '1', 'SSA', 'SSA',
//         now(), '1')") or die('Error: ' . mysqli_error());

//         print "成功输入IC为 ".$ic." 的学员基本信息。";
//         $updateato=mysqli_query($link, "UPDATE ato_info SET status='atoentered' WHERE ic='$ic' AND status!='delete' ")
//               or die ("Could not match data because ".mysqli_error());
//       }
//       else
//       {
//         $dateofbirth=date('Y-m-d',mktime(0,0,0,1,1,2038));
//         $sql=mysqli_query($link, "UPDATE student_info SET name='$studentname', surname='SSA',
//         givename='SSA', othername='SSA', tel='$tel', tel_home='SSA', 
//         gender='SSA', salutation='SSA', dateofbirth='$dateofbirth', idtype='SSA',
//         citizenship='SSA', expirydate='$dateofbirth', nationality='SSA', 
//         race='SSA', cnlevel='SSA', edulevel='SSA', employstatus='SSA',
//         companyname='SSA', companystatus='SSA', companyregno='SSA', 
//         industry='SSA', designation='SSA', salaryrange='SSA',
//         lang='SSA', block='SSA', street='SSA', floorno='SSA', building='SSA', 
//         address='SSA', postcode='1', gov_letter='SSA', intro='SSA', 
//         updated_at=now(), status='A', source='1' WHERE ic='$ic'")
//         or die('Error: ' . mysqli_error());
//         print "成功更新IC为 ".$ic." 的学员基本信息。";
//       }
//     }
//   }
//   else
//   {
//     print "<B>输入错误:</B>";

//     $error_hash = $validator->GetErrors();
//     foreach($error_hash as $inpname => $inp_err)
//     {
//         print "<p>$inpname : $inp_err</p>\n";
//     }
//   }
// }
if($_POST['SSA']=='2') 
{
  $_POST['ic']=trim($_POST['ic']);
  $_POST['tel']=trim($_POST['tel']);
  $_POST['postcode']=trim($_POST['postcode']);
  $validator = new FormValidator();
  $validator->addValidation("ic","req","请输入学员ic");
  $validator->addValidation("ic","minlen=9","学员ic应该是9位");
  $validator->addValidation("ic","maxlen=9","学员ic应该是9位");
  $validator->addValidation("idtype","dontselect=0","请选择学员ic类型");
  $validator->addValidation("surname","req","请输入学员姓氏");
  $validator->addValidation("givename","req","请输入学员名字");
  $validator->addValidation("studentname","req","请输入学员姓名");
  $validator->addValidation("tel","req","请输入学员电话");
  $validator->addValidation("tel","num","学员电话应该是数字");
  $validator->addValidation("tel","minlen=8","学员电话应该是8位数字");
  $validator->addValidation("tel","maxlen=8","学员电话应该是8位数字");
  $validator->addValidation("gender","dontselect=0","请选择学员性别");
  $validator->addValidation("salutation","dontselect=请选择","请选择学员称呼");
  // $validator->addValidation("dobyear","dontselect=请选择","请选择学员出生年份");
  // $validator->addValidation("dobmonth","dontselect=请选择","请选择学员出生月份");
  // $validator->addValidation("dobday","dontselect=请选择","请选择学员出生日期");
  $validator->addValidation("dobyear","req","请输入学员出生年份");
  $validator->addValidation("dobmonth","req","请输入学员出生月份");
  $validator->addValidation("dobday","req","请输入学员出生日期");
  $validator->addValidation("block","req","请输入学员住址大牌号，如果没有填00");
  $validator->addValidation("street","req","请输入学员住址街道名，如果没有填NA");
  $validator->addValidation("floorno1","req","请输入学员住址楼层号，如果没有填00");
  $validator->addValidation("floorno2","req","请输入学员住址门牌号，如果没有填000");
  $validator->addValidation("building","req","请输入学员住址建筑名或地名，如果没有填NA");
  // $validator->addValidation("address","req","请输入学员住址全部信息");
  $validator->addValidation("postcode","req","请输入学员邮编");
  $validator->addValidation("postcode","num","学员邮编应该是数字");
  $validator->addValidation("postcode","minlen=6","学员邮编应该是6位数字");
  $validator->addValidation("postcode","maxlen=6","学员邮编应该是6位数字");
  $validator->addValidation("citizenship","dontselect=0","请选择学员准证类型");
  $validator->addValidation("nationality","dontselect=0","请选择学员国籍");
  $validator->addValidation("race","dontselect=0","请选择学员种族");
  $validator->addValidation("lang","dontselect=0","请选择学员所用语言");
  $validator->addValidation("cnlevel","dontselect=0","请选择学员华文最高学历");
  $validator->addValidation("edulevel","dontselect=0","请选择学员最高教育程度");
  $validator->addValidation("employstatus","dontselect=0","请选择学员就业情况");
  $validator->addValidation("salaryrange","dontselect=请选择","请选择学员薪水范围");
  $validator->addValidation("gov_letter","dontselect=0","请选择学员有没有政府信");
  if($validator->ValidateForm())
  {
    $ic=mysqli_real_escape_string($link, trim($_POST['ic']));
    $icArray=str_split($ic);
    include("ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      print "你的学员IC输错了吧，格式不对呀。";
    }
    elseif (!is_numeric($_POST['dobyear'])||
      ($_POST['dobyear']<1900)||($_POST['dobyear']>2010)) 
    {
      print "你的学员出生年份格式不对。出生年份应该是四位数。";
    }
    elseif (!is_numeric($_POST['dobmonth'])||
      ($_POST['dobmonth']<1)||($_POST['dobmonth']>12)) 
    {
      print "你的学员出生月份格式不对。出生月份应该大于0小于13。";
    }
    elseif (!is_numeric($_POST['dobday'])||
      ($_POST['dobday']<1)||($_POST['dobday']>31)) 
    {
      print "你的学员出生日期格式不对。出生日期应该大于0小于31。";
    }
    else
    {
      print "<h2>输入有效</h2>";
      $idtype=$_POST['idtype'];
      $gender=$_POST['gender'];
      $surname=strtoupper(mysqli_real_escape_string($link, trim($_POST['surname'])));
      $givename=strtoupper(mysqli_real_escape_string($link, trim($_POST['givename'])));
      $studentname=strtoupper(mysqli_real_escape_string($link, trim($_POST['studentname'])));
      $othername=isset($_POST['othername'])?
      strtoupper(mysqli_real_escape_string($link, trim($_POST['othername']))):"";
      $tel=mysqli_real_escape_string($link, trim($_POST['tel']));
      $tel_home=isset($_POST['tel_home'])?
      mysqli_real_escape_string($link, trim($_POST['tel_home'])):"";
      $salutation=$_POST['salutation'];
      $dateofbirth=date('Y-m-d',
        mktime(0,0,0,$_POST['dobmonth'],$_POST['dobday'],$_POST['dobyear']));
      // print $_POST['dobyear'].' '.$_POST['dobmonth'].' '.$_POST['dobday'].'<br>';
      // print $dateofbirth;
      $block=mysqli_real_escape_string($link, trim($_POST['block']));
      $street=mysqli_real_escape_string($link, trim($_POST['street']));
      $floorno1=mysqli_real_escape_string($link, trim($_POST['floorno1']));
      $floorno2=mysqli_real_escape_string($link, trim($_POST['floorno2']));
      $floorno='#'.$floorno1.'-'.$floorno2;
      $building=strtoupper(mysqli_real_escape_string($link, trim($_POST['building'])));
      $postcode=mysqli_real_escape_string($link, trim($_POST['postcode']));
      $address=isset($_POST['address'])?
      mysqli_real_escape_string($link, trim($_POST['address'])):
      ('BLK'.$block.' '.$street.' '.$floorno.' '.$building);
      $citizenship=$_POST['citizenship'];
      //$expirydate=date("Y-m-d",mktime(0,0,0,1,1,2038));
      $expirydate=date("Y-m-d",mktime(0,0,0,1,1,2038));
      if(!empty($_POST['expiremonth'])&&!empty($_POST['expireday'])
        &&!empty($_POST['expireyear']))
      {
        //print $_POST['expireyear'].' '.$_POST['expiremonth'].' '.$_POST['expirydate'];
        $expirydate=date("Y-m-d",
        mktime(0,0,0,$_POST['expiremonth'],$_POST['expireday'],$_POST['expireyear']));
      }
      $nationality=$_POST['nationality'];
      if($citizenship=='SG'&&$nationality!='SG')
      {
        print "你的国籍或者准证类型选择有误，拿新加坡公民准证的国籍应该是新加坡！";
        return;
      }
      if($citizenship!='SG'&&$nationality=='SG')
      {
        print "你的国籍或者准证类型选择有误，拿非新加坡公民准证的国籍应该不能是新加坡！";
        return;
      }
      $race=$_POST['race'];
      $lang=$_POST['lang'];
      $cnlevel=$_POST['cnlevel'];
      $edulevel=$_POST['edulevel'];
      $gov_letter=$_POST['gov_letter'];
      $employstatus=$_POST['employstatus'];
      $companyname=isset($_POST['companyname'])?
      strtoupper(mysqli_real_escape_string($link, trim($_POST['companyname']))):"";
      $companystatus=(!empty($_POST['companystatus']))?
      $_POST['companystatus']:"";
      $companyregno=isset($_POST['companyregno'])?
      strtoupper(mysqli_real_escape_string($link, trim($_POST['companyregno']))):"";
      $industry=(!empty($_POST['industry']))?$_POST['industry']:"";
      $designation=(!empty($_POST['designation']))?$_POST['designation']:"";
      $salaryrange=$_POST['salaryrange'];
      if(($employstatus=='EMP002'&&$salaryrange!='00')||
        ($employstatus=='EMP001'&&$salaryrange=='00'))
      {
        print "你的就业情况和薪水范围有冲突！";
        return;
      }
      $intro=isset($_POST['intro'])?mysqli_real_escape_string($link, trim($_POST['intro'])):"";
      $availabletime=
      (isset($_POST['availabletime1'])?'1':'').
      (isset($_POST['availabletime2'])?'2':'').
      (isset($_POST['availabletime3'])?'3':'').
      (isset($_POST['availabletime4'])?'4':'').
      (isset($_POST['availabletime5'])?'5':'').
      (isset($_POST['availabletime6'])?'6':'').
      (isset($_POST['availabletime7'])?'7':'');
      $branch=$_POST['hiddenbranch'];
      $branchop=$_POST['hiddenbranchop'];
      $match = mysqli_query($link, "SELECT ic FROM student_info WHERE ic='$ic'")
      or die ("Could not match data because ".mysqli_error());
      $num_rows = mysqli_num_rows($match);
      if ($num_rows<1) 
      {
        $sql=mysqli_query($link, "INSERT INTO student_info (ic, name, surname, givename,
          othername, tel, tel_home, gender, salutation, dateofbirth, idtype,
          citizenship, expirydate, nationality, race, cnlevel, edulevel, employstatus,
          companyname, companystatus, companyregno, industry, designation, salaryrange,
          lang, block, street, floorno, building, address, postcode, gov_letter, intro,
          updated_at, source, availabletime) VALUES ('$ic', '$studentname', '$surname', '$givename',
          '$othername', '$tel', '$tel_home', '$gender', '$salutation', '$dateofbirth', '$idtype',
          '$citizenship', '$expirydate', '$nationality', '$race', '$cnlevel', '$edulevel', '$employstatus',
          '$companyname', '$companystatus', '$companyregno', '$industry', '$designation', '$salaryrange',
          '$lang', '$block', '$street', '$floorno', '$building', '$address', '$postcode', '$gov_letter', '$intro',
          now(),'2', '$availabletime')") or die('Error: ' . mysqli_error());

        print "成功输入IC为 ".$ic." 的学员基本信息。";
      }
      else
      {
        $sql=mysqli_query($link, "UPDATE student_info SET name='$studentname', surname='$surname',
        givename='$givename', othername='$othername', tel='$tel', tel_home='$tel_home', 
        gender='$gender', salutation='$salutation', dateofbirth='$dateofbirth', idtype='$idtype',
        citizenship='$citizenship', expirydate='$expirydate', nationality='$nationality', 
        race='$race', cnlevel='$cnlevel', edulevel='$edulevel', employstatus='$employstatus',
        companyname='$companyname', companystatus='$companystatus', companyregno='$companyregno', 
        industry='$industry', designation='$designation', salaryrange='$salaryrange',
        lang='$lang', block='$block', street='$street', floorno='$floorno', building='$building', 
        address='$address', postcode='$postcode', gov_letter='$gov_letter', intro='$intro', 
        updated_at=now(), status='A', source='2', availabletime='$availabletime' WHERE ic='$ic'") 
        or die('Error: ' . mysqli_error());
        print "成功更新IC为 ".$ic." 的学员基本信息。";
      }
      $checkrecord=mysqli_query($link, "SELECT * FROM student_record 
        WHERE ic='$ic' AND status!='delete'")
      or die ("Could not match data because ".mysqli_error());
      $numrecord = mysqli_num_rows($checkrecord);
      if($numrecord>0)
      {
        $sql=mysqli_query($link, "UPDATE student_record SET availabletime='$availabletime' WHERE ic='$ic'")
        or die ("Could not match data because ".mysqli_error());
      }
      else
      {
        $sql=mysqli_query($link, "INSERT INTO student_record (name, ic, tel, 
          branch, branchop, availabletime) VALUES ('$studentname', '$ic', '$tel', 
          '$branch', '$branchop', '$availabletime')")
        or die ("Could not match data because ".mysqli_error());
      }
      $updateato=mysqli_query($link, "UPDATE ato_info SET status='atoentered' WHERE ic='$ic' AND status!='delete' ")
              or die ("Could not match data because ".mysqli_error());
      $_POST['regic']=$ic;
      // print "<script>javascript:window.open('includes/getall.php?id=".$ic."', target='_blank')</script>";
    }
  }
  else
  {
      print "<B>输入错误:</B>";

      $error_hash = $validator->GetErrors();
      foreach($error_hash as $inpname => $inp_err)
      {
          print "<p>$inpname : $inp_err</p>\n";
      }
  }//else
}
else
{
  $_POST['ic']=trim($_POST['ic']);
  $_POST['studentname']=trim($_POST['studentname']);
  $validator = new FormValidator();
  $validator->addValidation("ic","req","请输入学员ic");
  $validator->addValidation("ic","minlen=9","学员ic应该是9位");
  $validator->addValidation("ic","maxlen=9","学员ic应该是9位");
  $validator->addValidation("studentname","req","请输入学员姓名");
  if($validator->ValidateForm())
  {
    $ic=mysqli_real_escape_string($link, $_POST['ic']);
    $icArray=str_split($ic);
    include("ic.php");
    if ($icArray[8]!=$theAlpha) 
    {
      print "你的学员IC输错了吧，格式不对呀。";
    }
    else
    {
      print "<h2>输入有效</h2>";
      $source=$_POST['SSA'];
      $idtype=(isset($_POST['idtype']))?
      mysqli_real_escape_string($link, $_POST['idtype']):' ';
      $gender=(isset($_POST['gender']))?
      mysqli_real_escape_string($link, $_POST['gender']):' ';
      $tel=(isset($_POST['tel']))?
      mysqli_real_escape_string($link, $_POST['tel']):' ';
      $surname=(isset($_POST['surname']))?
      mysqli_real_escape_string($link, $_POST['surname']):' ';
      $givename=(isset($_POST['givename']))?
      mysqli_real_escape_string($link, $_POST['givename']):' ';

      $studentname=mysqli_real_escape_string($link, $_POST['studentname']);
      $othername=(isset($_POST['othername']))?
      mysqli_real_escape_string($link, $_POST['othername']):' ';
      $tel_home=(isset($_POST['tel_home']))?
      mysqli_real_escape_string($link, $_POST['tel_home']):' ';
      $salutation=(isset($_POST['salutation']))?$_POST['salutation']:' ';
      if(!empty($_POST['dobmonth'])&&!empty($_POST['dobday'])&&!empty($_POST['dobyear']))
      {
        $dateofbirth=date('Y-m-d',
        mktime(0,0,0,$_POST['dobmonth'],$_POST['dobday'],$_POST['dobyear']));
      }
      else
      {
        $dateofbirth=date('Y-m-d',mktime(0,0,0,1,1,2038));
      }
      $block=(isset($_POST['block']))?
      mysqli_real_escape_string($link, $_POST['block']):'00';
      $street=(isset($_POST['street']))?
      mysqli_real_escape_string($link, $_POST['street']):'NA';
      $block=(isset($_POST['block']))?
      mysqli_real_escape_string($link, $_POST['block']):'00';
      $floorno1=(isset($_POST['floorno1']))?
      mysqli_real_escape_string($link, $_POST['floorno1']):'00';
      $floorno2=(isset($_POST['floorno2']))?
      mysqli_real_escape_string($link, $_POST['floorno2']):'000';
      $floorno='#'.$floorno1.'-'.$floorno2;
      $building=(isset($_POST['building']))?
      strtoupper(mysqli_real_escape_string($link, $_POST['building'])):'NA';
      $postcode=(isset($_POST['postcode']))?
      mysqli_real_escape_string($link, $_POST['postcode']):'0';
      $address=isset($_POST['address'])?
      mysqli_real_escape_string($link, trim($_POST['address'])):
      ('BLK'.$block.' '.$street.' '.$floorno.' '.$building);
      $citizenship=(isset($_POST['citizenship']))?
      mysqli_real_escape_string($link, $_POST['citizenship']):' ';
      $expirydate=date("Y-m-d",mktime(0,0,0,1,1,2038));
      if(!empty($_POST['expiremonth'])&&!empty($_POST['expireday'])
        &&!empty($_POST['expireyear']))
      {
        //print $_POST['expireyear'].' '.$_POST['expiremonth'].' '.$_POST['expirydate'];
        $expirydate=date("Y-m-d",
        mktime(0,0,0,$_POST['expiremonth'],$_POST['expireday'],$_POST['expireyear']));
      }
      $nationality=(isset($_POST['nationality']))?
      mysqli_real_escape_string($link, $_POST['nationality']):' ';
      $race=(isset($_POST['race']))?
      mysqli_real_escape_string($link, $_POST['race']):' ';
      $lang=(isset($_POST['lang']))?
      mysqli_real_escape_string($link, $_POST['lang']):' ';
      $cnlevel=(isset($_POST['cnlevel']))?
      mysqli_real_escape_string($link, $_POST['cnlevel']):' ';
      $edulevel=(isset($_POST['edulevel']))?
      mysqli_real_escape_string($link, $_POST['edulevel']):' ';
      $gov_letter=(isset($_POST['gov_letter']))?
      mysqli_real_escape_string($link, $_POST['gov_letter']):' ';
      $employstatus=(isset($_POST['employstatus']))?
      mysqli_real_escape_string($link, $_POST['employstatus']):' ';
      $companyname=isset($_POST['companyname'])?
      strtoupper(mysqli_real_escape_string($link, trim($_POST['companyname']))):"";
      $companystatus=(!empty($_POST['companystatus']))?
      $_POST['companystatus']:"";
      $companyregno=isset($_POST['companyregno'])?
      strtoupper(mysqli_real_escape_string($link, trim($_POST['companyregno']))):"";
      $industry=(!empty($_POST['industry']))?$_POST['industry']:"";
      $designation=(!empty($_POST['designation']))?$_POST['designation']:"";
      $salaryrange=(isset($_POST['salaryrange']))?
      mysqli_real_escape_string($link, $_POST['salaryrange']):' ';
      // $_POST['intro']=str_replace("'","",trim($_POST['intro']));
      $intro=isset($_POST['intro'])?mysqli_real_escape_string($link, $_POST['intro']):"";
      $availabletime=
      (isset($_POST['availabletime1'])?'1':'').
      (isset($_POST['availabletime2'])?'2':'').
      (isset($_POST['availabletime3'])?'3':'').
      (isset($_POST['availabletime4'])?'4':'').
      (isset($_POST['availabletime5'])?'5':'').
      (isset($_POST['availabletime6'])?'6':'').
      (isset($_POST['availabletime7'])?'7':'');
      // print $intro;
      // print $_POST['availabletime'];
      // print $availabletime.'<br />';
      if($_POST['SSA']=='1')
      {
        $surname='SSA';
        $givename='SSA';
        $address='SSA';
      }
      $match = mysqli_query($link, "SELECT * FROM student_info WHERE ic='$ic'")
      or die ("Could not match data because ".mysqli_error());
      $num_rows = mysqli_num_rows($match);
      if ($num_rows<1) 
      {
        $sql=mysqli_query($link, "INSERT INTO student_info (ic, name, surname, givename,
          othername, tel, tel_home, gender, salutation, dateofbirth, idtype,
          citizenship, expirydate, nationality, race, cnlevel, edulevel, employstatus,
          companyname, companystatus, companyregno, industry, designation, salaryrange,
          lang, block, street, floorno, building, address, postcode, gov_letter, intro,
          updated_at, source, availabletime) VALUES ('$ic', '$studentname', '$surname', '$givename',
          '$othername', '$tel', '$tel_home', '$gender', '$salutation', '$dateofbirth', '$idtype',
          '$citizenship', '$expirydate', '$nationality', '$race', '$cnlevel', '$edulevel', '$employstatus',
          '$companyname', '$companystatus', '$companyregno', '$industry', '$designation', '$salaryrange',
          '$lang', '$block', '$street', '$floorno', '$building', '$address', '$postcode', '$gov_letter', '$intro',
          now(),'3','$availabletime')") or die('Error: ' . mysqli_error());
        
        print "成功输入IC为 ".$ic." 的学员基本信息。";
        $updateato=mysqli_query($link, "UPDATE ato_info SET status='atoentered' WHERE ic='$ic' AND status!='delete' ")
              or die ("Could not match data because ".mysqli_error());
      }
      else
      {
        $sql=mysqli_query($link, "UPDATE student_info SET name='$studentname', surname='$surname',
        givename='$givename', othername='$othername', tel='$tel', tel_home='$tel_home', 
        gender='$gender', salutation='$salutation', dateofbirth='$dateofbirth', idtype='$idtype',
        citizenship='$citizenship', expirydate='$expirydate', nationality='$nationality', 
        race='$race', cnlevel='$cnlevel', edulevel='$edulevel', employstatus='$employstatus',
        companyname='$companyname', companystatus='$companystatus', companyregno='$companyregno', 
        industry='$industry', designation='$designation', salaryrange='$salaryrange',
        lang='$lang', block='$block', street='$street', floorno='$floorno', building='$building', 
        address='$address', postcode='$postcode', gov_letter='$gov_letter', intro='$intro', 
        updated_at=now(), status='A', source='3', availabletime='$availabletime' WHERE ic='$ic'") 
        or die('Error: ' . mysqli_error());
        print "成功更新IC为 ".$ic." 的学员基本信息。";
        // print $_POST['availabletime'];

        // print $_POST['availabletime'].'<br />';
      }
    }
  }
}
?>