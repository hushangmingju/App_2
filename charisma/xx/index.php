<?php
include(dirname(__FILE__).'/base.php');
?><?php $vvc=1; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居——一站式整体家装服务</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>

	</head>
	<body>
		<?php include 'top.php';?>
		
		
		
		
		<?php
		$swiperBanner = array(
																				array("pic"=>"images/banner_01.jpg","url"=>"#"),
																				array("pic"=>"images/banner_02.jpg","url"=>"#"),
																				array("pic"=>"images/banner_03.jpg","url"=>"#"),
																				);
		?>
		<div class="home content container-full">
			<div class="banner container-full">
				<div class="swiper-container">
					<div class="swiper-wrapper">
					
							<?php
							$swiperBanner = $db->QueryData("SELECT * FROM `banner` WHERE `status` = 'ok'  ","all");
							//pre($listArr);
							$count = count($swiperBanner);
							for($i=0;$i<$count;$i++){
								echo "\n";
							?>
						<div class="swiper-slide">
							<a href="<?=$swiperBanner[$i]["url"]?>"><img src="<?=$swiperBanner[$i]["pic"]?>" class="img-full"></a>
						</div>
							<?php
							}
							?>
						<?php
						$count = count($swiperBanner);
						for($i=0;$i<$count;$i++){
							
						?>

						<?php
						}
						?>
					</div>
				</div>
				<nav class="pagination"></nav>
				<div class="swiper-button swiper-button-next"></div>
				<div class="swiper-button swiper-button-prev"></div>
			</div>
			<div class="advantage container">
				<div class="title row p-b-20">
					<a href="#"><img src="images/title_01.png"/></a>
				</div>
				<div class="row">
					<div class="col-3 box">
						<a href="jg60.php?jid=1">
							<span class="icon bg-red"><img src="images/icon_01.png"/></span>
							<span class="subtitle">实景样板间，所见即所得</span>
							<span class="description">沪尚茗居首创十几款不同风格、不同价位的实景样板间，从中式到西式，从简约到奢华，满足了不同人群的不同需求。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=2">
							<span class="icon bg-pink"><img src="images/icon_02.png"/></span>
							<span class="subtitle">工厂价装修，价格超低</span>
							<span class="description">沪尚茗居以集团统一采购形式直接从工厂批量进货，节省大额装修成本，直供消费者，价格至少节省30%。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=3">
							<span class="icon bg-purple"><img src="images/icon_03.png"/></span>
							<span class="subtitle">家装全包，不用您费心</span>
							<span class="description">“全包式”套餐，大到家具家电，小到马桶刷都为客户配齐，为客户省钱的同时，也省去了客户选购、比价的时间。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=4">
							<span class="icon bg-indigo"><img src="images/icon_04.png"/></span>
							<span class="subtitle">无增项加价，让您更放心</span>
							<span class="description">装修花销不再无底洞！建筑面积乘以单价即是最终决算，一次报价绝不再添一分钱。</span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-3 box">
						<a href="jg60.php?jid=5">
							<span class="icon bg-blue"><img src="images/icon_05.png"/></span>
							<span class="subtitle">规范施工，全程质保</span>
							<span class="description">茗居集团独有家装白皮书，上百条施工规范将家装量化到每一个细节。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=6">
							<span class="icon bg-green"><img src="images/icon_06.png"/></span>
							<span class="subtitle">绿色环保，让您更安心</span>
							<span class="description">茗居集团通过整合供应链，与百余家知名牌厂家直接建立合作，精选满足国家环保要求的产品。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=7">
							<span class="icon bg-orange"><img src="images/icon_07.png"/></span>
							<span class="subtitle">自由选择，您温暖的家</span>
							<span class="description">尊重消费者的个人喜好，根据特定需求的任意调换、删减，在保证装修风格统一的前提下，打造出属于您的温馨之家！</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=8">
							<span class="icon bg-crimson"><img src="images/icon_08.png"/></span>
							<span class="subtitle">星级保修，售后无忧</span>
							<span class="description">超五星级售后服务，并承诺客户：基础装修保修2年，内部水电隐蔽工程保修5年，主材保修1年，终身维护服务。</span>
						</a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="styleshow bg-grey container-full">
				<div class="bg-black row">
					<div class="title"><img src="images/title_02.png"/></div>
				</div>
				<div class="figwall row bg-grey">
					<div class="figwall-show row">
      					<div class="swiper-container swiper-show">
								<div class="swiper-wrapper">
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
									</div>
									<div class="swiper-slide">
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
										</div>
										<div class="row">
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
											<div class="col-4">
												<a href="#" class="box"><img src="images/jg6.jpg" class="img-full"></a>
											</div>
									
										</div>
									</div>
									
								</div>
							</div>
						<div class="swiper-button swiper-button-next"></div>
						<div class="swiper-button swiper-button-prev"></div>
					</div>
					<div class="container">
						<ul id="show-tabs" class="nav-tabs">
						    <li class="active"><a href="javascript:;" class="show-btn-1">客厅</a></li>
						    <li><a href="javascript:;" class="show-btn-2">厨房</a></li>
						    <li><a href="javascript:;" class="show-btn-3">主卧</a></li>
						    <li><a href="javascript:;" class="show-btn-4">次卧</a></li>
						    <li><a href="javascript:;" class="show-btn-5">卫生间</a></li>
						    <li><a href="javascript:;" class="show-btn-6">书房</a></li>
      					</ul>
      					<div class="clear"></div>
      				</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="brand container">
				<div class="content row">
					<div class="title row"><img src="images/title_03.png"/></div>
					<div class="info row">
						<p>　　茗居集团是香港派瑞投资顾问有限公司旗下的家装强势品牌。这是一家集建材采购、室内设计、装修施工于一体的新型装修企业。企业所采用的全新装修模式被誉为最经济便捷、高品质的家装新模式。</p>
						<p>　　由世界顶级设计师精心打造，带您领略最前沿的居住时尚。“全包式”装修，真正拎包入住。</p>
						<p>　　公司通过集约化管理，规范的施工队伍，娴熟的技术，严苛的跟踪监理制度，进度的严丝合缝，既保证了装修质量，也保证了不延误工期，以及强大的售后保修制度，承诺提供终身维修服务，让您在省心、放心的基础上更舒心。</p>
						<p>　　欢迎各位消费者的到来。选择茗居集团永远称心如意，选择茗居集团永远物超所值！</p>

					</div>
				</div>
				<div class="img"><img src="images/house.png"/></div>
				<div class="clear"></div>
			</div>
			<div class="partners container">
				<div class="title row"><img src="images/title_04.png"/></div>
				
				<div class="swiper-container partners-show">
					<div class="swiper-wrapper">
						<div class="swiper-slide">

								<div class="content">
								
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_07.jpg"/></div>
										<div class="partner-info">
											
											<h3><strong>老板</strong>  ROBAM</h3>
										</div>
									</div>		
													
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_02.jpg"/></div>
										<div class="partner-info">
											<h3><strong>德国都芳漆</strong>  DUFANG</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_03.jpg"/></div>
										<div class="partner-info">
											<h3><strong>海尔</strong>  HAIER</h3>
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_09.jpg"/></div>
										<div class="partner-info">
											<h3><strong>美标</strong>  AMERICANSTANDARD</h3>
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_08.jpg"/></div>
										<div class="partner-info">
											<h3><strong>罗马利奥</strong>  ROMARIO</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_06.jpg"/></div>
										<div class="partner-info">
											<h3><strong>快可美</strong>  QUICK-MIX</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_01.jpg"/></div>
										<div class="partner-info">
											<h3><strong>安心地板</strong>  ANXIN</h3>
										
										</div>
									</div>		
									
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_05.jpg"/></div>
										<div class="partner-info">
											<h3><strong>九星钢管</strong>  JIUXING</h3>
											
										</div>
									</div>
									
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_04.jpg"/></div>
										<div class="partner-info">
											<h3><strong>华为</strong>  HWAWELL</h3>
										</div>
									</div>
									
								</div>
								<div class="clear"></div>
							
						</div>
						
						
						<div class="swiper-slide">

								<div class="content">
								
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_10.jpg"/></div>
										<div class="partner-info">
											<h3><strong>魔帝</strong>  MIKN</h3>
										
										</div>
									</div>				
													
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_11.jpg"/></div>
										<div class="partner-info">
											<h3><strong>欧卡罗</strong>  OKELO</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_12.jpg"/></div>
										<div class="partner-info">
											<h3><strong>圣陶坊</strong>  SHENGTAOFANG</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_13.jpg"/></div>
										<div class="partner-info">
											<h3><strong>舒鑫</strong>  SHUXIN</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_14.jpg"/></div>
										<div class="partner-info">
											<h3><strong>天沛</strong>  TIANPEI</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_15.jpg"/></div>
										<div class="partner-info">
											<h3><strong>旺帮</strong>  WANGBANG</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_16.jpg"/></div>
										<div class="partner-info">
											<h3><strong>伟星管业</strong>  WEIXING</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_17.jpg"/></div>
										<div class="partner-info">
											<h3><strong>西蒙电气</strong>  SIMON</h3>
											
										</div>
									</div>
									
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_18.jpg"/></div>
										<div class="partner-info">
											<h3><strong>宜来</strong>  ELLAI</h3>
											
										</div>
									</div>
									
								</div>
								<div class="clear"></div>
							
						</div>
						
						
						<div class="swiper-slide">

								<div class="content">
								
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_19.jpg"/></div>
										<div class="partner-info">
											<h3><strong>筑巢</strong>  ZHUCHAO</h3>
										</div>
									</div>				
													
									<div class="box col-4">
										<div class="partner-logo"><img src="logos/icon_20.jpg"/></div>
										<div class="partner-info">
											<h3><strong>卓众线缆</strong>  ZHUOZHONG</h3>
										</div>
									</div>

								</div>
								<div class="clear"></div>
							
						</div>
						
						
					</div>
				</div>
				
				<div class="swiper-button swiper-button-next"></div>
				<div class="swiper-button swiper-button-prev"></div>
				
				<div class="clear"></div>
			</div>
			
		</div>
		
		<?php include 'end.php';?>

	</body>
	
	
	
