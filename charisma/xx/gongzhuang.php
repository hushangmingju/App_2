<?php
include(dirname(__FILE__).'/base.php');




?><?php $vvc=4; ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>整体工装——一站式整体家装服务</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>

	</head>

	<body>
		<?php include 'top.php';?>
		<?php $nban='images/ban_gongzhuang.jpg'; ?>

		<div class="content">

			<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat;"></div>

			<div class="mainc" style="overflow: hidden;">
				<div class="gzs">
					<div class="gongzhuangshow swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<a href="javascript:;" class="ba1"><img src="images/gongzhuang_banner.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="#" class="ba2"><img src="images/gongzhuang_banner.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="#" class="ba3"><img src="images/gongzhuang_banner.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="#" class="ba4"><img src="images/gongzhuang_banner.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="#" class="ba5"><img src="images/gongzhuang_banner.jpg" class="img-full"></a>
							</div>
						</div>
					</div>
					<div class="prev btn"></div>
					<div class="next btn"></div>
				</div>

				<div class="mainc3">
					<div class="caleft">

						<div class="gzli">
							<ul>


							<?php
							$listArr = $db->QueryData("SELECT * FROM `wenda` WHERE `mod`='gongyi' AND `status` = 'ok'  ","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
								<li>
									<div class="tit"><a href=""><?=($i+1)?>: <?=$listArr[$i]["q"]?></a></div>
									<div class="jj">
										<span data-text="<?=str_replace("\n","<br>",$listArr[$i]["a"])?>"></span>
										<a href="javascript:;" class="words-close" style="display: none;">收起内容</a>
										<a href="javascript:;" class="words">显示完整内容</a>
									</div>
								</li>
							<?php
							}
							?>

							</ul>
						</div>
						
						<div class="pages">
								<a href="#" class="prev">&nbsp;</a>
								<span class="numbers">
									<a href="#" class="active">1</a>
								</span>
								<a href="#" class="next">&nbsp;</a>
							</div>

					</div>

					<div class="caright">

						<div class="gzbqtit">标签：</div>
						<div class="gzbq">
							<ul>
								<li class="hoverss"><a href="">无异味</a></li>
								<li><a href="">效率高</a></li>
								<li><a href="">很喜欢</a></li>
								<li><a href="">高品质</a></li>

								<div class="clear"></div>
							</ul>
						</div>

					</div>
					<div class="clear"></div>

				</div>
			</div>

		</div>

		<?php include 'end.php';?>

	</body>

</html>

<script>
	<!--
	function setTab(name, cursel, n) {
		for (i = 1; i <= n; i++) {
			var menu = document.getElementById(name + i);
			var con = document.getElementById("con_" + name + "_" + i);
			menu.className = i == cursel ? "hover" : "";
			con.style.display = i == cursel ? "block" : "none";
		}
	}
	//-->

	var mySwiper = new Swiper('.gongzhuangshow', {
		effect: 'coverflow',
		slidesPerView: 3,
		autoplay: 8000,
		loop: true,
		centeredSlides: true,
		prevButton: '.gzs .prev',
		nextButton: '.gzs .next',
		coverflow: {
			rotate: 30,
			stretch: 10,
			depth: 100,
			modifier: 2,
			slideShadows: true
		}
	});

	$(document).ready(function() {

		$('.jj').each(function(idx, $el) {
			var $el = $($el);
			var $span = $el.children('span');
			var $btnShow = $el.children('.words');
			var $btnHide = $el.children('.words-close');

			var text = $span.data('text');
			if (text) {
				$span.html(text.substring(0, 89) + "...");

				$btnShow.click(function() {
					$btnShow.hide();
					$btnHide.show();
					$span.html($span.data('text'));
				});
				$btnHide.click(function() {
					$btnHide.hide();
					$btnShow.show();
					$span.html($span.data('text').substring(0, 89) + "...");
				});
			}

		});
	})
</script>