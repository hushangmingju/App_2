<?php
require_once('init.inc');
require_once('../../ext/vcs.inc');
VCS::start(); 
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>沪尚茗居 —— 整体家装体验馆</title> 
    <link rel="stylesheet" type="text/css" href="../../css/swiper.4.4.2.css"/>
    <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="../../js/swiper.4.4.2.js"></script>  
    <script type="text/javascript" src="../../js/agui.js"></script>  
    <script type="text/javascript" src="../../js/vcs.js"></script>      
    <style>
    img{
      margin:0px;
      padding:0px;
      border:none;
      -webkit-box-sizing:border-box;
      -moz-box-sizing:border-box;
      box-sizing:border-box;
      vertical-align: middle;
      max-width: 100%;
    }
    li{
      cursor:pointer;
    }
    button{
      cursor:pointer;
    }
    button:hover{
      box-shadow:2px 2px 10px #888888;        
    }
    .botton1{
      box-shadow:3px 3px 5px #888888;  
    }
    .button1:hover{
      box-shadow:6px 6px 10px #888888;  
    }
    </style>
  </head>
  <body style="margin:0px; padding:0px; background-color:#fafafa; min-width:1200px;">
    <!-- banner图-->
    <section style="padding:0px; margin:0px;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_01m.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>    
    <!-- 表单栏1 -->
    <section style="padding:0px; margin:0px; min-width:1200px;">
      <div style="display:block; height:112px; background-color:#f6d4cb; width:100%; text-align:center; margin-top:-5px; min-width:1200px;">
        <div style="display:inline-block; margin:0px;">
          <div style="font-size:32px; color:#ba1a26; font-weight:bold; display:table-cell; vertical-align:middle; height:112px; width:180px;">免费索票</div>
        </div>
        <div style="display:inline-block;">
          <div style="font-size:40px; color:#ba1a26; font-weight:bold; display:table-cell; vertical-align:middle; height:112px;">
            <div style="display:inline-block;">
              <form>
                <input type="hidden" name="type" value="yuyue"/>
                <input type="hidden" name="bultin" value="zt/pc/index_yuyue_01"/>
                <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
                <input type="text" name="name" placeholder="请填写您的姓名" style="width:380px; height:40px; border:2px solid #ba1a26; border-radius:15px; padding-left:16px; margin-top:-10px; font-size:16px;"/>
                <input type="tel" name="tel" placeholder="请填写手机号" style="width:380px; height:40px; border:2px solid #ba1a26; border-radius:15px; padding-left:16px; margin-top:-10px; font-size:16px; margin-left:10px;"/>
              </form>
            </div>            
            <button type="button" class="submit" style="background-color:#ba1a26; color:#FFFFFF; font-size:22px; border-radius:18px; border:none; font-weight:bold; padding:8px 24px 8px 24px; margin-left:10px; cursor:pointer;">立即报名</button>
          </div>
        </div>
      </div>
    </section>   
    <!-- 图片1-->
    <section style=" padding:0px; margin:0px;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_03c.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>   
    <!-- 图片2-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_04d.jpg" style="width:100%;"/>
      </div>
    </section>   
    <!-- 图片3-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_05d.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 弹框按钮1-->
    <section style="width:100%; text-align:center; margin-top:20px;">
      <div style="width:100%; min-width:1200px; display:inline-block; text-align:center; height:96px; margin-bottom:20px;">
        <img onClick="dialogReserve.show();" src="images/button1.gif" style="cursor:pointer;" />
      </div>
    </section>  
    <!-- 图片4-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_07a.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>   
    <!-- 图片5-->
    <section style="text-align:center;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_08a.jpg" style="width:100%;"/>
      </div>
    </section>    
    <!-- 轮拨图-->
    <section style="text-align:center;">
      <div style="width:100%; max-width:1200px; display:inline-block;">
        <div style="width:100%; display:inline-block; margin:0px; padding:0px;">
          <ul class="style_navigator" style="margin:0px; padding:0px;">
            <li onClick="mySwiper.slideTo(1);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A;">北欧</li>
            <li onClick="mySwiper.slideTo(2);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A; margin-left:4px;">现代</li>
            <li onClick="mySwiper.slideTo(3);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A; margin-left:4px;">简约</li>
            <li onClick="mySwiper.slideTo(4);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A; margin-left:4px;">美式</li>
            <li onClick="mySwiper.slideTo(5);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A; margin-left:4px;">混搭</li>
            <li onClick="mySwiper.slideTo(6);" style="display:inline-block; width:15.5%; border-bottom:6px solid #e40112; padding:8px 0px 8px 0px; font-size:36px; color:#4A4A4A; margin-left:4px;">日式</li>
          </ul>
        </div>
      </div>
      <div class="swiper-container" style="margin-top:40px;">
		<div class="swiper-wrapper">
          <div class="swiper-slide">
			<img src="images/style_01.jpg" class="img-full">
		  </div>
          <div class="swiper-slide">
			<img src="images/style_02.jpg" class="img-full">
		  </div>
          <div class="swiper-slide">
			<img src="images/style_03.jpg" class="img-full">
		  </div>
          <div class="swiper-slide">
			<img src="images/style_04.jpg" class="img-full">
		  </div>
          <div class="swiper-slide">
			<img src="images/style_05.jpg" class="img-full">
		  </div>
          <div class="swiper-slide">
			<img src="images/style_06.jpg" class="img-full">
		  </div>
        </div>
        <div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
      </div>
    </section>  
    <!-- 图片6-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_09a.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 弹框按钮2-->
    <section style="width:100%; text-align:center; margin-top:10px;">
      <div style="width:100%; min-width:1200px; display:inline-block; text-align:center; height:96px; margin-bottom:32px;">
        <img onClick="dialogReserve.show();" src="images/button2.gif" style="cursor:pointer;" />
      </div>
    </section>   
    <!-- 图片7-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_10a.jpg" style="width:100%;"/>
      </div>
    </section>   
    <!-- 图片8-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_11a.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 弹框按钮3-->
    <section style="width:100%; text-align:center; margin-top:10px;">
      <div style="width:100%; min-width:1200px; display:inline-block; text-align:center; height:96px; margin-bottom:32px;">
        <img onClick="dialogReserve.show();" src="images/button2.gif" style="cursor:pointer;" />
      </div>
    </section>  
    <!-- 图片9-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_12d.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 图片12-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img onClick="dialogReserve.show();" src="images/pc_13d.jpg" style="width:100%; cursor:pointer;"/>
      </div>
    </section>    
    <!-- 表单栏2-->
    <section style="text-align:center;">
      <div style="width:1200px; display:inline-block; text-align:center;">
        <div style="display:inline-block;">
          <div style="display:table-cell; vertical-align:central; font-size:28px; color:#000000;">
            <div style="display:inline-block;">
            <form>
              <input type="hidden" name="type" value="yuyue"/>
              <input type="hidden" name="bultin" value="zt/pc/index_yuyue_02"/>
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
              填写手机号码即可获取线路短信：
              <input type="tel" name="tel" style="width:280px; height:32px; display:inline-block; top:-3px; position:relative;"/>
            </form>
            </div>
            <button type="button" class="submit" style="border:none; height:40px; padding:5px 16px 5px 16px; font-size:20px; color:#FFFFFF; background-color:#e70012; display:inline-block; margin-left:8px;">确认发送</button>
          </div>
        </div>
      </div>
    </section>    
    <!-- 底部留白-->
    <section style="height:120px;">
    </section>
    <!-- 底部悬浮栏-->
    <section style="position:fixed; bottom:0px; left:-5%; top:auto; padding:0px; margin:0px; text-align:center; width:110%; display:block; height:100px; z-index:100; display:none;">
      <div style="width:100%; display:inline-block; background-image:url(images/background_transparent.png); background-repeat:repeat; height:100px; margin:0px; min-width:1200px; padding:0px; border-radius:48px;"> 
        <div style="display:inline-block; width:500px; height:100px; margin:0px; text-align:left;">
          <img src="images/bottombar_img.png" style="width:500px; position:absolute; display:inline-block; margin-top:10px;"/>
        </div>
        <div style="display:inline-block; width:700px; height:100px; text-align:left;">
          <div style="display:inline-block; height:100px; width:700px; position:absolute;">
            <div style="display:inline-block; width:600px; position:absolute; margin-top:33px; margin-left:64px;">
              <form>
                <input type="hidden" name="type" value="yuyue"/>
                <input type="hidden" name="bultin" value="zt/pc/index_yuyue_bottombar"/>
                <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
                <span style="color:#FFFFFF; font-size:20px; display:inline-block;">姓名:</span>
                <input type="text" name="name" style="border:none; width:180px; height:18px; display:inline-block;"/>
                <span style="color:#FFFFFF; margin-left:5px; font-size:20px; display:inline-block;">电话:</span>
                <input type="tel" name="tel" style="border:none; width:180px; height:18px; display:inline-block;"/>
              </form>
            </div>
            <button type="button" class="submit" style="background-color:#ce0805; display:inline-block; height:80px; width:80px; background-color:#cd0300; border-radius:40px; border:none; color:#FFFFFF; font-size:24px; cursor:pointer; position:absolute; margin-top:10px; margin-left:560px;">免费索票</button>
          </div>
        </div>
        <a onClick="$(this).parents('section').animate({left:'-=95%'},'slow', function(){$(this).find('a:eq(1)').show();});$(this).hide();" style="float:right; margin-right:5.5%; margin-top:39px; cursor:pointer;">
          <img src="images/close_small.png"/>
        </a>
        <a onClick="$(this).parents('section').animate({left:'+=95%'},'slow', function(){$(this).find('a:eq(0)').show();});$(this).hide();" style="float:right; margin-right:16px; margin-top:39px; cursor:pointer; display:none;">
          <span style="color:#FFFFFF; font-size:18px; font-weight:bold;">立即索票</span>
          <img src="images/arrow_right.png" style="margin-left:24px;"/>
        </a>
      </div>
    </section>
    <div id="DIALOG_RESERVE_DIV" style="display:inline-block; width:502px; height:598px; background-image:url(images/dialog.jpg); background-size:cover; z-index:120;">
      <img onClick="$(this).next().find(':text').val(''); dialogReserve.hide();" src="images/close.png" style="width:64px; position:relative; bottom:-510px; left:219px; cursor:pointer;"/>
      <div style="display:inline-block; width:280px; height:160px; position:relative; top:230px; left:40px;">  
        <div style="display:inline-block;">      
          <form>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="zt/pc/index_yuyue_bottombar"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <input type="text" name="name" placeholder="请输入姓名" style="width:190px; background-color:#d3d3d3; border:none; border-radius:12px; height:40px; font-size:16px; padding-left:90px;"/>
            <input type="text" name="tel" placeholder="请输入电话" style="width:190px; background-color:#d3d3d3; border:none; border-radius:12px; height:40px; font-size:16px; padding-left:90px; margin-top:14px;"/>
          </form>
        </div>
        <button type="button" class="submit" style="border:none; background-color:#cd0300; color:#FFFFFF; font-size:24px; font-weight:bold; width:280px; border-radius:12px; margin-top:14px; height:50px;">立即报名</button>
      </div>
    </div>
  <script type="text/javascript" language="javascript">
  <!--//
  var _hmt = _hmt || [];
  (function() {
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?220b1fd78079208854b1033416f6cf05";
    var s = document.getElementsByTagName("script")[0]; 
    s.parentNode.insertBefore(hm, s);
  })();

  (function() {var _53code = document.createElement("script");_53code.src = "https://tb.53kf.com/code/code/10127818/1";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(_53code, s);})();
  //-->
  </script>
  <script src="https://s19.cnzz.com/z_stat.php?id=1275077633&web_id=1275077633" language="JavaScript"></script>
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
var dialogReserve = new DIALOG("DIALOG_RESERVE_DIV");
var disableBottomBar = false;
var time;
var mySwiper = new Swiper ('.swiper-container', {
  speed:500,
  autoplay:true,
  loop:true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay:{
    delay: 5000,
    stopOnLastSlide: false,
    disableOnInteraction: false,
  },
  on:{
    slideChange: function(){
      var index = parseInt(this.activeIndex) - 1;
      index = index > 5 ? 0: index;
      $(".style_navigator").find("li").css("border-bottom", "6px solid #e40112");
      $(".style_navigator").find("li:eq(" + index + ")").css("border-bottom", "6px solid #AAAAAA");
    },
  },
});
$(document).scroll(function(e) {
  if(!disableBottomBar && $(document).scrollTop() > 0){
    $("section:last").fadeIn("slow");
  } 
  else{
    $("section:last").fadeOut("slow");
  }
});

