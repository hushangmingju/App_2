<?php require('wcp_head.inc'); ?>
<?php
$mGlobalLogo = false;
$mGlobalDropdown = false;
$mGlobalDropup = false;
$mGlobalMenuitems = array();
$mGlobalMenubottoms = array();
$mGlobalBottomButtons = array();

$images = new Query("*", "`tb_wcp_images`", "", "`pageID` = -1 AND `status` = 1", "ordnung");
$images = DAS::quickQuery($images);
if (DAS::hasData($images)) {
    foreach ($images['data'] as $image) {
        switch($image['component']) {
            case 'm_global_logo':
                $mGlobalLogo = $image;
                break;
            case 'm_global_dropdown':
                $mGlobalDropdown = $image;
                break;
            case 'm_global_dropup':
                $mGlobalDropup = $image;
                break;
            case 'm_global_menuitem':
                $mGlobalMenuitems[] = $image;
                break;
            case 'm_global_menubottom':
                $mGlobalMenubottoms[] = $image;
                break;
            case 'm_global_bottom':
                $mGlobalBottomButtons[] = $image;
                break;
        }
    }
}

$mGlobalMaxWidth = false;
$mGlobalBackgroundColor = false;
$mGlobalBottomBackgroundColor = false;
$mGlobalLeftBottomStyle = false;
$mGlobalRightBottomStyle = false;
$mGlobalLeftBottomFont = false;
$mGlobalRightBottomFont = false;
$mGlobalHeadCodes = false;
$mGlobalBodyCodes = false;

