<?php
$sessionCookieExpireTime=8*60*60;
session_set_cookie_params($sessionCookieExpireTime);
session_start();
if (isset($_COOKIE[session_name()]))
setcookie(session_name(), $_COOKIE[session_name()], time() + $sessionCookieExpireTime, "/");
?>