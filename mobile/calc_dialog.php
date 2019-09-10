<?php
require_once('top.inc');		
?>  
    <section>
      <div style="width:100%">
        <img class="topImg"  src="img/calc_dialog/banner01.jpg" alt="" style="width:100%;">
      </div>
    </section>
    <section style="text-align:center; margin-top:10px;">
      <div class="orderBox" style="background-color:#ffffff; width:100%; text-align:center; display:inline-block;">
        <div class="order" style="width:90%; display:inline-block;">
          <div style="width:100%; display:block; font-size:16px; text-align:center; padding-top:14px;">
            <h2>输入面积 一键报价</h2>
            <p style="margin-top:16px;"></p>
          </div>
          <div id="CALC_FORM_CALC_TOTAL" style="font-family:ledfont;background:#d5d1cd;font-size:3.333rem;border:0.027rem solid #777777;text-align:right;">000000</div>
          <form>
            <input type="hidden" name="type" value="calc"/>
            <input type="hidden" name="bultin" value="mobile/calc_dialog"/>
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
            <input type="hidden" name="url" value="<?php echo rawurlencode($_SERVER['HTTP_REFERER']);?>"/>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/calc_dialog/area_icon.jpg" style="width:28px;"></label>
              <input name="area" type="tel" value="" placeholder="建筑面积">
            </p>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/calc_dialog/user_icon.jpg" style="width:28px;"></label>
              <input name="name" type="text" value="" placeholder="请输入姓名">
            </p>
            <p style="margin-top:18px; text-align:center;">
              <label><img src="img/calc_dialog/phone_icon.jpg" style="width:28px;"></label>
              <input name="tel" type="tel" value="" placeholder="请输入手机号">
            </p>
            <p style="padding-top:18px;">
              <button id="MOBILE_CALC_DIALOD_BUTTON" style="background-color:#fe4b5b; border-color:#F2F2F2;">
                <span>立即获取报价</span>
              </button>
            </p>
          </form>
          <script type="text/javascript" language="javascript">
          <!--//
          var timerID;

          function showCalcNumbers(elmId,delay,count){
            if(!document.getElementById(elmId)){
              return false;
            }
            var count = !isNaN(count) && count > 0 ? count : 10;
            var delay = !isNaN(delay) && delay > 0 ? delay : 3000;
            var periode = Math.ceil(delay/6);
	        var i = 0;
            timerID = setInterval(showNumber, periode);
    
    
    
            function showNumber(){
              i = i > 5 ? 0 : i;
              var numbers = [3746, 6585, 36784, 74823, 167248, 222394];
              document.getElementById(elmId).innerHTML = numbers[i];
              i++;
            }
          } 
          
          function calculation(elmId,number,delay,count){
            if(!document.getElementById(elmId)){
              return false;
            }
            clearInterval(timerID);
            var count = !isNaN(count) && count > 0 ? count : 10;
            var delay = !isNaN(delay) && delay > 0 ? delay : 3000;
	        if(!isNaN(number) && number > 0){
              var tempNumber = 0;
              var restCount = count;
              var periode = Math.ceil(delay/count);      
              timerID = setInterval(rewrite, periode);      
	        }
            /*
            else if(number == -1){
              var i = 0;
              timerID = setInterval(showNumber, periode);
            }*/
    
            function rewrite(){
              if(restCount > 0){
                tempNumber = Math.ceil(number/restCount);
                document.getElementById(elmId).innerHTML = tempNumber;
                restCount--;
              }
              else{
                document.getElementById(elmId).innerHTML = number;
                clearInterval(timerID);
              }
            }
    
            function showNumber(){
              i = i > 5 ? 0 : i;
              var numbers = [3746, 6585, 36784, 74823, 167248, 222394];
              document.getElementById(elmId).innerHTML = numbers[i];
              i++;
            }
          }
          
          $(document).ready(function(e) {
            //showCalcNumbers("CALC_FORM_CALC_TOTAL", 2000, 10);
            $("#MOBILE_CALC_DIALOD_BUTTON").click(function(e) {
              var area = $(this).parent().prev().prev().prev().find("input").val();
              var name = $(this).parent().prev().prev().find("input").val();
              var tel = $(this).parent().prev().find("input").val();
              var form = $(this).parent().parent();
              if(area == "" || isNaN(parseInt(area)) || parseInt(area) < 10){
		        alert('建筑面积不正确');
		        return false;
	          }
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
                    calculation("CALC_FORM_CALC_TOTAL",data.DATA,2000,10);
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