<?php
require_once('top.inc');
$kd = kd(32);
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
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php require_once('head_codes.inc');?>
	</head>
	<body>
    <?php require_once('body_top.inc');?>
		<div class="menu-mask"></div>
		
		
		
		<!--内容-->
		<div class="mybody jg60">

			<div class="jiazhuang row">
				<div class="title">
					<img src="images/title_jg60.png"/>
					<h2>包设计  |  包主材  |  包施工  |  包家具｜包灯具  |  包软装</h2>
				</div>
				<?php
				$jid = isset($_GET['jid']) && intval($_GET['jid']) ? intval($_GET['jid']) : 1;
				?>
				<div class="box-list col-2">
					<div class="box<?php if($jid==1){echo " active";} ?>">
						<a href="jg60.html?jid=1">
							<span class="icon bg-red"><img src="images/icon/icon_01.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==2){echo " active";} ?>">
						<a href="jg60.html?jid=2">
							<span class="icon bg-pink"><img src="images/icon/icon_02.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==3){echo " active";} ?>">
						<a href="jg60.html?jid=3">
							<span class="icon bg-purple"><img src="images/icon/icon_03.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==4){echo " active";} ?>">
						<a href="jg60.html?jid=4">
							<span class="icon bg-indigo"><img src="images/icon/icon_04.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==5){echo " active";} ?>">
						<a href="jg60.html?jid=5">
							<span class="icon bg-blue"><img src="images/icon/icon_05.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==6){echo " active";} ?>">
						<a href="jg60.html?jid=6">
							<span class="icon bg-green"><img src="images/icon/icon_06.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==7){echo " active";} ?>">
						<a href="jg60.html?jid=7">
							<span class="icon bg-orange"><img src="images/icon/icon_07.png"/></span>
						</a>
					</div>
					<div class="box<?php if($jid==8){echo " active";} ?>">
						<a href="jg60.html?jid=8">
							<span class="icon bg-crimson"><img src="images/icon/icon_08.png"/></span>
						</a>
					</div>
				</div>
				
				
				
				<?php if($jid==1){ ?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys1">01.实景样板间，所见即所得</h3>
					</div>
					<div class="detail row">
						沪尚茗居拥有十几款不同风格、不同价位的实景样板间，从中式到西式，从简约到奢华，满足了不同人群的不同需求，完美实现1:1实景复制。
					</div>
				</div>
				<?php }elseif($jid==2){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys2">02.工厂价装修，价格超低</h3>
					</div>
					<div class="detail row">
						在沪尚茗居定装修，百平米至少省5万元。沪尚茗居与百余个一线大品牌建立常年合作。所有产品全部以集团统一采购形式直接从工厂批量进货，节省大额装修成本，直供消费者，价格至少比普通装修公司节省30%。专业的采购团队提前帮客户砍价，所用装修材料全部底价工厂直供。
					</div>
				</div>
				<?php }elseif($jid==3){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys3">03.家装全包，不用您费心</h3>
					</div>
					<div class="detail row">
						 “全包式”套餐，大到家具家电，小到马桶刷都为客户配齐，在为客户省钱的同时，也省去了客户自己选购、比价的时间。同时，沪尚茗居采用的是新的计费方式：单价X建筑面积=预算，预算=决算，装修过程中绝不再让消费者多花一分钱。选择沪尚茗居，真正实现拎包入住。
					</div>
				</div>
				<?php }elseif($jid==4){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys4">04.无增项加价，让您更放心</h3>
					</div>
					<div class="detail row">
						装修花销不再无底洞！建筑面积乘以单价即是最终决算，一次报价绝不再添一分钱。可能你遇到过传统家装黑幕，可能你遭遇过家装过程逐渐加价，但在沪尚茗居绝对不会有，真正让您超省心。
					</div>
				</div>
				<?php }elseif($jid==5){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys5">05.自由选择，您温暖的家</h3>
					</div>
					<div class="detail row">
						沪尚家装尊重所有消费者的个人喜好，提供了多种不同品牌的产品，可以根据消费者的特定需求任意调换、删减，在保证装修风格协调统一的前提下，打造出属于您的温馨之家！
					</div>
				</div>
				<?php }elseif($jid==6){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys6">06.绿色环保，让您更安心</h3>
					</div>
					<div class="detail row">
						选材料是装修的关键一步，材料选的好，装修工程才能算是完美。沪尚茗居通过整合供应链，与百余家知名品牌厂家直接建立合作，精选满足国家环保要求的产品。合理的价格，环保的产品，让您与您的家人享受安全健康的居住环境。辅材有美国联想接线端子、德国的欧松板、环保无碳的石膏板、水电行业领军品牌伟星管线、多乐士安心家乳胶漆等知名品牌产品。
					</div>
				</div>
				<?php }elseif($jid==7){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys7">07.规范施工，全程质保</h3>
					</div>
					<div class="detail row">
						沪尚茗居独有家装白皮书，上百条施工规范将家装量化到每一个细节。一道工序结束后，必须由客户和质检人员共同确认达到白皮书施工标准后，才能进行下一道工序的施工。如发现不合格项目，必须砸掉重做，费用由沪尚茗居承担。
					</div>
				</div>
				<?php }elseif($jid==8){?>
				<div class="content col-8">
					<div class="title row">
						<h3 class="ys8">08.星级保修，售后无忧</h3>
					</div>
					<div class="detail row">
						沪尚茗居有着超五星级售后服务，并承诺客户：基础装修保修2年，内部水电隐蔽工程保修5年，主材保修1年，终身维护服务。接听来电后24小时内上门解除客户的后顾之忧。
					</div>
				</div>
				<?php }?>
				<div class="clear"></div>

			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>
