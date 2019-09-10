<?php
require_once('top.inc');
$style = isset($_GET['s']) && intval($_GET['s']) ? intval($_GET['s']) : 1;
$id = isset($_GET['id']) && intval($_GET['id']) && DAS::isExistedInDB("`yangban`", "`id` = " . intval($_GET['id'])) ? intval($_GET['id']) : false;

$kd = kd(34);
$kd_k = $kd["k"];
$kd_d = $kd["d"];

if($style==1){
	$stylePic = "images/morden1.jpg";
}elseif($style==2){
	$stylePic = "images/morden2.jpg";
}elseif($style==3){
	$stylePic = "images/morden3.jpg";
}elseif($style==4){
	$stylePic = "images/morden4.jpg";
}else{
	$stylePic = "images/morden1.jpg";
}

$listArr = new Query("*", "`yangban`", "", "`type` = '" . $style . "' AND `status`='ok'", "`id` DESC");
$listArr = DAS::quickQuery($listArr);
if($id){
  $dbData = new Query("*", "`yangban`", "", "`id` = " . $id);
  $dbData = DAS::quickQuery($dbData);
}
else{
  $dbData = $listArr;  
}

if(DAS::hasData($dbData)){
  $dbData = $dbData['data'][0];
  $id = $dbData['id'];
	$title=$dbData['title'];
	$etitle=$dbData['etitle'];
	$desc=$dbData['desc'];
	$price=$dbData['price'];
	$piclist=$dbData['piclist'];
	$pic=$dbData['pic'];
	$pic1=$dbData['pic1'];
	$pic2=$dbData['pic2'];
	$pic3=$dbData['pic3'];
	$pic4=$dbData['pic4'];
	$pic5=$dbData['pic5'];
	$pic6=$dbData['pic6'];
	$label1=$dbData['label1'];
	$label2=$dbData['label2'];
	$label3=$dbData['label3'];
	$label4=$dbData['label4'];
	$label5=$dbData['label5'];
	$label6=$dbData['label6'];
	$time=$dbData['time'];
	$style=$dbData['type'];
}
else{
  Header("HTTP/1.1 301 Moved Permanently");
	Header("Location: yangban.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$title?> <?=$kd_k?>" />
		<meta name="description" content="<?=$title?> <?=$etitle?>，<?=$kd_d?>" />
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
			<div class="yangban-v row">

				<div class="title-img row">
					<img src="<?=$stylePic?>" class="img-full" />
				</div>

				<div class="species row">
					<div class="title"><img src="images/title_species.png" class="img-full" /></div>
					<div class="row">
						<?php
            if(DAS::hasData($listArr)){
              $listArr = $listArr['data'];
              $count = count($listArr);
              for($i=0;$i<$count;$i++){
							?>
						<div class="col-xs-6"><a href="yangban-v.html?s=<?=$style?>&id=<?=$listArr[$i]["id"]?>" <?php if($id==$listArr[$i]["id"]){echo ' class="active"';} ?>><?=$listArr[$i]["title"]?><span style="display:none;">￥<?=$listArr[$i]["price"]?></span></a></div>
							<?php
							}
            }
							?>
					</div>
				</div>


				<?php
				if($id){
				?>

				<div class="explanation row">
					<div class="title">风格说明：</div>
					<div class="detail">
						<?=$desc?>
					</div>
				</div>

				<div class="house row">
					<div class="row show-tab" id="house1">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic1);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					<div class="row show-tab" id="house2">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic2);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					<div class="row show-tab" id="house3">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic3);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					<div class="row show-tab" id="house4">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic4);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					<div class="row show-tab" id="house5">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic5);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					<div class="row show-tab" id="house6">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<?php
								$listArr = explode('|',$pic6);
								for($i=0;$i<count($listArr);$i++){
								?>
								<div class="swiper-slide">
									<img src="<?=$listArr[$i]?>">
								</div>
								<?php
								}
								?>
							</div>
						</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					
					
					<div class="tabs" id="show-tabs">
						<div class="tab active"><a href="javascript:;" data-toggle="house1">客厅</a></div>
						<div class="tab"><a href="javascript:;" data-toggle="house2">主卧</a></div>
						<div class="tab"><a href="javascript:;" data-toggle="house3">次卧</a></div>
						<div class="tab"><a href="javascript:;" data-toggle="house4">餐厅</a></div>
						<div class="tab"><a href="javascript:;" data-toggle="house5">厨房</a></div>
						<div class="tab"><a href="javascript:;" data-toggle="house6">卫生间</a></div>
					</div>
				</div>
				
				<?php
				$yangbanTitle = $title;
				$yangbanPrice = $price;
				?>

				<?php
				}
				?>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	<script src="js/swiper.3.1.2.min.js"></script>
	<script>
		var mySwiper = new Swiper('#house1 .swiper-container', {
			speed: 500,
			prevButton: '#house1 .swiper-button-prev',
			nextButton: '#house1 .swiper-button-next',
		});

		var mySwiperB = new Swiper('#house2 .swiper-container', {
			speed: 500,
			prevButton: '#house2 .swiper-button-prev',
			nextButton: '#house2 .swiper-button-next',
		});
		
		var mySwiperC = new Swiper('#house3 .swiper-container', {
			speed: 500,
			prevButton: '#house3 .swiper-button-prev',
			nextButton: '#house3 .swiper-button-next',
		});
		
		var mySwiperD = new Swiper('#house4 .swiper-container', {
			speed: 500,
			prevButton: '#house4 .swiper-button-prev',
			nextButton: '#house4 .swiper-button-next',
		});
		
		var mySwiperE = new Swiper('#house5 .swiper-container', {
			speed: 500,
			prevButton: '#house5 .swiper-button-prev',
			nextButton: '#house5 .swiper-button-next',
		});
		
		var mySwiperF = new Swiper('#house6 .swiper-container', {
			speed: 500,
			prevButton: '#house6 .swiper-button-prev',
			nextButton: '#house6 .swiper-button-next',
		});
	</script>
	</body>
</html>
<?php require_once('bottom.inc');?>