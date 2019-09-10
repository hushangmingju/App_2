<?php
require_once('top.inc');
$kd = kd(12);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 品牌故事——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <?php require_once('head_codes.inc');?>
	</head>

	<body>

		<?php require_once('body_top.inc');?>

		<div class="content" style="display:block; height:790px;">

			<div class="mainc" style="position:relative; max-width: 100%;">

				

				<div id="about_box2">

					<div class="mainc2">
						<div class="nclose2" style="height:70px;"></div>

						<div class="nabout" style="float:left;padding-left:60px">
							<div class="abtit2"><img src="images/brand_title2.png"></div>
							<div class="clear"></div>
							<div class="abcon boxscroll" id="boxscroll">
								<div id="contentscroll" style="width: 560px; float: left;">　　上海茗居网络科技有限公司，是一家集建材采购、室内设计、装修施工于一体的新型装修企业。企业创建的家装6.0全新装修模式被誉为经济便捷、高品质的家装新模式。
								<br /><br />　　上海茗居网络科技有限公司拥有几十款实景样板间，全部由优秀设计师精心打造，带您领略前沿的居住时尚。这几十款实景样板间，不同风格、不同价位，满足了不同人群、不同要求。上海茗居网络科技有限公司真正是“全包式”装修，不仅包括硬装、家具、灯具等大件，就连毛巾架、马桶刷等每一个小件也全都包括在内，您所需要做的，就是像购物一样，从实景样板间里轻松挑选一款心仪的风格，签下合同后就无需再过问，让您省心省力住上满意的新家。
								<br /><br />　　这种新型的装修一站式模式，不仅方便顾客一目了然挑选到自己喜欢的装修风格，而且所有建材全部工厂直供，价格也比网购、团购更低，可以让您只花简单装修的钱，获得豪华装修的产品。
								<br /><br />　　上海茗居网络科技有限公司还有一支规范的施工队伍，一千五百多名工人，常年围绕这几十种装修风格施工，练就了娴熟的技术。同时，公司通过集约化管理，标准化流程，达到施工进度的严丝合缝，既保证了装修质量，也保证了不延误工期。
								<br /><br />　　作为一家品牌企业，上海茗居网络科技有限公司还有着严苛的跟踪监理制度，以及强大的售后保修制度，承诺提供终身维修服务，让您在省心、放心的基础上更舒心。
								<br /><br />　　总之，上海茗居网络科技有限公司所有员工，会以专业的施工规范、细致的服务体系，具性价比的价格，欢迎各位消费者的到来。选择上海茗居网络科技有限公司让您称心如意，选择上海茗居网络科技有限公司让您物超所值！
								</div>
							</div>

						</div>
					</div>

				</div>

				
				<div class="clear"></div>

			</div>

		</div>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>
	
	<script src="js/jquery.nicescroll.min.js"></script>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		
		//滚动条
		$("#boxscroll").niceScroll("", {
				cursorcolor: "#fe6d02",
				cursoropacitymax: 1,
				touchbehavior: true
			});
		
		
		
		$("#about_box2").show();
			$("#about_box2").animate({
				height: "710px"
			});
		
		
		

	});
</script>
<?php require_once('bottom.inc');?>