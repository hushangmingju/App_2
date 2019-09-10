<?php
require_once('../top_tg.inc');

$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];

$expoYuyues = new Query("`tel`, `id`, `name`, `timestamp`", "`tb_expo_yuyue`", "", "`type` = 'yuyue' AND `status` = 'ok'", "`timestamp` DESC", "`tel`", "10");
$expoYuyues = DAS::quickQuery($expoYuyues);

$expoYuyues =  DAS::hasData($expoYuyues) ? $expoYuyues['data'] : false;

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
    <title>展会——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
    <link rel="stylesheet" type="text/css" href="../mobile/css/s3.css" />
    <link rel="stylesheet" type="text/css" href="../css/font_led.css" />
    <?php require_once('../mobile/head_codes.inc');?>
  </head>
  <script src="../mobile/js/site.js" ></script>

  <body id="body" style="background-color: #ffffff">
    <div id="GEO_LOCATION" style="display:none;"></div>
    <script type="text/javascript" language="javascript">
    <!--//
    !function(e){
	    function t(){
		    var e=d.getBoundingClientRect().width;
		    u=e/10, d.style.fontSize=u+"px";
	    }
	    function n(){
		    o.body&&(o.body.style.fontSize=14/(i/10)+"rem");
	    }
	    var i=375,o=e.document,d=o.documentElement,c=d.getBoundingClientRect().width,u=(window.devicePixelRatio||1,c/10),l=null;
	    e.addEventListener("resize",function(){clearTimeout(l),l=setTimeout(t,300)},!1),n(),"complete"===o.readyState?n():o.addEventListener("DOMContentLoaded",function(){n()},!1),t()
    }(window);
    //-->
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
                <img src="../mobile/images/expo17.jpg" class="image-item">
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
            <a href="tel:021-33588891" data-tel="021-33588891" tt-data-eventvalue="021-33588891" phone_number="021-33588891" class="tel-btn style1" style="background-color:rgb(89, 134, 248);color:#FFF;line-height:1.173rem;border-radius:0.107rem;border-width:0.027rem;border-color:rgba(0, 0, 0, 0);border-style:none;font-size:0.48rem;width:66%;height:1.173rem;">
              <i class="brick-i-tel-left icon-telphone_left"></i>
              <span class="tel-label text-ellipsis">拨打电话  咨询详情</span>
              <i class="brick-i-tel-right icon-telphone_right"></i>
              <i class="icon-telphone_circle brick-i-tel"></i>
              <i class="icon-left_arrow"></i>
            </a>
          </div>
        </div>
      </section>
      <script language="javascript" type="text/javascript">
      <!--//
      var initHeight = document.documentElement.clientHeight;     
      window.onresize = function(){
        if((initHeight - document.documentElement.clientHeight) > 100){
          document.getElementById("frame-14").style.display = "none";
        }
        else{
          document.getElementById("frame-14").style.display = "";
        }
      }
      //-->
      </script>
      <section id="frame-6" class="brick-frame brick-frame-server" style="background-color:rgba(27, 99, 100, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
          <div class="piece form-piece">
            <div>
              <form id="EXPO_YUYUE_FORM_1">
                <div class="form-element">
                  <div validate="name" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                    <div class="m-input-text">
                      <input type="hidden" name="type" value="yuyue"/>
                      <input type="hidden" name="bultin" value="expo/index_yuyue_01"/>
                      <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
                      <input id="EXPO_YUYUE_NAME_1" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                    <div class="m-input-text">
                      <input id="EXPO_YUYUE_TEL_1" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="input-group-i">
                    <div id="submit-result" class="el-result"></div>                              
                    <button type="submit" id="EXPO_YUYUE_SUBMIT_1" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
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
                        if($expoYuyues){
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
                        }
                      ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </form>
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
              <form id="EXPO_YUYUE_FORM_2">
                <div class="form-element">
                  <div validate="name" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                    <div class="m-input-text">
                      <input type="hidden" name="type" value="yuyue"/>
                      <input type="hidden" name="bultin" value="expo/index_yuyue_02"/>
                      <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
                      <input id="EXPO_YUYUE_NAME_2" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                    <div class="m-input-text">
                      <input id="EXPO_YUYUE_TEL_2" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="input-group-i">
                    <div id="submit-result" class="el-result"></div>                              
                    <button type="submit" id="EXPO_YUYUE_SUBMIT_2" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
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
                        if($expoYuyues){
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
                        }
                      ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </form>
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
              <form id="EXPO_YUYUE_FORM_3">
                <div class="form-element">
                  <div validate="name" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                    <div class="m-input-text">
                      <input type="hidden" name="type" value="yuyue"/>
                      <input type="hidden" name="bultin" value="expo/index_yuyue_03"/>
                      <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
                      <input id="EXPO_YUYUE_NAME_3" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                    <div class="m-input-text">
                      <input id="EXPO_YUYUE_TEL_3" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="input-group-i">
                    <div id="submit-result" class="el-result"></div>                              
                    <button type="submit" id="EXPO_YUYUE_SUBMIT_3" class="btn-i" style="border-radius:0.107rem;background-color:rgb(9, 160, 34) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
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
                        if($expoYuyues){
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
                        }
                      ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </form>
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
  </body>
