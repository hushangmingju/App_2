<?php
include(dirname(__FILE__).'/base.php');


$week = array("日","一","二","三","四","五","六");

?>
<?php $vvc=4; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>家装问答——一站式整体家装服务</title>
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
		<?php $nban='images/ban_wenda.jpg'; ?>
	
		<div class="content" >
		  
           		<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat;margin-bottom:0px"></div>

			     <div class="mainc " >
				   <div class="mainc3">
						   <div class="ctiwen">
								<div class="twtit">描述您的问题：</div>
								 
								 <form action="" method="post">
											<div class="">
												<div class="tw1"><textarea name="content" class="twkk" placeholder="详细说明您的情况，可获得更准确的回答哟~" id="nr" onkeyup="tjzs()" onpropertychange="if (value.length>150) value=value.substring(0,150)"></textarea></div>
												<div class="tw2">
													<div><input type="submit" name="submit" value="立即提交" class="twsubcc"></div>
													<div class="srss">输入 <span id="zs">0</span>/150</div>
												</div>
												<div class="clear"></div>
											</div>
								  </form>
											
						   </div>				 
				 
				 
				 
				      <div class="caleft">
					   
					        <div class="wendali">
								    <ul>
									   
									   
									   
							<?php
							$keyword = _POST("keyword") ? " AND `q` LIKE '%".addslashes(_POST("keyword"))."%'  " : null;
							$type = _GET("t") ? " AND `type` = '".intval(_GET("t"))."'  " : null;
							$listArr = $db->QueryData("SELECT * FROM `wenda` WHERE `mod`='wenda' AND `status` = 'ok' $keyword $type ","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
									   <li>
									      <div class="info"><?=date("Y-m-d H:i",$listArr[$i]["time"])?> 周<?=$week[date("w",$time)]?>  发布人：<?=$listArr[$i]["name"]?></div>
										  <div class="tit" ><a href="">Q：<?=$listArr[$i]["q"]?></a></div>
										  <div class="jj">
										        <div class="jj1">A：</div>
												<div class="jj2">
												   <span data-text="<?=str_replace("\n","<br>",$listArr[$i]["a"])?>"></span>
												   <a href="javascript:;" class="words-close" style="display: none;">收起内容</a>
												   <a href="javascript:;" class="words">显示完整内容</a>
												</div>
										  </div>
									   </li>
							<?php
							}
							?>
									   
								    </ul>
								 </div>
				
							<div class="pages">
								<a href="#" class="prev">&nbsp;</a>
								<span class="numbers">
									<a href="#" class="active">1</a>
								</span>
								<a href="#" class="next">&nbsp;</a>
							</div>
					
					  </div>	  
					   
				
					  <div class="caright">
					     <form action="" method="post" >
						 
							   <div class="wssbk">
							       <div class="ss1"><input type="text" name="keyword" value="<?=_POST("keyword")?>"></div>
								   <div class="ss2"><input type="image" src="images/sert2.png"></div>
							   </div>
							   
						  </form>
						  
						  <div class="wbstit">按日期</div>
						  <div class="lbk0"><a href="">2016年</a></div>
						  <div class="lbk1">
						     <ul>
									<li<?php if(date("m",time())==1){ ?> class="hoverss"<?php } ?>><a href="?m=1">▪ 01月</a></li>
									<li<?php if(date("m",time())==2){ ?> class="hoverss"<?php } ?>><a href="?m=2">▪ 02月</a></li>
									<li<?php if(date("m",time())==3){ ?> class="hoverss"<?php } ?>><a href="?m=3">▪ 03月</a></li>
									<li<?php if(date("m",time())==4){ ?> class="hoverss"<?php } ?>><a href="?m=4">▪ 04月</a></li>
									<li<?php if(date("m",time())==5){ ?> class="hoverss"<?php } ?>><a href="?m=5">▪ 05月</a></li>
									<li<?php if(date("m",time())==6){ ?> class="hoverss"<?php } ?>><a href="?m=6">▪ 06月</a></li>
									<li<?php if(date("m",time())==7){ ?> class="hoverss"<?php } ?>><a href="?m=7">▪ 07月</a></li>
									<li<?php if(date("m",time())==8){ ?> class="hoverss"<?php } ?>><a href="?m=8">▪ 08月</a></li>
									<li<?php if(date("m",time())==9){ ?> class="hoverss"<?php } ?>><a href="?m=9">▪ 09月</a></li>
									<li<?php if(date("m",time())==10){ ?> class="hoverss"<?php } ?>><a href="?m=10">▪ 10月</a></li>
									<li<?php if(date("m",time())==11){ ?> class="hoverss"<?php } ?>><a href="?m=11">▪ 11月</a></li>
									<li<?php if(date("m",time())==12){ ?> class="hoverss"<?php } ?>><a href="?m=12">▪ 12月</a></li>
							   <div class="clear"></div>
						     </ul>
						  </div>
						  
						  <!--<div class="lbk0"><a href="">2015年</a></div>
						  <div class="lbk1">
						     <ul>
							   <li><a href="">▪ 01月</a></li><li><a href="">▪ 02月</a></li><li><a href="">▪ 03月</a></li>
							   <li><a href="">▪ 04月</a></li><li><a href="">▪ 05月</a></li><li><a href="">▪ 06月</a></li>
							   <li><a href="">▪ 07月</a></li><li><a href="">▪ 08月</a></li><li><a href="">▪ 09月</a></li>
							   <li><a href="">▪ 10月</a></li><li><a href="">▪ 11月</a></li><li><a href="">▪ 12月</a></li>
							   <div class="clear"></div>
						     </ul>
						  </div>
						  
						  
						  <div class="lbk0"><a href="">2014年</a></div>
						  <div class="lbk1">
						     <ul>
							   <li><a href="">▪ 01月</a></li><li><a href="">▪ 02月</a></li><li><a href="">▪ 03月</a></li>
							   <li><a href="">▪ 04月</a></li><li><a href="">▪ 05月</a></li><li><a href="">▪ 06月</a></li>
							   <li><a href="">▪ 07月</a></li><li><a href="">▪ 08月</a></li><li><a href="">▪ 09月</a></li>
							   <li><a href="">▪ 10月</a></li><li><a href="">▪ 11月</a></li><li><a href="">▪ 12月</a></li>
							   <div class="clear"></div>
						     </ul>
						  </div>-->
						  
						  
						  <div class="wbstit">按分类</div>
						  <div class="lbk3"><a href="?t=1">一站式整体装修</a></div>
						  <div class="lbk3"><a href="?t=2">品牌评测</a></div>
						  <div class="lbk3"><a href="?t=3">施工注意</a></div>
						  <div class="lbk3"><a href="?t=4">一站式整体装修</a></div>
						  <div class="lbk3"><a href="?t=5">一站式整体装修</a></div>
						  
							   
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
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"hover":"";
  con.style.display=i==cursel?"block":"none";
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

	$('.jj2').each(function(idx, $el){
		var $el = $($el);
		var $span = $el.children('span');
		var $btnShow = $el.children('.words');
		var $btnHide = $el.children('.words-close');

		var text = $span.data('text');
		if (text) {
			$span.html(text.substring(0,89)+"...");

			$btnShow.click(function(){
				$btnShow.hide();
				$btnHide.show();
				$span.html($span.data('text'));
			});
			$btnHide.click(function(){
				$btnHide.hide();
				$btnShow.show();
				$span.html($span.data('text').substring(0,89)+"...");
			});
		}

	});
})

</script>