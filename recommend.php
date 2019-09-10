<?php
require_once('top.inc');
$kd = kd(4);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 业主推荐——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <?php require_once('head_codes.inc');?>
	</head>
	<body>
		<?php require_once('body_top.inc');?>			
		<div class="content">
	    <div class="banner recommend container">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php
              $allRecommends = new Query("*", "`tuijian`", "", "`status` = 'ok' AND `type` = '1'", "`id`", "", "0,10");
              $allRecommends = DAS::quickQuery($allRecommends);
              $allRecommends = DAS::hasData($allRecommends) ? $allRecommends['data'] : false;
              if($allRecommends){
                for($i = 0; $i < count($allRecommends); $i++){
            ?>
            <div class="swiper-slide">
							<a href="<?php echo $allRecommends[$i]["url"];?>" target="_blank"><img src="<?php echo $allRecommends[$i]["pic"];?>" class="img-full"></a>
						</div>
            <?php
                }
              }
						?>
					</div>
				</div>
				<nav class="pagination"></nav>
				<div class="swiper-button swiper-button-next"></div>
				<div class="swiper-button swiper-button-prev"></div>
			</div>			
			<div class="mainc">
				<div class="cgtit p-t-20"><img src="images/yezhu01.png"></div>
				<div class="meiti">				
					<?php
					  $allRecommends = new Query("*", "`tuijian`", "", "`status` = 'ok' AND `type` = '2'", "`id`", "", "0,10");
            $allRecommends = DAS::quickQuery($allRecommends);
            $allRecommends = DAS::hasData($allRecommends) ? $allRecommends['data'] : false;
            if($allRecommends){
                for($i = 0; $i < count($allRecommends); $i++){
          ?>
          <div class="item">
						<a href="<?php echo $allRecommends[$i]["url"];?>" target="_blank"><img src="<?php echo $allRecommends[$i]["pic"];?>"/></a>
					</div>
          <?php
                }
              }
					?>
				</div>				
				<div class="cgtit"><img src="images/yezhu02.png"></div>
				<div class="jinqi banner">
					<div class="swiper-container">
						<div class="swiper-wrapper">		
							<?php
                $allRecommends = new Query("*", "`tuijian`", "", "`status` = 'ok' AND `type` = '3'", "`id`", "", "0,10");
                $allRecommends = DAS::quickQuery($allRecommends);
                $allRecommends = DAS::hasData($allRecommends) ? $allRecommends['data'] : false;
                if($allRecommends){
                  for($i = 0; $i < count($allRecommends); $i++){
              ?>
              <div class="swiper-slide">
								<a href="<?php echo $allRecommends[$i]["url"];?>" target="_blank"><img src="<?php echo $allRecommends[$i]["pic"];?>"  style="width:285px; height:200px; display: block;"></a>
							</div>
              <?php
                  }
                }
							?>
						</div>
					</div>
					<div class="swiper-button swiper-button-next"></div>
					<div class="swiper-button swiper-button-prev"></div>
				</div>				
				<div class="cgtit"><img src="images/yezhu03.png"></div>
				<div class="ybli">
					<ul>					
						<?php
              //$allRecommends = new Query("*", "`tuijian`", "", "`status` = 'ok' AND `type` = '4'", "`id`", "", "0,12");
              $allRecommends = new Query("*", "`yangban`", "", "`status` = 'ok' AND`tuijian`='1'", "`id`", "", "0,12");
              $allRecommends = DAS::quickQuery($allRecommends);
              $allRecommends = DAS::hasData($allRecommends) ? $allRecommends['data'] : false;
              if($allRecommends){
                for($i = 0; $i < count($allRecommends); $i++){
            ?>
            <li>
              <a href="yangban-v.php?id=<?php echo $allRecommends[$i]["id"];?>" target="_blank">
                <!--<span class="hover transition"><?php echo $allRecommends[$i]["title"];?></span>-->
                <img src="<?php echo $allRecommends[$i]["pic"];?>" style="width:380px; height:275px;">
              </a>
            </li>
            <?php
                }
              }
					  ?>
					</ul>
					<div class="clear"></div>
				  </div>
			  </div>
		  </div>			 
	  </div>		
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>
</html>	
<script type="text/javascript" language="javascript">
<!--//
		var mySwiper = new Swiper ('.recommend .swiper-container', {
			pagination: '.pagination', // 如果需要分页器
			autoplayDisableOnInteraction : false, //用户操作分页器后不停止
			paginationClickable: true, //分页器可点击
			speed:500,
			autoplay:6000,
			prevButton:'.banner .swiper-button-prev',
			nextButton:'.banner .swiper-button-next',
		});
		
		
		var mySwiperA = new Swiper ('.jinqi .swiper-container', {
			slidesPerView : 4,
			spaceBetween : 20,
			speed:600,
			autoplay:1000,
			autoplayDisableOnInteraction : false,
			prevButton:'.jinqi .swiper-button-prev',
			nextButton:'.jinqi .swiper-button-next',
		});
//-->		
</script>
<?php require_once('bottom.inc');?>