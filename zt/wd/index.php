<?php
require_once('../top.inc');
?>
    <title>展会——一站式整体家装服务</title>
    <link rel="stylesheet" type="text/css" href="../css/s3.css" />
    <style>
    .body-wrapper{background-color:#3d47a0!important;color:#333}
    .single-img{background:#3d47a0}
    .single-img-box img{width:100%}
    .trans-form-blank-three{background-color:#fff; width:80%; border-radius:10px;}
    .trans-form-blank-three .bsml-form{padding-bottom:1rem;}
    .trans-form-blank-three .bsml-form-title{text-align:left;padding:.875rem 0 .875rem .875rem;font-size:1.125rem; width:90%}
    .trans-form-blank-three .bsml-form-count{padding-left:1rem;font-size:.75rem;padding-bottom:1.063rem;color:#666}
    .trans-form-blank-three .bsml-form-list li{list-style:none}
    .trans-form-blank-three .bsml-form-list label{text-align:left;font-size:1rem;margin-bottom:.75rem;padding:0 1rem;display:-webkit-flex;display:flex}
    .trans-form-blank-three .form-input div{display:block;padding:0;margin:0;}
    .trans-form-blank-three .bsml-form-list-box{display:block;padding:.25rem 1rem 0}
    .trans-form-blank-three .bsml-form-list-submit{padding:0;display:block;height:2.375rem;line-height:2.375rem;text-align:center;font-size:.875rem;background-color:#ff6d39;color:#fff}
    .trans-form-blank-three .bsml-form-tips{display:none;position:absolute;width:120px;height:3.75rem;line-height:3.75rem;text-align:center;font-size:.75rem;color:#fff;bottom:30%;left:50%;margin-left:-80px;z-index:999;border-radius:5px;background:rgba(0,0,0,.3);white-space:nowrap;word-wrap:normal;overflow:hidden;text-overflow:ellipsis}
    </style>
  </head>

  <body id="wdbody" style="width:100%; padding:0px; margin:0px; background-image:url(images/background01.jpg); background-repeat:no-repeat; background-size:100%;background-origin: border-box; background-position:0px -20px; text-align:center; vertical-align:bottom;">
    <main>
      <section id="frame-1" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0;">
        <div class="brick-mask"></div>
        <div class="brick-content" style="width:100%;">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a id="toQuestion" style="display:inline-block; background-color:#FFFFFF; border-radius:10px; padding:5px 48px 5px 48px; font-size:22px; margin-top:480px; font-weight:bold; color:#9b026e;">开始答题</a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>
      <section id="frame-2" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0; display:none;">
        <div class="brick-mask"></div>
        <div class="brick-content" style="width:100%;">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none; margin-top:160px; padding-left:72px; padding-right:64px; text-align:left;">
              <h2 id="WD_QUESTION_H2" style="color:#ffffff;">沪尚茗居目前在上海有几家店？</h2>
              <div id="WD_CHOOSES_DIV" style="color:#ffffff; font-weight:bold; margin-top:57px; width:180px;">
                <ol>
                  <li style="list-style-type:upper-alpha; height:72px;">
                    <div style="height:48px; opacity:0; background-color:#ffffff; width:208px; margin-left:-36px; border-radius:10px;"></div>
                    <a id="WD_CHOOSE_A_A" class="qbtn" value="1" style="color:#ffffff; position:relative; display:block; margin-top:-36px;"></a>
                  </li>
                  <li style="list-style-type:upper-alpha; height:72px;">
                    <div style="height:48px; opacity:0; background-color:#ffffff; width:208px; margin-left:-36px; border-radius:10px;"></div>
                    <a id="WD_CHOOSE_B_A" class="qbtn" value="2" style="color:#ffffff; position:relative; display:block; margin-top:-36px;"></a>
                  </li>
                  <li style="list-style-type:upper-alpha; height:72px;">
                    <div style="height:48px; opacity:0; background-color:#ffffff; width:208px; margin-left:-36px; border-radius:10px;"></div>
                    <a id="WD_CHOOSE_C_A" class="qbtn" value="3" style="color:#ffffff; position:relative; display:block; margin-top:-37px;"></a>
                  </li>
                </ol>
              </div>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section> 
      <section id="frame-3" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0; display:none; vertical-align:central;">
        <div class="brick-mask"></div>
        <div class="brick-content" style="width:100%; margin-top: 130px;">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <form id="WD_RESERVE_FORM">
              <input type="hidden" name="type" value="yuyue"/>
              <input type="hidden" name="bultin" value="zt/wd/index_yuyue_01"/>
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
              <div class="image-box" style="-webkit-clip-path:none;">
                <input type="text" name="name" id="WD_RESERVE_NAME_TEXT" placeholder="姓名：方便我们礼貌称呼您" value="" style="width:220px; border-radius:5px; font-size:14px; padding:8px 24px 8px 24px; border:none;">
                <p></p>
                <input type="tel" name="tel" id="WD_RESERVE_TEL_TEXT" placeholder="手机：方便我们准确联系您" value="" style="width:220px; border-radius:5px; font-size:14px; padding:8px 24px 8px 24px; border:none;">
                <div class="bsml-form-list-submit" onclick="" style="">
                  <div id="bsmlStyle_comp_7_trans-form-blank-three4">
                    <a id="WD_RESERVE_SUBMIT_A" style="color:#000000; font-size:22px; border-radius:10px; background-color:#ffe864; color:#000000; width:60%; padding:5px 40px 5px 40px; position:relative; bottom:-30px; text-align:center; font-weight:bold;">立即领取</a>
                  </div>
                </div>
                <span class="image-text"></span>
              </div>
            </form>
          </div>
        </div>
      </section>
      <section id="frame-4" class="brick-frame brick-frame-server" style="padding-top:0;padding-bottom:0;padding-left:0;padding-right:0; display:none;">
        <div class="brick-mask"></div>
        <div class="brick-content" style="width:100%;">
          <div tetris-data-click="" tetris-data-component-type="image" tetris-data-action-type="click" class="piece image-con">
            <div class="image-box" style="-webkit-clip-path:none;">
              <a href="https://mp.weixin.qq.com/s/5eR8fbVMb_1essUYVNypDg" style="display:inline-block; background-color:#ffe864; border-radius:10px; padding:5px 48px 5px 48px; font-size:22px; margin-top:360px; font-weight:bold; color:#000000;">了解沪尚茗居最新活动</a>
              <span class="image-text"></span>
            </div>
          </div>
        </div>
      </section>  
    </main>
    <div id="DIALOG_WD_DIV" style="width:240px; height:240px; background-color:#ffffff; border-radius:15px;"> 
      <div class="bsml-form">
        <div style="padding-left:24px; padding-right:24px;">
          <div class="bsml-form-title" style="color:#9b026e;text-align:center; font-size:larger; margin-top: 28px; display:block;">正确答案是：</div>
          <div class="bsml-form-title" id="DIALOG_WD_TEXT_DIV" style="color:#9b026e;text-align:center; font-size:larger; margin-top: 28px;"></div>
          <div class="bsml-form-count" style="text-align:center;">&nbsp;</div>
          <table align="center" style="width:100%;">
            <tr>
              <td align="center"> 
                <div class="bsml-form-list-submit" onclick="dialogPresent.hide()" style="border-radius:10px; background-color:#9b026e; color:#ffffff; width:60%; padding:5px; position:relative; bottom:-30px;">
                  <div>
                    <b><font>再来一次</font></b>
                  </div>
                </div>
              </td>
            </tr>
          </table>  
          <div class="bsml-form-tips"></div>
        </div>
      </div>     
    </div>
  </body>
</html>
<script language="javascript" src="questions.js"></script>
<script language="javascript" type="text/javascript">
<!--//
var dialogPresent = new DIALOG("DIALOG_WD_DIV");
var q = getQuestions();
var time = 0;
var chooseText = ["A","B","C"];

$(document).ready(function(e) {
  $("#toQuestion").click(function(e) {
    loadQuestion();
    $("#wdbody").css("background-image", "url(images/background02.jpg)");
    $("#frame-1").css("display", "none");
    $("#frame-2").css("display", "block");
  });
  
  $(".qbtn").click(function(e) {
    $(this).parent().parent().find("div").css("opacity", "0");
    $(this).siblings("div").css("opacity", "0.4");
    if($(this).attr("value") != q[0].result){
      $("#DIALOG_WD_TEXT_DIV").text(chooseText[parseInt(q[0].result) - 1] + " " + q[0].choose[parseInt(q[0].result) - 1]);
      dialogPresent.show();
    }
    else{
      q.shift();
      loadQuestion();
    }
  });
});

function loadQuestion(){
  if(q.length > 0){
    $("#WD_QUESTION_H2").text(q[0].q);
    $("#WD_CHOOSES_DIV").css("font-size", q[0].fontSize);
    $("#WD_CHOOSES_DIV").find("div").css("opacity", "0");
    $("#WD_CHOOSE_A_A").text(q[0].choose[0]);
    $("#WD_CHOOSE_B_A").text(q[0].choose[1]);
    $("#WD_CHOOSE_C_A").text(q[0].choose[2]);
  }
  else{
    $("#wdbody").css("background-image", "url(images/background04.jpg)");
    $("#frame-2").css("display", "none");
    $("#frame-3").css("display", "block");
  }
}

$("#WD_RESERVE_SUBMIT_A").click(function(){
    var $name = $("#WD_RESERVE_NAME_TEXT").val();
	var $mobile = $("#WD_RESERVE_TEL_TEXT").val();
	if($name == ""){
		alert('请填写您的姓名');
		return false;
	}
  else if($mobile==""){
		alert('手机号不能为空');
		return false;
	}
  else if(!$mobile.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
		alert("手机号码格式不正确！");
		return false;
	};
   
  $.ajax({
		type: "POST",
		url: "dml_svr.php",
		data: $("#WD_RESERVE_FORM").serializeArray(),
		dataType: "json",                
		success: function(data) { 
			alert(data.TEXT);
            $("#wdbody").css("background-image", "url(images/background03.jpg)");
            $("#frame-3").css("display", "none");
            $("#frame-4").css("display", "block");
		},
		error: function(data) { 
			alert("信息提交成功！");
		},
	});
	return false;
});
//-->
</script>
<?php require_once('../bottom.inc');?>