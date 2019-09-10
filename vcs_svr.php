<?php
require_once('init.inc');
require_once('ext/vcs.inc');

function hitPoint(){
  $msg = new MSG(__FUNCTION__);
  $hitPointTime = VCS::getMillisecond();
  if(!isset($_SESSION['vcs']['hitSite']) || !$_SESSION['vcs']['hitSite'] || !isset($_SESSION['vcs']['gid']) || !$_SESSION['vcs']['gid']){
    return $msg->msg(3, 'Failed important VCS-data in session.');
  }
  
  $hpDML = new DML('tb_vcs_guest');
  //$hpDML->setValue('isSpider', 0);
  $hpDML->setValue('refererJS', (isset($_POST['refererJS']) && $_POST['refererJS'] ? $_POST['refererJS'] : null));
  $hpDML->setValue('cookie', (isset($_POST['cookie']) && $_POST['cookie'] ? $_POST['cookie'] : null));
  if(isset($_POST['gid']) && $_POST['gid'] && DAS::isExistedInDB("tb_vcs_guest", "guestID = '" . $_POST['gid'] . "'")){
    $_SESSION['vcs']['gid'] = $_POST['gid'];
    $hpDML->setValue('guestID', $_SESSION['vcs']['gid']);
  }
  if(isset($_SESSION['vcs']['phpHit']) && $_SESSION['vcs']['phpHit']){
    if($hpDML->update("`id` = " . $_SESSION['vcs']['vcsID'])){
      $_SESSION['vcs']['phpHit'] = false;
		  return $msg->msg(1, 'A hitpoint on "' . $_SESSION['vcs']['vcsID'] . '" was successfully updated.', $_SESSION['vcs']['gid']);
	  }
  }
  $pageFile = substr($_SESSION['vcs']['phpSelf'], 1);
  $pageID = DAS::isExistedInDB("tb_vcs_pages", "`pageFile` = '" . $pageFile . "' AND `status` = 1", "id");
  $hpDML->setValue('phpSelf', $_SESSION['vcs']['phpSelf']);
  if ($pageID){
      $hpDML->setValue('pageID', $pageID);
      $hpDML->setValue('pageFile', $pageFile);
  }  
  if (strpos($_SESSION['vcs']['hitSite'], 'yangban-v') !== false) {
      $showroomID = intval(substr($_SESSION['vcs']['hitSite'], (strpos($_SESSION['vcs']['hitSite'], 'id%3D') + 5)));
      $hpDML->setValue('showroomID', $showroomID);
  }
  $hpDML->setValue('date', date('Y-m-d'));
  $hpDML->setValue('guestID', $_SESSION['vcs']['gid']);
  $hpDML->setValue('hitSite', $_SESSION['vcs']['hitSite']);
  $hpDML->setValue('userAgent', $_SESSION['vcs']['userAgent']);
  $hpDML->setValue('refererPHP', (isset($_SESSION['vcs']['refererPHP']) && $_SESSION['vcs']['refererPHP'] ? $_SESSION['vcs']['refererPHP'] : null));
  $hpDML->setValue('hitPointTime', $hitPointTime);
  $hpDML->setValue('ip', VCS::getIp());
  $hpDML->setValue('timestamp', date('Y-m-d H:i:s'));
  if($hpDML->insert()){
    $_SESSION['vcs']['vcsID'] = mysqli_insert_id(SGF::$dbCon);
		return $msg->msg(1, 'A hitpoint on "' . $_SESSION['vcs']['hitSite'] . '" at ' . date('Y-m-d H:i:s') . ' was successfully inserted.', $_SESSION['vcs']['gid']);
	}
	return $msg->msg(3, 'Error by insert.');
}

