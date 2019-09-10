<?php
include(dirname(__FILE__).'/base.php');
?>
<?php $vvc=5; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>新闻资讯——一站式整体家装服务</title>
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
		<?php $nban='images/ban_news.jpg'; ?>
	
		<div class="content" >
		  
           		<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			     <div class="mainc" style="padding-bottom:50px">
				 
				   <div class="mainnews">   
				    
									<div class="newslist">
									   <ul>
										
							<?php
							
							$type = _GET("type") ? " AND `type` = '".intval(_GET("type"))."'  " : null;
							$listArr = $db->QueryData("SELECT * FROM `news` WHERE `status` = 'ok' $type ","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
										 <li>
											 <div class="nrq"><span><?=date("m-d",$listArr[$i]["time"])?></span> / <?=date("Y",$listArr[$i]["time"])?></div>
											 <div class="tit"><a href="xinwen.php?id=<?=$listArr[$i]["id"]?>"><?=$listArr[$i]["title"]?></a></div>
											 <div class="jj"><?=$listArr[$i]["desc"]?></div>
											 <div class="nmore"><a href="xinwen.php?id=<?=$listArr[$i]["id"]?>"><img src="images/nmore.jpg"></a></div>
										 </li>
							<?php
							}
							?>

										 
										 
										 
									
									   </ul>
									   <div class="clear"></div>
									</div>
					
					
					   </div>
					
				 
				 </div>
			           
				   
				   
			
		</div>
		
		<?php include 'end.php';?>

	</body>
	
	
	
</html>

		