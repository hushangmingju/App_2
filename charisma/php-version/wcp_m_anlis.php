<?php require('wcp_head.inc'); ?>
<?php
// 指定参数
$pageFile = 'mobile/styles.php';
$imagesFolder = 'pics';
$bannerComponent = 'm_styles_banner';
$picturesComponent = 'm_styles_pic';

// 检验pageFile参数是否正确
for ($i = 0; $i < count($pages); $i++) {
    if ($pages[$i]['pageFile'] == $pageFile) {
        $pageInfos = $pages[$i];
    }
}
if (!isset($pageInfos)) {
    die("<script type='text/javascript'>window.location.href='wcp_root.html'</script>");
}

// 页面参数
$pageFile = $pageInfos['pageFile'];
$platformName = $pageInfos['platform'];
$pageID = $pageInfos['id'];
$pageName = $pageInfos['pageNameCN'];

// -------------------------------------------------  分割线 -------------------------------------------------------------------------------------
$values = array();
$contentIDs = array();
$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageInfos['id'] . " AND `status` = 1");
$contents = DAS::quickQuery($contents);
if (DAS::hasData($contents)) {
    foreach ($contents['data'] as $content) {
        $values[$content['component']] = $content['textType'] == 1 ? $content['contentChar'] : $content['contentText'];
        $contentIDs[$content['component']] = $content['id'];
    }
}
$banner = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `component` = '" . $bannerComponent . "'");
$banner = DAS::quickQuery($banner);
$banner = DAS::hasData($banner) ? $banner['data'][0] : false;

