<?php
	require("conn.php");
    mysql_connect($dbhost, $dbuser, $dbpass);
    mysql_select_db($dbname);
	// $sess_maxlifetime=30;
	
    function sess_open($sess_path, $sess_name) {
        return true;
    }

    function sess_close() {
        return true;
    }

    function sess_read($sess_id) {
        $result = mysql_query("SELECT Data FROM sessions WHERE SessionID = '$sess_id';");
        $CurrentTime = time();
        if (!mysql_num_rows($result)) {
            mysql_query("INSERT INTO sessions (SessionID, DateTouched) VALUES ('$sess_id', $CurrentTime);");
            return '';
        } else {
            extract(mysql_fetch_array($result), EXTR_PREFIX_ALL, 'sess');
            mysql_query("UPDATE sessions SET DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
            return $sess_Data;
        }
    }

    function sess_write($sess_id, $data) {
        $CurrentTime = time();
        require("conn.php");
        mysql_connect($dbhost, $dbuser, $dbpass);
        mysql_select_db($dbname);
        mysql_query("UPDATE sessions SET Data = '$data', DateTouched = $CurrentTime WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_destroy($sess_id) {
        mysql_query("DELETE FROM sessions WHERE SessionID = '$sess_id';");
        return true;
    }

    function sess_gc($sess_maxlifetime) {
        $CurrentTime = time();
        mysql_query("DELETE FROM sessions WHERE DateTouched + $sess_maxlifetime < $CurrentTime;");
        return true;
    }
	
	ini_set('session.save_handler', 'user');
	ini_set('session.gc_maxlifetime', 8*60*60);
	ini_set('session.gc_probability', 1000);
	ini_set('session.gc_divisor', 1000);
    session_set_save_handler("sess_open", "sess_close", "sess_read", "sess_write", "sess_destroy", "sess_gc");
	

    session_start();
	// session_regenerate_id(true);

?>