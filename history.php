<?php
require_once('top.inc');
$kd = kd(12);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 发展历程——一站式整体家装服务</title>
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

				<div id="about_box1">

					<div class="mainc2">
						<div class="nabout">
                        <div class="nclose2" style="height:70px;"></div>
							<div class="abtit1"><img src="images/brand_title1.png"></div>
							<div class="clear"></div>

							<div class="ablc boxscroll" id="boxscroll2">

								<ul style="width: 560px; float: left; height: 1560px; overflow:hidden;" id="contentscroll2">
									<li style="background-image:url(images/year2018.png);">
										<div style="padding-top:16px">2018年12月，在福建省漳州市芗城区胜利西路105-5香江大厦（闽南日报社斜对面）成立第五家实景体验中心，即沪尚茗居整体家装体验馆漳州店</div>
									</li>
                                    <li style="background-image:url(images/year2018.png);">
										<div style="padding-top:16px">2018年10月，在上海市宝山区江杨南路880号B1栋成立第四家实景体验中心，即沪尚茗居整体家装体验馆。</div>
									</li>
									<li style="background-image:url(images/year2018.png);">
										<div style="padding-top:16px">2018年4月，在上海市嘉定区曹安公路2883号（四方科创11栋）成立第三家实景体验中心，即沪尚茗居嘉定城市概念店。</div>
									</li>
									<li style="background-image:url(images/year2017.png);">
										<div style="padding-top:8px">2017年9月，在上海市松江区方塔北路558号6栋成立第二家实景体验中心，即沪尚茗居松江旗舰店。</div>
									</li>
									<li style="background-image:url(images/year2016.png);">
										<div style="padding-top:16px">2016年9月在上海市闵行区颛兴东路1280弄5号楼成立第一家全屋整装实景体验中心，即沪尚茗居闵行店。</div>
									</li>
									<li style="background-image:url(images/year2015.png);">
										<div style="padding-top:26px">2015年1月入驻上海，在上海成立整装研发中心，8月推出13套符合普通家庭装修风格的样板间产品。</div>
									</li>
									<li style="background-image:url(images/year2015.png);">
										<div style="padding-top:35px">在开拓创新精神的引领下，上海茗居网络科技有限公司开启全国布局；</div>
									</li>
									<li style="background-image:url(images/year2013.png);">
										<div style="padding-top:26px">经过两年的准备，上海茗居网络科技有限公司正式成立，推出一站式整体家装服务模式；</div>
									</li>
									<li style="background-image:url(images/year2010.png);">
										<div style="padding-top:35px">家装公司和工装公司着手合并，筹备上海茗居网络科技有限公司；</div>
									</li>
									<li style="background-image:url(images/year2005.png);">
										<div style="padding-top:35px">组建工程装修公司，成功完成数个酒店、商场等工程装修项目；</div>
									</li>
									<li style="background-image:url(images/year1996.png);">
										<div style="padding-top:35px">家装队伍不断壮大，成功完成数个精装楼盘装修项目，声名鹊起；</div>
									</li>
									<li style="background-image:url(images/year1993.png);">
										<div style="padding-top:26px">上海茗居网络科技有限公司前身是一支装修经验丰富的家装团队集结成军；</div>
									</li>
									
								</ul>

							</div>

						</div>
					</div>

				</div>

			</div>

		</div>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>
	
	<script src="js/jquery.nicescroll.min.js"></script>
	<script type="text/javascript">
	
		$(document).ready(function() {
			
			
		});
	</script>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		
		//滚动条
		$("#boxscroll2").niceScroll("", {
				cursorcolor: "#fe6d02",
				cursoropacitymax: 1,
				touchbehavior: true
			});
		
		
		$("#about_box1").show();
			$("#about_box1").animate({
				height: "710px"
			});
	});
</script>
<?php require_once('bottom.inc');?>