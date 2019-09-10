<?php
require_once('top.inc');
$kd = kd(11);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 整体工装——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <?php require_once('head_codes.inc');?>
	</head>

	<body>
		<?php require_once('body_top.inc');?>
		<?php $nban='images/ban_gongzhuang.jpg'; ?>

		<div class="content">

			<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat;"></div>

			<div class="mainc" style="overflow: hidden;">
				<div class="gzs">
					<div class="gongzhuangshow swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<a href="javascript:;" class="ba1"><img src="images/gy_1.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba2"><img src="images/gy_2.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba3"><img src="images/gy_3.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba4"><img src="images/gy_4.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba5"><img src="images/gy_5.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba6"><img src="images/gy_6.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba7"><img src="images/gy_7.jpg" class="img-full ba1"></a>
							</div>
						
							<div class="swiper-slide">
								<a href="javascript:;" class="ba8"><img src="images/gongzhuang_1.jpg" class="img-full ba1"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba9"><img src="images/gongzhuang_2.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba10"><img src="images/gongzhuang_3.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba11"><img src="images/gongzhuang_4.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba12"><img src="images/gongzhuang_5.jpg" class="img-full"></a>
							</div>
							<div class="swiper-slide">
								<a href="javascript:;" class="ba13"><img src="images/gongzhuang_6.jpg" class="img-full"></a>
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
              $currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
							$tagSql = isset($_GET['tag']) && $_GET['tag'] ? " AND `tag` LIKE '%".addslashes($_GET['tag'])."%'  " : null;              
              $technics = new Query("*", "`wenda`", "", "`mod`='gongyi' AND `status` = 'ok'" . $tagSql, "`id` DESC");
              $technics = DAS::quickQuery($technics, 'RC', 10, $currentPage);
              $technics = DAS::hasData($technics) ? $technics : false;
						  if($technics){
                $_page = new Page($technics['NUM_DATA'], $technics['NUM_PER_PAGE']); 
                $count = count($technics['data']);
                for($i=0;$i<$count;$i++){
              ?>
                <li>
									<div class="tit"><a href=""><?php echo ($i+1);?>: <?php echo $technics['data'][$i]["q"];?></a></div>
									<div class="jj">
										<span><?php echo str_replace("\n","<br>", $technics['data'][$i]["a"]);?></span>
										<a href="javascript:;" class="words-close" style="display: none;">收起内容</a>
										<a href="javascript:;" class="words">显示完整内容</a>
									</div>
								</li>
              <?php    
                }
              }
							?>
							</ul>
						</div>
						
						<div class="pages">
								<?php echo $_page->showpage();?>
							</div>

					</div>

					<div class="caright">

						<div class="gzbqtit">标签：</div>
						<div class="gzbq">
							<ul>
								<li class="hoverss"><a href="gongzhuang.php">全部</a></li>
								<li><a href="?tag=<?=urlencode("无异味")?>">无异味</a></li>
								<li><a href="?tag=<?=urlencode("效率高")?>">效率高</a></li>
								<li><a href="?tag=<?=urlencode("很喜欢")?>">很喜欢</a></li>
								<li><a href="?tag=<?=urlencode("高品质")?>">高品质</a></li>

								<div class="clear"></div>
							</ul>
						</div>

					</div>
					<div class="clear"></div>

				</div>
			</div>

		</div>

		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

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
			rotate: -13,
			stretch: 10,
			depth: 56,
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
      
			var text = $span.text();
			if (text) {        
        $span.val(text);
				$span.html(text.substring(0, 89) + "...");

				$btnShow.click(function() {
					$btnShow.hide();
					$btnHide.show();
					$span.html($span.val());
				});
				$btnHide.click(function() {
					$btnHide.hide();
					$btnShow.show();
					$span.html($span.val().substring(0, 89) + "...");
				});
			}

		});
	})
</script>
<?php require_once('bottom.inc');?>