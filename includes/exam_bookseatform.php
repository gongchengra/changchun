<center><h1>预定及删除PRE CAT座位</h1></center>
<p>
  <?php
  if(isset($_GET['examdate'])&&$_GET['examdate']!='')
  {
    $_POST['bookexamdate']=date('Y-m-d', $_GET['examdate']);
    $_POST['examtime']=date('H', $_GET['examdate']);
    $_POST['examlocation']=$_GET['location'];
  }
  ?>
  <form action="exam.php" method="post" id="bookseat">
  <input type='hidden' name='hiddenbranch' 
  value='<?php echo $_SESSION['branch'];?>'>
  <input type='hidden' name='hiddenbranchop' 
  value='<?php echo $_SESSION['username'];?>'>
  <input type='hidden' name='hiddenemail' 
  value='<?php echo $_SESSION['email'];?>'>
  atoid：<input type="text" name="atoid" class="inputid" 
    value="<?php if (isset($_POST['atoid'])) {print stripslashes($_POST['atoid']);} ?>">
    <input type="submit" name="searchatoic" value="搜索">
  学员IC：
  <input type="text" name="atoic" value="<?php if (isset($_POST['atoic'])) 
  {print stripslashes($_POST['atoic']);}else {print "";} ?>">
  <input type="submit" name="searchallato" value="搜索已有ato"><br><br>
  日期: <input type="text" id="datepicker" name="bookexamdate"
  value="<?php if (isset($_POST['bookexamdate'])) {
      print stripslashes($_POST['bookexamdate']);}else {print "";} ?>">
  时间：
  <select name="examtime">
    <option>请选择</option>
    <option value="9" <?php if(isset($_POST['examtime']))
    {echo ($_POST['examtime'] == '9')?"selected":"";}?>>上午九点</option>
    <option value="14" <?php if(isset($_POST['examtime']))
    {echo ($_POST['examtime'] == '14')?"selected":"";}?>>下午两点</option>
    <option value="19" <?php if(isset($_POST['examtime']))
    {echo ($_POST['examtime'] == '19')?"selected":"";}?>>晚上七点</option>
  </select>
  考试地点：
  <select name="examlocation">
    <option>请选择</option>
    <option value="JE" <?php if(isset($_POST['examlocation']))
    {echo ($_POST['examlocation'] == 'JE')?"selected":"";}?>>Jurong East</option>
    <option value="UN" <?php if(isset($_POST['examlocation']))
    {echo ($_POST['examlocation'] == 'UN')?"selected":"";}?>>EUNOS</option>
  </select>
  <br><br>
  考试科目*：<br><br>
    阅读ER<select name="ER"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ER']))
    {echo ($_POST['ER'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ER']))
    {echo ($_POST['ER'] == 'N')?"selected":"";} else {echo "selected";}?>>NO</option>
    </select>
    听力EL<select name="EL"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EL']))
    {echo ($_POST['EL'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EL']))
    {echo ($_POST['EL'] == 'N')?"selected":"";} else {echo "selected";}?>>NO</option>
    </select>
    会话ES<select name="ES"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['ES']))
    {echo ($_POST['ES'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['ES']))
    {echo ($_POST['ES'] == 'N')?"selected":"";} else {echo "selected";}?>>NO</option>
    </select>
    写作EW<select name="EW"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EW']))
    {echo ($_POST['EW'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EW']))
    {echo ($_POST['EW'] == 'N')?"selected":"";} else {echo "selected";}?>>NO</option>
    </select>
    数学EN<select name="EN"><option value="0">请选择</option>
    <option value="Y" <?php if(isset($_POST['EN']))
    {echo ($_POST['EN'] == 'Y')?"selected":"";}?>>YES</option>
    <option value="N" <?php if(isset($_POST['EN']))
    {echo ($_POST['EN'] == 'N')?"selected":"";} else {echo "selected";}?>>NO</option>
    </select><br><br>
  考试类型*：
  <select name="prepost">
    <option>请选择</option>
    <option value="PRE" selected <?php if(isset($_POST['prepost']))
    {echo ($_POST['prepost'] == 'PRE')?"selected":"";}?>>PRE CAT</option>
    <option value="POST" <?php if(isset($_POST['prepost']))
    {echo ($_POST['prepost'] == 'POST')?"selected":"";}?>>POST CAT</option>
  </select>
  <center>
    <h2>
      提交：
      <input type="submit" name="book" value="输入">
    </h2>
    <h3>
      ato id：
      <input type="text" name="del_ato"
      value="<?php if (isset($_POST['del_ato'])) {
      print stripslashes($_POST['del_ato']);} ?>">
      <input type="submit" name="delbook" value="删除">
    </h3>
  </center>
  </form>
</p>