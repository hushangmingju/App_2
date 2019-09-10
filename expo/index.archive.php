<?php
include('../mobile/base.php');

$_SESSION['httpReferer'] = $_SERVER['HTTP_REFERER'];
$_SESSION['phpSelf'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];

$expoYuyues = $db->QueryData("SELECT * FROM `tb_expo_yuyue` WHERE type = 'yuyue' AND status = 'ok' ORDER BY timestamp DESC LIMIT 10","all");

function getTimeOffset($timestamp){
  $timeArr1 = explode(' ', $timestamp);
  $timeArr2 = explode('-', $timeArr1[0]);
  $timeArr3 = explode(':', $timeArr1[1]);
  $timestamp = mktime($timeArr3[0], $timeArr3[1], $timeArr3[2], $timeArr2[1], $timeArr2[2], $timeArr2[0]);
  $offset = time() - $timestamp;
  $offset = intdiv($offset, 60);
  $today = explode('-', date('Y-m-d'));
  $today = mktime(0, 0, 0, $today[1], $today[2], $today[0]);
  if($offset < 60){
    return $offset . '分钟前';
  }
  elseif($timestamp > $today){
    return intdiv($offset, 60) . '小时前';
  }
  else{
    $offset = intdiv(($offset - intdiv(time() - $today)), 1440) + 1;
    return $offset . '天前';
  }
}
function editTel($tel){
  $et = substr($tel, 0, 4);
  $et .= '****';
  $et .= substr($tel, 8);
  return $et;
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="pathname" content="bytecom_tetris" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="icon" href="http://ad.toutiao.com/favicon.ico" type="image/x-icon" />
    <style type="text/css" >@charset "utf-8";html{color:#000;overflow-y:scroll;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-family:Arial,Helvetica,'Hiragino Sans GB','Microsoft YaHei',sans-serif}html *{outline:0;-webkit-text-size-adjust:none;-webkit-tap-highlight-color:rgba(0,0,0,0);box-sizing:border-box;margin:0;padding:0}html input{font-family:Arial,Helvetica,'Hiragino Sans GB','Microsoft YaHei',sans-serif}table{border-collapse:collapse;border-spacing:0}fieldset,img{border:0}del{text-decoration:line-through}address,caption,cite,code,dfn,em,th,var{font-style:normal;font-weight:500}ol,ul{list-style:none}caption,th{text-align:left}a:hover{text-decoration:underline}ins,a{text-decoration:none}html,body{width:100%}body{background-color:#FFF;line-height:1.5}#content{width:100%;margin:0 auto}.piece{width:100%;background-color:transparent;position:relative;box-sizing:border-box}.piece.fbottom,.piece.ftop{position:fixed!important;width:100%!important;z-index:10!important}.create-left-content{width:1.867rem;height:auto;text-align:center;z-index:9999;position:fixed;bottom:0;left:0}.create-right-content{width:1.867rem;height:auto;text-align:center;z-index:9999;position:fixed;bottom:0;right:0}.piece.fbottom{top:auto!important;bottom:0!important}.piece.ftop{top:0!important;bottom:auto!important}#content{min-height:100%;position:relative;overflow:hidden}#MEIQIA-PANEL-HOLDER{right:0!important}html::-webkit-scrollbar{display:none}.hide{display:none!important}</style>
    <link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/swiper_302abfc.css" /><link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/ledfont_ccb326d.css" /><link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/daymode_1ae66db.css" /><link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/notice_7471b49.css" />
    <link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/bricks/bricks-common_6c02f99.css" />
    <script id="globalvar">
        GLOBAL_VAR = JSON.parse('{"siteId":"1601967623808014","pageIds":[1601967623808014],"pageid_map":{"378560":1601967623808014},"shareTitle":"展会","name":"展会","shareDesc":"","shareThumb":""}');
        componentsConfig = {
            PanoramaList: []
        }
    </script>
    <script src="//s3.pstatp.com/bytecom/resource/vue/lib/vendor_293fa4c.js"></script>
	<script src="//res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
	<!--<script src="//s3.pstatp.com/bytecom/resource/vue/lib/main_5fdef5d.js"></script>-->
  <script src="../mobile/js/jquery-2.1.4.min.js"></script>
	<script src="../mobile/js/site.js" ></script>
    <link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/brand_5a9c6d0.css" />
    <link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/iconfont_03f5f23.css" />
    <link rel="stylesheet" type="text/css" href="//s3.pstatp.com/bytecom/resource/vue/lib/brickicon_2e09b13.css" />
    <!-- 替换为Vue模板语法 -->
    
    <title>展会——一站式整体家装服务</title>

<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
			.textinfo img{display:block; width:100%; height:auto;}
		</style>
    <?php require_once('../head_codes.inc');?>
		<script>
    (function(w,d,t,s,q,m,n){if(w.utq)return;q=w.utq=function(){q.process?q.process(arguments):q.queue.push(arguments);};q.queue=[];m=d.getElementsByTagName(t)[0];n=d.createElement(t);n.src=s;n.async=true;m.parentNode.insertBefore(n,m);})(window,document,'script','https://image.uc.cn/s/uae/g/0s/ad/utracking.js');utq('set', 'convertMode', true);utq('set', 'trackurl', 'huichuan.sm.cn/lp');
		</script>


            <script>
            !function(){"use strict";!function(t,e){var r=t.seed=t.seed||[];if(r.start=+new Date,!r.initialize&&!r.invoked){r.invoked=!0,r.methods=["track","page","on","once"],r.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);return e.unshift(t),r.push(e),r}};for(var n=0;n<r.methods.length;n++){var a=r.methods[n];r[a]=r.factory(a)}r.load=function(){var t=e.createElement("script");t.type="text/javascript",t.async=!0,t.src="//s3.pstatp.com/bytecom/resource/tetris/insight/v0.1-beta/analytics.js";var r=e.getElementsByTagName("script")[0];r.parentNode.insertBefore(t,r)},r.SNIPPET_VERSION="1.1.8",r.load()}}(window,document)}();
            </script>
            <style>.clearfix::after{display:block;content:"";clear:both}</style>
            <script>
            !function(){  try{window.addEventListener("DOMContentLoaded",function(){document.querySelectorAll(".form-tel-autofillbtn").forEach(function(ele){ele.parentElement.remove()})})}catch(e){};  }();
            </script>
            </head>