function beat(){
    $msg = new MSG(__FUNCTION__);  
    if (!isset($_SESSION['vcs']['hitSite']) || !$_SESSION['vcs']['hitSite'] || !isset($_SESSION['vcs']['gid']) || !$_SESSION['vcs']['gid']) {
        return $msg->msg(3, 'Failed important VCS-data in session.');
    }
    $beatTime = VCS::getMillisecond();
    $btDML = new DML('tb_vcs_guest');
    if ($_SESSION['vcs']['isSpider'] && ($beatTime - $_SESSION['vcs']['startTime']) > 1000) {
        $btDML->setValue('isSpider', 0);
        if (strpos($_SESSION['vcs']['hitSite'], 'yangban-v') !== false) {
            $showroomID = intval(substr($_SESSION['vcs']['hitSite'], (strpos($_SESSION['vcs']['hitSite'], 'id%3D') + 5)));
            $showroomDML = new DML('`tb_wcp_showrooms`');
            $showroomDML->setUpdateExpr("`visitCount` = `visitCount` + 1"); 
            $showroomDML->update("`id` = " .$showroomID);
        }
        $_SESSION['vcs']['isSpider'] = false;
    }
    $btDML->setValue('lastBeatTime', $beatTime);
    $btDML->setValue('duration', ($beatTime - $_SESSION['vcs']['startTime']));
    if ($btDML->update("`id` = " . $_SESSION['vcs']['vcsID'])) {
	    return $msg->msg(1, 'A Beat on "' . $_SESSION['vcs']['vcsID'] . '" was successfully updated at ' . date('Y-m-d H:i:s') . 'duration: ' . (($beatTime - $_SESSION['vcs']['startTime']) / 1000) . 's' . '; isSpider:' . $_SESSION['vcs']['isSpider'] . (isset($showroomID) ? '; showroomID:' . $showroomID : ''), $_SESSION['vcs']['gid']);
    }
}

function fullLoad(){
  $msg = new MSG(__FUNCTION__);
  $fullLoadTime = VCS::getMillisecond();
  if(isset($_SESSION['vcs']['vcsID']) && intval($_SESSION['vcs']['vcsID']) && $flHitpointTime = DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['vcsID']), "hitPointTime")){
    $flDML = new DML('tb_vcs_guest');
    $flDML->setValue('fullLoadTime', $fullLoadTime);
    $flDML->setValue('loadDelay', ($fullLoadTime - $flHitpointTime));
    $flDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if(isset($_POST['cookie']) && $_POST['cookie']){
      $flDML->setValue('cookie', $_POST['cookie']);
    }
    if($flDML->update('`id` = ' . intval($_SESSION['vcs']['vcsID']))){
		  return $msg->msg(1, 'A fullloadpoint on "' . $_SESSION['vcs']['vcsID'] . '" at ' . date('Y-m-d H:i:s') . ' was successfully updated.');
	  }
	  return $msg->msg(3, 'Error by update.');
  }
  return $msg->msg(3, 'Failed vcsID.');
}

function leavePoint(){
  $msg = new MSG(__FUNCTION__);
  $leaveTime = VCS::getMillisecond();
  if(isset($_SESSION['vcs']['vcsID']) && intval($_SESSION['vcs']['vcsID']) && $lpHitpointTime = DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['vcsID']), "hitPointTime")){    
    $lpDML = new DML('tb_vcs_guest');
    $lpDML->setValue('leaveTime', $leaveTime);
    $lpDML->setValue('residenceTime', ($leaveTime - $lpHitpointTime));
    $lpDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if(isset($_POST['cookie']) && $_POST['cookie']){
      $lpDML->setValue('cookie', $_POST['cookie']);
    }
    if($lpDML->update('`id` = ' . intval($_SESSION['vcs']['vcsID']))){
      SGF::eventLog(__FUNCTION__,'1','A leavepoint on %var%"' . $_SESSION['vcs']['vcsID'] . '"%#var% at %var%' . date('Y-m-d H:i:s') . '%#var% was %return%successfully updated%#return% in %var%"' . $lpDML->getTable() . '"%#var%.');
		  return $msg->msg(1, 'A leavepoint on "' . $_SESSION['vcs']['vcsID'] . '" at ' . date('Y-m-d H:i:s') . ' was successfully updated in "' . $lpDML->getTable() . '".');
	  }
    SGF::eventLog(__FUNCTION__,'2','Error by update.', 'error');
	  return $msg->msg(3, 'Error by update.');
  }
  SGF::eventLog(__FUNCTION__,'3','Failed vcsID.', 'error');
  return $msg->msg(3, 'Failed vcsID.');
}

