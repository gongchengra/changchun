<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <title>长春教育管理系统</title>
  <style type="text/css">
  #licenter{
    width: 70%;
    margin-left: 20%;
    margin-right: 10%;
    /*margin: 0px;*/
    /*width: 300px;
    margin-left: 330px;
    margin-right: 330px;
    padding: 0px;*/
  }
  #login fieldset{

    margin-top: 100px;
    /*width: 200%;*/
  }
  #login label{
    font-size:200%;
  }
  #login input{
    font-size:200%;
  }
  </style>
</head>
<body>
  <div id="wrapper">
    <div id="header">
      <img src="images/logo.png" width="100%" alt="changchunlogo"/>
    </div> <!-- end #header -->
    <div id="content">
      <?php include('includes/login.php'); ?>
      <div id="login">
        <form action="index.php" method="post" >
          <fieldset>
            <div id="licenter">
              <label for="username">帐号: </label>
              <input type="text" name="username" id="username" size="30"/><br />
              <label for="password">密码: </label>
              <input type="password" name="password" id="password" size="30"/><br />
              <input type="submit" name="login" value="Log In"/>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</body>
</html>