<?php
  // session_start();
  include("includes/sessions.php");
if ((!isset($_SESSION['username']))||($_SESSION['username'])=='')
{
  header('Location:index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="" />
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<title>长春教育集团管理系统</title>
<style type="text/css">
label{
  font:18px "Helvetica",Arial,sans-serif;
  float: left;
  width: 120px;
  font-weight: bold;
}
input{
  width: 240px;
  margin-bottom: 5px;
}
.green{
    width:100%;
    background-color:#95ca78;
    border-bottom:solid 1px #8AA000;
    padding:10px 0px 10px 5px;
    margin-bottom: 8px;
    font-weight:bold;
    text-align:left;
}
.red{
    color:#E8514A;
    font-weight:bold;
}
#usertable{
    width:100%;
}
#usertable td{
    width:19%;
}
#usertable th{
    text-align: left;
}
#adduser{
    margin: auto;
    width: 300px;
    zoom:150%;
}
.red{
    color:#E8514A;
    font-weight:bold;
}
.shorttd{
    width:4em;
}
#adduserform{
  zoom:150%;
  margin: auto;
}
form{
  margin: auto;
}   
</style>
</head>
<body>
  <div id="wrapper">
    <?php include('includes/header.php'); ?>
    <?php include('includes/nav.php'); ?>
    <div id="content">
      <?php include('includes/change_password.php'); ?>
      <?php include('includes/change_search.php'); ?>
      <?php include('includes/change_form.php'); ?>
    </div>
    <!-- end #content -->
  <?php include('includes/footer.php'); ?>
</div>
<!-- End #wrapper -->
</body>
</html>