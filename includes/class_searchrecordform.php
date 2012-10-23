<center>
  <h1>筛选满足条件学员</h1>
</center>
<form name="searchrecform" id="searchrecform" action="" method="POST">
  <center>
    上课时间：
    <select name="availabletime[]" multiple="multiple" id='availabletime'>
      <option value="0">请选择</option>
      <option value="1" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='1') {echo "selected";} }
      }?>>平时早</option>
      <option value="2" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='2') {echo "selected";} }
      }?>>平时下午</option>
      <option value="3" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='3') {echo "selected";} }
      }?>>平时晚</option>
      <option value="4" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='4') {echo "selected";} }
      }?>>拜六日早</option>
      <option value="5" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='5') {echo "selected";} }
      }?>>拜六日下午</option>
      <option value="6" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='6') {echo "selected";} }
      }?>>拜六日晚</option>
      <option value="7" 
      <?php if(isset($_POST['availabletime']))
      { foreach($_POST['availabletime'] as $value)
        { if($value=='7') {echo "selected";} }
      } else {echo "selected";} ?>>任意时间</option>
    </select><br /><br /><br />
    class id：<input type="text" name="classid2" id="classid2" class="inputid" 
    value="<?php if(isset($_POST['classid2'])) {print stripcslashes($_POST['classid2']);}
    elseif(isset($_POST['classid1'])) {print stripslashes($_POST['classid1']);} 
    elseif(isset($_GET['classid'])&&$_GET['classid']!='') {print $_GET['classid'];}
    elseif(isset($_POST['classid'])) {print stripslashes($_POST['classid']);}?>">
    类型*:
    <select name="classtype1" id="classtype1">
        <option value="0">请选择</option>
        <option value="encmp" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'encmp')?"selected":"";}?>>综合</option>
        <option value="encon" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'encon')?"selected":"";}?>>会话</option>
        <option value="eness" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'eness')?"selected":"";}?>>ESS</option>
        <option value="encos" <?php if(isset($_POST['course_type']))
        {echo ($_POST['course_type'] == 'encos')?"selected":"";}?>>COS</option>
        <option value="encom" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'encom')?"selected":"";}?>>英文电脑</option>
        <option value="chcom" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'chcom')?"selected":"";}?>>华文电脑</option>
        <option value="chpin" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'chpin')?"selected":"";}?>>拼音</option>
        <option value="enpho" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'enpho')?"selected":"";}?>>音标</option>
        <option value="engra" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'engra')?"selected":"";}?>>语法</option>
        <option value="chwri" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'chwri')?"selected":"";}?>>华文作文</option>
        <option value="others" <?php if(isset($_POST['classtype1']))
        {echo ($_POST['classtype1'] == 'others')?"selected":"";}?>>其他</option>
      </select>
    等级*:
    <select name="classlevel1" id="classlevel1">
      <option value="0">请选择</option>
      <option value="BEGINNERS" <?php if(isset($_POST['classlevel1']))
      {echo ($_POST['classlevel1'] == 'BEGINNERS')?"selected":"";}?>>初级</option>
      <option value="INTERMEDIATE" <?php if(isset($_POST['classlevel1']))
      {echo ($_POST['classlevel1'] == 'INTERMEDIATE')?"selected":"";}?>>中级</option>
      <option value="ADVANCED" <?php if(isset($_POST['classlevel1']))
      {echo ($_POST['classlevel1'] == 'ADVANCED')?"selected":"";}?>>高级</option>
    </select><br />
    
    考试日期（起始）：
    <input type="text" id="datepicker5" name="exam_startdate"
    value="<?php if (isset($_POST['exam_startdate'])) {
    print stripslashes($_POST['exam_startdate']);} else 
    {print date('Y-m-d', mktime(0, 0, 0, 1, 1, date("Y")));} ?>">
    考试日期（载止）：
    <input type="text" id="datepicker6" name="exam_enddate"
    value="<?php if (isset($_POST['exam_enddate'])) {
    print stripslashes($_POST['exam_enddate']);} else {print date('Y-m-d');} ?>">
    <input type='hidden' name='hiddenbranch' id='hiddenbranch'
      value='<?php echo $_SESSION['branch'];?>'/>
    <input type="button" name="searchrecord" id="searchrecord" value="搜索">
  </center>
</form>
