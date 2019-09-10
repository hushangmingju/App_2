
			<div class="message container-full">
				<div class="container">
					<div class="forms row">
						<div class="row"><form action="" method="post" id="bottomyuyue"><input type="hidden" value="bottom" name="type">
							<div class="col-6"><input type="text" id="" value="" name="name" class="name" id="bottomyueyuename" placeholder="您的姓名" /></div>
							<div class="col-6"><input type="tel" id="" value="" name="tel" class="phone" id="bottomyueyuetel" placeholder="您的联系号码" /></div></form>
						</div>
						<div class="row mybtn"><a href="#" class="btn" id="bottomyueyuebutton">立即预约</a></div>
					</div>
					<div class="img">
						<img src="images/message.png"/>
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
						<div class="col-2">
							<a href="#" class="icon"><img src="images/icon-wechat.png"/><span class="scancode transition"><img src="images/scancode-foot.png"/></span></a>
							<a href="tencent://message/?uin=906469923&Site=QQ交谈&Menu=yes" class="icon"><img src="images/icon-qq.png"/></a>
						</div>
						<div class="col-14" >
							<div class="icon"><img src="images/icon-tel.png"/></div>
							<div class="email">021-33888832</div>
						</div>
						
						<div class="col-3" >
							<div class="icon"><img src="images/icon-email.png"/></div>
							<div class="email">906469923@qq.com</div>
						</div>
						
						<div class="col-4">
							<div class="icon"><img src="images/icon-dingwei.png"/></div>
							<div class="email">上海市闵行区颛兴东路1280弄5号楼</div>
						</div>

					</div>
					<div class="col-2">
						<div class="btns">
							<!--<a href="http://j.map.baidu.com/WfXcC" target="_blank">发送地址到手机</a>-->
							<a href="http://j.map.baidu.com/WfXcC" target="_blank">实时地图</a>
						</div>
						<div class="qrcode"><img src="images/qrcode.png"/></div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="copyright container">
				<div class="col-6"><a href="#">关于我们</a><a href="#">发展历程</a><a href="#">新闻中心</a><a href="#">招聘信息</a><a href="#">联系我们</a></div>
				<div class="col-6">Copyrights &copy; HSMJ,All rights reserved.</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		
		
		<div class="jisuan">
			<div class="jisuanqi">
				<a href="javascript:;" class="js-guan"></a>
				<div class="js-content">
					<h3>计算器</h3>
					<div class="myinput">
						<span>风格：</span>
						<select name="style" id="calculator-style">
							<option value="1298" selected="selected">清新雅居</option>
							<option value="1698">摩登时代</option>
							<option value="1968">时尚本真</option>
							<option value="1598">都市旋律</option>
							<option value="1568">怡然风尚</option>
							<option value="2298">风情地中海</option>
							<option value="2398">英式乡村</option>
							<option value="2298">小美格调</option>
							<option value="2198">时尚中式</option>
							<option value="2198">荣耀经典</option>
						</select>
					</div>
					<div class="myinput">
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
						<span>总价：</span>
						<input type="tel" name="" id="calculator-total" value="" />
						<span class="unit">元</span>
					</div>
					<a href="?yuyue.php" class="ljyy" id="calculator-yuyue">立即预约</a>
				</div>
			</div>
			<div class="jisuan-mask js-guan"></div>
		</div>
		
		
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/swiper.3.1.2.min.js"></script>


   <script>
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
		
		
		
		
		
		
		$('#calculator-price').val($('#calculator-style').children('option:selected').val());
		$('#calculator-style').change(function(){
			$('#calculator-price').val($(this).children('option:selected').val());
		});
		$('#calculator-area').change(function(){
			if($('#calculator-area').val()==""){
				$('#calculator-total').val("");
			}else{
				$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() );
			}
		});
		$('#calculator-area').keyup(function(){
			if($('#calculator-area').val()==""){
				$('#calculator-total').val("");
			}else{
				$('#calculator-total').val( $('#calculator-price').val() * $('#calculator-area').val() );
			}
		});
		$("#calculator-yuyue").click(function(){
			var $style = $('#calculator-style').children('option:selected').text();
			var $price = $('#calculator-style').children('option:selected').val();
			var $area = $('#calculator-area').val();
			var $total = $('#calculator-total').val();
			window.location.href = "yuyue.php?s="+$style+"&p="+$price+"&a="+$area+"&t="+$total;
			return false;
		});
		
		
		$("#bottomyueyuebutton").click(function(){
			var name = $('#bottomyueyuename').val();
			var tel = $('#bottomyueyuetel').val();
$.ajax({
  type: 'POST',
  url: "yuyuesave.php",
  data: $("#bottomyuyue").serializeArray(),
  dataType: "json",
  success: function(data) { 
   alert(""+data.msg);
  },
  error: function(data) { 
		alert("网络错误，请重试。");
  },
});
			
			
			return false;
		});
		
   </script>