<?php require('wcp_head.inc'); ?>
<?php
$shops = new Query("*", "`tb_wcp_shops`", "", "`status` > 0", "`ordnung`, `id`");
$shops = DAS::quickQuery($shops);
$shops = DAS::hasData($shops) ? $shops['data'] : false;
if ($shops) {
    $cities = new Query("`city`", "`tb_wcp_shops`", "", "`status` > 0", "", "`city`");
    $cities = DAS::quickQuery($cities);
    $cities = DAS::hasData($cities) ? $cities['data'] : false;
}
$covers = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = -3 AND `component` LIKE 'shop%cover'");
$covers = DAS::quickQuery($covers);
$covers = DAS::hasData($covers) ? $covers['data'] : false;
?>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <!-- 门店管理栏 START -->
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2 style="display:inline-block;"><i class="glyphicon glyphicon-th-large"></i> 门店管理</h2>
                  <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以管理门店信息或添加新门店。</span>
                </div>
                <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px;">                  
                  <?php
                  if ($shops) {
                  ?>
                  <ul class="nav nav-tabs" id="myTab">
                  <?php
                      for ($i = 0; $i < count($cities); $i++) {
                  ?>
                    <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:-2px;"><a href="#city_<?php echo $i;?>"><?php echo $cities[$i]['city'];?></a></li>
                  <?php
                      }
                  ?>                  
                  </ul>
                  <div id="myTabContent" class="tab-content">
                  <?php
                      for ($i = 0; $i < count($cities); $i++) {
                  ?>
                    <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="city_<?php echo $i;?>">
                    <?php
                          foreach ($shops as $shop) {
                              if ($shop['city'] == $cities[$i]['city']) {
                                  $shopCover = false;
                                  foreach ($covers as $cover) {
                                      if ($cover['showroomShop'] == $shop['id']) {
                                          $shopCover = $cover;
                                      }
                                  }
                      ?>
                      <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                        <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                          <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                            <a class="icon_button" onClick="deleteShop(<?php echo $shop['id'];?>, '<?php echo $shop['city'];?>');" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                            <a class="icon_button" onClick="setShop($('#SHOP_DIALOG_DIV').find('form'), <?php echo $shop['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                            <a class="icon_button" onClick="setCover(<?php echo $shop['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-picture" title="封面"></i></a>
                            <?php
                                if ($shop['ordnung'] < count($shops)) {
                            ?>
                            <a class="icon_button" onClick="moveNextShop(<?php echo $shop['id'];?>, '<?php echo $shop['city'];?>');" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                            <?php
                                }
                                if ($shop['ordnung'] > 1) {
                            ?>
                            <a class="icon_button" onClick="movePrevShop(<?php echo $shop['id'];?>, '<?php echo $shop['city'];?>');" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                            <?php
                                }
                            ?>
                          </div>
                        </div>
                        <?php
                                if ($shopCover) {
                                    $coverFile = $shopCover['folderName'] . '/' . $shopCover['fileName'];
                                }
                                else {
                                    $coverFile = "http://www.mingjugroup.com/charisma/img/wcp/empty_cover.jpg";
                                }
                        ?>
                        <img src="<?php echo $coverFile;?>" style="width:320px; height:240px;">
                        <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;">
                          <span style="display:block; font-size:16px; font-weight:bolder;"><?php echo $shop['city'];?>，<?php echo $shop['name'];?></span>
                          <span style="display:block; font-size:12px;">更新时间：<?php echo $shop['timestamp'];?></span>
                        </div>
                      </div>
                      <?php
                              }
                          }
                    ?>
                      <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                        <a onClick="addShop($('#SHOP_DIALOG_DIV').find('form'));" style="cursor:pointer;">
                          <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加门店</div>
                          <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                            <span style="display:block; font-size:16px; font-weight:bolder;">&nbsp;</span>
                            <span style="display:block; font-size:12px;">&nbsp;</span>
                          </div>                          
                        </a>
                      </div>
                    </div>
                  <?php
                      }
                  ?>
                  </div>
                  <?php                  
                  }
                  else {
                  ?>
                  <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                    <a onClick="addShop($('#SHOP_DIALOG_DIV').find('form'));" style="cursor:pointer;">
                      <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加门店</div>
                      <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                      <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                        <span style="display:block; font-size:16px; font-weight:bolder;">&nbsp;</span>
                        <span style="display:block; font-size:12px;">&nbsp;</span>
                      </div>                          
                    </a>
                  </div>
                  <?php 
                  }
                  ?>
                </div>
              </div>                                
            </div>
          </div>
          <!-- #门店管理栏 END -->
          <!-- SHOP_DIALOG_DIV 添加设置门店对话框 -->
          <div id="SHOP_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:860px; padding:00px 0px 20px 0px; overflow:hidden;">
            <form>
              <input type="hidden" name="action" value="add_shop"/>
              <input type="hidden" name="id" value=""/>
              <div style="display:block; text-align:center;">
                <h2 style="color:#35a6e7;">添加门店</h2>
              </div>
              <div style="width:100%; box-shadow:#888888 0px 3px 10px;"> 
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">门店名称：</span>
                      <input type="text" name="name" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">所在省（市）：</span>
                      <input type="text" name="city" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                    </div>                            
                  </div>
                </div>                
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">状态：</span>
                  </div>
                  <input type="radio" name="status" value="1" checked="checked" style="margin-left:20px;"/> 正常
                  <input type="radio" name="status" value="2" style="margin-left:20px;"/> 筹备中
                  <input type="radio" name="status" value="3" style="margin-left:20px;"/> 试营业
                  <input type="radio" name="status" value="4" style="margin-left:20px;"/> 休息
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">工商注册名：</span><span>（选填）</span>
                  </div>
                  <input type="text" name="company" value="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">门店地址：</span><span>（选填）</span>
                  </div>
                  <input type="text" name="address" value="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">门店电话：</span><span>多个电话间请用“,”分隔。（选填）</span>
                  </div>
                  <input type="text" name="tel" value="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">地理坐标：</span><span>格式为 经度, 维度，如：121.425369,31.08139（选填）</span>
                  </div>
                  <input type="text" name="coordinates" value="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <div style="display:block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">门店介绍：</span>
                    <span>样板间介绍将会显示在样板间页面以及meta标签description属性中。（选填）</span>
                  </div>
                  <textarea name="content" value="" style="width:100%; height:80px; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"></textarea>
                </div>                    
                <div style="display:block; margin-top:20px; height:20px;">
                </div>
              </div> 
              <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                <button type="button" onClick="" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>
                <button type="button" onClick="dialogShop.hide();" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF; margin-left:24px;">取消</button>
              </div>
            </form>
          </div>  

<script type="text/javascript" language="javascript">
<!--//
var dialogShop = new DIALOG("SHOP_DIALOG_DIV");
var shops = <?php echo ($shops ? json_encode($shops) : 'false');?>;
var covers = <?php echo ($covers ? json_encode($covers) : 'false');?>;

// addShop(formJQuery) 添加门店，formJQuery为对话框表单所属form标签的JQuery对象
function addShop(formJQuery){
  formJQuery.find("h2").text("添加门店");
  formJQuery.find("input").eq(0).val("add_shop");
  formJQuery.find("input").eq(1).val("");
  formJQuery.find("input").eq(2).val("");
  formJQuery.find("input").eq(3).val("");
  formJQuery.find("input").eq(4).attr("checked", "checked");
  formJQuery.find("input").eq(8).val("");
  formJQuery.find("input").eq(9).val("");
  formJQuery.find("input").eq(10).val("");
  formJQuery.find("input").eq(11).val("");
  formJQuery.find("textarea").val("");
  formJQuery.find("textarea").text("");
  formJQuery.find("button").eq(0).unbind();
  formJQuery.find("button").eq(0).click(function(e) {
    var status = true;
    $(this).parents("form").find("input").each(function(index, element) {
      if($(this).attr("name") == "name" && !$(this).val()){
        alert("门店名称不能为空。");
        status = false;
        return false;
      }
      if($(this).attr("name") == "city" && !$(this).val()){
        alert("所在城市不能为空。");
        status = false;
        return false;
      }    
    });
    if(!status){
      return false;
    }
    $.ajax({
      url: "wcp_svr.html",
      type: "POST",
      data: formJQuery.serializeArray(),
      dataType: "json",
      success: function(data) { 
        alert(data.TEXT);
        reloadPage();
      },
      error: function(data) { 
	    alert("网络错误，请重试，如果仍无法解决请联系管理员。");
      },
    });
  });
  dialogShop.show();
}
// setShop(formJQuery, id) 编辑门店，formJQuery为对话框表单所属form标签的JQuery对象，id为门店ID
function setShop(formJQuery, id){
  if(!id || isNaN(parseInt(id)) || parseInt(id) < 1){
    return false;
  }
  var shop = false;
  for(var i = 0; i < shops.length; i++){
    if(id == shops[i].id){
      shop = shops[i];
    }
  }
  if(!shop){
    return false;
  }
  formJQuery.find("h2").text("编辑门店");
  formJQuery.find("input").eq(0).val("set_shop");
  formJQuery.find("input").eq(1).val(shop.id);
  formJQuery.find("input").eq(2).val(shop.name);
  formJQuery.find("input").eq(3).val(shop.city);
  for(var i = 4; i < 8; i++){
    if(formJQuery.find("input").eq(i).val() == shop.status){
      formJQuery.find("input").eq(i).attr("checked", "checked");
    }
  }
  formJQuery.find("input").eq(8).val(shop.company);
  formJQuery.find("input").eq(9).val(shop.address);
  formJQuery.find("input").eq(10).val(shop.tel);
  formJQuery.find("input").eq(11).val(shop.coordinates);
  formJQuery.find("textarea").val(shop.content);
  formJQuery.find("textarea").text(shop.content);  
  formJQuery.find("button").eq(0).unbind();
  formJQuery.find("button").eq(0).click(function(e) {
    var status = true;
    $(this).parents("form").find("input").each(function(index, element) {
      if($(this).attr("name") == "name" && !$(this).val()){
        alert("门店名称不能为空。");
        status = false;
        return false;
      }
      if($(this).attr("name") == "city" && !$(this).val()){
        alert("所在城市不能为空。");
        status = false;
        return false;
      }    
    });
    if(!status){
      return false;
    }
    $.ajax({
      url: "wcp_svr.html",
      type: "POST",
      data: formJQuery.serializeArray(),
      dataType: "json",
      success: function(data) { 
        alert(data.TEXT);
        reloadPage();
      },
      error: function(data) { 
	    alert("网络错误，请重试，如果仍无法解决请联系管理员。");
      },
    });
  });
  dialogShop.show();
}
// setCover(id) 设置门店封面
function setCover(id){
  if(!id){
    return false;
  }
  var shop = false;
  for(var i = 0; i < shops.length; i++){
    if(id == shops[i].id){
      shop = shops[i];
    }
  }
  if(!shop){
    return false;
  }
  var formJQuery = $("#IMG_FORM");  
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("shop_" + shop.id + "_cover");
  // 设置folder
  formJQuery.children("input").eq(3).val("shops");
  // 设置descript
  formJQuery.children("input").eq(4).val(shop.city + shop.name + "封面图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("shop");
  // 设置showroomShop
  formJQuery.children("input").eq(6).val("");
  // 设置showroomShop
  formJQuery.children("input").eq(7).val(shop.id);
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加" + shop.city + shop.name + "封面图片" + ":");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为640x480px或同比例扩大，文件小于512KB的.jpg或.png格式图片。"); 
  // 清空预览图片  
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html("");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 隐藏href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 清空head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true);
  // 清空content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), true);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 清空图片路径信息
  formJQuery.find("input#IMG_PATH").val("");
  // 清空图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("");
  for(var i = 0; i < covers.length; i++){
    if(covers[i].showroomShop == id){
      // 设置ID
      formJQuery.children("input").eq(0).val(covers[i].id);
      // 设置action
      formJQuery.children("input").eq(1).val("set_image");
      // 设置component
      formJQuery.children("input").eq(2).val("shop_" + shop.id + "_cover");
      // 设置folder
      formJQuery.children("input").eq(3).val("shops");
      // 设置descript
      formJQuery.children("input").eq(4).val(shop.city + shop.name + "封面图片");
      // 设置pageFile
      formJQuery.children("input").eq(5).val("shop");
      // 设置showroomShop
      formJQuery.children("input").eq(6).val(shop.id);
      // 设置对话框标题
      formJQuery.find("div.DialogTitle").text("设置" + shop.city + shop.name + "封面图片" + ":");
      // 清空临时文件路径
      formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
      // 清空临时文件ID
      formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
      // 设置预览图片框尺寸
      formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
      // 设置预览文件信息
      formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + covers[i].fileName.substring(covers[i].fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(covers[i].size/10)/100 + "KB 图片尺寸：" + covers[i].width + " x " + covers[i].height + "px");
      // 设置图片上传要求
      formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为640x480px或同比例扩大，文件小于512KB的.jpg或.png格式图片。"); 
      // 设置预览图片  
      var picPreviewDimen = fixImgSize(covers[i].width, covers[i].height, 400, 300);
      var picPreviewHtml = "<img src='" + covers[i].folderName + "/" + covers[i].fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";
      formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
      // ---------------------------------------------------- 分界线 -------------------------------------------------------------
      // 设置对话框右侧文本信息栏
      var contentsJQuery = formJQuery.children("div").eq(2);
      // 设置alt信息
      setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, covers[i].alt);
      // 隐藏title表单栏
      setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
      // 隐藏href信息
      setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
      // 设置head信息
      setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, covers[i].head);
      // 设置content信息
      setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), true, covers[i].content);
      // 隐藏css信息
      setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
      
      // ---------------------------------------------------- 分界线 -------------------------------------------------------------
      // 设置图片路径信息
      formJQuery.find("input#IMG_PATH").val((covers[i].folderName + "/" + covers[i].fileName).substring(27));
      // 设置图片路径信息（隐藏）
      formJQuery.find("input#IMG_PATH_HIDDEN").val((covers[i].folderName + "/" + covers[i].fileName).substring(27));
    }
  } 
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogShopCoversList.show(e, loadImgListWidget("SHOPCOVERS_LIST_DIALOG_DIV"));
  });
  // 设置表单提交按钮函数
  formJQuery.find("button#IMG_SUBMIT_BUTTON").unbind();
  formJQuery.find("button#IMG_SUBMIT_BUTTON").click(function(e) {
    $.ajax({
      url: "wcp_svr.html",
      type: "POST",
      data: $(this).parents("form").serializeArray(),
      dataType: "json",
      success: function(data) { 
        alert(data.TEXT);
        reloadPage();
      },
      error: function(data) { 
	    alert("网络错误，请重试，如果仍无法解决请联系管理员。");
      },
    });
  });
  // 显示图片设置对话框
  dialogImg.show();
}
// 前移门店
function movePrevShop(id, city){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_shop", "id": id, "city": city},
    dataType: "json",
    success: function(data) { 
      alert(data.TEXT);
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// 后移门店
function moveNextShop(id, city){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_shop", "id": id, "city": city},
    dataType: "json",
    success: function(data) { 
      alert(data.TEXT);
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// 删除门店
function deleteShop(id, city){
  if(!confirm("确定要删除此门店吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_shop", "id": id, "city": city},
    dataType: "json",
    success: function(data) { 
      alert(data.TEXT);
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}

$(document).ready(function(e) {
  $("img").mouseover(function(e) {
    $(this).prev("div").slideDown("slow");
  });
  $(".button_bar").mouseleave(function(e) {
    $(this).fadeOut("slow");
  });
});
//-->
</script>
<?php require('wcp_bottom.inc'); ?>