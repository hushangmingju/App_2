<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a8c7183d35d8da846fc1c6f86640fd81";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>

	<script src="../mobile/js/jquery-2.1.4.min.js"></script>
	<script src="../mobile/js/site.js" ></script>

		<!--页头-->
		<header>
			<div class="logo"><a href="index.html"><img src="../mobile/images/logo.png"/></a></div>
			<div class="btn btn-right">
				<a href="javascript:;" class="icon icon-menu open-menu"></a>
				<a href="javascript:;" class="icon icon-close close-menu" style="display: none;"></a>
				<div class="menu">
					<div class="search">
						<form action="../mobile/arclist.html" method="post" id="search">
							<input type="text" name="keyword" value="<?=_POST("keyword")?>" placeholder="搜点什么..." />
							<a onclick="$('#search').submit()" class="icon icon-search"></a>
						</form>
					</div>
					<div class="nav">
						<ul>
							<li <?php if($nav==1){echo " class=\"active\"";} ?>><a href="../mobile/index.html">首页</a></li>
							<li <?php if($nav==2){echo " class=\"active\"";} ?>><a href="../mobile/jg60.html">家装6.0</a></li>
							<li <?php if($nav==3){echo " class=\"active\"";} ?>><a href="../mobile/yizhan.html">一站式整体装修</a></li>
							<li <?php if($nav==4){echo " class=\"active\"";} ?>><a href="../mobile/yangban.html">实景体验</a></li>
							<li <?php if($nav==10){echo " class=\"active\"";} ?>><a href="../mobile/promotions.html">优惠活动</a></li>
							<li <?php if($nav==5){echo " class=\"active\"";} ?>><a href="../mobile/hezuo.html">合作供应商</a></li>
							<li <?php if($nav==6){echo " class=\"active\"";} ?>><a href="../mobile/about.html">关于沪尚</a></li>
							<li <?php if($nav==7){echo " class=\"active\"";} ?>><a href="../mobile/brand.html">品牌历史</a></li>
							<li <?php if($nav==8){echo " class=\"active\"";} ?>><a href="../mobile/contact.html">联系我们</a></li>
						</ul>
					</div>
					<div class="btns">
						<a href="tencent://message/?uin=<?=$userXqq?>&Site=QQ交谈&Menu=yes" target="blank"><img src="../mobile/images/icon/icon-headset.png" /></a>
						<a href="yuyue.html"><img src="../mobile/images/icon/icon-message.png" /></a>
						<a href="javascript:;" class="js-kai"><img src="../mobile/images/icon/icon-compute.png" /></a>
						<a href="javascript:;" class="qrcode-kai"><img src="../mobile/images/icon/icon-qrcode.png" /></a>
					</div>
				</div>
			</div>
		</header>