<?php
require_once('top.inc');
$id = isset($_GET['id']) && intval($_GET['id']) ? intval($_GET['id']) : false;

if($id){
    $career = new Query("*", "`tb_mingju_jobs`", "", "`id` = " . $id);
    $career = DAS::quickQuery($career);
}
$kd = kd(14);
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
	<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
	<link rel="stylesheet" type="text/css" href="css/site.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php require_once('head_codes.inc');?>
  </head>

  <body>
    <?php require_once('body_top.inc');?>
	<div class="menu-mask"></div>
	<!--内容-->
	<div class="mybody">
	  <div class="yangban row">
		<div class="title">
		  <a href="jobs.html"><img src="images/title_jobs.png" /></a>
		</div>
        <div class="content">
		<?php
        if ($id && DAS::hasData($career)){
            $career = $career['data'][0];
        ?>
		  <div class="title">
			<h4><?php echo rawurldecode($career['post']);?></h4>
			<div class="time">发布日期： <?php echo substr($career['timestamp'], 0, strpos($career['timestamp'], ' '));?></div>
		  </div>
		  <div class="detail row"><?php echo rawurldecode($career['contents']);?></div>
		  <div class="clear"></div>
        <?php                    
        }
        else{
            $careers = new Query("*", "`tb_mingju_jobs`", "", "1", "timestamp DESC");
            $careers = DAS::quickQuery($careers);
            if (DAS::hasData($careers)){
        ?>
          <ul style="padding-left:32px; list-style:disc;">
        <?php
                foreach($careers['data'] as $career){
        ?>   
		    <li>
		      <a href="?id=<?php echo $career['id'];?>">
                <div style="font-size:18px; font-weight:bold; display:inline-block;"><?php echo rawurldecode($career['post']);?></div>
                <span style="padding-left:16px;"><?php echo $career['number'];?>人</span>
                <span style="padding-left:16px;"><?php echo rawurldecode($career['location']);?></span>
              </a>
		      <div class="time">发布日期： <?php echo substr($career['timestamp'], 0, strpos($career['timestamp'], ' '));?></div>
		    </li>
        <?php
                }
        ?>
          </ul>
        <?php               
            }
        }
        ?>
	    </div>
	    <div class="clear"></div>
	  </div>
    </div>
    <?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
  </body>
</html>