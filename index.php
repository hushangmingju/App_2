<?php
require_once('top.inc');
$region = VCS::getRegionByIP();
$kd = kd(1);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居官网——沪尚茗居,上海家装,沪尚茗居装修，沪上装修，一站式整体家装服务</title>
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
		<div class="home content container-full">
			<div class="banner container-full">
				<div class="reservation">
					<form method="post" id="hyuyue">
						<input type="hidden" name="type" value="banner">
            <input type="hidden" name="bultin" value="index_banner">
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
						<div class="rhead"></div>
						<div class="rform">
							<div class="item">
								<input type="text" name="name" id="hname" value="" placeholder="您的姓名" />
							</div>
							<div class="item">
								<input type="text" name="area" id="harea" value="" placeholder="房屋面积（㎡）" />
							</div>
							<div class="item">
								<input type="text" name="content" id="hadd" value="" placeholder="地址" />
							</div>
							<div class="item">
								<input type="text" name="tel" id="htel" value="" placeholder="电话" />
							</div>
						</div>
						<div class="rfoot">
							<a href="javascript:;" class="btn" id="hbtn">立即预约</a>
						</div>
					</form>
				</div>
				
				<div class="swiper-container">
					<div class="swiper-wrapper">
							<?php
							$swiperBanner = new Query("*", "banner", "", "status = 'ok' AND agent = 1", "ID DESC");
              $swiperBanner = DAS::quickQuery($swiperBanner);
							//pre($listArr);
							if(DAS::hasData($swiperBanner)){
                $swiperBanner = $swiperBanner['data'];
                $count = count($swiperBanner);
							  for($i=0;$i<$count;$i++){
								  echo "\n";
							      if (strpos($region['prov'], '福建') !== false && $i == 0) {
                              ?>
                        <div class="swiper-slide">
							<a href="zz.php"><img src="images/zz_banner_01.jpg" class="img-full"></a>
						</div>
                              <?php
                                  }
                                  else {
                              ?>
						<div class="swiper-slide">
							<a href="<?=$swiperBanner[$i]["url"]?>"><img src="<?php echo substr($swiperBanner[$i]["pic"], 1);?>" class="img-full"></a>
						</div>
							<?php
                                  }
							  }
              }
							?>
					</div>
				</div>
				<nav class="pagination"></nav>
				<div class="swiper-button swiper-button-next"></div>
				<div class="swiper-button swiper-button-prev"></div>
			</div>
			
			<?php
		$vurl = new Query("*", "`keys`", "", "`key`='shipin'");
    $vurl = DAS::quickQuery($vurl);
		$vurl = DAS::hasData($vurl) && isset($vurl['data'][0]['value2']) ? $vurl['data'][0]['value2'] : null;
			if($vurl){
			?>
			
			<div class="container container-small">
				<div class="home-table">
					<div class="calculator">
					  <div class="rhead">装修报价</div>
            <div style="height:80px;">&nbsp;</div>
            <div class="myinput">
						  <span>风格：</span>
						  <select name="style" id="calculator-style1">
							<?php $sty=0; ?>
                            <?php
                            $yangban = new Query("`t1`.*, `t2`.`name` AS shopName", "`tb_wcp_showrooms` AS `t1`", "LEFT JOIN `tb_wcp_shops` AS `t2` ON `t1`.`shop` = `t2`.`id`", "`t1`.`status` = 1 AND `t1`.`priceList` IS NOT NULL AND `t1`.`priceList` != ''");
                            $yangban = DAS::quickQuery($yangban);
							if (DAS::hasData($yangban)) {
                                foreach ($yangban['data'] as $yangbanOpt) {
                                    echo '<option value="' . $yangbanOpt['id'] . '" ' . (isset($_GET['id']) && is_int(intval($_GET['id'])) && intval($_GET['id']) == $yangbanOpt['id'] ? 'selected="selected"' : '') . '>' . $yangbanOpt['name'] . '(' . $yangbanOpt['shopName'] . ')</option>';
                                }
							}							
							?>
						</select>
					  </div>
					  <div class="myinput" style="display:none">
						  <span>单价：</span>
						  <input type="tel" name="" id="calculator-price1" value="0" disabled="disabled" />
						  <span class="unit">元/平方米</span>
					  </div>
					  <div class="myinput">
						  <span>面积：</span>
						  <input type="tel" name="" id="calculator-area1" value="" />
						  <span class="unit">平方米</span>
					  </div>
					  <div class="myinput">
						  <span>手机：</span>
						  <input type="tel" name="" id="calculator-mobile1" value="" />
						  <span class="unit"></span>
					  </div>
					  <div class="myinput">
						  <span>总价：</span>
						  <input type="tel" name="" id="calculator-total1" value="" disabled style="background-color:#fff;" />
						  <span class="unit">元</span>
					  </div>
					  <a href="#" class="ljyy" id="calculator-yuyue1">开始计算</a>
				  </div>
				</div>
				<div class="home-video">
                  <video id="showvideo" src="video/video20.mp4" ype="video/mp4" controls autoplay loop preload="preload" poster=""></video>
                  <!--<iframe class="video_iframe" style="z-index:1;" src="http://v.qq.com/iframe/player.html?vid=s0744vvny2s&amp;auto=1" allowfullscreen=1 frameborder="0" ></iframe>-->
					<!--<iframe id="showvideo" src="" frameborder=0 'allowfullscreen'></iframe>-->
				</div>
				
			</div>
			<?php
		}
			?>
			
			
			<div class="advantage container">
				<div class="title row p-b-20">
					<a href="#"><img src="images/title_01d.png"/></a>
				</div>
				<div class="row">
					<div class="col-3 box">
						<a href="jg60.php?jid=1">
							<span class="icon bg-red"><img src="images/icon_01.png"/></span>
							<span class="subtitle">68实景样板间，1：1呈现</span>
							<span class="description">沪尚茗居拥有六十八款不同风格、不同价位的实景样板间，从中式到西式，从简约到奢华，满足了不同人群的不同需求。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=2">
							<span class="icon bg-pink"><img src="images/icon_02.png"/></span>
							<span class="subtitle">集团化采购</span>
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
							<span class="description">装修花销不再无底洞！一房一价附上套餐配置单，明码标价不增项，绝不再加一分钱。</span>
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-3 box">
						<a href="jg60.php?jid=5">
							<span class="icon bg-blue"><img src="images/icon_05.png"/></span>
							<span class="subtitle">自由选择，您温暖的家</span>
							<span class="description">尊重消费者的个人喜好，根据特定需求的任意调换、删减，在保证装修风格统一的前提下，打造出属于您的温馨之家！</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=6">
							<span class="icon bg-green"><img src="images/icon_06.png"/></span>
							<span class="subtitle">绿色环保，让您更安心</span>
							<span class="description">上海茗居网络科技有限公司通过整合供应链，与百余家知名品牌厂家直接建立合作，精选满足国家环保要求的产品。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=7">
							<span class="icon bg-orange"><img src="images/icon_07.png"/></span>
							<span class="subtitle">规范施工，全程质保</span>
							
							<span class="description">上海茗居网络科技有限公司独有家装白皮书，上百条施工规范将家装量化到每一个细节。</span>
						</a>
					</div>
					<div class="col-3 box">
						<a href="jg60.php?jid=8">
							<span class="icon bg-crimson"><img src="images/icon_08.png"/></span>
							<span class="subtitle">星级保修，售后无忧</span>
							<span class="description">五星级售后服务，并承诺客户：基础装修保修2年，内部水电隐蔽工程保修10年，防水工程保修5年，终身维护服务。</span>
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
								<div class="swiper-slide cl1" data-toggle="1">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=28" class="box"><img src="images/现代/现代_08.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=31" class="box"><img src="images/现代/现代_09.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=45" class="box"><img src="images/现代/现代_07.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=21" class="box"><img src="images/现代/现代_03.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=21" class="box"><img src="images/现代/现代_11.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=2" class="box"><img src="images/现代/现代_12.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl1" data-toggle="2">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=20" class="box"><img src="images/现代/现代_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=27" class="box"><img src="images/现代/现代_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=61" class="box"><img src="images/现代/现代_10.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=25" class="box"><img src="images/现代/现代_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=39" class="box"><img src="images/现代/现代_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=44" class="box"><img src="images/现代/现代_06.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl2" data-toggle="1">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=43" class="box"><img src="images/欧式/欧式_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=46" class="box"><img src="images/欧式/欧式_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=30" class="box"><img src="images/欧式/欧式_03.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=4" class="box"><img src="images/欧式/欧式_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=15" class="box"><img src="images/欧式/欧式_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=35" class="box"><img src="images/欧式/欧式_06.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl3">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=33" class="box"><img src="images/中式/中式_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=40" class="box"><img src="images/中式/中式_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=40" class="box"><img src="images/中式/中式_03.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=13" class="box"><img src="images/中式/中式_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=40" class="box"><img src="images/中式/中式_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=18" class="box"><img src="images/中式/中式_06.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl4">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=5" class="box"><img src="images/美式/美式_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=34" class="box"><img src="images/美式/美式_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=62" class="box"><img src="images/美式/美式_03.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=23" class="box"><img src="images/美式/美式_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=7" class="box"><img src="images/美式/美式_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=7" class="box"><img src="images/美式/美式_06.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl4">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=16" class="box"><img src="images/美式/美式_07.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=16" class="box"><img src="images/美式/美式_08.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=41" class="box"><img src="images/美式/美式_09.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=37" class="box"><img src="images/美式/美式_10.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=42" class="box"><img src="images/美式/美式_11.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=11" class="box"><img src="images/美式/美式_12.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl5">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=36" class="box"><img src="images/日式/日式_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=29" class="box"><img src="images/日式/日式_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=26" class="box"><img src="images/日式/日式_03.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=43" class="box"><img src="images/日式/日式_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=36" class="box"><img src="images/日式/日式_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=12" class="box"><img src="images/日式/日式_06.jpg"></a>
										</div>
									</div>
								</div>
								<div class="swiper-slide cl6">
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=17" class="box"><img src="images/地中海/地中海_01.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=17" class="box"><img src="images/地中海/地中海_02.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=32" class="box"><img src="images/地中海/地中海_03.jpg"></a>
										</div>
									</div>
									<div class="row">
										<div class="col-4">
											<a href="yangban-v.php?id=32" class="box"><img src="images/地中海/地中海_04.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=47" class="box"><img src="images/地中海/地中海_05.jpg"></a>
										</div>
										<div class="col-4">
											<a href="yangban-v.php?id=3" class="box"><img src="images/地中海/地中海_06.jpg"></a>
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
						    <li class="active show-btn-1"><a href="javascript:;">现代</a></li>
						    <li class="show-btn-2"><a href="javascript:;">欧式</a></li>
						    <li class="show-btn-3"><a href="javascript:;">中式</a></li>
						    <li class="show-btn-4"><a href="javascript:;">美式</a></li>
						    <li class="show-btn-5"><a href="javascript:;">日式</a></li>
						    <li class="show-btn-6"><a href="javascript:;">地中海</a></li>
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
						<p>　　上海茗居网络科技有限公司，是一家集建材采购、室内设计、装修施工于一体的新型装修企业。企业创建的家装6.0全新装修模式被誉为经济便捷、高品质的家装新模式。</p>
						<p>　　上海茗居网络科技有限公司拥有六十八款实景样板间，全部由优秀设计师精心打造，带您领略前沿的居住时尚。这十几款实景样板间，不同风格、不同价位，满足了不同人群、不同要求。上海茗居网络科技有限公司真正是“全包式”装修，不仅包括硬装、家具、灯具等大件，就连毛巾架、马桶刷等每一个小件也全都包括在内，您所需要做的，就是像购物一样，从实景样板间里轻松挑选一款心仪的风格，签下合同后就无需再过问，让您省心省力住上满意的新家。</p>
						<p>　　这种新型的装修一站式模式，不仅方便顾客一目了然挑选到自己喜欢的装修风格，而且所有建材全部工厂直供，价格也比网购、团购更低，可以让您只花简单装修的钱，获得豪华装修的产品。</p>
						<p>　　上海茗居网络科技有限公司拥有一支规范的施工队伍，一千五百多名工人，常年围绕这十几种装修风格施工，练就了娴熟的技术。同时，公司通过集约化管理，标准化流程，达到施工进度的严丝合缝，既保证了装修质量，也保证了不延误工期。</p>
						<p>　　作为一家品牌企业，上海茗居网络科技有限公司还有着严苛的跟踪监理制度，以及强大的售后保修制度，承诺提供终身维修服务，让您在省心、放心的基础上更舒心。</p>
						<p>　　总之，上海茗居网络科技有限公司所有员工，会以专业的施工规范、细致的服务体系，具性价比的价格，欢迎各位消费者的到来。选择上海茗居网络科技有限公司让您称心如意，选择上海茗居网络科技有限公司让您物超所值！</p>
					</div>
				</div>
				<div class="img" style="padding-top: 220px;"><img src="images/house.png"/></div>
				<div class="clear"></div>
			</div>
			<div class="partners">
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
											<h3><strong>华唯</strong>  HWAWELL</h3>
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
						
						
						<!--<div class="swiper-slide">

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
							
						</div>-->
						
						
					</div>
				</div>
				
				<div class="swiper-button swiper-button-next"></div>
				<div class="swiper-button swiper-button-prev"></div>
				
				<div class="clear"></div>
			</div>
			
		</div>
		
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
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
			
			onSlideChangeStart: function(swiper){
				$('#show-tabs li').removeClass('active');
				var cl = $('.figwall-show .swiper-slide-active').attr('class').match(/\d+\b/);
				var bm = '.show-btn-' + cl;
				$(bm).addClass('active');
			}
		});
		
		//切换
		$('#show-tabs li').each(function(idx, $li) {
			var $li = $($li);
			var num = $li.attr('class').match(/\d+\b/);
			var s = '.swiper-wrapper .cl'+ num;
			var snum =$(s).index();
			$li.click(function() {
				mySwiperA.slideTo(snum);
			});
		});
		
		
		$(".side ul li").hover(function(){
			$(this).find(".sidebox").stop().animate({"width":"145px"},200).css({"opacity":"1","filter":"Alpha(opacity=100)","background":"#ae1c1c"});
			$(this).find(".sidebox.tell").stop().animate({"width":"170px"},200).css({"opacity":"1","filter":"Alpha(opacity=100)","background":"#ae1c1c"})		
		},function(){
			$(this).find(".sidebox").stop().animate({"width":"54px"},200).css({"opacity":"0.8","filter":"Alpha(opacity=80)","background":"#000"})	
		});
		
		function goTop(){
			$('html,body').animate({'scrollTop':0},600);
		}
		
		
		$("#hbtn").click(function(){
			
			if($('#hname').val()==""){
				alert('请填写您的姓名');
				return false;
			}else if($('#yyphone').val()==""){
				alert('请填写您的房屋面积');
				return false;
			}else if($('#yyphone').val()==""){
				alert('请填写您的地址');
				return false;
			}else if($('#yyarea').val()==""){
				alert('请填写您的电话');
				return false;
			};
			
			$.ajax({
			  type: 'POST',
			  url: "yuyuesave.php",
			  data: $("#hyuyue").serializeArray(),
			  dataType: "json",
			  success: function(data) { 
			   alert(data.TEXT);
			  },
			  error: function(data) { 
					alert("网络错误，请重试。");
			  },
			});
			
			return false;
		});
		
		/*
		$("#hbtn1").click(function(){
			
			if($('#hname1').val()==""){
				alert('请填写您的姓名');
				return false;
			}else if($('#yyphone1').val()==""){
				alert('请填写您的房屋面积');
				return false;
			}else if($('#yyphone1').val()==""){
				alert('请填写您的地址');
				return false;
			}else if($('#yyarea1').val()==""){
				alert('请填写您的电话');
				return false;
			};
			
			$.ajax({
			  type: 'POST',
			  url: "yuyuesave.php",
			  data: $("#hyuyue1").serializeArray(),
			  dataType: "json",
			  success: function(data) { 
			   alert(""+data.msg);
			  },
			  error: function(data) { 
					alert("网络错误，请重试。");
			  },
			});
			
			return false;
		});*/
    
    /*
    $('#calculator-price1').val($('#calculator-style1').children('option:selected').val());
		$('#calculator-style1').change(function(){
			$('#calculator-price1').val($(this).children('option:selected').val());
		});
		$('#calculator-area1').change(function(){
			if($('#calculator-area1').val()==""){
				$('#calculator-total1').val("");
			}else{
				//$('#calculator-total1').val( $('#calculator-price1').val() * $('#calculator-area1').val() ); //计算放到点击里计算
			}
		});
		$('#calculator-area1').keyup(function(){
			if($('#calculator-area1').val()==""){
				$('#calculator-total1').val("");
			}else{
				//$('#calculator-total1').val( $('#calculator-price1').val() * $('#calculator-area1').val() ); //计算放到点击里计算
			}
		});*/
    
        var yangbanList = <?php echo json_encode($yangban['data']);?>;
        $("#calculator-yuyue1").click(function(){       
            var $area = $('#calculator-area1').val();
            $area = parseInt($area) > 180 || parseInt($area) < 50 ? 80 : parseInt($area);
            var $style = $('#calculator-style1').children('option:selected').text();
			var $id = $('#calculator-style1').children('option:selected').val();
            for(var i = 0; i < yangbanList.length; i++){
                if(yangbanList[i].id == $id){
                    var tempPriceList = yangbanList[i].priceList.split("%0D%0A");
                    console.log(tempPriceList.length);
                    for(var j = 0; j < tempPriceList.length; j++){
                        tempPrice = tempPriceList[j].split("%09");
                        if(Math.ceil($area) == parseInt(tempPrice[0])){
                            var $total = Math.ceil(parseFloat(tempPrice[2].replace(/%20/, "")));
                            if(Math.ceil($area) == 80){
                                if(yangbanList[i].yangbanID != 26){
                                    $total = (Math.ceil($total/10)) * 10;
                                }
                                else{
                                    $total = 145310;
                                }
                                
                            }
                        }
                    }
                }
            }
			var $mobile = $('#calculator-mobile1').val();
			var POSTDATA = {"type":'calc3',"bultin":"index_calc","phpSelf":"<?php echo $_SERVER['PHP_SELF'];?>","calc-style":$style,"calc-area":$area,"calc-total":$total,"tel":$mobile};
			if($mobile==""){
				alert('手机号不能为空');return false;
			}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
				alert("手机号码格式不正确！"); return false;
			}
			
			
				$('#calculator-total1').val($total); 
				//window.location.href = "yuyue.php?s="+$style+"&p="+$price+"&a="+$area+"&t="+$total+"&mo="+$mobile;
				
			
				$.ajax({
				  type: 'POST',
				  url: "yuyuesave.php",
				  data: POSTDATA,
				  dataType: "json",
				  success: function(data) { 
				   //alert(data.TEXT);
				  },
				  error: function(data) { 
						//alert("网络错误，请重试。");
				  },
				
				});
				return false;

		});
    
    window.onload = function(){
      //document.getElementById("showvideo").src = "video/video01.mp4";
    }		
	</script>
<?php require_once('bottom.inc');?>