function expand(){
  $(".botton1").each(function(index, element) {
    $(this).animate({
      height:'+=10%',
      width:'+=3%',
      fontSize:'+=15%'
    }, 750);
    $(this).find("img").animate({
      height:'+=5%',
      width:'+=0.15%',
    }, 750);
  });
}
function shrink(){
  $(".botton1").each(function(index, element) {
    $(this).animate({
      height:'-=10%',
      width:'-=3%',
      fontSize:'-=15%'
    }, 750);
    $(this).find("img").animate({
      height:'-=5%',
      width:'-=0.15%',
    }, 750);
  });
}

$(document).ready(function(e) {
  $(".submit").click(function(e) {
    var form = $(this).prev().find("form");
    if(form.children().is("[name='name']") && !form.children("[name='name']").val()){
      alert('请填写您的姓名');
      return false;
    }
    if(form.children().is("[name='tel']")){
      if(!form.children("[name='tel']").val()){
        alert('电话号码不能为空');
        return false;
      }
      var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
      var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
      if(!isPhone.test(form.children("[name='tel']").val()) && !isMob.test(form.children("[name='tel']").val())){
		alert("电话号码格式不正确！");
		return false;
      }
    }
    $.ajax({
      type: "POST",
	  url: "dml_svr.php",
	  data: form.serializeArray(),
	  dataType: "json",                
	  success: function(data) { 
        alert(data.TEXT);
        reloadPage();
	  },
	  error: function(data) { 
	    alert("信息提交成功！");
        reloadPage();
	  },
	});
	return false;
  });
});
getRegion();
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();}};
//-->
</script>