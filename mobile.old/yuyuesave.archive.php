<?php
if(!isset($_POST['type']) || !$_POST['type']){
  die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): wrong post."}');
}

require_once('init.inc');

function _POST($n){
  return isset($_POST[$n]) ? $_POST[$n] : NULL;
}
if($_POST['type']=="wenda"){
	$tab = "wenda";
}else{
	$tab = "yuyue";
}
$yuyueDML = new DML($tab);
switch($_POST['type']){
  case 'yuyue':
    $yuyueDML->setValue('name', _POST("name"));
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('area', _POST("area"));
    $yuyueDML->setValue('content', _POST("content"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'calc':
    $yuyueDML->setValue('name', _POST("name"));
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('area', _POST("area"));
    $yuyueDML->setValue('content', _POST("content"));
    $yuyueDML->setValue('calcstyle', _POST("calc-style"));
    $yuyueDML->setValue('calcprice', _POST("calc-price"));
    $yuyueDML->setValue('calcarea', _POST("calc-area"));
    $yuyueDML->setValue('calctotal', _POST("calc-total"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'calc2':
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('calcstyle', _POST("calc-style"));
    $yuyueDML->setValue('calcprice', _POST("calc-price"));
    $yuyueDML->setValue('calcarea', _POST("calc-area"));
    $yuyueDML->setValue('calctotal', intval(_POST("calc-price"))*intval(_POST("calc-area")));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'yangban':
    $yuyueDML->setValue('name', _POST("name"));
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('area', _POST("area"));
    $yuyueDML->setValue('content', _POST("content"));
    $yuyueDML->setValue('sid', _POST("sid"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'bottom':
    $yuyueDML->setValue('name', _POST("name"));
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'liuyan':
    $yuyueDML->setValue('name', _POST("name"));
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('title', _POST("title"));
    $yuyueDML->setValue('content', _POST("content"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    break;
  case 'wenda':
    $yuyueDML->setValue('mod', 'wenda');
    $yuyueDML->setValue('q', _POST("content"));
    $yuyueDML->setValue('status', "wenda");
    $yuyueDML->setValue('time', time());
    break;
  default:
    die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): invalid type:' . $_POST['type'] . '"}');  
}
$yuyueDML->setValue('date', date('Y-m-d'));
$yuyueDML->setValue('type', $_POST['type']);
$yuyueDML->setValue('bultin', _POST("bultin"));
$yuyueDML->setValue('phpSelf', _POST('phpSelf'));
$yuyueDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));

if(isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']){
  $yuyueDML->setValue('gid', $_SESSION['vcs']['gid']);
}

if($yuyueDML->insert()){
  die('{"FUNC":"yuyuesave.php","TYPE":1,"STATUS":"OK","TEXT":"提交成功。"}'); 
}
die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): error by insert."}'); 
















?>