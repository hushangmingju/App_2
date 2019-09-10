<?php
require_once('init.inc');
// 加载VCS访客统计系统服务器端函数库
if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
  require_once('../ext/vcs.inc');
  // 运行VCS访客统计系统
  VCS::start();
}

$_SESSION['visit_path'] = isset($_SESSION['visit_path']) ? $_SESSION['visit_path'] : array();
if (count($_SESSION['visit_path']) > 1 && $_SESSION['visit_path'][count($_SESSION['visit_path']) - 2] == 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
    array_pop($_SESSION['visit_path']);
}
else if ('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] != end($_SESSION['visit_path'])) {
    array_push($_SESSION['visit_path'], 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
}
$httpReffer = count($_SESSION['visit_path']) > 1 ? $_SESSION['visit_path'][count($_SESSION['visit_path']) - 2] : 'index.html';

$values = array();
$pageFile = substr($_SERVER['PHP_SELF'], 1);
$imagesFolder = 'pics';
$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . substr($_SERVER['PHP_SELF'], 1) . "'", "`id`");
if ($pageID == 61 || $pageID = 62) {
    $contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID);
    $contents = DAS::quickQuery($contents);
    if(DAS::hasData($contents)){
        foreach ($contents['data'] as $content) {
            $values[$content['component']] = $content['contentChar'];
        }
    }
}

$phpSelf = explode('/', substr($_SERVER['PHP_SELF'], 1));
$rootPath = '';
if (count($phpSelf) > 0) {
    for ($i = 0; $i < count($phpSelf); $i++) {
        if ($i > 0) {
            $rootPath .= '../';
        }
    }
}

$bodyColor = strpos($_SERVER['PHP_SELF'], 'yuyue_dialog') !== false ? '#F2F2F2' : '#FFFFFF';
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
    if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
    ?>
    <!-- 加载VCS访客统计系统客户端函数库  -->
    <script type="text/javascript" src="../js/vcs.js"></script>
    <?php
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
    
    <!-- 手机上电话号码不要默认显示为链接
    <meta name="format-detection" content="telephone=no"/>
    -->    
    <!-- 加载统一样式表 -->    
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link type="text/css" rel="stylesheet" href="css/activity.css">
    <link rel="stylesheet" type="text/css" href="../css/font_led.css" />
    <!-- 关键词及注释 -->
    <meta name="keywords" content="<?php echo ($pageID == 61 || $pageID = 62) ? $values['keywords'] : '';?>">
    <meta name="description" content="<?php echo ($pageID == 61 || $pageID = 62) ? $values['description'] : '';?>">
    <title>沪尚茗居——一站式整体家装服务</title>
    <?php
    require_once('head_codes.inc');
    ?>
  </head>
  <script language="javascript" type="text/javascript">
  <!--//
  console.log("<?php echo $rootPath;?>");
  //-->
  </script>
  <body style="background-color:<?php echo ($pageID == 61 || $pageID = 62) ? $values['backgroundColor'] : $bodyColor;?>">
    <section id="TOP_BAR" style="text-align:center; width:100%; padding:0px 0px 0px 0px; background-color:rgba(0, 0, 0, 0); bottom:auto; position:fixed; z-index:110; top:0px;">
      <div style=" padding:0px; background-color:#FFFFFF; max-width:800px;">
        <div style="width:82%; display:inline-block; padding:0px; vertical-align:bottom;">
          <?php
          switch ($_SERVER['PHP_SELF']) {
              case '/mobile/index.php':
                  echo '<img class="topImg"  src="img/top/logo01a.jpg" alt="" style="padding-left:30px;padding-right:0px; height:56px;">';
                  break;
              case '/mobile/yuyue_dialog.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px; padding-left:70px; padding-right:0px">                        
                          抢免费装修设计
                        </h3>';
                  break;
              case '/mobile/calc_dialog.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px; padding-left:70px; padding-right:0px">                        
                          装修费用计算器
                        </h3>';
                  break;
              case '/mobile/jz60.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          全屋整装 6.0
                        </h3>';
                  break;
              case '/mobile/about.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          关于我们
                        </h3>';
                  break;
              case '/mobile/anli.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          茗居真实案例
                        </h3>';
                  break;
              case '/mobile/styles.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          实景样板间
                        </h3>';
                  break;
              case '/mobile/packages.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          ' . ($_GET['i'] == '001' ? '美式 逸美风情' : '欧式 品欧生活') . '
                        </h3>';
                  break;
              case '/mobile/gongdi.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px; padding-left:70px; padding-right:0px">                        
                          在施工地
                        </h3>';
                  break;
              case '/mobile/promotions.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px; padding-left:70px; padding-right:0px;">                        
                          最新活动
                        </h3>';
                  break;
              case '/mobile/test.php': case '/mobile/test1.php': case '/mobile/zz.php':
                  echo '<a href="' . $httpReffer . '" style="padding:0px; float:left;">
                          <img src="img/top/menu_prev_button.jpg" alt="" style="height:18px; margin-left:16px; margin-top:2px;">
                        </a>
                        <h3 style="text-align:center; margin-bottom:10px; color:#000000; margin-left:5px;">                        
                          ' . $values['topTitle'] . '
                        </h3>';
                  break;
          }
          
          ?>
        </div>
        <div style="width:15.5%; display:inline-block;">
          <img id="TOP_MENU_BUTTON"  src="img/top/menu_button.jpg" alt="" style="height:56px; float:right; margin-bottom:-3px;">
        </div>
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
    <section id="TOP_MENU" style="position:fixed; top:56px; background-color:#FFFFFF; width:100%; max-width:800px; z-index:110; display:none;">
      <div style="width:100%; max-width:800px; padding-left:36px; padding-right:36px; min-height:640px;">
        <a href="index.html" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;"><img src="img/top/menu_home_button.jpg" style="margin-left:-18px; margin-top:-5px;"> 首页 <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;"></a>
        <a href="jz60.html" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;"><img src="img/top/menu_jz60_button.jpg" style="margin-left:-18px; margin-top:-5px;"> 全屋整装 6.0 <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;"></a>
        <a href="styles.html" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;"><img src="img/top/menu_shijing_button.jpg" style="margin-left:-18px; margin-top:-5px;"> 实景样板间 <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;"></a>
        <a href="gongdi.html" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;"><img src="img/top/menu_gongdi_button.jpg" style="margin-left:-18px; margin-top:-5px;"> 在施工地 <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;"></a>
        <a href="about.html" style="display:block; border-bottom: 2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:16px;"><img src="img/top/menu_about_button.jpg" style="margin-left:-18px; margin-top:-5px;"> 关于我们 <img src="img/top/menu_next_button.jpg" style="height:16px; float:right; margin-top:7px; margin-right:-8px;"></a>
        <div style="display:block; height:48px;"></div>
        <div style="display:block; height:48px;">
          <a href="yuyue_dialog.html" style="display:inline-block; border-right:2px solid #AAAAAA; padding:8px; font-weight:bold; font-size:14px; width:50%;"><img src="img/top/menu_zhuangxiu_button.jpg" style="margin-left:0px; width:24px; margin-top:-3px;"> 抢免费装修设计</a>
          <a href="calc_dialog.html" style="display:inline-block; padding:8px; font-weight:bold; font-size:14px;"><img src="img/top/menu_jisuan_button.jpg" style="margin-left:0px; width:24px; margin-top:-3px;"> 装修费用计算</a>
        </div>
      </div>
    </section>