<?php
set_time_limit(0);
session_start();
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set("Asia/Shanghai");
header('Content-Type: text/html; charset=utf-8');
function _POST($n) { return isset($_POST[$n]) ? $_POST[$n] : NULL; }
function _GET($n) { return isset($_GET[$n]) ? $_GET[$n] : NULL; }
function pre($res) {echo "<pre>";print_r($res);echo "</pre>";}
function _LOGIN() {return isset($_SESSION['admin']) ? $_SESSION['admin'] : NULL;}
include_once(dirname(__FILE__)."/charisma/libs/db.lib.php");
$week = array("日","一","二","三","四","五","六");
?>