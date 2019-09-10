<?php
require_once('init.inc');

require_once('../../ext/vcs.inc');
VCS::start();
?>
<!doctype html>
<html>
  <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
  <script type="text/javascript" src="../../js/swiper.3.1.2.min.js"></script>
  <script type="text/javascript" src="../../js/vcs.js"></script>
  <head>
    <meta charset="utf-8" />
	<title>沪尚茗居官网——沪尚茗居,上海家装,沪尚茗居装修，沪上装修，一站式整体家装服务</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="../../css/swiper.3.1.2.min.css"/>
	<link rel="stylesheet" type="text/css" href="../../css/site.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script type="text/javascript" src="../../js/jquery.pack.js"></script>
	<script type="text/javascript" src="../../js/jQuery.blockUI.js"></script>
	<script type="text/javascript" src="../../js/jquery.SuperSlide.js"></script>
    <script type="text/javascript" src="../../js/agui.js"></script>
    <style>
    a:hover{
      cursor:pointer;
    }
    #float-bm {
	  position: fixed;
	  left: 0;
	  right: 0;
	  bottom: 0;
	  background-color: #000000;
      filter:alpha(opacity=50);
      -moz-opacity:0.5;
      -khtml-opacity: 0.5;
      opacity: 0.5; 
	  height: 110px;
    }
    </style>
    <script type="text/javascript" language="javascript">
    <!--//
    window._agl = window._agl || [];
    (function () {
      _agl.push(
        ['production', '_f7L2XwGXjyszb4d1e2oxPybgD']
      );
      (function () {
        var agl = document.createElement('script');
        agl.type ='text/javascript';
        agl.async = true;
        agl.src = 'https://fxgate.baidu.com/angelia/fcagl.js?production=_f7L2XwGXjyszb4d1e2oxPybgD';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(agl, s);
      })();
    })();
    //-->
    </script>
    <script type="text/javascript" language="javascript">
    <!--//
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?220b1fd78079208854b1033416f6cf05";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    //-->
    </script>
  </head>
  <body style="background-color:#fffae6;">
    <section style="padding:0px; margin:0px;">
      <div>
        <img class="images" src="images/001b.jpg" />
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div style="padding:0px; margin:0px;">
        <form style="height:0px; padding:0px;">
          <input type="hidden" name="type" value="yuyue"/>
          <input type="hidden" name="bultin" value="tg/01/index_yuyue_01"/>
          <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
          <div style="position:relative; top:83px; left:730px;">
            <input type="text" name="name" placeholder="*您的姓名" style="height:42px; width:262px; border: 2px solid #ffc412; font-size:20px; padding:3px 5px 3px 5px; color:#999999; font-weight:400;" />
          </div>
          <div style="position:relative; top:31px; left:1010px;">
            <input type="text" name="tel" placeholder="*您的电话" style="height:42px; width:262px; border: 2px solid #ffc412; font-size:20px; padding:3px 5px 3px 5px; color:#999999; font-weight:400;" />
          </div> 
          <a class="submit" style="display:inline-block; height:52px; width:142px; position:relative; top:-21px; left:1290px;">
            <img src="images/button01.png" />
          </a>         
          <div style="position:relative; top:-15px; left:730px; font-size:18px; font-weight:bold; color:#000000;">
            <input type="radio" name="service" value="闵行店"> 闵行展
            <input type="radio" name="service" value="松江店"> 松江展
            <input type="radio" name="service" value="嘉定店"> 嘉定展
          </div>
        </form>
        <img class="images" src="images/002.jpg" />
      </div>
    </section>
    <section style="padding:0px; margin:0px;">
      <div style="padding:0px; margin:0px;">
        <img class="images" src="images/003a.jpg" />
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div style="padding:0px; margin:0px;">
        <img class="images" src="images/004.jpg" />
        <form style="height:0px; padding:0px;">
          <input type="hidden" name="type" value="yuyue"/>
          <input type="hidden" name="bultin" value="tg/01/index_yuyue_02"/>
          <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>       
          <div style="position:relative; bottom:210px; left:450px; font-size:18px; font-weight:bold; color:#000000; z-index:100">
            <input type="radio" name="service" value="闵行店"> 闵行展
            <input type="radio" name="service" value="松江店"> 松江展
            <input type="radio" name="service" value="嘉定店"> 嘉定展
          </div>
          <div style="position:relative; top:-384px; left:427px;">
            <input type="tel" name="tel" placeholder="您的电话（信息已被加密，请放心填写）" style="height:130px; width:1000px; border-radius:20px; border: 3px solid #ffc412; font-size:43px; padding:3px 30px 3px 30px; color:#555555; font-weight:400;" />
          </div> 
          <a class="submit" style="display:block; height:146px; width:512px; position:relative; top:-330px; left:695px;">
            <img src="images/button02.jpg" />
          </a>
        </form>
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/005.jpg" />
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/006.jpg" />
        <a onclick="dialogReserve.show();" style="display:block; height:146px; width:512px; position:relative; top:-190px; left:695px;">
          <img src="images/button02.jpg" />
        </a>
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/007.jpg" />
        <a onclick="dialogReserve.show();" style="display:block; height:146px; width:512px; position:relative; top:-180px; left:695px;">
          <img src="images/button02.jpg" />
        </a>
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/008.jpg" />
        <a onclick="dialogReserve.show();" style="display:block; height:146px; width:512px; position:relative; top:-175px; left:695px;">
          <img src="images/button02.jpg" />
        </a>
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/009.jpg" />
        <a onclick="dialogReserve.show();" style="display:block; height:146px; width:512px; position:relative; top:-175px; left:695px;">
          <img src="images/button02.jpg" />
        </a>
      </div>
    </section>
    <section style="padding:0px; margin:0px; margin-top:-4px;">
      <div>
        <img class="images" src="images/010.jpg" />
        <a onclick="dialogReserve.show();" style="display:block; height:146px; width:512px; position:relative; top:-250px; left:695px;">
          <img src="images/button02.jpg" />
        </a>
      </div>
    </section>
    <div id="float-bm" class="float-bm">
      <div>
      </div>      
    </div>
    <table class="float-bm" cellpadding="0" cellspacing="0" align="center" style="position:fixed; bottom: 0; z-index:100; text-align:center; width:100%;">
      <tr>
        <td valign="middle" align="right" style="width:960px; height:110px;">
          <img src="images/bottombanner.png" style="height:110px; width:472px;" />
        </td>
        <td valign="middle" align="left" style="width:960px;">
          <form style="height:0px; padding:0px;">
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="tg/01/index_yuyue_bottom"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <div style="position:relative; top:10px;">
              <input type="text" name="name" placeholder="*您的姓名" style="height:32px; width:180px; border: 2px solid #ffc412; font-size:14px; padding:3px 5px 3px 5px; color:#666666; font-weight:400;" />
            </div>
            <div style="position:relative; top:-32px; left:200px;">
              <input type="text" name="tel" placeholder="*您的电话" style="height:32px; width:180px; border: 2px solid #ffc412; font-size:14px; padding:3px 5px 3px 5px; color:#666666; font-weight:400;" />
            </div> 
            <a class="submit" style="display:inline-block; height:42px; width:115px; top:-74px; left:400px; position:relative;">
              <img src="images/button01.png" style="height:42px; width:115px;" />
            </a>         
            <div style="position:relative; top:-74px; left:0px; font-size:18px; font-weight:bold; color:#ffffff;">
              <input type="radio" name="service" value="闵行店"> 闵行展
              <input type="radio" name="service" value="松江店"> 松江展
              <input type="radio" name="service" value="嘉定店"> 嘉定展
            </div>
          </form>
          <a onclick="$('.float-bm').each(function() {$(this).hide();});" style="display:inline-block; height:64px; width:64px; text-align:center; position:relative; left:640px; bottom:0px;">
            <img src="images/close.png" style="height:64px; width:64px;" />
          </a>
        </td>
      </tr>
    </table>
    <!-- dialog to descript a device-->
    <div id="RESERVE_DIALOG_DIV" style="background-color:#fffae6; border:3px #ffc412 solid; border-radius: 30px; display:none; padding:48px 64px 48px 64px; z-index:20; width:960px; height:360px; margin-top:-80px;">
      <form id="RESERVE_FORM">
        <input type="hidden" name="type" value="yuyue"/>
        <input type="hidden" name="bultin" value="tg/01/index_yuyue_dialog"/>
        <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
        <input type="tel" name="tel" placeholder="您的电话（信息已被加密，请放心填写）" style="height:96px; width:800px; border-radius:20px; border: 3px solid #ffc412; font-size:32px; padding:3px 30px 3px 30px; color:#555555; font-weight:400; margin-left:-20px;" />
        <div style="font-size:18px; font-weight:bold; color:#000000; margin-top:20px;">
          <input type="radio" name="service" value="闵行店"> 闵行展
          <input type="radio" name="service" value="松江店"> 松江展
          <input type="radio" name="service" value="嘉定店"> 嘉定展
        </div>
        <a class="submit" style="position:relative; display:block; height:91px; width:320px; left:240px; margin-top:36px;">
          <img src="images/button03.jpg" />
        </a>
      </form>
      <a onclick="dialogReserve.hide();" style="display:block; height:128px; width:128px; text-align:center; position:relative; left:340px; bottom:-80px;">
        <img src="images/close.png" />
      </a>
    </div>
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
var dialogReserve = new DIALOG("RESERVE_DIALOG_DIV");

