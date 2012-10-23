<div id="inputatoinfo">
  <center><h1>更新学员ato信息</h1></center>
  <p>*为必填内容。此处只用来更新ato信息。对于pre cat 学员，
    请先在考试管理中订座位。对于post cat学员，请先在班级管理中
    将班级状态改为待考试。要更新ato信息，请在学员检索中找到学员的
    ato id, 点搜索, 然后输入更新的信息，最后点输入。
    <br></p></p>
  <p>
  <form action="studentmp.php" method="post" id="inputato">
    atoid：<input type="text" name="atoid" class="inputid" 
    value="<?php if (isset($_POST['atoid'])) {print stripslashes($_POST['atoid']);} ?>">
    <input type="submit" name="searchatoic" value="搜索">
    学员IC*：<input type="text" id="atoic" name="atoic" value="<?php if (isset($_POST['atoic'])) {
          print stripslashes($_POST['atoic']);}else {
            print isset($_POST['ic'])?$_POST['ic']:
            (isset($_POST['regic'])?$_POST['regic']:
            (isset($_POST['receiptic'])?$_POST['receiptic']:""));} ?>">
    <input type="button" id="searchallato" name="searchallato" value="搜索已有ato"><br>
    考试类型*：<select name="prepost">
    <option>请选择</option>
    <option value="PRE" <?php if(isset($_POST['prepost']))
  {echo ($_POST['prepost'] == 'PRE')?"selected":"";}?>>PRE CAT</option>
    <option value="POST" <?php if(isset($_POST['prepost']))
  {echo ($_POST['prepost'] == 'POST')?"selected":"";}?>>POST CAT</option>
    </select>
    推荐等级*：<select name="recommend" >
                <option>请选择</option>
                <option value="Waiting for the result" <?php if(isset($_POST['recommend']))
  {echo ($_POST['recommend'] == 'Waiting for the result')?"selected":"";}?>>PRE CAT等成绩</option>
                <option value="BEGINNERS" <?php if(isset($_POST['recommend']))
  {echo ($_POST['recommend'] == 'BEGINNERS')?"selected":"";}?>>初级</option>
                <option value="INTERMEDIATE" <?php if(isset($_POST['recommend']))
  {echo ($_POST['recommend'] == 'INTERMEDIATE')?"selected":"";}?>>中级</option>
                <option value="ADVANCED" <?php if(isset($_POST['recommend']))
  {echo ($_POST['recommend'] == 'ADVANCED')?"selected":"";}?>>高级</option>
                </select><br>
    课程开始日期*: <input type="text" id="datepicker4" name="start_date" 
    value="<?php if (isset($_POST['start_date'])) {
          print stripslashes($_POST['start_date']);}else {print "";} ?>">
    课程截止日期*: <input type="text" id="datepicker5" name="end_date" 
    value="<?php if (isset($_POST['end_date'])) {
          print stripslashes($_POST['end_date']);}else {print "";} ?>"><br>
    班级代码*: <input type="text" name="coursecode" value="<?php if (isset($_POST['coursecode'])) {
          print stripslashes($_POST['coursecode']);}else {print "";} ?>">
    出勤率*: <input type="text" name="attendance" value="<?php if (isset($_POST['attendance'])) {
          print stripslashes($_POST['attendance']);}else {print "";} ?>"><br>
    考试科目*：<br><br>
    听力EL<select name="EL"><option>请选择</option>
    <option value="Y" <?php if(isset($_POST['EL']))
    {echo ($_POST['EL'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EL']))
    {echo ($_POST['EL'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    阅读ER<select name="ER"><option>请选择</option>
    <option value="Y" <?php if(isset($_POST['ER']))
    {echo ($_POST['ER'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ER']))
    {echo ($_POST['ER'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    数学EN<select name="EN"><option>请选择</option>
    <option value="Y" <?php if(isset($_POST['EN']))
    {echo ($_POST['EN'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EN']))
    {echo ($_POST['EN'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    会话ES<select name="ES"><option>请选择</option>
    <option value="Y" <?php if(isset($_POST['ES']))
    {echo ($_POST['ES'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ES']))
    {echo ($_POST['ES'] == 'N')?"selected":"";}?>>NO</option>
    </select>
    写作EW<select name="EW"><option>请选择</option>
    <option value="Y" <?php if(isset($_POST['EW']))
    {echo ($_POST['EW'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EW']))
    {echo ($_POST['EW'] == 'N')?"selected":"";}?>>NO</option>
    </select><br><br>
    考试地点*：<select name="location"><option>请选择</option>
    <option value="JE" <?php if(isset($_POST['location']))
    {echo ($_POST['location'] == 'JE')?"selected":"";}?>>Jurong East</option>
    <option value="UN" <?php if(isset($_POST['location']))
    {echo ($_POST['location'] == 'UN')?"selected":"";}?>>EUNOS</option>
    </select>
    考试日期*: <input type="text" id="datepicker6" name="atodate"
    value="<?php if (isset($_POST['atodate'])) {
          print stripslashes($_POST['atodate']);}else {print "";} ?>">
    考试时间*：<select name="atotime">
              <option>请选择</option>
              <option value="9" <?php if(isset($_POST['atotime']))
  {echo ($_POST['atotime'] == '9')?"selected":"";}?>>上午九点</option>
              <option value="14" <?php if(isset($_POST['atotime']))
  {echo ($_POST['atotime'] == '14')?"selected":"";}?>>下午两点</option>
              <option value="19" <?php if(isset($_POST['atotime']))
  {echo ($_POST['atotime'] == '19')?"selected":"";}?>>晚上七点</option>
              </select><br><br>
    <center>
        
      分部：<select name="branch">
            <option value='0'>Please select</option>
            <option value='changchun'>changchun</option>
            <option value='angmokio'>angmokio</option>
            <option value='bedok'>bedok</option>
            <option value='bishan'>bishan</option>
            <option value='bukitbatok'>bukitbatok</option>
            <option value='hougang'>hougang</option>
            <option value='jurongeast'>jurongeast</option>
            <option value='khatib'>khatib</option>
            <option value='pasirris'>pasirris</option>
            <option value='sembawang'>sembawang</option>
            <option value='sengkang'>sengkang</option>
            <option value='serangoon'>serangoon</option>
            <option value='tampines'>tampines</option>
            <option value='woodlands'>woodlands</option>
            <option value='yishun'>yishun</option>
            </select><br>
      <h2>
        提交：<input type="submit" name="inputato" value="输入">
      </h2>
      <h3>
        ato id：
        <input type="text" name="del_ato"
        value="<?php if (isset($_POST['del_ato'])) {
        print stripslashes($_POST['del_ato']);} ?>">
        <input type="submit" name="delato" value="删除">
      </h3>
    </center>
  </form>
  <center>
    <h1>查看所有ato信息</h1>
      <form action="student.php" method="post">
        起始日期：
        <input type="text" id="datepicker11" name="ato_startdate"
        value="<?php if (isset($_POST['ato_startdate'])) {
        print stripslashes($_POST['ato_startdate']);} else 
        {print date('Y-m-d');} ?>">
        截止日期：
        <input type="text" id="datepicker12" name="ato_enddate"
        value="<?php if (isset($_POST['ato_enddate'])) {
        print stripslashes($_POST['ato_enddate']);} else {print date('Y-m-d', mktime(0, 0, 0, date("m")+2, date("d"), date("Y")));} ?>">
        <input type="submit" name="searchatoinfo" value="搜索">
      </form>
      <?php include('includes/student_searchatoinfo.php'); ?>
      <form action="ato.php" method="post">
        <input type="hidden" name="hiddenato_startdate"
        value="<?php if (isset($_POST['ato_startdate'])) {
        print stripslashes($_POST['ato_startdate']);} else 
        {print date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y")));} ?>">
        <input type="hidden" name="hiddenato_enddate"
        value="<?php if (isset($_POST['ato_enddate'])) {
        print stripslashes($_POST['ato_enddate']);} else {print date('Y-m-d');} ?>">
        <input type="hidden" name="branch" value="<?php echo $_SESSION['branch']; ?>">
        <input type="submit" name="atoexcel" value="生成excel">
      </form>

      <?php
      $show_generate=false;
      if ($_SESSION['role']<3)
      {
        $show_generate=true;
      }
      if(true == $show_generate)
      {
      ?>
      <h1>生成ato</h1>
      <form action="student.php" method="post">
        考试日期：
        <input type="text" id="datepicker13" name="ato_date"
        value="<?php if (isset($_POST['ato_date'])) {
        print stripslashes($_POST['ato_date']);} else 
        {print date('Y-m-d');} ?>">
        <input type="submit" name="generateato" value="搜索">
      </form>
      <?php include('includes/student_generateato.php'); ?>
      <form action="export.php" method="post">
        <input type="hidden" name="hiddendate" value="<?php if (isset($_POST['ato_date'])) {
        print stripslashes($_POST['ato_date']);} else 
        {print date('Y-m-d');} ?>"> 
        <input type="submit" name="generateexcel" value="生成excel">
      </form>
      <?php } ?>
  </center>
  </p>
</div>