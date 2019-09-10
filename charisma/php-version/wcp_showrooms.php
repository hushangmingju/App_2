<?php require('wcp_head.inc'); ?>
<?php
$showrooms = new Query("`t1`.*, `t2`.`name` AS shopName", "`tb_wcp_showrooms` AS `t1`", "LEFT JOIN `tb_wcp_shops` AS `t2` ON `t1`.`shop` = `t2`.`id`", "`t1`.`status` > 0", "`t1`.`ordnung`, `t1`.`numberNew`");
$showrooms = DAS::quickQuery($showrooms);
$showrooms = DAS::hasData($showrooms) ? $showrooms['data'] : false;

$shops = new Query("`id`, `name`", "`tb_wcp_shops`", "", "`status` > 0", "`city`, `ordnung`");
$shops = DAS::quickQuery($shops);
$shops = DAS::hasData($shops) ? $shops['data'] : false;

$covers = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = -2 AND `component` LIKE 'sr%cover'");
$covers = DAS::quickQuery($covers);
$covers = DAS::hasData($covers) ? $covers['data'] : false;

$reserves = new Query("`showroomID`, COUNT(*) as `reserveCount`", "`tb_mingju_reserves`", "", "`status` = 'ok'", "`showroomID`", "`showroomID`");
$reserves = DAS::quickQuery($reserves);
$reserves = DAS::hasData($reserves) ? $reserves['data'] : false;


