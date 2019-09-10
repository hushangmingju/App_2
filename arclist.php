<?php
require_once('top.inc');
$kd = kd(15);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 相关新闻——一站式整体家装服务</title>
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
		<?php $nban='images/ban_news.jpg'; ?>
	
		<div class="content" >
		  
           		<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			     <div class="mainc" style="padding-bottom:50px">
				 
				   <div class="mainnews">   
				    
									<div class="newslist">
									   <ul>
										
										
							<?php

							
							$currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
							$whereStr = isset($_GET['type']) && intval($_GET['type']) ? " AND `type` = '".intval($_GET['type'])."'  " : null;
							$news = new Query("*", "`news`", "", "`status` = 'ok'" . $whereStr, "`time` DESC");
              $news = DAS::quickQuery($news, 'RC', 12, $currentPage);
              if(DAS::hasData($news)){
                $_page = new Page($news['NUM_DATA'], $news['NUM_PER_PAGE']); 
                $count = count($news['data']);
                for($i=0;$i<$count;$i++){
            ?>
              <li>
											 <div class="nrq"><span><?php echo date("m-d",$news['data'][$i]["time"]);?></span> / <?php echo date("Y",$news['data'][$i]["time"]);?></div>
											 <div class="tit"><a href="xinwen.php?id=<?php echo $news['data'][$i]["id"];?>"><?php echo $news['data'][$i]["title"];?></a></div>
											 <div class="jj"><a href="xinwen.php?id=<?php echo $news['data'][$i]["id"];?>"><?php echo $news['data'][$i]["desc"];?></a></div>
											 <div class="nmore"><a href="xinwen.php?id=<?php echo $news['data'][$i]["id"];?>"></a></div>
										 </li>
            <?php
                }
              }
							?>
										
										 
										 
										 
									
									   </ul>
									   <div class="clear"></div>
									</div>
									
								
							<div class="pages">
								<?php echo $_page->showpage();?>
							</div>
					
					
					   </div>
					
				 
				 </div>
			           
				   
				   
			
		</div>
		
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>
	
	
	
</html>
<?php require_once('bottom.inc');?>