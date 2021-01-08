<?php

require_once("config.php");


if(isset($_POST['log_username'])){
	$uname = e_url($_POST['log_username']);
	$pass = e_url($_POST['log_password']);

    $api = $GLOBALS['api']."ck_log";
	$res = @file_get_contents("$api/$uname/$pass");
	if($res === FALSE) { 
		echo "false";
	}else{
		echo $res;
	}
}

?>