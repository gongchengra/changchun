<div id="inputreceipt">
  <div style="text-align: center">
    <h1>输入收入和支出</h1>
  </div>
  <p>*为必填内容。
    新输入收据信息时不用填写id。<br />
    填写前，请先输入学员ic, 查看先前收据，避免重复输入。<br />
    如果发现收据信息填写有错误需要更改，
    请先找到收据id, 点搜索，
    然后改正错误再点输入。<br />
    如果是免收学费，收据号码和收费金额都写0。
    如果有优惠活动，请在备注中写明减免多少。<br />
    如果是补交学费，请选择补交学费，并填写课程类型。
    如果知道课程代码，请填写课程代码。<br />
    如果是补交学费，一定要填写之前的收据，及金额。<br />
    如果之前有多张收据，请用“+”号隔开。<br />
    相关收据应该形如“26323+26308”，相关收据金额应该形如“30+139.1”。
  </p>
  <form name="inputreceiptform" id="inputreceiptform" action="" method="POST">
    <fieldset>
      <div style="text-align: center">
        <h2>收入部分</h2>
      </div>
      <input type='hidden' name='hiddenbranch' id='hiddenbranch'
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenbranchop' id='hiddenbranchop'
      value='<?php echo $_SESSION['username'];?>'/>
      收据id：<input type="text" name="receiptid" id="receiptid" class="inputid"
      value="<?php if (isset($_POST['receiptid'])) {print stripslashes($_POST['receiptid']);} ?>"/>
      <input type="button" name="searchreceiptid" id="searchreceiptid" value="搜索"/>
      学员IC*：<input type="text" id="receiptic" name="receiptic" value="<?php if (isset($_POST['receiptic'])) {
            print stripslashes($_POST['receiptic']);}else {
              print isset($_POST['ic'])?$_POST['ic']:
              (isset($_POST['regic'])?$_POST['regic']:"");} ?>"/>
      <input type="button" name="searchallreceipt" id="searchallreceipt" value="搜索已有收据"/><br />
      学员姓名（IC上的姓名）*：
      <input type="text" id="receiptname" name="receiptname" value="<?php if (isset($_POST['receiptname'])) 
        {print stripslashes($_POST['receiptname']);}else {print "";} ?>"/>
      学员电话*：
      <input type="text" id="receiptel" name="receiptel" value="<?php if (isset($_POST['receiptel'])) 
        {print stripslashes($_POST['receiptel']);}else {print "";} ?>"/><br />
      来源*：
      <select name="receipt_type" id="receipt_type">
        <option value="1" selected='selected' <?php if(isset($_POST['receipt_type']))
        {echo ($_POST['receipt_type'] == '1')?"selected='selected'":"";}?>>LINK1</option>
        <option value="2" <?php if(isset($_POST['receipt_type']))
        {echo ($_POST['receipt_type'] == '2')?"selected='selected'":"";}?>>changchun</option>
        <option value="3" <?php if(isset($_POST['receipt_type']))
        {echo ($_POST['receipt_type'] == '3')?"selected='selected'":"";}?>>SSA</option>
      </select>
      收据号码*: 
      <input type="text" name="receipt_no" id="receipt_no" value="<?php if (isset($_POST['receipt_no'])) {
            print stripslashes($_POST['receipt_no']);}else {print "";} ?>"/>
      <input type="button" name="searchreceiptno" id="searchreceiptno" value="搜索收据号"/>
      <button type="button" id="invalid">作废收据</button><br />
      收款人*：
      <input type="text" name="receiptop" id="receiptop" value="<?php if (isset($_POST['receiptop'])) {
            print stripslashes($_POST['receiptop']);}else {print $_SESSION['username'];} ?>"/>
      收据日期*：<input type="text" id="datepicker3" name="receipt_date" 
      value="<?php if (isset($_POST['receipt_date'])) {
            print stripslashes($_POST['receipt_date']);}else {print date('Y-m-d');} ?>"/><br />
      收费金额*：<input type="text" name="amount" id="amount" value="<?php if (isset($_POST['amount'])) {
            print stripslashes($_POST['amount']);}else {print "";} ?>"/>
      是否补交学费*：
      <select name="secondornot" id="secondornot">
        <option value="0">请选择</option>
        <option value="Y" <?php if(isset($_POST['secondornot']))
        {echo ($_POST['secondornot'] == 'Y')?"selected='selected'":"";}?>>是</option>
        <option value="N" <?php if(isset($_POST['secondornot']))
        {echo ($_POST['secondornot'] == 'N')?"selected='selected'":"";}?>>否</option>
      </select><br />
      是否老学员*：
      <select name="newstudent" id="newstudent">
        <option value="0">请选择</option>
        <option value="Y" <?php if(isset($_POST['newstudent']))
        {echo ($_POST['newstudent'] == 'Y')?"selected='selected'":"";}?>>新学员</option>
        <option value="N" <?php if(isset($_POST['newstudent']))
        {echo ($_POST['newstudent'] == 'N')?"selected='selected'":"";}?>>老学员</option>
      </select>
      课程类型：
      <select name="course_type" id="course_type">
        <option value="0">请选择</option>
        <option value="encmp" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encmp')?"selected='selected'":"";}?>>综合</option>
        <option value="encon" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encon')?"selected='selected'":"";}?>>会话</option>
        <option value="eness" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'eness')?"selected='selected'":"";}?>>ESS</option>
        <option value="encos" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encos')?"selected='selected'":"";}?>>COS</option>
        <option value="encom" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encom')?"selected='selected'":"";}?>>英文电脑</option>
        <option value="chcom" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'chcom')?"selected='selected'":"";}?>>华文电脑</option>
        <option value="chpin" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'chpin')?"selected='selected'":"";}?>>拼音</option>
        <option value="enpho" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'enpho')?"selected='selected'":"";}?>>音标</option>
        <option value="engra" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'engra')?"selected='selected'":"";}?>>语法</option>
        <option value="chwri" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'chwri')?"selected='selected'":"";}?>>华文作文</option>
        <option value="others" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'others')?"selected='selected'":"";}?>>其他</option>
      </select>
      政府信类型：
      <select name="lettertype" id="lettertype">
        <option value="0">请选择</option>
        <option value="wts1" <?php if(isset($_POST['lettertype']))
        {echo ($_POST['lettertype'] == 'wts1')?"selected='selected'":"";}?>>wts1</option>
        <option value="wts2" <?php if(isset($_POST['lettertype']))
        {echo ($_POST['lettertype'] == 'wts2')?"selected='selected'":"";}?>>wts2</option>
        <option value="na" <?php if(isset($_POST['lettertype']))
        {echo ($_POST['lettertype'] == 'na')?"selected='selected'":"";}?>>na</option>
      </select><br />
      课程代码：
      <input type="text" name="coursecode" id="coursecode" value="<?php if (isset($_POST['coursecode'])) {
            print stripslashes($_POST['coursecode']);}else {print "";} ?>"/>
      报名表号码：<input type="text" name="reg_no1" id="reg_no1" value="<?php if (isset($_POST['reg_no1'])) {
            print stripslashes($_POST['reg_no1']);}else {print "";} ?>"/><br />
      相关收据：
      <input type="text" name="relatedreceipt" id="relatedreceipt" value="<?php if (isset($_POST['relatedreceipt'])) {
            print stripslashes($_POST['relatedreceipt']);}else {print "";} ?>"/>
      对应金额：
      <input type="text" name="relatedamount" id="relatedamount" value="<?php if (isset($_POST['relatedamount'])) {
            print stripslashes($_POST['relatedamount']);}else {print "";} ?>"/><br />
      备注：
      <input type="text" name="remarks" id="remarks" class="longtext"
      value="<?php if (isset($_POST['remarks'])) 
      {print trim($_POST['remarks']);}else {print "";} ?>"/><br /><br />
      <div style="text-align: center">
        <h2>
          提交：
          <input type="button" name="inputreceiptbtn" id="inputreceiptbtn" value="收入">
          <input type="button" class="clear" name="clearreceipt" id="clearreceipt" value="清空">
          <input type="button" name="inputreceipt1" id="inputreceipt1" value="支出">
          <input type="button" name="inputreceipt2" id="inputreceipt2" value="退款">
        </h2>
      </div>
      <div id="resultreceipt"></div>
      <div style="text-align: center">
        <h2>支出部分</h2>
      </div>
        支出类型*：<select name="debitype">
        <option value="0">请选择</option>
        <option value="10" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '10')?"selected='selected'":"";}?>>退款</option>
        <option value="11" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '11')?"selected='selected'":"";}?>>工资</option>
        <option value="12" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '12')?"selected='selected'":"";}?>>交通费</option>
        <option value="13" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '13')?"selected='selected'":"";}?>>提成</option>
        <option value="14" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '14')?"selected='selected'":"";}?>>加班费</option>
        <option value="15" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '15')?"selected='selected'":"";}?>>其他补贴</option>
        <option value="16" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '16')?"selected='selected'":"";}?>>办公支出</option>
        <option value="17" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '17')?"selected='selected'":"";}?>>校长临时支出</option>
        <option value="18" <?php if(isset($_POST['debitype']))
        {echo ($_POST['debitype'] == '18')?"selected='selected'":"";}?>>其他(请备注)</option>
        </select><br />
        支出人*：
        <input type="text" name="receiptop1" value="<?php if (isset($_POST['receiptop1'])) {
              print stripslashes($_POST['receiptop1']);}else {print $_SESSION['username'];} ?>"/>
        签收人：
        <input type="text" name="receiptname1" value="<?php if (isset($_POST['receiptname1'])) {
              print stripslashes($_POST['receiptname1']);}else {print '';} ?>"/><br />
        支出日期*：<input type="text" id="datepicker14" name="receipt_date1" 
        value="<?php if (isset($_POST['receipt_date1'])) {
              print stripslashes($_POST['receipt_date1']);}else {print date('Y-m-d');} ?>"/>
        支出金额*：<input type="text" name="amount1" value="<?php if (isset($_POST['amount1'])) {
              print stripslashes($_POST['amount1']);}else {print "";} ?>"/><br />
        备注：
        <input type="text" name="remarks1" id="remarks1" class="longtext"
        value="<?php if (isset($_POST['remarks1'])) 
        {print trim($_POST['remarks1']);}else {print "";} ?>"/>
      <div style="text-align: center">
        <h3>
          收据id：
          <input type="text" name="del_receipt"
          value="<?php if (isset($_POST['del_receipt'])) {
          print stripslashes($_POST['del_receipt']);} ?>"/>
          <input type="button" name="delreceipt" id="delreceipt" value="删除">
        </h3>
      </div>
    </fieldset>
  </form>
  <div style="text-align: center"><h1>检索收费信息</h1></div>
  <form name="searchreceiptform" id="searchreceiptform" action="receipt.php" method="POST">
    <fieldset>
      <div style="text-align: center">
      起始日期：
      <input type="text" id="datepicker9" name="receipt_startdate"
      value="<?php if (isset($_POST['receipt_startdate'])) {
      print stripslashes($_POST['receipt_startdate']);} else 
      {print date('Y-m-d', mktime(0, 0, 0, date("m"), 1, date("Y")));} ?>"/>
      截止日期：
      <input type="text" id="datepicker10" name="receipt_enddate"
      value="<?php if (isset($_POST['receipt_enddate'])) {
      print stripslashes($_POST['receipt_enddate']);} else {print date('Y-m-d');} ?>"/><br />
      收款人*：
      <input type="text" name="receiptop2" id="receiptop2" value="<?php print ''; ?>"/>
      <input type='hidden' name='hiddenbranch' id='hiddenbranch'
        value='<?php echo $_SESSION['branch'];?>'/>
      <input type="button" name="searchreceiptinfo" id="searchreceiptinfo" value="搜索">
      <input type="submit" name="receiptexcel" value="生成excel"/>
      </div>
    </fieldset>
  </form>
  <div id="allreceipt">
  </div>
</div>