</html>
	<script>
	
		var mySwiperB = new Swiper ('.partners-show', {
			speed:500,
			prevButton:'.partners .swiper-button-prev',
			nextButton:'.partners .swiper-button-next',
		});
		
		var mySwiper = new Swiper ('.banner .swiper-container', {
			pagination: '.pagination', // 如果需要分页器
			autoplayDisableOnInteraction : false, //用户操作分页器后不停止
			paginationClickable: true, //分页器可点击
			speed:500,
			autoplay:6000,
			prevButton:'.banner .swiper-button-prev',
			nextButton:'.banner .swiper-button-next',
		});
		
		var mySwiperA = new Swiper ('.swiper-show', {
			speed:500,
			prevButton:'.figwall .swiper-button-prev',
			nextButton:'.figwall .swiper-button-next',
		});
		
		
		$('.show-btn-1').click(function() {
			mySwiperA.slideTo(0);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		$('.show-btn-2').click(function() {
			mySwiperA.slideTo(2);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		
		$('.show-btn-3').click(function() {
			mySwiperA.slideTo(4);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		
		$('.show-btn-4').click(function() {
			mySwiperA.slideTo(6);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		
		$('.show-btn-5').click(function() {
			mySwiperA.slideTo(8);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		
		$('.show-btn-6').click(function() {
			mySwiperA.slideTo(10);
			$('.nav-tabs li').removeClass("active");
			$(this).parent('li').addClass("active");
		})
		
		$('.figwall-show .swiper-button, .figwall-show .swiper-slide').mouseover(function() {
			if(mySwiperA.activeIndex==0){
				$('.show-btn-1').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==1){
				$('.show-btn-1').parent('li').addClass("active");
			}else{
				$('.show-btn-1').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==2){
				$('.show-btn-2').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==3){
				$('.show-btn-2').parent('li').addClass("active");
			}else{
				$('.show-btn-2').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==4){
				$('.show-btn-3').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==5){
				$('.show-btn-3').parent('li').addClass("active");
			}else{
				$('.show-btn-3').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==6){
				$('.show-btn-4').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==7){
				$('.show-btn-4').parent('li').addClass("active");
			}else{
				$('.show-btn-4').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==8){
				$('.show-btn-5').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==9){
				$('.show-btn-5').parent('li').addClass("active");
			}else{
				$('.show-btn-5').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==10){
				$('.show-btn-6').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==11){
				$('.show-btn-6').parent('li').addClass("active");
			}else{
				$('.show-btn-6').parent('li').removeClass("active");
			}
		})
		
		$('.figwall-show .swiper-button, .figwall-show .swiper-slide').click(function() {
			if(mySwiperA.activeIndex==0){
				$('.show-btn-1').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==1){
				$('.show-btn-1').parent('li').addClass("active");
			}else{
				$('.show-btn-1').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==2){
				$('.show-btn-2').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==3){
				$('.show-btn-2').parent('li').addClass("active");
			}else{
				$('.show-btn-2').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==4){
				$('.show-btn-3').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==5){
				$('.show-btn-3').parent('li').addClass("active");
			}else{
				$('.show-btn-3').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==6){
				$('.show-btn-4').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==7){
				$('.show-btn-4').parent('li').addClass("active");
			}else{
				$('.show-btn-4').parent('li').removeClass("active");
			}
			
			if(mySwiperA.activeIndex==8){
				$('.show-btn-5').parent('li').addClass("active");
			}else if(mySwiperA.activeIndex==9){
				$('.show-btn-5').parent('li').addClass("active");
			}else{
				$('.show-btn-5').parent('li').removeClass("active");
			}
		})
	</script>
