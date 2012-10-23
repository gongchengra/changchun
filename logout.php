<?php
	// session_start();
  include("includes/sessions.php");
	session_destroy();
	header('Location:index.php');
?>