<?php require('wcp_head.inc'); ?>
<?php
$contents = new Query("*", "`tb_wcp_contents`", "", "`pageID` = 49 AND `status` = 1");
$contents = DAS::quickQuery($contents);
$contents = $contents['data'];
$contentsArray = array();
foreach ($contents as $content) {
    if ($content['component'] != 'm_index_headline') {
        $contentsArray[$content['component']] = $content['textType'] = 1 ? $content['contentChar'] : $content['contentText'];
    }    
}
$banners = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `component` = 'm_index_banner'", "`ordnung`");
$banners = DAS::quickQuery($banners);
$banners = DAS::hasData($banners) ? $banners['data'] : false;
$navButtons = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `component` = 'm_index_navbutton'", "`ordnung`");
$navButtons = DAS::quickQuery($navButtons);
$navButtons = DAS::hasData($navButtons) ? $navButtons['data'] : false;
$headLines = new Query("*", "`tb_wcp_contents`", "", "`component` = 'm_index_headline' AND `status` = 1", "`ordnung`");
$headLines = DAS::quickQuery($headLines);
$headLines = DAS::hasData($headLines) ? $headLines['data'] : false;
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
                  <h2><i class="glyphicon glyphicon-info-sign"></i> <a href="http://www.mingjugroup.com/mobile/index.html" target="_blank">移动端首页 mobile/index.html</a></h2>
                </div>
                <div class="box-content row">
                  <div class="box col-md-12">
                    <!-- 基本内容编辑栏-->
                    <div class="box-inner">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">基本内容</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置页面关键词、描述、背景色。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="set_contents_group">
                          <input type="hidden" name="pageFile" value="mobile/index.php"/>
                          <input type="hidden" id="CONTENTS_FORM_PARAMETER" name="formParameter" value=""/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:block; width:90%; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">标题:</span>
                                <span>title标签 页面标题，该内容将显示在浏览器标签页上以及作为页面收藏的标题。（选填）</span>
                              </div>
                              <input type="text" name="title" value="<?php echo isset($contentsArray['title']) ? $contentsArray['title'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">关键词:</span>
                                <span>meta标签 keywords属性 可以填写网页关键词，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="keywords" value="<?php echo isset($contentsArray['keywords']) ? $contentsArray['keywords'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">描述:</span>
                                <span>meta标签 description属性 可以填写网页描述，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="description" value="<?php echo isset($contentsArray['description']) ? $contentsArray['description'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">                              
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面背景颜色:</span>
                                <a onClick="$(this).next().css('background-color', $(this).next().next().val());" style="cursor:pointer; display:inline-block; position:relative; right:-186px;">预览</a>                             
                                <div style="width:20px; height:20px; margin-left:20px; display:inline-block; box-shadow:#888888 0px 2px 6px; position:relative; right:-176px; margin-bottom:-4px; background-color:<?php echo isset($contentsArray['backgroundColor']) ? $contentsArray['backgroundColor'] : '';?>;"></div>
                                <input type="text" name="backgroundColor" value="<?php echo isset($contentsArray['backgroundColor']) ? $contentsArray['backgroundColor'] : '';?>" style="width:240px;; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:-57px;"/>
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
                    <!-- Banner图编辑栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">Banner图</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以添加、删除、编辑首页的Banner图片，还可以调整图片的显示顺序。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px; display:none;">
                        <?php                        
                        if ($banners) {
                            foreach ($banners as $banner) {
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                            <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                              <a class="icon_button" onClick="deleteMIndexBanner(<?php echo $banner['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                            <?php
                                if ($banner['href']) {
                            ?>
                              <a href="<?php echo $banner['href'];?>" class="icon_button" target="_blank" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-share-alt" title="超链接"></i></a>
                            <?php
                                }
                            ?>
                              <a class="icon_button" onClick="setMIndexBanner(<?php echo $banner['ordnung'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                            <?php
                                if ($banner['ordnung'] < count($banners)) {
                            ?>
                              <a class="icon_button" onClick="moveNextMIndexBanner(<?php echo $banner['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                            <?php
                                }
                                if ($banner['ordnung'] > 1) {
                            ?>
                              <a class="icon_button" onClick="movePrevMIndexBanner(<?php echo $banner['id'];?>);" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                            <?php
                                }
                            ?>
                            </div>
                          </div>                      
                          <img src="<?php echo $banner['folderName'] . '/' . $banner['fileName'];?>" style="width:320px;">
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;">
                            <span style="display:block; display:inline-block;">注释：<?php echo $banner['alt'];?></span>
                          </div>
                        </div>  
                        <?php
                            }
                        }
                        ?>
                        <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <a onClick="addMIndexBanner();" style="cursor:pointer;">
                            <div style="position:relative; display:inline-block; bottom:-246px; color:#FFFFFF; width:330px; text-align:center; font-size:25px; letter-spacing:2px; font-weight:bold;">点击添加图片</div>
                            <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new.png" style="width:320px; background-color:#C0C0C0;">
                            <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#C0C0C0; padding:5px 5px 5px 5px;">
                              <span style="width:310px; display:inline-block;"></span>
                            </div>                          
                          </a>
                        </div>                          
                      </div>
                    </div>
                    <!-- 导航按钮编辑栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">导航按钮</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置移动端首页导航按钮图标，最多可以排列6个图标。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;">
                        <div style="width:100%; box-shadow:#888888 0px 3px 10px;">
                          <div style="display:block; width:90%; padding:24px 64px 0px 64px;">
                          <?php                        
                          if ($navButtons) {
                              foreach ($navButtons as $navButton) {
                          ?>
                            <div style="display:inline-block; text-align:left; width:16%;">
                              <div style="width:128px; height:162px; display:inline-block; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; box-shadow:#888888 0px 2px 6px;">
                                <a onClick="setMIndexNavButton(<?php echo $navButton['ordnung'];?>);" style="cursor:pointer;">
                                  <img src="<?php echo $navButton['folderName'] . '/' . $navButton['fileName'];?>" style="width:128px; height:128px;" />
                                </a>
                                <div style="background-color:#FFFFFF; display:inline-block; width:100%; position:relative; margin-bottom:-6px; padding:5px;">
                                  <a class="icon_button2" onClick="deleteMIndexNavButton(<?php echo $navButton['id'];?>)" style="font-size:18px; float:right; margin-right:14px;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <?php
                                  if ($navButton['ordnung'] < count($navButtons)) {
                                  ?>
                                  <a class="icon_button2" onClick="moveNextMIndexNavButton(<?php echo $navButton['id'];?>)" style="font-size:18px; float:right; margin-right:14px;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($navButton['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button2" onClick="movePrevMIndexNavButton(<?php echo $navButton['id'];?>)" href="#" style="font-size:18px; float:right; margin-right:14px;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>                                  
                                </div> 
                              </div>                         
                            </div>
                          <?php
                              }
                          }
                          if (count($navButtons) < 6) {
                          ?>
                            <div style="display:inline-block; text-align:left; width:16%; top:-74px; position:relative;">
                              <div style="width:128px; height:162px; display:inline-block; box-shadow:#888888 0px 2px 6px; background-color:#c9c9c9;">
                                <a onClick="addMIndexNavButton();" style="cursor:pointer;">
                                  <img src="http://www.mingjugroup.com/charisma/img/wcp/add_new_nav_button.jpg" style="width:128px; height:160px;" />
                                </a>
                              </div>                             
                            </div>
                          <?php
                          }
                          ?>
                          </div>
                          <div style="width:100%; text-align:center; margin-top:20px; background-color:#EFEFEF; padding-top:16px; padding-bottom:20px;">                     
                            <div style="float:left; display:inline-block; background-color:#35a6e7; color:#ffffff; margin-top:-16px; padding:3px 5px 3px 5px;">预览</div>
                            <div style="text-align:center; box-shadow:#888888 0px 3px 10px; margin-top:8px; display:inline-block; padding:0px; background-color:#FFFFFF; width:800px;">
                            <?php                        
                            if ($navButtons) {
                                $width = ceil(100 / count($navButtons)) - 2;
                                foreach ($navButtons as $navButton) {
                            ?>
                              <a href="<?php echo $navButton['href'];?>" target="_blank">
                                <img src="<?php echo $navButton['folderName'] . '/' . $navButton['fileName'];?>" style="width:<?php echo $width;?>%;" />
                              </a>
                            <?php
                                }
                            }
                            ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- 头条编辑栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">编辑头条</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以编辑装修头条的条目及内容。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <div style="width:100%;">
                          <div style="display:inline-block; width:90%; padding-bottom:36px; margin-left:24px; margin-top:48px;">
                          <?php
                          if ($headLines) {
                              foreach ($headLines as $headLine) {
                          ?>
                            <div style="display:inline-block; width:100%; margin-top:<?php echo $headLine['ordnung'] > 1 ? 20 : 0;?>px; padding:0px 64px 0px 64px;">
                              <div style="display:inline-block; text-align:left; background-color:#FFFFFF; border:1px #888888 solid; height:40px; padding-top:6px; padding-left:12px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">
                                <div style="display:none;">
                                  <input type="text" value="" name="content" style="width:100%; border-radius:3px; border:1px solid #AAAAAA;" />                                    
                                  <button type="button" onClick="setHeadLine($(this).prev(), <?php echo $headLine['id'];?>)" style="position:relative; top:-24px; float:right; width:96px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF;">提交</button>
                                  <a onClick="$(this).parent().hide('slow','',$(this).parent().next().next().show('slow'));" style="float:right; margin-right:10px; position:relative; top:-21px; cursor:pointer;">取消</a>
                                </div>
                                <div style="display:none;">
                                  <input type="text" value="" name="href" style="width:100%; border-radius:3px; border:1px solid #AAAAAA;" />                                    
                                  <button type="button" onClick="setHeadLineHref($(this).prev(), <?php echo $headLine['id'];?>)" style="position:relative; top:-24px; float:right; width:96px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF;">提交</button>
                                  <a onClick="$(this).parent().hide('slow','',$(this).parent().next().show('slow'));" style="float:right; margin-right:10px; position:relative; top:-21px; cursor:pointer;">取消</a>
                                </div>
                                <div>
                                  <a <?php echo $headLine['href'] ? 'href="' . $headLine['href'] . '"' : '';?> target="_blank">
                                    <span style="color:#000000; font-size:16px; font-weight:bold;"><?php echo $headLine['contentChar'];?></span>
                                  </a>
                                  <a class="icon_button2" onClick="deleteHeadLine(<?php echo $headLine['id'];?>)" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button2" onClick="$(this).parent().prev().prev().find('input').val($(this).prev().prev().children('span').text());$(this).parent().hide('fast','',$(this).parent().prev().prev().show('slow'));" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;">
                                    <i class="glyphicon glyphicon-edit" title="编辑内容"></i>
                                  </a>
                                  <a class="icon_button2" onClick="$(this).parent().prev().find('input').val($(this).prev().prev().prev().attr('href'));$(this).parent().hide('fast','',$(this).parent().prev().show('slow'));" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;">
                                    <i class="glyphicon glyphicon-share-alt" title="编辑链接"></i>
                                  </a>
                                  <?php
                                  if ($headLine['ordnung'] < count($headLines)) {
                                  ?>
                                  <a class="icon_button2" onClick="moveNextHeadLine(<?php echo $headLine['id'];?>)" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;">
                                    <i class="glyphicon glyphicon-arrow-down" title="下移"></i>
                                  </a>
                                  <?php    
                                  }
                                  else {
                                  ?>
                                  <div style="font-size:18px; float:right; margin-right:14px; margin-top:4px; color:#AAAAAA;"><i class="glyphicon glyphicon-arrow-down"></i></div>
                                  <?php
                                  }
                                  if ($headLine['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button2" onClick="movePrevHeadLine(<?php echo $headLine['id'];?>)" style="font-size:18px; float:right; margin-right:14px; margin-top:4px;">
                                    <i class="glyphicon glyphicon-arrow-up" title="上移"></i>
                                  </a>                                  
                                  <?php
                                  }
                                  else {
                                  ?>
                                  <div style="font-size:18px; float:right; margin-right:14px; margin-top:4px; color:#AAAAAA;"><i class="glyphicon glyphicon-arrow-up"></i></div>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>
                            </div>
                          <?php
                              }
                          }
                          ?>                    
                            <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:inline-block; text-align:left; background-color:#FFFFFF; border:1px #888888 solid; height:40px; padding-top:6px; padding-left:12px; padding-right:12px; width:100%; box-shadow:#888888 0px 3px 10px;">     
                                <div style="display:none;">
                                  <input type="text" value="" style="width:100%; border-radius:3px; border:1px solid #AAAAAA;" />                                    
                                  <button type="button" onClick="addHeadLine($(this).prev());" style="position:relative; top:-24px; float:right; width:96px;; background-color:#35a6e7; padding:2px; border:none; font-size:14px; color:#FFFFFF;">提交</button>
                                  <a onClick="$(this).parent().hide('slow','',$(this).parent().next().show('slow'));" style="float:right; margin-right:10px; position:relative; top:-21px; cursor:pointer;">取消</a>
                                </div>
                                <a onClick="$(this).hide('fast','',$(this).prev().show('slow'));" style="cursor:pointer;">
                                  <i class="glyphicon glyphicon-plus" title="添加条目" style="display:inline-block; margin-top:3px; margin-left:12px;"> <b>添加条目</b></i>                                  
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- 板块编辑栏
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">板块规划</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以编辑移动端首页显示的栏目及排放的顺序。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="m_index_basecontents"/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:block; width:90%; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">标题:</span>
                                <span>title标签 页面标题，该内容将显示在浏览器标签页上以及作为页面收藏的标题。（选填）</span>
                              </div>
                              <input type="text" name="title" value="<?php echo isset($contentsArray['title']) ? $contentsArray['title'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">关键词:</span>
                                <span>meta标签 keywords属性 可以填写网页关键词，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="keywords" value="<?php echo isset($contentsArray['keywords']) ? $contentsArray['keywords'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">描述:</span>
                                <span>meta标签 description属性 可以填写网页描述，有利于爬虫抓取。（选填）</span>
                              </div>
                              <input type="text" name="description" value="<?php echo isset($contentsArray['description']) ? $contentsArray['description'] : '';?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">                              
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">页面背景颜色:</span>
                                <a onClick="$(this).next().css('background-color', $(this).next().next().val());" style="cursor:pointer; display:inline-block; position:relative; right:-186px;">预览</a>                             
                                <div style="width:20px; height:20px; margin-left:20px; display:inline-block; box-shadow:#888888 0px 2px 6px; position:relative; right:-176px; margin-bottom:-4px; background-color:<?php echo isset($contentsArray['backgroundColor']) ? $contentsArray['backgroundColor'] : '';?>;"></div>
                                <input type="text" name="backgroundColor" value="<?php echo isset($contentsArray['backgroundColor']) ? $contentsArray['backgroundColor'] : '';?>" style="width:240px;; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:-57px;"/>
                                <span style="margin-left:20px;">body CSS background-color属性，整个页面的背景色，默认为白色，填写格式#FFFFFF或rgba(255,255,255,1.00)（选填）</span> 
                              </div>                            
                            </div>                      
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div> 
                          <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                            <button type="button" id="BASE_CONTENTS" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>
                      </div>
                    </div>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          
<script type="text/javascript" language="javascript">
<!--//

var banners = <?php echo ($banners ? json_encode($banners) : 'false');?>;
var navButtons = <?php echo ($banners ? json_encode($navButtons) : 'false');?>;

// 添加首页Banner图片
function addMIndexBanner(){
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_index_banner");
  // 设置folder
  formJQuery.children("input").eq(3).val("pics");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端首页Banner图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/index.php");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加首页Banner图:");
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
  // 清空head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
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
    uploadImg($(this), '.JPG,.PNG', 512);
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
// 设置首页Banner图片
function setMIndexBanner(ordnung){
  if(!ordnung || !banners[ordnung - 1]){
    return false;
  }
  var banner = banners[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val(banner.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_index_banner");
  // 设置folder
  formJQuery.children("input").eq(3).val("pics");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端首页Banner");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/index.php");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置首页Banner图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + banner.fileName.substring(banner.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(banner.size/10)/100 + "KB 图片尺寸：" + banner.width + " x " + banner.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为640x480px或同比例扩大，文件小于512KB的.jpg或.png格式图片。"); 
  // 设置预览图片  
  var picPreviewDimen = fixImgSize(banner.width, banner.height, 400, 300);
  var picPreviewHtml = "<img src='" + banner.folderName + "/" + banner.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, banner.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, banner.href);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((banner.folderName + "/" + banner.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((banner.folderName + "/" + banner.fileName).substring(27));
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 512);
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
// 删除首页Banner图片
function deleteMIndexBanner(id){
  if(!confirm("确定要删除此Banner图片吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_image", "id": id, "component": "m_index_banner"},
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
// 前移首页Banner图片
function movePrevMIndexBanner(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_image", "id": id, "component": "m_index_banner"},
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
// 后移首页Banner图片
function moveNextMIndexBanner(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_image", "id": id, "component": "m_index_banner"},
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

// 添加首页导航按钮图标
function addMIndexNavButton(){
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_index_navbutton");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端首页导航按钮图标");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/index.php");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加移动端首页导航按钮图标:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"256px","height":"256px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为128x128px或同比例扩大，文件小于128KB的.jpg或.png格式图片。");   
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
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
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
// 设置首页导航按钮图标
function setMIndexNavButton(ordnung){
  if(!ordnung || !navButtons[ordnung - 1]){
    return false;
  }
  var navButton = navButtons[ordnung - 1];
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val(navButton.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("m_index_navbutton");
  // 设置folder
  formJQuery.children("input").eq(3).val("icons");
  // 设置descript
  formJQuery.children("input").eq(4).val("移动端首页导航按钮图标");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("mobile/index.php");
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置移动端首页导航按钮图标:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"256px","height":"256px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + navButton.fileName.substring(navButton.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(navButton.size/10)/100 + "KB 图片尺寸：" + navButton.width + " x " + navButton.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为128x128px或同比例扩大，文件小于128KB的.jpg或.png格式图片。"); 
  // 设置预览图片  
  var picPreviewDimen = fixImgSize(navButton.width, navButton.height, 256, 256);
  var picPreviewHtml = "<img src='" + navButton.folderName + "/" + navButton.fileName + "' style='width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px'>";
  formJQuery.find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(picPreviewHtml);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置对话框右侧文本信息栏
  var contentsJQuery = formJQuery.children("div").eq(2);
  // 设置alt信息
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, navButton.alt);
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, navButton.href);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val((navButton.folderName + "/" + navButton.fileName).substring(27));
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val((navButton.folderName + "/" + navButton.fileName).substring(27));
  
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
// 删除首页导航按钮图标
function deleteMIndexNavButton(id){  
  if(!confirm("确定要删除此导航按钮吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_image", "id": id, "component": "m_index_navbutton"},
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
// 前移首页导航按钮图标
function movePrevMIndexNavButton(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_image", "id": id, "component": "m_index_navbutton"},
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
// 后移首页导航按钮图标
function moveNextMIndexNavButton(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_image", "id": id, "component": "m_index_navbutton"},
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

// 添加头条条目
function addHeadLine(jqueryObj){
  if(!jqueryObj.val()){
    alert("头条内容不能为空。");
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"add_content", "pageFile":"mobile/index.php", "component":"m_index_headline", "textType":1, "contentChar":jqueryObj.val(), "descript":"mobile/index.php页面的装修头条"},
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
// 编辑头条条目
function setHeadLine(jqueryObj, id){
  if(!jqueryObj.val()){
    alert("头条内容不能为空。");
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"set_content", "id":id, "pageFile":"mobile/index.php", "component":"m_index_headline", "textType":1, "contentChar":jqueryObj.val(), "descript":"mobile/index.php页面的装修头条"},
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
// 编辑头条链接
function setHeadLineHref(jqueryObj, id){  
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"set_content", "id":id, "pageFile":"mobile/index.php", "component":"m_index_headline", "href":jqueryObj.val(), "descript":"mobile/index.php页面的装修头条"},
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
// 前移头条条目
function movePrevHeadLine(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"moveprev_content", "id":id, "component":"m_index_headline"},
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
// 后移头条条目
function moveNextHeadLine(id){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"movenext_content", "id":id, "component":"m_index_headline"},
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
// 删除头条条目
function deleteHeadLine(id){
  if(!confirm("确定要删除此头条内容吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action":"delete_content", "id":id, "component":"m_index_headline"},
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