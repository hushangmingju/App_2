<?php
require_once('top.inc');
$kd = kd(33);
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
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php require_once('head_codes.inc');?>
  </head>

	<body>
    <?php require_once('body_top.inc');?>
		<div class="menu-mask"></div>

		<!--内容-->
		<div class="mybody">

			<div class="yizhan row">
				
				<div class="title">
					<img src="images/title_yizhan_1.png"/>
					<h2>国际品质+欧洲货+中国价+全品类=产品优势</h2>
				</div>
				
				<div class="content">
					<div class="detail row">
						<p><img src="images/flags.png" class="img-full"/></p>
						<h4>全球采购 实景体验</h4>
						<p>　　2016年，沪尚茗居凭借丰富的行业资源，重金打造集欧洲进口建材及家具为一体的进口建材馆，为消费者提供更加优质的家装解决方案。</p>
						<p>　　馆内产品种类齐全，且全部为欧洲一线品牌，涵盖包括德国、意大利、西班牙在内的众多进口产品，不仅品质出众，而且物美价廉，真正实现用中国价买欧洲货！</p>
						<p>　　沪尚茗居进口建材馆将用高品质的产品颠覆您对传统家装的一切固有印象，让您感受全新家装理念带来的震撼，并让您获得意想不到的家装新体验！</p>
					</div>

					<div class="clear"></div>
				</div>
				
				<div class="title">
					<img src="images/title_yizhan_2.png"/>
					<h2>杜绝家装暴利 + 省掉暗箱回扣</h2>
				</div>
				
				<div class="content">
					<div class="detail row">
						<p><img src="images/yizhan_02.png" class="img-full"/></p>
					</div>

					<div class="clear"></div>
				</div>
				
				<div class="clear"></div>
			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>