<?php
  // session_start();
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
    font-size:20px;
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
  <script type="text/javascript">
  $(function(){
    // Datepicker
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker1').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker2').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker3').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker4').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker5').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker6').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker7').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker8').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker9').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker10').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker11').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker12').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker13').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#datepicker14').datepicker({
        dateFormat: 'yy-mm-dd', inline: true
    });
    $('#tabs').tabs();
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#searchallreg").click(function () {
      $("#allregtable").load('Retrieving...');
      $.ajax({
        type: "POST",
        data: "regic=" + $("#regic").val(),
        url: "includes/searchallreg.php",
        success: function(msg){
          $("#allregtable").html(msg)
        }
      });
    });
    $("#searchallreceipt").click(function () {
      $("#allreceiptable").load('Retrieving...');
      $.ajax({
        type: "POST",
        data: "receiptic=" + $("#receiptic").val(),
        url: "includes/searchallreceipt.php",
        success: function(msg){
          $("#allreceiptable").html(msg)
        }
      });
    });
    $("#searchallato").click(function () {
      $("#allatotable").load('Retrieving...');
      $.ajax({
        type: "POST",
        data: "atoic=" + $("#atoic").val(),
        url: "includes/searchallato.php",
        success: function(msg){
          $("#allatotable").html(msg)
        }
      });
    });
  });
  </script>
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
          <li><a href="#tabs-3">学员收费信息</a></li>
          <li><a href="#tabs-4">学员ato信息</a></li>
          <li><a href="#tabs-5">检索学员信息</a></li>
        </ul>
        <div id="tabs-1">
          <a name="inputbasichead"></a>
          <?php include('includes/student_reminder.php'); ?>
          <?php include('includes/student_inputbasic.php'); ?>
          <?php include('includes/student_searchic.php'); ?>
          <?php include('includes/student_inputbasicform.php'); ?>
        </div>
        <div id="tabs-2">
          <a name="inputreghead"></a>
          <div id="allregtable"></div>
          <?php include('includes/student_inputreg.php'); ?>
          <?php include('includes/student_searchregic.php'); ?>
          <?php include('includes/student_delreg.php'); ?>
          <?php include('includes/student_inputregform.php'); ?>
          <?php include('includes/student_showreg.php'); ?>
        </div>
        <div id="tabs-3">
          <a name="inputreceipthead"></a>
          <div id="allreceiptable"></div>
          <?php include('includes/student_inputreceipt.php'); ?>
          <?php include('includes/student_searchreceiptic.php'); ?>
          <?php include('includes/student_delreceipt.php'); ?>
          <?php include('includes/student_inputreceiptform.php'); ?>
          <?php include('includes/student_showreceipt.php'); ?>
        </div>
        <div id="tabs-4">
          <a name="inputatohead"></a>
          <div id="allatotable"></div>
          <?php include('includes/student_inputatotmp.php'); ?>
          <?php include('includes/student_searchatoic.php'); ?>
          <?php include('includes/student_delato.php'); ?>
          <?php include('includes/student_inputatoformtmp.php'); ?>
          <a name="inputatorecord"></a>
          <?php include('includes/student_inputatorecord.php'); ?>
          <?php include('includes/student_searchatorecord.php'); ?>
          <?php include('includes/student_inputatorecordform.php'); ?>
          <?php include('includes/student_showupload.php'); ?>
          <?php include('includes/student_showato.php'); ?>
        </div>
        <div id="tabs-5">
          <center>
            <h1>查看学员所有信息</h1>
            <form action="student.php" method="post">
              学员IC*：<input type="text" name="allic" value="<?php if (isset($_POST['allic'])) {
              print stripslashes($_POST['allic']);}else {print "";} ?>">
              <input type="submit" name="searchallic" value="搜索">
            </form>
            <?php include('includes/student_searchallic.php'); ?>
            <?php include('includes/student_searchform.php'); ?>
          </center>
        </div>
      </div>
    </div>
    <!-- end #content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!-- End #wrapper -->
</body>
</html>
