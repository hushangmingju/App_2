    <?php
    if(strpos($_SERVER['PHP_SELF'], 'dialog') === false && strpos($_SERVER['PHP_SELF'], 'gongdi') === false){
    ?>
    <section style="width:100%; padding:0px 0px 0px 0px; background-color:rgba(0, 0, 0, 0); left:0; bottom:0; position:fixed; z-index:100; top:auto; text-align:center;">
      <div style="width:100%; background-color:#4C4C4C; max-width:800px; display:inline-block; text-align:left;">
        <a href="yuyue_dialog.html" style="width:49%; height:48px; display:inline-block;">
          <img src="img/top/zhuangxiu_button.jpg" style="height:100%;">
          <span style="color:#FFF; font-size:14px; padding-left:10px;"><font style="color:#FF6600;">抢</font>免费装修设计</span>
        </a>
        <a href="calc_dialog.html" style="width:49%; height:48px; display:inline-block;">
          <img src="img/top/jisuan_button.jpg" style="height:100%;">
          <span style="color:#FFF; font-size:14px; padding-left:10px;">装修费用计算</span>
        </a>
      </div>
    </section>
    <?php
    }
    ?>
    <section>
      <div style="height:24px;; text-align:center; background-color:#FFFFFF;">
      </div>
    </section>    
<!-- CNZZ 代码 -->
<script src="https://s22.cnzz.com/z_stat.php?id=1275086047&web_id=1275086047" language="JavaScript"></script> 
    <div id="GEO_LOCATION" style="display:none;"></div>
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
$(document).ready(function(e){
  $("#TOP_MENU_BUTTON").click(function(e){
    if(!document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
      addBackgroundShadow(e);
    }
    else{
      removeBackgroundShadow();
    }
    $("#TOP_MENU").slideToggle();
    if($(this).attr("src").indexOf("close") > 0){
      $(this).attr("src", "img/top/menu_button.jpg");
    }
    else{
      $(this).attr("src", "img/top/menu_close_button.jpg");
    }
  });
});    
//-->
</script>

<script language="javascript" type="text/javascript">
<!--//
<?php
if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
?>
getRegion();
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();}};
<?php
}
?>
//-->
</script>