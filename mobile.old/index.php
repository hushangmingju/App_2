<?php
require_once('top.inc');
$kd = kd(31);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php require_once('head_codes.inc');?>
	</head>
	<body>
    <?php require_once('body_top.inc');?>
		<div class="menu-mask"></div>
		
		
		
		<!--内容-->
		<div class="mybody home">

			<!--<div class="banner row">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<a href="yangban-v.html?s=1"><img src="images/banner_01.jpg" class="img-full"></a>
						</div>
						<div class="swiper-slide">
							<a href="yangban-v.html?s=2"><img src="images/banner_02.jpg" class="img-full"></a>
						</div>
						<div class="swiper-slide">
							<a href="yangban-v.html?s=3"><img src="images/banner_03.jpg" class="img-full"></a>
						</div>
					</div>
				</div>
				<nav class="pagination"></nav>
			</div>-->
			
			<div class="banner row">
				<div class="swiper-container">
					<div class="swiper-wrapper">

							<?php
              $swiperBanner = new Query("*", "`banner`", "", "`status` = 'ok' AND `agent` = 2", "`id` DESC");
              $swiperBanner = DAS::quickQuery($swiperBanner);
              if(!DAS::hasData($swiperBanner)){
                $swiperBanner = new Query("*", "`banner`", "", "`status` = 'ok' AND `agent` = 1", "`id` DESC");
                $swiperBanner = DAS::quickQuery($swiperBanner);
              }              
              if(DAS::hasData($swiperBanner)){
                for($i=0;$i<count($swiperBanner['data']);$i++){
								  echo "\n";
              ?>
            <div class="swiper-slide">
							<a href="<?php echo $swiperBanner['data'][$i]["url"];?>"><img src="<?php echo $swiperBanner['data'][$i]["pic"];?>"></a>
						</div>
              <?php
                }
              }
							?>
					</div>
				</div>
				<nav class="pagination"></nav>
			</div>
			
			<div class="home-menu row">
				<div class="col-xs-3"><a href="yangban.html"><img src="images/home_icon_01.png"/>实景样板房</a></div>
				<div class="col-xs-3"><a href="javascript:;" class="js-kai"><img src="images/home_icon_04.png"/>装修报价</a></div>
				<div class="col-xs-3"><a href="https://www16.53kf.com/m.php?cid=72176001&style=1&keyword=http%3A%2F%2Fwww.mingjugroup.com%2Fmobile%2Fabout.php&referer=http%3A%2F%2Fwww.mingjugroup.com%2Fmobile%2F&guest_id=843371340016&tpl=crystal_blue&uid=548c3c850e467453a4f475330b2eb32d&u_stat_id=&talktitle=沪尚茗居——一站式整体家装服务&tfrom=50&device=&zdkf_type=1&kf=466151009%40qq.com&kflist=off" target="_blank"><img src="images/home_icon_02.png"/>在线咨询</a></div>
				<div class="col-xs-3"><a href="promotions.html"><img src="images/home_icon_03.png"/>优惠活动</a></div>
			</div>
			
			<!--<div class="styleshow row">
				<div class="title col-2"><a href="yangban.html"><img src="images/title_home_01.png"/></a></div>
				<div class="pics col-8">
					<div class="col-3"><a href="yangban-v.html?s=2"><img src="images/home_style_01.png"/></a></div>
					<div class="col-3"><a href="yangban-v.html?s=4"><img src="images/home_style_02.png"/></a></div>
					<div class="col-4"><a href="yangban-v.html?s=3"><img src="images/home_style_03.png"/></a>
					<a href="yangban-v.html?s=1"><img src="images/home_style_04.png"/></a></div>
				</div>
			</div>-->
			
			<div class="yangban row">
				<div class="title">
					<a href="yangban.html"><img src="images/title_home_01.png" style="width: 120px;" /></a>
				</div>
				<div class="content">
					<div class="box">
						<a href="yangban-v.html?s=1">
							<img src="images/yangban_01.jpg"/>
						</a>
					</div>
					<div class="box">
						<a href="yangban-v.html?s=2">
							<img src="images/yangban_02.jpg"/>
						</a>
					</div>
					<!--<div class="box">
						<a href="yangban-v.html?s=3">
							<img src="images/yangban_03.jpg"/>
						</a>
					</div>-->
					<div class="box">
						<a href="yangban-v.html?s=4">
							<img src="images/yangban_04.jpg"/>
						</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="row baojia">
				<div class="title">
					<img src="images/title_home_03.png" />
				</div>
				<div class="row">
					<div class="js-content" style="width: 320px; margin: 0 auto;">
						<div class="myinput">
						    <span>风格：</span>
						    <select name="style" id="calculator-style1">
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
						    <select name="type" id="calculator-type1">
							    <option value="1111">1房1厅1厨1卫</option>
							    <option value="2211">2房2厅1厨1卫</option>
							    <option value="3211">3房2厅1厨1卫</option>
							    <option value="3212">3房2厅1厨2卫</option>
							    <option value="4212">4房2厅1厨2卫</option>
							    <option value="5213">5房2厅1厨3卫</option>
						    </select>
					    </div>
						<div class="myinput" style="display: none;">
							<span>单价：</span>
							<input type="tel" name="" id="calculator-price1" value="0" disabled="disabled">
							<span class="unit">元/平方米</span>
						</div>
						<div class="myinput">
							<span>面积：</span>
							<input type="tel" name="" id="calculator-area1" value="">
							<span class="unit">平方米</span>
						</div>
						<div class="myinput">
							<span>手机：</span>
							<input type="tel" name="" id="calculator-mobile1" value="" />
							<span class="unit"></span>
						</div>
						<!--<div class="myinput">
							<span>地址：</span>
							<input type="text" name="" id="calculator-add1" value="" />
						</div>-->
						<div class="myinput">
							<span>总价：</span>
							<input type="tel" name="" id="calculator-total1" value="" disabled style="background-color:#fff;" />
							<span class="unit">元</span>
						</div>
						<a href="javascript:;" class="ljyy" id="calculator-yuyue1">开始计算</a>
						<span>我们承诺，您的信息将被严格保密，请放心填写。</span>
					</div>
				</div>
			</div>
			
			<script>
            var yangbanList = <?php echo json_encode($yangban['data']);?>;
        $("#calculator-yuyue1").click(function(){       
            var $area = $('#calculator-area1').val();
            $area = parseInt($area) > 180 || parseInt($area) < 50 ? 80 : parseInt($area);
            var $style = $('#calculator-style1').children('option:selected').text();
			var $id = $('#calculator-style1').children('option:selected').val();
            var $type = $('#calculator-type1').children('option:selected').val();
            var $typeText = $('#calculator-type1').children('option:selected').text();
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
			var $mobile = $('#calculator-mobile1').val();
			var POSTDATA = {"type":'calc2',"bultin":"mobile/index_calc","phpSelf":"<?php echo $_SERVER['PHP_SELF'];?>","calc-style":$style,"calc-area":$area,"calc-price":$typeText,"calc-total":$total,"tel":$mobile};
			if($mobile==""){
				alert('手机号不能为空');return false;
			}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
				alert("手机号码格式不正确！"); return false;
			}
			
			
				$('#calculator-total1').val($total); 
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
			
			
			<div class="advantage row">
				<div class="title">
					<a href="jg60.html"><img src="images/title_home_02.png"/></a>
					<h2>包设计  |  包主材  |  包施工  |  包家具｜包灯具</h2>
				</div>
				
				<div class="row">
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=1">
							<span class="icon bg-red"><img src="images/icon/icon_01.png"/></span>
							<span class="subtitle">实景样板房</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=2">
							<span class="icon bg-pink"><img src="images/icon/icon_02.png"/></span>
							<span class="subtitle">工厂价直供</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=3">
							<span class="icon bg-purple"><img src="images/icon/icon_03.png"/></span>
							<span class="subtitle">全包式套餐</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=4">
							<span class="icon bg-indigo"><img src="images/icon/icon_04.png"/></span>
							<span class="subtitle">无增项加价</span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=5">
							<span class="icon bg-blue"><img src="images/icon/icon_05.png"/></span>
							<span class="subtitle">锤子加质检</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=6">
							<span class="icon bg-green"><img src="images/icon/icon_06.png"/></span>
							<span class="subtitle">环保更安心</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=7">
							<span class="icon bg-orange"><img src="images/icon/icon_07.png"/></span>
							<span class="subtitle">自由挑选家</span>
						</a>
					</div>
					<div class="col-xs-3 box">
						<a href="jg60.html?jid=8">
							<span class="icon bg-crimson"><img src="images/icon/icon_08.png"/></span>
							<span class="subtitle">终身式售后</span>
						</a>
					</div>
				</div>
				<div class="clear"></div>

			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	<script>
		var mySwiper = new Swiper ('.banner .swiper-container', {
			pagination: '.pagination', // 如果需要分页器
			autoplayDisableOnInteraction : false, //用户操作分页器后不停止
			paginationClickable: true, //分页器可点击
			speed:500,
			autoplay:6000,
			prevButton:'.banner .swiper-button-prev',
			nextButton:'.banner .swiper-button-next',
		});
	</script>
	</body>
</html>
<?php require_once('bottom.inc');?>
