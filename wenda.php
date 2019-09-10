<?php
require_once('top.inc');
$kd = kd(8);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 家装问答——一站式整体家装服务</title>
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
		<?php $nban='images/ban_wenda.jpg'; ?>	
		<div class="content" >		  
      <div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat;margin-bottom:0px"></div>
			<div class="mainc " >
				<div class="mainc3">
					<div class="ctiwen">
						<div class="twtit">描述您的问题：</div>								 
						<form action="" method="post" id="wenda">
							<input type="hidden" name="type" value="wenda">
							<input type="hidden" name="bultin" value="wenda_wenda">
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
							<div class="">
								<div class="tw1"><textarea name="content" class="twkk" placeholder="详细说明您的情况，可获得更准确的回答哟~" id="nr" onkeyup="tjzs()" onpropertychange="if (value.length>150) value=value.substring(0,150)"></textarea></div>
								<div class="tw2">
									<div><input type="button" value="立即提交" id="wendabutton" class="twsubcc"></div>
									<div class="srss">输入 <span id="zs">0</span>/150</div>
								</div>
								<div class="clear"></div>
							</div>
						</form>											
					  <script type="text/javascript" language="javascript">
            <!--//
		        $("#wendabutton").click(function(){
              $.ajax({
                type: 'POST',
                url: "yuyuesave.php",
                data: $("#wenda").serializeArray(),
                dataType: "json",
                success: function(data) { 
                  alert(data.TEXT);
                },
                error: function(data) { 
		              alert("网络错误，请重试。");
                },
              });
			        return false;
		        });
            //-->
					  </script>
					</div>	
				  <div class="caleft">
					  <div class="wendali">
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
							$keyword = isset($_GET['keyword']) && $_GET['keyword'] ? " AND `q` LIKE '%".addslashes($_GET['keyword'])."%'  " : null;
							$type = isset($_GET['t']) && $_GET['t'] ? " AND `type` = '".intval($_GET['t'])."'  " : null;
              $currentPage = isset($_POST['page']) && intval($_POST['page']) > 0 ? intval($_POST['page']) : 1;
              
              $allQAs = new Query("*", "`wenda`", "", "`mod`='wenda' AND `status` = 'ok'" . $keyword . $type . $mSql, "`id` DESC");
              $allQAs = DAS::quickQuery($allQAs, 'RC', 10, $currentPage);
              $allQAs = DAS::hasData($allQAs) ? $allQAs : false;
						  if($allQAs){
                $_page = new Page($allQAs['NUM_DATA'], $allQAs['NUM_PER_PAGE']); 
                $count = count($allQAs['data']);
                for($i=0;$i<$count;$i++){
                  echo "\n";
              ?>
                <li>
								  <div class="info"><?php echo date("Y-m-d H:i",$allQAs['data'][$i]["time"]);?> 周<?php echo $week[date("w",$allQAs['data'][$i]["time"])];?>  <!--发布人：<?php echo $allQAs['data'][$i]["name"];?>--></div>
								  <div class="tit" ><a href="">Q：<?=$allQAs['data'][$i]["q"]?></a></div>
									<div class="jj">
									  <div class="jj1">A：</div>
										<div class="jj2">
									    <span><?php echo str_replace("\n","<br>",$allQAs['data'][$i]["a"])?></span>
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
				    <form action="" method="post" >
						  <div class="wssbk">
							  <div class="ss1">
                  <input type="text" name="keyword" value="<?php echo $_POST['keyword'];?>">
                </div>
							  <div class="ss2"><input type="image" src="images/sert2.png"></div>
					    </div>   
					  </form>
				    <div class="wbstit">按日期</div>
					  <div class="lbk0"><a href="">2018年</a></div>
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
				    <div class="wbstit">按分类</div>
					  <div class="lbk3"><a href="?t=0">全部</a></div>
					  <div class="lbk3"><a href="?t=1">一站式整体装修</a></div>
					  <div class="lbk3"><a href="?t=2">品牌评测</a></div>
					  <div class="lbk3"><a href="?t=3">施工注意</a></div>
					  <div class="lbk3"><a href="?t=4">设计风格</a></div>
					  <div class="lbk3"><a href="?t=5">装修需知</a></div>
				  </div>
				  <div class="clear"></div>
			  </div>
	    </div>	
	  </div>		
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>
</html>
<script language="javascript" type="text/javascript">
<!--//
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"hover":"";
  con.style.display=i==cursel?"block":"none";
}
}

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

		var text = $span.text();
		if (text) {
			$span.text(text.substring(0,89)+"...");

			$btnShow.click(function(){
				$btnShow.hide();
				$btnHide.show();
				$span.text(text);
			});
			$btnHide.click(function(){
				$btnHide.hide();
				$btnShow.show();
				$span.text(text.substring(0,89)+"...");
			});
		}

	});
})
//-->
</script>
<?php require_once('bottom.inc');?>