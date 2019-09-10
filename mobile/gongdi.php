<?php
require_once('top.inc');
?>  
    <section>
      <div style="width:100%">
        <img class="topImg"  src="img/gongdi/banner01.jpg" alt="" style="width:100%;">
      </div>
    </section>
    <section style="text-align:center; margin-top:10px;">
      <div class="orderBox" style="background-color:#ffffff; width:100%; text-align:center; display:inline-block;">
        <div class="order" style="width:90%; display:inline-block;">
          <div style="width:100%; display:block; font-size:16px; text-align:center; padding-top:14px;">
            <h2>免费预约 快人一步</h2>
            <p style="margin-top:16px;">已有63人成功预约</p>
          </div>
          <form>
            <input type="hidden" name="type" value="gongdi"/>
            <input type="hidden" name="bultin" value="mobile/gongdi"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/calc_dialog/user_icon.jpg" style="width:28px;"></label>
              <input name="name" type="text" value="" placeholder="请输入姓名">
            </p>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/calc_dialog/phone_icon.jpg" style="width:28px;"></label>
              <input name="tel" type="tel" value="" placeholder="请输入手机号">
            </p>
            <p style="padding-top:18px;">
              <button id="MOBILE_GONGDI_BUTTON" style="background-color:#fe4b5b; border-color:#F2F2F2;">
                <span>立即预约</span>
              </button>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          $(document).ready(function(e) {
            $("#MOBILE_GONGDI_BUTTON").click(function(e) {
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