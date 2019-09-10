<?php
require_once('top.inc');
$region = VCS::getRegionByIP();
$pictures = glob('img/promotions/*.*');
if (strpos($region['prov'], '福建') !== false) {
    echo '<script language="javascript" type="text/javascript">window.location="zz.html"</script>';
}
?>  
    <script type="text/javascript" language="javascript">
    <!--//
    console.log("<?php echo $region['prov'];?>");
    //-->
    </script>
    <?php
    for($i = 0; $i < count($pictures); $i++) {
    ?>
    <section>
      <div style="width:100%">
        <img class="topImg"  src="<?php echo $pictures[$i];?>" alt="" <?php echo ($i == count($pictures) - 1) ? 'usemap="#reservepic"' : '';?> style="width:100%;">
      </div>
    </section>
    <?php
    }
    ?>
    <map name="reservepic" id="reservepic">
      <area shape="rect" coords="127,312,242,334" onclick ="dialogReserve.show()" target ="_blank" alt="Sun" />
    </map>
    <div id="DIALOG_RESERVE_FORM_DIV" style="background-color:#FFFFFF; border-radius:10px; width:80%; height:240px; z-index:120;"> 
      <div style="height:40px;">
        <img src="../images/close.png" height="18px" width="18px" onclick="dialogReserve.hide();" style="float:right; margin-right: 18px; margin-top:10px;" />
      </div>
      <div>
        <form id="LOTTO_RESERVE_04_FORM" style="text-align:center;">
          <input type="hidden" name="type" value="yuyue"/>
          <input type="hidden" name="bultin" value="promotions_yuyue_dialog"/>
          <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/> 
          <input name="name" type="text" id="LOTTO_RESERVE_NAME_04_INPUT" placeholder="您的姓名（信息已加密，请放心填写）" style="font-size:22px; border-radius:8px; border:1px solid #aaaaaa; padding:8px 12px 10px 12px; margin-top:2px; width:90%;" />
          <input name="tel" type="tel" id="LOTTO_RESERVE_TEL_04_INPUT" placeholder="您的电话（信息已加密，请放心填写）" style="font-size:22px; border-radius:8px; border:1px solid #aaaaaa; padding:8px 12px 10px 12px; margin-top:8px; width:90%;" />
          <button style="border-radius:8px; width:90%; background-color:#F85959; color:#ffffff; font-size:22px; padding:5px; border:1px solid #cccccc; margin-top:16px;">立即预约</button>            
        </form>
      </div>
    </div>
    <script language="javascript" type="text/javascript">
    <!--//
    var dialogReserve = new DIALOG("DIALOG_RESERVE_FORM_DIV");
    $(document).ready(function() { 
      $("button").click(function(e) {
        var mobile = $(this).prev("input").val();
        var name = false;
        if($(this).prev("input").prev("input").attr("name") == "name"){
          var name = $(this).prev("input").prev("input").val();
        }
        if(name !== false && name == ""){
          alert('请填写您的姓名');
	      return false;
	    }
        if(mobile == ""){
	      alert('手机号不能为空');
	      return false;
	    }
        if(!mobile.match(/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/)){
		    alert("手机号码格式不正确！");
		    return false;
	    };
        $.ajax({
	      type: "POST",
	      url: "dml_svr.php",
	      data: $(this).parent("form").serializeArray(),
          dataType: "json",                
	      success: function(data) { 
            alert(data.TEXT);
	      },
	      error: function(data) { 
		    alert("信息提交成功！");
          }
	    });
	    return false;
      });
    });
    //-->
    </script>
<?php
require_once('bottom.inc');
?>