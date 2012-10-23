<div id="inputatoinfo">
  <div style='text-align:center'><h1>更新学员ato信息</h1></div>
  <p>*为必填内容。此处只用来更新ato信息。对于pre cat 学员，
    请先在考试管理中订座位。对于post cat学员，请先在班级管理中
    将班级状态改为待考试。要更新ato信息，请在学员检索中找到学员的
    ato id, 点搜索, 然后输入更新的信息，最后点输入。
    如果是改期，请在备注中写明是否已交测试费。
    <br /></p>
  <form name="inputatoform" id="inputatoform" action="" method="POST">
    <fieldset>
      <input type='hidden' name='hiddenbranch' 
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenemail' 
      value='<?php echo $_SESSION['email'];?>'/>
      <input type='hidden' name='hiddenbranchop' 
      value='<?php echo $_SESSION['username'];?>'/>
      atoid：<input type="text" name="atoid" class="inputid" id="atoid"
      value="<?php if (isset($_POST['atoid'])) {print stripslashes($_POST['atoid']);} ?>"/>
      <input type="button" name="searchatoid" id="searchatoid" value="搜索"/>
      学员IC*：<input type="text" id="atoic" name="atoic" value="<?php if (isset($_POST['atoic'])) {
            print stripslashes($_POST['atoic']);}else {
              print isset($_POST['ic'])?$_POST['ic']:
              (isset($_POST['regic'])?$_POST['regic']:
              (isset($_POST['receiptic'])?$_POST['receiptic']:""));} ?>"/>
      <input type="button" id="searchallato" name="searchallato" value="搜索已有ato"/><br />
      考试类型*：<select name="prepost" id="prepost">
      <option>请选择</option>
      <option value="PRE" <?php if(isset($_POST['prepost']))
    {echo ($_POST['prepost'] == 'PRE')?"selected='selected'":"";}?>>PRE CAT</option>
      <option value="POST" <?php if(isset($_POST['prepost']))
    {echo ($_POST['prepost'] == 'POST')?"selected='selected'":"";}?>>POST CAT</option>
      </select>
      推荐等级*：<select name="recommend" id="recommend">
                  <option>请选择</option>
                  <option value="Waiting for the result" <?php if(isset($_POST['recommend']))
    {echo ($_POST['recommend'] == 'Waiting for the result')?"selected='selected'":"";}?>>PRE CAT等成绩</option>
                  <option value="BEGINNERS" <?php if(isset($_POST['recommend']))
    {echo ($_POST['recommend'] == 'BEGINNERS')?"selected='selected'":"";}?>>初级</option>
                  <option value="INTERMEDIATE" <?php if(isset($_POST['recommend']))
    {echo ($_POST['recommend'] == 'INTERMEDIATE')?"selected='selected'":"";}?>>中级</option>
                  <option value="ADVANCED" <?php if(isset($_POST['recommend']))
    {echo ($_POST['recommend'] == 'ADVANCED')?"selected='selected'":"";}?>>高级</option>
                  </select><br />
      课程开始日期*: <input type="text" id="datepicker4" name="start_date" 
      value="<?php if (isset($_POST['start_date'])) {
            print stripslashes($_POST['start_date']);}else {print "";} ?>"/>
      课程截止日期*: <input type="text" id="datepicker5" name="end_date" 
      value="<?php if (isset($_POST['end_date'])) {
            print stripslashes($_POST['end_date']);}else {print "";} ?>"/><br />
      班级代码*: <input type="text" name="coursecode1" id="coursecode1" value="<?php if (isset($_POST['coursecode'])) {
            print stripslashes($_POST['coursecode']);}else {print "";} ?>"/>
      出勤率*: <input type="text" name="attendance" id="attendance" value="<?php if (isset($_POST['attendance'])) {
            print stripslashes($_POST['attendance']);}else {print "";} ?>"/><br />
      考试科目*：<br /><br />
      听力EL<select name="EL" id="EL"><option>请选择</option>
      <option value="Y" <?php if(isset($_POST['EL']))
      {echo ($_POST['EL'] == 'Y')?"selected='selected'":"";}?>>YES</option>
      <option value="N" <?php if(isset($_POST['EL']))
      {echo ($_POST['EL'] == 'N')?"selected='selected'":"";}?>>NO</option>
      </select>
      阅读ER<select name="ER" id="ER"><option>请选择</option>
      <option value="Y" <?php if(isset($_POST['ER']))
      {echo ($_POST['ER'] == 'Y')?"selected='selected'":"";}?>>YES</option>
      <option value="N" <?php if(isset($_POST['ER']))
      {echo ($_POST['ER'] == 'N')?"selected='selected'":"";}?>>NO</option>
      </select>
      数学EN<select name="EN" id="EN"><option>请选择</option>
      <option value="Y" <?php if(isset($_POST['EN']))
      {echo ($_POST['EN'] == 'Y')?"selected='selected'":"";}?>>YES</option>
      <option value="N" <?php if(isset($_POST['EN']))
      {echo ($_POST['EN'] == 'N')?"selected='selected'":"";}?>>NO</option>
      </select>
      会话ES<select name="ES" id="ES"><option>请选择</option>
      <option value="Y" <?php if(isset($_POST['ES']))
      {echo ($_POST['ES'] == 'Y')?"selected='selected'":"";}?>>YES</option>
      <option value="N" <?php if(isset($_POST['ES']))
      {echo ($_POST['ES'] == 'N')?"selected='selected'":"";}?>>NO</option>
      </select>
      写作EW<select name="EW" id="EW"><option>请选择</option>
      <option value="Y" <?php if(isset($_POST['EW']))
      {echo ($_POST['EW'] == 'Y')?"selected='selected'":"";}?>>YES</option>
      <option value="N" <?php if(isset($_POST['EW']))
      {echo ($_POST['EW'] == 'N')?"selected='selected'":"";}?>>NO</option>
      </select><br /><br />
      考试地点*：<select name="location" id="location"><option>请选择</option>
      <option value="JE" <?php if(isset($_POST['location']))
      {echo ($_POST['location'] == 'JE')?"selected='selected'":"";}?>>Jurong East</option>
      <option value="UN" <?php if(isset($_POST['location']))
      {echo ($_POST['location'] == 'UN')?"selected='selected'":"";}?>>EUNOS</option>
      </select>
      考试日期*: <input type="text" id="datepicker6" name="atodate"
      value="<?php if (isset($_POST['atodate'])) {
            print stripslashes($_POST['atodate']);}else {print "";} ?>"/>
      考试时间*：<select name="atotime" id="atotime">
                <option>请选择</option>
                <option value="09" <?php if(isset($_POST['atotime']))
    {echo ($_POST['atotime'] == '09')?"selected='selected'":"";}?>>上午九点</option>
                <option value="14" <?php if(isset($_POST['atotime']))
    {echo ($_POST['atotime'] == '14')?"selected='selected'":"";}?>>下午两点</option>
                <option value="19" <?php if(isset($_POST['atotime']))
    {echo ($_POST['atotime'] == '19')?"selected='selected'":"";}?>>晚上七点</option>
                </select><br /><br />
                Remarks： <input type='text' name='atoremark' id='atoremark' class='longtext' value="<?php if (isset($_POST['atoremark'])) {
                  print stripslashes($_POST['atoremark']);}else {print "";} ?>" />
      <div style='text-align:center'>
        <h2>
          提交：<input type="button" name="inputatobtn" id="inputatobtn" value="保存">
          <input type="button" class="clear" name="clearato" id="clearato" value="清空">
        </h2>
        <div id="resultato"></div>
        <h3>
          ato id：
          <input type="text" name="del_ato" id="del_ato"
          value="<?php if (isset($_POST['del_ato'])) {
          print stripslashes($_POST['del_ato']);} ?>"/>
          <input type="button" name="delato" id="delato" value="删除">
        </h3>
      </div>
    </fieldset>
  </form>
  <div style='text-align:center'>
    <h1>生成某一天的ato</h1>
    <form name="exportatoform" id="exportatoform" action="export.php" method="POST">
      <fieldset>
        考试日期：
        <input type="text" id="datepicker13" name="ato_date"
        value="<?php if (isset($_POST['ato_date'])) {
        print stripslashes($_POST['ato_date']);} else 
        {print date('Y-m-d');} ?>"/>
        <input type='hidden' name='hiddenbranch' value='<?php echo $_SESSION['branch'];?>'/>
        <input type="button" name="generateato" id="generateato" value="搜索">
        <input type="submit" name="generateexcel" value="生成excel"/>
      </fieldset>
    </form>
    <div id='exportato'>
    </div>
    <h1>查看ato信息</h1>
      <form name="searchatoform" id="searchatoform" action="ato.php" method="POST">
        <fieldset>
          起始日期：
          <input type="text" id="datepicker11" name="ato_startdate"
          value="<?php if (isset($_POST['ato_startdate'])) {
          print stripslashes($_POST['ato_startdate']);} else 
          {print date('Y-m-d');} ?>"/>
          截止日期：
          <input type="text" id="datepicker12" name="ato_enddate"
          value="<?php if (isset($_POST['ato_enddate'])) {
          print stripslashes($_POST['ato_enddate']);} 
          else {print date('Y-m-d', mktime(0, 0, 0, date("m")+2, date("d"), date("Y")));} ?>"/>
          <input type='hidden' name='hiddenbranch' value='<?php echo $_SESSION['branch'];?>'/>
          <input type="button" name="searchatoinfo" id="searchatoinfo" value="搜索">
          <input type="submit" name="atoexcel" value="生成excel"/>
        </fieldset>
      </form>
      <div id='allatoinfo'>
      </div>
  </div>
</div>