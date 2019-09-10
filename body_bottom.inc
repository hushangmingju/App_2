			<div class="message container-full">
				<div class="container">
					<div class="forms row">
						<div class="row">
							<form action="" method="post" id="bottomyuyue">
                <input type="hidden" value="bottom" name="type">
                <input type="hidden" name="bultin" value="body_bottom_yuyue"/>
                <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
								<div class="col-6"><input type="text" value="" name="name" class="name" id="bottomyueyuename" placeholder="您的姓名" /></div>
								<div class="col-6"><input type="tel" value="" name="tel" class="phone" id="bottomyueyuetel" placeholder="您的联系号码" /></div>
							</form>
						</div>
						<div class="row mybtn"><a href="#" class="btn" id="bottomyueyuebutton">立即预约</a></div>
					</div>
					<div class="img">
						<img src="images/message_01.png"/>
					</div>
					<a href="javascript:;" class="message-close"></a>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
    <div class="footer container-full">
			<div class="contact container-full">
				<div class="container">
					<div class="col-10">						
            <div class="col-3">							
              <div class="icon"><img src="images/icon-tel.png" /></div>							
              <div style="display:inline-block;">
                <div style="font-size:14px; vertical-align:top;">
                  <div style="display:inline-block; vertical-align:top;">上海总部：</div>
                  <div style="display:inline-block;"><?php echo ($user && isset($user['tel']) ? $user['tel'] : '');?><br>021-31599932<br>021-31599928</div>
                </div>	
                <div style="font-size:14px; vertical-align:top;">
                  <div style="display:inline-block; vertical-align:top;">漳州市：</div>
                  <div style="display:inline-block; margin-left:12px;">0596-6199966</div>
                </div>
              </div>						
            </div>
            <div class="col-3">
              <div class="icon"><img src="images/icon-service.png" /></div>							
              <div style="display:inline-block;">
                <div style="font-size:14px; vertical-align:top;">
                  <div style="display:inline-block; vertical-align:top;">售后专线：</div>
                  <div style="display:inline-block;">021-24259321</div>
                </div>	
                <div style="font-size:14px; vertical-align:top;">
                  <div style="display:inline-block; vertical-align:top;">投诉专线：</div>
                  <div style="display:inline-block;">021-34127010</div>
                </div>
              </div>	
              <div class="icon" style="margin-top:12px;"><img src="images/icon-email.png" /></div>
              <div class="email" style="font-size:small; margin-top:12px;"><?php echo ($user && isset($user['email']) ? $user['email'] : '');?></div>
            </div>
            <div class="col-6">
              <div class="icon"><img src="images/icon-dingwei.png" /></div>
              <div class="email" style="padding-top:0; font-size:13px;"><?php echo ($user && isset($user['address']) ? $user['address'] : '');?></div>
            </div>
					</div>
					<div class="col-2">
						<div class="btns">
							<a href="http://map.baidu.com/?newmap=1&ie=utf-8&s=s%26wd%3D%E6%B2%AA%E5%B0%9A%E8%8C%97%E5%B1%85" target="_blank">实时地图</a>
						</div>
						<div class="qrcode"><img src="images/qrcode.png"/></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="copyright container">
				<div class="col-5"><a href="about.php">关于我们</a><a href="about.php">发展历程</a><a href="arclist.php">新闻中心</a><a href="jobs.php">招聘信息</a><a href="contact.php">联系我们</a></div>
				<div class="col-5">
                  <?php echo ($user && isset($user['copyright']) ? $user['copyright'] : '');?>
                </div>
                <div class="col-2" style=" text-align:right; padding-left:20px;">
                  <a href="http://218.242.124.22:8081/businessCheck/verifKey.do?showType=extShow&serial=9031000020161111145313000001376033-SAIC_SHOW_310000-4028e4cb641aec460164484dc1d579cf127&signData=MEUCIQD66z17Aotyq5sUOVLGf2+k0sk20kvKsrrmFQqjt7fm2AIgeFayk4UMdD0C/KCKx48bscSNhJWaaMG6RVHYjlNxwa4=" target="_blank" style="display:inline-block;"><img src="images/lz2.jpg" style="height:36px;"/></a>
                  <a href="https://zzlz.gsxt.gov.cn/businessCheck/verifKey.do?showType=p&serial=91310112MA1GB6D373-SAIC_CHECK_10002091310112MA1GB6D3731563517803929&signData=MEQCINybol1cSnw1LmEudCmtFoJrbjSm8tR0s3S2lUgXv53yAiDX6aJgII7iXi8bbAoF+AjjhJk7LRx5a9KSMznBGofDfQ==" target="_blank" style="display:inline-block;"><img src="https://zzlz.gsxt.gov.cn/images/lz4.png" style="height:36px;"/></a>
                </div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>		
		<div class="jisuan">
			<div class="jisuanqi">
				<a href="javascript:;" class="js-guan"></a>
				<div class="js-content">
					<h3>装修报价</h3>
					<div class="myinput">
						<span>风格：</span>
						<select name="style" id="calculator-style">
							<?php $sty=0; ?>
                            <?php
                            $yangban = new Query("`t1`.*, `t2`.`name` AS shopName", "`tb_wcp_showrooms` AS `t1`", "LEFT JOIN `tb_wcp_shops` AS `t2` ON `t1`.`shop` = `t2`.`id`", "`t1`.`status` = 1 AND `t1`.`priceList` IS NOT NULL AND `t1`.`priceList` != ''");
                            $yangban = DAS::quickQuery($yangban);
							if (DAS::hasData($yangban)) {
                                foreach ($yangban['data'] as $yangbanOpt) {
                                    echo '<option value="' . $yangbanOpt['id'] . '" ' . (isset($_GET['id']) && is_int(intval($_GET['id'])) && intval($_GET['id']) == $yangbanOpt['id'] ? 'selected="selected"' : '') . '>' . $yangbanOpt['name'] . '(' . $yangbanOpt['shopName'] . ')</option>';
                                }
							}							
							?>
						</select>
					</div>
                    <div class="myinput">
						<span>户型：</span>
						<select name="type" id="calculator-type">
							<option value="1111">1房1厅1厨1卫</option>
							<option value="2211">2房2厅1厨1卫</option>
							<option value="3211">3房2厅1厨1卫</option>
							<option value="3212">3房2厅1厨2卫</option>
							<option value="4212">4房2厅1厨2卫</option>
							<option value="5213">5房2厅1厨3卫</option>
						</select>
					</div>
					<div class="myinput" style="display:none">
						<span>单价：</span>
						<input type="tel" name="" id="calculator-price" value="0" disabled="disabled" />
						<span class="unit">元/平方米</span>
					</div>
					<div class="myinput">
						<span>面积：</span>
						<input type="tel" name="" id="calculator-area" value="" />
						<span class="unit">平方米</span>
					</div>
					<div class="myinput">
						<span>手机：</span>
						<input type="tel" name="" id="calculator-mobile" value="" />
						<span class="unit"></span>
					</div>
					<div class="myinput">
						<span>总价：</span>
						<input type="tel" name="" id="calculator-total" value="" disabled style="background-color:#fff;" />
						<span class="unit">元</span>
					</div>
					<a href="#" class="ljyy" id="calculator-yuyue">开始计算</a>
				</div>
			</div>
			<div class="jisuan-mask js-guan"></div>
		</div>		
		<div class="side">
			<ul>
				<li><a href="/promotions.php" target="_blank"><div class="sidebox"><img src="images/side_icon01.png">优惠活动</div></a></li>
        
				<li><a href="javascript:max_from_company_mini(this)"><div class="sidebox"><img src="images/icon-53.png"/>客服咨询</div></a></li>
				<!--<li><a href="tencent://message/?uin=3146304357&Site=QQ交谈&Menu=yes" target="_blank"><div class="sidebox"><img src="images/side_icon02.png">QQ在线客服</div></a></li>-->
				<li><a href="/yuyue.php" target="_blank"><div class="sidebox"><img src="images/side_icon03.png">预约装修</div></a></li>
				<li><a ><div class="sidebox tell"><img src="images/side_icon04.png">021-31599932</div></a></li>
				<li style="border:none;"><a href="javascript:goTop();" class="sidetop"><img src="images/side_icon05.png"></a></li>
			</ul>
		</div>
    <script type="text/javascript" language="javascript">
    <!--//   
		$(".side ul li").hover(function(){
			$(this).find(".sidebox").stop().animate({"width":"145px"},200).css({"opacity":"1","filter":"Alpha(opacity=100)","background":"#ae1c1c"});
			$(this).find(".sidebox.tell").stop().animate({"width":"170px"},200).css({"opacity":"1","filter":"Alpha(opacity=100)","background":"#ae1c1c"})		
		},function(){
			$(this).find(".sidebox").stop().animate({"width":"54px"},200).css({"opacity":"0.8","filter":"Alpha(opacity=80)","background":"#000"})	
		});
		
		function goTop(){
			$('html,body').animate({'scrollTop':0},600);
		}
   
     	$('.message-close').click(function() {
			$('.message').fadeOut();
		});

		$(document).ready(function() {
			$(".js-kai").click(function(){
				$(".jisuan").fadeIn()
			});
			
			$(".js-guan").click(function(){
				$(".jisuan").fadeOut()
			});
		});
		
		
		