</html>
<script src="//api.map.baidu.com/api?ak=p4FTFpD8nfUUqK3yRUgvIGOs&v=2.0&s=1"></script>
<script type="text/javascript" language="javascript">
<!--//
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


                
$(document).ready(function() {  
	$("#EXPO_YUYUE_SUBMIT_1").click(function(){
    utq('track', 'FormSubmit', '62605');
		var $name = $('#EXPO_YUYUE_NAME_1').val();
		var $mobile = $('#EXPO_YUYUE_TEL_1').val();
		if($name == ""){
			alert('请填写您的姓名');
			return false;
		}
    else if($mobile==""){
			alert('手机号不能为空');
			return false;
		}
    else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
			alert("手机号码格式不正确！");
			return false;
		};
    
    $.ajax({
			type: 'POST',
			url: "dml_svr.php",
			data: $("#EXPO_YUYUE_FORM_1").serializeArray(),
			dataType: "json",                
			success: function(data) { 
				alert(data.TEXT);
			},
			error: function(data) { 
				alert("信息提交成功！");
			},
		});
		return false;
	});
  $("#EXPO_YUYUE_SUBMIT_2").click(function(){
    utq('track', 'FormSubmit', '62605');
		var $name = $('#EXPO_YUYUE_NAME_2').val();
		var $mobile = $('#EXPO_YUYUE_TEL_2').val();
		if($name == ""){
			alert('请填写您的姓名');
			return false;
		}
    else if($mobile==""){
			alert('手机号不能为空');
			return false;
		}
    else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
			alert("手机号码格式不正确！");
			return false;
		};
    
    $.ajax({
			type: 'POST',
			url: "dml_svr.php",
			data: $("#EXPO_YUYUE_FORM_2").serializeArray(),
			dataType: "json",                
			success: function(data) { 
				alert(data.TEXT);
			},
			error: function(data) { 
				alert("信息提交成功！");
			},
		});
		return false;
	});
  $("#EXPO_YUYUE_SUBMIT_3").click(function(){
    utq('track', 'FormSubmit', '62605');
		var $name = $('#EXPO_YUYUE_NAME_3').val();
		var $mobile = $('#EXPO_YUYUE_TEL_3').val();
		if($name == ""){
			alert('请填写您的姓名');
			return false;
		}
    else if($mobile==""){
			alert('手机号不能为空');
			return false;
		}
    else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
			alert("手机号码格式不正确！");
			return false;
		};
    
    $.ajax({
			type: 'POST',
			url: "dml_svr.php",
			data: $("#EXPO_YUYUE_FORM_3").serializeArray(),
			dataType: "json",                
			success: function(data) { 
				alert(data.TEXT);
			},
			error: function(data) { 
				alert("信息提交成功！");
			},
		});
		return false;
	});
});

$(function(){
  $(".swiper-wrapper").textSlider({
    line:1
  });
})
//-->
</script>
<?php
require_once('../bottom_tg.inc');
?>