$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = -1 AND `status` = 1");
$contents = DAS::quickQuery($contents);
if (DAS::hasData($contents)) {
    foreach ($contents['data'] as $content) {
        switch($content['component']) {
            case 'maxWidth':
                $mGlobalMaxWidth = $content;
                break;
            case 'backgroundColor':
                $mGlobalBackgroundColor = $content;
                break;
            case 'bottom_backgroundColor':
                $mGlobalBottomBackgroundColor = $content;
                break;
            case 'left_button_style':
                $mGlobalLeftBottomStyle = $content;
                break;
            case 'right_button_style':
                $mGlobalRightBottomStyle = $content;
                break;
            case 'left_button_font':
                $mGlobalLeftBottomFont = $content;
                break;
            case 'right_button_font':
                $mGlobalRightBottomFont = $content;
                break;
            case 'head_codes':
                $mGlobalHeadCodes = $content['textType'] == 1 ? $content['contentChar'] : $content['contentText'];
                break;
            case 'body_codes':
                $mGlobalBodyCodes = $content['textType'] == 1 ? $content['contentChar'] : $content['contentText'];
                break;
        }
    }
}
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
                  <h2><i class="glyphicon glyphicon-info-sign"></i> 移动端全局设置</h2>
                </div>
                <div class="box-content row">
                  <div class="box col-md-12">
                    <!-- 全局头部参数设置表单 -->
                    <div class="box-inner">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">头部设置</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面头部Logo图，菜单按钮图标。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;">                        
                        <form>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px;">
                            <div style="display:block; width:90%; padding:24px 64px 0px 64px;">
                              <div style="display:inline-block; text-align:left; width:33%;">
                                <?php
                                if ($mGlobalLogo) {
                                    $mGlobalLogo['path'] = $mGlobalLogo['folderName'] . '/' . $mGlobalLogo['fileName'];
                                    $mGlobalLogo['suffix'] = substr($mGlobalLogo['fileName'], strrpos($mGlobalLogo['fileName'], '.'));
                                    $mGlobalLogo['size'] = round(filesize('../../images/pics/' . $mGlobalLogo['fileName']) / 1024, 2) . 'KB';
                                    $mGlobalLogo['dimen'] = getimagesize($mGlobalLogo['path']);
                                }
                                ?>
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">LOGO图片:</span>
                                <span style="display:block;">首页Logo图片，672x128px .jpg或 .png格式的图片。</span>
                                <button type="button" onClick="setLogo();" style="background-color:#35a6e7; border-radius:6px; width:180px;; padding:5px; border:none; font-size:14px; color:#FFF; margin-top:8px; display:block;">编辑LOGO图片</button>                              
                              </div>
                              <div style="display:inline-block; text-align:left; width:33%;">
                                <div style="width:64px; height:64px; float:right; margin-right:36px; display:inline-block; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; box-shadow:#888888 0px 2px 6px;">
                                  <?php
                                  if ($mGlobalDropdown) {
                                      $mGlobalDropdown['path'] = $mGlobalDropdown['folderName'] . '/' . $mGlobalDropdown['fileName'];
                                      $mGlobalDropdown['suffix'] = substr($mGlobalDropdown['fileName'], strrpos($mGlobalDropdown['fileName'], '.'));
                                      $mGlobalDropdown['size'] = round(filesize('../../images/icons/' . $mGlobalDropdown['fileName']) / 1024, 2) . 'KB';
                                      $mGlobalDropdown['dimen'] = getimagesize($mGlobalDropdown['path']);
                                      echo '<img src="' . $mGlobalDropdown['folderName'] . '/' . $mGlobalDropdown['fileName'] . '" style="width:64px; height:64px;" />';
                                  }
                                  ?>
                                  
                                </div>
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">菜单打开按钮:</span>
                                <span style="display:block;">顶部菜单打开图片，128x128px .jpg或 .png格式的图片。</span>
                                <button type="button" onClick="setMenuDropdownButton();" style="background-color:#35a6e7; border-radius:6px; width:180px;; padding:5px; border:none; font-size:14px; color:#FFF; margin-top:8px; display:block;">编辑菜单打开图标</button>                              
                              </div>
                              <div style="display:inline-block; text-align:left; width:33%;">
                                <div style="width:64px; height:64px; float:right; margin-right:36px; display:inline-block; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; box-shadow:#888888 0px 2px 6px;">
                                  <?php
                                  if ($mGlobalDropup) {
                                      $mGlobalDropup['path'] = $mGlobalDropup['folderName'] . '/' . $mGlobalDropup['fileName'];
                                      $mGlobalDropup['suffix'] = substr($mGlobalDropup['fileName'], strrpos($mGlobalDropup['fileName'], '.'));
                                      $mGlobalDropup['size'] = round(filesize('../../images/icons/' . $mGlobalDropup['fileName']) / 1024, 2) . 'KB';
                                      $mGlobalDropup['dimen'] = getimagesize($mGlobalDropup['path']);
                                      echo '<img src="' . $mGlobalDropup['folderName'] . '/' . $mGlobalDropup['fileName'] . '" style="width:64px; height:64px;" />';
                                  }
                                  ?>
                                </div>
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">菜单收起按钮:</span>
                                <span style="display:block;">顶部菜单收起图片，128x128px .jpg或 .png格式的图片。</span>
                                <button type="button" onClick="setMenuDropupButton();" style="background-color:#35a6e7; border-radius:6px; width:180px;; padding:5px; border:none; font-size:14px; color:#FFF; margin-top:8px; display:block;">编辑菜单收起图标</button>                              
                              </div>
                            </div>
                            <div style="width:100%; text-align:center; margin-top:20px; height:180px; background-color:#EFEFEF; padding-top:16px;">                     
                              <div style="float:left; display:inline-block; background-color:#35a6e7; color:#ffffff; margin-top:-16px; padding:3px 5px 3px 5px;">预览</div>
                              <div style="box-shadow:#888888 0px 3px 10px; margin-top:8px; display:inline-block; padding:0px; height:128px; width:800px; background-color:<?php echo $mGlobalBackgroundColor ? $mGlobalBackgroundColor['contentChar'] : '#FFFFFF';?>;">
                                <?php
                                if ($mGlobalLogo) {
                                    echo '<img src="' . $mGlobalLogo['folderName'] . '/' . $mGlobalLogo['fileName'] . '" style="width:672px; margin:0px; border:none; padding:0px;" />';
                                }
                                if ($mGlobalDropdown && $mGlobalDropup) {
                                    echo '<img src="' . $mGlobalDropdown['folderName'] . '/' . $mGlobalDropdown['fileName'] . '" onClick="if($(this).attr(\'src\')==\'' . $mGlobalDropdown['folderName'] . '/' . $mGlobalDropdown['fileName'] . '\'){$(this).attr(\'src\', \'' . $mGlobalDropup['folderName'] . '/' . $mGlobalDropup['fileName'] . '\');}else{$(this).attr(\'src\', \'' . $mGlobalDropdown['folderName'] . '/' . $mGlobalDropdown['fileName'] . '\');}" style="width:128px; cursor:pointer; margin:0px; border:none; padding:0px; float:right;" />';
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- 全局基本参数设置表单 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">基本内容</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面关键词、描述、背景色。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;">                      
                        <form> 
                          <input type="hidden" name="action" value="set_contents_group">
                          <input type="hidden" name="pageFile" value="mobile/top.inc"/>
                          <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px;">
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面最大宽度:</span>
                                <input type="text" name="maxWidth" value="<?php echo $mGlobalMaxWidth ? $mGlobalMaxWidth['contentChar'] : '';?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                                <span style="margin-left:20px;">body CSS max-width属性，整个页面的最大宽度，默认为800px，该显示属性可提高移动端页面在电脑端浏览器的浏览体验。（选填）</span>
                              </div>                            
                            </div>
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">                              
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面背景颜色:</span>
                                <a onClick="$(this).next().css('background-color', $(this).next().next().val());" style="cursor:pointer; display:inline-block; position:relative; right:-186px;">预览</a>                             
                                <div style="width:20px; height:20px; margin-left:20px; display:inline-block; box-shadow:#888888 0px 2px 6px; position:relative; right:-176px; margin-bottom:-4px;"></div>
                                <input type="text" name="backgroundColor" value="<?php echo $mGlobalBackgroundColor ? $mGlobalBackgroundColor['contentChar'] : '';?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:-57px;"/>
                                <span style="margin-left:20px;">body CSS background-color属性，整个页面的背景色，默认为白色，填写格式#FFFFFF或rgba(255,255,255,1.00)（选填）</span> 
                              </div>                            
                            </div>
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div>
                          <div style="display:block; margin-top:24px; text-align:center;">
                            <button type="button" onClick="setContentsGroup($(this).parent().prev());" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- 下拉菜单内容编辑表单 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">菜单设置</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置右上角下拉菜单的内容。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;">                      
                        <div style="width:100%;">
                          <div style="display:inline-block; width:46%; border:#888888 1px dashed; padding-bottom:36px; margin-left:24px; margin-top:48px; border-radius:15px;">
                            <div style="display:inline-block; color:#35a6e7; background-color:#FFFFFF; padding:12px; font-size:18px; font-weight:bold; margin-left:36px; position:relative; top:-28px;">菜单列表</div>
                            <?php
                            foreach ($mGlobalMenuitems as $mGlobalMenuitem) {
                            ?>
                            <div style="display:inline-block; width:100%; padding:0px 64px 0px 64px; margin-top:<?php echo $mGlobalMenuitem['ordnung'] > 1 ? '20px' : '-64px';?>;">
                              <div style="display:inline-block; text-align:left; background-color:#FFFFFF; border:1px #888888 solid; height:40px; padding-top:5px; padding-left:12px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">                                  
                                <a href="<?php echo $mGlobalMenuitem['href'];?>" target="_blank">
                                  <img src="<?php echo $mGlobalMenuitem['folderName'] . '/' . $mGlobalMenuitem['fileName'];?>" style="height:32px; margin-top:-3px;">
                                  <span style="color:#000000; font-size:16px; font-weight:bold;"><?php echo $mGlobalMenuitem['head'];?></span>
                                </a>
                                <a onClick="deleteMenuItem(<?php echo $mGlobalMenuitem['id'];?>);" class="icon_button2" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                <a onClick="setMenuItem(<?php echo $mGlobalMenuitem['ordnung'];?>)" class="icon_button2" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-edit" title="编辑"></i></a>
                                <?php
                                if ($mGlobalMenuitem['ordnung'] > 1) {
                                ?>
                                <a onClick="switchUpMenuItem(<?php echo $mGlobalMenuitem['id'];?>)" class="icon_button2" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-arrow-up" title="上移"></i></a>
                                <?php
                                }
                                else {
                                ?>
                                <div style="font-size:18px; float:right; margin-right:14px; margin-top:4px; color:#AAAAAA;"><i class="glyphicon glyphicon-arrow-up"></i></div>
                                <?php
                                }
                                if ($mGlobalMenuitem['ordnung'] < count($mGlobalMenuitems)) {
                                ?>
                                <a onClick="switchDownMenuItem(<?php echo $mGlobalMenuitem['id'];?>)" class="icon_button2" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-arrow-down" title="下移"></i></a>
                                <?php
                                }
                                else {
                                ?>
                                <div style="font-size:18px; float:right; margin-right:14px; margin-top:4px; color:#AAAAAA;"><i class="glyphicon glyphicon-arrow-down"></i></div>
                                <?php
                                }
                                ?>
                              </div>
                            </div>
                            <?php
                            }
                            ?>                                
                            <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <a onclick="addMenuItem();" target="_blank">
                                <div style="display:inline-block; text-align:left; background-color:#FFFFFF; border:1px #888888 solid; height:40px; padding-top:5px; padding-left:12px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">                                  
                                  <i class="glyphicon glyphicon-plus" title="添加条目" style="display:inline-block; margin-top:3px; margin-left:12px;"> <b>添加条目</b></i>
                                </div>
                              </a>
                            </div>
                          </div>                            
                          <div style="display:inline-block; width:46%; border:#888888 1px dashed; padding-bottom:36px; margin-left:24px; margin-top:48px; border-radius:15px;">
                            <div style="display:inline-block; color:#35a6e7; background-color:#FFFFFF; padding:12px; font-size:18px; font-weight:bold; margin-left:36px; position:relative; top:-28px;">菜单底部按钮</div>
                            <?php
                            foreach ($mGlobalMenubottoms as $mGlobalMenubottom) {
                            ?>
                            <div style="display:inline-block; width:100%; padding:0px 64px 0px 64px; margin-top:<?php echo $mGlobalMenubottom['ordnung'] > 1 ? '20px' : '-64px';?>;">
                              <div style="display:inline-block; text-align:left; background-color:#FFFFFF; border:1px #888888 solid; height:40px; padding-top:5px; padding-left:12px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">                                  
                                <a href="<?php echo $mGlobalMenubottom['href'];?>" target="_blank">
                                  <img src="<?php echo $mGlobalMenubottom['folderName'] . '/' . $mGlobalMenubottom['fileName'];?>" style="height:32px; margin-top:-3px;">
                                  <span style="color:#000000; font-size:16px; font-weight:bold;"><?php echo $mGlobalMenubottom['head'];?></span>
                                </a>
                                <a class="icon_button2" onClick="setMenuBottom(<?php echo $mGlobalMenubottom['ordnung'];?>)" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-edit" title="编辑"></i></a>
                              </div>
                            </div>
                            <?php
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- 底部按钮编辑表单 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">底部设置</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面底部按钮的内容。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <div style="width:100%;">  
                          <form> 
                            <input type="hidden" name="action" value="set_contents_group">
                            <input type="hidden" name="pageFile" value="mobile/bottom.inc"/>
                            <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                            <div style="display:inline-block; width:94%; border:#888888 1px dashed; padding-bottom:36px; margin-left:24px; margin-top:48px; border-radius:15px;">
                              <div style="display:inline-block; color:#35a6e7; background-color:#FFFFFF; padding:12px; font-size:18px; font-weight:bold; margin-left:36px; position:relative; top:-28px;">页面底部按钮CSS样式表</div>
                              <div style="display:inline-block; width:90%; margin-top:-24px; padding:0px 64px 12px 64px;">
                                <div style="display:block; text-align:left;">                              
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">底部按钮栏背景颜色:</span>
                                  <a onClick="$(this).next().css('background-color', $(this).next().next().val());" style="cursor:pointer; display:inline-block; position:relative; right:-186px;">预览</a>                             
                                  <div style="width:20px; height:20px; margin-left:20px; display:inline-block; box-shadow:#888888 0px 2px 6px; position:relative; right:-176px; margin-bottom:-4px; background-color:#4C4C4C;"></div>
                                  <input type="text" name="bottom_backgroundColor" value="<?php echo $mGlobalBottomBackgroundColor ? $mGlobalBottomBackgroundColor['contentChar'] : '';?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:-57px;"/>
                                  <span style="margin-left:20px;">底部按钮栏整体 CSS background-color属性，填写格式#FFFFFF或rgba(255,255,255,1.00)（选填）</span> 
                                </div>                            
                              </div>
                              <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">左侧按钮CCS:</span>
                                  <span>底部左侧悬浮按钮CSS样式代码，可用于自定义按钮的长宽，背景颜色等。（选填）</span>
                                </div>
                                <input type="text" name="left_button_style" value="<?php echo $mGlobalLeftBottomStyle ? $mGlobalLeftBottomStyle['contentChar'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                              </div>
                              <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">右侧按钮CCS:</span>
                                  <span>底部右侧悬浮按钮CSS样式代码，可用于自定义按钮的长宽，背景颜色等。（选填）</span>
                                </div>
                                <input type="text" name="right_button_style" value="<?php echo $mGlobalRightBottomStyle ? $mGlobalRightBottomStyle['contentChar'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                              </div>
                              <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">左侧按钮文字CCS:</span>
                                  <span>底部左侧悬浮按钮文字CSS样式代码，用以自定义按钮文字的字体、颜色、大小等。（选填）</span>
                                </div>
                                <input type="text" name="left_button_font" value="<?php echo $mGlobalLeftBottomFont ? $mGlobalLeftBottomFont['contentChar'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                              </div>
                              <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">右侧按钮文字CCS:</span>
                                  <span>底部右侧悬浮按钮文字CSS样式代码，用以自定义按钮文字的字体、颜色、大小等。（选填）</span>
                                </div>
                                <input type="text" name="right_button_font" value="<?php echo $mGlobalRightBottomFont ? $mGlobalRightBottomFont['contentChar'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                              </div>
                              <div style="display:block; margin-top:24px; text-align:center;">
                                <button type="button" onClick="setContentsGroup($(this).parent().parent());" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                              </div>
                            </div>
                          </form>
                          <div style="display:inline-block; width:94%; border:#888888 1px dashed; padding-bottom:36px; margin-left:24px; margin-top:48px; border-radius:15px;">
                            <div style="display:inline-block; color:#35a6e7; background-color:#FFFFFF; padding:12px; font-size:18px; font-weight:bold; margin-left:36px; position:relative; top:-28px;">页面底部按钮图标文字编辑</div>
                            <div style="display:block;">
                              <div style="display:inline-block; width:43%; padding:0px 64px 0px 64px;">
                                <div style="display:inline-block; text-align:left; background-color:#4C4C4C; height:64px; padding:0px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">                                  
                                  <a href="<?php echo $mGlobalBottomButtons[0]['href'];?>" target="_blank">
                                    <img src="<?php echo $mGlobalBottomButtons[0]['folderName'] . '/' . $mGlobalBottomButtons[0]['fileName'];?>" <?php echo $mGlobalBottomButtons[0]['css'] ? 'style="' . $mGlobalBottomButtons[0]['css'] . '"' : '';?>/>
                                    <span style="color:#FFFFFF; font-size:16px; font-weight:bold; display:inline-block; margin-top:16px;"><?php echo $mGlobalBottomButtons[0]['head'];?></span>
                                  </a>
                                  <a class="icon_button2" onClick="setBottomButton(1)" style="font-size:22px; float:right; margin-right:14px; margin-top:17px; color:#FFFFFF; display:inline-block;"><i class="glyphicon glyphicon-edit" title="编辑"></i></a>
                                </div>
                              </div>
                              <div style="display:inline-block; width:43%; padding:0px 64px 0px 64px;">
                                <div style="display:inline-block; text-align:left; background-color:#4C4C4C; height:64px; padding:0px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">                                  
                                  <a href="<?php echo $mGlobalBottomButtons[1]['href'];?>" target="_blank">
                                    <img src="<?php echo $mGlobalBottomButtons[1]['folderName'] . '/' . $mGlobalBottomButtons[1]['fileName'];?>" <?php echo $mGlobalBottomButtons[1]['css'] ? 'style="' . $mGlobalBottomButtons[1]['css'] . '"' : '';?>/>
                                    <span style="color:#FFFFFF; font-size:16px; font-weight:bold; display:inline-block; margin-top:16px;"><?php echo $mGlobalBottomButtons[1]['head'];?></span>
                                  </a>
                                  <a class="icon_button2" onClick="setBottomButton(2)" style="font-size:22px; float:right; margin-right:14px; margin-top:17px; color:#FFFFFF; display:inline-block;"><i class="glyphicon glyphicon-edit" title="编辑"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div style="width:100%; text-align:center; margin-top:20px; height:180px; background-color:#EFEFEF; padding-top:16px;">                     
                          <div style="float:left; display:inline-block; background-color:#35a6e7; color:#ffffff; margin-top:-16px; padding:3px 5px 3px 5px;">预览</div>
                          <div style="box-shadow:#888888 0px 3px 10px; margin-top:8px; display:inline-block; padding:0px; height:128px; width:480px; background-color:<?php echo $mGlobalBackgroundColor ? $mGlobalBackgroundColor['contentChar'] : '#FFFFFF';?>;">
                            <div style="background-color:<?php echo $mGlobalBottomBackgroundColor ? $mGlobalBottomBackgroundColor['contentChar'] : 'rgba(0, 0, 0, 0)';?>; display:block; text-align:left; position:relative; bottom:-80px;">
                              <a target="_blank" href="<?php echo $mGlobalBottomButtons[0]['href'];?>" <?php echo $mGlobalLeftBottomStyle ? 'style="' . $mGlobalLeftBottomStyle['contentChar'] . '"' : '';?>>
                                <img src="<?php echo $mGlobalBottomButtons[0]['folderName'] . '/' . $mGlobalBottomButtons[0]['fileName'];?>" <?php echo $mGlobalBottomButtons[0]['css'] ? 'style="' . $mGlobalBottomButtons[0]['css'] . '"' : '';?>>
                                <span <?php echo $mGlobalLeftBottomFont ? 'style="' . $mGlobalLeftBottomFont['contentChar'] . '"' : '';?>><?php echo $mGlobalBottomButtons[0]['head'];?></span>
                              </a>
                              <a target="_blank" href="<?php echo $mGlobalBottomButtons[1]['href'];?>" <?php echo $mGlobalRightBottomStyle ? 'style="' . $mGlobalRightBottomStyle['contentChar'] . '"' : '';?>>
                                <img src="<?php echo $mGlobalBottomButtons[1]['folderName'] . '/' . $mGlobalBottomButtons[1]['fileName'];?>" <?php echo $mGlobalBottomButtons[1]['css'] ? 'style="' . $mGlobalBottomButtons[1]['css'] . '"' : '';?>>
                                <span <?php echo $mGlobalRightBottomFont ? 'style="' . $mGlobalRightBottomFont['contentChar'] . '"' : '';?>><?php echo $mGlobalBottomButtons[1]['head'];?></span>
                              </a>
                            </div>
                          </div>
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
                          <input type="hidden" name="pageFile" value="mobile/top.inc"/>
                          <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">头部代码:</span>
                                <span>在&lt;/head&gt;标签前插入的代码，注意：插入Javascript代码必须包含&lt;script&gt;&lt;/script&gt;标签（选填）</span>
                              </div>
                              <textarea name="head_codes" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; height:80px;"><?php echo $mGlobalHeadCodes ? rawurldecode($mGlobalHeadCodes) : '';?></textarea>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">正文代码:</span>
                                <span>在&lt;/body&gt;标签前插入的代码，注意：插入Javascript代码必须包含&lt;script&gt;&lt;/script&gt;标签（选填）</span>
                              </div>
                              <textarea name="body_codes" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; height:80px;"><?php echo $mGlobalBodyCodes ? rawurldecode($mGlobalBodyCodes) : '';?></textarea>
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
          </div>
<script type="text/javascript" language="javascript">
<!--//

var menuItems = <?php echo json_encode($mGlobalMenuitems);?>;
var menuBottoms = <?php echo json_encode($mGlobalMenubottoms);?>;
var mGlobalBottomButtons = <?php echo json_encode($mGlobalBottomButtons);?>;

// 设置logo图片
function setLogo(){
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(<?php echo $mGlobalLogo ? $mGlobalLogo['id'] : '';?>);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_logo");
  // 设置folder
  formJQuery.children("input").eq(3).val("pics");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局Logo图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置Logo图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"76px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("<?php echo $mGlobalLogo ? ('文件类型：' . $mGlobalLogo['suffix'] . ' 大小：' . $mGlobalLogo['size'] . ' 图片尺寸：' . $mGlobalLogo['dimen'][0] . ' x ' . $mGlobalLogo['dimen'][1] . 'px') : '';?>");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为672x128px或同比例扩大，文件小于256KB的.jpg或.png格式图片。");      
  // 设置预览图片
  <?php
  if ($mGlobalLogo) {
      echo 'var picPreviewDimen = fixImgSize(' . $mGlobalLogo['dimen'][0] . ', ' . $mGlobalLogo['dimen'][1] . ', 400, 76);';
      echo 'var picPreviewHtml = "<img src=\'' . $mGlobalLogo['path'] . '\' style=\'width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px\'/>";';
  }
  else {
      echo 'var picPreviewHtml = "";';
  }
  ?>
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, "<?php echo $mGlobalLogo ? $mGlobalLogo['alt'] : '';?>");
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, "<?php echo $mGlobalLogo ? $mGlobalLogo['href'] : '';?>");
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val("<?php echo $mGlobalLogo ? substr($mGlobalLogo['path'], 27) : '';?>");
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("<?php echo $mGlobalLogo ? substr($mGlobalLogo['path'], 27) : '';?>");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 256);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogPicsList.show(e, loadImgListWidget("PICS_LIST_DIALOG_DIV"));
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
// 设置菜单收起按钮
function setMenuDropdownButton(){
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(<?php echo $mGlobalDropdown ? $mGlobalDropdown['id'] : '';?>);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_dropdown");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局下拉菜单下拉按钮");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置菜单下拉按钮:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"256px","height":"256px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("<?php echo $mGlobalDropdown ? '文件类型：' . $mGlobalDropdown['suffix'] . ' 大小：' . $mGlobalDropdown['size'] . ' 图片尺寸：' . $mGlobalDropdown['dimen'][0] . ' x ' . $mGlobalDropdown['dimen'][1] . 'px' : '';?>");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为128x128px或同比例扩大，文件小于128KB的.jpg或.png格式图片。");      
  // 设置预览图片
  <?php
  if ($mGlobalDropdown) {
      echo 'var picPreviewDimen = fixImgSize(' . $mGlobalDropdown['dimen'][0] . ', ' . $mGlobalDropdown['dimen'][1] . ', 256, 256);';
      echo 'var picPreviewHtml = "<img src=\'' . $mGlobalDropdown['path'] . '\' style=\'width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px\'/>";';
  }
  else {
      echo 'var picPreviewHtml = "";';
  }
  ?>
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, "<?php echo $mGlobalDropdown ? $mGlobalDropdown['alt'] : '';?>");
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val("<?php echo $mGlobalDropdown ? substr($mGlobalDropdown['path'], 27) : '';?>");
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("<?php echo $mGlobalDropdown ? substr($mGlobalDropdown['path'], 27) : '';?>");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 128);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
// 设置菜单收起按钮
function setMenuDropupButton(){
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(<?php echo $mGlobalDropup ? $mGlobalDropup['id'] : '';?>);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_dropup");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局下拉菜单收起按钮");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置菜单收起按钮:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"256px","height":"256px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("<?php echo $mGlobalDropup ? '文件类型：' . $mGlobalDropup['suffix'] . ' 大小：' . $mGlobalDropup['size'] . ' 图片尺寸：' . $mGlobalDropup['dimen'][0] . ' x ' . $mGlobalDropup['dimen'][1] . 'px' : '';?>");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为128x128px或同比例扩大，文件小于128KB的.jpg或.png格式图片。");      
  // 设置预览图片
  <?php
  if ($mGlobalDropup) {
      echo 'var picPreviewDimen = fixImgSize(' . $mGlobalDropup['dimen'][0] . ', ' . $mGlobalDropup['dimen'][1] . ', 256, 256);';
      echo 'var picPreviewHtml = "<img src=\'' . $mGlobalDropup['path'] . '\' style=\'width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px\'/>";';
  }
  else {
      echo 'var picPreviewHtml = "";';
  }
  ?> 
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, "<?php echo $mGlobalDropup ? $mGlobalDropup['alt'] : '';?>");
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val("<?php echo $mGlobalDropup ? substr($mGlobalDropup['path'], 27) : '';?>");
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("<?php echo $mGlobalDropup ? substr($mGlobalDropup['path'], 27) : '';?>");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 128);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
// 添加菜单条目
function addMenuItem(){
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_menuitem");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局下拉菜单条目");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加菜单条目:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"128px","height":"128px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为64x64px或同比例扩大，文件小于16KB的.jpg或.png格式图片。");   
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
  // 清空head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 清空图片路径信息
  formJQuery.find("input#IMG_PATH").val("");
  // 清空图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 16);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