for ($i = 0; $i < count($showrooms); $i++) {
    foreach ($reserves as $reserve) {
        if ($showrooms[$i]['id'] == $reserve['showroomID']) {
            $showrooms[$i]['reserveCount'] = $reserve['reserveCount'];
        }
    }
}
?>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <!-- 样板间管理栏 START -->
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2 style="display:inline-block;"><i class="glyphicon glyphicon-th-large"></i> 样板间管理</h2>
                  <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以浏览样板间、进入样板间编辑器、或添加新样板间。</span>
                </div>
                <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px;">
                  <ul class="nav nav-tabs" id="myTab">
                  <?php
                  for ($i = 0; $i < count($shops); $i++) {
                  ?>
                    <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:-2px;"><a href="#shop_<?php echo $shops[$i]['id'];?>"><?php echo $shops[$i]['name'];?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
                  <div id="myTabContent" class="tab-content">
                  <?php
                  for ($i = 0; $i < count($shops); $i++) {
                  ?>
                    <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="shop_<?php echo $shops[$i]['id'];?>">
                    <?php
                      if ($showrooms) {
                          foreach ($showrooms as $showroom) {
                              if ($showroom['shop'] == $shops[$i]['id']) {
                                  $showroomCover = false;
                                  foreach ($covers as $cover) {
                                      if ($cover['showroomNum'] == $showroom['number'] && $cover['showroomShop'] == $showroom['shop']) {
                                          $showroomCover = $cover;
                                      }
                                  }
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                            <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                              <span style="float:left; display:inline-block; color:#FFFFFF; font-size:20px; font-weight:bolder;">ID: <?php echo $showroom['id'];?></span>
                              <a class="icon_button" onClick="deleteShowroom(<?php echo $showroom['id'];?>, <?php echo $showroom['shop'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                              <a class="icon_button" onClick="changeVisibility(<?php echo $showroom['id'];?>, $(this))" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="<?php echo $showroom['status'] == 1 ? 'glyphicon glyphicon-eye-open' : 'glyphicon glyphicon-eye-close';?>" title="显示状态"></i></a>
                              <a class="icon_button" onClick="changeToTop(<?php echo $showroom['id'];?>, $(this))" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="<?php echo $showroom['toTop'] == 1 ? 'glyphicon glyphicon-download' : 'glyphicon glyphicon-upload';?>" title="置顶状态"></i></a>
                              <a class="icon_button" href="wcp_showroom.html?id=<?php echo $showroom['id'];?>" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                            <?php
                                if ($showroom['ordnung'] < count($showrooms)) {
                            ?>
                              <a class="icon_button" onClick="moveNextShowroom(<?php echo $showroom['id'];?>, <?php echo $showroom['shop'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                            <?php
                                }
                                if ($showroom['ordnung'] > 1) {
                            ?>
                              <a class="icon_button" onClick="movePrevShowroom(<?php echo $showroom['id'];?>, <?php echo $showroom['shop'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                            <?php
                                }
                            ?>
                            </div>
                          </div>
                          <?php
                                if ($showroomCover) {
                                    $coverFile = $showroomCover['folderName'] . '/' . $showroomCover['fileName'];
                                }
                                else {
                                    $coverFile = "http://www.mingjugroup.com/charisma/img/wcp/empty_cover.jpg";
                                }
                          ?>
                          <img <?php echo $showroom['status'] == 2 ? 'class="gray"' : '';?> src="<?php echo $coverFile;?>" style="width:320px; height:240px;">
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;">
                            <span style="display:block; font-size:16px; font-weight:bolder;"><?php echo $showroom['name'];?>，<?php echo $showroom['shopName'];?>，<?php echo $showroom['numberNew'];?>号样板间</span>
                            <span style="display:block; font-size:12px;">浏览量：<?php echo $showroom['visitCount'];?>;&nbsp;&nbsp;&nbsp;&nbsp;预约量：<?php echo $showroom['reserveCount'];?></span>
                            <span style="display:block; font-size:12px;">更新时间：<?php echo $showroom['timestamp'];?></span>
                          </div>
                        </div> 
                        <?php                        
                              }
                          }
                      }
                  ?> 
                      <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                        <a onClick="openAddShowroom($('#ADD_SHOWROOM_DIALOG_DIV').find('form'), <?php echo $shops[$i]['id'];?>);" style="cursor:pointer;">
                          <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加样板间</div>
                          <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                            <span style="display:block; font-size:16px; font-weight:bolder;">&nbsp;</span>
                            <span style="display:block; font-size:12px;">&nbsp;</span>
                            <span style="display:block; font-size:12px;">&nbsp;</span>
                          </div>                          
                        </a>
                      </div>  
                    </div>
                  <?php
                  }
                  ?>
                  </div>
                </div>
              </div>                                
            </div>
          </div>
          <!-- #样板间管理栏 END -->
          <!-- #ADD_SHOWROOM_DIALOG_DIV 添加新样板间对话框 -->
          <div id="ADD_SHOWROOM_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:800px; padding:00px 0px 20px 0px; overflow:hidden;">
            <form>
              <input type="hidden" name="action" value="add_showroom"/>
              <input type="hidden" name="shop" value=""/>
              <div style="display:block; text-align:center;">
                <h2 style="color:#35a6e7;"></h2>
              </div>
              <div style="width:100%; box-shadow:#888888 0px 3px 10px;"> 
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间编号：</span>
                      <input type="text" name="number" value="" style="width:80px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">所属门店：</span>
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;"></span>
                    </div>                            
                  </div>
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间中文名称：</span>
                    <input type="tel" name="name" value="" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                    <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                  </div>
                </div>
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间英文名称：</span>
                    <input type="text" name="ename" value="" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                    <span style="margin-left:20px;">（选填）</span>
                  </div>
                </div>
                <div style="display:block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间介绍：</span>
                    <span>样板间介绍将会显示在样板间页面以及meta标签description属性中。（选填）</span>
                  </div>
                  <textarea name="content" value="" style="width:100%; height:200px; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"></textarea>
                </div>                    
                <div style="display:block; margin-top:20px; height:20px;">
                </div>
              </div> 
              <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                <button type="button" onClick="addShowroom($(this).parent().parent());" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">添加</button>
                <button type="button" onClick="dialogAddShowroom.hide();" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF; margin-left:24px;">取消</button>
              </div>
            </form>
          </div>
<script type="text/javascript" language="javascript">
<!--//
var dialogAddShowroom = new DIALOG("ADD_SHOWROOM_DIALOG_DIV");

var shops = <?php echo ($shops ? json_encode($shops) : 'false');?>;

// openAddShowroom(formJQuery, shop) 打开添加样板间对话框，formJQuery为文本表单所属form标签的JQuery对象，shop为门店ID
function openAddShowroom(formJQuery, shop){
    var shop = (!shop || isNaN(parseInt(shop)) || parseInt(shop) < 1) ? 1 : parseInt(shop);
    for(var i = 0; i < shops.length; i++){
      if(shop == shops[i].id){
        shop = i;
      }
    }
    formJQuery.find("input").eq(1).val(shops[shop].id);
    formJQuery.find("h2").text("添加" + shops[shop].name + "样板间");
    formJQuery.find("span").eq(3).text(shops[shop].name);
    dialogAddShowroom.show();
}
// addShowroom(formJQuery) 添加样板间，formJQuery为文本表单所属form标签的JQuery对象
function addShowroom(formJQuery){
  var status = true;
  formJQuery.find("input").each(function(index, element) {
    if($(this).attr("name") == "number" && (!$(this).val() || isNaN(parseInt($(this).val())))){
      alert("样板间编号不能为空，且必须为整数。");
      status = false;
      return false;
    }
    if($(this).attr("name") == "name" && (!$(this).val())){
      alert("样板间名称不能为空。");
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
}
// 前移样板间
function movePrevShowroom(id, shop){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_showroom", "id": id, "shop": shop},
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
// 后移样板间
function moveNextShowroom(id, shop){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_showroom", "id": id, "shop": shop},
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
// 删除样板间
function deleteShowroom(id, shop){
  if(!confirm("确定要删除此样板间吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_showroom", "id": id, "shop": shop},
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
// changeVisibility(id, buttonJQuery) 更改样板间显示状态, id为样板间ID，buttonJQuery为按钮JQuery对象
function changeVisibility(id, buttonJQuery){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "change_showroom_visibility", "id": id},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE == 1){
        buttonJQuery.parent().parent().parent().find("img").toggleClass("gray");
        if(buttonJQuery.find("i").attr("class") == "glyphicon glyphicon-eye-open"){
          buttonJQuery.find("i").removeClass("glyphicon glyphicon-eye-open");
          buttonJQuery.find("i").addClass("glyphicon glyphicon-eye-close");
        }
        else{
          buttonJQuery.find("i").removeClass("glyphicon glyphicon-eye-close");
          buttonJQuery.find("i").addClass("glyphicon glyphicon-eye-open");
        }
      }
      else{
        alert(data.TEXT);
      }
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// changeToTop(id, buttonJQuery) 更改样板间置顶状态, id为样板间ID，buttonJQuery为按钮JQuery对象
function changeToTop(id, buttonJQuery){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "change_showroom_totop", "id": id},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE == 1){
        if(buttonJQuery.find("i").attr("class") == "glyphicon glyphicon-upload"){
          buttonJQuery.find("i").removeClass("glyphicon glyphicon-upload");
          buttonJQuery.find("i").addClass("glyphicon glyphicon-download");
        }
        else{
          buttonJQuery.find("i").removeClass("glyphicon glyphicon-download");
          buttonJQuery.find("i").addClass("glyphicon glyphicon-upload");
        }
      }
      else{
        alert(data.TEXT);
      }
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