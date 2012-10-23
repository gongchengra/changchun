<center>
  <h1>
    添加修改用户
  </h1>
  <h2>
  新增加用户不用填写id, 更改用户请写填写id, 点搜索，更新信息再点输入.
  </h2>
  <div id="adduserform">
    <form action="system.php" method="post" >
      <center>
        <fieldset>
          
          id：<input type="text" name="userid"
          value="<?php if (isset($_POST['userid'])) 
          {print stripslashes($_POST['userid']);} ?>">
          <input type="submit" name="searchuserid" value="搜索"><br>
          帐号: <input type="text" name="username"
          value="<?php if (isset($_POST['username'])) 
          {print stripslashes($_POST['username']);} ?>"><br>
          密码: <input type="password" name="password"><br>
          邮箱: <input type="text" name="email"
          value="<?php if (isset($_POST['email'])) 
          {print stripslashes($_POST['email']);} ?>"><br>
          身份：
          <select name="roleid">
            <option value="3"
            <?php if(isset($_POST['roleid']))
            {echo ($_POST['roleid'] == '3')?"selected":"";}?>
            >操作员</option>
            <option value="2"
            <?php if(isset($_POST['roleid']))
            {echo ($_POST['roleid'] == '2')?"selected":"";}?>
            >管理员</option>
          </select><br>  
          分部：
          <select name="branch">
            <option>Please select</option>
            <option value='changchun'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'changchun')?"selected":"";}?>
            >changchun</option>
            <option value='angmokio'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'angmokio')?"selected":"";}?>
            >angmokio</option>
            <option value='bedok'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'bedok')?"selected":"";}?>
            >bedok</option>
            <option value='bishan'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'bishan')?"selected":"";}?>
            >bishan</option>
            <option value='bukitbatok'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'bukitbatok')?"selected":"";}?>
            >bukitbatok</option>
            <option value='hougang'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'hougang')?"selected":"";}?>
            >hougang</option>
            <option value='jurongeast'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'jurongeast')?"selected":"";}?>
            >jurongeast</option>
            <option value='khatib'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'khatib')?"selected":"";}?>
            >khatib</option>
            <option value='pasirris'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'pasirris')?"selected":"";}?>
            >pasirris</option>
            <option value='sembawang'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'sembawang')?"selected":"";}?>
            >sembawang</option>
            <option value='sengkang'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'sengkang')?"selected":"";}?>
            >sengkang</option>
            <option value='serangoon'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'serangoon')?"selected":"";}?>
            >serangoon</option>
            <option value='tampines'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'tampines')?"selected":"";}?>
            >tampines</option>
            <option value='woodlands'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'woodlands')?"selected":"";}?>
            >woodlands</option>
            <option value='yishun'
            <?php if(isset($_POST['branch']))
            {echo ($_POST['branch'] == 'yishun')?"selected":"";}?>
            >yishun</option>
          </select><br>
          <input name="add-submit" type="submit" value="输入">  
        </fieldset>
      </center>
    </form>
  </div>
</center>
