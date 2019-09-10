<?php require('wcp_head.inc'); ?>
<?php
$tags = new Query("*", "`tb_wcp_tags`", "", "", "`groupIndex`, `tagIndex`, `itemIndex`");
$tags = DAS::quickQuery($tags);
$tags = DAS::hasData($tags) ? $tags['data'] : false;
$tagGroups = false;
if ($tags) {
    $tagGroups = array();
    foreach ($tags as $tag) {
        if (!isset($tagGroups[$tag['tagGroup']])) {
            $tagGroups[$tag['tagGroup']] = array();
        }
        if ($tag['tag'] && !isset($tagGroups[$tag['tagGroup']][$tag['tag']])) {
            $tagGroups[$tag['tagGroup']][$tag['tag']] = array();
        }
        $tagGroups[$tag['tagGroup']][$tag['tag']][] = $tag; 
    }
}
?>
<style>
a.bar_button{
  background-color:#999999;
  border:#999999 1px solid;
  display:inline-block;
  height:36px;
  width:120px;
  padding:8px 12px 5px 12px;
  margin-top:-4px;
  color:#FFFFFF;
  text-align:center;
}
a.bar_button: hover{
  background-color:#FFFFFF;
  border:#35a6e7 1px solid;
  color:#35a6e7;
}
</style>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <!-- 标签管理栏 START -->
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2 style="display:inline-block;"><i class="glyphicon glyphicon-th-large"></i> 标签管理</h2>
                  <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以管理标签组、标签。</span>
                </div>
                <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px;">                  
                  <?php
                  if ($tagGroups) {
                      $tagGroupKeys = array_keys($tagGroups);
                  ?>
                  <ul class="nav nav-tabs" id="myTab">
                  <?php
                      for ($i = 0; $i < count($tagGroupKeys); $i++) {
                  ?>
                    <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:-2px;"><a href="#taggroup_<?php echo $i;?>" class="glyphicon glyphicon-tags"> <?php echo $tagGroupKeys[$i];?></a></li>
                  <?php
                      }
                  ?>  
                    <li style="margin-bottom:-2px;"><a href="#add_new_taggroup" class="glyphicon glyphicon-plus"> 新建</a></li>                
                  </ul>
                  <div id="myTabContent" class="tab-content">
                  <?php
                      for ($i = 0; $i < count($tagGroupKeys); $i++) {
                  ?>
                    <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="taggroup_<?php echo $i;?>">
                      <div style="display:block; height:36px; background-color:#FAFAFA; margin-top:12px; padding:5px 24px 5px 24px;">
                        <span style="color:#35a6e7; font-weight:bold; font-size:16px;">标签组操作：</span>
                        <?php
                          if ($i > 0) {
                        ?>
                        <a class="bar_button" onClick="movePrevGroup(<?php echo ($i + 1);?>, '<?php echo $tagGroupKeys[$i];?>');"><li class="glyphicon glyphicon-arrow-left"></li> 前移</a>
                        <?php      
                          }
                          if ($i < (count($tagGroupKeys) - 1)) {
                        ?>
                        <a class="bar_button" onClick="moveNextGroup(<?php echo ($i + 1);?>, '<?php echo $tagGroupKeys[$i];?>');"><li class="glyphicon glyphicon-arrow-right"></li> 后移</a>
                        <?php
                          }
                        ?>
                        <a class="bar_button" onClick="deleteGroup(<?php echo ($i + 1);?>, '<?php echo $tagGroupKeys[$i];?>')"><li class="glyphicon glyphicon-trash"></li> 删除</a>
                        <span style="display:none;">
                          <input type="text" value="<?php echo $tagGroupKeys[$i];?>"/>
                          <a class="glyphicon glyphicon-ok" onClick="renameTagGroup($(this).prev(), <?php echo ($i + 1);?>)" title="提交"></a>
                        </span>
                        <a class="bar_button" onClick="$(this).fadeOut('fast','',function(e){$(this).prev().fadeIn('slow');$(this).prev().find('input').focus();$(this).prev().find('input').focusout(function(e) {$(this).parent().fadeOut('slow','',function(e){$(this).next().fadeIn('slow');});});});"><li class="glyphicon glyphicon-edit"></li> 编辑</a>
                      </div>
                      <p style="padding-left:24px; font-weight:bold; color:#35a6e7; margin-top:20px; font-size:16px;">标签管理：</p>
                    <?php
                          $tagKeys = array_keys($tagGroups[$tagGroupKeys[$i]]);
                          for ($j = 0; $j < count($tagKeys); $j++) {
                              if ($tagKeys[$j]) {
                    ?>
                      <div style="display:inline-block; width:330px; padding:5px; text-align:left; height:36px; font-size:16px; margin-top:16px; border-radius:5px; box-shadow:#888888 0px 3px 10px; margin-left:16px; padding-left:16px;">
                        <div style="display:none;">
                          <form>
                            <input type="hidden" name="action" value="rename_tag"/>
                            <input type="hidden" name="tagGroup" value="<?php echo $tagGroupKeys[$i];?>"/>
                            <input type="hidden" name="tagIndex" value="<?php echo ($j + 1);?>"/>
                            <input type="text" name="tag" value="<?php echo $tagKeys[$j];?>" style="width:100%; border-radius:4px; border:1px solid #AAAAAA; margin-top:-1px; padding-left:8px;" />                                    
                            <button type="button" onClick="renameTag($(this).parents('form'));" style="height:25px;; position:relative; top:-26px; float:right; margin-right:1px; width:64px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF; border-top-right-radius:3px; border-bottom-right-radius:3px;">提交</button>
                          </form>
                          <a onClick="$(this).parent().fadeOut('fast','',function(e){$(this).next().fadeIn('slow');});" style="float:right; margin-right:10px; position:relative; top:-25px; cursor:pointer; border-left:#AAAAAA 1px solid; padding-left:8px;">取消</a>
                        </div>
                        <div>
                          <li class="glyphicon glyphicon-tag"> </li> <?php echo $tagKeys[$j];?>
                          <a class="glyphicon glyphicon-trash" title="删除" onClick="deleteTag(<?php echo ($j + 1);?>, '<?php echo $tagKeys[$j];?>', '<?php echo $tagGroupKeys[$i];?>')" style="float:right; margin-right:6px; margin-top:2px;"></a>                        
                          <a class="glyphicon glyphicon-edit" title="编辑" onClick="$(this).parent().fadeOut('fast','',function(e){$(this).prev().fadeIn('slow');});" style="float:right; margin-right:6px; margin-top:2px;"></a>
                          <?php
                                  if ($j < (count($tagKeys) - 1)) {
                          ?>
                          <a class="glyphicon glyphicon-arrow-right" onClick="moveNextTag(<?php echo ($j + 1);?>, '<?php echo $tagKeys[$j];?>', '<?php echo $tagGroupKeys[$i];?>');" title="后移" style="float:right; margin-right:6px; margin-top:2px;"></a>
                          <?php
                                  }
                          ?>
                          <?php
                                  if ($j > 0) {
                          ?>
                          <a class="glyphicon glyphicon-arrow-left" onClick="movePrevTag(<?php echo ($j + 1);?>, '<?php echo $tagKeys[$j];?>', '<?php echo $tagGroupKeys[$i];?>');" title="前移" style="float:right; margin-right:6px; margin-top:2px;"></a>
                          <?php
                                  }
                          ?>
                        </div>                      
                      </div>
                    <?php
                              }
                          }
                    ?>
                      <div style="display:inline-block; width:330px; padding:5px; text-align:left; height:36px; font-size:16px; margin-top:16px; border-radius:5px; border:#CCCCCC 1px dashed; margin-left:16px;">
                        <div style="display:none;">
                          <form>
                            <input type="hidden" name="action" value="add_tag"/>
                            <input type="hidden" name="tagGroup" value="<?php echo $tagGroupKeys[$i];?>"/>
                            <input type="text" name="tag" value="" placeholder="新标签名称" style="width:100%; border-radius:4px; border:1px solid #AAAAAA; margin-top:-1px; padding-left:8px;" />                                    
                            <button type="button" onClick="addTag($(this).parents('form'));" style="height:25px;; position:relative; top:-26px; float:right; margin-right:1px; width:64px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF; border-top-right-radius:3px; border-bottom-right-radius:3px;">提交</button>
                          </form>
                          <a onClick="$(this).parent().fadeOut('fast','',function(e){$(this).next().fadeIn('slow');});" style="float:right; margin-right:10px; position:relative; top:-25px; cursor:pointer; border-left:#AAAAAA 1px solid; padding-left:8px;">取消</a>
                        </div>
                        <a onClick="$(this).fadeOut('fast','',function(e){$(this).prev().fadeIn('slow');});" style="cursor:pointer; padding-left:24px; font-weight:bold;">
                          <li class="glyphicon glyphicon-plus"></li> 点击添加新标签                        
                        </a>
                      </div>
                    </div>
                  <?php
                      }
                  ?>
                    <div class="tab-pane" id="add_new_taggroup">
                      <div style="display:inline-block; width:330px; padding:5px; text-align:left; height:36px; font-size:16px; margin-top:10px; border-radius:5px; border:#CCCCCC 1px dashed;">
                        <div style="display:none;">
                          <input type="text" value="" style="width:100%; border-radius:4px; border:1px solid #AAAAAA; margin-top:-1px; padding-left:8px;" />                                    
                          <button type="button" onClick="addTagGroup($(this).prev());" style="position:relative; top:-26px; float:right; margin-right:1px; width:64px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF; border-top-right-radius:3px; border-bottom-right-radius:3px;">提交</button>
                          <a onClick="$(this).parent().fadeOut('fast','',function(e){$(this).next().fadeIn('slow');});" style="float:right; margin-right:10px; position:relative; top:-25px; cursor:pointer; border-left:#AAAAAA 1px solid; padding-left:8px;">取消</a>
                        </div>
                        <a onClick="$(this).fadeOut('fast','',function(e){$(this).prev().fadeIn('slow');});" style="cursor:pointer; padding-left:24px; font-weight:bold;">
                          <li class="glyphicon glyphicon-plus"></li> 点击添加新标签组                        
                        </a>
                      </div>
                    </div>
                  </div>
                  <?php                  
                  }
                  else {
                  ?>
                  <div style="display:inline-block; width:330px; padding:5px; text-align:left; height:36px; font-size:16px; margin-top:10px; border-radius:5px; border:#CCCCCC 1px dashed;">
                    <div style="display:none;">
                      <input type="text" value="" style="width:100%; border-radius:4px; border:1px solid #AAAAAA; margin-top:-1px; padding-left:8px;" />                                    
                      <button type="button" onClick="addTagGroup($(this).prev());" style="position:relative; top:-26px; float:right; margin-right:1px; width:64px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF; border-radius:3px;">提交</button>
                      <a onClick="$(this).parent().fadeOut('fast','',function(e){$(this).next().fadeIn('slow');});" style="float:right; margin-right:10px; position:relative; top:-25px; cursor:pointer; border-left:#AAAAAA 1px solid; padding-left:8px;">取消</a>
                    </div>
                    <a onClick="$(this).fadeOut('fast','',function(e){$(this).prev().fadeIn('slow');});" style="cursor:pointer; padding-left:24px; font-weight:bold;">
                      <li class="glyphicon glyphicon-plus"></li> 还没有标签组，点击添加新标签组                        
                    </a>
                  </div>
                  <?php 
                  }
                  ?>
                </div>
              </div>                                
            </div>
          </div>
          <!-- #标签管理栏 END -->
         
