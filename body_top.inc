    <div id="GEO_LOCATION" style="display:none;"></div>
    <div class="header container-full">
			<div class="top container">
				<div class="col-6">
					<div class="logo"><img src="images/logo.png"/></div>
				</div>
				<div class="col-6">
					<div class="icons">
						<!--<a href="tencent://message/?uin=<?=$userXqq?>&Site=QQ交谈&Menu=yes" target="blank"><img src="images/icon-headset.png"/></a>-->
            <a href="javascript:;" onclick="max_from_company_mini(this);"><img src="images/icon-headset.png"/></a>
            <a href="yuyue.php"><img src="images/icon-message.png"/></a>
						<a href="javascript:;" class="js-kai"><img src="images/icon-compute.png"/></a>
						<a href="javascript:;"><img src="images/icon-qrcode.png"/><span class="scancode transition"><img src="images/scancode.png"/></span></a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="nav container-full">
				<div class="container">
					<ul id="main_navi" class="col-10">
						<li><a href="index.php" class="transition">首页</a></li>
						<!--<li><a href="3D.php" class="transition">3D全景</a></li>-->
						<li>
							<a href="yangban.php" class="transition">实景体验</a>
							<div class="sub-nav top2 transition">
								<div class="container">
									<ul>
										<li><a href="yangban.php?style=现代简约"><img src="images/style_1a.jpg"/><span class="mask transition"></span></a></li>
										<li><a href="yangban.php?style=美式风格"><img src="images/style_2a.jpg"/><span class="mask transition"></span></a></li>
										<li><a href="yangban.php?style=欧式风格"><img src="images/style_3a.jpg"/><span class="mask transition"></span></a></li>
										<li><a href="yangban.php?style=中式风格"><img src="images/style_4a.jpg"/><span class="mask transition"></span></a></li>
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="recommend.php" class="transition">业主推荐</a>
							<div class="sub-nav transition">
								<div class="container-full" >
									<div class="TxtBox5">
										<div class="hdd">
											<ul>
												 <li onclick="javascript:window.location.href='recommend.php'">业主推荐</li>
												 <li onclick="javascript:window.location.href='yuyue.php'">快速预约</li>
											 </ul>
										</div>

									</div>
								</div>
							</div>
						</li>						
						<li>
                            <a href="promotions.php" class="transition">优惠活动</a>
                        </li>						
						<li>
						  <a href="caigou.php" class="transition">装修知识</a>
							<div class="sub-nav transition">
								<div class="container-full" >
									<div class="TxtBox4">
										<div class="hdd">
											<ul>
												 <li onclick="javascript:window.location.href='caigou.php'">家装战略</li>
												 <li onclick="javascript:window.location.href='wenda.php'">装修问答</li>
												 <li onclick="javascript:window.location.href='jg60.php'">整体家装</li>
											     <li onclick="javascript:window.location.href='liucheng.php'" style="width:140px">一站式精装呈现</li>
											  	 <li onclick="javascript:window.location.href='gongzhuang.php'">整体工艺</li>
											 </ul>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li>
						  <a href="about.php" class="transition">关于茗居</a>
							<div class="sub-nav transition">
								<div class="container-full" >
									<div class="TxtBox3">
										<div class="hdd">
											<ul>
												<li onclick="javascript:window.location.href='brand.php'">品牌故事</li>
												<li onclick="javascript:window.location.href='history.php'">发展历程</li>
												<li onclick="javascript:window.location.href='arclist.php'">相关新闻</li>
											  <li onclick="javascript:window.location.href='contact.php'">联系我们</li>
											  <li onclick="javascript:window.location.href='jobs.php'">招聘信息</li>
											</ul>
										</div>
									</div>
								</div>
							</div>						
						</li>
                        <li><a href="jobs.php" class="transition">诚聘英才</a></li>
					</ul>
          <script language="javascript" type="text/javascript">
          <!--//
          var mainNavi = document.getElementById("main_navi").childNodes;
          // 0: index, 1: 3D, 2: yangban, 3: recommend, 4: promotions, 5: caigou, 6: about
          var pageIndex = ["index", "3D", "yangban", "recommend", "promotions", "caigou", "about", "jobs"];
          var allPageIndex = ["index", "3D", "yangban", "recommend,yuyue", "promotions,zz", "caigou,wenda,jg60,liucheng,gongzhuang", "about,brand,history,arclist,contact,jobs,xinwen,xinwen-list", "jobs"];
          var pageSelf = window.location.href;
          var hostName = "http://<?php echo $_SERVER['HTTP_HOST'];?>/";
          var hostLength = hostName.length;
          pageSelf = pageSelf.substr(hostLength);
          pageSelf = pageSelf.substr(0, pageSelf.indexOf(".php"));
          pageSelf = pageSelf == "" ? "index" : pageSelf;
          var activedPage = "index";
          for(var i = 0; i < allPageIndex.length; i++){
            if(allPageIndex[i].indexOf(pageSelf) > -1){
              activedPage = pageIndex[i];
            }
          }
          for(var i = 0; i < mainNavi.length; i++){
            var tempLi = mainNavi[i];
            if(tempLi.tagName == "LI"){
              var tempA = tempLi.childNodes;
              for(var j = 0; j < tempA.length; j++){                
                if(tempA[j].tagName == "A" && tempA[j].href.indexOf(activedPage) > -1){
                  tempLi.className = "active";
                  break;
                }
              }
            }
          }
          //-->
          </script>
					<div class="col-2 search">
            <form action="xinwen-list.php" method="post" id="search">
						  <a onclick="document.getElementById('search').submit()"></a>
						  <div class="search-input">
                <input type="text" name="keyword" id="" value="" class="transition" />
              </div>
						</form>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	
