<?php
require_once('init.inc');
require_once('plugins.inc'); 

$_SESSION['visit_path'] = isset($_SESSION['visit_path']) ? $_SESSION['visit_path'] : array();
if (count($_SESSION['visit_path']) > 1 && $_SESSION['visit_path'][count($_SESSION['visit_path']) - 2] == 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
    array_pop($_SESSION['visit_path']);
}
else if ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != end($_SESSION['visit_path'])) {
    array_push($_SESSION['visit_path'], 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}
$httpReffer = count($_SESSION['visit_path']) > 1 ? $_SESSION['visit_path'][count($_SESSION['visit_path']) - 2] : 'index.html';


// 页面参数
$pageInfos = new Query("", "`tb_vcs_pages`", "", "`pageFile` = '" . substr($_SERVER['PHP_SELF'], 1) . "' AND `status` = 1");
$pageInfos = DAS::quickQuery($pageInfos);
$pageInfos = DAS::hasData($pageInfos) ? $pageInfos['data'][0] : false;

if (!$pageInfos) {
    die("<script type='text/javascript'>window.location.href='index.php'</script>");
}
$pageFile = $pageInfos['pageFile'];
$imagesFolder = $pageInfos['imageFolder'];
$platformName = $pageInfos['platform'];
$pageID = $pageInfos['id'];
$bannerComponent = $pageInfos['componentPrefix'] . '_banner';
$picturesComponent = $pageInfos['componentPrefix'] . '_pic';
$pageName = $pageInfos['pageNameCN'];
$rootPath = '../';

// 获取全局参数
$globalValues = array();
$globalContents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = -1 AND `status` = 1", "ordnung");
$globalContents = DAS::quickQuery($globalContents);
if (DAS::hasData($globalContents)) {
    foreach ($globalContents['data'] as $globalContent) {
        $globalValues[$globalContent['component']] = $globalContent['textType'] == 1 ? rawurldecode($globalContent['contentChar']) : rawurldecode($globalContent['contentText']);
    }
}
// 获取全局图片参数
$globalImages = array();
$globalImagesData = new Query("*", "`tb_wcp_images`", "", "`pageID` = -1 AND `status` = 1", "ordnung");
$globalImagesData = DAS::quickQuery($globalImagesData);
if (DAS::hasData($globalImagesData)) {
    foreach ($globalImagesData['data'] as $globalImageData) {
        if ($globalImageData['component'] == 'm_global_menuitem' || $globalImageData['component'] == 'm_global_menubottom' || $globalImageData['component'] == 'm_global_bottom') {
            $globalImages[$globalImageData['component']][] = $globalImageData;
        }
        else {
            $globalImages[$globalImageData['component']] = $globalImageData; 
        }
    }
}
// 获取页面基本参数
$values = array();
$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1");
$contents = DAS::quickQuery($contents);
if (DAS::hasData($contents)) {
    foreach ($contents['data'] as $content) {
        $values[$content['component']] = $content['textType'] == 1 ? rawurldecode($content['contentChar']) : rawurldecode($content['contentText']);
    }
}
if ($pageID == 75 && isset($_GET['id']) && is_int(intval($_GET['id'])) && $showroomName = DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . intval($_GET['id']), "`name`")) {
    $values['topTitle'] = $showroomName;
}
// 加载VCS访客统计系统服务器端函数库
if (isset($globalValues['vcs_status']) && $globalValues['vcs_status'] == '1') {
    if (strpos($_SERVER['REQUEST_URI'], 'isFrame') === false) {
        require_once('../ext/vcs.inc');
        // 运行VCS访客统计系统
        VCS::start();
    }
}

$backgroundColor = (isset($globalValues['backgroundColor']) && $globalValues['backgroundColor']) ? $globalValues['backgroundColor'] : '#FFFFFF';
$backgroundColor = (isset($values['backgroundColor']) && $values['backgroundColor']) ? $values['backgroundColor'] : $backgroundColor;

$maxWidth = (isset($globalValues['maxWidth']) && $globalValues['maxWidth']) ? $globalValues['maxWidth'] : '800px';

$backgroundColor = strpos($_SERVER['PHP_SELF'], 'yuyue_dialog') !== false ? '#F2F2F2' : $backgroundColor;


