<?php
include('plugins.inc');
// 获取相对根目录路径
$phpSelf = explode('/', substr($_SERVER['PHP_SELF'], 1));
$rootPath = '';
if (count($phpSelf) > 0) {
    for ($i = 0; $i < count($phpSelf); $i++) {
        if ($i > 0) {
            $rootPath .= '../';
        }
    }
}
?>
<!doctype html>
<html>
  <head>
    <!-- 网站基本参数设置  --> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,initial-scale=1.0,user-scalable=no, minimal-ui" />    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <!-- 强制浏览器清理缓存--> 
    <meta content="no-cache" http-equiv="pragma">
    <meta content="no-cache" http-equiv="cache-control">
    <meta content="0" http-equiv="expires">    
    <!-- 手机上电话号码不要默认显示为链接 -->    
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo $rootPath;?>css/swiper.4.4.2.css"/>    
    <script type="text/javascript" src="<?php echo $rootPath;?>js/swiper.4.4.2.js"></script>
    <title>沪尚茗居——一站式整体家装服务</title>
  </head>
  <script language="javascript" src="../js/jquery-2.1.4.min.js"></script>
  <script language="javascript" src="../js/agui.js"></script>
  <body style="width:100%; padding:0px; margin:0px;">
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#FFFFFF', 'width' => '95%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'test_yuyue_01', 'phpSelf' => $_SERVER['PHP_SELF']);
    echo PLUGIN::setPlugIn($plugInArray, 0);
    ?>
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#FFFFFF', 'width' => '95%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'test_yuyue_01', 'head' => '免费预约设计咨询', 'placeholder' => '请输入手机号', 'buttonString' => '立即申请', 'buttonColor' => '#fe4b5b', 'buttonFontColor' => '#FFFFFF');
    echo PLUGIN::setPlugIn($plugInArray, 1);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#FFFFFF', 'width' => '95%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'test_yuyue_01', 'head' => '免费预约 快人一步', 'placeholder_name' => '请输入您的姓名', 'placeholder_tel' => '请输入您的手机号', 'buttonString' => '立即申请', 'buttonColor' => '#fe4b5b', 'buttonFontColor' => '#FFFFFF');
    echo PLUGIN::setPlugIn($plugInArray, 2);
    ?>
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
      <div style="display:block; text-align:center;">
        <div style="display:inline-block; width:90%; background-color:#FFFFFF; text-align:left; height:90px;">
          <a>
            <span style="font-size:16px; font-weight:bold; display:block;">带样式的文本框：</span>
            <span style="font-size:14px; display:block;">通过富文本编辑器，实现带样式的文本显示。</span>            
            <span style="font-size:14px; display:block; color:#FF0000;">可以调整文本颜色</span>           
            <span style="font-size:14px; display:block;">可以设置文本<b>粗体</b>，<span style="font-style:italic;">斜体</span>，<span style="text-decoration:underline;">下划线</span></span>
            <span style="font-size:14px; display:block;">还可以设置文本超链接等</span>
          </a>
        </div>
      </div>
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#f4efeb', 'width' => '90%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'zt/yd/index_yuyue_01', 'placeholder_name' => '您的姓名（信息已加密，请放心填写）', 'placeholder_tel' => '您的电话（信息已加密，请放心填写）', 'buttonString' => '免费领取门票', 'buttonColor' => '#ffc412', 'buttonFontColor' => '#000000');
    echo PLUGIN::setPlugIn($plugInArray, 4);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#f4efeb', 'width' => '90%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'zt/yd/index_yuyue_01', 'placeholder_tel' => '您的电话（信息已加密，请放心填写）', 'buttonString' => '立即领取优惠', 'buttonColor' => '#ffc412', 'buttonFontColor' => '#000000');
    echo PLUGIN::setPlugIn($plugInArray, 5);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('background-color' => '#f4efeb', 'width' => '90%', 'paddingTop' => '20px;', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => 'zt/yd/index_yuyue_01', 'placeholder_name' => '您的姓名（信息已加密，请放心填写）', 'placeholder_tel' => '您的电话（信息已加密，请放心填写）', 'buttonString' => '免费领取门票', 'buttonColor' => '#ffc412', 'buttonFontColor' => '#000000');
    echo PLUGIN::setPlugIn($plugInArray, 8);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('id' => '', 'background_css' => 'background-color:#fafafa;', 'width' => '90%', 'paddingTop' => '20px', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => '', 'placeholder_name' => '您的姓名', 'placeholder_tel' => '您的电话', 'placeholder_address' => '您的地址', 'input_css' => 'font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;', 'buttonString' => '免费预约', 'button_css' => 'width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;', 'success_code' => 'alert(data.TEXT);reloadPage();');
    echo PLUGIN::setPlugIn($plugInArray, 12);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px;">
    <?php
    $plugInArray = array('id' => '', 'background_css' => 'background-color:#4d2a6c;', 'form_css' => 'width:90%; background-color:#fffcf7; border-radius:12px; padding:20px 10px 20px 10px; box-shadow:#000 3px 3px 10px;', 'paddingTop' => '20px', 'paddingBottom' => '20px', 'type' => 'yuyue', 'bultin' => '', 'placeholder_name' => '请输入姓名', 'placeholder_tel' => '请输入手机号', 'placeholder_address' => '请输入售票地址，方便门票到家', 'input_css' => 'font-size:14px; height:28px; display:inline-block; width:92%; border: none; border-bottom:1px solid #AAA; background-color:#fffcf7; margin-top:5px; margin-left:12px;', 'remark' => '请详细填写以上信息，我们将免费快递您价值66元的门票一张。', 'remark_css' => 'display:block; color:#b41d2e; font-size:10px; text-align:left; margin-left:20px; margin-top:4px;', 'buttonString' => '免费领取门票', 'button_css' => 'width:75%; border-radius:16px; background-color:#c91b1d; color:#FFFFFF; font-size:18px; height:36px; border:none;', 'success_code' => 'alert(data.TEXT);reloadPage();');
    echo PLUGIN::setPlugIn($plugInArray, 13);
    ?> 
      </div>  
    </section> 
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div id="*id#" style="width:90%; display:inline-block; padding:0px; margin:0px; background-color:#fafafa; text-align:center; padding-top:20px; padding-bottom:20px;">
        <div style="width:*width#; display:inline-block;">
          <form>
            <span style="display:block; text-align:left; font-size:12px; padding-bottom:5px;">参展地址：</span>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="zt/yd2/index_yuyue_01"/>
            <input type="hidden" name="phpSelf" value=""/> 
            <div style="display:block; text-align:left;"> 
              <input type="radio" name="service" value="宝山店"/> <span style="font-size:14px;">宝山展</span>
              <input type="radio" name="service" value="闵行店"/> <span style="font-size:14px;">闵行展</span>
              <input type="radio" name="service" value="松江店"/> <span style="font-size:14px;">松江展</span>
              <input type="radio" name="service" value="嘉定店"/> <span style="font-size:14px;">嘉定展</span>
            </div>
            <input name="name" type="text" placeholder="您的姓名" style="font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;" />
            <input name="tel" type="text" placeholder="您的电话" style="font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;" />
            <div style="display:block; text-align:center; margin-top:16px;">
              <button onClick="submit4($(this));" type="button" style="width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;">立即预约</button>
            </div>
          </form> 
        </div>
      </div>
    </section>
    <section style="margin:0px; padding:0px; text-align:center; width:100%; margin-top:60px;">
      <div style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:#fFFFFF; text-align:center; padding-top:20px; padding-bottom:20px;">
                         <div style="width:90%; display:inline-block;">
                           <form>
                             <input type="hidden" name="type" value="yuyue"/>
                             <input type="hidden" name="bultin" value="zt/yd2/index_yuyue_02"/>
                             <input type="hidden" name="phpSelf" value=""/>
                             <input name="tel" type="text" placeholder="您的电话" style="font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit11($(this));" type="button" style="width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;">立即预约</button>
                             </div>
                           </form> 
                         </div>
                       </div>
    </section>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px; height:180px;">
      <?php
    $plugInArray = array('background_css' => '', 'form_css' => 'width:100%; padding:100px 10px 100px 10px; box-shadow:#000 3px 3px 10px;', 'paddingTop' => '20px', 'paddingBottom' => '20px', 'onClick' => '', 'buttonString' => '免费领取门票', 'button_css' => 'width:75%; border-radius:16px; background-color:#c91b1d; color:#FFFFFF; font-size:18px; height:36px; border:none;');
    echo PLUGIN::setPlugIn($plugInArray, 14);
    ?> 
      </div>
    </section>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:640px; height:180px;">
      </div>
    </section>
    <?php
    $plugInArray = array('id' => 'DIALOG_YUYUE','background-color' => '#f4efeb', 'width' => '85%', 'type' => 'yuyue', 'bultin' => 'zt/yd/index_yuyue_dialog', 'placeholder_name' => '您的姓名（信息已加密，请放心填写）', 'placeholder_tel' => '您的电话（信息已加密，请放心填写）', 'buttonString' => '立即领取优惠', 'buttonColor' => '#ffc412', 'buttonFontColor' => '#000000');
    echo PLUGIN::setPlugIn($plugInArray, 6);
    ?>
    <?php
    $plugInArray = array('id' => 'DIALOG_RESERVE','background-color' => '#f4efeb', 'width' => '85%', 'type' => 'yuyue', 'bultin' => 'zt/yd/index_yuyue_dialog', 'placeholder_name' => '您的姓名（信息已加密，请放心填写）', 'placeholder_tel' => '您的电话（信息已加密，请放心填写）', 'buttonString' => '立即领取优惠', 'buttonColor' => '#ffc412', 'buttonFontColor' => '#000000');
    echo PLUGIN::setPlugIn($plugInArray, 9);
    ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%; margin-top:60px;">
      <div style="width:100%; max-width:640px; display:inline-block; background-color:#b00c02;">
        <div style="width:90%; display:inline-block; margin:0px; padding:0px;">
          <ul class="style_navigator" style="margin:0px; padding:0px;">
          <?php
          $lunbos = glob('lunbo1/*.jpg');
          for ($k = 0; $k < count($lunbos); $k++) {          
          ?>
            <li onClick="mySwiper.slideTo(<?php echo ($k + 1);?>);" style="display:inline-block; width:<?php echo ((90 / count($lunbos)) - 1)?>%; border-bottom:3px solid #FFFFFF; padding:8px 0px 8px 0px; color:#fcd37b;<?php echo $k == 0 ? '' : ' margin-left:3px;';?>"><?php echo substr(str_replace('lunbo1/', '', str_replace('.jpg', '', $lunbos[$k])), 1);?></li>
          <?php
          }
          ?>
          </ul>
        </div>
      </div>
      <div class="swiper-container" id="SWIPER_CONTAINER_01" style="padding-top:20px; background-color:#b00c02; max-width:640px;">
		<div class="swiper-wrapper">
        <?php
        for ($k = 0; $k < count($lunbos); $k++) {
        ?>
          <div class="swiper-slide">
			<img src="<?php echo $lunbos[$k];?>" style="width:100%;">
		  </div>
        <?php
        }
        ?>
        </div>
      </div>
    </section>
     <!-- 轮拨图2-->
    <section style="margin:0px; padding:0px; text-align:center; width:100%; margin-top:60px;">
      <div class="swiper-container" id="SWIPER_CONTAINER_02" style="width:100%; max-width:640px; display:inline-block; background-color:#f4efeb;">
		<div class="swiper-wrapper">
        <?php
        $lunbos = glob('lunbo2/*.jpg');
        for ($k = 0; $k < count($lunbos); $k++) {
        ?>
          <div class="swiper-slide">
			<img src="<?php echo $lunbos[$k];?>" class="img-full" style="width:100%;">
		  </div>
        <?php
        }
        ?>
        </div>
      </div>
    </section>
    <section style="background-color:rgba(0, 0, 0, 0); bottom:0; position:fixed; z-index:21; top:auto; width:100%; text-align:center; display:block; margin-top:180px;">
          <div style="display:inline-block; max-width:640px; width:100%; margin:0px; padding-bottom:5px;">
            <a href="tel:021-31599924" phone_number="021-31599924" style="background-color:#FD6556; color:#FFF; font-size:18px; width:48%; height:32px; display:inline-block; text-align:center; padding-top:5px; border-radius:2px; text-decoration:none;">
              <span class="tel-label text-ellipsis">拨打电话</span>
              <i class="brick-i-tel-right icon-telphone_right"></i>
              <i class="icon-telphone_circle brick-i-tel"></i>
            </a>
            <a onclick="openDialog('DIALOG_RESERVE');" style="background-color:#FD6556; color:#FFF; font-size:18px; width:48%; height:32px; display:inline-block; text-align:center; padding-top:5px; border-radius:2px; text-decoration:none;">
              <span class="tel-label text-ellipsis">领取优惠</span>
              <i class="brick-i-tel-right icon-telphone_right"></i>
              <i class="icon-telphone_circle brick-i-tel"></i>
            </a>
          </div>
      </section>
    
        <script type="text/javascript" language="javascript">
        <!--//
        var dialog = new Array();
        dialog.push(new DIALOG("DIALOG_RESERVE"));
        
        function openDialog(id){
          if(document.getElementById(id)){
            for(var i = 0; i < dialog.length; i++){
              if(dialog[i].id == id){
                dialog[i].show();
              }
            }
          }
        }
        function closeDialog(id){
          if(document.getElementById(id)){
            for(var i = 0; i < dialog.length; i++){
              if(dialog[i].id == id){
                dialog[i].hide();
              }
            }
          }
        }
        
        
var mySwiper = new Swiper ('#SWIPER_CONTAINER_01', {
  speed:500,
  autoplay:true,
  loop:true,
  navigation: {
    nextEl: 'null',
    prevEl: 'null',
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
      $(".style_navigator").find("li").css("border-bottom", "3px solid #FFFFFF");
      $(".style_navigator").find("li:eq(" + index + ")").css("border-bottom", "3px solid #AAAAAA");
    },
  },
});  
var mySwiper2 = new Swiper ('#SWIPER_CONTAINER_02', {
  speed:500,
  autoplay:true,
  loop:true,
  navigation: {
    nextEl: 'null',
    prevEl: 'null',
  },
  autoplay:{
    delay: 5000,
    stopOnLastSlide: false,
    disableOnInteraction: false,
  }
});  
        //-->
        </script>
  </body>
</html>