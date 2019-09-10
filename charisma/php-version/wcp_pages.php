<?php 
require_once('wcp_head.inc');
if ($pages) {
    $platforms = new Query("`platform`, COUNT(`id`) AS pageNumber", "`tb_vcs_pages`", "", "`status` = 1", "pageNumber DESC", "`platform`");
    $platforms = DAS::quickQuery($platforms);
    $platforms = DAS::hasData($platforms) ? $platforms['data'] : false;
}
?>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <!-- 页面管理栏 START -->
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2 style="display:inline-block;"><i class="glyphicon glyphicon-th-large"></i> 页面管理</h2>
                  <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以管理页面信息或添加新页面。</span>
                </div>
                <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px;">                  
                  <?php
                  if ($pages) {
                  ?>
                  <ul class="nav nav-tabs" id="myTab">
                  <?php
                      for ($i = 0; $i < count($platforms); $i++) {
                  ?>
                    <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:-2px;"><a href="#platform_<?php echo $i;?>"><?php echo $platforms[$i]['platform'];?></a></li>
                  <?php
                      }
                  ?>                  
                  </ul>
                  <div id="myTabContent" class="tab-content">
                  <?php
                      for ($i = 0; $i < count($platforms); $i++) {
                  ?>
                    <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="platform_<?php echo $i;?>">
                    <?php
                          foreach ($pages as $page) {
                              if ($page['platform'] == $platforms[$i]['platform']) {
                      ?>
                      <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                        <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                          <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                            <span style="float:left; display:inline-block; color:#FFFFFF; font-size:20px; font-weight:bolder;">ID: <?php echo $page['id'];?></span>
                            <a class="icon_button" onClick="deletePage(<?php echo $page['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                            <a class="icon_button" onClick="setPage(<?php echo $page['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                          </div>
                        </div>
                        <img src="https://image.thum.io/get/auth/2775-img/width/320/crop/800/http://www.mingjugroup.com/<?php echo $page['pageFile'];?>" style="width:320px; height:240px;">
                        <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;">
                          <span style="display:block; font-size:14px; font-weight:bolder;">网页名称：<?php echo $page['pageNameCN'] ? $page['pageNameCN'] : '';?></span>
                          <span style="display:block; font-size:12px;">网页地址：<a href="http://www.mingjugroup.com/<?php echo $page['pageFile'];?>" target="_blank"><?php echo $page['pageFile'];?></a></span>
                        </div>
                      </div>
                      <?php
                              }
                          }
                    ?>
                      <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                        <a onClick="setPage('', '<?php echo $platforms[$i]['platform'];?>');" style="cursor:pointer;">
                          <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加页面</div>
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
                    <a onClick="setPage();" style="cursor:pointer;">
                      <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加页面</div>
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
          <!-- #页面管理栏 END -->
          <!-- PAGE_DIALOG_DIV 添加设置门店对话框 -->
          <div id="PAGE_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:860px; padding:00px 0px 20px 0px; overflow:hidden;">
            <form>
              <input type="hidden" name="action" value=""/>
              <input type="hidden" name="id" value=""/>
              <div style="display:block; text-align:center;">
                <h2 style="color:#35a6e7;"></h2>
              </div>
              <div style="width:100%; box-shadow:#888888 0px 3px 10px;"> 
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面名称：</span>
                      <input type="text" name="pageNameCN" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;"></font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面路径：</span>
                      <input type="text" name="pageFile" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面别名：</span>
                      <input type="text" name="pageCname" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;"></font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">目录路径：</span>
                      <input type="text" name="folder" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;"></font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">所属平台：</span>
                      <select name="platform" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;">
                        <optgroup>
                        <?php
                        foreach ($platforms as $platform) {
                        ?>
                          <option value="<?php echo $platform['platform'];?>"><?php echo $platform['platform'];?></option>
                        <?php
                        }
                        ?>                          
                        </optgroup>
                      </select>
                      <span style="margin-left:20px;"><font style="color:red;"></font></span>
                    </div>                            
                  </div>
                  <div style="display:inline-block; width:49%;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">站点别名：</span>
                      <input type="text" name="siteCname" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                      <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                    </div>                            
                  </div>
                  <div id="PAGE_DIALOG_IMAGEINFO_DIV" style="display:none;">
                    <div style="display:inline-block; width:49%;">
                      <div style="display:block; text-align:left;">
                        <span style="color:#35a6e7; font-size:16px; font-weight:bold;">图片目录：</span>
                        <input type="text" name="imagesFolder" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                        <span style="margin-left:20px;"><font style="color:red;"></font></span>
                      </div>                            
                    </div>
                    <div style="display:inline-block; width:49%;">
                      <div style="display:block; text-align:left;">
                        <span style="color:#35a6e7; font-size:16px; font-weight:bold;">组件前缀：</span>
                        <input type="text" name="componentPrefix" value="" style="width:120px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                        <span style="margin-left:20px;"><font style="color:red;"></font></span>
                      </div>                            
                    </div>
                  </div>
                </div>            
                <div id="PAGE_DIALOG_TEMPLET_SELECT" style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block;">
                    <div style="display:inline-block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">管理方式：</span>
                    </div>
                    <select name="templet" style="font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;">
                      <optgroup>
                        <option value=0>仅注册，没有相应的控制台</option>
                        <option value=1>仅注册，但配置有控制台：手动上传页面文件，并提交控制台页面路径</option>
                        <option value=2>官网移动端模板：自动生成页面文件、自动生成控制台</option>
                        <option value=3>推广移动端模板：自动生成页面文件、自动生成控制台</option>
                      </optgroup>
                    </select>
                  </div>
                  <div style="display:block; margin-top:12px;">
                    <div style="display:inline-block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">控制页面：</span>
                    </div>
                    <input type="text" name="configFile" placeholder="仅需提供文件名，模板方式不需要提供。" style="width:485px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;" />
                  </div>
                </div>                   
                <div style="display:block; margin-top:20px; height:20px;">
                </div>
              </div> 
              <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                <button type="button" onClick="" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>
                <button type="button" onClick="dialogPage.hide();" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF; margin-left:24px;">取消</button>
              </div>
            </form>
          </div> 
          
<script type="text/javascript" language="javascript">
<!--//
var dialogPage = new DIALOG("PAGE_DIALOG_DIV");
var pages = <?php echo ($pages ? json_encode($pages) : 'false');?>;

// setPage(id) 添加或编辑页面信息，id为页面ID
function setPage(id, platform){
  var form = $("#PAGE_DIALOG_DIV");
  form.find("h2").text("添加页面");
  form.find("input").eq(0).val("set_page"); // action
  
  form.find("input").eq(1).val(""); // id
  form.find("input").eq(2).val(""); // pageNameCN
  form.find("input").eq(3).val(""); // pageFile
  form.find("input").eq(3).attr("disabled", false); // pageFile
  form.find("input").eq(4).val(""); // pageCname
  form.find("input").eq(5).val(""); // folder
  form.find("input").eq(5).attr("disabled", false); // folder
  form.find("input").eq(6).val(""); // siteCname
  form.find("input").eq(7).val(""); // imagesFolder
  form.find("input").eq(7).attr("disabled", "disbaled"); // imagesFolder
  form.find("input").eq(8).val(""); // componentPrefix
  form.find("input").eq(8).attr("disabled", "disbaled"); // componentPrefix  
  $("#PAGE_DIALOG_IMAGEINFO_DIV").css("display", "none");
  // templet
  if(form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("option").size() < 4){
    form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("optgroup").append("<option value=2>官网移动端模板：自动生成页面文件、自动生成控制台</option>", "<option value=3>推广移动端模板：自动生成页面文件、自动生成控制台</option>");
  }
  form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("select").attr("disabled", false);
  form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("option:eq(0)").prop("selected", "selected");
  form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("input").attr("disabled", "disabled");
  form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("input").val("");
  form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("select").change(function(e) {
    $(this).parent().next().find("input").attr("disabled", "disabled");
    $(this).parent().next().find("input").val("");
    $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(0).val(""); // imagesFolder
    $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(0).attr("disabled", "disbaled"); // imagesFolder
    $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(1).val(""); // componentPrefix
    $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(1).attr("disabled", "disbaled"); // componentPrefix
    if($(this).find("option:checked").val() > 1){
      $("#PAGE_DIALOG_IMAGEINFO_DIV").slideDown("fast");
      $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(0).attr("disabled", false); // imagesFolder
      $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(1).attr("disabled", false); // componentPrefix
    }
    else{
      $("#PAGE_DIALOG_IMAGEINFO_DIV").slideUp("fast");
      $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(0).attr("disabled", "disbaled"); // imagesFolder
      $("#PAGE_DIALOG_IMAGEINFO_DIV").find("input").eq(1).attr("disabled", "disbaled"); // componentPrefix
    }
    if($(this).find("option:checked").val() == 1){
      $(this).parent().next().find("input").attr("disabled", false);
    }
  });
  //console.log($("#PAGE_DIALOG_TEMPLET_RADIO").find("input[type='radio']:checked").val());
  // platform
  if(platform){
    form.find("select").eq(0).find("option").each(function(index, elememt){
      if($(this).val() == platform){
        $(this).prop("selected", "selected");
      }
    });
  }
  else{
    form.find("select").eq(0).find("option").eq(0).prop("selected", "selected"); 
  }
  
  if(id && !isNaN(parseInt(id)) && parseInt(id) > 0){
    for(var i = 0; i < pages.length; i++){
      if(pages[i].id == id){
        form.find("h2").text("编辑页面信息");
        form.find("input").eq(1).val(pages[i].id); // id
        form.find("input").eq(2).val(pages[i].pageNameCN); // pageNameCN
        form.find("input").eq(3).val(pages[i].pageFile); // pageFile
        form.find("input").eq(3).attr("disabled", "disabled"); // pageFile
        form.find("input").eq(4).val(pages[i].pageCname); // pageCname
        form.find("input").eq(5).val(pages[i].folder == "root" ? "" : pages[i].folder); // folder
        form.find("input").eq(5).attr("disabled", "disabled"); // folder
        form.find("input").eq(6).val(pages[i].siteCname); // siteCname
        form.find("input").eq(7).val(pages[i].imagesFolder); // imagesFolder
        form.find("input").eq(8).val(pages[i].componentPrefix); // componentPrefix
        // templet
        if(pages[i].templet < 2){
          if(form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("option").size() > 2){
            form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("option:gt(1)").remove();
          }
          if(pages[i].templet == 1){
            form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("input").attr("disabled", false);
            form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("input").val(pages[i].configFile);
          } 
        }
        else{
          form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("select").attr("disabled", "disabled");
          form.find("input").eq(7).attr("disabled", false); // imagesFolder
          form.find("input").eq(8).attr("disabled", false); // componentPrefix
          $("#PAGE_DIALOG_IMAGEINFO_DIV").css("display", "block");
        }
        form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("option:eq(" + pages[i].templet + ")").prop("selected", "selected");
        form.find("#PAGE_DIALOG_TEMPLET_SELECT").find("select").change(function(e) {
          $(this).parent().next().find("input").attr("disabled", "disabled");
          $(this).parent().next().find("input").val("");
          $(this).find("option").each(function(index, element) {
            if($(this).prop("selected") && $(this).val() == 1){
              $(this).parents("div").next().find("input").attr("disabled", false);
              if(pages[i].configFile){
                $(this).parents("div").next().find("input").val(pages[i].configFile);
              }
            }
          });
        });
        // platform
        form.find("select").find("option").each(function(e){
          if(pages[i].platform == $(this).val()){
            $(this).prop("selected", "selected");    
          }
        }); 
      }
    }
  }
   
  form.find("button").eq(0).unbind();
  form.find("button").eq(0).click(function(e) {
    var status = true;
    $(this).parents("form").find("input").each(function(index, element) {
      if($(this).attr("name") == "pageFile" && !$(this).val()){
        alert("页面路径不能为空。");
        status = false;
        return false;
      }
      if($(this).attr("name") == "siteCname" && !$(this).val()){
        alert("站点别名不能为空。");
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
  dialogPage.show();
}
// 删除门店
function deletePage(id){
  if(!confirm("确定要删除此页面吗？")){
    return false;
  }
  var checkID = false;
  for(var i = 0; i < pages.length; i++){
      if(pages[i].id == id){
          checkID = true;
          if(pages[i].templet > 1){
            if(!confirm("你要删除的是一个模板页面，一旦删除页面文件也会从服务器上被移除，是否继续？")){
              return false;
            }
          }
      }
  }
  if(!checkID){
    alert("错误的页面ID，请联系管理员");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_page", "id": id},
    dataType: "json",
    success: function(data) { 
      alert(data.TEXT);
      history.go(0);
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