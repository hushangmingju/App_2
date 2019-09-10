			<!--页脚-->
			<div class="foot row">
				<div class="code row">
					<div class="col-xs-6">
						<div class="row">
							<a href="tel:<?php echo ($user && isset($user['tel']) ? $user['tel'] : '');?>" class="ctel" style="line-height:16px"><?php echo ($user && isset($user['tel']) ? $user['tel'] : '');?><br>021-31599932</a>
						</div>
						<div class="row">
							<a href="mailto:<?php echo ($user && isset($user['email']) ? $user['email'] : '');?>" class="cmail"><?php echo ($user && isset($user['email']) ? $user['email'] : '');?></a>
						</div>
					</div>
					<div class="col-xs-6">
						<div class="mycode">
							<div class="qrcode"><img src="images/qrcode.png"/></div>
							<div class="btns"><a href="https://j.map.baidu.com/NM_qP" target="_blank">实时地图</a></div>
						</div>
					</div>
				</div>
				<div class="copyright row"><?php echo ($user && isset($user['copyright']) ? $user['copyright'] : '');?><!--<a href="http://www.mingjugroup.com/seo/test.php">（已备案）</a>--></div>
			</div>			
			<div class="clear"></div>
		</div>
    <!--底部按钮-->
		<footer>
			<div class="backtop"><a href="index.html" id="backtop"><img src="images/backtop.png"/></a></div>
			<div class="btns">
				<div class="col-5"><a href="javascript:;" class="js-kai"><img src="images/btn-01.png"/></a></div>
				<div class="col-5"><a href="yuyue.html"><img src="images/btn-02.png"/></a></div>
			</div>
		</footer>
		
		
		<!--二维码弹窗-->
		<div class="pop-qrcode">
			<div class="pop-content">
				<img src="images/qrcode.jpg" class="img-full"/>
			</div>
			<div class="qrcode-mask qrcode-guan"></div>
		</div>
		
		
		<!--计算器弹窗-->
		<div class="jisuan">
			<div class="jisuanqi">
				<a href="javascript:;" class="js-guan"></a>
				<div class="js-content">
					<h3>装修报价</h3>
					<div class="myinput">
						<span>风格：</span>
						<select name="style" id="calculator-style">
							<?php
                            $yangban = new Query("id,yangbanID, priceList, title", "`yangban`", "", "`priceList` IS NOT NULL AND `priceList` != ''");
                            $yangban = DAS::quickQuery($yangban);
							if (DAS::hasData($yangban)) {
                                foreach ($yangban['data'] as $yangbanOpt) {
                                    echo '<option value="' . $yangbanOpt['id'] . '">' . $yangbanOpt['title'] . '</option>';
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
					
					<div class="myinput">
						<span>面积：</span>
						<input type="tel" id="calculator-area" value="">
						<span class="unit">平方米</span>
					</div>
					
					<div class="myinput">
						<span>手机：</span>
						<input type="tel" id="calculator-mobile" value="" />
						<span class="unit"></span>
					</div>
					
					<div class="myinput">
						<span>总价：</span>
						<input type="text" id="totalPrice" disabled style="background-color:#fff;" />
						<span class="unit">元</span>
					</div>
					
					<a href="#" class="ljyy" id="calculator-yuyue">开始计算</a>
				</div>
			</div>
			<div class="jisuan-mask js-guan"></div>
		</div>
<script>
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
                    var tempPriceList = yangbanList[i].priceList.split("%20%0D%0A");
                    for(var j = 0; j < tempPriceList.length; j++){
                        tempPrice = tempPriceList[j].split("%09");
                        if(Math.ceil($area) == tempPrice[0] && $type == tempPrice[1]){                            
                            var $total = Math.ceil(tempPrice[2]);
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
            $('#totalPrice').val($total);
            //alert($('#calculator-total').val()); 
			var $mobile = $('#calculator-mobile').val();
			var POSTDATA = {"type":'calc2',"bultin":"mobile/body_bottom_calc","phpSelf":"<?php echo $_SERVER['PHP_SELF'];?>","calc-style":$style,"calc-area":$area,"calc-price":$typeText,"calc-total":$total,"tel":$mobile};
			if($mobile==""){
				alert('手机号不能为空');return false;
			}else if(!$mobile.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
				alert("手机号码格式不正确！"); return false;
			}
				
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
</script>
      	