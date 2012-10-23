<?php 
  // session_start();
  include("includes/sessions.php");
  if ((!isset($_SESSION['username']))||($_SESSION['username'])=='') {
       header('Location:index.php');
   }

  $monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
      "August", "September", "October", "November", "December");
  $monthplus1=(!isset($_REQUEST["month"]))?true:false;
  if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
  // $monthplus1=(!isset($_REQUEST["month"]))?true:false;
  if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
  // if (date("d")>23) $_REQUEST["month"]=$_REQUEST["month"]+1; 
  $cMonth = $_REQUEST["month"];
  if ($monthplus1&&date("d")>23) $cMonth=$cMonth+1; 
  $cYear = $_REQUEST["year"];
   
  $prev_year = $cYear;
  $next_year = $cYear;
  $prev_month = $cMonth-1;
  $next_month = $cMonth+1;
   
  if ($prev_month == 0 ) 
  {
    $prev_month = 12;
    $prev_year = $cYear - 1;
  }
  if ($next_month == 13 ) 
  {
    $next_month = 1;
    $next_year = $cYear + 1;
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
  <title>长春教育管理系统</title>
  <link type="text/css" href="css/jquery-ui-1.8.18.custom.css" rel="stylesheet" /> 
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.18.custom.min.js"></script>
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
  });
  </script>
  <script type="text/javascript">
  $(document).ready(function(){

      });
  </script>
  <style type="text/css">
  .inputseat1{
      width:98%;
      background-color: #00FF00;
  }
  .inputseat2{
      width:98%;
      background-color: yellow;
  }
  .inputseat3{
      width:98%;
      background-color: #808080;
  }
  .selectlength{
      width:40px;
  }
  .atoprecat{
      width:100%;
  }
  .atoprecat td{
      width:20%;
  }
  .atoprecat th{
      text-align: left;
  }
  .atoprecatadmin{
      width:100%;
  }
  .atoprecatadmin td{
      width:110px;
  }
  .atoprecatadmin th{
      text-align: left;
  }
  #bookseat{
    zoom:120%;
  }
  </style>
</head>
<body>
  <div id="wrapper">
    <?php include('includes/header.php'); ?>
    <?php include('includes/nav.php'); ?>
    <div id="content">
          <?php include('includes/exam_showseat.php'); ?>
          <?php include('includes/exam_inputseatable.php'); ?>
          <?php include('includes/exam_inputseat.php'); ?>
          <a name="inputatohead"></a>
          <h1>&nbsp</h1>
          <?php include('includes/exam_searchseat.php'); ?>
          <?php include('includes/exam_bookseat.php'); ?>
          <?php include('includes/exam_delseat.php'); ?>
          <?php include('includes/exam_bookseatform.php'); ?>
          <?php include('includes/exam_booked.php'); ?>
    </div>
    <!-- end #content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!-- End #wrapper -->
</body>
</html>
