<div id="inputatorecord">
  <div style="text-align: center">
    <h1>输入学员考试成绩</h1>
  </div>
  <p>如果学员在其他地方考试或者系统成绩有错需要更改，请在此处输入成绩。
       如果需要更改成绩，先输入ic，点搜索，更改成绩，再点输入。</p>
  <form name="inputatorecform" id="inputatorecform" action="" method="POST">
    <fieldset>
      <input type='hidden' name='hiddenbranch' 
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenbranchop' 
      value='<?php echo $_SESSION['username'];?>'/>
      学员IC*：
      <input type="text" name="recordic" id="recordic"
      value="<?php if (isset($_POST['recordic'])) 
       {
         print stripslashes($_POST['recordic']);
       }
       ?>"/>
       <input type="button" name="searchatorecord" id="searchatorecord" value="搜索"/>
       考试时间*：
       <input type="text" id="datepicker15" name="rlupdated_at"
        value="<?php if (isset($_POST['rlupdated_at'])) {
        print stripslashes($_POST['rlupdated_at']);} else 
        {print date('Y-m-d');} ?>"/><br />
       考试成绩*：<br /><br />
       阅读ER<select name="ERrec" id="ERrec"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == 'NA')?"selected='selected'":"";}?>>NA</option>
       <option value="UN" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == 'UN')?"selected='selected'":"";}?>>UN</option>
       <option value="EXE" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == 'EXE')?"selected='selected'":"";}?>>EXE</option>
       <option value="B1" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == 'B1')?"selected='selected'":"";}?>>B1</option>
       <option value="1" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '1')?"selected='selected'":"";}?>>1</option>
       <option value="2" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '2')?"selected='selected'":"";}?>>2</option>
       <option value="3" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '3')?"selected='selected'":"";}?>>3</option>
       <option value="4" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '4')?"selected='selected'":"";}?>>4</option>
       <option value="5" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '5')?"selected='selected'":"";}?>>5</option>
       <option value="6" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '6')?"selected='selected'":"";}?>>6</option>
       <option value="7" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '7')?"selected='selected'":"";}?>>7</option>
       <option value="8" <?php if(isset($_POST['ERrec']))
       {echo ($_POST['ERrec'] == '8')?"selected='selected'":"";}?>>8</option>
       </select>
       听力EL<select name="ELrec" id="ELrec"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == 'NA')?"selected='selected'":"";}?>>NA</option>
       <option value="UN" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == 'UN')?"selected='selected'":"";}?>>UN</option>
       <option value="EXE" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == 'EXE')?"selected='selected'":"";}?>>EXE</option>
       <option value="B1" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == 'B1')?"selected='selected'":"";}?>>B1</option>
       <option value="1" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '1')?"selected='selected'":"";}?>>1</option>
       <option value="2" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '2')?"selected='selected'":"";}?>>2</option>
       <option value="3" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '3')?"selected='selected'":"";}?>>3</option>
       <option value="4" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '4')?"selected='selected'":"";}?>>4</option>
       <option value="5" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '5')?"selected='selected'":"";}?>>5</option>
       <option value="6" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '6')?"selected='selected'":"";}?>>6</option>
       <option value="7" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '7')?"selected='selected'":"";}?>>7</option>
       <option value="8" <?php if(isset($_POST['ELrec']))
       {echo ($_POST['ELrec'] == '8')?"selected='selected'":"";}?>>8</option>
       </select>
       
       会话ES<select name="ESrec" id="ESrec"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == 'NA')?"selected='selected'":"";}?>>NA</option>
       <option value="UN" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == 'UN')?"selected='selected'":"";}?>>UN</option>
       <option value="EXE" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == 'EXE')?"selected='selected'":"";}?>>EXE</option>
       <option value="B1" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == 'B1')?"selected='selected'":"";}?>>B1</option>
       <option value="1" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '1')?"selected='selected'":"";}?>>1</option>
       <option value="2" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '2')?"selected='selected'":"";}?>>2</option>
       <option value="3" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '3')?"selected='selected'":"";}?>>3</option>
       <option value="4" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '4')?"selected='selected'":"";}?>>4</option>
       <option value="5" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '5')?"selected='selected'":"";}?>>5</option>
       <option value="6" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '6')?"selected='selected'":"";}?>>6</option>
       <option value="7" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '7')?"selected='selected'":"";}?>>7</option>
       <option value="8" <?php if(isset($_POST['ESrec']))
       {echo ($_POST['ESrec'] == '8')?"selected='selected'":"";}?>>8</option>
       </select>
       写作EW<select name="EWrec" id="EWrec"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == 'NA')?"selected='selected'":"";}?>>NA</option>
       <option value="UN" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == 'UN')?"selected='selected'":"";}?>>UN</option>
       <option value="EXE" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == 'EXE')?"selected='selected'":"";}?>>EXE</option>
       <option value="B1" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == 'B1')?"selected='selected'":"";}?>>B1</option>
       <option value="1" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '1')?"selected='selected'":"";}?>>1</option>
       <option value="2" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '2')?"selected='selected'":"";}?>>2</option>
       <option value="3" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '3')?"selected='selected'":"";}?>>3</option>
       <option value="4" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '4')?"selected='selected'":"";}?>>4</option>
       <option value="5" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '5')?"selected='selected'":"";}?>>5</option>
       <option value="6" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '6')?"selected='selected'":"";}?>>6</option>
       <option value="7" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '7')?"selected='selected'":"";}?>>7</option>
       <option value="8" <?php if(isset($_POST['EWrec']))
       {echo ($_POST['EWrec'] == '8')?"selected='selected'":"";}?>>8</option>
       </select>
       数学EN<select name="ENrec" id="ENrec"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == 'NA')?"selected='selected'":"";}?>>NA</option>
       <option value="UN" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == 'UN')?"selected='selected'":"";}?>>UN</option>
       <option value="EXE" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == 'EXE')?"selected='selected'":"";}?>>EXE</option>
       <option value="B1" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == 'B1')?"selected='selected'":"";}?>>B1</option>
       <option value="1" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '1')?"selected='selected'":"";}?>>1</option>
       <option value="2" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '2')?"selected='selected'":"";}?>>2</option>
       <option value="3" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '3')?"selected='selected'":"";}?>>3</option>
       <option value="4" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '4')?"selected='selected'":"";}?>>4</option>
       <option value="5" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '5')?"selected='selected'":"";}?>>5</option>
       <option value="6" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '6')?"selected='selected'":"";}?>>6</option>
       <option value="7" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '7')?"selected='selected'":"";}?>>7</option>
       <option value="8" <?php if(isset($_POST['ENrec']))
       {echo ($_POST['ENrec'] == '8')?"selected='selected'":"";}?>>8</option>
       </select><br /><br />
       等级*：
       综合CMP<select name="CMP" id="CMP"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['CMP']))
       {echo ($_POST['CMP'] == 'NA')?"selected='selected'":"";}?>>N/A</option>
       <option value="BEGINNERS" <?php if(isset($_POST['CMP']))
       {echo ($_POST['CMP'] == 'BEGINNERS')?"selected='selected'":"";}?>>初级</option>
       <option value="INTERMEDIATE" <?php if(isset($_POST['CMP']))
       {echo ($_POST['CMP'] == 'INTERMEDIATE')?"selected='selected'":"";}?>>中级</option>
       <option value="ADVANCED" <?php if(isset($_POST['CMP']))
       {echo ($_POST['CMP'] == 'ADVANCED')?"selected='selected'":"";}?>>高级</option>
       </select>
       会话CON<select name="CON" id="CON"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['CON']))
       {echo ($_POST['CON'] == 'NA')?"selected='selected'":"";}?>>N/A</option>
       <option value="BEGINNERS" <?php if(isset($_POST['CON']))
       {echo ($_POST['CON'] == 'BEGINNERS')?"selected='selected'":"";}?>>初级</option>
       <option value="INTERMEDIATE" <?php if(isset($_POST['CON']))
       {echo ($_POST['CON'] == 'INTERMEDIATE')?"selected='selected'":"";}?>>中级</option>
       <option value="ADVANCED" <?php if(isset($_POST['CON']))
       {echo ($_POST['CON'] == 'ADVANCED')?"selected='selected'":"";}?>>高级</option>
       </select>
       写作WRI<select name="WRI" id="WRI"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['WRI']))
       {echo ($_POST['WRI'] == 'NA')?"selected='selected'":"";}?>>N/A</option>
       <option value="BEGINNERS" <?php if(isset($_POST['WRI']))
       {echo ($_POST['WRI'] == 'BEGINNERS')?"selected='selected'":"";}?>>初级</option>
       <option value="INTERMEDIATE" <?php if(isset($_POST['WRI']))
       {echo ($_POST['WRI'] == 'INTERMEDIATE')?"selected='selected'":"";}?>>中级</option>
       <option value="ADVANCED" <?php if(isset($_POST['WRI']))
       {echo ($_POST['WRI'] == 'ADVANCED')?"selected='selected'":"";}?>>高级</option>
       </select>
       数学WPN<select name="WPN" id="WPN"><option value='0'>请选择</option>
       <option value="NA" <?php if(isset($_POST['WPN']))
       {echo ($_POST['WPN'] == 'NA')?"selected='selected'":"";}?>>N/A</option>
       <option value="BEGINNERS" <?php if(isset($_POST['WPN']))
       {echo ($_POST['WPN'] == 'BEGINNERS')?"selected='selected'":"";}?>>初级</option>
       <option value="INTERMEDIATE" <?php if(isset($_POST['WPN']))
       {echo ($_POST['WPN'] == 'INTERMEDIATE')?"selected='selected'":"";}?>>中级</option>
       <option value="ADVANCED" <?php if(isset($_POST['WPN']))
       {echo ($_POST['WPN'] == 'ADVANCED')?"selected='selected'":"";}?>>高级</option>
       </select><br /><br />
       Remarks： <input type='text' name='remark' id='remark' class='longtext' value="<?php if (isset($_POST['remark'])) {
                print stripslashes($_POST['remark']);}else {print "";} ?>" />
        <div style='text-align:center'>
         <h2>
           提交：
           <input type="button" name="inputrecordbtn" id="inputrecordbtn" value="保存">
            <input type="button" class="clear" name="clearrec" id="clearrec" value="清空">
         </h2>
        </div>
        <div id='resultrec'></div>
    </fieldset>
  </form>
  <?php
  $show_upload=false;
  if ($_SESSION['role']>2)
  {
    $show_upload=true;
  }
  if(true == $show_upload)
  {
  ?>
  <div style="text-align: center">
    <h1>更改学员分部信息</h1>
  </div>
  <form name="inputbranchform" id="inputbranchform" action="" method="POST">
    <fieldset>
      <input type='hidden' name='hiddenbranch' 
      value='<?php echo $_SESSION['branch'];?>'/>
      <input type='hidden' name='hiddenrole' 
      value='<?php echo $_SESSION['role'];?>'/>
      学员IC*：
      <input type="text" name="branchic" id="branchic"
      value="<?php if (isset($_POST['branchic'])) 
      {
      print stripslashes($_POST['branchic']);
      }
      ?>"/>
      <input type="button" name="searchbranch" id="searchbranch" value="搜索"/>
      分部：<select name="branch" id="branch">
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
      </select>
      <input type="button" name="inputbranchbtn" id="inputbranchbtn" value="保存"><br>
    </fieldset>
  </form>
  <?php } ?>
</div>