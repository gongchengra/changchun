<div id="showclasses">
  <center>
    <h1>所有已输入班级</h1>
  </center>
  <?php 
  include("includes/conn.php");
  include("includes/link.php");
  $branch=$_SESSION['branch'];
  $showclasses=mysql_query("SELECT * FROM class_info 
    WHERE (branch='$branch' OR '$branch'='changchun')
    AND status!='delete' ORDER BY classid DESC")
    or die ("Could not match data because ".mysql_error());
  $num_classes = mysql_num_rows($showclasses);
  if ($num_classes < 1) 
  {
    echo "加油啊，你还一个班都没有呢！";
  }
  else
  {
    print "<table class=\"classtable\">";
    print "<tr><th>class id</th><th>课程代码</th><th>类型</th>
            <th>等级</th><th>状态</th><th>开课日期</th><th>结课日期</th><th>上课时间</th>
            </tr>";
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
      $getclass['class_startdate']=($getclass['class_startdate']!='2038-01-01')?
      date('Y-m-d',strtotime($getclass['class_startdate'])):'';
      $getclass['class_endate']=($getclass['class_endate']!='2038-01-01')?
      date('Y-m-d',strtotime($getclass['class_endate'])):'';
      print "<tr><td><a href='class.php?classid=$getclass[classid]#tabs-2'>$getclass[classid]</a>
      &nbsp</td><td>$getclass[coursecode]&nbsp</td><td>$getclass[classtype]&nbsp</td>
      <td>$getclass[classlevel]&nbsp</td><td>$getclass[finish]&nbsp</td>
      <td>$getclass[class_startdate]&nbsp</td><td>$getclass[class_endate]&nbsp</td>
      <td>$getclass[class_startime]&nbsp</td></tr>";
    }
    print "</table>";
  }
  ?>
</div>