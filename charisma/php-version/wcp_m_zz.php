<?php 
require_once('wcp_head.inc'); 
// 页面基本参数
$pageFile = 'mobile/zz.php';
$imagesFolder = 'pics';
$bannerComponent = 'm_zz_banner';
$picturesComponent = 'm_zz_pic';
$platformName = '移动端';
$pageName = '漳州活动页面';


// -------------------------------------------------  分割线 -------------------------------------------------------------------------------------

$pageID = DAS::isExistedInDB("`tb_vcs_pages`", "`pageFile` = '" . $pageFile . "'", "`id`");
$values = array();

$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = " . $pageID . " AND `status` = 1");
$contents = DAS::quickQuery($contents);
if (DAS::hasData($contents)) {
    foreach ($contents['data'] as $content) {
        $values[$content['component']] = $content['textType'] == 1 ? rawurldecode($content['contentChar']) : rawurldecode($content['contentText']);
    }
}
$banner = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `component` = '" . $bannerComponent . "'");
$banner = DAS::quickQuery($banner);
$banner = DAS::hasData($banner) ? $banner['data'][0] : false;

$pictures = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageID . " AND `component` = '" . $picturesComponent . "'", "`ordnung`");
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$composes = new Query("*", "`tb_wcp_composes`", "", "`pageID` = " . $pageID, "`id`");
$composes = DAS::quickQuery($composes);
$composes = DAS::hasData($composes) ? $composes['data'] : false;

