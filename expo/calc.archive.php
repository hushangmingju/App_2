<?php
include('../mobile/base.php');

$_SESSION['httpReferer'] = $_SERVER['HTTP_REFERER'];
$_SESSION['phpSelf'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$calcCount = $db->QueryData("SELECT COUNT(DISTINCT tel) as count FROM tb_expo_yuyue WHERE type = 'calc' AND status = 'ok'","all");
$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>沪尚茗居 报价器</title>
    <meta name="pathname" content="bytecom_tetris" />
    <meta name="keywords" content="<?=$kd_k?>" />
	  <meta name="description" content="<?=$kd_d?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui"/>
    <link rel="stylesheet" type="text/css" href="../mobile/css/s3.css" />
    <link rel="stylesheet" type="text/css" href="../css/font_led.css" />
    <?php require_once('../head_codes.inc');?>
  </head>
  <script src="../mobile/js/jquery-2.1.4.min.js"></script>
  <script src="../mobile/js/site.js" ></script>

  <body id="body" style="background-color: #ffffff">
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
	  e.addEventListener("resize",function(){clearTimeout(l),l=setTimeout(t,300)},!1),n(),"complete"===o.readyState?n():o.addEventListener("DOMContentLoaded",function(){n()},!1),t()}(    window);
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
                <img src="../mobile/images/calc01.jpg" class="image-item">
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
      <section id="frame-2" class="brick-frame brick-frame-server" style="background-color:rgb(243, 243, 243);">
        <a name="showcalc"></a>
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
          <div class="piece form-piece">
            <div class="form-piece-with-caculator">
              <div data-node="topCount" class="form-count">
                <span class="split-count"></span>
                <span data-node="countTextPre" class="count-text">目前已经有</span>
                <span data-node="countTextNum" class="count-text-num" id="CALC_SPAN_COUNT"><?php echo (5200 + $calcCount[0]['count']);?></span>
                <span data-node="countTextPos" class="count-text">人参与活动</span>
                <span class="split-count"></span>
              </div>
              <form id="CALC_FORM_CALC" class="form-group-i input-style2">                
                <div class="caculator">
                  <div id="CALC_FORM_CALC_TOTAL" class="caculator-display">000000</div>
                  <div class="caculator-body">
                    <div class="caculator-title">您的计算结果如上: </div>
                    <div class="caculator-warn"></div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i" style="color:rgb(0, 0, 0);">姓名</span>
                    <div class="m-input-text">
                      <input id="CALC_FORM_CALC_NAME" required="required" type="text" placeholder="" name="name" class="input-style form-input-i" />
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(0, 0, 0);">手机</span>
                    <div class="m-input-text">
                      <input id="CALC_FORM_CALC_TEL" required="required" type="text" placeholder="" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i" />
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div validate="number" class="input-group-i">
                    <span id="label" class="input-group-addon-i warn-star" style="color:rgb(0, 0, 0);">面积</span>
                    <div class="m-input-text">
                      <input id="CALC_FORM_CALC_AREA" required="required" type="text" placeholder="" validate="number" eleType="number" name="area" value="" class="input-style form-input-i" />
                      <span class="el-input-clear"></span>
                    </div>
                  </div>
                </div>
                <div class="form-element">
                  <div class="input-group-i">
                    <div id="submit-result" class="el-result"></div>
                    <button id="CALC_FORM_CALC_SUBMIT" type="submit" class="btn-i" style="border-radius:0.107rem;background-color:rgb(235, 92, 0) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:100%;">立刻获取整装报价</button>
                  </div>
                </div>
                <div data-node="recent-submit-content" class="recent-submit-content hide">
                  <div class="recent-title">最新报名客户</div>
                  <div class="recent-notification">
                    <i class="icon-notification2"></i>
                  </div>
                  <div class="swiper-container"></div>
                </div>
              </form>
              <div>
			    <style>.nor-btn {background-color: #f85959}.form-piece .recent-submit-content .recent-title {background-color: #f85959}</style>
              </div>
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
                <img src="../mobile/images/calc02.jpg" class="image-item">
              </a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>
      <section id="frame-4" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a target="_blank" href="javascript:void(0);" class="image-link">
                <div class="image-mask" style="background-color:none;"></div>
                <img src="../mobile/images/calc03.jpg" class="image-item">
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
                <img src="../mobile/images/calc04.jpg" class="image-item">
              </a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>
      <section id="frame-6" class="brick-frame brick-frame-server" style="background-color:rgba(27, 99, 100, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
            <div class="piece form-piece">
                <div>
                    <form id="CALC_FORM_RESV01">
                        <input type="hidden" name="type" value="expo"/>
                        <input type="hidden" name="referer" id="CALC_FORM_RESV01_REFERER"/>
                        <div class="form-element">
                            <div validate="name" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                                <div class="m-input-text">
                                    <input id="CALC_FORM_RESV01_NAME" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div validate="cellphone" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                                <div class="m-input-text">
                                    <input id="CALC_FORM_RESV01_TEL" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="input-group-i">
                                <div id="submit-result" class="el-result"></div>                              
                                <button type="submit" id="CALC_FORM_RESV01_SUBMIT" class="btn-i" style="border-radius:0.107rem;background-color:rgb(235, 92, 0) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
                            </div>
                        </div>
                    </form>
                    <script>
					$(document).ready(function() {
                      //utq('track', 'FormSubmit', '62605');
						$("#CALC_FORM_RESV01_SUBMIT").click(function(){
							var $name = $('#CALC_FORM_RESV01_NAME').val();
							var $mobile = $('#CALC_FORM_RESV01_TEL').val();
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
								data: $("#CALC_FORM_RESV01").serializeArray(),
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
      <section id="frame-7" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a target="_blank" href="javascript:void(0);" class="image-link">
                <div class="image-mask" style="background-color:none;"></div>
                <img src="../mobile/images/calc05.jpg" class="image-item">
              </a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>     
      <section id="frame-8" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a target="_blank" href="javascript:void(0);" class="image-link">
                <div class="image-mask" style="background-color:none;"></div>
                <img src="../mobile/images/calc06.jpg" class="image-item">
              </a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>     
      <section id="frame-9" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a target="_blank" href="javascript:void(0);" class="image-link">
                <div class="image-mask" style="background-color:none;"></div>
                <img src="../mobile/images/calc07.jpg" class="image-item">
              </a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>
      <section id="frame-10" class="brick-frame brick-frame-server" style="background-color:rgba(27, 99, 100, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
            <div class="piece form-piece">
                <div>
                    <form id="CALC_FORM_RESV02">
                        <input type="hidden" name="type" value="expo"/>
                        <input type="hidden" name="referer" id="CALC_FORM_RESV02_REFERER"/>
                        <div class="form-element">
                            <div validate="name" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">姓名</span>
                                <div class="m-input-text">
                                    <input id="CALC_FORM_RESV02_NAME" required="required" type="text" placeholder="方便我们礼貌称呼您" validate="name" eleType="name" name="name" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div validate="cellphone" class="input-group-i">
                                <span id="label" class="input-group-addon-i warn-star" style="color:rgb(200, 22, 29);">电话</span>
                                <div class="m-input-text">
                                    <input id="CALC_FORM_RESV02_TEL" required="required" type="text" placeholder="方便我们准确联系您" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i">
                                    <span class="el-input-clear"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-element">
                            <div class="input-group-i">
                                <div id="submit-result" class="el-result"></div>                              
                                <button type="submit" id="CALC_FORM_RESV02_SUBMIT" class="btn-i" style="border-radius:0.107rem;background-color:rgb(235, 92, 0) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:54%;">报名立享优惠</button>
                            </div>
                        </div>
                    </form>
                    <script>
					$(document).ready(function() {
                      //utq('track', 'FormSubmit', '62605');
						$("#CALC_FORM_RESV02_SUBMIT").click(function(){
							var $name = $('#CALC_FORM_RESV02_NAME').val();
							var $mobile = $('#CALC_FORM_RESV02_TEL').val();
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
								data: $("#CALC_FORM_RESV02").serializeArray(),
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
    </main>
</body>
</html>
<script language="javascript" type="text/javascript">
<!--//
document.getElementById('CALC_FORM_RESV01_REFERER').value = document.referrer;
document.getElementById('CALC_FORM_RESV02_REFERER').value = document.referrer;
    
$("#CALC_FORM_CALC_SUBMIT").click(function(){
  var $price = 1498;
  var $area = $('#CALC_FORM_CALC_AREA').val();
  var $mobile = $('#CALC_FORM_CALC_TEL').val();
  var $name = $('#CALC_FORM_CALC_NAME').val();
  if($mobile==""){
    alert('手机号不能为空');return false;
  }else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
    alert("手机号码格式不正确！"); return false;
  }else if($('#CALC_FORM_CALC_AREA').val()==""){
    alert('请填写您的房屋面积');
    return false;
  };
  var POSTDATA = {"type":'calc4',"calc-style":"清新雅居","calc-area":$area,"calc-price":$price,"tel":$mobile,"name":$name};			
			
  function calculation(elmId,number,delay,count){
	  if(document.getElementById(elmId) && !isNaN(number) && number > 0 &&  !isNaN(delay) && delay &&  !isNaN(count) && count){
      var timeID;
      var tempNumber = 0;
      var count = count || 10;
      var delay = delay || 300;
      var restCount = count;
      var periode = Math.ceil(delay/count);
      
      timerID = setInterval(rewrite, periode);      
	  }
    
    function rewrite(){
      if(restCount > 0){
        tempNumber = Math.ceil(number/restCount);
        document.getElementById(elmId).innerHTML = tempNumber;
        restCount--;
      }
      else{
        document.getElementById(elmId).innerHTML = number;
        clearInterval(timerID);
      }
    }
  }
			
  $.ajax({
    type: 'POST',
    url: "dml_svr.php",
    data: POSTDATA,
    dataType: "json",
    success: function(data) { 
      location.href = "#showcalc";
      calculation("CALC_FORM_CALC_TOTAL",($area * $price),3000,10);
      $('#CALC_SPAN_COUNT').text(data.count);
    },
	error: function(data) { 
      //alert("网络错误，请重试。");
    },				
  });
  return false;
});
//-->
</script>