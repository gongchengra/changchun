<?php
include("includes/sessions.php");
if ((!isset($_SESSION['username']))||($_SESSION['username'])=='') {
     header('Location:index.php');
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="changchun education" />
  <meta name="keywords" content="Management" />
  <meta name="author" content="Gong Cheng" />
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <style type="text/css">
  #inputbasic{
    font-family: Arial, "MS Trebuchet", sans-serif;
    font-size:35px;
  }
  .clear{
    font-family: Arial, "MS Trebuchet", sans-serif;
    font-size:15px;
  }
  #inputreg{
    font-family: Arial, "MS Trebuchet", sans-serif;
    font-size:20px;
  }
  #inputreceipt{
    font-family: Arial, "MS Trebuchet", sans-serif;
    font-size:20px;
  }
  #inputato{
    font-family: Arial, "MS Trebuchet", sans-serif;
    font-size:20px;
  }
  .short{
      width:50px;
  }
  .inputid{
    width:6em;
  }
  .long{
    width:80%;
  }
  .longtext{
      width:90%;
    }
  .scrollContent 
  {
   overflow-x:hidden;
   overflow-y:auto;
  }
  </style>
  <link type="text/css" href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
  <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
  <script type="text/javascript" src="js/student.js"></script>
</head>
<body>
  <div id="wrapper">
    <?php include('includes/header.php'); ?>
    <?php include('includes/nav.php'); ?>
    <div id="content">
      <div id="tabs">
        <ul>
          <li><a href="#tabs-1">学员基本信息</a></li>
          <li><a href="#tabs-2">学员报名信息</a></li>
          <li><a href="#tabs-3">收入支出信息</a></li>
          <li><a href="#tabs-4">学员ato信息</a></li>
          <li><a href="#tabs-5">检索学员信息</a></li>
          <li><a href="#tabs-6">输入学员成绩</a></li>
        </ul>
        <div id="tabs-1">
          <a name="inputbasichead"></a>
          <?php include('includes/student_reminder.php'); ?>
          <?php include('includes/student_searchic.php'); ?>
          <?php include('includes/student_inputbasicform.php'); ?>
        </div>
        <div id="tabs-2">
          <a name="inputreghead"></a>
          <div id="allregtable"></div>
          <?php include('includes/student_searchregic.php'); ?>
          <?php include('includes/student_inputregform.php'); ?>
        </div>
        <div id="tabs-3">
          <a name="inputreceipthead"></a>
          <div id="allreceiptable"></div>
          <?php include('includes/student_searchreceiptic.php'); ?>
          <?php include('includes/student_inputreceiptform.php'); ?>
        </div>
        <div id="tabs-4">
          <a name="inputatohead"></a>
          <div id="allatotable"></div>
          <?php include('includes/student_searchatoic.php'); ?>
          <?php include('includes/student_inputatoform.php'); ?>
        </div>
        <div id="tabs-5">
          <?php include('includes/student_searchallform.php'); ?>
        </div>
        <div id="tabs-6">
          <a name="inputatorecord"></a>
          <?php include('includes/student_searchatorecord.php'); ?>
          <?php include('includes/student_inputatorecordform.php'); ?>
          <?php include('includes/student_showupload.php'); ?>
        </div>
      </div>
    </div>
    <!-- end #content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!-- End #wrapper -->
</body>
</html>
