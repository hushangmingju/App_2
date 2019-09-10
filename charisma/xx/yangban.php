<?php
include(dirname(__FILE__).'/base.php');
?>
<?php $vvc=2; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>样板房体验——一站式整体家装服务</title>
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
		
		<?php $nban='images/nban_yanban.jpg'; ?>


<?php
$style = _GET("s") ? _GET("s") : 1;
$price = _GET("p") ? _GET("p") : 1;
$styleUrl = "&s=".$style;
$priceUrl = "&p=".$price;
?>


		<div class="content">
		   <div class="nban2" style="background:url(<?php echo $nban ;?>) center no-repeat;height:290px"></div>
		 
			       <div class="mainc">
				   
				        <div class="ybsx">
						   <div class="ybsx1"><img src="images/ybkk.png"></div>
						   <div class="ybsx2">
						     
							   <div class="ybs0">
							       <div class="sa1">风格：</div>
								   <div class="sa2 btnn1">
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
							   
							   <div class="ybs0">
							       <div class="sa1">价格：</div>
								   <div class="sa2 btnn2">
								     <ul>
									    <li<?php if($price==1){ ?> class="hoverss"<?php } ?>><a href="?p=1<?=$styleUrl?>">999-1599</a></li>
									    <li<?php if($price==2){ ?> class="hoverss"<?php } ?>><a href="?p=2<?=$styleUrl?>">1600-1999</a></li>
									    <li<?php if($price==3){ ?> class="hoverss"<?php } ?>><a href="?p=3<?=$styleUrl?>">2000-2599</a></li>
									 </ul>
									 <div class="clear"></div>
								   </div>
								   <div class="clear"></div>
							   </div>							   
							   
						   </div>
						   <div class="clear"></div>
						</div>
			
						
					
					   <div class="ybli">
					      <ul>
						  
						  
						  
						  
		<?php
		$id = _GET("id") ? intval(_GET("id")) : 1;
		$listArr = array(
																				array("id"=>"1","pic"=>"images/ybimg.jpg",),
																				array("id"=>"2","pic"=>"images/ybimg.jpg"),
																				array("id"=>"3","pic"=>"images/ybimg.jpg"),
																				array("id"=>"4","pic"=>"images/ybimg.jpg"),
																				array("id"=>"5","pic"=>"images/ybimg.jpg"),
																				array("id"=>"6","pic"=>"images/ybimg.jpg"),
																				array("id"=>"7","pic"=>"images/ybimg.jpg"),
																				array("id"=>"8","pic"=>"images/ybimg.jpg"),
																				array("id"=>"9","pic"=>"images/ybimg.jpg"),
																				);
		?>
						<?php
							$style = _GET("s") ? " AND `type` = '".intval(_GET("s"))."'  " : null;
							$price = _GET("p") ? intval(_GET("p")) : null;
							if($price==1){
								$priceSql =" AND ( `price`>='999' AND `price`<='1599' ) ";
							}elseif($price==2){
								$priceSql =" AND ( `price`>='1600' AND `price`<='1999' ) ";
							}elseif($price==3){
								$priceSql =" AND ( `price`>='2000' AND `price`<='2599' ) ";
							}else{
								$priceSql =" ";
							}
							
							$listArr = $db->QueryData("SELECT * FROM `yangban` WHERE `status` = 'ok' $style $priceSql ","all");
						$count = count($listArr);
						for($i=0;$i<$count;$i++){
							echo "\n";
						?>
						<li><a href="yangban-v.php?id=<?=$listArr[$i]["id"]?>"><span class="hover transition"></span><img src="<?=$listArr[$i]["pic"]?>"></a></li>
						<?php
						}
						?>
							 
							 
					      </ul>
					      <div class="clear"></div>
					   </div>

			
					<div class="pages">
							<a href="<?php if($id<=1){ echo "#";}else{echo "?id=".($id-1).$styleUrl.$priceUrl;}?>" class="prev">&nbsp;</a>
							<span class="numbers">
								<a href="#" class="active">1</a>
							</span>
							<a href="#" class="next">&nbsp;</a>
						</div>
					
				   </div>

 		</div>
		
		<?php include 'end.php';?>

	</body>
	<script>
		$(document).ready(function() {
			$(".btnn1 ul li a").click(function(){
				$(".btnn1 ul li").removeClass("hoverss");
				$(this).parent("li").addClass("hoverss");
			});
			
			$(".btnn2 ul li a").click(function(){
				$(".btnn2 ul li").removeClass("hoverss");
				$(this).parent("li").addClass("hoverss");
			});
		});
	</script>
</html>

