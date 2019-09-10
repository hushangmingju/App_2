<?php
require_once('top.inc');

$id = isset($_GET['id']) && intval($_GET['id']) > 0 ? intval($_GET['id']) : null;
$dbData = new Query("*", "`news`", "", "`id` = " . $id);
$dbData = DAS::quickQuery($dbData); 
if(DAS::hasData($dbData)){
  $dbData = $dbData['data'][0];
	$title=$dbData['title'];
	$desc=$dbData['desc'];
	$pic=$dbData['pic'];
	$content=$dbData['content'];
	$time=$dbData['time'];	
	$newskey=$dbData['newskey'];
	$newsdes=$dbData['newsdes'];
}
else{
	Header("HTTP/1.1 301 Moved Permanently");
	Header("Location: arclist.php");
}
?>
	<head>
		<meta charset="utf-8" />
		<title><?=$title?>——相关新闻——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$newskey?>" />
		<meta name="description" content="<?=$newsdes?>" />
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

						<div class="xinwen">
							<div class="title">
								<div class="time"><?php echo date("m-d-Y",$time);?>&nbsp;&nbsp;&nbsp;<?php echo date("h:i",$time);?>&nbsp;&nbsp;&nbsp;周<?php echo $week[date("w",$time)];?></div>
								<h1><?php echo $title;?></h1>
							</div>
							<div class="content">
								<div class="title-pic">
									<img src="<?php echo $pic;?>" class="img-full"/>
									<span class="author">由&nbsp;&nbsp;<span>官网人员</span>&nbsp;&nbsp;发布</span>
									<span class="share" style="display:none"><img src="images/share.png"/></span>
									<div class="clear"></div>
								</div>
								<div class="info">
									<?php echo $content;?>
								</div>
							</div>
						</div>

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
							<div class="lbk3"><a href="xinwen-list.php?type=1">官方咨询</a></div>
							<div class="lbk3"><a href="xinwen-list.php?type=2">活动分享</a></div>
							<div class="lbk3"><a href="xinwen-list.php?type=3">其他</a></div>
							
						</div>
						
						<div class="xinwenclass">
							<div class="wbstit">新闻列表<a href="#" class="refresh"></a></div>
							<?php
              $currentPage = isset($_GET['page']) && intval($_GET['page']) > 0 ? intval($_GET['page']) : 1;
              $newsList = new Query("*", "`news`", "", "`status` = 'ok'", "`id` DESC");
              $newsList = DAS::quickQuery($newsList, 'RC', 10, $currentPage);
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