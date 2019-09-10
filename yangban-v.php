<?php
require_once('top.inc');
if (!isset($_GET['id']) || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`status` > 0 AND `id` = " . $_GET['id'])) {
    Header("HTTP/1.1 301 Moved Permanently");
	Header("Location: yangban.php");
}
$showroom = new Query("t1.*, t2.name AS shopName", "`tb_wcp_showrooms` AS t1", "LEFT JOIN `tb_wcp_shops` AS t2 ON t1.shop = t2.id", "t1.`id` = " . $_GET['id']);
$showroom = DAS::quickQuery($showroom);
$showroom = $showroom['data'][0];

$pictures = new Query("*", "`tb_wcp_images`", "", "`pageID` = -2 AND `status` = 1 AND `showroomNum` = " . $showroom['number'] . " AND `showroomShop` = " . $showroom['shop'], 'ordnung');
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$shops = new Query("*", "`tb_wcp_shops`", "", "`status` > 0", "`ordnung`, `id`");
$shops = DAS::quickQuery($shops);
$shops = DAS::hasData($shops) ? $shops['data'] : false;

$cover = false;
$livingPics = array();
$diningPics = array();
$kitchenPics = array();
$bathroomPics = array();
$masterPics = array();
$guestPics = array();
if ($pictures) {    
    foreach ($pictures as $picture) {
        switch ($picture['component']) {
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'cover':
                $cover = $picture;
                $cover['path'] = $cover['folderName'] . '/' . $cover['fileName'];
                $cover['suffix'] = strtoupper(substr($cover['fileName'], strrpos($cover['fileName'], '.')));
                $cover['size'] = round(filesize('../../images/showrooms/' . $showroom['number'] . '_' . $showroom['shop'] . '/' . $cover['fileName']) / 1024, 2) . 'KB';
                $cover['dimen'] = getimagesize($cover['path']);
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'living':
                $livingPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'dining':
                $diningPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'kitchen':
                $kitchenPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'bathroom':
                $bathroomPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'master':
                $masterPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'guest':
                $guestPics[] = $picture;
                break;
        }        
    }                                
}
$picArray = array($livingPics, $diningPics, $kitchenPics, $bathroomPics, $masterPics, $guestPics);
$picListArr = array($cover);
foreach ($picArray as $picList) {
    if (count($picList) > 0) {
        $picListArr[] = $picList[0];
    }
}
$roomName = array('客厅', '餐厅', '厨房', '卫生间', '主卧', '次卧');
$slideCount = count($picListArr) - 1;

$kd = kd(3);
$kd_k = $kd["k"];
$kd_d = $kd["d"];

$pid = isset($_GET['pid']) && $_GET['pid'] ? intval($_GET['pid']) : 1;
?>
	<head>
		<meta charset="utf-8" />
		<title><?=$showroom['name']?> <?=$showroom['ename']?> ( <?=$showroom['shopName']?>)——实景体验——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$title?> <?=$kd_k?>" />
		<meta name="description" content="<?=$title?> <?=$etitle?>，<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
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
			<div class="mainc">

				<div class="ybm1">

					<div class="gallery">

						<div class="ybtu">



							<div class="bd">
								<ul>
								
								<?php
								for($i=0;$i<count($picListArr);$i++){
								?>
									<li>
										<div class="bg"></div>
										<div class="pic">
											<a href="#"><img src="<?=$picListArr[$i]['folderName'] . '/' . $picListArr[$i]['fileName']?>" /></a>
										</div>
									</li>
								<?php
								}
								?>
								</ul>
							</div>

							<div class="hd">
								<a class="sPrev">&lt;</a>
								<a class="sNext">&gt;</a>
								<ul>
								<?php
								for($i=0;$i<count($picListArr);$i++){
								?>
									<li><img src="<?=$picListArr[$i]['folderName'] . '/' . $picListArr[$i]['fileName']?>" /></li>
								<?php
								}
								?>
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
							<div class="ybtit"><?=$showroom['name']?>&nbsp;&nbsp;<span><?=$showroom['ename']?></span></div>
							<div class="ybjj">
								<?=$showroom['content']?>
							</div>

							<div class="yyjsq">
								<div class="yy"><a href="yuyue.php?sid=<?=$showroom['id']?>">在线预约</a></div>
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
					<?php
                    $slideIndex = 1;
                    for ($i = 0; $i < count($picArray); $i++) {
                        if (count($picArray[$i]) > 0) {
                    ?>
                      <div class="slideBox" id="con_pic_<?php echo $slideIndex;?>" style="<?php echo $i == 0 ? 'height:auto;' : 'height:0px;';?>">
					    <div class="slide-arrow prev"></div>
						<div class="slide-arrow next"></div>
						<div class="bd">
						<?php
						    for ($j  =0; $j < count($picArray[$i]); $j++){
						?>
						  <div class="abstu"><img src="<?php echo $picArray[$i][$j]['folderName'] . '/' . $picArray[$i][$j]['fileName'];?>"></div>
						<?php
						    }
						?>
						</div>
					  </div>
                    <?php
                            $slideIndex++;
                        }
                    }                    
                    ?>	
						<div class="hd">
							<ul>
                    <?php
                    $slideIndex = 1;
                    for ($i = 0; $i < count($picArray); $i++) {
                        if (count($picArray[$i]) > 0) {
                    ?>
                            <li id="pic<?php echo $slideIndex;?>" onClick="setTab('pic',<?php echo $slideIndex;?>,<?php echo $slideCount;?>)"><?php echo $roomName[$i];?></li>
                    <?php
                            $slideIndex++;
                        }
                    }
                    ?>
							</ul>
						</div>
						
						<div class="abscon">
							<div class="abscon2">
								<div class="abscon2"><span><?=$showroom['name']?></span>&nbsp;&nbsp;&nbsp;<span style="display:none">￥<?=$price?> /平米</span></div>
							</div>
						</div>
						
						<script type="text/javascript">
							jQuery(".slideBox").slide({
								effect: "left",
								trigger: "click"
							});
						</script>
						
					</div>

				</div>

			</div>
		</div>

		
		<?php
		$yangbanTitle = $title;
		$yangbanPrice = $price;
		?>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>

</html>

<script>
<!--
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"on":"";
  con.style.height=i==cursel?"auto":"0";
}
}
//-->
</script>
<?php require_once('bottom.inc');?>