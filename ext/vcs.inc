<?php
class VCS{
  
  public static function start(){
    if(session_id() == ''){
      if(!session_start()){
        return false;
      }	
    }
    self::createGID();
    $_SESSION['vcs']['phpHit'] = false;
    $_SESSION['vcs']['userAgent'] = rawurlencode($_SERVER['HTTP_USER_AGENT']);
    $_SESSION['vcs']['phpSelf'] = $_SERVER['PHP_SELF'];
    $_SESSION['vcs']['date'] = date('Y-m-d');
    $_SESSION['vcs']['refererPHP'] = isset($_SERVER['HTTP_REFERER']) && ($_SERVER['HTTP_REFERER']) ? rawurlencode($_SERVER['HTTP_REFERER']) : null;
    $_SESSION['vcs']['hitSite'] = rawurlencode($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); 
    $_SESSION['vcs']['isSpider'] = true;
    self::hitPoint();
  }
  
  private static function createGID(){
    if(isset($_COOKIE['vcs-gid']) && $_COOKIE['vcs-gid']){
      $_SESSION['vcs']['gid'] = $_COOKIE['vcs-gid'];
      return false;
    }
    if(isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']){
      setcookie("vcs-gid", $_SESSION['vcs']['gid'], time()+2592000);
      return false;
    }
    $_SESSION['vcs']['gid'] = md5($_SERVER['REMOTE_ADDR'] . time());    
    return true;
  }
  
