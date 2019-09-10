<?php
// 获取相对根目录路径
$phpSelf = explode('/', substr($_SERVER['PHP_SELF'], 1));
$rootPath = '';
if (count($phpSelf) > 0) {
    for ($i = 0; $i < count($phpSelf); $i++) {
        if ($i > 0) {
            $rootPath .= '../';
        }
    }
}
// 初始化数据库
require_once('init.inc');
// 加载插件库
require_once($rootPath . 'mobile/plugins.inc'); 

// 获取页面参数
$pageInfos = new Query("", "`tb_vcs_pages`", "", "`status` = 1 AND `pageFile` = '" . substr($_SERVER['PHP_SELF'], 1) . "'");
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

// 获取页面内容参数
$values = array();

$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1");
$contents = DAS::quickQuery($contents);
if (DAS::hasData($contents)) {
    foreach ($contents['data'] as $content) {
        $values[$content['component']] = $content['textType'] == 1 ? rawurldecode($content['contentChar']) : rawurldecode($content['contentText']);
    }
}
$banner = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageID . " AND `component` = '" . $bannerComponent . "'");
$banner = DAS::quickQuery($banner);
$banner = DAS::hasData($banner) ? $banner['data'][0] : false;

$pictures = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageID . " AND `component` = '" . $picturesComponent . "'", "`ordnung`");
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$composes = new Query("*", "`tb_wcp_composes`", "", "`status` = 1 AND `pageID` = " . $pageID, "`id`");
$composes = DAS::quickQuery($composes);
$composes = DAS::hasData($composes) ? $composes['data'] : false;

$backgroundColor = (isset($values['backgroundColor']) && $values['backgroundColor']) ? $values['backgroundColor'] : '#FFFFFF';

if (isset($values['vcs_status']) && $values['vcs_status'] == '1') {
    require_once($rootPath . 'ext/vcs.inc');
    VCS::start(); 
}
?>
<!doctype html>
<html>
  <head>
    <script language="javascript" src="<?php echo $rootPath;?>js/jquery-2.1.4.min.js"></script>
    <script language="javascript" src="<?php echo $rootPath;?>js/agui.js"></script>
    <?php
    if (isset($values['vcs_status']) && $values['vcs_status'] == '1') {
        if (isset($values['geo_status']) && $values['geo_status'] == '1') {
    ?>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
    <?php
        }
    ?>  
    <script type="text/javascript" src="<?php echo $rootPath;?>js/vcs.js"></script>
    <?php
    }
    ?>  
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no, minimal-ui" />
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- 强制浏览器清理缓存 --> 
    <meta content="no-cache" http-equiv="pragma">
    <meta content="no-cache" http-equiv="cache-control">
    <meta content="0" http-equiv="expires"> 
    <!-- 手机上电话号码不要默认显示为链接 -->
    <meta name="format-detection" content="telephone=no"/>
    <meta http-equiv="Access-Control-Allow-Origin" content="www.mingjugroup.com">
    <link type="text/css" rel="stylesheet" href="<?php echo $rootPath;?>css/css.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $rootPath;?>css/swiper.4.4.2.css"/>    
    <script type="text/javascript" src="<?php echo $rootPath;?>js/swiper.4.4.2.js"></script>
