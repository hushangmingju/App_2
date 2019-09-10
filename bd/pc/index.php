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
        <img src="images/banner_01v.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>    
    <!-- 表单栏1 -->
    <section style="padding:0px; margin:0px; min-width:1200px;">
      <div style="display:block; height:112px; background-color:#d40b11; width:100%; text-align:center; margin-top:-5px; min-width:1200px;">
        <div style="display:inline-block; margin:0px;">
          <div style="font-size:32px; color:#ffffff; font-weight:bold; display:table-cell; vertical-align:middle; height:112px; width:180px;">免费索票</div>
        </div>
        <div style="display:inline-block;">
          <div style="font-size:40px; color:#ba1a26; font-weight:bold; display:table-cell; vertical-align:middle; height:112px;">
            <div tag="div" style="display:inline-block;">
              <form>
                <input type="hidden" name="type" value="yuyue"/>
                <input type="hidden" name="bultin" value="zt/pc/index_yuyue_01"/>
                <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
                <input type="text" name="name" placeholder="请填写您的姓名" style="width:380px; height:40px; border:2px solid #ba1a26; border-radius:15px; padding-left:16px; margin-top:-10px; font-size:16px;"/>
                <input type="tel" name="tel" placeholder="请填写手机号" style="width:380px; height:40px; border:2px solid #ba1a26; border-radius:15px; padding-left:16px; margin-top:-10px; font-size:16px; margin-left:10px;"/>
              </form>
            </div>
            <button type="button" class="submit" style="display:inline-block; background-color:#ff6e01; color:#FFFFFF; font-size:22px; border-radius:18px; border:none; font-weight:bold; padding:8px 24px 8px 24px; margin-left:10px; cursor:pointer;">立即报名</button>
          </div>
        </div>
      </div>
    </section>   
    <!-- 图片1-->
    <section style=" padding:0px; margin:0px;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_01d.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>   
    <!-- 图片2-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_02h.jpg" style="width:100%;"/>
      </div>
    </section>      
    <!-- 弹框按钮1-->
    <section style="width:100%; text-align:center; margin-top:10px;">
      <div style="width:100%; min-width:1200px; display:inline-block; text-align:center; height:96px; margin-bottom:32px;">
        <img onClick="dialogReserve.show();" src="images/button3.png" style="cursor:pointer;" />
      </div>
    </section>  
    <!-- 图片3
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_03.jpg" style="width:100%;"/>
      </div>
    </section>  -->  
    <!-- 表单2
    <section style="text-align:center; background-color:#f6f8f5;">
      <div style="width:1200px; display:inline-block; text-align:center; margin-top:20px; margin-bottom:20px;">
        <div style="display:block; text-align:center;">
          <div style="display:block; text-align:center;">
            <form>
              <input type="hidden" name="type" value="yuyue"/>
              <input type="hidden" name="bultin" value="zt/pc/index_yuyue_02"/>
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
              <input type="tel" name="tel" placeholder="您的电话（信息已加密，请放心填写）" style="width:80%; height:48px; font-size:24px; padding:8px; border-radius:32px; padding-left:32px;"/>
            </form>
          </div>
          <button type="button" class="submit" style="border:none; height:50px; padding:5px 40px 5px 40px; font-size:28px; color:#FFFFFF; background-color:#e70012; display:inline-block; margin-top:26px; border-radius:25px;">预约优惠名额</button>
        </div>
      </div>
    </section>  --> 
    <!-- 图片4-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_03d.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section>  
    <!-- 图片5
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_05.jpg" style="width:100%; padding:0px; margin:0px;"/>
      </div>
    </section> -->  
    <!-- 轮拨图-->
    <section style="text-align:center;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <div class="swiper-container" style="margin-top:20px;">
		  <div class="swiper-wrapper" style="height:490px;">
            <div class="swiper-slide">
			  <img onClick="dialogReserve.show();" src="images/lunbo/1.jpg" class="img-full" style="height:100%; cursor:pointer;">
		    </div>
            <div class="swiper-slide">
			  <img onClick="dialogReserve.show();" src="images/lunbo/2.jpg" class="img-full" style="height:100%; cursor:pointer;">
		    </div>
            <div class="swiper-slide">
			  <img onClick="dialogReserve.show();" src="images/lunbo/3.jpg" class="img-full" style="height:100%; cursor:pointer;">
		    </div>
            <div class="swiper-slide">
			  <img onClick="dialogReserve.show();" src="images/lunbo/4.jpg" class="img-full" style="height:100%; cursor:pointer;">
		    </div>
          </div>
          <div class="swiper-button-next"></div>
		  <div class="swiper-button-prev"></div>
        </div>
      </div>
    </section>     
    <!-- 图片6-->
    <section style="text-align:center;">
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_04d.jpg" style="width:100%;"/>
      </div>
    </section>    
    <!-- 弹框按钮2-->
    <section style="width:100%; text-align:center; margin-top:10px;">
      <div style="width:100%; min-width:1200px; display:inline-block; text-align:center; height:96px; margin-bottom:32px;">
        <img onClick="dialogReserve.show();" src="images/button2.gif" style="cursor:pointer;" />
      </div>
    </section>       
    <!-- 表单3
    <section style="text-align:center; background-color:#f6f8f5;">
      <div style="width:1200px; display:inline-block; text-align:center; margin-top:20px; margin-bottom:20px;">
        <div style="display:block; text-align:center;">
          <div style="display:block; text-align:center;">
            <form>
              <input type="hidden" name="type" value="yuyue"/>
              <input type="hidden" name="bultin" value="zt/pc/index_yuyue_03"/>
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
              <input type="tel" name="tel" placeholder="您的电话（信息已加密，请放心填写）" style="width:80%; height:48px; font-size:24px; padding:8px; border-radius:32px; padding-left:32px;"/>
            </form>
          </div>
          <button type="button" class="submit" style="border:none; height:50px; padding:5px 40px 5px 40px; font-size:28px; color:#FFFFFF; background-color:#e70012; display:inline-block; margin-top:26px; border-radius:25px;">预约优惠名额</button>
        </div>
      </div>
    </section>  --> 
    <!-- 图片7-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_05d.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 图片8-->
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_06f.jpg" style="width:100%;"/>
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
        <img src="images/pc_07d.jpg" style="width:100%;"/>
      </div>
    </section>  
    <!-- 图片10 --> 
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_08d.jpg" style="width:100%;"/>
      </div>
    </section> 
    <!-- 图片11
    <section>
      <div style="width:100%; min-width:1200px; display:inline-block;">
        <img src="images/pc_11.jpg" style="width:100%; cursor:pointer;"/>
      </div>
    </section> -->   
    <!-- 表单栏2-->
    <section style="text-align:center; background-color:#f6f8f5;">
      <div style="width:1200px; display:inline-block; text-align:center;">
        <div style="display:inline-block;">
          <div style="display:table-cell; vertical-align:central; font-size:28px; color:#000000;">
            <div tag="div" style="display:inline-block;">
            <form>
              <input type="hidden" name="type" value="yuyue"/>
              <input type="hidden" name="bultin" value="zt/pc/index_yuyue_02"/>
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>  
              填写手机号码即可获取线路短信：
              <input type="tel" name="tel" style="width:360px; height:32px; display:inline-block; top:-3px; position:relative; border-radius:16px;"/>
            </form>
            </div>
            <button type="button" class="submit" style="border:none; height:40px; padding:5px 32px 5px 32px; font-size:20px; color:#FFFFFF; background-color:#e70012; display:inline-block; margin-left:8px; border-radius:16px;">确认发送</button>
          </div>
        </div>
      </div>
    </section>       
    <!-- 底部留白-->
    <section style="height:120px; background-color:#f6f8f5;">
    </section>
    <!-- 预约弹框-->
    <div id="DIALOG_RESERVE_DIV" style="display:inline-block; width:640px; height:450px; z-index:120; margin-top:-60px;">
      <img onClick="$(this).next().find(':text').val(''); dialogReserve.hide();" src="images/close.png" style="width:64px; position:relative; bottom:-550px; left:288px; cursor:pointer;"/>
      <div style="display:inline-block; width:640px; height:450px; background-color:#FFFFFF;">
        <h1 style="color:#ff0000; text-align:center; padding-top:20px;">上海整体家装博览会</h1> 
        <p style="display:inline-block; text-align:center; padding-bottom:10px; width:560px; border-bottom:1px #AAAAAA solid; margin-left:40px;">今 日 还 剩 <img src="images/counter.gif" style="border:none; height:24px;" /> 个 名 额</p>   
        <div style="display:inline-block; width:480px; margin-left:80px;">  
          <form tag="form">
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="zt/pc/index_yuyue_bottombar"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <div style="display:block; margin-top:20px;">
              <span style="display:inline-block; width:90px;">你的姓名</span>
              <input type="text" name="name" placeholder="请输入您的姓名" style="width:370px; background-color:#FFFFFF; border:1 solid #AAAAAA; border-radius:5px; height:36px; font-size:16px; padding-left:10px;"/>
            </div>
            <div style="display:block; margin-top:20px;">
              <span style="display:inline-block; width:90px;">您的电话</span>
              <input type="text" name="tel" placeholder="请输入您的手机电话" style="width:370px; background-color:#FFFFFF; border:1 solid #AAAAAA; border-radius:5px; height:36px; font-size:16px; padding-left:10px;"/>
            </div> 
          </form>
          <button type="button" class="submit" style="border:none; background-color:#cd0300; color:#FFFFFF; font-size:24px; font-weight:bold; width:100%; border-radius:5px; margin-top:32px; height:40px;">免费索票</button>
        </div>
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
  pagination : '.swiper-pagination',});
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
    
    /*
    var form = $(this).prev().attr("tag") == "div" ? $(this).prev().find("form") : $(this).prev();
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
    }*/
    var name = false;
    var tel = false;
    if($(this).prev().attr("tag") == "div"){
      var form = $(this).prev().find("form");
      name = form.children().is("[name='name']") ? form.children("[name='name']") : false;
      tel = form.children("[name='tel']");
    }
    else{
      var form = $(this).prev();
      name = form.children("div:eq(0)").children("[name='name']");
      tel = form.children("div:eq(1)").children("[name='tel']");
    }
    if(name && !name.val()){
      alert('请填写您的姓名');
      return false;
    }
    if(tel){
      if(!tel.val()){
        alert('电话号码不能为空');
        return false;
      }
      var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
      var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
      if(!isPhone.test(tel.val()) && !isMob.test(tel.val())){
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