$backgroundColor = (isset($values['backgroundColor']) && $values['backgroundColor']) ? $values['backgroundColor'] : $globalBackgroundColor;
?>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2><i class="glyphicon glyphicon-info-sign"></i> <a href="http://www.mingjugroup.com/mobile/styles.html" target="_blank">移动端样板间主页 mobile/styles.html</a></h2>
                </div>
                <div class="box-content row">
                  <div class="box col-md-12">
                    <!-- 基本内容编辑栏-->
                    <div class="box-inner">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">基本内容</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面题头、标题、关键词、描述、背景色。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="set_contents_group"/>
                          <input type="hidden" name="pageFile" value="mobile/styles.php"/>
                          <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:block; width:90%; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">顶部题头:</span>
                                <span>显示在页面顶部的标题。<font style="color:red;">（必须填）</font></span>
                              </div>
                              <input type="text" name="topTitle" value="<?php echo isset($values['topTitle']) ? $values['topTitle'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">标题:</span>
                                <span>title标签 页面标题，该内容将显示在浏览器标签页上以及作为页面收藏的标题。（选填）</span>
                              </div>
                              <input type="text" name="title" value="<?php echo isset($values['title']) ? $values['title'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">关键词:</span>
                                <span>meta标签 keywords属性 可以填写网页关键词，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="keywords" value="<?php echo isset($values['keywords']) ? $values['keywords'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">描述:</span>
                                <span>meta标签 description属性 可以填写网页描述，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="description" value="<?php echo isset($values['description']) ? $values['description'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">                              
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面背景颜色:</span>
                                <a onClick="$(this).next().css('background-color', $(this).next().next().val());" style="cursor:pointer; display:inline-block; position:relative; right:-186px;">预览</a>                             
                                <div style="width:20px; height:20px; margin-left:20px; display:inline-block; box-shadow:#888888 0px 2px 6px; position:relative; right:-176px; margin-bottom:-4px;<?php echo isset($values['backgroundColor']) ? 'background-color:' . $values['backgroundColor'] . ';' : '';?>"></div>
                                <input type="text" name="backgroundColor" value="<?php echo isset($values['backgroundColor']) ? $values['backgroundColor'] : '';?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:-57px;"/>
                                <span style="margin-left:20px;">body CSS background-color属性，整个页面的背景色，默认为白色，填写格式#FFFFFF或rgba(255,255,255,1.00)（选填）</span> 
                              </div>                            
                            </div>                      
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div> 
                          <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                            <button type="button" onClick="setContentsGroup($(this).parent().prev());" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- Banner图设置栏 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">Banner图设置</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面Banner图。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <div style="width:100%; box-shadow:#888888 0px 3px 10px;">
                          <?php
                            if ($banner) {
                                $banner['path'] = $banner['folderName'] . '/' . $banner['fileName'];
                                $banner['suffix'] = strtoupper(substr($banner['fileName'], strrpos($banner['fileName'], '.')));
                                $banner['size'] = round(filesize('../../images/pics/' . $banner['fileName']) / 1024, 2) . 'KB';
                                $banner['dimen'] = getimagesize($banner['path']);
                            }
                            ?> 
                          <div style="width:100%; text-align:center; background-color:#EFEFEF; padding-top:16px; padding-bottom:28px;">                     
                            <div style="float:left; display:inline-block; background-color:#35a6e7; color:#ffffff; margin-top:-16px; padding:3px 5px 3px 5px;">预览</div>
                            <div style="box-shadow:#888888 0px 3px 10px; margin-top:8px; display:inline-block; padding:0px; width:640px;">
                            <?php
                            if ($banner) {
                                echo '<img src="' . $banner['path'] . '" style="width:640px; margin:0px; border:none; padding:0px;" />';
                            }
                            ?>
                            </div>
                          </div>
                        </div>
                        <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                          <button type="button" onClick="setBanner(<?php echo $banner['id'];?>);" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">编辑Banner图片</button>  
                        </div>
                      </div>
                    </div>
                    <!-- 标签分类设置栏 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">标签组设置</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面展示的标签分类。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <form>
                          <input type="hidden" name="action" value="set_a_content"/>
                          <input type="hidden" name="id" value="<?php echo $contentIDs['taggroup'];?>"/>
                          <input type="hidden" name="pageFile" value="<?php echo $pageInfos['pageFile'];?>"/>
                          <input type="hidden" name="component" value="taggroup"/>
                          <input type="hidden" name="descript" value="实景样板间标签组设置"/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;">
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">                              
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">选择标签组:</span>
                                <select name="content" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;">
                                <?php
                                for ($i = 0; $i < count($tagGroups); $i++) {
                                ?>
                                  <option value="<?php echo $tagGroups[$i]['tagGroup'];?>"<?php echo ($tagGroups[$i]['tagGroup'] == $values['taggroup']) ? 'selected = "selected"' : ''?>><?php echo $tagGroups[$i]['tagGroup'];?></option>
                                <?php
                                }
                                ?>
                                </select>
                                <span style="margin-left:20px;">实景样板间标签组，选择要在页面上显示的标签组（选填）</span> 
                              </div>                            
                            </div>                      
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div> 
                          <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                            <button type="button" onClick="setAContent($(this).parents('form'))" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>                        
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
<script type="text/javascript" language="javascript">
<!--//
// 设置Banner图片
function setBanner(id){
  // 默认为添加模式
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val();
  // 设置action为add_image
  formJQuery.children("input").eq(1).val("add_image");  
  // 设置component
  formJQuery.children("input").eq(2).val("<?php echo $bannerComponent;?>");
  // 设置folder
  formJQuery.children("input").eq(3).val("<?php echo $imagesFolder;?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $platformName . $pageName;?>Banner图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("<?php echo $pageFile;?>");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加<?php echo $platformName . $pageName;?>Banner图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"131px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为640x210px或同比例扩大，文件小于256KB的.jpg或.png格式图片。");      
  // 清空预览图片
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html("");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 清空alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 清空href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 清空图片路径信息
  formJQuery.find("input#IMG_PATH").val("");
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("");  
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 如果存在id，则更改为修改模式
  if(id && id == <?php echo $banner ? $banner['id'] : -1;?>){
    // 设置ID
    formJQuery.children("input").eq(0).val(<?php echo $banner ? $banner['id'] : '';?>);
    // 设置action
    formJQuery.children("input").eq(1).val("set_image");
    // 设置对话框标题
    formJQuery.find("div.DialogTitle").text("设置<?php echo $platformName . $pageName;?>Banner图片:");
    // 设置预览文件信息
    formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("<?php echo $banner ? ('文件类型：' . $banner['suffix'] . ' 大小：' . $banner['size'] . ' 图片尺寸：' . $banner['dimen'][0] . ' x ' . $banner['dimen'][1] . 'px') : '';?>");
    // 设置预览图片
    <?php
    if ($banner) {
        echo 'var picPreviewDimen = fixImgSize(' . $banner['dimen'][0] . ', ' . $banner['dimen'][1] . ', 400, 131);';
        echo 'var picPreviewHtml = "<img src=\'' . $banner['path'] . '\' style=\'width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px\'/>";';
    }
    else {
        echo 'var picPreviewHtml = "";';
    }
    ?>
    formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
    
    // 设置alt信息
    setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, "<?php echo $banner ? $banner['alt'] : '';?>");
    // 隐藏title表单栏
    setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
    // 设置href信息
    setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, "<?php echo $banner ? $banner['href'] : '';?>");
    // 设置head信息
    setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
    // 隐藏content信息
    setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
    // 隐藏css信息
    setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
    
    // 设置图片路径信息
    formJQuery.find("input#IMG_PATH").val("<?php echo $banner ? substr($banner['path'], 27) : '';?>");
    // 设置图片路径信息（隐藏）
    formJQuery.find("input#IMG_PATH_HIDDEN").val("<?php echo $banner ? substr($banner['path'], 27) : '';?>");
  }
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 256);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    <?php echo $imgFolderArray[$imagesFolder];?>
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
// 
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