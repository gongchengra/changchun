<?php
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)
or die ("Could not select database because ".mysqli_error($link));
mysqli_query($link, "SET NAMES UTF8");
?>
