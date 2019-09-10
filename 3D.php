<?php
require_once('top.inc');
$kd = kd(2);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 3D全景——一站式整体家装服务</title>
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
		<?php $nban='images/ban_shijing.jpg'; ?>
		<div class="content">
		  <div class="nban" style="background:url(images/ban_3d.jpg) center no-repeat;"></div>		 
			<div class="mainc">
        <div class="ybli p-t-0">
			   	<ul>		
					<?php
            $currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
						$all3D = new Query("*", "`x3d`", "", "`status` = 'ok'");
            $all3D = DAS::quickQuery($all3D, 'RC', '12', $currentPage);
            $all3D = DAS::hasData($all3D) ? $all3D : false;
						if($all3D){
              $_page = new Page($all3D['NUM_DATA'], $all3D['NUM_PER_PAGE']); 
              $count = count($all3D['data']);
              for($i=0;$i<$count;$i++){
                echo "\n";
          ?>
            <li><a href="<?php echo $all3D['data'][$i]["url"];?>" target="_blank"><span class="hover transition"><?php echo $all3D['data'][$i]["title"]?></span><img src="<?php echo $all3D['data'][$i]["pic"];?>"></a></li>
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
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>	
</html>
<script type="text/javascript" language="javascript">
<!--//
		$(document).ready(function() {
			$(".sa2 ul li a").click(function(){
				$(".sa2 ul li").removeClass("hoverss");
				$(this).parent("li").addClass("hoverss");
			});
		});
//-->
</script>
<?php require_once('bottom.inc');?>