  private static function hitPoint(){
      if (isset($_SESSION['vcs']['gid']) && $_SESSION['vcs']['gid']){
          if (isset($_SESSION['vcs']['phpSelf']) && $_SESSION['vcs']['phpSelf']){
              $pageFile = substr($_SESSION['vcs']['phpSelf'], 1);
              $pageID = DAS::isExistedInDB("tb_vcs_pages", "`pageFile` = '" . $pageFile . "' AND `status` = 1", "id");
          }
          else{
              $pageFile = false;
              $pageID = false;
              $folderArr = array();
              $defaultPageArr = array();
              $pagesInfos = new Query("*", "tb_vcs_pages", "", "`status` = 1");
              $pagesInfos = DAS::quickQuery($pagesInfos);
              $pagesInfos = DAS::hasData($pagesInfos) ? $pagesInfos['data'] : false;          
              if ($pagesInfos){
                  foreach ($pagesInfos as $pageInfo){
                      if (strpos($_SERVER['REQUEST_URI'], $pageInfo['pageFile']) || strpos($_SERVER['REQUEST_URI'], $pageInfo['pageCname'])){
                          $pageFile = $pageInfo['pageFile'];
                          $pageID = $pageInfo['id'];
                      }
                      if (array_search($pageInfo['folder'], $folderArr) === false){
                          array_push($folderArr, $pageInfo['folder']);
                          array_push($defaultPageArr, $pageInfo);
                      }
                  }
                  if (!$pageFile || !$pageID){
                      for ($i = 0; $i < count($folderArr); $i++){
                          if (strpos($_SERVER['REQUEST_URI'], $folderArr[$i])){
                              $pageFile = $defaultPageArr[$i]['pageFile'];
                              $pageID = $defaultPageArr[$i]['id'];
                          }
                      }
                      if (!$pageFile || !$pageID){
                          $pageFile = 'index.php';
                          $pageID = 1;
                      }
                  }
              }
          }
          
          
          $vcsDML = new DML('tb_vcs_guest');
          $vcsDML->setValue('date', $_SESSION['vcs']['date']);
          $vcsDML->setValue('guestID', $_SESSION['vcs']['gid']);
          $vcsDML->setValue('hitSite', $_SESSION['vcs']['hitSite']);
          $vcsDML->setValue('phpSelf', $_SESSION['vcs']['phpSelf']);
          if ($pageID){
              $vcsDML->setValue('pageID', $pageID);
              $vcsDML->setValue('pageFile', $pageFile);
          }
          if (strpos($_SESSION['vcs']['hitSite'], 'yangban-v') !== false) {
              $showroomID = intval(substr($_SESSION['vcs']['hitSite'], (strpos($_SESSION['vcs']['hitSite'], 'id%3D') + 5)));
              $vcsDML->setValue('showroomID', $showroomID);
          }
          $hitPointTime = self::getMillisecond();
          $_SESSION['vcs']['startTime'] = $hitPointTime;   
          $vcsDML->setValue('hitPointTime', $hitPointTime);      
          $vcsDML->setValue('userAgent', $_SESSION['vcs']['userAgent']);
          if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] && trim($_SERVER['HTTP_REFERER']) != ''){
              $vcsDML->setValue('refererPHP', rawurlencode($_SERVER['HTTP_REFERER']));
          }
          /*      
          $vcsGIP = self::getRegionByIP();
          if ($vcsGIP['prov'] || $vcsGIP['city']){
              $vcsDML->setValue('region', rawurlencode($vcsGIP['prov'] . ' ' . $vcsGIP['city']));
          }
          if ($vcsGIP['isp']){
              $vcsDML->setValue('isp', rawurlencode($vcsGIP['isp']));
          }*/
          $vcsDML->setValue('ip', self::getIp());
          $vcsDML->setValue('timestamp', date('Y-m-d H:i:s'));
          if ($vcsDML->insert()){
              $_SESSION['vcs']['vcsID'] = mysqli_insert_id(SGF::$dbCon);
              $_SESSION['vcs']['phpHit'] = true;
              if (isset($_SESSION['vcs']['redirectID']) && intval($_SESSION['vcs']['redirectID']) && DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['redirectID']))){
                  $vcsRdID = intval($_SESSION['vcs']['redirectID']);
                  $_SESSION['vcs']['redirectID'] = false;
                  unset($_SESSION['vcs']['redirectID']);
                  $vcsRdDML = new DML('tb_vcs_guest');
                  $vcsRdDML->setValue("isSpider", 0);
                  $vcsRdDML->setValue("targetID", $_SESSION['vcs']['vcsID']);
                  if ($vcsRdDML->update("`id` = " . $vcsRdID)){
                      return true;
                  }
                  return false;
              }
              return false;
          }
      }
  }
  
  // 登记重定向 redirect($redirector, $target), $redirector转向器程序位置，描述格式路径名（不含文件后缀名）_namespace,如："mobile/top_rd01", $target是重定向指向页面相对路径
  public static function redirect(){
      $tmpArgArr = func_get_args();
      if (!isset($tmpArgArr[0]) || $tmpArgArr[0] == '' || !isset($tmpArgArr[1]) || $tmpArgArr[1] == ''){
          return false;
      }
      $rdID = false;
      if (!isset($_SESSION['vcs']['vcsID']) || !intval($_SESSION['vcs']['vcsID']) || !$rdID = DAS::isExistedInDB("tb_vcs_guest", "`id` = " . intval($_SESSION['vcs']['vcsID']), "`id`")){
          if(!isset($_SESSION['vcs']['gid']) || !$_SESSION['vcs']['gid'] || !$rdID = DAS::isExistedInDB("tb_vcs_guest", "`isSpider` = 1 AND `guestID` = '" . intval($_SESSION['vcs']['gid']) . "' ORDER BY `id` DESC", "`id`")){
              return false;
          }
          $_SESSION['vcs']['vcsID'] = intval($rdID);
      }
      $rdDML = new DML("tb_vcs_guest");
      $rdDML->setValue("isRedirect", 1);
      $rdDML->setValue("redirector", rawurlencode($tmpArgArr[0]));
      $rdDML->setValue("target", rawurlencode($_SERVER['HTTP_HOST'] . $tmpArgArr[1]));
      $rdDML->setValue('timestamp', date('Y-m-d H:i:s'));
      if($rdDML->update("`id` = " . intval($rdID))){
          $_SESSION['vcs']['redirectID'] = intval($rdID);
          return true;
      }
      return false;
  }
  
  public static function getMillisecond(){
      list($t1, $t2) = explode(' ', microtime());
      return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
  }
  
  public static function getIp() { 
      if(!empty($_SERVER["HTTP_CLIENT_IP"])) { 
          $cip = $_SERVER["HTTP_CLIENT_IP"]; 
      } 
      else if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) { 
          $cip = $_SERVER["HTTP_X_FORWARDED_FOR"]; 
      } 
      else if(!empty($_SERVER["REMOTE_ADDR"])) { 
          $cip = $_SERVER["REMOTE_ADDR"]; 
      } 
      else { 
          $cip = ''; 
      } 
      preg_match("/[\d\.]{7,15}/", $cip, $cips); 
      $cip = isset($cips[0]) ? $cips[0] : false; 
      unset($cips); 
      return $cip; 
  }

  
  // ip行政区域查询
  public static function getRegionByIP(){
    //$geoLocTB = false;
    $geoLocBD = false;
    $geoLoc126 = false;
    
    $ip = self::getIp();
    $ip = !$ip ? '0.0.0.0' : $ip;
    
    // 淘宝查询
    //$geoLocTB = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip);
    // 百度查询
    $geoLocBD = json_decode(file_get_contents('http://api.map.baidu.com/location/ip?ip=' . $ip . '&ak=HZakQb3i0b3afI4r9gUOtK1QCdmZrSzp'), true);
    // 126查询
    $geoLoc126 = @file_get_contents('http://ip.ws.126.net/ipquery?ip=' . $ip);
    // 省、直辖市
    $prov = false;
    // 市、区县
    $city = false;
    // 网络供应商
    $isp = false;
    
    $quelle = '';
    /*
    if($geoLocTB){
      $geoLocTB = json_decode($geoLocTB, true);
      if(isset($geoLocTB['data']['region']) && isset($geoLocTB['data']['city']) && isset($geoLocTB['data']['isp'])){
        $prov = $geoLocTB['data']['region'];
        $city = $geoLocTB['data']['city'];
        $isp = $geoLocTB['data']['isp'];
      }
    }*/
    if ($geoLocBD && isset($geoLocBD['address'])){
        $geoLocBD = explode('|', $geoLocBD['address']);
        $isp = $geoLocBD[4];
        $prov = $geoLocBD[1];
        $city = $geoLocBD[2];
    }
    if($geoLoc126){
      $geoLoc126 = mb_convert_encoding($geoLoc126, 'UTF-8', mb_detect_encoding($geoLoc126, 'GBK', true)); 
      $geoLoc126 = substr($geoLoc126, strpos($geoLoc126, '{'));
      $geoLoc126 = substr($geoLoc126, (strpos($geoLoc126, '"') + 1));
      $city = substr($geoLoc126, 0, strpos($geoLoc126, '"'));
      $geoLoc126 = substr($geoLoc126, (strpos($geoLoc126, '"') + 1));
      $geoLoc126 = substr($geoLoc126, (strpos($geoLoc126, '"') + 1));
      $prov = substr($geoLoc126, 0, strpos($geoLoc126, '"'));
    }
    return array('prov' => $prov, 'city' => $city, 'isp' => $isp, 'ip' => $ip);
  }
}
?>