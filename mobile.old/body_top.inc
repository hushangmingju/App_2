<!--页头-->
		<div id="GEO_LOCATION" style="display:none;"></div>
    <header>
			<div class="logo"><a href="index.html"><img src="images/logo.png"/></a></div>
			<div class="btn btn-right">
				<a href="javascript:;" class="icon icon-menu open-menu"></a>
				<a href="javascript:;" class="icon icon-close close-menu" style="display: none;"></a>
				<div class="menu">
					<div class="search">
						<form action="arclist.html" method="post" id="search">
							<input type="text" name="keyword" value="<?php echo isset($_POST["keyword"]) && $_POST["keyword"] ? $_POST["keyword"] : null;?>" placeholder="搜点什么..." />
							<a onclick="$('#search').submit()" class="icon icon-search"></a>
						</form>
					</div>
					<div class="nav">
						<ul id="main_navi">
							<li><a href="index.html">首页</a></li>
							<li><a href="jg60.html">家装6.0</a></li>
							<li><a href="yizhan.html">一站式整体装修</a></li>
							<li><a href="yangban.html">实景体验</a></li>
							<li><a href="promotions.html">优惠活动</a></li>
							<li><a href="hezuo.html">合作供应商</a></li>
							<li><a href="about.html">关于沪尚</a></li>
							<li><a href="brand.html">品牌历史</a></li>
							<li><a href="jobs.html">诚聘英才</a></li>
							<li><a href="contact.html">联系我们</a></li>
						</ul>
					</div>
					<div class="btns">
						<a href="tencent://message/?uin=<?=$userXqq?>&Site=QQ交谈&Menu=yes" target="blank"><img src="images/icon/icon-headset.png" /></a>
						<a href="yuyue.html"><img src="images/icon/icon-message.png" /></a>
						<a href="javascript:;" class="js-kai"><img src="images/icon/icon-compute.png" /></a>
						<a href="javascript:;" class="qrcode-kai"><img src="images/icon/icon-qrcode.png" /></a>
					</div>
				</div>
			</div>
		</header>
    <script language="javascript" type="text/javascript">
    <!--//
          var mainNavi = document.getElementById("main_navi").childNodes;
          // 0: index, 1: jg60, 2: yizhan, 3: yangban, 4: hezuo, 5: about, 6: brand, 7: contact, 8: promotions
          var pageIndex = ["index", "jg60", "yizhan", "yangban", "hezuo", "about", "brand", "contact", "promotions"];
          var pageSelf = window.location.href;
          var hostName = "http://<?php echo $_SERVER['HTTP_HOST'];?>/mobile/";
          var hostLength = hostName.length;
          pageSelf = pageSelf.substr(hostLength);
          pageSelf = pageSelf.substr(0, pageSelf.indexOf("."));
          pageSelf = pageSelf == "" ? "index" : pageSelf;
          for(var i = 0; i < mainNavi.length; i++){
            var tempLi = mainNavi[i];
            if(tempLi.tagName == "LI"){
              var tempA = tempLi.childNodes;
              for(var j = 0; j < tempA.length; j++){                
                if(tempA[j].tagName == "A" && tempA[j].href.indexOf(pageSelf) > -1){
                  tempLi.className = "active";
                  break;
                }
              }
            }
          }
          //-->
          </script>