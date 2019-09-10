<?php
require_once('top.inc');
$kd = kd(16);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 家装问答——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
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
		<?php $nban='images/ban_news.jpg'; ?>

		<div class="content">

			<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			<div class="mainc ">
				<div class="mainc3">

					<div class="caleft">
						
		 
				    
									<div class="newslist">
									   <ul>
										
										
										
										
							<?php
              $m = isset($_GET['m']) && $_GET['m'] ? intval($_GET['m']) : null;
							$m1 = gmmktime(0,0,0,$m,1,date("Y",time()));
							$m2 = gmmktime(0,0,0,($m+1),1,date("Y",time()));
							if($m){
								$mSql = "   AND `time`>'$m1' AND `time`<'$m2'   ";
							}else{
								$mSql = "";
							}
              $type = isset($_GET['type']) && intval($_GET['type']) ? intval($_GET['type']) : null;
							$typeSQL = isset($_GET['type']) && $_GET['type'] ? " AND `type` = '".intval($_GET['type'])."'  " : null;
              $searchSQL = isset($_POST['keyword']) && $_POST['keyword'] ? " AND `title` LIKE '%".addslashes($_POST['keyword'])."%'  " : null;
							$currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
              $news = new Query("*", "`news`", "", "`status` = 'ok'" . $searchSQL . $typeSQL . $mSql, "`id` DESC");
              $news = DAS::quickQuery($news, 'RC', 10, $currentPage);
              if(DAS::hasData($news)){
                $_page = new Page($news['NUM_DATA'], $news['NUM_PER_PAGE']); 
                $count = count($news['data']);
                for($i=0;$i<$count;$i++){
              ?>
										 <li>
											 <div class="nrq"><span><?php echo date("m-d",$news['data'][$i]["time"]);?></span> / <?php echo date("Y",$news['data'][$i]["time"]);?></div>
											 <div class="tit"><a href="xinwen.php?id=<?php echo $news['data'][$i]["id"];?>"><?php echo $news['data'][$i]["title"];?></a></div>
											 <div class="jj"><a href="xinwen.php?id=<?php echo $news['data'][$i]["id"];?>"><?php echo $news['data'][$i]["desc"];?></a></div>
										 </li>
							<?php  
                }
							?>
										
										
										
										 
										 
										 
									
									   </ul>
									   <div class="clear"></div>
									</div>
					
							<div class="pages">
								<?php echo $_page->showpage();?>
							</div>
              <?php
              }
              else{
              ?>
                <li>
                  <div class="tit" >抱歉，没有找到相关内容。</div>
								</li>
              </ul>
            </div>
            
              <?php
              }
              ?>
					</div>

					<div class="caright">
						<form action="xinwen-list.php" method="post">
							<div class="wssbk">
								<div class="ss1"><input type="text" name="keyword" value="<?php echo $_POST['keyword'];?>"></div>
								<div class="ss2"><input type="image" src="images/sert2.png"></div>
							</div>
						</form>

						<div class="xinwentime">
							<div class="wbstit">按日期</div>
							<div class="lbk0"><a href="">2018年</a></div>
							<div class="lbk1">
								<ul>
									<li<?php if(date("m",time())==1){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=1">▪ 01月</a></li>
									<li<?php if(date("m",time())==2){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=2">▪ 02月</a></li>
									<li<?php if(date("m",time())==3){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=3">▪ 03月</a></li>
									<li<?php if(date("m",time())==4){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=4">▪ 04月</a></li>
									<li<?php if(date("m",time())==5){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=5">▪ 05月</a></li>
									<li<?php if(date("m",time())==6){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=6">▪ 06月</a></li>
									<li<?php if(date("m",time())==7){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=7">▪ 07月</a></li>
									<li<?php if(date("m",time())==8){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=8">▪ 08月</a></li>
									<li<?php if(date("m",time())==9){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=9">▪ 09月</a></li>
									<li<?php if(date("m",time())==10){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=10">▪ 10月</a></li>
									<li<?php if(date("m",time())==11){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=11">▪ 11月</a></li>
									<li<?php if(date("m",time())==12){ ?> class="hoverss"<?php } ?>><a href="xinwen-list.php?m=12">▪ 12月</a></li>
									<div class="clear"></div>
								</ul>
							</div>
						</div>

						<div class="xinwenclass">
							<div class="wbstit">按分类</div>
							<div class="lbk3<?php if($type==1){echo " active";}?>"><a href="xinwen-list.php?type=1">官方咨询</a></div>
							<div class="lbk3<?php if($type==2){echo " active";}?>"><a href="xinwen-list.php?type=2">活动分享</a></div>
							<div class="lbk3<?php if($type==3){echo " active";}?>"><a href="xinwen-list.php?type=3">其他</a></div>
						</div>
						
						<div class="xinwenclass">
							<div class="wbstit">新闻列表<a href="#" class="refresh"></a></div>
							<?php
              $currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
              $newsList = new Query("*", "`news`", "", "`status` = 'ok'", "`id` DESC");
              $newsList = DAS::quickQuery($newsList, 'RC', 15, $currentPage);
              if(DAS::hasData($newsList)){
                $_page = new Page($newsList['NUM_DATA'], $newsList['NUM_PER_PAGE']); 
                $count = count($newsList['data']);
                for($i=0;$i<$count;$i++){
              ?>
							<div class="lbk3 <?php if($newsList['data'][$i]["id"]==$id){echo " active";}?>"><a href="xinwen.php?id=<?php echo $newsList['data'][$i]["id"];?>"><?php echo date("m-d",$newsList['data'][$i]["time"]);?>：<?php echo mb_substr($newsList['data'][$i]["title"],0,12,'utf-8');?>...</a></div>
							<?php
                }
              }
							?>
						</div>

						<div class="pages">
							<?php echo $_page->showpage();?>
						</div>

					</div>
					<div class="clear"></div>

				</div>
			</div>

		</div>

		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>

</html>
<script>
	<!--
	function setTab(name, cursel, n) {
		for (i = 1; i <= n; i++) {
			var menu = document.getElementById(name + i);
			var con = document.getElementById("con_" + name + "_" + i);
			menu.className = i == cursel ? "hover" : "";
			con.style.display = i == cursel ? "block" : "none";
		}
	}
	//-->

	function tjzs() {
		var count = $("#nr").val().length;
		if (count > 150) {
			var nr = $("#nr").val().substring(0, 150);
			$("#nr").val(nr);
			count = 150;
		}
		$("#zs").html(count);
	}

	$(document).ready(function() {

		$('.jj2').each(function(idx, $el) {
			var $el = $($el);
			var $span = $el.children('span');
			var $btnShow = $el.children('.words');
			var $btnHide = $el.children('.words-close');

			var text = $span.data('text');
			if (text) {
				$span.html(text.substring(0, 89) + "...");

				$btnShow.click(function() {
					$btnShow.hide();
					$btnHide.show();
					$span.html($span.data('text'));
				});
				$btnHide.click(function() {
					$btnHide.hide();
					$btnShow.show();
					$span.html($span.data('text').substring(0, 89) + "...");
				});
			}

		});
	})
</script>
<?php require_once('bottom.inc');?>