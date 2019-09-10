<?php
include('../mobile/base.php');

$_SESSION['httpReferer'] = $_SERVER['HTTP_REFERER'];
$_SESSION['phpSelf'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$calcCount = $db->QueryData("SELECT COUNT(*) as count FROM `yuyue` WHERE type = 'calc4' AND status = 'ok'","all");
$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
<!doctype html>
<html>
    <meta charset="utf-8">
    <meta name="pathname" content="bytecom_tetris" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui"/>
    <meta name="keywords" content="<?=$kd_k?>" />
	<meta name="description" content="<?=$kd_d?>" />
  <head>
    <meta charset="utf-8">
    <title>沪尚茗居 报价器</title>
    <link rel="stylesheet" type="text/css" href="../mobile/css/s3.css" />
    <link rel="stylesheet" type="text/css" href="../css/font_led.css" />
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
      <section id="frame-2" class="brick-frame brick-frame-server" style="background-color:rgb(243, 243, 243);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
          <div class="piece form-piece">
            <div class="form-piece-with-caculator">
              <div data-node="topCount" class="form-count">
                <span class="split-count"></span>
                <span data-node="countTextPre" class="count-text">目前已经有</span>
                <span data-node="countTextNum" class="count-text-num"><?php echo $calcCount[0]['count'];?></span>
                <span data-node="countTextPos" class="count-text">人参与活动</span>
                <span class="split-count"></span>
              </div>
              <form id="CALC_FORM_CALC" class="form-group-i input-style2">                
                <div class="caculator">
                  <div id="CALC_FORM_CALC_TOTAL" class="caculator-display">000000</div>
                  <div class="caculator-body">
                    <div class="caculator-title">您的计算结果如上: </div>
                    <div class="caculator-warn"></div>
                    <!--<ul class="caculator-items">
                      <li class="caculator-item">
                        <span class="caculator-key" style="color:rgb(0, 0, 0);">装修总价</span>
                        <span>: </span>
                        <span class="caculator-val">?</span>
                      </li>
                    </ul>-->
                  </div>
                </div>
                <div class="form-element">
                  <div validate="cellphone" class="input-group-i">
                    <span id="label" class="input-group-addon-i" style="color:rgb(0, 0, 0);">姓名</span>
                    <div class="m-input-text">
                      <input id="CALC_FORM_CALC_NAME" required="required" type="text" placeholder="" validate="cellphone" eleType="telphone" name="tel" class="input-style form-input-i" />
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
      <!--<section id="frame-2" class="brick-frame brick-frame-server" style="background-color:rgba(0, 0, 0, 0);">
        <div class="brick-mask" style="background-color:rgba(0, 0, 0, 0);"></div>
        <div class="brick-content">
          <div class="piece form-piece">
            <div>
              <form id="CALC_FORM_CALC" class="form-group-i input-style2">  
                  <input type="hidden" name="type" value="calc3"/>             
                  <div class="form-element">
                    <div validate="name" class="input-group-i">
                      <span class="input-group-addon-i" style="color:#808080;">姓名</span>
                      <div class="m-input-text">
                        <input required="required" type="text" placeholder=""name="name" id="CALC_FORM_CALC_NAME" class="input-style form-input-i">
                        <span class="el-input-clear"></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-element">
                    <div validate="cellphone" class="input-group-i">
                      <span class="input-group-addon-i warn-star" style="color:#808080;">电话</span>
                      <div class="m-input-text">
                        <input required="required" type="text" placeholder="" name="tel" id="CALC_FORM_CALC_TEL" class="input-style form-input-i">
                        <span class="el-input-clear"></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-element">
                    <div validate="number" class="input-group-i">
                      <span class="input-group-addon-i" style="color:#808080;">装修风格</span>
                      <div class="m-input-text">
                        <select name="style" id="CALC_FORM_CALC_STYLE" class="input-style selectMulti-group">
						  <option value="1498" >清新雅居</option>
						  <option value="1798" >摩登时代</option>
						  <option value="1698" >怡然风尚</option>
						  <option value="2398" >小美格调</option>
						  <option value="1858" >现代金雅典</option>
						  <option value="2498" >英式乡村</option>
						  <option value="2068" >时尚本真</option>
						  <option value="2398" >经典荣耀</option>
						  <option value="1898" >北欧风情</option>
						  <option value="1758" >都市旋律</option>
						  <option value="2498" >品欧生活</option>
						  <option value="1898" >逸美风情</option>
						  <option value="1698" >阳光海岸</option>
						  <option value="2798" >御景园</option>
						  <option value="1758" >北欧风尚</option>
						  <option value="1758" >轻时尚</option>
						  <option value="1958" >惟品居</option>
						  <option value="2398" >时尚慕弗</option>
						</select>
                        <span class="el-input-clear"></span>
                      </div>
                    </div>
                  </div>
			      <div class="myinput" style="display:none">
					<span>单价：</span>
					<input type="tel" name="" id="CALC_FORM_CALC_PRICE" value="0" disabled="disabled" />
					<span class="unit">元/平方米</span>
				  </div>
                  <div class="form-element">
                    <div validate="number" class="input-group-i">
                      <span class="input-group-addon-i warn-star" style="color:#808080;">装修面积</span>
                      <div class="m-input-text">
                        <input required="required" type="text" placeholder="" name="area" value="" id="CALC_FORM_CALC_AREA" class="input-style form-input-i">
                        <span class="el-input-clear"></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-element">
                    <div validate="number" class="input-group-i">
                      <span class="input-group-addon-i" style="color:#808080;">总价</span>
                      <div class="m-input-text">
                        <input required="required" type="text" placeholder="" value="" id="CALC_FORM_CALC_TOTAL" class="input-style form-input-i" disabled="disabled">
                        <span class="el-input-clear"></span>
                      </div>
                    </div>
                  </div>
                  <div class="form-element">
                    <div class="input-group-i">
                      <div id="submit-result" class="el-result"></div>
                      <button type="submit" class="btn-i" id="CALC_FORM_CALC_SUBMIT" style="border-radius:0.107rem;background-color:rgb(235, 92, 0) !important;color:#FFF;height:1.12rem;line-height:1.12rem;width:67%;">获取整装报价</button>
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
      </section>-->
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

$('#CALC_FORM_CALC_PRICE').val($('#CALC_FORM_CALC_STYLE').children('option:selected').val());
		$('#CALC_FORM_CALC_STYLE').change(function(){
			$('#CALC_FORM_CALC_PRICE').val($(this).children('option:selected').val());
		});
		$('#CALC_FORM_CALC_AREA').change(function(){
			if($('#CALC_FORM_CALC_AREA').val()==""){
				$('#CALC_FORM_CALC_TOTAL').val("");
			}else{
				//$('#calculator-total1').val( $('#calculator-price1').val() * $('#calculator-area1').val() ); //计算放到点击里计算
			}
		});
		$('#CALC_FORM_CALC_AREA').keyup(function(){
			if($('#CALC_FORM_CALC_AREA').val()==""){
				$('#CALC_FORM_CALC_TOTAL').val("");
			}else{
				//$('#calculator-total1').val( $('#calculator-price1').val() * $('#calculator-area1').val() ); //计算放到点击里计算
			}
		});
    
		$("#CALC_FORM_CALC_SUBMIT").click(function(){
			//var $style = $('#CALC_FORM_CALC_STYLE').children('option:selected').text();
			//var $price = $('#CALC_FORM_CALC_STYLE').children('option:selected').val();
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
			
			
				$('#CALC_FORM_CALC_TOTAL').text( $price * $('#CALC_FORM_CALC_AREA').val() ); 
				//window.location.href = "yuyue.php?s="+$style+"&p="+$price+"&a="+$area+"&t="+$total+"&mo="+$mobile;
				
			
				$.ajax({
				  type: 'POST',
				  url: "dml_svr.php",
				  data: POSTDATA,
				  dataType: "json",
				  success: function(data) { 
				    alert(""+data.msg);
				  },
				  error: function(data) { 
						//alert("网络错误，请重试。");
				  },
				
				});
				return false;

		});
//-->
</script>