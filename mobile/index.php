<?php
require_once('top.inc');
$region = '';
if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
    $region = VCS::getRegionByIP();
}
?>  
    <section style="text-align:center;">
      <div style="width:100%">
        <div class="banner" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			  <div class="swiper-slide">
		      <?php
              if (strpos($region['prov'], '福建') !== false) {
              ?>
                <a href="zz.html"><img class="topImg" src="img/index/bannerzz_01.jpg" class="img-full"></a>
              <?php
              }
              else {
              ?>
                <a href="promotions.html"><img class="topImg" src="img/index/banner26.jpg" class="img-full"></a>
              <?php
              }
              ?>
			  </div>
			  <div class="swiper-slide">
				<a href="jz60.html"><img class="topImg" src="img/index/banner01.jpg" class="img-full"></a>
			  </div>
			  <div class="swiper-slide">
				<a href="anli.html"><img class="topImg" src="img/index/banner02.jpg" class="img-full"></a>
			  </div>
			  <div class="swiper-slide">
				<a href="styles.html"><img class="topImg" src="img/index/banner03a.jpg" class="img-full"></a>
			  </div>
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var mySwiper = new Swiper ('.banner .swiper-container', {
	  pagination: '.pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <section>
      <div style="width:100%; text-align:center;">
        <a href="jz60.html"><img src="img/index/jz60_button.jpg" alt="" style="width:23%;"></a>
        <a href="styles.html"><img src="img/index/shijing_button.jpg" alt="" style="width:23%;"></a>
        <a href="gongdi.html"><img src="img/index/gongdi_button.jpg" alt="" style="width:23%;"></a>
        <a href="about.html"><img src="img/index/about_button.jpg" alt="" style="width:23%;"></a>
      </div>
    </section>
    <section>
      <div style="width:100%; background-color:#FAFAFA; margin-top:28px; padding:12px 4px 12px 24px; overflow:hidden; height:48px;">
        <span style="width:28%; font-size:18px; font-weight:bold;">装修头条</span>
        <div id="swap" style="width:64%; font-size:12px; color:#808080; margin-left:16px; margin-top:-3px; display:inline-block; position:relative; height:16px; bottom:2px;">沪尚茗居整体家装开创家装6.0新体验！</div>
        <!--<span style="width:8%; float:right;">
          <img src="img/index/next_button.jpg" style="width:100%; max-width:36px;">
        </span>-->
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
    var news = ["沪尚茗居整体家装开创家装6.0新体验！", "沪尚茗居三年庆，海量豪礼1元购！"];
    function swapNews(){
      $("#swap").animate({bottom: "48px"}, "slow", "", function(){changeText(); });
      
      function changeText(){
        $("#swap").css({bottom:"-22px"});
        var currentNews = $("#swap").text();
        var nextNews = "";
        for(var i = 0; i < news.length; i++){
          if (news[i] == currentNews) {
            if (i < (news.length - 1)) {
              nextNews = news[i + 1];
            }
            else {
              nextNews = news[0];
            }
          }
        }
        $("#swap").text(nextNews);      
        $("#swap").animate({bottom: "2px"}, "slow");
      }
      
      setTimeout(swapNews, 3000);
    }
    //-->
    </script>
    <section style="text-align:center;">
      <div class="orderBox" style="background-color:#ffffff; width:90%; text-align:center; display:inline-block;">
        <div class="order">
          <div style="width:100%; display:block; font-size:18px; font-weight:bold; text-align:center; padding-top:14px;">
            预约免费设计咨询
          </div>
          <form>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="mobile/index_yuyue_01"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <p class="phone" style="margin-top:18px;">
              <label for="mobile1"><img src="img/icons/phone.png"></label>
              <input type="tel" name="tel" value="" placeholder="请输入手机号">
            </p>
            <p style="padding-top:18px;">
              <button id="MOBILE_INDEX_YUYUE_01_bUTTON" style="background-color:#fe4b5b; border-radius:5px;">
                <span>立即申请</span>
              </button>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          $(document).ready(function(e) {
            swapNews();
            $("#MOBILE_INDEX_YUYUE_01_bUTTON").click(function(e) {
              var tel = $(this).parent().prev().find("input").val();
              var form = $(this).parent().parent();
              if(!tel.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)) {
                alert("手机号码格式不正确！");
                return false;
              }
              $.ajax({
		        type: "POST",
		        url: "dml_svr.php",
		        data: form.serializeArray(),
		        dataType: "json",                
		        success: function(data) { 
                    alert(data.TEXT);
		        },
		        error: function(data) { 
			        alert("信息提交成功！");
		        },
	          });
	          return false;
            });
          });
          //-->
          </script>
        </div>
      </div>
    </section>
    <section style="text-align:center; padding-top:24px;">
      <div style="width:91%; display:inline-block;">
        <a href="jz60.html"><img src="img/index/jz60_pic.jpg" alt="" style="width:100%;"></a>
      </div>
    </section>
    <section style="text-align:center; padding-top:24px;">
      <div style="width:100%; display:inline-block;">
        <img src="img/index/stv_pinpai_pic01.jpg" alt="" style="width:100%;">
      </div>
    </section>
    <section style="text-align:center; padding-top:24px;">
      <h3>热卖爆款套餐</h3>
      <div style="width:91%; display:inline-block; margin-top:18px;">
        <a href="packages.html?i=001"><img src="img/index/style_meishi_pic.jpg" alt="" style="width:100%;"></a>
      </div>
      <div style="width:91%; display:inline-block; margin-top:30px;">
        <a href="packages.html?i=002"><img src="img/index/style_oushi_pic.jpg" alt="" style="width:100%;"></a>
      </div>
    </section>
    <section style="text-align:center;">
      <div style="width:91%; margin-top:28px; display:inline-block; text-align:left;">
        <span style="width:84%; font-size:18px; font-weight:bold;">茗居真实案例</span>
        <span style="width:16%; float:right; margin-top:3px;">
          <a href="anli.html"><img src="img/index/more_button.jpg" style="width:100%; max-width:80px;"></a>
        </span>
      </div>
    </section>
    <?php
    $anlisContents = new Query("*", "`tb_wcp_contents`", "", "`pageFile` LIKE 'mobile/anli%'");
    $anlisContents = DAS::quickQuery($anlisContents);
    $anlisImages = new Query("*", "`tb_wcp_images`", "", "`pageID` IN (78,79,80,82,83) AND `component` LIKE '%_banner'", "`pageID`");
    $anlisImages = DAS::quickQuery($anlisImages);
    if(DAS::hasData($anlisImages)){
        for ($i = 0; $i < count($anlisImages['data']); $i++) {
            for ($j = 0; $j < count($anlisContents['data']); $j++) {
                if ($anlisImages['data'][$i]['pageID'] == $anlisContents['data'][$j]['pageID']) {
                    $anlisImages['data'][$i]['text'][$anlisContents['data'][$j]['component']] = $anlisContents['data'][$j]['contentChar'];
                    $anlisImages['data'][$i]['pageFile'] = $anlisContents['data'][$j]['pageFile'];
                }
            }
        }
    ?>
    <section style="text-align:center; padding-top:5px;">
      <div style="width:91%; display:inline-block; margin-top:0px;"> 
        <a href="http://www.mingjugroup.com/<?php echo isset($anlisImages['data'][0]['pageFile']) ? $anlisImages['data'][0]['pageFile'] : '';?>"><img src="<?php echo $anlisImages['data'][0]['folderName'] . '/' . $anlisImages['data'][0]['fileName'];?>" alt="" style="width:100%;"></a>  
        <div style="position:relative; margin-top:-28px; color:#FFFFFF; font-size:12px; font-weight:bold; text-align:left; margin-left:14px;">
          <?php echo isset($anlisImages['data'][0]['text']['maintitle']) ? rawurldecode($anlisImages['data'][0]['text']['maintitle']) : '';?>
        </div>     
        <div style="position:relative; margin-top:-40px; color:#FFFFFF; font-size:14px; font-weight:bold; text-align:left; margin-left:14px;">
          <?php echo isset($anlisImages['data'][0]['text']['subtitle']) ? rawurldecode($anlisImages['data'][0]['text']['subtitle']) : '';?>
        </div>
      </div>
      <div style="width:91%; display:inline-block; margin-top:48px; text-align:left;">
        <div style="width:48%; float:left; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($anlisImages['data'][1]['pageFile']) ? $anlisImages['data'][1]['pageFile'] : '';?>"><img src="<?php echo $anlisImages['data'][1]['folderName'] . '/' . $anlisImages['data'][1]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
        <div style="width:48%; float:right; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($anlisImages['data'][2]['pageFile']) ? $anlisImages['data'][2]['pageFile'] : '';?>"><img src="<?php echo $anlisImages['data'][2]['folderName'] . '/' . $anlisImages['data'][2]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; font-weight:bold;">
          <span><?php echo isset($anlisImages['data'][1]['text']['maintitle']) ? rawurldecode($anlisImages['data'][1]['text']['maintitle']) : '';?></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; font-weight:bold;">
          <span><?php echo isset($anlisImages['data'][2]['text']['maintitle']) ? rawurldecode($anlisImages['data'][2]['text']['maintitle']) : '';?></span>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; color:#808080;">
          <span><?php echo isset($anlisImages['data'][1]['text']['subtitle']) ? rawurldecode($anlisImages['data'][1]['text']['subtitle']) : '';?></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; color:#808080;">
          <span><?php echo isset($anlisImages['data'][2]['text']['subtitle']) ? rawurldecode($anlisImages['data'][2]['text']['subtitle']) : '';?></span>
        </div>
      </div>
      <div style="width:91%; display:inline-block; margin-top:12px; text-align:left;">
        <div style="width:48%; float:left; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($anlisImages['data'][3]['pageFile']) ? $anlisImages['data'][3]['pageFile'] : '';?>"><img src="<?php echo $anlisImages['data'][3]['folderName'] . '/' . $anlisImages['data'][3]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
        <div style="width:48%; float:right; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($anlisImages['data'][4]['pageFile']) ? $anlisImages['data'][4]['pageFile'] : '';?>"><img src="<?php echo $anlisImages['data'][4]['folderName'] . '/' . $anlisImages['data'][4]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; font-weight:bold;">
          <span><?php echo isset($anlisImages['data'][3]['text']['maintitle']) ? rawurldecode($anlisImages['data'][3]['text']['maintitle']) : '';?></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; font-weight:bold;">
          <span><?php echo isset($anlisImages['data'][4]['text']['maintitle']) ? rawurldecode($anlisImages['data'][4]['text']['maintitle']) : '';?></span>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; color:#808080;">
          <span><?php echo isset($anlisImages['data'][3]['text']['subtitle']) ? rawurldecode($anlisImages['data'][3]['text']['subtitle']) : '';?></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; color:#808080;">
          <span><?php echo isset($anlisImages['data'][4]['text']['subtitle']) ? rawurldecode($anlisImages['data'][4]['text']['subtitle']) : '';?></span>
        </div>
      </div>
    </section>
    <?php
    }
    ?>
    <!--
    <section style="text-align:center; padding-top:5px;">      
      <div style="width:91%; display:inline-block; margin-top:0px;"> 
        <a href="anli.html?aid=2"><img src="img/anli/anli_pic01.jpg" alt="" style="width:100%;"></a>  
        <div style="position:relative; margin-top:-28px; color:#FFFFFF; font-size:12px; font-weight:bold; text-align:left; margin-left:14px;">
          现代 时尚本真 85m<sup>2</sup>
        </div>     
        <div style="position:relative; margin-top:-40px; color:#FFFFFF; font-size:14px; font-weight:bold; text-align:left; margin-left:14px;">
          现代简约风格，简约却不失格调！
        </div>
      </div>
      <div style="width:91%; display:inline-block; margin-top:48px; text-align:left;">
        <div style="width:48%; float:left; display:inline-block;">
          <a href="anli.html?aid=2"><img src="img/anli/anli_pic02.jpg" alt="" style="width:100%;"></a>
        </div>
        <div style="width:48%; float:right; display:inline-block;">
          <a href="anli.html?aid=3"><img src="img/anli/anli_pic03.jpg" alt="" style="width:100%;"></a>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; font-weight:bold;">
          <span>一辈子对家人的爱和牵挂足够长沪尚茗居为爱保驾护航！</span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; font-weight:bold;">
          <span>用感性与生活对话，70岁老人的文艺空间。</span>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block; font-size:12px; color:#808080;">
          <span>欧式 怡然风尚 72m<sup>2</sup></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; font-size:12px; color:#808080;">
          <span>美式 荣耀经典 80m<sup>2</sup></span>
        </div>
      </div>
    </section> -->  
    <?php
    $zixunsContents = new Query("*", "`tb_wcp_contents`", "", "`pageFile` LIKE 'mobile/zixun%'");
    $zixunsContents = DAS::quickQuery($zixunsContents);
    $zixunsImages = new Query("*", "`tb_wcp_images`", "", "`pageID` IN (76,77) AND `component` LIKE '%_banner'", "`pageID`");
    $zixunsImages = DAS::quickQuery($zixunsImages);
    if(DAS::hasData($zixunsImages)){
        for ($i = 0; $i < count($zixunsImages['data']); $i++) {
            for ($j = 0; $j < count($zixunsContents['data']); $j++) {
                if ($zixunsImages['data'][$i]['pageID'] == $zixunsContents['data'][$j]['pageID']) {
                    $zixunsImages['data'][$i]['text'][$zixunsContents['data'][$j]['component']] = $zixunsContents['data'][$j]['contentChar'];
                    $zixunsImages['data'][$i]['pageFile'] = $zixunsContents['data'][$j]['pageFile'];
                }
            }
        }
    ?>
    <section style="text-align:center;">
      <div style="width:91%; margin-top:28px; display:inline-block; text-align:left;">
        <span style="font-size:18px; font-weight:bold;">企业资讯</span>
      </div>
    </section>
    <section style="text-align:center; padding-top:5px;">
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($zixunsImages['data'][0]['pageFile']) ? $zixunsImages['data'][0]['pageFile'] : '';?>"><img src="<?php echo $zixunsImages['data'][0]['folderName'] . '/' . $zixunsImages['data'][0]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
        <div style="width:48%; float:right; display:inline-block;">
          <a href="http://www.mingjugroup.com/<?php echo isset($zixunsImages['data'][1]['pageFile']) ? $zixunsImages['data'][1]['pageFile'] : '';?>"><img src="<?php echo $zixunsImages['data'][1]['folderName'] . '/' . $zixunsImages['data'][1]['fileName'];?>" alt="" style="width:100%;"></a>
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left; margin-top:-14px;">
        <div style="width:48%; float:left; display:inline-block; background-color:#FAFAFA; padding-left:5px; padding-top:12px; padding-bottom:8px;">
          <span style="display:block; font-size:16px; font-weight:bold;"><?php echo isset($zixunsImages['data'][0]['text']['maintitle']) ? rawurldecode($zixunsImages['data'][0]['text']['maintitle']) : '';?></span>
          <span style="display:block; font-size:13px;"><?php echo isset($zixunsImages['data'][0]['text']['subtitle']) ? rawurldecode($zixunsImages['data'][0]['text']['subtitle']) : '';?></span>
        </div>
        <div style="width:48%; float:right; display:inline-block; background-color:#FAFAFA; padding-left:5px; padding-top:12px; padding-bottom:8px;">
          <span style="display:block; font-size:16px; font-weight:bold;"><?php echo isset($zixunsImages['data'][1]['text']['maintitle']) ? rawurldecode($zixunsImages['data'][1]['text']['maintitle']) : '';?></span>
          <span style="display:block; font-size:13px;"><?php echo isset($zixunsImages['data'][1]['text']['subtitle']) ? rawurldecode($zixunsImages['data'][1]['text']['subtitle']) : '';?></span>
        </div>
      </div>
    </section>  
    <?php
    }
    ?> 
    <!--
    <section style="text-align:center;">
      <div style="width:91%; margin-top:28px; display:inline-block; text-align:left;">
        <span style="font-size:18px; font-weight:bold;">企业资讯</span>
      </div>
    </section>
    <section style="text-align:center; padding-top:5px;">
      <div style="width:91%; display:inline-block; text-align:left;">
        <div style="width:48%; float:left; display:inline-block;">
          <img src="img/index/zixun_pic_01.jpg" alt="" style="width:100%;">
        </div>
        <div style="width:48%; float:right; display:inline-block;">
          <img src="img/index/zixun_pic_02.jpg" alt="" style="width:100%;">
        </div>
      </div>
      <div style="width:91%; display:inline-block; text-align:left; margin-top:-14px;">
        <div style="width:48%; float:left; display:inline-block; background-color:#FAFAFA; padding-left:5px; padding-top:12px; padding-bottom:8px;">
          <span style="display:block; font-size:16px; font-weight:bold;">自有白皮书</span>
          <span style="display:block; font-size:13px;">108项标准施工工艺</span>
        </div>
        <div style="width:48%; float:right; display:inline-block; background-color:#FAFAFA; padding-left:5px; padding-top:12px; padding-bottom:8px;">
          <span style="display:block; font-size:16px; font-weight:bold;">上海电视台</span>
          <span style="display:block; font-size:13px;">权威媒体推荐品牌</span>
        </div>
      </div>
    </section>--> 
    <section style="text-align:center;">
      <div style="width:91%; margin-top:28px; display:inline-block; text-align:left;">
        <span style="font-size:18px; font-weight:bold;">服务流程</span>
      </div>
    </section>
    <section>
      <div style="width:100%; text-align:center; padding-top:20px;">
        <img src="img/index/liucheng_pic.jpg" alt="" style="width:100%;">
      </div>
    </section>
<?php
require_once('bottom.inc');
?>