<?php
if (!isset($_POST['type']) || !$_POST['type']) {
    die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): wrong post."}');
}
require_once('init.inc');
require_once('../../ext/vcs.inc');
$region = VCS::getRegionByIP();
function _POST($n) {
    return isset($_POST[$n]) ? $_POST[$n] : NULL;
}

$reserveDML = new DML('`tb_mingju_reserves`');
$data = null;
switch ($_POST['type']) {    
    case 'yuyue':
        break;   
    case 'gongdi':
        break;
    case 'calc':
        $priceList = new Query("priceList", "yangban", "", "yangbanID = 1"); 
        $priceList = DAS::quickQuery($priceList);
        if (!DAS::hasData($priceList)) {
            die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"提交成功。"}');
        }
        $priceList = explode('%0D%0A', $priceList['data'][0]['priceList']);
        $area = intval(_POST("area"));
        $total = 0;
        foreach ($priceList as $price) {
            $price = explode('%09', $price);
            if($area == $price[0]){
                $total = intval($price[2]);
            }
        }
        $reserveDML->setValue("contents", rawurlencode('{"calcstyle":"清新雅居", "calcarea":"' . $area . '", "calctotal":"' . $total . '"}')); 
        $data = $total;   
        break;
    default:
        die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): invalid type:' . $_POST['type'] . '"}');  
}
$reserveDML->setValue('type', $_POST['type']);
if (strpos($region['prov'], '福建') !== false) {
    $reserveDML->setValue("group_table", 4); 
}
else {
    $reserveDML->setValue("group_table", 2); 
}
$reserveDML->setValue('name', _POST("name"));
$reserveDML->setValue('tel', _POST("tel")); 
$reserveDML->setValue('bultin', _POST("bultin"));
$reserveDML->setValue('date', date('Y-m-d'));
$reserveDML->setValue('phpSelf', _POST('phpSelf'));
if ($pageID = DAS::isExistedInDB("tb_vcs_pages", "pageFile = '" . substr(_POST('phpSelf'), 1) . "' AND status = 1", "id")) {
   $reserveDML->setValue('pageID', $pageID);
}
if ($_POST["service"]) {
        $reserveDML->setValue('contents', '{"service":"' . rawurlencode($_POST["service"]) . '"}');
}
$reserveDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));
$reserveDML->setValue('ip', $_SERVER['REMOTE_ADDR']);
$reserveDML->setValue('timestamp', date('Y-m-d H:i:s'));
$reserveDML->setValue('status', "ok");

if(isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']){
  $reserveDML->setValue('gid', $_SESSION['vcs']['gid']);
}
if($reserveDML->insert()){
  die('{"FUNC":"dml_svr.php","TYPE":1,"STATUS":"OK","TEXT":"提交成功。","DATA":"' . $data . '"}'); 
}
die('{"FUNC":"dml_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER dml_svr.php (on server): error by insert."}'); 

?>