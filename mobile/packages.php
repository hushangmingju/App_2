<?php
require_once('top.inc');
$index= $_GET['i'];
$pictures = glob('img/packages/' . $index . '/*.jpg');
?>  
    <?php
    for ($i = 0; $i < count($pictures); $i++) {
        if ($i == 3) {
    ?>
    <section style="text-align:center;">
      <div class="orderBox" style="background-color:#ffffff; width:90%; text-align:center; display:inline-block;">
        <div class="order">
          <div style="width:100%; display:block; font-size:18px; font-weight:bold; text-align:center; padding-top:12px;">
            预约免费设计咨询
          </div>
          <form>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="mobile/packages_yuyue_01"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <p class="phone" style="margin-top:12px;">
              <label for="mobile1"><img src="img/icons/phone.png"></label>
              <input name="tel" type="tel" value="" placeholder="请输入手机号">
            </p>
            <p style="padding-top:12px;">
              <button id="MOBILE_PACKAGES_YUYUE_01_bUTTON" style="background-color:#fe4b5b; border-radius:5px;">
                <span>立即申请</span>
              </button>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          $(document).ready(function(e) {
            $("#MOBILE_PACKAGES_YUYUE_01_bUTTON").click(function(e) {
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
          <p></p>
        </div>
      </div>
    </section>
    <?php
        }
    ?>
    <section>
      <div style="width:100%">
        <img class="topImg"  src="<?php echo $pictures[$i];?>" alt="" style="width:100%;">
      </div>
    </section>    
    <?php
    }
    ?>    
    <section style="text-align:center;">
      <div style="background-color:#ffffff; width:90%; text-align:center; display:inline-block;">
        <div class="order1">
          <form>
            <input type="hidden" name="type" value="yuyue"/>
            <input type="hidden" name="bultin" value="mobile/packages_yuyue_02"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <p style="margin-top:18px;">
              <img src="img/packages/name_label.jpg" style="width:30%;">
              <input name="name" type="text" value="" style="width:60%; height:">
            </p>
            <p style="margin-top:18px;">
              <img src="img/packages/phone_label.jpg" style="width:30%;">
              <input name="tel" type="tel" value="" style="width:60%;">
            </p>
            <p style="padding-top:18px;">
              <a id="MOBILE_PACKAGES_YUYUE_02_A"><img src="img/packages/submit_button.jpg" style="width:80%;"></a>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          $(document).ready(function(e) {
            $("#MOBILE_PACKAGES_YUYUE_02_A").click(function(e) {
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
    <section>
      <div style="width:100%; margin-top:32px;">
        <img class="topImg"  src="img/packages/bottom01.jpg" alt="" style="width:100%;">
      </div>
    </section> 
<?php
require_once('bottom.inc');
?>