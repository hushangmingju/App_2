<?php
include(dirname(__FILE__).'/base.php');

$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `news` WHERE `id` = '$id'");

if($dbData){
	$title=$dbData['title'];
	$desc=$dbData['desc'];
	$pic=$dbData['pic'];
	$content=$dbData['content'];
	$time=$dbData['time'];
}else{
	echo "null";
	exit();
}
//pre($dbData);
$week = array("日","一","二","三","四","五","六");

?><?php $vvc=5; ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title><?=$title?></title>
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
		<?php $nban='images/ban_news.jpg'; ?>

		<div class="content">

			<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			<div class="mainc ">
				<div class="mainc3">

					<div class="caleft">

						<div class="xinwen">
							<div class="title">
								<div class="time"><?=date("Y-m-d",$time)?>&nbsp;&nbsp;&nbsp;<?=date("h:i",$time)?>&nbsp;&nbsp;&nbsp;周<?=$week[date("w",$time)]?></div>
								<h1><?=$title?></h1>
							</div>
							<div class="content">
								<div class="title-pic">
									<img src="<?=$pic?>" class="img-full"/>
									<span class="author">由&nbsp;&nbsp;<span>官网人员</span>&nbsp;&nbsp;发布</span>
									<span class="share" style="display:none"><img src="images/share.png"/></span>
									<div class="clear"></div>
								</div>
								<div class="info">
									<?=$content?>
								</div>
							</div>
						</div>

					</div>

					<div class="caright">
						<form action="" method="post">

							<div class="wssbk">
								<div class="ss1"><input type="text" name="keyword" value=""></div>
								<div class="ss2"><input type="image" src="images/sert2.png"></div>
							</div>

						</form>

						<div class="xinwentime">
							<div class="wbstit">按日期</div>
							<div class="lbk0"><a href="">2016年</a></div>
							<div class="lbk1">
								<ul>
									<li<?php if(date("m",time())==1){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=1">▪ 01月</a></li>
									<li<?php if(date("m",time())==2){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=2">▪ 02月</a></li>
									<li<?php if(date("m",time())==3){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=3">▪ 03月</a></li>
									<li<?php if(date("m",time())==4){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=4">▪ 04月</a></li>
									<li<?php if(date("m",time())==5){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=5">▪ 05月</a></li>
									<li<?php if(date("m",time())==6){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=6">▪ 06月</a></li>
									<li<?php if(date("m",time())==7){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=7">▪ 07月</a></li>
									<li<?php if(date("m",time())==8){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=8">▪ 08月</a></li>
									<li<?php if(date("m",time())==9){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=9">▪ 09月</a></li>
									<li<?php if(date("m",time())==10){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=10">▪ 10月</a></li>
									<li<?php if(date("m",time())==11){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=11">▪ 11月</a></li>
									<li<?php if(date("m",time())==12){ ?> class="hoverss"<?php } ?>><a href="arclist.php?m=12">▪ 12月</a></li>
									<div class="clear"></div>
								</ul>
							</div>
						</div>

						<div class="xinwenclass">
							<div class="wbstit">按分类</div>
							<div class="lbk3"><a href="arclist.php?type=1">官方咨询</a></div>
							<div class="lbk3"><a href="arclist.php?type=2">活动分享</a></div>
							<div class="lbk3"><a href="arclist.php?type=3">其他</a></div>
						</div>
						
						<div class="xinwenclass">
							<div class="wbstit">新闻列表<a href="#" class="refresh"></a></div>
							
							
							<?php
							$listArr = $db->QueryData("SELECT * FROM `news` WHERE `status` = 'ok'","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
							<div class="lbk3"><a href=""><?=date("m-d",$listArr[$i]["time"])?>：<?=mb_substr($listArr[$i]["title"],0,12,'utf-8');?>...</a></div>
							<?php
							}
							?>
						</div>

						<div class="pages">
							<a href="#" class="prev">&nbsp;</a>
							<span class="numbers">
									<a href="#" class="active">1</a>
								</span>
							<a href="#" class="next">&nbsp;</a>
						</div>

					</div>
					<div class="clear"></div>

				</div>
			</div>

		</div>

		<?php include 'end.php';?>

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