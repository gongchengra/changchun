<center>
  <h1>
  更改帐号和密码
  </h1>
  <h2>
此处只能更改帐号和密码，如果需要更改其他内容，请联系管理员。</h2>
</center>
<div id="adduserform">
  <form action="change.php" method="post" >
    <label for="userid">id：</label>
    <input type="text" name="userid"
    value="<?php if (isset($_POST['userid'])) 
    {print stripslashes($_POST['userid']);} ?>" readonly="readonly"><br>
    <label for="username">帐号: </label>
    <input type="text" name="username"
    value="<?php if (isset($_POST['username'])) 
    {print stripslashes($_POST['username']);} ?>"><br>
    <label for="password1">输入新密码: </label>
    <input type="password" name="password1"><br>
    <label for="password2">确认新密码: </label>
    <input type="password" name="password2"><br>
    <label for="email">邮箱: </label>
    <input type="text" name="email"
    value="<?php if (isset($_POST['email'])) 
    {print stripslashes($_POST['email']);} ?>" readonly="readonly"><br>
    <label for="branch">分部：</label>
    <input type="text" name="branch"
    value="<?php if (isset($_POST['branch'])) 
    {print stripslashes($_POST['branch']);} ?>" readonly="readonly"><br>
    <input name="update" type="submit" value="输入">
  </form>
</div>