function getCoordinate(){
  $msg = new MSG(__FUNCTION__);
  if(!isset($_POST['coordinate']) || !$_POST['coordinate']){
    return $msg->msg(3, 'Invalid Coordinate.');
  }
  if(isset($_SESSION['vcs']['vcsID']) && intval($_SESSION['vcs']['vcsID']) && DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['vcsID']))){    
    $gcDML = new DML('tb_vcs_guest');
    $gcDML->setValue('coordinate', $_POST['coordinate']);
    $gcDML->setValue('timestamp', date('Y-m-d H:i:s'));
    if($gcDML->update('`id` = ' . intval($_SESSION['vcs']['vcsID']))){
      SGF::eventLog(__FUNCTION__,'1','A Coordinate on %var%"' . $_SESSION['vcs']['vcsID'] . '"%#var% at %var%' . date('Y-m-d H:i:s') . '%#var% was %return%successfully updated%#return% in %var%"' . $gcDML->getTable() . '"%#var%.');
		  return $msg->msg(1, 'A Coordinate on "' . $_SESSION['vcs']['vcsID'] . '" at ' . date('Y-m-d H:i:s') . ' was successfully updated in "' . $gcDML->getTable() . '".');
	  }
    SGF::eventLog(__FUNCTION__,'2','Error by update.', 'error');
	  return $msg->msg(3, 'Error by update.');
  }
  SGF::eventLog(__FUNCTION__,'3','Failed vcsID.', 'error');
  return $msg->msg(3, 'Failed vcsID.');
}

function getRegion(){
    $msg = new MSG(__FUNCTION__);
    if (isset($_SESSION['vcs']['vcsID']) && intval($_SESSION['vcs']['vcsID']) && DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['vcsID']))) {    
        $grGIP = VCS::getRegionByIP();
        if (!$grGIP['prov'] && !$grGIP['city'] && !$grGIP['isp']) {
            SGF::eventLog(__FUNCTION__,'2','Can not find the Region from IP.', 'warning');
            return $msg->msg(2, 'Can not find the Region from IP.');
        }  
        $grDML = new DML('tb_vcs_guest');  
        if ($grGIP['prov'] || $grGIP['city']) {
            $grDML->setValue('region', rawurlencode($grGIP['prov'] . ' ' . $grGIP['city']));
        }
        if ($grGIP['isp']) {
            $grDML->setValue('isp', rawurlencode($grGIP['isp']));
        }
        $grDML->setValue('timestamp', date('Y-m-d H:i:s'));
        if ($grDML->update('`id` = ' . intval($_SESSION['vcs']['vcsID']))) {
            SGF::eventLog(__FUNCTION__,'1','A Region on %var%"' . $_SESSION['vcs']['vcsID'] . '"%#var% at %var%' . date('Y-m-d H:i:s') . '%#var% was %return%successfully updated%#return% in %var%"' . $grDML->getTable() . '"%#var%.');
		    return $msg->msg(1, 'A Region on "' . $_SESSION['vcs']['vcsID'] . '" at ' . date('Y-m-d H:i:s') . ' was successfully updated in "' . $grDML->getTable() . '".', $grGIP);
	    }
        SGF::eventLog(__FUNCTION__,'2','Error by update.', 'error');
	    return $msg->msg(3, 'Error by update.');
    }
    SGF::eventLog(__FUNCTION__,'3','Failed vcsID.', 'error');
    return $msg->msg(3, 'Failed vcsID.');  
}

if(isset($_POST['action']) && $_POST['action']){
  switch($_POST['action']){
    case 'hitPoint':
      die(json_encode(hitPoint()));
    case 'beat':
      die(json_encode(beat()));
	case 'fullLoad':
	  die(json_encode(fullLoad()));
    case 'leavePoint':
      die(json_encode(leavePoint()));
    case 'getCoordinate':
      die(json_encode(getCoordinate()));
    case 'getRegion':
      die(json_encode(getRegion()));
  }
  die('{"FUNC":"vcs_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER vcs_svr.php (on server): invalid action."}');
}
die('{"FUNC":"vcs_svr.php","TYPE":3,"STATUS":"ERROR","TEXT":"SERVER vcs_svr.php (on server): wrong post."}');
?>