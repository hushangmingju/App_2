<?php
if(!isset($_POST['type']) || !$_POST['type']){
  die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): wrong post."}');
}

require_once('init.inc');
require_once('ext/vcs.inc');
function _POST($n){
  return isset($_POST[$n]) ? $_POST[$n] : NULL;
}
if ($_POST['type']=="wenda") {
	$wendaDML = new DML("`wenda`");
    $wendaDML->setValue('mod', 'wenda');
    $wendaDML->setValue('q', _POST("content"));
    $wendaDML->setValue('status', "wenda");
    $wendaDML->setValue('time', time());
    $wendaDML->setValue('date', date('Y-m-d'));
    $wendaDML->setValue('type', $_POST['type']);
    $wendaDML->setValue('bultin', _POST('bultin'));
    $wendaDML->setValue('phpSelf', _POST('phpSelf'));
    $wendaDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));
    if (isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']) {
        $wendaDML->setValue('gid', $_SESSION['vcs']['gid']);
    }
    if ($wendaDML->insert()) {
        die('{"FUNC":"yuyuesave.php","TYPE":1,"STATUS":"OK","TEXT":"提交成功。"}'); 
    }
}
else {
    $yuyueDML = new DML("`yuyue`");
    $reserveDML = new DML('`tb_mingju_reserves`');
    switch ($_POST['type']) {
        case 'yuyue': case 'banner': case 'yhbanner':
            $contentsJSON = '{"area":"' . _POST("area") . '", "content":"' . _POST("content") . '"}';
            $reserveDML->setValue("contents", rawurlencode($contentsJSON));
            $reserveDML->setValue("name", rawurlencode(_POST("name")));         
            
            $yuyueDML->setValue('name', _POST("name"));
            $yuyueDML->setValue('area', _POST("area"));
            $yuyueDML->setValue('content', _POST("content"));
            break;
        case 'calc':
            $contentsJSON = '{"area":"' . _POST("area") . '", "content":"' . _POST("content") . '", "calcstyle":"' . _POST("calc-style") . '", "calcprice":"' . _POST("calc-price") . '", "calcarea":"' . _POST("calc-area") . '", "calctotal":"' . _POST("calc-total") . '"}';
            $reserveDML->setValue("contents", rawurlencode($contentsJSON));
            $reserveDML->setValue("name", rawurlencode(_POST("name")));
            
            $yuyueDML->setValue('name', _POST("name"));
            $yuyueDML->setValue('area', _POST("area"));
            $yuyueDML->setValue('content', _POST("content"));
            $yuyueDML->setValue('calcstyle', _POST("calc-style"));
            $yuyueDML->setValue('calcprice', _POST("calc-price"));
            $yuyueDML->setValue('calcarea', _POST("calc-area"));
            $yuyueDML->setValue('calctotal', _POST("calc-total"));
            break;
        case 'calc2': case 'calc3':
            $contentsJSON = '{"calcstyle":"' . _POST("calc-style") . '", "calcprice":"' . _POST("calc-price") . '", "calcarea":"' . _POST("calc-area") . '", "calctotal":"' . _POST("calc-total") . '"}';
            $reserveDML->setValue("contents", rawurlencode($contentsJSON));
            
            $yuyueDML->setValue('calcstyle', _POST("calc-style"));
            $yuyueDML->setValue('calcprice', _POST("calc-price"));
            $yuyueDML->setValue('calcarea', _POST("calc-area"));
            $yuyueDML->setValue('calctotal', intval(_POST("calc-price"))*intval(_POST("calc-area")));
            break;
        case 'yangban':
            $contentsJSON = '{"area":"' . _POST("area") . '", "content":"' . _POST("content") . '", "sid":"' . _POST("sid") . '"}';
            $reserveDML->setValue("contents", rawurlencode($contentsJSON));
            $reserveDML->setValue("name", rawurlencode(_POST("name")));             
        
            $yuyueDML->setValue('name', _POST("name"));
            $yuyueDML->setValue('area', _POST("area"));
            $yuyueDML->setValue('content', _POST("content"));
            $yuyueDML->setValue('sid', _POST("sid"));
            break;
        case 'bottom':
            $reserveDML->setValue("name", rawurlencode(_POST("name"))); 
            $yuyueDML->setValue('name', _POST("name"));
            break;
        case 'liuyan':
            $contentsJSON = '{"title":"' . _POST("title") . '", "content":"' . _POST("content") . '"}';
            $reserveDML->setValue("contents", rawurlencode($contentsJSON));
            $reserveDML->setValue("name", rawurlencode(_POST("name")));                    
        
            $yuyueDML->setValue('name', _POST("name"));
            $yuyueDML->setValue('title', _POST("title"));
            $yuyueDML->setValue('content', _POST("content"));
            break;
        default:
            die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): invalid type:' . $_POST['type'] . '"}');  
    }
    $reserveDML->setValue("tel", _POST("tel"));
    $region = VCS::getRegionByIP();
    if (strpos($region['prov'], '福建') !== false) {
        $reserveDML->setValue("group_table", 4); 
    }
    else {
        $reserveDML->setValue("group_table", 1); 
    }
    $reserveDML->setValue("status", "ok");  
    $reserveDML->setValue('date', date('Y-m-d')); 
    $reserveDML->setValue("type", $_POST['type']);
    $reserveDML->setValue("bultin", _POST('bultin'));
    $reserveDML->setValue("phpSelf", _POST('phpSelf'));
    if ($pageID = DAS::isExistedInDB("tb_vcs_pages", "pageFile = '" . substr(_POST('phpSelf'), 1) . "' AND status = 1", "id")) {
        $reserveDML->setValue('pageID', $pageID);
    }
    $reserveDML->setValue("url", rawurlencode($_SERVER['HTTP_REFERER']));
    $reserveDML->setValue("timestamp", date('Y-m-d H:i:s'));
    $reserveDML->setValue("ip", $_SERVER['REMOTE_ADDR']);
    
    $yuyueDML->setValue('tel', _POST("tel"));
    $yuyueDML->setValue('status', "ok");
    $yuyueDML->setValue('time', time());
    $yuyueDML->setValue('date', date('Y-m-d'));
    $yuyueDML->setValue('type', $_POST['type']);
    $yuyueDML->setValue('bultin', _POST('bultin'));
    $yuyueDML->setValue('phpSelf', _POST('phpSelf'));
    $yuyueDML->setValue('url', rawurlencode($_SERVER['HTTP_REFERER']));
    if (isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']) {
        $yuyueDML->setValue('gid', $_SESSION['vcs']['gid']);
        $reserveDML->setValue('gid', $_SESSION['vcs']['gid']);
    }
    if (strpos($_SESSION['vcs']['hitSite'], 'yangban-v') !== false && strpos($_SESSION['vcs']['hitSite'], 'id%3D') !== false) {
        $showroomID = intval(substr($_SESSION['vcs']['hitSite'], (strpos($_SESSION['vcs']['hitSite'], 'id%3D') + 5)));
        $reserveDML->setValue('showroomID', $showroomID);
    }    
    if (strpos($_SESSION['vcs']['hitSite'], 'yuyue') !== false && strpos($_SESSION['vcs']['hitSite'], 'sid%3D') !== false) {
        $showroomID = intval(substr($_SESSION['vcs']['hitSite'], (strpos($_SESSION['vcs']['hitSite'], 'sid%3D') + 6)));
        $reserveDML->setValue('showroomID', $showroomID);
    }
    if ($yuyueDML->insert() && $reserveDML->insert()) {
        die('{"FUNC":"yuyuesave.php","TYPE":1,"STATUS":"OK","TEXT":"提交成功。"}'); 
    }
}
die('{"FUNC":"yuyuesave.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER yuyuesave.php (on server): error by insert."}'); 
















?>