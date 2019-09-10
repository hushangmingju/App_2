<?php
set_time_limit(0);
date_default_timezone_set('Asia/Shanghai');
ini_set('display_errors', true);
error_reporting(E_ALL);
function _POST($n) { return isset($_POST[$n]) ? $_POST[$n] : NULL; }
function _GET($n) { return isset($_GET[$n]) ? $_GET[$n] : NULL; }
function _VAR($n,$var) { return isset($n[$var]) ? $n[$var] : NULL; }
function pre($res) {echo "<pre>";print_r($res);echo "</pre>";}
function LogStatus($key="_key_") {
    if($key=="_key_"){
        if(empty($_SESSION['admin'])){
            return false;
        }
        else {
            return $_SESSION['admin'];
        }
    }
    elseif($key=="unset") {
        unset($_SESSION['admin']);
    }
    else {
        $_SESSION['admin'] = $key;
    }
}
if(_GET('http_trim')){echo "err";exit();}
include_once(dirname(__FILE__)."/../libs/db.lib.php");

if (!isset($no_visible_elements) || !$no_visible_elements) {
	if(LogStatus()){
		header('Content-Type: text/html; charset=utf-8');
	}else{
		Header("HTTP/1.1 301 Moved Permanently");
		Header("Location: ./login.html");
		exit();
	}
	$username = LogStatus();
}

//pre($userData);








?>