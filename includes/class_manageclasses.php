<div id="manageclasses">
  <center>
    <h1>检索班级</h1>
  </center>
  <form action="class.php" method="post">
    类型*:
    <select name="type">
    <option value="0">请选择</option>
    <option value="CMP" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'CMP')?"selected":"";}?>>综合</option>
    <option value="CON" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'CON')?"selected":"";}?>>会话</option>
    <option value="WRI" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'WRI')?"selected":"";}?>>写作</option>
    <option value="WPN" <?php if(isset($_POST['type']))
    {echo ($_POST['type'] == 'WPN')?"selected":"";}?>>数学</option>
    </select>
    等级*:
    <select name="level">
      <option value="0">请选择</option>
      <option value="BEGINNERS" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'BEGINNERS')?"selected":"";}?>>初级</option>
      <option value="INTERMEDIATE" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'INTERMEDIATE')?"selected":"";}?>>中级</option>
      <option value="ADVANCED" <?php if(isset($_POST['level']))
      {echo ($_POST['level'] == 'ADVANCED')?"selected":"";}?>>高级</option>
    </select>
    状态*:
    <select name="finish">
      <option value="0">请选择</option>
      <option value="preparing" <?php if(isset($_POST['finish']))
      {echo ($_POST['finish'] == 'preparing')?"selected":"";}?>>未开班</option>
      <option value="learning" <?php if(isset($_POST['finish']))
      {echo ($_POST['finish'] == 'learning')?"selected":"";}?>>已开班</option>
      <option value="waitexam" <?php if(isset($_POST['finish']))
      {echo ($_POST['finish'] == 'waitexam')?"selected":"";}?>>待考试</option>
      <option value="finished" <?php if(isset($_POST['finish']))
      {echo ($_POST['finish'] == 'finished')?"selected":"";}?>>已结束</option>
    </select>
    分部：
    <select name="branch">
      <option value='0'>Please select</option>
      <option value='changchun' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'changchun')?"selected":"";}?>>changchun</option>
      <option value='angmokio' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'angmokio')?"selected":"";}?>>angmokio</option>
      <option value='bedok' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'bedok')?"selected":"";}?>>bedok</option>
      <option value='bishan' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'bishan')?"selected":"";}?>>bishan</option>
      <option value='bukitbatok' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'bukitbatok')?"selected":"";}?>>bukitbatok</option>
      <option value='hougang' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'hougang')?"selected":"";}?>>hougang</option>
      <option value='jurongeast' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'jurongeast')?"selected":"";}?>>jurongeast</option>
      <option value='khatib' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'khatib')?"selected":"";}?>>khatib</option>
      <option value='pasirris' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'pasirris')?"selected":"";}?>>pasirris</option>
      <option value='sembawang' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'sembawang')?"selected":"";}?>>sembawang</option>
      <option value='sengkang' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'sengkang')?"selected":"";}?>>sengkang</option>
      <option value='serangoon' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'serangoon')?"selected":"";}?>>serangoon</option>
      <option value='tampines' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'tampines')?"selected":"";}?>>tampines</option>
      <option value='woodlands' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'woodlands')?"selected":"";}?>>woodlands</option>
      <option value='yishun' <?php if(isset($_POST['branch']))
      {echo ($_POST['branch'] == 'yishun')?"selected":"";}?>>yishun</option>
    </select>
    <input type="submit" name="searchclass4management" value="搜索">
  </form>
  <?php
  if(isset($_POST['searchclass4management']))
  {
    if(empty($_POST['level'])||empty($_POST['type'])||empty($_POST['finish']))
    {
      echo "请选择班级类型等级和状态";
      echo "<script LANGUAGE='javascript'>document.location.href=
      'class.php#tabs-3'</script>";
      return;
    }
    include("includes/conn.php");
    include("includes/link.php");
    $type=$_POST['type'];
    $level=$_POST['level'];
    $branch=$_POST['branch'];
    $finish=$_POST['finish'];
    if(empty($branch))
    {
      $checkclass=mysql_query("SELECT * FROM class_info where classtype='$type'
        AND classlevel='$level' AND finish='$finish' AND status!='delete' 
        ORDER BY classid DESC")or die ("Could not match data because ".mysql_error());
      $numclass=mysql_num_rows($checkclass);
      if($numclass>0)
      {
        print "<table class=\"classtable\">";
        print "<tr><th>class id</th><th>班级名称</th><th>课程代码</th><th>类型</th>
                <th>等级</th><th>状态</th><th>开课日期</th><th>结课日期</th><th>上课时间</th>
                <th>课程老师</th><th>老师电话</th></tr>";
        $convert = array('CMP' => '综合', 'CON' =>'会话', 'WRI'=>'写作','WPN'=>'数学',
        'BEGINNERS'=>'初级','INTERMEDIATE'=>'中级','ADVANCED'=>'高级','preparing'=>'未开班',
        'learning'=>'已开班','waitexam'=>'待考试','finished'=>'已结束');
        while ($getclass = mysql_fetch_array($checkclass)) 
        {
          $getclass['classtype']=$convert[($getclass['classtype'])];
          $getclass['classlevel']=$convert[($getclass['classlevel'])];
          $getclass['finish']=$convert[($getclass['finish'])];
          print "<tr><td>$getclass[classid]&nbsp</td><td>$getclass[classname]&nbsp</td>
          <td>$getclass[coursecode]&nbsp</td><td>$getclass[classtype]&nbsp</td>
          <td>$getclass[classlevel]&nbsp</td><td>$getclass[finish]&nbsp</td>
          <td>$getclass[class_startdate]&nbsp</td><td>$getclass[class_endate]&nbsp</td>
          <td>$getclass[class_startime]&nbsp</td><td>$getclass[teacher]&nbsp</td>
          <td>$getclass[teacher_tel]&nbsp</td></tr>";
        }
        print "</table>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php#tabs-3'</script>";
      }
      else
      {
        echo "没有符合条件的班级。";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php#tabs-3'</script>";
      }
    }
    else
    {
      $checkclass=mysql_query("SELECT * FROM class_info where classtype='$type'
        AND classlevel='$level' AND finish='$finish' AND branch='$branch' 
        AND status!='delete' ORDER BY classid DESC")
      or die ("Could not match data because ".mysql_error());
      $numclass=mysql_num_rows($checkclass);
      if($numclass>0)
      {
        print "<table class=\"classtable\">";
        print "<tr><th>class id</th><th>班级名称</th><th>课程代码</th><th>类型</th>
                <th>等级</th><th>状态</th><th>开课日期</th><th>结课日期</th><th>上课时间</th>
                <th>课程老师</th><th>老师电话</th></tr>";
        $convert = array('CMP' => '综合', 'CON' =>'会话', 'WRI'=>'写作','WPN'=>'数学',
        'BEGINNERS'=>'初级','INTERMEDIATE'=>'中级','ADVANCED'=>'高级','preparing'=>'未开班',
        'learning'=>'已开班','waitexam'=>'待考试','finished'=>'已结束');
        while ($getclass = mysql_fetch_array($checkclass)) 
        {
          $getclass['classtype']=$convert[($getclass['classtype'])];
          $getclass['classlevel']=$convert[($getclass['classlevel'])];
          $getclass['finish']=$convert[($getclass['finish'])];
          print "<tr><td>$getclass[classid]&nbsp</td><td>$getclass[classname]&nbsp</td>
          <td>$getclass[coursecode]&nbsp</td><td>$getclass[classtype]&nbsp</td>
          <td>$getclass[classlevel]&nbsp</td><td>$getclass[finish]&nbsp</td>
          <td>$getclass[class_startdate]&nbsp</td><td>$getclass[class_endate]&nbsp</td>
          <td>$getclass[class_startime]&nbsp</td><td>$getclass[teacher]&nbsp</td>
          <td>$getclass[teacher_tel]&nbsp</td></tr>";
        }
        print "</table>";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php#tabs-3'</script>";
      }
      else
      {
        echo "没有符合条件的班级。";
        echo "<script LANGUAGE='javascript'>document.location.href=
        'class.php#tabs-3'</script>";
      }
    }
  }
  ?>
  <center>
    <h1>所有班级</h1>
  </center>
  <?php 
  include("includes/conn.php");
  $link = mysql_connect($dbhost, $dbuser, $dbpass)
  or die ("Could not connect to mysql because ".mysql_error());
  // select the database
  mysql_select_db($dbname)
  or die ("Could not select database because ".mysql_error());
  mysql_query("SET NAMES UTF8");
  $branch=$_SESSION['branch'];
  $showclasses=mysql_query("SELECT * FROM class_info 
    WHERE status!='delete' ORDER BY classid DESC")
  or die ("Could not match data because ".mysql_error());
  $num_classes = mysql_num_rows($showclasses);
  if ($num_classes < 1) 
  {
    echo "目前还一个班都没有。";
  }
  else
  {
    print "<table class=\"classtable\">";
    print "<tr><th>class id</th><th>班级名称</th><th>课程代码</th><th>类型</th>
            <th>等级</th><th>状态</th><th>开课日期</th><th>结课日期</th><th>上课时间</th>
            <th>课程老师</th><th>老师电话</th></tr>";
    $convert = array('CMP' => '综合', 'CON' =>'会话', 'WRI'=>'写作','WPN'=>'数学',
    'BEGINNERS'=>'初级','INTERMEDIATE'=>'中级','ADVANCED'=>'高级','preparing'=>'未开班',
    'learning'=>'已开班','waitexam'=>'待考试','finished'=>'已结束', '0'=>'NA',
    'encmp' => '综合','encon' => '会话','eness' => 'ESS','encos' => 'COS','encom' => '英文电脑',
    'chcom' => '华文电脑','chpin' => '拼音','enpho' => '音标','engra' => '语法',
    'chwri' => '华文作文','others' => '其他');
    while ($getclass = mysql_fetch_array($showclasses)) 
    {
      $getclass['classtype']=$convert[($getclass['classtype'])];
      $getclass['classlevel']=$convert[($getclass['classlevel'])];
      $getclass['finish']=$convert[($getclass['finish'])];
      print "<tr><td>$getclass[classid]&nbsp</td><td>$getclass[classname]&nbsp</td>
      <td>$getclass[coursecode]&nbsp</td><td>$getclass[classtype]&nbsp</td>
      <td>$getclass[classlevel]&nbsp</td><td>$getclass[finish]&nbsp</td>
      <td>$getclass[class_startdate]&nbsp</td><td>$getclass[class_endate]&nbsp</td>
      <td>$getclass[class_startime]&nbsp</td><td>$getclass[teacher]&nbsp</td>
      <td>$getclass[teacher_tel]&nbsp</td></tr>";
    }
    print "</table>";
  }
  ?>
</div>