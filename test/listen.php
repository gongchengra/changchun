<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="changchun education" />
  <meta name="keywords" content="Management" />
  <meta name="author" content="Gong Cheng" />
  <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
  <link type="text/css" href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
  <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
  <script type="text/javascript" src="js/test.js"></script>
</head>
<body>
  <div id="wrapper">
    <img src="images/logo.png" width="100%" alt="changchunlogo" />
    <div id="content">
      <center>
      <div id="r1">
        <embed height="100" width="100" src="horse.mp3">
        <h1>1. ___ is used when asking for a person. E.g. ___ is your supervisor?</h1>
        A <input class="cr1" type="button" id="r1a" name="r1a" value="What"><br />
        B <input class="cr1" type="button" id="r1b" name="r1b" value="Who"><br />
        C <input class="cr1" type="button" id="r1c" name="r1c" value="Which"><br />
        D <input class="cr1" type="button" id="r1d" name="r1d" value="When"><br />
        <div id="resultr1"></div>
      </div>
      <div id="r2">
        <embed height="100" width="100" src="liar.wav">
        <h1>2. ___ means "at what time" or "on which date/day".</h1>
        A <input class="cr2" type="button" id="r2a" name="r2a" value="Which"><br />
        B <input class="cr2" type="button" id="r2b" name="r2b" value="Who"><br />
        C <input class="cr2" type="button" id="r2c" name="r2c" value="When"><br />
        D <input class="cr2" type="button" id="r2d" name="r2d" value="How"><br />
        <div id="resultr2"></div>
      </div>
      <div id="r3">
        <h1>3. How are you?</h1>
        A <input class="cr3" type="button" id="r3a" name="r3a" value="I am a counter assistant."><br />
        B <input class="cr3" type="button" id="r3b" name="r3b" value="I am fine. Thank you."><br />
        C <input class="cr3" type="button" id="r3c" name="r3c" value="May I know you, please?"><br />
        D <input class="cr3" type="button" id="r3d" name="r3d" value="Thank you very much."><br />
        <div id="resultr3"></div>
      </div>
      <div id="r4">
        <h1>4. Where do you live?</h1>
        A <input class="cr4" type="button" id="r4a" name="r4a" value="I live in Block 77, Toa"><br />
        B <input class="cr4" type="button" id="r4b" name="r4b" value="I am going back early today."><br />
        C <input class="cr4" type="button" id="r4c" name="r4c" value="I will start work next week."><br />
        D <input class="cr4" type="button" id="r4d" name="r4d" value="My son lives in Sembawang."><br />
        <div id="resultr4"></div>
      </div>
      </center>
    </div>
    <!-- end #content -->
    <?php include('includes/footer.php'); ?>
  </div>
  <!-- End #wrapper -->
</body>
</html>
