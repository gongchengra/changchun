<div id="inputreg">
  <div style='text-align:center'>
    <h1>输入学员报名信息</h1>
  </div>
  <p>*为必填内容。新输入报名信息时不用填写id。
    如果发现报名信息填写有错误需要更改，
    请先在检索学员中找到报名id, 点搜索，
    然后改正错误再点输入。<br /></p>
  <form name="inputregform" id="inputregform" action="" method="POST">
    <fieldset>
      <input type='hidden' name='hiddenbranch' id='hiddenbranch'
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenbranchop' id='hiddenbranchop'
      value='<?php echo $_SESSION['username'];?>'/>
      报名id：<input type="text" id="regid" name="regid" class="inputid"
      value="<?php if (isset($_POST['regid'])) {
            print stripslashes($_POST['regid']); } ?>"/>
      <input type="button" name="searchregid" id="searchregid" value="搜索"/>
      学员IC*：<input type="text" id="regic" name="regic" value="<?php if (isset($_POST['regic'])) {
            print stripslashes($_POST['regic']);}else {
              print isset($_POST['ic'])?$_POST['ic']:"";} ?>"/>
      <input type="button" id="searchallreg" name="searchallreg" value="搜索已有报名信息"/>
      <br />
      报名日期*: <input type="text" id="datepicker" name="reg_date" 
      value="<?php if (isset($_POST['reg_date'])) {
            print stripslashes($_POST['reg_date']);}else {print date('Y-m-d');} ?>"/>
      报名地点*：<input type="text" name="reg_location" id="reg_location" value="<?php if (isset($_POST['reg_location'])) {
            print stripslashes($_POST['reg_location']);}else {print $_SESSION['branch'];} ?>"/><br />
      报名表号码*：<input type="text" name="reg_no" id="reg_no" value="<?php if (isset($_POST['reg_no'])) {
            print stripslashes($_POST['reg_no']);}else {print "";} ?>"/>
      报名人*：<input type="text" name="reg_op" id="reg_op" value="<?php if (isset($_POST['reg_op'])) {
            print stripslashes($_POST['reg_op']);}else {print $_SESSION['username'];} ?>"/><br />
      
      <input type="hidden" id="datepicker1" name="classtime" value="<?php if (isset($_POST['classtime'])) {
            print stripslashes($_POST['classtime']);}else {print "";} ?>"/><br />
      <div style="text-align: center">
        <h2>
          提交：<input type="button" name="inputregbtn" id="inputregbtn" value="保存">
          <input type="button" class="clear" name="clearreg" id="clearreg" value="清空">
        </h2>
        <div id="resultsreg"></div>
        <h3>
          报名id：
          <input type="text" name="del_reg"
          value="<?php if (isset($_POST['del_reg'])) {
          print stripslashes($_POST['del_reg']);} ?>"/>
          <input type="button" name="delreg" id="delreg" value="删除">
        </h3>
      </div>
    </fieldset>
  </form>
  <div style="text-align: center">
    <h1>查看报名信息</h1>
    <form name="searchregform" id="searchregform" action="reg.php" method="POST">
      <fieldset>
        起始日期：
        <input type="text" id="datepicker7" name="reg_startdate"
        value="<?php if (isset($_POST['reg_startdate'])) {
        print stripslashes($_POST['reg_startdate']);} else 
        {print date('Y-m-d', mktime(0, 0, 0, date("m")-3, date("d"), date("Y")));} ?>"/>
        截止日期：
        <input type="text" id="datepicker8" name="reg_enddate"
        value="<?php if (isset($_POST['reg_enddate'])) {
        print stripslashes($_POST['reg_enddate']);} else {print date('Y-m-d');} ?>"/>
        <input type='hidden' name='hiddenbranch' id='hiddenbranch'
        value='<?php echo $_SESSION['branch'];?>'/>
        <input type="button" name="searchreginfo" id="searchreginfo" value="搜索">
        <input type="submit" name="regexcel" value="生成excel"/>
      </fieldset>
    </form>
    <div id="allreg">
    </div>
    </form>
  </div>
</div>