// 设置菜单条目
function setMenuItem(ordnung){
  if(!ordnung || !menuItems[ordnung - 1]){
    return false;
  }
  var menuItem = menuItems[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val(menuItem.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_menuitem");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局下拉菜单条目");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加菜单条目:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"128px","height":"128px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + menuItem.fileName.substring(menuItem.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(menuItem.size/10)/100 + "KB 图片尺寸：" + menuItem.width + " x " + menuItem.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为64x64px或同比例扩大，文件小于16KB的.jpg或.png格式图片。");   
  // 设置预览图片  
  var picPreviewDimen = fixImgSize(menuItem.width, menuItem.height, 128, 128);
  var picPreviewHtml = "<img src='" + menuItem.folderName + "/" + menuItem.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, menuItem.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, menuItem.href);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, menuItem.head);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((menuItem.folderName + "/" + menuItem.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((menuItem.folderName + "/" + menuItem.fileName).substring(27));
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 16);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
// 设置菜单按钮
function setMenuBottom(ordnung){
  if(!ordnung || !menuItems[ordnung - 1]){
    return false;
  }
  var menuBottom = menuBottoms[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(menuBottom.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_menubottom");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局下拉菜单底部按钮");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/top.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置菜单底部按钮:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"128px","height":"128px","display":"inline-block"});  
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + menuBottom.fileName.substring(menuBottom.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(menuBottom.size/10)/100 + "KB 图片尺寸：" + menuBottom.width + " x " + menuBottom.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为64x64px或同比例扩大，文件小于16KB的.jpg或.png格式图片。");   
  // 设置预览图片
  var picPreviewDimen = fixImgSize(menuBottom.width, menuBottom.height, 128, 128);
  var picPreviewHtml = "<img src='" + menuBottom.folderName + "/" + menuBottom.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";  
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml); 
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, menuBottom.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, menuBottom.href);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, menuBottom.head);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((menuBottom.folderName + "/" + menuBottom.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((menuBottom.folderName + "/" + menuBottom.fileName).substring(27));
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 16);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
// 删除菜单条目
function deleteMenuItem(id){
  if(!confirm("确定要删除此菜单条目吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_image", "id": id, "component": "m_global_menuitem"},
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
// 上移菜单条目
function switchUpMenuItem(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_image", "id": id, "component": "m_global_menuitem"},
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
// 下移菜单条目
function switchDownMenuItem(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_image", "id": id, "component": "m_global_menuitem"},
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
// 设置底部按钮
function setBottomButton(ordnung){
  if(!ordnung || !mGlobalBottomButtons[ordnung - 1]){
    return false;
  }
  var bottomButton = mGlobalBottomButtons[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(bottomButton.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_global_bottom");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端全局底部按钮");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/bottom.inc");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置移动端全局底部按钮:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"128px","height":"128px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + bottomButton.fileName.substring(bottomButton.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(bottomButton.size/10)/100 + "KB 图片尺寸：" + bottomButton.width + " x " + bottomButton.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为64x64px或同比例扩大，文件小于128KB的.jpg或.png格式图片。");      
  // 设置预览图片
  var picPreviewDimen = fixImgSize(bottomButton.width, bottomButton.height, 128, 128);
  var picPreviewHtml = "<img src='" + bottomButton.folderName + "/" + bottomButton.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";  
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, bottomButton.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), true, bottomButton.title);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, bottomButton.href);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, bottomButton.head);
  // 清空content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 设置CSS信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), true, bottomButton.css);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((bottomButton.folderName + "/" + bottomButton.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((bottomButton.folderName + "/" + bottomButton.fileName).substring(27));
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 128);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));
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
    data: {"action":"set_vcs", "pageFile":"mobile/top.inc", "vcs_status":vcsStatus, "geo_status":geoStatus},
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
//-->
</script>
<?php require('wcp_bottom.inc'); ?>