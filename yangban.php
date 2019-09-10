<?php
require_once('top.inc');
$styleTag = isset($_GET['style']) && $_GET['style'] ? $_GET['style'] : false;
$kd = kd(3);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
$currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;

if ($styleTag) {
    $showrooms = new Query("`t2`.*, `t3`.`name` AS shopName", "`tb_wcp_tags` AS `t1`", "LEFT JOIN `tb_wcp_showrooms` AS `t2` ON `t1`.`itemID` = `t2`.`id` LEFT JOIN `tb_wcp_shops` AS `t3` ON `t3`.`id` = `t2`.`shop`", "`t1`.`tagGroup` = '风格' AND `t1`.`itemType` = 1 AND `t1`.`tag` = '" . $styleTag . "' AND `t2`.`status` = 1", "`t1`.`tagIndex`, `t1`.`itemIndex`");
}
else {
    $showrooms = new Query("`t1`.*, `t2`.`name` AS shopName", "`tb_wcp_showrooms` AS `t1`", "LEFT JOIN `tb_wcp_shops` AS `t2` ON `t1`.`shop` = `t2`.`id`", "`t1`.`status` = 1", "`t1`.`ordnung`, `t1`.`id` DESC, `t1`.`number`");
}
$showrooms = DAS::quickQuery($showrooms, 'RC', 12, $currentPage);
$showrooms = DAS::hasData($showrooms) ? $showrooms : false;

$covers = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = -2 AND `component` LIKE 'sr%cover'");
$covers = DAS::quickQuery($covers);
$covers = DAS::hasData($covers) ? $covers['data'] : false;
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 实景体验——一站式整体家装服务</title>
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
		<?php $nban='images/nban_yanban.jpg'; ?>
		<div class="content">
		  <div class="nban2" style="background:url(<?php echo $nban ;?>) center no-repeat; height:290px; width:1200px; margin:0 auto"></div>		 
			<div class="mainc">				   
			  <div class="ybsx">
				  <div class="ybsx1"><img src="images/ybkk.png"></div>
					<div class="ybsx2">
						<div class="ybs0">
							<div class="sa1">风格：</div>
							<div class="sa2 btnn1">
								<ul>
									<li<?php if($styleTag=='现代简约'){ ?> class="hoverss"<?php } ?>><a href="?style=现代简约">现代简约</a></li>
									<li<?php if($styleTag=='美式风格'){ ?> class="hoverss"<?php } ?>><a href="?style=美式风格">美式风格</a></li>
									<li<?php if($styleTag=='欧式风格'){ ?> class="hoverss"<?php } ?>><a href="?style=欧式风格">欧式风格</a></li>
									<li<?php if($styleTag=='中式风格'){ ?> class="hoverss"<?php } ?>><a href="?style=中式风格">中式风格</a></li>
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
			if ($showrooms) {
                $_page = new Page($showrooms['NUM_DATA'], $showrooms['NUM_PER_PAGE']); 
                $count = count($showrooms['data']);
                for($i=0;$i<$count;$i++){
                  echo "\n";
                  foreach ($covers as $cover) {
                      if ($cover['showroomNum'] == $showrooms['data'][$i]['number'] && $cover['showroomShop'] == $showrooms['data'][$i]['shop']) {
                          $showroomCover = $cover;
                      }
                  }
					  ?>
						<li>
                          <a href="yangban-v.php?id=<?=$showrooms['data'][$i]["id"]?>">
                            <span class="hover transition">
                            <?php
                            if ($showrooms['data'][$i]['ename']) {
                            ?>  
                              <div style="display:inline-block; height:55px;"><?php echo $showrooms['data'][$i]['name'];?></div><br/>
                              <div style="display:inline-block; height:55px; font-variant:small-caps; border-top:2px #FFFFFF solid; padding:0px 10px 0px 10px;"><?php echo $showrooms['data'][$i]['ename'];?></div>  
                            <?php
                            }
                            else {
                            ?>
                              <div style="display:inline-block; height:110px; padding:24px;">
                                <?php echo $showrooms['data'][$i]['name'];?>
                              </div>
                            <?php
                            }
                            ?>                            
                            </span>
                            <img src="<?=$showroomCover["folderName"] . '/' . $showroomCover["fileName"]?>" style="width:380px; height:310px;">
                          </a>
                        </li>
					  <?php
                }
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
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>
</html>
<script language="javascript" type="text/javascript">
<!--//
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
//-->
</script>
<?php require_once('bottom.inc');?>
