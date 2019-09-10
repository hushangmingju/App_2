<?php
require_once('top.inc');
$dbData = new Query("*", "`keys`", "", "`key`='huodong'");
$dbData = DAS::quickQuery($dbData);

$dbData = DAS::hasData($dbData) ? $dbData['data'][0] : false;
$title=isset($dbData['value1']) ? $dbData['value1'] : null;
$pic=isset($dbData['value2']) ? $dbData['value2'] : null;
$url=isset($dbData['value3']) ? $dbData['value3'] : null;
$text=isset($dbData['text1']) ? $dbData['text1'] : null;

$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>优惠活动——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<style>
			.textinfo img{display:block; width:100%; height:auto;}
		</style>
		<?php require_once('head_codes.inc');?>
	</head>

	<body>
    <?php require_once('body_top.inc');?>
		<div class="menu-mask"></div>

		<!--内容-->
		<div class="mybody">

			<div class="row">
				<div class="content">
					<div class="detail row">
						<a href="<?=$url?>" target="_blank" class="block-center"><img class="img-full block-center" src="<?=$pic?>"></a>
						<div class="textinfo"><?=$text?></div>
					</div>
				</div>

				<div class="clear"></div>

			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>