<?php
require_once('top.inc');
$kd = kd(34);
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

			<div class="yangban row">
				<div class="title">
					<img src="images/title_yangban.png" />
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
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>