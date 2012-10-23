<div id="inputclass">
  <center>
    <h1>输入班级信息</h1>
  </center>
  如果是新输入班级，请不要填class id; <br>
  如果是已输入班级，需要更新信息请先输入class id, 
  点搜索，再更改信息，然后点输入。<br>
  <b>注意！</b>当班级状态变成待考试时，系统将自动生成所有学员post cat的ato。<br>
  自动生成ato时，默认出勤率是100%，如要修改，请在学员管理中自行修改。<br>
  请大家在把班级变成待考试之前先检查学员名单及其他信息。<br><br>
  
  <form action="class.php" method="post" id="inputclassform">
    班级代码：
    <input type="text" name="coursecode" 
    value="<?php if (isset($_POST['coursecode'])) 
    {print stripslashes($_POST['coursecode']);}else {print "";} ?>">
    class id：<input type="text" name="classid" class="inputid" 
    value="<?php if (isset($_POST['classid'])) {print stripslashes($_POST['classid']);} 
    elseif(isset($_GET['classid'])&&$_GET['classid']!='') {print $_GET['classid'];} ?>">
    <input type="submit" name="searchclass" value="搜索"><br>
    类型*:
    <select name="classtype">
        <option value="0">请选择</option>
        <option value="encmp" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'encmp')?"selected":"";}?>>综合</option>
        <option value="encon" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'encon')?"selected":"";}?>>会话</option>
        <option value="eness" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'eness')?"selected":"";}?>>ESS</option>
		    <option value="encos" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encos')?"selected":"";}?>>COS</option>
        <option value="encom" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'encom')?"selected":"";}?>>英文电脑</option>
        <option value="chcom" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'chcom')?"selected":"";}?>>华文电脑</option>
        <option value="chpin" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'chpin')?"selected":"";}?>>拼音</option>
        <option value="enpho" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'enpho')?"selected":"";}?>>音标</option>
        <option value="engra" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'engra')?"selected":"";}?>>语法</option>
        <option value="chwri" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'chwri')?"selected":"";}?>>华文作文</option>
        <option value="others" <?php if(isset($_POST['classtype']))
        {echo ($_POST['classtype'] == 'others')?"selected":"";}?>>其他</option>
      </select>
    等级*:
    <select name="classlevel">
      <option value="0">请选择</option>
      <option value="BEGINNERS" <?php if(isset($_POST['classlevel']))
      {echo ($_POST['classlevel'] == 'BEGINNERS')?"selected":"";}?>>初级</option>
      <option value="INTERMEDIATE" <?php if(isset($_POST['classlevel']))
      {echo ($_POST['classlevel'] == 'INTERMEDIATE')?"selected":"";}?>>中级</option>
      <option value="ADVANCED" <?php if(isset($_POST['classlevel']))
      {echo ($_POST['classlevel'] == 'ADVANCED')?"selected":"";}?>>高级</option>
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
    上课地点：
    <input type="text" name="location"
      value="<?php if (isset($_POST['location'])) {
      print stripslashes($_POST['location']);} else 
      {print $_SESSION['branch'];} ?>"><br>
    开课日期：
    <input type="text" id="datepicker1" name="class_startdate"
      value="<?php if (isset($_POST['class_startdate'])) {
      print stripslashes($_POST['class_startdate']);} else 
      {print '';} ?>">
    结课日期：
    <input type="text" id="datepicker2" name="class_endate"
      value="<?php if (isset($_POST['class_endate'])) {
      print stripslashes($_POST['class_endate']);} else 
      {print '';} ?>"><br>
    上课时间：(请按照0000-2359的格式)
    <input type="text" name="class_startime" value="<?php if (isset($_POST['class_startime'])) 
    {print stripslashes($_POST['class_startime']);}else {print "";} ?>">
    下课时间：
    <input type="text" name="class_endtime" value="<?php if (isset($_POST['class_endtime'])) 
    {print stripslashes($_POST['class_endtime']);}else {print "";} ?>"><br>
    课程老师：
    <input type="text" name="teacher" value="<?php if (isset($_POST['teacher'])) 
    {print stripslashes($_POST['teacher']);}else {print "";} ?>">
    老师电话：
    <input type="text" name="teacher_tel" value="<?php if (isset($_POST['teacher_tel'])) 
    {print stripslashes($_POST['teacher_tel']);}else {print "";} ?>"><br>
    <br>考试科目1(如果是会话，请在此处选)*：<br><br>
    听力EL1<select name="EL1"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EL1']))
    {echo ($_POST['EL1'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EL1']))
    {echo ($_POST['EL1'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    阅读ER1<select name="ER1"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ER1']))
    {echo ($_POST['ER1'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ER1']))
    {echo ($_POST['ER1'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    数学EN1<select name="EN1"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EN1']))
    {echo ($_POST['EN1'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EN1']))
    {echo ($_POST['EN1'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    会话ES1<select name="ES1"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ES1']))
    {echo ($_POST['ES1'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ES1']))
    {echo ($_POST['ES1'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    写作EW1<select name="EW1"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EW1']))
    {echo ($_POST['EW1'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EW1']))
    {echo ($_POST['EW1'] == 'N')?"selected":"";}?>>NO</option>
    </select><br><br>
    日期: <input type="text" id="datepicker3" name="lrdate"
    value="<?php if (isset($_POST['lrdate'])) {
      print stripslashes($_POST['lrdate']);}else {print "";} ?>">
    时间：
    <select name="lrtime">
      <option value="0">请选择</option>
      <option value="9" <?php if(isset($_POST['lrtime']))
      {echo ($_POST['lrtime'] == '9')?"selected":"";}?>>上午九点</option>
      <option value="14" <?php if(isset($_POST['lrtime']))
      {echo ($_POST['lrtime'] == '14')?"selected":"";}?>>下午两点</option>
      <option value="19" <?php if(isset($_POST['lrtime']))
      {echo ($_POST['lrtime'] == '19')?"selected":"";}?>>晚上七点</option>
    </select>
    考试地点：
    <select name="lrlocation">
      <option value="0">请选择</option>
      <option value="JE" <?php if(isset($_POST['lrlocation']))
      {echo ($_POST['lrlocation'] == 'JE')?"selected":"";}?>>Jurong East</option>
      <option value="UN" <?php if(isset($_POST['lrlocation']))
      {echo ($_POST['lrlocation'] == 'UN')?"selected":"";}?>>EUNOS</option>
    </select><br>
      <br>考试科目2*：<br><br>
    听力EL2<select name="EL2"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EL2']))
    {echo ($_POST['EL2'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EL2']))
    {echo ($_POST['EL2'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    阅读ER2<select name="ER2"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ER2']))
    {echo ($_POST['ER2'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ER2']))
    {echo ($_POST['ER2'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    数学EN2<select name="EN2"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EN2']))
    {echo ($_POST['EN2'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EN2']))
    {echo ($_POST['EN2'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    会话ES2<select name="ES2"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ES2']))
    {echo ($_POST['ES2'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ES2']))
    {echo ($_POST['ES2'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    写作EW2<select name="EW2"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EW2']))
    {echo ($_POST['EW2'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EW2']))
    {echo ($_POST['EW2'] == 'N')?"selected":"";}?>>NO</option>
    </select><br><br>
    日期: <input type="text" id="datepicker4" name="swdate"
    value="<?php if (isset($_POST['swdate'])) {
      print stripslashes($_POST['swdate']);}else {print "";} ?>">
    时间：
    <select name="swtime">
      <option value="0">请选择</option>
      <option value="9" <?php if(isset($_POST['swtime']))
      {echo ($_POST['swtime'] == '9')?"selected":"";}?>>上午九点</option>
      <option value="14" <?php if(isset($_POST['swtime']))
      {echo ($_POST['swtime'] == '14')?"selected":"";}?>>下午两点</option>
      <option value="19" <?php if(isset($_POST['swtime']))
      {echo ($_POST['swtime'] == '19')?"selected":"";}?>>晚上七点</option>
    </select>
    考试地点：
    <select name="swlocation">
      <option value="0">请选择</option>
      <option value="JE" <?php if(isset($_POST['swlocation']))
      {echo ($_POST['swlocation'] == 'JE')?"selected":"";}?>>Jurong East</option>
      <option value="UN" <?php if(isset($_POST['swlocation']))
      {echo ($_POST['swlocation'] == 'UN')?"selected":"";}?>>EUNOS</option>
    </select><br>
    备注(可以写星期几上课，哪天没课。):<br>
    <input type="text" name="remarks" class="longtext"
      value="<?php if (isset($_POST['remarks'])) 
      {print trim($_POST['remarks']);}else {print "";} ?>">
    <br>
    <center>
    <h2>
      提交：<input type="submit" name="inputclass" value="输入">
    </h2>
    </center>
  </form>
</div>