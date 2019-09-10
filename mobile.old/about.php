<?php
require_once('top.inc');
$kd = kd(36);
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

			<div class="about row">
				<div class="title">
					<img src="images/title_about.png" />
				</div>

				<div class="content">
					<div class="img">
						<img src="images/house.png" class="img-full" />
					</div>

					<div class="detail row">
						<p><span class="first-word">上</span>海茗居网络科技有限公司，是一家集建材采购、室内设计、装修施工于一体的新型装修企业。企业创建的家装6.0全新装修模式被誉为经济便捷、高品质的家装新模式。</p>
						<p>　　上海茗居网络科技有限公司拥有十几款实景样板间，全部由优秀设计师精心打造，带您领略前沿的居住时尚。这十几款实景样板间，不同风格、不同价位，满足了不同人群、不同要求。上海茗居网络科技有限公司真正是“全包式”装修，不仅包括硬装、家具、灯具、软装、床品等大件，就连毛巾架、马桶刷等每一个小件也全都包括在内，您所需要做的，就是像购物一样，从实景样板间里轻松挑选一款心仪的风格，然后签下合同，一切都不用再过问，真正拎包入住。</p>
						<p>　　这种新型的装修一站式模式，不仅方便顾客一目了然挑选到自己喜欢的装修风格，而且所有建材全部工厂直供，价格也比网购、团购更低，可以让您只花简单装修的钱，获得豪华装修的产品。</p>
						<p>　　上海茗居网络科技有限公司还有一支规范的施工队伍，一千五百多名工人，常年围绕这十几种装修风格施工，练就了娴熟的技术。同时，公司通过集约化管理，标准化流程，达到施工进度的严丝合缝，既保证了装修质量，也保证了不延误工期。</p>
						<p>　　作为一家品牌企业，上海茗居网络科技有限公司还有着严苛的跟踪监理制度，以及强大的售后保修制度，承诺提供终身维修服务，让您在省心、放心的基础上更舒心。</p>
						<p>　　总之，上海茗居网络科技有限公司所有员工，会以专业的施工规范、细致的服务体系，具性价比的价格，欢迎各位消费者的到来。选择上海茗居网络科技有限公司让您称心如意，选择上海茗居网络科技有限公司让您物超所值！</p>
					</div>
				</div>

				<div class="clear"></div>

			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>