$(document).ready(function(e) {
  $(".submit").click(function(e) {
    $name = false;
    $tel = false;
    $form = $(this).parent("form");
    $(this).prevAll("div").each(function() {
      if($(this).find("input").attr("name") == "tel"){
        $tel = $(this).find("input").val();
      }
      if($(this).find("input").attr("name") == "name"){
        $name = $(this).find("input").val();
      }
    });
    $(this).prevAll("input").each(function() {
      if($(this).attr("name") == "tel"){
        $tel = $(this).val();
      }
      if($(this).attr("name") == "name"){
        $name = $(this).val();
      }
    });
    
    if($name == "" && $name !== false){
      alert('请填写您的姓名');
	  return false;
	}
    else if($tel==""){
	  alert('手机号不能为空');
	  return false;
	}
    else if(!$tel.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
		alert("手机号码格式不正确！");
		return false;
	};
   
    $.ajax({
	  type: "POST",
	  url: "dml_svr.php",
	  data: $form.serializeArray(),
	  dataType: "json",                
	  success: function(data) { 
		window._agl && window._agl.push(['track', ['success', {t: 3}]]);
        dialogReserve.hide();
        alert(data.TEXT);
	  },
	  error: function(data) { 
        dialogReserve.hide();
		alert("信息提交成功！");
	  },
	});
	return false;
  });
});

//-->
</script>
<script language="javascript" type="text/javascript">
<!--//
getRegion();
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();}};
//-->
</script>