<!----------------------------------------------------- top.inc END --------------------------------------------------------------------------->

    <!-- 关键词及注释 -->
    <meta name="keywords" content="<?php echo isset($values['keywords']) ? $values['keywords'] : '';?>">
    <meta name="description" content="<?php echo isset($values['description']) ? $values['description'] : '';?>">
    <title><?php echo isset($values['title']) ? $values['title'] : '';?></title>
    <?php echo isset($values['head_codes']) ? $values['head_codes'] : '';?>
  </head>
  <body style="background-color:<?php echo $backgroundColor;?>;">
  <?php
  // Banner 图片  
  if ($banner) {
      if (isset($values['showBanner']) && $values['showBanner'] == 1) {
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
        <img src="<?php echo $banner['folderName'] . '/' . $banner['fileName'];?>" style="width:100%;"/>
      </div>
    </section>
  <?php
      }
  }
  ?>
  <?php
  // 图片及插件
  for ($i = 0; $i < count($pictures); $i++) {
      for ($j = 0; $j < count($composes); $j++) {
          if ($composes[$j]['ordnung'] == $pictures[$i]['ordnung']) {
              if ($composes[$j]['name'] == '轮拨图') {
  ?>
  <!-- 轮拨图-->
    <section style="text-align:center;">
      <div style="width:100%; max-width:1200px; display:inline-block;">
        <div style="width:90%; display:inline-block; margin:0px; padding:0px;">
          <ul class="style_navigator" style="margin:0px; padding:0px;">
          <?php
          $lunbos = glob('lunbo/*.jpg');
          for ($k = 0; $k < count($lunbos); $k++) {          
          ?>
            <li onClick="mySwiper.slideTo(<?php echo $k;?>);" style="display:inline-block; width:<?php echo ((85 / count($lunbos)) - 1.2)?>%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; color:#4A4A4A;<?php echo $k == 0 ? '' : ' margin-left:4px;';?>"><?php echo str_replace('lunbo/', '', str_replace('.jpg', '', $lunbos[$k]));?></li>
          <?php
          }
          ?>
          </ul>
        </div>
      </div>
      <div class="swiper-container" style="margin-top:40px;">
		<div class="swiper-wrapper">
        <?php
        for ($k = 0; $k < count($lunbos); $k++) {
        ?>
          <div class="swiper-slide">
			<img src="<?php echo $lunbos[$k];?>" class="img-full">
		  </div>
        <?php
        }
        ?>
        </div>
        <div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
      </div>
    </section>
  <?php
              }
              else {
                  $columnValues = json_decode($composes[$j]['json'], true);
                  $columns = PLUGIN::$plugIns[$composes[$j]['plugInIndex']]['column'];
                  $dataArray = array();
                  for ($k = 0; $k < count($columns); $k++) {
                      $dataArray[$columns[$k]] = rawurldecode($columnValues[$k]);
                  }
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
  <?php            
              echo PLUGIN::setPlugIn($dataArray, $composes[$j]['plugInIndex']);
  ?>    
      </div>      
    </section>
  <?php       
              }
          }
      }
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
        <img src="<?php echo $pictures[$i]['folderName'] . '/' . $pictures[$i]['fileName'];?>" style="width:100%; margin:0px;"/>
      </div>
    </section>
  <?php  
  }
  for ($i = 0; $i < count($composes); $i++) {
      if ($composes[$i]['ordnung'] == -1) {
          $columnValues = json_decode($composes[$i]['json'], true);
          $columns = PLUGIN::$plugIns[$composes[$i]['plugInIndex']]['column'];
          $dataArray = array();
          for ($j = 0; $j < count($columns); $j++) {
              $dataArray[$columns[$j]] = rawurldecode($columnValues[$j]);
          }
          if ($composes[$i]['type'] != 'dialog' && $composes[$i]['type'] != 'bar') {    
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
  <?php            
              echo PLUGIN::setPlugIn($dataArray, $composes[$i]['plugInIndex']);
  ?>   
      </div>       
    </section>
  <?php 
          }
          elseif ($composes[$i]['type'] == 'dialog') {
              echo PLUGIN::setPlugIn($dataArray, $composes[$i]['plugInIndex']);
          }
          else{
              echo PLUGIN::setPlugIn($dataArray, $composes[$i]['plugInIndex']);
          }
      }
  }
  ?>
  <?php echo isset($values['body_codes']) ? $values['body_codes'] : '';?>
  </body>
</html>
<!--
<script src="gettoken.php"></script>
-->
<script type="text/javascript" language="javascript">
<!--//
var dialog = new Array();

<?php
foreach ($composes as $compose) {
    if ($compose['type'] == 'dialog') {
        $columns = PLUGIN::getPlugInsColumns($compose['plugInIndex']);
        $idIndex = -1;
        for ($i = 0; $i < count($columns['column']); $i++) {
            if ($columns['column'][$i] == 'id') {
                $idIndex = $i;
            }
        }
        $columnValues = json_decode($compose['json'], true);
        echo 'dialog.push(new DIALOG("' . rawurldecode($columnValues[$idIndex]) . '"));';
    }
}
?>
var time;
var mySwiper = new Swiper ('.swiper-container', {
  speed:500,
  autoplay:true,
  loop:true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay:{
    delay: 5000,
    stopOnLastSlide: false,
    disableOnInteraction: false,
  },
  on:{
    slideChange: function(){
      var index = parseInt(this.activeIndex) - 1;
      index = index > 5 ? 0: index;
      $(".style_navigator").find("li").css("border-bottom", "6px solid #e40112");
      $(".style_navigator").find("li:eq(" + index + ")").css("border-bottom", "6px solid #AAAAAA");
    },
  },
});     
function openDialog(id){
  if(document.getElementById(id)){
    for(var i = 0; i < dialog.length; i++){
      if(dialog[i].id == id){
        dialog[i].show();
      }
    }
  }
}
function closeDialog(id){
  if(document.getElementById(id)){
    for(var i = 0; i < dialog.length; i++){
      if(dialog[i].id == id){
        dialog[i].hide();
      }
    }
  }
}
$(document).ready(function(e) {
  /*
  $.ajax({
    type: "POST",
    url: "https://api.weixin.qq.com/marketing/user_actions/add?version=v1.0&access_token=" + token.access_token,
    data: {"type": "WEB","name": "test1","description": "test1"},
    dataType: "json",
    success: function(data) {
      console.log(data.data.user_action_set_id);
    },
    error: function(data) {
      console.log("error")
    }
  });
  var click_id = "<?php echo isset($_GET['gdt_vid']) ? $_GET['gdt_vid'] : '';?>";*/
});
//-->
</script>
<!-- VCS代码 -->
<script language="javascript" type="text/javascript">
<!--//
<?php
if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
?>
<?php
    if (isset($values['vcs_status']) && $values['vcs_status'] == '1') {
?>
getRegion();
<?php
        if (isset($values['geo_status']) && $values['geo_status'] == '1') {
?>
getCoordinate();
<?php
        }
?>
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();}};
<?php
    }
?>
<?php
}
?>
//-->
</script>