<body id="body" style="background-color: #ffffff">
<?php
//$nav=10;
//include('header.php');
?>
<!--<div style="display:block; height:30px;"></div>-->
<script type="text/javascript">
  !function(e){
	  function t(){
		  var e=d.getBoundingClientRect().width;
		  u=e/10, d.style.fontSize=u+"px";
	  }
	  function n(){
		  o.body&&(o.body.style.fontSize=14/(i/10)+"rem");
	  }
	  var i=375,o=e.document,d=o.documentElement,c=d.getBoundingClientRect().width,u=(window.devicePixelRatio||1,c/10),l=null;
	  e.addEventListener("resize",function(){clearTimeout(l),l=setTimeout(t,300)},!1),n(),"complete"===o.readyState?n():o.addEventListener("DOMContentLoaded",function(){n()},!1),t()}(window);
</script>
<main data-server-rendered="true">
    <span></span>
    <section id="frame-1" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo21.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>    
    <section id="frame-14" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;background-color:rgba(0, 0, 0, 0);left:0;bottom:0;position:fixed;z-index:21;top:auto;">
      <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
      <div class="brick-content">
        <div class="piece telephone-button">
          <a href="tel:021-34127010" data-tel="021-34127010" tt-data-eventvalue="021-34127010" phone_number="021-34127010" class="tel-btn style1" style="background-color:rgb(89, 134, 248);color:#FFF;line-height:1.173rem;border-radius:0.107rem;border-width:0.027rem;border-color:rgba(0, 0, 0, 0);border-style:none;font-size:0.48rem;width:66%;height:1.173rem;">
            <i class="brick-i-tel-left icon-telphone_left"></i>
            <span class="tel-label text-ellipsis">拨打电话  咨询详情</span>
            <i class="brick-i-tel-right icon-telphone_right"></i>
            <i class="icon-telphone_circle brick-i-tel"></i>
            <i class="icon-left_arrow"></i>
          </a>
        </div>
      </div>
    </section>
    <section id="frame-6" class="brick-frame brick-frame-server" style="background-color:rgba(27, 99, 100, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
            <div class="piece form-piece">
                <div>
                    <form id="a6">
                        <div class="form-element">
                            <div validate="name" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                                <div class="m-input-text">
                                    <input type="hidden" name="type" value="expo"/>
                                    <input type="hidden" name="referer" id="referer"/>
                                    <input id="name" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div validate="cellphone" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                                <div class="m-input-text">
                                    <input id="tel" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="input-group-i">
                                <div id="submit-result" class="el-result"></div>                              
                                <button type="submit" id="expo_yuyue_submit" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
                                <input type="reset" id="reset" style="display:none;">
                            </div>
                        </div>
                        <div data-node="recent-submit-content" class="recent-submit-content style1">
                            <div class="recent-title">最新报名客户</div>
                            <div class="recent-notification">
                                <i class="icon-notification2"></i>
                            </div>
                            <div style="display:block; height:160px; overflow:hidden; width:100%;">
                            
                                <div class="swiper-wrapper" style="transform: translate3d(0px, -319.5px, 0px); transition-duration: 0ms; padding-top:240px; width:100%;">
                                    <ul>
                                        <?php
                                          for($i = 0; $i < count($expoYuyues); $i++){
                                            $index = $i % 4;
                                            switch($index){
                                              case 0:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="height: 53.25px;">';
                                                break;
                                              case 1:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="1" style="height: 53.25px;">';
                                                break;
                                              case 2:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="2" style="height: 53.25px;">';
                                                break;
                                              case 3:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" style="height: 53.25px;">';
                                                break;
                                            }
                                            echo '<span class="text name">' . $expoYuyues[$i]['name'] . '</span>';
                                            echo '<span class="text phone" style="position:absolute; left:110px;">' . editTel($expoYuyues[$i]['tel']) . '</span>';
                                            echo '<span class="text time" style="position:absolute; left:255px; width: 60px; text-align:right;">' . getTimeOffset($expoYuyues[$i]['timestamp']) . '</span>';
                                            echo '</li>';
                                          }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
					$(document).ready(function() {
            utq('track', 'FormSubmit', '62605');
						$("#expo_yuyue_submit").click(function(){
							var $name = $('#name').val();
							var $mobile = $('#tel').val();
							if($name == ""){
								alert('请填写您的姓名');
								return false;
							}else if($mobile==""){
								alert('手机号不能为空');
								return false;
							}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
								alert("手机号码格式不正确！");
								return false;
							};
              
							
							
                
							$.ajax({
								type: 'POST',
								url: "dml_svr.php",
								data: $("#a6").serializeArray(),
								dataType: "json",
                
								success: function(data) { 
									alert("信息提交成功！");
								},
								error: function(data) { 
									alert("信息提交成功！");
								},
							});
							return false;
						});
					});
					</script>
                    <div>
	                    <style>.nor-btn {background-color: #f85959}.form-piece .recent-submit-content .recent-title {background-color: #f85959}</style>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-2" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo22.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-3" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo23.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-5" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo24.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-9" class="brick-frame brick-frame-server" style="background-color:rgba(0, 0, 0, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
            <div class="piece form-piece">
                <div>
                    <form id="a9">
                        <div class="form-element">
                            <div validate="name" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                                <div class="m-input-text">
                                    <input type="hidden" name="type" value="expo"/>
                                    <input type="hidden" name="referer" id="referer1"/>
                                    <input id="name1" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div validate="cellphone" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                                <div class="m-input-text">
                                    <input id="tel1" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="input-group-i">
                                <div id="submit-result" class="el-result"></div>                              
                                <button type="submit" id="expo_yuyue_submit" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
                                <input type="reset" id="reset" style="display:none;">
                            </div>
                        </div>
                        <div data-node="recent-submit-content" class="recent-submit-content style1">
                            <div class="recent-title">最新报名客户</div>
                            <div class="recent-notification">
                                <i class="icon-notification2"></i>
                            </div>
                            <div style="display:block; height:160px; overflow:hidden; width:100%;">
                            
                                <div class="swiper-wrapper" style="transform: translate3d(0px, -319.5px, 0px); transition-duration: 0ms; padding-top:240px; width:100%;">
                                    <ul>
                                        <?php
                                          for($i = 0; $i < count($expoYuyues); $i++){
                                            $index = $i % 4;
                                            switch($index){
                                              case 0:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="height: 53.25px;">';
                                                break;
                                              case 1:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="1" style="height: 53.25px;">';
                                                break;
                                              case 2:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="2" style="height: 53.25px;">';
                                                break;
                                              case 3:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" style="height: 53.25px;">';
                                                break;
                                            }
                                            echo '<span class="text name">' . $expoYuyues[$i]['name'] . '</span>';
                                            echo '<span class="text phone" style="position:absolute; left:110px;">' . editTel($expoYuyues[$i]['tel']) . '</span>';
                                            echo '<span class="text time" style="position:absolute; left:255px; width: 60px; text-align:right;">' . getTimeOffset($expoYuyues[$i]['timestamp']) . '</span>';
                                            echo '</li>';
                                          }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
					$(document).ready(function() {
            utq('track', 'FormSubmit', '62605');
            
						$("#expo_yuyue_submit").click(function(){
							var $name = $('#name1').val();
							var $mobile = $('#tel1').val();
							if($name == ""){
								alert('请填写您的姓名');
								return false;
							}else if($mobile==""){
								alert('手机号不能为空');
								return false;
							}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
								alert("手机号码格式不正确！");
								return false;
							};
							
							$.ajax({
								type: 'POST',
								url: "dml_svr.php",
								data: $("#a9").serializeArray(),
								dataType: "json",
								success: function(data) { 
									alert("信息提交成功！");
								},
								error: function(data) { 
									alert("信息提交成功！");
								},
							});
							return false;
						});
					});
					</script>
                    <div>
			            <style>.nor-btn {background-color: #f85959}.form-piece .recent-submit-content .recent-title {background-color: #f85959}</style>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-5" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo25.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-5" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
                <div class="image-box" style="-webkit-clip-path:none;">
                    <a target="_blank" href="javascript:void(0);" class="image-link">
                        <div class="image-mask" style="background-color:none;"></div>
                        <img src="../mobile/images/expo26.jpg" class="image-item">
                    </a>
                    <span class="image-text"></span>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-9" class="brick-frame brick-frame-server" style="background-color:rgba(0, 0, 0, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
            <div class="piece form-piece">
                <div>
                    <form id="a7">
                        <div class="form-element">
                            <div validate="name" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                                <div class="m-input-text">
                                    <input type="hidden" name="type" value="expo"/>
                                    <input type="hidden" name="referer" id="referer2"/>
                                    <input id="name2" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div validate="cellphone" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                                <div class="m-input-text">
                                    <input id="tel2" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="input-group-i">
                                <div id="submit-result" class="el-result"></div>                              
                                <button type="submit" id="expo_yuyue_submit" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
                                <input type="reset" id="reset" style="display:none;">
                            </div>
                        </div>
                        <div data-node="recent-submit-content" class="recent-submit-content style1">
                            <div class="recent-title">最新报名客户</div>
                            <div class="recent-notification">
                                <i class="icon-notification2"></i>
                            </div>
                            <div style="display:block; height:160px; overflow:hidden; width:100%;">
                            
                                <div class="swiper-wrapper" style="transform: translate3d(0px, -319.5px, 0px); transition-duration: 0ms; padding-top:240px; width:100%;">
                                    <ul>
                                        <?php
                                          for($i = 0; $i < count($expoYuyues); $i++){
                                            $index = $i % 4;
                                            switch($index){
                                              case 0:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate" data-swiper-slide-index="0" style="height: 53.25px;">';
                                                break;
                                              case 1:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-prev" data-swiper-slide-index="1" style="height: 53.25px;">';
                                                break;
                                              case 2:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="2" style="height: 53.25px;">';
                                                break;
                                              case 3:
                                                echo '<li class="recent-submit-item threecol swiper-slide swiper-slide-duplicate swiper-slide-duplicate-next" data-swiper-slide-index="3" style="height: 53.25px;">';
                                                break;
                                            }
                                            echo '<span class="text name">' . $expoYuyues[$i]['name'] . '</span>';
                                            echo '<span class="text phone" style="position:absolute; left:110px;">' . editTel($expoYuyues[$i]['tel']) . '</span>';
                                            echo '<span class="text time" style="position:absolute; left:255px; width: 60px; text-align:right;">' . getTimeOffset($expoYuyues[$i]['timestamp']) . '</span>';
                                            echo '</li>';
                                          }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                    <script>
					$(document).ready(function() {
            utq('track', 'FormSubmit', '62605');
            
						$("#expo_yuyue_submit").click(function(){
							var $name = $('#name2').val();
							var $mobile = $('#tel2').val();
							if($name == ""){
								alert('请填写您的姓名');
								return false;
							}else if($mobile==""){
								alert('手机号不能为空');
								return false;
							}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
								alert("手机号码格式不正确！");
								return false;
							};
							
							$.ajax({
								type: 'POST',
								url: "dml_svr.php",
								data: $("#a7").serializeArray(),
								dataType: "json",
								success: function(data) { 
									alert("信息提交成功！");
								},
								error: function(data) { 
									alert("信息提交成功！");
								},
							});
							return false;
						});
					});
					</script>
                    <div>
			            <style>.nor-btn {background-color: #f85959}.form-piece .recent-submit-content .recent-title {background-color: #f85959}</style>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="frame-10" class="brick-frame brick-frame-server">
        <div class="brick-mask"></div>
        <div class="brick-content">
            <div>
                <div class="piece clearfix brick-map map-style4">
                    <div class="map-con">
                        <div id="a12" class="bd-map" style="height:6.2rem;"></div>
                        <a href="//api.map.baidu.com/marker?location=31.024916,121.255327&amp;title=%E4%B8%8A%E6%B5%B7%E5%B8%82%E6%9D%BE%E6%B1%9F%E5%8C%BA%E6%B2%AA%E5%B0%9A%E8%8C%97%E5%B1%85%E5%AE%B6%E8%A3%85%E5%B7%A5%E5%8E%82&amp;content=%E4%B8%8A%E6%B5%B7%E5%B8%82%E6%9D%BE%E6%B1%9F%E5%8C%BA%E6%B2%AA%E5%B0%9A%E8%8C%97%E5%B1%85%E5%AE%B6%E8%A3%85%E5%B7%A5%E5%8E%82&amp;output=html&amp;src=baidu" target="_blank" tt-data-click="click" tt-data-eventtype="map" class="overlay"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
    <?php
//include('footer.php');
?>
</body>
<script src="//s3.pstatp.com/bytecom/resource/vue/lib/toutiao-tetris-analytics-init_a60908f.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/track_log/src/tetris-user-action.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/lib/daymode_c65fed4.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/lib/base64_68e8d03.js"></script>
<script src="//api.map.baidu.com/api?ak=p4FTFpD8nfUUqK3yRUgvIGOs&v=2.0&s=1"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/lib/swiper_d5340fc.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/lib/notice_584309a.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/bricks/Form/script.landing_51252e4.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/bricks/TelephoneButton/script.landing_8888577.js"></script>
<script src="//s3.pstatp.com/bytecom/resource/vue/bricks/Map/script.landing_48406e5.js"></script>
<script>
document.getElementById('referer1').value = document.referrer;
document.getElementById('referer2').value = document.referrer;
document.getElementById('referer').value = document.referrer;
(function(w,d,t,s,q,m,n){
  if(w.utq)
    return;
  q=w.utq=function(){
    q.process?q.process(arguments):q.queue.push(arguments);
  };
  q.queue=[];
  m=d.getElementsByTagName(t)[0];
  n=d.createElement(t);
  n.src=s;
  n.async=true;
  m.parentNode.insertBefore(n,m);
  }
)(window,document,'script','https://image.uc.cn/s/uae/g/0s/ad/utracking.js');
utq('set', 'convertMode', true);
utq('set', 'trackurl', 'huichuan.sm.cn/lp');

    
 (function($){		
 $.fn.textSlider = function(options){
   var defaults = { //初始化参数
      scrollHeight:25,
      line:1,
      speed:'normal',
      timer:3000
   };
   var opts = $.extend(defaults,options);
   this.each(function(){
     var timerID;
     var obj = $(this);
     var $ul = obj.children("ul");
     var $height = $ul.find("li").height();
     var $Upheight = 0-opts.line*$height;
     obj.hover(function(){
       clearInterval(timerID);
     },function(){
       timerID = setInterval(moveUp,opts.timer);
       });
     function moveUp(){
       $ul.animate({"margin-top":$Upheight},opts.speed,function(){
          for(i=0;i<opts.line;i++){ //只有for循环了才可以设置一次滚动的行数
           $ul.find("li:first").appendTo($ul);
          }
         $ul.css("margin-top",0);
       });
     };
     timerID = setInterval(moveUp,opts.timer);
     });
   };
})(jQuery)
</script>
<script>
$(function(){
  $(".swiper-wrapper").textSlider({
    line:1
    });
  })
</script>
</html>