?>
<!doctype html>
<html>
  <head>
    <!-- 加载Jquery及相关类 -->
    <script language="javascript" src="../js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../js/swiper.3.1.2.min.js"></script>
    <!-- 加载图形化交互界面函数库 -->
    <script language="javascript" src="../js/agui.js"></script>
    <?php
    if (isset($globalValues['vcs_status']) && $globalValues['vcs_status'] == '1') {
        if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
    ?>
    <!-- 加载高德地图应用API用于VCS位置搜集  -->
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
    <!-- 加载VCS访客统计系统客户端函数库  -->
    <script type="text/javascript" src="../js/vcs.js"></script>
    <?php
        }
    }
    ?>
    <!-- 网站基本参数设置  --> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no, minimal-ui" />    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <!-- 强制浏览器清理缓存--> 
    <meta content="no-cache" http-equiv="pragma">
    <meta content="no-cache" http-equiv="cache-control">
    <meta content="0" http-equiv="expires">  
    
    <!-- 手机上电话号码不要默认显示为链接-->
    <meta name="format-detection" content="telephone=no"/>
        
    <!-- 加载统一样式表 --> 
    <link type="text/css" rel="stylesheet" href="../css/css_m.css">
    <link type="text/css" rel="stylesheet" href="../css/swiper.3.1.2.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font_led.css" />
    <!-- 关键词及注释 -->
    <meta name="keywords" content="<?php echo (isset($values['keywords'])) ? $values['keywords'] : '';?>">
    <meta name="description" content="<?php echo (isset($values['description'])) ? $values['description'] : '';?>">
    <title><?php echo isset($values['title']) ? $values['title'] : '沪尚茗居——一站式整体家装服务';?></title>
    <?php
    if (strpos($_SERVER['REQUEST_URI'], 'isFrame') === false) {
        echo isset($globalValues['head_codes']) ? $globalValues['head_codes'] : '';
    }
    ?>
  </head>
  <body style="background-color:<?php echo $backgroundColor;?>;">
    <section id="TOP_BAR" style="display:block; text-align:center; width:100%; padding:0px 0px 0px 0px; background-color:rgba(0, 0, 0, 0); bottom:auto; position:fixed; z-index:110; top:0px; left:0px;">
      <div style="padding:0px; margin:0px; background-color:#FFFFFF; max-width:<?php echo $maxWidth;?>; display:inline-block; width:100%; height:56px; text-align:center; vertical-align:middle;">
        <div style="width:56px; display:flex; justify-content:center; align-items:center; float:right;">
          <img id="TOP_MENU_BUTTON"  src="<?php echo $globalImages['m_global_dropdown']['folderName'] . '/' . $globalImages['m_global_dropdown']['fileName'];?>" alt="" style="height:56px; display:inline-block;">
        </div>
        <?php
        if ($_SERVER['PHP_SELF'] == '/mobile/index.php') {
        ?>
          <img class="topImg"  src="<?php echo $globalImages['m_global_logo']['folderName'] . '/' . $globalImages['m_global_logo']['fileName'];?>" alt="<?php echo $globalImages['m_global_logo']['alt'];?>" style="padding:0px; height:56px;">
        <?php
        }
        else {
        ?>
          <a href="<?php echo $httpReffer;?>" style="display:inline-block; width:56px; height:56px; display:flex; justify-content:center; align-items:center; float:left;">
            <img src="img/top/menu_prev_button.jpg" alt="" style="display:inline-block; height:18px; ">
          </a>
          <div style="height:56px; display:flex; justify-content:center; align-items:center;">
            <div style="text-align:center; color:#000000; display:inline-block; font-weight:bold; font-size:18px; position:relative;"><?php echo $values['topTitle'];?></div>
          </div>
        <?php
        }          
        ?>
      </div>   
    </section>
    <script language="javascript" type="text/javascript">
    <!--//
    $(document).scroll(function(e) {
      if($(document).scrollTop() > 0){
        $("#TOP_BAR").css("opacity", "0.9");
        $("#TOP_MENU").css("opacity", "0.9");
      }
      else{
        $("#TOP_BAR").css("opacity", "1");
        $("#TOP_MENU").css("opacity", "1");
      }
    });
    function addBackgroundShadow(e){
	  if(document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
		return false;
	  }
	  var csbBackground = document.createElement("div");
	  csbBackground.id = "AGUI_SHADOW_BACKGROUND_DIV";
	  csbBackground.style.width = $(document).width() + "px";
	  csbBackground.style.height = $(document).height() + "px";
	  csbBackground.style.position = "absolute";
	  csbBackground.style.display = "block";
	  csbBackground.style.left = "0px";
	  csbBackground.style.top = "0px";
	  csbBackground.style.backgroundColor = "#000";
	  csbBackground.onclick = function(e){var ccEvt=e||event;if(ccEvt.stopPropagation){ccEvt.stopPropagation();}else{ccEvt.cancelBubble = true;}};
	  csbBackground.style.opacity = "0.9";
	  document.body.appendChild(csbBackground);
    }
    function removeBackgroundShadow(){
      if(document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
		document.body.removeChild(document.getElementById("AGUI_SHADOW_BACKGROUND_DIV"));
	  }
    }
    //-->
    </script>  
    <section>
      <div style="height:56px;; text-align:center;">
      </div>
    </section>
    <section id="TOP_MENU" style="position:fixed; top:56px; width:100%; z-index:110; display:none; left:0px; text-align:center;">
      <div style="width:100%; max-width:<?php echo $maxWidth;?>; min-height:640px; background-color:#FFFFFF; display:inline-block; text-align:left;">
      <div style="display:block; padding-left:36px; padding-right:36px;">
      <?php
      for ($i = 0; $i < count($globalImages['m_global_menuitem']); $i++) {
      ?>
        <a href="<?php echo $globalImages['m_global_menuitem'][$i]['href'];?>" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;">
          <img src="<?php echo $globalImages['m_global_menuitem'][$i]['folderName'] .'/' . $globalImages['m_global_menuitem'][$i]['fileName'];?>" style="margin-left:-18px; margin-top:-5px;">
            <?php echo $globalImages['m_global_menuitem'][$i]['head'];?>
          <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;">
        </a>
      <?php
      }
      ?>
        <div style="display:block; height:48px;"></div>
        <div style="display:block; height:48px;">
      <?php
      for ($i = 0; $i < count($globalImages['m_global_menubottom']); $i++) {
      ?>
          <a href="<?php echo $globalImages['m_global_menubottom'][$i]['href'];?>" style="display:inline-block; padding:8px; font-weight:bold; font-size:14px; <?php echo $i == 0 ? 'width:50%; border-right:2px solid #AAAAAA;' : '';?>">
            <img src="<?php echo $globalImages['m_global_menubottom'][$i]['folderName'] .'/' . $globalImages['m_global_menubottom'][$i]['fileName'];?>" style="margin-left:0px; width:24px; margin-top:-3px;">
            <?php echo $globalImages['m_global_menubottom'][$i]['head'];?>
          </a>
      <?php
      }
      ?>
        </div>
      </div>
      </div>
    </section>