<div id="inputstudent">
  <form name="inputstudentform" id="inputstudentform" action="" method="POST">
    <center>
      <h1>添加及更新学员信息</h1>
    </center>
    <div id="studentall"></div>
    <center>
    class id：<input type="text" name="classid1" id="classid1" class="inputid" 
    value="<?php if (isset($_POST['classid1'])) {print stripslashes($_POST['classid1']);} 
    elseif(isset($_GET['classid'])&&$_GET['classid']!='') {print $_GET['classid'];}
    elseif(isset($_POST['classid'])) {print stripslashes($_POST['classid']);}?>"><br>
    学员IC：
    <input type="text" name="ic" id="ic"
    value="<?php 
    if(isset($_POST['ic'])){echo $_POST['ic'];}
    elseif(isset($_GET['atdic'])&&$_GET['atdic']!=''){echo $_GET['atdic'];} 
    else echo ''; ?>"/>
    <input type="button" id="searchstudent" name="searchstudent" value="搜索">
    出勤率：<input type="text" name="attendance" class="inputid" 
    value="<?php if (isset($_POST['attendance'])) 
    {print stripslashes($_POST['attendance']);} else print "100"; ?>"> % <br>
    所用报名表号码*：
    <input type="text" name="reg_no" id="reg_no" value="<?php if (isset($_POST['reg_no'])) {
            print stripslashes($_POST['reg_no']);}else {print "";} ?>">
    所用收据号码*: 
    <input type="text" name="receipt_no" id="receipt_no" value="<?php if (isset($_POST['receipt_no'])) {
            print stripslashes($_POST['receipt_no']);}else {print "";} ?>">
    <input type='hidden' name='hiddenbranch' id='hiddenbranch'
      value='<?php echo $_SESSION['branch'];?>'/>
    <input type="button" name="inputstudentbtn" id="inputstudentbtn" value="添加或更新">
    <!-- <input type="submit" name="deletestudent" value="删除" onSubmit="return confirm_entry()"><br> -->
    <br>
    如果有多张收据，请用“+”号隔开。
    </center>
  </form>
  <div id='resultinputstudent'></div>
</div>