/*
		$('#calculator-price').val($('#calculator-style').children('option:selected').val());
		$('#calculator-style').change(function(){
			$('#calculator-price').val($(this).children('option:selected').val());
		});
		$('#calculator-area').change(function(){
			if($('#calculator-area').val()==""){
				$('#calculator-total').val("");
			}else{
				//$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() ); //计算放到点击里计算
			}
		});
		$('#calculator-area').keyup(function(){
			if($('#calculator-area').val()==""){
				$('#calculator-total').val("");
			}else{
				//$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() ); //计算放到点击里计算
			}
		});*/
		
        var yangbanList = <?php echo json_encode($yangban['data']);?>;
        $("#calculator-yuyue").click(function(){       
            var $area = $('#calculator-area').val();
            $area = parseInt($area) > 180 || parseInt($area) < 50 ? 80 : parseInt($area);
            var $style = $('#calculator-style').children('option:selected').text();
			var $id = $('#calculator-style').children('option:selected').val();
            var $type = $('#calculator-type').children('option:selected').val();
            var $typeText = $('#calculator-type').children('option:selected').text();
            for(var i = 0; i < yangbanList.length; i++){
                if(yangbanList[i].id == $id){
                    var tempPriceList = yangbanList[i].priceList.split("%0D%0A");                    
                    for(var j = 0; j < tempPriceList.length; j++){
                        tempPrice = tempPriceList[j].split("%09");
                        if(Math.ceil($area) == parseInt(tempPrice[0])){
                            if(Math.ceil($area) > 59 && Math.ceil($area) < 66 && $type == tempPrice[1]){
                                var $total = Math.ceil(parseFloat(tempPrice[2].replace(/%20/, "")));
                            }
                            else{
                                var $total = Math.ceil(parseFloat(tempPrice[2].replace(/%20/, "")));
                            }
                            if(Math.ceil($area) == 80){
                                if(yangbanList[i].yangbanID != 26){
                                    $total = (Math.ceil($total/10)) * 10;
                                }
                                else{
                                    $total = 145310;
                                }
                                
                            }
                        }
                    }
                }
            }
			var $mobile = $('#calculator-mobile').val();
			var POSTDATA = {"type":'calc2',"bultin":"body_bottom_calc","phpSelf":"<?php echo $_SERVER['PHP_SELF'];?>","calc-style":$style,"calc-area":$area,"calc-price":$typeText,"calc-total":$total,"tel":$mobile};
			if($mobile==""){
				alert('手机号不能为空');return false;
			}else if(!$mobile.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
				alert("手机号码格式不正确！"); return false;
			}
			
			
				$('#calculator-total').val($total); 
				//window.location.href = "yuyue.php?s="+$style+"&p="+$price+"&a="+$area+"&t="+$total+"&mo="+$mobile;
				
			
				$.ajax({
				  type: 'POST',
				  url: "yuyuesave.php",
				  data: POSTDATA,
				  dataType: "json",
				  success: function(data) { 
				   //alert(data.TEXT);
				  },
				  error: function(data) { 
						//alert("网络错误，请重试。");
				  },
				
				});
				return false;

		});
        /*
        $("#calculator-yuyue").click(function(){
			var $style = $('#calculator-style').children('option:selected').text();
			var $price = $('#calculator-style').children('option:selected').val();
			var $area = $('#calculator-area').val();
			var $total = $('#calculator-total').val();
			var $mobile = $('#calculator-mobile').val();
			var POSTDATA = {"type":'calc2',"bultin":"body_bottom_calc","phpSelf":"<?php echo $_SERVER['PHP_SELF'];?>","calc-style":$style,"calc-area":$area,"calc-price":$price,"calc-total":$total,"tel":$mobile};
			if($mobile==""){
				alert('手机号不能为空');return false;
			}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
				alert("手机号码格式不正确！"); return false;
			}
			
			
				$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() ); 
				//window.location.href = "yuyue.php?s="+$style+"&p="+$price+"&a="+$area+"&t="+$total+"&mo="+$mobile;
				
			
				$.ajax({
				  type: 'POST',
				  url: "yuyuesave.php",
				  data: POSTDATA,
				  dataType: "json",
				  success: function(data) { 
				   //alert(""+data.msg);
				  },
				  error: function(data) { 
						//alert("网络错误，请重试。");
				  },
				
				});
				return false;

		});   */
    
		
		
		$("#bottomyueyuebutton").click(function(){
			var name = $('#bottomyueyuename').val();
			var tel = $('#bottomyueyuetel').val();
			
			if($('#bottomyueyuename').val()==""){
				alert('请填写您的姓名');
				return false;
			}else if($('#bottomyueyuetel').val()==""){
				alert('手机号不能为空');
				return false;
			}else if(!$('#bottomyueyuetel').val().match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
				alert("手机号码格式不正确！");
				return false;
			};
			
			$.ajax({
			  type: 'POST',
			  url: "yuyuesave.php",
			  data: $("#bottomyuyue").serializeArray(),
			  dataType: "json",
			  success: function(data) { 
			   alert(data.TEXT);
			  },
			  error: function(data) { 
					alert("网络错误，请重试。");
			  },
			});
			return false;
			
		});
		//-->
    </script>
<!-- CNZZ 代码 -->
<script src="https://s22.cnzz.com/z_stat.php?id=1275086047&web_id=1275086047" language="JavaScript"></script>