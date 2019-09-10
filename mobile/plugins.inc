<?php
class PLUGIN{    
    public static $plugIns = array(
        // background-color, width, paddingTop, paddingBottom, type, bultin
        0 => array(
            'html' => '<div style="background-color:*background-color#; width:*width#; text-align:center; display:inline-block; margin:0px; padding:0px; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                        <div>
                          <form>
                            <input type="hidden" name="type" value="*type#"/>
                            <input type="hidden" name="bultin" value="*bultin#"/>
                            <input type="hidden" name="phpSelf" value="*phpSelf#"/>
                            <div style="margin-top:18px; display:block; height:36px;">
                              <img src="http://www.mingjugroup.com/mobile/img/packages/name_label.jpg" style="vertical-align:top; height:100%;"/>
                              <input name="name" type="text" value="" style="width:60%; height:90%; vertical-align:top; border:1px #000000 solid; font-size:16px; padding-left:5px;"/>
                            </div>
                            <div style="margin-top:18px; display:block; height:36px;">
                              <img src="http://www.mingjugroup.com/mobile/img/packages/phone_label.jpg" style="vertical-align:top; height:100%;"/>
                              <input name="tel" type="tel" value="" style="width:60%; height:90%; vertical-align:top; border:1px #000000 solid; font-size:16px; padding-left:5px;"/>
                            </div>
                            <p style="padding-top:18px; display:block;">
                              <a onClick="submit0($(this))"><img src="http://www.mingjugroup.com/mobile/img/packages/submit_button.jpg" style="width:85%;"></a>
                            </p>
                          </form>
                        </div>
                      </div>',
            'js' =>  '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit0(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().find("input").val();
                        var tel = buttonJQuery.parent().prev().find("input").val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
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
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置'),
            'defaultValue' => array('#FFFFFF', '95%', '20px', '20px', 'yuyue', ''),
            'position' => '',
            'type' => ''
        ), 
        // background-color, width, paddingTop, paddingBottom, head, type, bultin, placeholder, buttonString, buttonColor, buttonFontColor, paddingTop, paddingBottom
        1 => array(
            'html' => '<div style="background-color:*background-color#; width:*width#; text-align:center; display:inline-block; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="display:block; font-size:18px; font-weight:bold; text-align:center; padding-top:12px;">
                           *head#
                         </div>
                         <form>
                           <input type="hidden" name="type" value="*yuyue#"/>
                           <input type="hidden" name="bultin" value="*bultin#"/>
                           <input type="hidden" name="phpSelf" value="*phpSelf#"/>
                           <div style="margin-top:12px; display:block; height:48px; width:100%; border:1px #AAAAAA solid; border-radius:2px; text-align:left; vertical-align:bottom;">
                             <label for="mobile1" style="vertical-align:middle; display:inline-block; height:100%;">
                               <img src="http://www.mingjugroup.com/mobile/img/icons/phone.png" style="display:inline-block; vertical-align:middle; height:40%; margin-top:100%; margin-left:150%;">
                             </label>
                             <input name="tel" type="tel" value="" placeholder="*placeholder#" style="vertical-align:middle; height:60%; width:70%; margin-left:36px; border:none; border-left:1px #CCCCCC solid; padding-left:16px;">
                           </div>
                           <div style="padding-top:24px;">
                             <button onClick="submit1(buttonJQuery)" type="button" style="background-color:*buttonColor#; border-radius:5px; color:*buttonFontColor#; width:100%; border:none; height:48px; font-size:18px; font-weight:bold;">
                               *buttonString#
                             </button>
                           </div>
                         </form>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit1(buttonJQuery){
                        var tel = buttonJQuery.parent().prev().find("input").val();
                        var plugIn = buttonJQuery.parent().parent();                           
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",                
		                  success: function(data) { 
                            alert(data.TEXT);
                            reloadPage();
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！")
                            reloadPage();;
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'head', 'type', 'bultin', 'placeholder', 'buttonString', 'buttonColor', 'buttonFontColor'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '表单标题', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单预置文字', '按钮文字', '按钮颜色', '按钮文字颜色', '上边间距', '下边间距'),
            'defaultValue' => array('#FFFFFF', '95%', '20px', '20px', '免费预约设计咨询', 'yuyue', '', '请输入手机号', '立即申请', '#fe4b5b', '#FFFFFF'),
            'position' => '',
            'type' => ''
        ),
        // background-color, width, paddingTop, paddingBottom, head, type, bultin, placeholder_name, placeholder_tel, buttonString, buttonColor, buttonFontColor
        2 => array(
            'html' => '<div style="background-color:*background-color#; width:*width#; text-align:center; display:inline-block; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="display:block; font-size:18px; font-weight:bold; text-align:center; padding-top:12px;">
                           *head#
                         </div>
                         <form>
                           <input type="hidden" name="type" value="*yuyue#"/>
                           <input type="hidden" name="bultin" value="*bultin#"/>
                           <input type="hidden" name="phpSelf" value="*phpSelf#"/>
                           <div style="margin-top:12px; display:block; height:48px; width:100%; border:1px #AAAAAA solid; border-radius:2px; text-align:left; vertical-align:bottom;">
                             <label for="mobile1" style="vertical-align:middle; display:inline-block; height:100%;">
                               <img src="http://www.mingjugroup.com/mobile/img/icons/icon-name.png" style="display:inline-block; vertical-align:middle; height:70%; margin-top:20%; margin-left:20%;">
                             </label>
                             <input name="name" type="text" value="" placeholder="*placeholder_name#" style="vertical-align:middle; height:70%; width:70%; margin-left:12px; border:none; border-left:1px #CCCCCC solid; padding-left:16px;">
                           </div>
                           <div style="margin-top:12px; display:block; height:48px; width:100%; border:1px #AAAAAA solid; border-radius:2px; text-align:left; vertical-align:bottom;">
                             <label for="mobile1" style="vertical-align:middle; display:inline-block; height:100%;">
                               <img src="http://www.mingjugroup.com/mobile/img/icons/icon-phone.png" style="display:inline-block; vertical-align:middle; height:70%; margin-top:20%; margin-left:20%;">
                             </label>
                             <input name="tel" type="tel" value="" placeholder="*placeholder_tel#" style="vertical-align:middle; height:70%; width:70%; margin-left:12px; border:none; border-left:1px #CCCCCC solid; padding-left:16px;">
                           </div>
                           <div style="padding-top:24px;">
                             <button onClick="submit2(buttonJQuery)" type="button" style="background-color:*buttonColor#; border-radius:2px; color:*buttonFontColor#; width:100%; border:none; height:48px; font-size:18px; font-weight:bold;">
                               *buttonString#
                             </button>
                           </div>
                         </form>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit2(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().find("input").val();
                        var tel = buttonJQuery.parent().prev().find("input").val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
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
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'head', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '表单标题', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色'),
            'defaultValue' => array('#FFFFFF', '95%', '20px', '20px', '免费预约 快人一步', 'yuyue', '', '请输入您的姓名', '请输入您的手机号', '立即申请', '#fe4b5b', '#FFFFFF'),
            'position' => '',
            'type' => ''
        ),
        // background-color, width, paddingTop, paddingBottom, height, href, richText
        3 => array(
            'html' => '<div style="display:block; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="display:inline-block; width:*width#; background-color:*background-color#; text-align:left; height:*height#;">
                           *richText#
                         </div>
                       </div>',
            'js' => '',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'height', 'richText'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '表单高度', '文本编辑器'),
            'defaultValue' => array('#FFFFFF', '95%', '20px', '20px', '', ''),
            'position' => '',
            'type' => ''
        ),
        // id, background-color, width, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, buttonString, buttonColor, buttonFontColor, success_code
        4 => array(
            'html' => '<div id="*id#" style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:*background-color#; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <span style="display:block; text-align:left; font-size:12px; padding-bottom:5px;">参展地址：</span>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/> 
                             <div style="display:block; text-align:left; color:*textFontColor#"> 
                               <input type="radio" name="service" value="宝山店"/> <span style="font-size:14px;">宝山展</span>
                               <input type="radio" name="service" value="闵行店"/> <span style="font-size:14px;">闵行展</span>
                               <input type="radio" name="service" value="松江店"/> <span style="font-size:14px;">松江展</span>
                               <input type="radio" name="service" value="嘉定店"/> <span style="font-size:14px;">嘉定展</span>
                             </div>
                             <input name="name" type="text" placeholder="*placeholder_name#" style="font-size:16px; height:32px; display:inline-block; width:96%; border-radius:6px; border:1px solid #aaaaaa; margin-top:10px; padding-left:8px;" />
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="font-size:16px; height:32px; display:inline-block; width:96%; border-radius:6px; border:1px solid #aaaaaa; margin-top:10px; padding-left:8px;" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit4($(this));" type="button" style="width:100%; border-radius:6px; background-color:*buttonColor#; color:*buttonFontColor#; font-size:18px; height:40px; border:1px solid #aaaaaa;">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit4(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",        
		                  success: function(data) {
                            *success_code#
                            alert(data.TEXT);
                            reloadPage();
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor', 'success_code', 'textFontColor'),
            'columnDescript' => array('表单的ID', '表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色', '提交成功执行代码', '门店文字颜色'),
            'defaultValue' => array('', '#f4efeb', '90%', '20px', '20px', 'yuyue', '', '您的姓名（信息已加密，请放心填写）', '您的电话（信息已加密，请放心填写）', '免费领取门票', '#ffc412', '#000000', '', '#000000'),
            'position' => '',
            'type' => ''
        ),
        // background-color, width, paddingTop, paddingBottom, type, bultin, placeholder_tel, buttonString, buttonColor, buttonFontColor, success_code
        5 => array(
            'html' => '<div style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:*background-color#; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/>
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="width:96%; font-size:16px; height:32px; display:inline-block; border-radius:6px; border:1px solid #aaaaaa; margin-top:10px; padding-left:8px;" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit5($(this));" type="button" style="width:100%; border-radius:6px; background-color:*buttonColor#; color:*buttonFontColor#; font-size:18px; height:40px; border:1px solid #aaaaaa;">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit5(buttonJQuery){
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parent().parent();   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",          
		                  success: function(data) { 
                            *success_code#
                            alert(data.TEXT);
                            reloadPage();
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor', 'success_code'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色', '提交成功代码'),
            'defaultValue' => array('#f4efeb', '90%', '20px', '20px', 'yuyue', '', '您的电话（信息已加密，请放心填写）', '免费领取优惠', '#ffc412', '#000000', ''),
            'position' => '',
            'type' => ''
        ),
        // id, background-color, width, type, bultin, placeholder_name, placeholder_tel, buttonString, buttonColor, buttonFontColor
        6 => array(
            'html' => '<div id="*id#" style="z-index:120; width:*width#;">
                         <form>
                           <input type="hidden" name="type" value="*type#"/>
                           <input type="hidden" name="bultin" value="*bultin#"/>
                           <input type="hidden" name="phpSelf" value="*phpSelf#"/>  
                           <div style="text-align:center; display:inline-block; width:90%; border-radius:8px; background-color:*background-color#; padding:12px 16px 12px 16px;">
                             <span style="display:block; text-align:left; font-size:12px; padding-bottom:5px;">参展地址：</span>
                             <div style="display:block; text-align:left;"> 
                               <input type="radio" name="service" value="宝山店"/> <span style="font-size:12px;">宝山展</span>
                               <input type="radio" name="service" value="闵行店" checked="checked"/> <span style="font-size:12px;">闵行展</span>
                               <input type="radio" name="service" value="松江店"/> <span style="font-size:12px;">松江展</span>
                               <input type="radio" name="service" value="嘉定店"/> <span style="font-size:12px;">嘉定展</span>
                             </div>
                             <div style="display:block; text-align:center;">
                               <input name="name" type="text" placeholder="*placeholder_name#" style="display:inline-block; width:95%; font-size:14px; border-radius:6px; border:1px solid #aaaaaa; height:32px; padding-left:10px; background-color:#FFFFFF; margin-top:10px;" />
                               <input name="tel" type="tel" placeholder="*placeholder_tel#" style="display:inline-block; width:95%; font-size:14px; border-radius:6px; border:1px solid #aaaaaa; height:32px; padding-left:10px; background-color:#FFFFFF; margin-top:10px;" />                          
                               <div style="display:block; text-align:center; margin-top:16px;">
                                 <button onClick="submit6($(this));" type="button" style="width:100%; border-radius:6px; background-color:*buttonColor#; color:*buttonFontColor#; font-size:18px; height:40px; border:1px solid #aaaaaa;">*buttonString#</button>
                               </div>
                             </div>
                           </div>
                         </form>
                         <div style="display:block; text-align:center;">
                           <img onClick="closeDialog($(this).parent().parent().attr(\'id\'));" src="http://www.mingjugroup.com/mobile/img/icons/close.png" style="width:48px; margin-top:18px; cursor:pointer;"/>
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit6(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parents("form");
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
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
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background-color', 'width', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor'),
            'columnDescript' => array('弹框ID，同一页面中不要出现重复的ID', '表单的背景色', '表单宽度', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色'),
            'defaultValue' => array('', '#f4efeb', '90%', 'yuyue', '', '您的姓名（信息已加密，请放心填写）', '您的电话（信息已加密，请放心填写）', '免费领取门票', '#ffc412', '#000000'),
            'position' => '',
            'type' => 'dialog'
        ),
        // position, width, max-width, padding-bottom, height, background-color, font-color, font-size, left_string, left_href, left_onclick, right_string, right_href, right_onclick
        7 => array(
            'html' => '<section id="BOTTOM_BAR_7" style="background-color:rgba(0, 0, 0, 0); z-index:21; width:100%; text-align:center; display:block; *position#">
                         <div style="display:inline-block; max-width:*max-width#; width:*width#; margin:0px; padding-bottom:*padding-bottom#;">
                           <a style="background-color:*background-color#; color:*font-color#; font-size:*font-size#; width:48%; height:*height#; display:inline-block; text-align:center; padding-top:5px; border-radius:2px; cursor:pointer;">
                             <span>*left_string#</span>
                           </a>
                           <a style="background-color:*background-color#; color:*font-color#; font-size:*font-size#; width:48%; height:*height#; display:inline-block; text-align:center; padding-top:5px; border-radius:2px; cursor:pointer;">
                             <span>*right_string#</span>
                           </a>
                         </div>
                       </section>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      var initHeight = $(window).height();  //获取当前页面高度
                      if(window.location.href.indexOf("charisma") == -1){
                        $(window).resize(function () {
                          var thisHeight = $(this).height();
                          if ( initHeight - thisHeight > 100 ) {
                            $("#BOTTOM_BAR_7").hide();//键盘弹出
                          } 
                          else {
                            $("#BOTTOM_BAR_7").show();//键盘收起
                          }
                        });
                        $(document).on("focusin", function () {
　　                      $("#BOTTOM_BAR_7").hide(); //软键盘弹出的事件处理
                        });  
                        $(document).on("focusout", function () {
　　                      $("#BOTTOM_BAR_7").show(); //软键盘收起的事件处理
                        });
                      }
                      $(document).ready(function(e) {
                        var lHref = "*left_href#";
                        var rHref = "*right_href#";
                        if(lHref){
                          $("#BOTTOM_BAR_7").find("a").eq(0).attr("href", lHref);
                        }
                        if(rHref){
                          $("#BOTTOM_BAR_7").find("a").eq(1).attr("href", rHref);
                        }
                        $("#BOTTOM_BAR_7").find("a").eq(0).click(function(e) {
                          *left_onclick#
                        });
                        $("#BOTTOM_BAR_7").find("a").eq(1).click(function(e) {
                          *right_onclick#
                        });
                      });
                      //-->
                      </script>',
            'column' => array('position', 'width', 'max-width', 'padding-bottom', 'height', 'background-color', 'font-color', 'font-size', 'left_string', 'left_href', 'left_onclick', 'right_string', 'right_href', 'right_onclick'),
            'columnDescript' => array('悬浮框位置参数，底部悬浮一般为“position:fixed; bottom:0px;”', '悬浮框宽度', '最大宽度限制', '下边边距', '悬浮按钮高度', '悬浮按钮颜色', '按钮文字颜色', '按钮字体大小', '左侧按钮文字', '左侧按钮链接，如要直拨电话“tel:021-31599924”', '左侧按钮点击函数，如要调用弹框“openDialog("弹框ID")”', '左侧按钮文字', '右侧按钮链接，如要直拨电话“tel:021-31599924”', '右侧按钮点击函数，如要调用弹框“openDialog("弹框ID")”'),
            'defaultValue' => array('position:fixed; bottom:0px; left:0px;', '100%', '640px', '5px', '32px', '#FD6556', '#FFFFFF', '18px', '拨打电话', 'tel:021-31599924', '', '领取优惠', '', ''),
            'position' => 'position:relative; margin-top:180px;',
            'type' => 'bar'
        ),
        // background-color, width, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, buttonString, buttonColor, buttonFontColor
        8 => array(
            'html' => '<div style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:*background-color#; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/> 
                             <input name="name" type="text" placeholder="*placeholder_name#" style="font-size:16px; height:32px; display:inline-block; width:96%; border-radius:6px; border:1px solid #aaaaaa; margin-top:10px; padding-left:8px;" />
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="font-size:16px; height:32px; display:inline-block; width:96%; border-radius:6px; border:1px solid #aaaaaa; margin-top:10px; padding-left:8px;" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit8($(this));" type="button" style="width:100%; border-radius:6px; background-color:*buttonColor#; color:*buttonFontColor#; font-size:18px; height:40px; border:1px solid #aaaaaa;">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit8(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
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
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色'),
            'defaultValue' => array('#f4efeb', '90%', '20px', '20px', 'yuyue', '', '您的姓名（信息已加密，请放心填写）', '您的电话（信息已加密，请放心填写）', '免费领取门票', '#ffc412', '#000000'),
            'position' => '',
            'type' => ''
        ),
        // id, background-color, width, type, bultin, placeholder_name, placeholder_tel, buttonString, buttonColor, buttonFontColor, success_code
        9 => array(
            'html' => '<div id="*id#" style="z-index:120; width:*width#;">
                         <form>
                           <input type="hidden" name="type" value="*type#"/>
                           <input type="hidden" name="bultin" value="*bultin#"/>
                           <input type="hidden" name="phpSelf" value="*phpSelf#"/>  
                           <div style="text-align:center; display:inline-block; width:90%; border-radius:8px; background-color:*background-color#; padding:12px 16px 12px 16px;">
                             <div style="display:block; text-align:center;">
                               <input name="name" type="text" placeholder="*placeholder_name#" style="display:inline-block; width:95%; font-size:14px; border-radius:6px; border:1px solid #aaaaaa; height:32px; padding-left:10px; background-color:#FFFFFF; margin-top:10px;" />
                               <input name="tel" type="tel" placeholder="*placeholder_tel#" style="display:inline-block; width:95%; font-size:14px; border-radius:6px; border:1px solid #aaaaaa; height:32px; padding-left:10px; background-color:#FFFFFF; margin-top:10px;" />                          
                               <div style="display:block; text-align:center; margin-top:16px;">
                                 <button onClick="submit9($(this));" type="button" style="width:100%; border-radius:6px; background-color:*buttonColor#; color:*buttonFontColor#; font-size:18px; height:40px; border:1px solid #aaaaaa;">*buttonString#</button>
                               </div>
                             </div>
                           </div>
                         </form>
                         <div style="display:block; text-align:center;">
                           <img onClick="closeDialog($(this).parent().parent().attr(\'id\'));" src="http://www.mingjugroup.com/mobile/img/icons/close.png" style="width:36px; margin-top:36px; cursor:pointer;"/>
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit9(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parents("form");
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",                
		                  success: function(data) { 
                            *success_code#
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background-color', 'width', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'buttonString', 'buttonColor', 'buttonFontColor', 'success_code'),
            'columnDescript' => array('弹框ID，同一页面中不要出现重复的ID', '表单的背景色', '表单宽度', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '按钮文字', '按钮颜色', '按钮文字颜色', '提交成功JS脚本'),
            'defaultValue' => array('', '#f4efeb', '90%', 'yuyue', '', '您的姓名（信息已加密，请放心填写）', '您的电话（信息已加密，请放心填写）', '免费领取门票', '#ffc412', '#000000', 'alert(data.TEXT);reloadPage();'),
            'position' => '',
            'type' => 'dialog'
        ),
        // id, background-color, width, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, input_css, buttonString, button_css, success_code
        10 => array(
            'html' => '<div id="*id#" style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:*background-color#; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <span style="display:block; text-align:left; font-size:12px; padding-bottom:5px;">参展地址：</span>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/> 
                             <div style="display:block; text-align:left;"> 
                               <input type="radio" name="service" value="宝山店"/> <span style="font-size:14px;">宝山展</span>
                               <input type="radio" name="service" value="闵行店"/> <span style="font-size:14px;">闵行展</span>
                               <input type="radio" name="service" value="松江店"/> <span style="font-size:14px;">松江展</span>
                               <input type="radio" name="service" value="嘉定店"/> <span style="font-size:14px;">嘉定展</span>
                             </div>
                             <input name="name" type="text" placeholder="*placeholder_name#" style="*input_css#" />
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="*input_css#" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit10($(this));" type="button" style="*button_css#">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit10(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",        
		                  success: function(data) {
                            *success_code#
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'input_css', 'buttonString', 'button_css', 'success_code'),
            'columnDescript' => array('表单的ID', '表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '文本表单CSS样式', '按钮文本', '按钮CSS样式', '提交成功JS脚本'),
            'defaultValue' => array('', '#fafafa', '90%', '20px', '20px', 'yuyue', '', '您的姓名', '您的电话', 'font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;', '免费预约', 'width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;', 'alert(data.TEXT);reloadPage();'),
            'position' => '',
            'type' => ''
        ),
        // background-color, width, paddingTop, paddingBottom, type, bultin, placeholder_tel, input_css, buttonString, button_css, success_code
        11 => array(
            'html' => '<div style="width:100%; display:inline-block; padding:0px; margin:0px; background-color:*background-color#; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#;">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/>
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="*input_css#" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit11($(this));" type="button" style="*button_css#">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit11(buttonJQuery){
                        var tel = buttonJQuery.parent().prev().val();
                        var plugIn = buttonJQuery.parent().parent();   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",          
		                  success: function(data) {                            
                            *success_code#
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('background-color', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_tel', 'input_css', 'buttonString', 'button_css', 'success_code'),
            'columnDescript' => array('表单的背景色', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单电话栏预置文字', '文本表单CSS样式', '按钮文字', '按钮CSS样式', '提交成功JS脚本'),
            'defaultValue' => array('#fafafa', '90%', '20px', '20px', 'yuyue', '', '您的电话', 'font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;', '立即预约', 'width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;', 'alert(data.TEXT);reloadPage();'),
            'position' => '',
            'type' => ''
        ),
        // id, background_css, width, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, placeholder_address, input_css, buttonString, button_css, success_code
        12 => array(
            'html' => '<div id="*id#" style="width:100%; display:inline-block; padding:0px; margin:0px; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#; *background_css#">
                         <div style="width:*width#; display:inline-block;">
                           <form>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/> 
                             <input name="name" type="text" placeholder="*placeholder_name#" style="*input_css#" />
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="*input_css#" />
                             <input name="service" type="text" placeholder="*placeholder_address#" style="*input_css#" />
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit12($(this));" type="button" style="*button_css#">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit12(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().prev().val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",        
		                  success: function(data) {
                            *success_code#
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background_css', 'width', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'placeholder_address', 'input_css', 'buttonString', 'button_css', 'success_code'),
            'columnDescript' => array('表单的ID', '表单的背景CSS', '表单宽度', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '表单地址栏预置文字', '文本表单CSS样式', '按钮文本', '按钮CSS样式', '提交成功JS脚本'),
            'defaultValue' => array('', 'background-color:#fafafa;', '90%', '20px', '20px', 'yuyue', '', '您的姓名', '您的电话', '您的地址', 'font-size:16px; height:36px; display:inline-block; width:96%; border-radius:12px; border:1px solid #b41d2e; margin-top:10px; padding-left:8px;', '免费预约', 'width:100%; border-radius:12px; background-color:#b41d2e; color:#FFFFFF; font-size:18px; height:40px; border:none; font-weight:bold;', 'alert(data.TEXT);reloadPage();'),
            'position' => '',
            'type' => ''
        ),
        // id, background_css, form_css, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, placeholder_address, input_css, remark, remark_css, buttonString, button_css, success_code
        13 => array(
            'html' => '<div id="*id#" style="width:100%; display:inline-block; padding:0px; margin:0px; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#; *background_css#">
                         <div style="display:inline-block; *form_css#">
                           <form>
                             <input type="hidden" name="type" value="*type#"/>
                             <input type="hidden" name="bultin" value="*bultin#"/>
                             <input type="hidden" name="phpSelf" value="*phpSelf#"/> 
                             <input name="name" type="text" placeholder="*placeholder_name#" style="*input_css#" />
                             <input name="tel" type="text" placeholder="*placeholder_tel#" style="*input_css#" />
                             <input name="service" type="text" placeholder="*placeholder_address#" style="*input_css#" />
                             <div style="*remark_css#">*remark#</div>
                             <div style="display:block; text-align:center; margin-top:16px;">
                               <button onClick="submit13($(this));" type="button" style="*button_css#">*buttonString#</button>
                             </div>
                           </form> 
                         </div>
                       </div>',
            'js' => '<script type="text/javascript" language="javascript">
                      <!--//
                      function submit13(buttonJQuery){
                        var name = buttonJQuery.parent().prev().prev().prev().prev().val();
                        var tel = buttonJQuery.parent().prev().prev().prev().val();
                        var plugIn = buttonJQuery.parent().parent();
                        if(name == ""){
		                  alert("请填写您的姓名");
		                  return false;
	                    }   
                        if(tel == ""){
		                  alert("请填写您的电话号码");
		                  return false;
	                    }                       
                        var isPhone = /^([0-9]{3,4}-)?[0-9]{7,8}$/;
                        var isMob=/^((13[0-9])|(14[5,7,9])|(15[^4])|(18[0-9])|(17[0,1,3,5,6,7,8]))\d{8}$/;
                        if(!isPhone.test(tel) && !isMob.test(tel)){
		                  alert("电话号码格式不正确！");
		                  return false;
                        }
                        $.ajax({
		                  type: "POST",
		                  url: "dml_svr.php",
		                  data: plugIn.serializeArray(),
		                  dataType: "json",        
		                  success: function(data) {
                            *success_code#
		                  },
		                  error: function(data) { 
			                alert("信息提交成功！");
                            reloadPage();
		                  },
	                    });
	                    return false;
                      }
                      //-->
                      </script>',
            'column' => array('id', 'background_css', 'form_css', 'paddingTop', 'paddingBottom', 'type', 'bultin', 'placeholder_name', 'placeholder_tel', 'placeholder_address', 'input_css', 'remark', 'remark_css', 'buttonString', 'button_css', 'success_code'),
            'columnDescript' => array('表单的ID', '表单的背景CSS', '表单的CSS', '上边间距', '下边间距', '提交内容类型预约或计算器“yuyue或calc”', '容器名称，用于在后台辨识用户提交表单的具体位置', '表单姓名栏预置文字', '表单电话栏预置文字', '表单地址栏预置文字', '文本表单CSS样式', '附注信息', '附注信息CSS样式', '按钮文本', '按钮CSS样式', '提交成功JS脚本'),
            'defaultValue' => array('', 'background-color:#4d2a6c;', 'width:90%; background-color:#fffcf7; border-radius:12px; padding:20px 10px 20px 10px; box-shadow:#000 3px 3px 10px;', '20px', '20px', 'yuyue', '', '请输入姓名', '请输入手机号', '请输入售票地址，方便门票到家', 'font-size:14px; height:28px; display:inline-block; width:92%; border: none; border-bottom:1px solid #AAA; background-color:#fffcf7; margin-top:5px; margin-left:12px;', '请详细填写以上信息，我们将免费快递您价值66元的门票一张。', 'display:block; color:#b41d2e; font-size:10px; text-align:left; margin-left:20px; margin-top:4px;', '免费领取门票', 'width:75%; border-radius:16px; background-color:#c91b1d; color:#FFFFFF; font-size:18px; height:36px; border:none;', 'alert(data.TEXT);reloadPage();'),
            'position' => '',
            'type' => ''
        ),
        // background_css, form_css, paddingTop, paddingBottom, type, bultin, placeholder_name, placeholder_tel, placeholder_address, input_css, remark, remark_css, buttonString, button_css, success_code
        14 => array(
            'html' => '<div style="width:100%; display:inline-block; padding:0px; margin:0px; text-align:center; padding-top:*paddingTop#; padding-bottom:*paddingBottom#; *background_css#">
                         <div style="display:inline-block; *form_css#">
                           <button onClick="*onClick#" type="button" style="*button_css#">*buttonString#</button>
                         </div>
                       </div>',
            'js' => '',
            'column' => array('background_css', 'form_css', 'paddingTop', 'paddingBottom', 'onClick', 'buttonString', 'button_css'),
            'columnDescript' => array('表单的背景CSS', '表单的CSS', '上边间距', '下边间距', '点击事件', '按钮文本', '按钮CSS样式'),
            'defaultValue' => array('', 'width:100%; padding:100px 10px 100px 10px; box-shadow:#000 3px 3px 10px;', '20px', '20px', '', '免费领取门票', 'width:75%; border-radius:16px; background-color:#c91b1d; color:#FFFFFF; font-size:18px; height:36px; border:none;'),
            'position' => '',
            'type' => ''
        ),
    );
    
    public static function getPlugInsColumns(){
        $tmpArgArr = func_get_args();
        if (isset($tmpArgArr[0]) && is_int(intval($tmpArgArr[0])) && isset(self::$plugIns[intval($tmpArgArr[0])])) {
            return array('column' => self::$plugIns[intval($tmpArgArr[0])]['column'], 'columnDescript' => self::$plugIns[intval($tmpArgArr[0])]['columnDescript'], 'defaultValue' => self::$plugIns[intval($tmpArgArr[0])]['defaultValue']);
        }
        $array = array();
        foreach (self::$plugIns as $plugIn){
            $array[] = array('column' => $plugIn['column'], 'columnDescript' => $plugIn['columnDescript'], 'defaultValue' => $plugIn['defaultValue']);
        }
        return $array;
    }
    
    public static function getPlugInsHTMLs(){
        $tmpArgArr = func_get_args();
        if (isset($tmpArgArr[0]) && is_int(intval($tmpArgArr[0])) && isset(self::$plugIns[intval($tmpArgArr[0])])) {
            return self::$plugIns[intval($tmpArgArr[0])]['html'];
        }
        $array = array();
        foreach (self::$plugIns as $plugIn){
            $array[] = array('html' => $plugIn['html']);
        }
        return $array;
    }
    
    public static function getPlugInType(){
        $tmpArgArr = func_get_args();
        if (isset($tmpArgArr[0]) && is_int(intval($tmpArgArr[0])) && isset(self::$plugIns[intval($tmpArgArr[0])])) {
            return self::$plugIns[intval($tmpArgArr[0])]['type'];
        }
        $array = array();
        foreach (self::$plugIns as $plugIn){
            $array[] = array('type' => $plugIn['type']);
        }
        return $array;
    }
    
    public static function setPlugIn($dataArray, $plugInIndex){
        if (!$dataArray || !is_array($dataArray)) {
            return 'error1';
        }
        if (!isset(self::$plugIns[$plugInIndex])) {
            return 'error2';
        }
        $keys = array_keys($dataArray);
        $html = self::$plugIns[$plugInIndex]['html'] . self::$plugIns[$plugInIndex]['js'];
        foreach ($keys as $key) {
            if (strpos($html, '*' . $key . '#') !== false) {
                $html = str_replace('*' . $key . '#', $dataArray[$key], $html);
            }
        }
        if (strpos($html, '*phpSelf#') !== false) {
            $html = str_replace('*phpSelf#', $_SERVER['PHP_SELF'], $html);
        }
        return $html;
    }
}
?>