<script type="text/javascript" language="javascript">
<!--//
var tagGroups = <?php echo ($tagGroups ? json_encode($tagGroups) : 'false');?>;

// addTagGroup(inputJQuery) 添加标签组，inputJQuery为文本输入框的JQuery对象
function addTagGroup(inputJQuery){
  if(!inputJQuery || !inputJQuery.val()){
    alert("标签组名称不能为空！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "add_taggroup", "tagGroup": inputJQuery.val()},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// renameTagGroup(inputJQuery， groupIndex) 重命名标签组，inputJQuery为文本输入框的JQuery对象，groupIndex是标签组顺序号
function renameTagGroup(inputJQuery, groupIndex){
  if(!inputJQuery || !inputJQuery.val()){
    alert("标签组名称不能为空！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "rename_taggroup", "tagGroup": inputJQuery.val(), "groupIndex": groupIndex},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// movePrevGroup(groupIndex, tagGroup) 前移标签组，groupIndex是标签组顺序号，tagGroup为标签组名称
function movePrevGroup(groupIndex, tagGroup){
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!groupIndex || isNaN(parseInt(groupIndex)) || parseInt(groupIndex) < 0){
    alert("无效的标签组顺序号！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_taggroup", "groupIndex": groupIndex, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }      
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// moveNextGroup(groupIndex, tagGroup) 后移标签组，groupIndex是标签组顺序号，tagGroup为标签组名称
function moveNextGroup(groupIndex, tagGroup){
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!groupIndex || isNaN(parseInt(groupIndex)) || parseInt(groupIndex) < 0){
    alert("无效的标签组顺序号！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_taggroup", "groupIndex": groupIndex, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// deleteGroup(tagGroup) 删除标签组，tagGroup为标签组名称
function deleteGroup(groupIndex, tagGroup){
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!groupIndex || isNaN(parseInt(groupIndex)) || parseInt(groupIndex) < 0){
    alert("无效的标签组顺序号！");
    return false;
  }
  if(!confirm("标签组“" + tagGroup + "”将永久删除，删除后将无法恢复，确定要继续删除吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_taggroup", "groupIndex": groupIndex, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}

// addTag(formJQuery) 添加标签，formJQuery为表单的JQuery对象
function addTag(formJQuery){
  var check = true;
  formJQuery.find("input").each(function(index, element) {
    if($(this).attr("name") == "tagGroup" && !$(this).val()){
      alert("标签组名称不能为空！");
      check = false;
    }
    if($(this).attr("name") == "tag" && !$(this).val()){
      alert("标签名称不能为空！");
      check = false;
    }
  });
  if(!check){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: formJQuery.serializeArray(),
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// renameTag(formJQuery) 重命名标签组formJQuery为表单的JQuery对象
function renameTag(formJQuery){
  var check = true;
  formJQuery.find("input").each(function(index, element) {
    if($(this).attr("name") == "tagGroup" && !$(this).val()){
      alert("标签组名称不能为空！");
      check = false;
    }
    if($(this).attr("name") == "tag" && !$(this).val()){
      alert("标签名称不能为空！");
      check = false;
    }
  });
  if(!check){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: formJQuery.serializeArray(),
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);     
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// movePrevTag(tagIndex, tag, tagGroup) 前移标签，tagIndex是标签顺序号，tag为标签名称，tagGroup为标签所属标签组名称
function movePrevTag(tagIndex, tag, tagGroup){
  if(!tag){
    alert("标签名称不能为空！");
    return false;
  }
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!tagIndex || isNaN(parseInt(tagIndex)) || parseInt(tagIndex) < 0){
    alert("无效的标签顺序号！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_tag", "tagIndex": tagIndex, "tag": tag, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }      
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// moveNextTag(tagIndex, tag, tagGroup) 后移标签，tagIndex是标签顺序号，tag为标签名称，tagGroup为标签所属标签组名称
function moveNextTag(tagIndex, tag, tagGroup){
  if(!tag){
    alert("标签名称不能为空！");
    return false;
  }
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!tagIndex || isNaN(parseInt(tagIndex)) || parseInt(tagIndex) < 0){
    alert("无效的标签顺序号！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_tag", "tagIndex": tagIndex, "tag": tag, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
      reloadPage();
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// deleteTag(tagIndex, tag, tagGroup) 删除标签组，tagIndex是标签顺序号，tag为标签名称，tagGroup为标签所属标签组名称
function deleteTag(tagIndex, tag, tagGroup){
  if(!tag){
    alert("标签名称不能为空！");
    return false;
  }
  if(!tagGroup){
    alert("标签组名称不能为空！");
    return false;
  }
  if(!tagIndex || isNaN(parseInt(tagIndex)) || parseInt(tagIndex) < 0){
    alert("无效的标签顺序号！");
    return false;
  }
  if(!confirm("标签“" + tag + "”将从标签组“" + tagGroup + "”中永久删除，删除后将无法恢复，确定要继续删除吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_tag", "tagIndex": tagIndex, "tag": tag, "tagGroup": tagGroup},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){
        alert(data.TEXT);
      }
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