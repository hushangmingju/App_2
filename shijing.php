<?php
include(dirname(__FILE__).'/base.php');
?>
<?php $vvc=3; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 案例展示——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
		<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?283aa2e31b5dd10395bb9aad75050144";
		  var s = document.getElementsByTagName("script")[0];
		  s.parentNode.insertBefore(hm, s);
		})();
		</script>

	</head>
	<body>
		<?php include 'top.php';?>
		
		<?php $nban='images/ban_shijing.jpg'; ?>

<?php
$style = _GET("s") ? intval(_GET("s")) : 1;
$styleDescArr = array("现代风格是比较流行的一种风格，追求时尚与潮流，非常注重居室空间的布局与使用功能的完美结合。现代风格具有简洁造型、无过多的装饰、推崇科学合理的构造工艺，重视发挥材料的性能的特性。现代风格因简约、时尚的装修理念，深受都市人群喜爱。",
"美式风格，顾名思义是来自于美国的装修和装饰风格。美国是个移民国家，欧洲各国各民族人民来到美洲殖民地，把各民族各地区的装饰装修和家具风格都带到了美国，同时由于美国地大物博，极大的放开了移民们对尺寸的需求，使得美式风格以宽大，舒适，杂糅各种风格而著称。美式家居风格的这些元素也正好迎合了时下的文化资产者对生活方式的需求，即：有文化感、有贵气感，还不能缺乏自在感与情调感。",
"中国风是通过中式风格的特征，表达对清雅含蓄、端庄丰华的东方式精神境界的追求。新中式风格是通过对传统文化的认识，将现代元素和传统元素结合在一起，以现代人的审美需求来打造富有传统韵味的事物，让传统艺术在家装中得到合适的体现。",
"欧式风格，是一种来自于欧罗巴洲的风格。主要有法式风格，意大利风格，西班牙风格，英式风格，地中海风格，北欧风格等几大流派。欧式风格就是欧洲各国文化传统所表达的强烈的文化内涵，是近年来高档楼盘和别墅豪宅装修的主要风格。");
$styleDesc = isset($styleDescArr[($style-1)]) ? $styleDescArr[($style-1)] : null;
?>


		<div class="content">
		   <div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat;"></div>
		 
			       <div class="mainc">
				   
				        <div class="sjsx">
						   <div class="sjsx2"><img src="images/yz0.jpg"></div>
						   <div class="sjsx1">
						     
							   <div class="ybs0">
							       <div class="sa1">风格：</div>
								   <div class="sa2">
								     <ul>
									    <li<?php if($style==1){ ?> class="hoverss"<?php } ?>><a href="?s=1<?=$priceUrl?>">现代风格</a></li>
									    <li<?php if($style==2){ ?> class="hoverss"<?php } ?>><a href="?s=2<?=$priceUrl?>">美式风格</a></li>
									    <li<?php if($style==3){ ?> class="hoverss"<?php } ?>><a href="?s=3<?=$priceUrl?>">新中式风格</a></li>
									    <li<?php if($style==4){ ?> class="hoverss"<?php } ?>><a href="?s=4<?=$priceUrl?>">欧式风格</a></li>
									 </ul>
									 <div class="clear"></div>
								   </div>
								   <div class="clear"></div>
							   </div>
							   
					           <div class="smtip"><?=$styleDesc?></div>						   
							   
							   
							 
							 
						   </div>
						   <div class="clear"></div>
						</div>
			
						
					
					
					   <div class="sjli">
					      <ul>
						  
						<?php
							$type = _GET("s") ? " AND `type` = '".intval(_GET("s"))."'  " : null;
							$totalQuery = $db->QueryData("SELECT count(*) AS `count` FROM  `shijing` WHERE `status` = 'ok' $type ");
							$_total = isset($totalQuery['count']) ? $totalQuery['count'] : 0;
							$_pagesize = 9;
							$_page = new Page($_total,$_pagesize); 
							$limitSql = $_page->limit;
							$listArr = $db->QueryData("SELECT * FROM `shijing` WHERE `status` = 'ok' $type $limitSql","all");
						$count = count($listArr);
                        
						for($i=0;$i<$count;$i++){
							echo "\n";
						?>
						     <li>
							   <a href="shijing-v.php?id=<?=$listArr[$i]["id"]?>">
							      <div class="tu"><img src="<?=$listArr[$i]["pic"]?>"></div>
								  <div class="ms transition">
								    <div class="ms2">
								      <?=$listArr[$i]["yonghu"]?><br>用户评价：<?=$listArr[$i]["pingjia"]?>
									</div>
								  </div>
							   </a>
							 </li>
						
						<?php
						}
						?>
							 
					      </ul>
					      <div class="clear"></div>
					   </div>
					
					
						<div class="pages">
							<?=$_page->showpage()?>
						</div>
						
						
						
				   </div>
				   
				   
	   
				   
 		</div>
		
		<?php include 'end.php';?>

	</body>
	
	<script>
		$(document).ready(function() {
			$(".sa2 ul li a").click(function(){
				$(".sa2 ul li").removeClass("hoverss");
				$(this).parent("li").addClass("hoverss");
			});
		});
	</script>
	
</html>

