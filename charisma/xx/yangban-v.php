<?php
include(dirname(__FILE__).'/base.php');
$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `yangban` WHERE `id` = '$id'");

if($dbData){
	$title=$dbData['title'];
	$desc=$dbData['desc'];
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
}else{
	echo "null";
	exit();
}
$styleNameArr = array("现代风格","美式风格","新中式风格","欧式风格");
$styleDescArr = array("现代风格是比较流行的一种风格，追求时尚与潮流，非常注重居室空间的布局与使用功能的完美结合。现代风格具有简洁造型、无过多的装饰、推崇科学合理的构造工艺，重视发挥材料的性能的特性。现代风格因简约、时尚的装修理念，深受都市人群喜爱。",
"欧式风格，是一种来自于欧罗巴洲的风格。主要有法式风格，意大利风格，西班牙风格，英式风格，地中海风格，北欧风格等几大流派。欧式风格就是欧洲各国文化传统所表达的强烈的文化内涵，是近年来高档楼盘和别墅豪宅装修的主要风格。",
"美式风格，顾名思义是来自于美国的装修和装饰风格。美国是个移民国家，欧洲各国各民族人民来到美洲殖民地，把各民族各地区的装饰装修和家具风格都带到了美国，同时由于美国地大物博，极大的放开了移民们对尺寸的需求，使得美式风格以宽大，舒适，杂糅各种风格而著称。美式家居风格的这些元素也正好迎合了时下的文化资产者对生活方式的需求，即：有文化感、有贵气感，还不能缺乏自在感与情调感。",
"中国风是通过中式风格的特征，表达对清雅含蓄、端庄丰华的东方式精神境界的追求。新中式风格是通过对传统文化的认识，将现代元素和传统元素结合在一起，以现代人的审美需求来打造富有传统韵味的事物，让传统艺术在家装中得到合适的体现。");
$styleDesc = isset($styleDescArr[($style-1)]) ? $styleDescArr[($style-1)] : null;
$styleName = isset($styleNameArr[($style-1)]) ? $styleNameArr[($style-1)] : null;
?>

<?php $vvc=2; ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居——一站式整体家装服务</title>
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

		<div class="content">
			<div class="mainc">

				<div class="ybm1">

					<div class="gallery">

						<div class="ybtu">

							<div class="bd">
								<ul>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic1?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic2?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic3?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic4?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic5?>" /></a>
										</div>
									</li>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$pic6?>" /></a>
										</div>
									</li>
								</ul>
							</div>

							<div class="hd">
								<a class="sPrev">&lt;</a>
								<a class="sNext">&gt;</a>
								<ul>
									<li><img src="<?=$pic?>" /></li>
									<li><img src="<?=$pic1?>" /></li>
									<li><img src="<?=$pic2?>" /></li>
									<li><img src="<?=$pic3?>" /></li>
									<li><img src="<?=$pic4?>" /></li>
									<li><img src="<?=$pic5?>" /></li>
									<li><img src="<?=$pic6?>" /></li>
								</ul>
							</div>

							<script type="text/javascript">
								jQuery(".hd").slide({
									mainCell: "ul",
									effect: "leftLoop",
									autoPlay: true,
									vis: 3,
									prevCell: ".sPrev",
									nextCell: ".sNext"
								});
								jQuery(".gallery").slide({
									mainCell: ".bd ul",
									effect: "leftLoop",
									autoPlay: true,
									delayTime: 0,
									defaultIndex: 0
								});
							</script>


						</div>
						<div class="ybxx">
							<div class="ybtit"><?=$styleName?>&nbsp;&nbsp;<span>Modern Style</span></div>
							<div class="ybjj">
								<?=$styleDesc?>
							</div>

							<div class="yyjsq">
								<div class="yy"><a href="yuyue.php?sid=<?=$id?>">在线预约</a></div>
								<div class="jsq"><a href="javascript:;" class="js-kai">计算器</a></div>
								<div class="clear"></div>
							</div>

						</div>
						<div class="clear"></div>

					</div>

				</div>

				<div class="kjpz">空间配置</div>

				<div class="tt2">

					<div class="slideTxtBox">
						<div class="hd">
							<ul>
								<li>客厅</li>
								<li>主卧</li>
								<li>次卧</li>
								<li>餐厅</li>
								<li>厨房</li>
								<li>卫生间</li>
							</ul>
						</div>
						<div class="bd">
							<ul>
								<div class="abstu"><img src="<?=$pic1?>"></div>
								<div class="abscon">
									<div class="abscon2">
										<div class="abscon2"><span>客厅包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label1?></div>
									</div>
								</div>
							</ul>
							<ul>
								<div class="abstu"><img src="<?=$pic2?>"></div>
								<div class="abscon">
									<div class="abscon2"><span>主卧包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label2?></div>
								</div>
							</ul>
							<ul>
								<div class="abstu"><img src="<?=$pic3?>"></div>
								<div class="abscon">
									<div class="abscon2"><span>次卧包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label3?></div>
								</div>
							</ul>

							<ul>
								<div class="abstu"><img src="<?=$pic4?>"></div>
								<div class="abscon">
									<div class="abscon2"><span>餐厅包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label4?></div>
								</div>
							</ul>
							<ul>
								<div class="abstu"><img src="<?=$pic5?>"></div>
								<div class="abscon">
									<div class="abscon2"><span>厨房包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label5?></div>
								</div>
							</ul>
							<ul>
								<div class="abstu"><img src="<?=$pic6?>"></div>
								<div class="abscon">
									<div class="abscon2"><span>卫生间包含项目</span>&nbsp;&nbsp;&nbsp;<?=$label6?></div>
								</div>
							</ul>

						</div>
					</div>
					<script type="text/javascript">
						jQuery(".slideTxtBox").slide({
							effect: "left",
							trigger: "click"
						});
					</script>

				</div>

			</div>
		</div>

		<?php include 'end.php';?>

	</body>

</html>