$backgroundColor = (isset($values['backgroundColor']) && $values['backgroundColor']) ? $values['backgroundColor'] : '#FFFFFF';


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
                  <h2><i class="glyphicon glyphicon-info-sign"></i> <a href="http://www.mingjugroup.com/<?php echo $pageFile;?>" target="_blank"><?php echo $platformName;?> <?php echo $pageFile;?></a></h2>
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
                          <input type="hidden" name="pageFile" value="<?php echo $pageFile;?>"/>
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
                                $banner['size'] = round(filesize('../../images/' . $imagesFolder . '/' . $banner['fileName']) / 1024, 2) . 'KB';
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
                    <!-- 图片编辑栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">图片管理</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以添加、删除、编辑页面的图片，还可以调整图片的显示顺序。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px; display:none;">
                        <?php                        
                        if ($pictures) {
                            foreach ($pictures as $picture) {
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                            <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                              <a class="icon_button" onClick="deletePic(<?php echo $picture['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                              <a class="icon_button" onClick="setPic(<?php echo $picture['ordnung'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                            <?php
                                if ($picture['ordnung'] < count($pictures)) {
                            ?>
                              <a class="icon_button" onClick="moveNextPic(<?php echo $picture['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                            <?php
                                }
                                if ($picture['ordnung'] > 1) {
                            ?>
                              <a class="icon_button" onClick="movePrevPic(<?php echo $picture['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                            <?php
                                }
                            ?>
                            </div>
                          </div>
                          <div style="display:inline-block; width:320px; height:240px; vertical-align:middle; text-align:center;">     
                          <?php
                          $width = $picture['width'];
                          $height = $picture['height'];
                          if ($width > 320) {
                              $height = ($height / $width) * 320;
                              $width = 320;
                          }
                          if ($height > 240) {
                              $width = ($width / $height) * 240;
                              $height = 240;
                          }
                          $marginTop = (240 - $height) / 2;
                          ?> 
                            <img src="<?php echo $picture['folderName'] . '/' . $picture['fileName'];?>" style="height:<?php echo $height;?>px; width:<?php echo $width;?>px; margin-top:<?php echo $marginTop;?>px; border:1px #AAAAAA solid;">
                          </div>
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;"> 
                            <span style="display:block; display:inline-block;">注释：<?php echo $picture['alt'];?></span>
                          </div>
                        </div>  
                        <?php
                            }
                        }
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <a onClick="addPic();" style="cursor:pointer;">
                            <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加图片</div>
                            <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                            <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                              <span style="width:310px; display:inline-block;"></span>
                            </div>                          
                          </a>
                        </div>                          
                      </div>
                    </div>
                    <!-- 插件管理栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">插件管理</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以添加、删除、编辑页面的插件。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px; display:none;">
                        <?php
                        foreach ($composes as $compose) {
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <div style="display:inline-block; width:320px; height:240px; vertical-align:middle; text-align:center; border:1px #CCCCCC solid; border-bottom:none;">
                            <?php
                            $plugInValuesArray = array();
                            $plugInValues = json_decode($compose['json'], true);                       
                            for ($i = 0; $i < count($plugInColumns[$compose['plugInIndex']]['column']); $i++) {
                                $plugInValuesArray[$plugInColumns[$compose['plugInIndex']]['column'][$i]] = rawurldecode($plugInValues[$i]);
                            }
                            if ($compose['type'] == 'bar') {
                                $plugInValuesArray['position'] = PLUGIN::$plugIns[$compose['plugInIndex']]['position'];
                            }
                            echo PLUGIN::setPlugIn($plugInValuesArray, $compose['plugInIndex']);
                            ?>
                          </div>
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#FFFFFF; padding:5px 5px 5px 5px; border:1px solid #CCCCCC; border-top:none;"> 
                            <span style="display:block; color:#35a6e7; font-weight:bold;">插件名：<?php echo $compose['name'];?></span>
                            <a class="icon_button3" onClick="" style="font-size:14px; text-align:center; display:inline-block; width:90px; height:24px; float:right; margin-top:14px; padding:3px; margin-right:-5px;">
                              <i class="glyphicon glyphicon-trash" title="删除"></i> 删除
                            </a>
                            <a class="icon_button3" onClick="setPlugIn(<?php echo $compose['id']?>)" style="font-size:14px; text-align:center; display:inline-block; width:90px; height:24px; float:right; margin-top:14px; padding:3px;; margin-right:3px;">
                              <i class="glyphicon glyphicon-edit" title="修改"></i> 修改
                            </a> 
                            <?php
                            if ($compose['type'] != 'dialog' && $compose['type'] != 'bar') {
                            ?>
                            <a class="icon_button3" onClick="setCompose('<?php echo $backgroundColor;?>', '<?php echo $banner['path'];?>', pictures, composes, <?php echo $compose['id'];?>);" style="font-size:14px; text-align:center; display:inline-block; width:90px; height:24px; float:right; margin-top:14px; padding:3px; margin-right:3px;">
                              <i class="glyphicon glyphicon-th-list" title="排版"></i> 排版
                            </a>
                            <?php
                            }
                            ?>                          
                          </div>
                        </div>  
                        <?php
                        }
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <a onClick="setPlugIn();" style="cursor:pointer;">
                            <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加插件</div>
                            <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                            <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                              <span style="width:310px; display:inline-block;"></span>
                            </div>                          
                          </a>
                        </div>                          
                      </div>
                    </div>
                    <!-- 插入代码编辑栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">插入代码</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置在&lt;head&gt;和&lt;body&gt;处插入Javascript代码。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="set_contents_group"/>
                          <input type="hidden" name="pageFile" value="<?php echo $pageFile;?>"/>
                          <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">头部代码:</span>
                                <span>在&lt;/head&gt;标签前插入的代码，注意：插入Javascript代码必须包含&lt;script&gt;&lt;/script&gt;标签（选填）</span>
                              </div>
                              <textarea name="head_codes" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; height:80px;"><?php echo isset($values['head_codes']) ? $values['head_codes'] : '';?></textarea>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">正文代码:</span>
                                <span>在&lt;/body&gt;标签前插入的代码，注意：插入Javascript代码必须包含&lt;script&gt;&lt;/script&gt;标签（选填）</span>
                              </div>
                              <textarea name="body_codes" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; height:80px;"><?php echo isset($values['body_codes']) ? $values['body_codes'] : '';?></textarea>
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
                    <!-- 本地统计设置-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">本地统计设置</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置本地方可统计系统开关。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <div class="control_panel">  
                          <div style="display:block; margin-top:20px; padding:0px 64px 0px 64px;">
                            <span style="color:#35a6e7; font-size:16px; font-weight:bold;">本地统计:</span>
                            <div style="display:inline-block; border:1px #35a6e7 solid; border-radius:4px;">
                              <button type="button" class="<?php echo ((isset($values['vcs_status']) && $values['vcs_status'] == '1') ? 'button_active' : 'button_deactive');?>" onClick="setVCS($(this))">打开</button>
                              <button type="button" class="<?php echo ((isset($values['vcs_status']) && $values['vcs_status'] == '1') ? 'button_deactive' : 'button_active');?>" onClick="setVCS($(this))">关闭</button>
                            </div>
                          </div>
                          <div style="display:block; margin-top:20px; padding:0px 64px 0px 64px;">
                            <span style="color:#35a6e7; font-size:16px; font-weight:bold;">位置搜集:</span>
                            <div style="display:inline-block; border:1px #35a6e7 solid; border-radius:4px;">
                              <button type="button" class="<?php echo ((isset($values['geo_status']) && $values['geo_status'] == '1') ? 'button_active' : 'button_deactive');?>" onClick="setVCS($(this))">打开</button>
                              <button  type="button" class="<?php echo ((isset($values['geo_status']) && $values['geo_status'] == '1') ? 'button_deactive' : 'button_active');?>" onClick="setVCS($(this))">关闭</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>              
                </div>
              </div>
            </div>
          </div>
<script type="text/javascript" language="javascript">
<!--//
var pictures = <?php echo ($pictures ? json_encode($pictures) : 'false');?>;
var composes = <?php echo ($composes ? json_encode($composes) : 'false');?>;

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
        echo 'var picPreviewDimen = fixImgSize(' . $banner['dimen'][0] . ', ' . $banner['dimen'][1] . ', 400, 300);';
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
    uploadImg($(this), '.JPG,.PNG', 512);
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

// 添加图片
function addPic(){
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("<?php echo $picturesComponent;?>");
  // 设置folder
  formJQuery.children("input").eq(3).val("<?php echo $imagesFolder;?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $platformName . $pageName;?>图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("<?php echo $pageFile;?>");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加<?php echo $platformName . $pageName;?>图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为宽大于640px，文件小于512KB的.jpg、.gif或.png格式图片。");   
  // 清空预览图片
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(""); 
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 清空alt信息
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
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG,.GIF', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogTuiguangList.show(e, loadImgListWidget("TUIGUANG_LIST_DIALOG_DIV"));
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
// 设置图片
function setPic(ordnung){
  if(!ordnung || !pictures[ordnung - 1]){
    return false;
  }
  var picture = pictures[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val(picture.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("<?php echo $picturesComponent;?>");
  // 设置folder
  formJQuery.children("input").eq(3).val("<?php echo $imagesFolder;?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $platformName . $pageName;?>图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("<?php echo $pageFile;?>");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置<?php echo $platformName . $pageName;?>图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + picture.fileName.substring(picture.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(picture.size/10)/100 + "KB 图片尺寸：" + picture.width + " x " + picture.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为宽大于640px，文件小于512KB的.jpg、.gif或.png格式图片。"); 
  // 设置预览图片  
  var picPreviewDimen = fixImgSize(picture.width, picture.height, 400, 300);
  var picPreviewHtml = "<img src='" + picture.folderName + "/" + picture.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, picture.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 隐藏href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, picture.head);
  // 设置content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), true, picture.content);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((picture.folderName + "/" + picture.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((picture.folderName + "/" + picture.fileName).substring(27));
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG,.GIF', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogTuiguangList.show(e, loadImgListWidget("TUIGUANG_LIST_DIALOG_DIV"));
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
// 删除图片
function deletePic(id){
  if(!confirm("确定要删除此<?php echo $platformName . $pageName;?>图片吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_image", "id": id, "component": "<?php echo $picturesComponent;?>"},
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
// 前移图片
function movePrevPic(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_image", "id": id, "component": "<?php echo $picturesComponent;?>"},
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
// 后移图片
function moveNextPic(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_image", "id": id, "component": "<?php echo $picturesComponent;?>"},
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

// 设置插件，id为插件ID（tb_wcp_compose），如果id为空为插入新插件，否则为编辑插件
function setPlugIn(id){
  var form = $("#PLUGIN_FORM");
  var plugIn = false;
  form.find("input").val("");
  if(!id){
    form.find(".DialogTitle").text("添加新插件"); 
    dialogPlugIn.show('', loadPlugInListWidget());   
  }
  else{
    form.find("input").eq(0).val(id);
    form.find(".DialogTitle").text("设置插件");
    for(var i = 0; i < composes.length; i++){
      if(composes[i].id == id){
        plugIn = composes[i];
      }
    }
    if(plugIn){
      dialogPlugIn.show('', loadPlugInListWidget(parseInt(plugIn.plugInIndex)));
    }    
  }
  $("#PLUGIN_SUBMIT_BUTTON").unbind();
  $("#PLUGIN_SUBMIT_BUTTON").click(function(e) {
    var values = "";
    var name = "";
    $(this).parent().prev().children().each(function(index, element) {
      if($(this).find("textarea").val()){
        values += '"' + encodeURIComponent($(this).find("textarea").val()) + '",';  
      }
      else if($(this).find("input")){
        if($(this).find("input").attr("name") == "name"){
          name = $(this).find("input").val();
        }
        else{
          values += '"' + encodeURIComponent($(this).find("input").val()) + '",';  
        }
      }
    });
    if(values){
      values = "[" + values.substring(0, (values.length - 1)) + "]";
    }
    $.ajax({
      url: "wcp_svr.html",
      type: "POST",
      data: {"id":id, "action":"set_plugin", "name":name, "pageFile":"<?php echo $pageFile;?>", "plugInIndex":$(this).parent().parent().find("input").eq(1).val(), "json":values},
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
}

// 切换按钮          
function toggleButton(buttonJQuery){
  if(buttonJQuery.attr("class") == "button_deactive"){
    var another = buttonJQuery.parent().find("button.button_active");
    another.css("background-color", "");
    buttonJQuery.css("background-color", "");
    another.toggleClass("button_active");
    another.toggleClass("button_deactive");
    buttonJQuery.toggleClass("button_active");
    buttonJQuery.toggleClass("button_deactive");
  }
}
// 设置VCS状态
function setVCS(buttonJQuery){
  toggleButton(buttonJQuery);
  var panel = buttonJQuery.parents(".control_panel");
  var vcsPanel = panel.children("div").eq(0);
  var geoPanel = panel.children("div").eq(1);
  var vcsTurnOn = vcsPanel.find("button").eq(0);
  var vcsTurnOff = vcsPanel.find("button").eq(1);
  var geoTurnOn = geoPanel.find("button").eq(0);
  var geoTurnOff = geoPanel.find("button").eq(1);
  var vcsStatus = 0;
  var geoStatus = 0;
  if(vcsTurnOn.attr("class") == "button_active"){
    vcsStatus = 1;
    geoPanel.slideDown("slow");
    if(geoTurnOn.attr("class") == "button_active"){
      geoStatus = 1;
    }
  }
  else{
    vcsStatus = 0;
    if(geoTurnOn.attr("class") == "button_active"){
      toggleButton(geoTurnOff);
    }  
    geoPanel.slideUp("slow");
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"set_vcs", "pageFile":"<?php echo $pageFile;?>", "vcs_status":vcsStatus, "geo_status":geoStatus},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE != 1){                    
        alert(data.TEXT);
      }
      else{
        console.log(data.TEXT);
      }
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}

$(document).ready(function(e) {
  $("img").mouseover(function(e) {
    $(this).parent().prev("div").slideDown("slow");
  });
  $(".button_bar").mouseleave(function(e) {
    $(this).fadeOut("slow");
  });

});
//-->
</script>
<?php require('wcp_bottom.inc'); ?>