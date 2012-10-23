<?php
  // session_start();
  include("includes/sessions.php");
  if ((!isset($_SESSION['username']))||($_SESSION['username'])=='') 
  {
    header('Location:index.php');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
    <title>长春教育</title>
    <link type="text/css" href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" /> 
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
    <script type="text/javascript" src="js/class.js"></script>
    <style type="text/css">
    .inputid{
      width:4em;
    }
    .longtext{
      width:90%;
    }
    </style>
  </head>
  <body>
    <div id="wrapper">
      <?php include('includes/header.php'); ?>
      <?php include('includes/nav.php'); ?>
      <div id="content">
        <div id="tabs">
          <ul>
            <li><a href="#tabs-1">所有已输入班级</a></li>
            <li><a href="#tabs-2">添加删除学员</a></li>
            <li><a href="#tabs-3">输入或更改班级信息</a></li>
            <!-- <li><a href="#tabs-2">删除班级信息</a></li> -->
            <?php
            $show_generate=false;
            if ($_SESSION['role']<3)
            {
              $show_generate=true;
            }
            if(true == $show_generate)
            {
            ?>
            <li><a href="#tabs-4">管理班级信息</a></li>
            <?php } ?>
          </ul>

          <div id="tabs-1">
            <?php include('includes/class_showclasses.php'); ?>
          </div>
          <div id="tabs-2">
            <?php include('includes/class_showstudent.php'); ?>
            <?php include('includes/class_inputstudent.php'); ?>
            <?php include('includes/class_searchnotes.php'); ?>
            <?php include('includes/class_searchclass.php'); ?>
            <?php include('includes/class_inputstudentform.php'); ?>
            <?php include('includes/class_deletetudent.php'); ?>
            <?php include('includes/class_searchrecordform.php'); ?>
            <div id='match'>
            <?php include('includes/class_match.php'); ?>
            </div>
          </div>

          <div id="tabs-3">
            <?php include('includes/class_inputclass.php'); ?>
            <?php include('includes/class_inputclassform.php'); ?>
            <?php include('includes/class_deleteclass.php'); ?>
            <?php include('includes/class_deleteclassform.php'); ?>
          </div>

          <?php
          $show_generate=false;
          if ($_SESSION['role']<3)
          {
            $show_generate=true;
          }
          if(true == $show_generate)
          {
          ?>
          <div id="tabs-4">
            <?php include('includes/class_manageclasses.php'); ?>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- end #content -->
      <?php include('includes/footer.php'); ?>
    </div>
    <!-- End #wrapper -->
  </body>
</html>

