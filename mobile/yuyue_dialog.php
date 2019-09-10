<?php
require_once('top.inc');
?>  
    <section>
      <div style="width:100%">
        <img class="topImg"  src="img/yuyue_dialog/banner02.jpg" alt="" style="width:100%;">
      </div>
    </section>
    <section style="margin-top:-16px;">
      <div style="width:100%; background-color:#FAFAFA; margin-top:28px; padding:12px 4px 12px 24px;">
        <img src="img/yuyue_dialog/last_lingqu.jpg" style="width:28%; font-size:18px; font-weight:bold;">
        <div style="width:64%; font-size:12px; color:#808080; margin-left:16px; margin-top:-3px; display:inline-block;">沪尚茗居三周年庆，万元豪礼一元购！</div>
      </div>
    </section>
    <section style="text-align:center; margin-top:10px;">
      <div class="orderBox" style="background-color:#ffffff; width:100%; text-align:center; display:inline-block;">
        <div class="order" style="width:90%; display:inline-block;">
          <div style="width:100%; display:block; font-size:18px; font-weight:bold; text-align:center; padding-top:14px;">
            
          </div>
          <form>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="mobile/yuyue_dialog"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <input type="hidden" name="url" value="<?php echo rawurlencode($_SERVER['HTTP_REFERER']);?>"/>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/yuyue_dialog/user_icon.jpg" style="width:28px;"></label>
              <input name="name" type="text" value="" placeholder="请输入姓名">
            </p>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/yuyue_dialog/phone_icon.jpg" style="width:28px;"></label>
              <input name="tel" type="tel" value="" placeholder="请输入手机号">
            </p>
            <p style="padding-top:18px;">
              <button id="MOBILE_YUYUE_DIALOD_BUTTON" style="background-color:#fe4b5b; border-color:#F2F2F2;">
                <span>立即领取</span>
              </button>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          $(document).ready(function(e) {
            $("#MOBILE_YUYUE_DIALOD_BUTTON").click(function(e) {
              var name = $(this).parent().prev().prev().find("input").val();
              var tel = $(this).parent().prev().find("input").val();
              var form = $(this).parent().parent();
              if(name == ""){
		        alert('请填写您的姓名');
		        return false;
	          }
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
<?php
require_once('bottom.inc');
?>