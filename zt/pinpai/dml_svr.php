<?php
if(!isset($_POST['type']) || !$_POST['type']){
  die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): wrong post."}');
}
require_once('init.inc');
function _POST($n){
  return isset($_POST[$n]) ? $_POST[$n] : NULL;
}

$yuyueDML = new DML("tb_expo_yuyue");
$reserveDML = new DML('`tb_mingju_reserves`');
switch($_POST['type']){
  case 'yuyue':       
    break;
  case 'calc':
    $contentsJSON = '{"style":"' . _POST("calc-style") . '", "price":"' . _POST("calc-price") . '", "area":"' . _POST("calc-area") . '", "total":"' . intval(_POST("calc-price"))*intval(_POST("calc-area")) . '"}';
    $reserveDML->setValue("contents", rawurlencode($contentsJSON));
  
    $yuyueDML->setValue('area', _POST("calc-area"));
    $yuyueDML->setValue('style', _POST("calc-style"));
    $yuyueDML->setValue('price', _POST("calc-price"));
    $yuyueDML->setValue('total', intval(_POST("calc-price"))*_POST("calc-area"));
    break;
  default:
    die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): invalid type:' . $_POST['type'] . '"}');  
}
$reserveDML->setValue('type', $_POST['type']);
$reserveDML->setValue("group_table", 2); 
$reserveDML->setValue('name', _POST("name"));
$reserveDML->setValue('tel', _POST("tel")); 
$reserveDML->setValue('bultin', _POST("bultin"));
$reserveDML->setValue('date', date('Y-m-d'));
$reserveDML->setValue('phpSelf', _POST('phpSelf'));
if ($pageID = DAS::isExistedInDB("tb_vcs_pages", "pageFile = '" . substr(_POST('phpSelf'), 1) . "' AND status = 1", "id")) {
   $reserveDML->setValue('pageID', $pageID);
}
$reserveDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));
$reserveDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
$reserveDML->setValue('timestamp', date('Y-m-d H:i:s'));
$reserveDML->setValue('status', "ok");


$yuyueDML->setValue('type', $_POST['type']); 
$yuyueDML->setValue('name', _POST("name"));
$yuyueDML->setValue('tel', _POST("tel")); 
$yuyueDML->setValue('bultin', _POST("bultin"));
$yuyueDML->setValue('date', date('Y-m-d'));
$yuyueDML->setValue('phpSelf', _POST('phpSelf'));
$yuyueDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));
$yuyueDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
$yuyueDML->setValue('timestamp', date('Y-m-d H:i:s'));
$yuyueDML->setValue('status', "ok");
if(isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']){
  $yuyueDML->setValue('gid', $_SESSION['vcs']['gid']);
  $reserveDML->setValue('gid', $_SESSION['vcs']['gid']);
}
if($yuyueDML->insert() && $reserveDML->insert()){
  die('{"FUNC":"dml_svr.php","TYPE":1,"STATUS":"OK","TEXT":"提交成功。"}'); 
}
die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): error by insert."}'); 

?>