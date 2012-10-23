<?php
$link = mysql_connect($dbhost, $dbuser, $dbpass)
or die ("Could not connect to mysql because ".mysql_error());
// select the database
mysql_select_db($dbname)
or die ("Could not select database because ".mysql_error());
mysql_query("SET NAMES UTF8");
?>
