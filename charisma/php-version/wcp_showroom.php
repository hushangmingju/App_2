<?php require('wcp_head.inc'); ?>
<?php
if (!isset($_GET['id']) || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`status` > 0 AND `id` = " . $_GET['id'])) {
    echo '<script type="text/javascript">window.location.href="wcp_root.html"</script>';
}
$showroom = new Query("t1.*, t2.name AS shopName", "`tb_wcp_showrooms` AS t1", "LEFT JOIN `tb_wcp_shops` AS t2 ON t1.shop = t2.id", "t1.`id` = " . $_GET['id']);
$showroom = DAS::quickQuery($showroom);
$showroom = $showroom['data'][0];

$pictures = new Query("*", "`tb_wcp_images`", "", "`pageID` = -2 AND `status` = 1 AND `showroomNum` = " . $showroom['number'] . " AND `showroomShop` = " . $showroom['shop'], 'ordnung');
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$shops = new Query("*", "`tb_wcp_shops`", "", "`status` > 0", "`ordnung`, `id`");
$shops = DAS::quickQuery($shops);
$shops = DAS::hasData($shops) ? $shops['data'] : false;

$cover = false;
$livingPics = array();
$diningPics = array();
$kitchenPics = array();
$bathroomPics = array();
$masterPics = array();
$guestPics = array();
if ($pictures) {    
    foreach ($pictures as $picture) {
        switch ($picture['component']) {
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'cover':
                $cover = $picture;
                $cover['path'] = $cover['folderName'] . '/' . $cover['fileName'];
                $cover['suffix'] = strtoupper(substr($cover['fileName'], strrpos($cover['fileName'], '.')));
                $cover['size'] = round(filesize('../../images/showrooms/' . $showroom['number'] . '_' . $showroom['shop'] . '/' . $cover['fileName']) / 1024, 2) . 'KB';
                $cover['dimen'] = getimagesize($cover['path']);
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'living':
                $livingPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'dining':
                $diningPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'kitchen':
                $kitchenPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'bathroom':
                $bathroomPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'master':
                $masterPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'guest':
                $guestPics[] = $picture;
                break;
        }        
    }                                
}
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
 .checked{
   color:#FFFFFF;
   background-color:#35a6e7;
 }
 </style>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2><i class="glyphicon glyphicon-th-large"></i> <?php echo $showroom['numberNew'];?>号样板间 <?php echo $showroom['name'] . ' ' . $showroom['shopName'];?></h2>
                </div>
                <div class="box-content row">
                  <div class="box col-md-12">
                    <!-- 样板间基本信息 -->
                    <div class="box-inner">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">样板间基本信息</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置样板间的编号、门店、名称、英文名、介绍。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="set_showroom"/>
                          <input type="hidden" name="id" value=<?php echo $showroom['id'];?>/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:inline-block; width:48%;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间编号:</span>
                                  <input type="text" name="number" value="<?php echo $showroom['numberNew'];?>" style="width:80px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                                  <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                                </div>                            
                              </div>
                              <div style="display:inline-block; width:48%;">
                                <div style="display:block; text-align:left;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">所属门店:</span>
                                  <select name="shop" style="width:96px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;">
                                  <?php
                                  for ($i = 0; $i < count($shops); $i++) {
                                  ?>
                                    <option value="<?php echo $shops[$i]['id'];?>"<?php echo $shops[$i]['id'] == $showroom['shop'] ? ' selected = "selected"' : '';?>><?php echo $shops[$i]['name'];?></option>
                                  <?php
                                  }
                                  ?>
                                  </select>
                                </div>                            
                              </div>
                            </div>
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <div style="display:inline-block; width:48%;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间中文名称:</span>
                                  <input type="text" name="name" value="<?php echo $showroom['name'];?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                                  <span style="margin-left:20px;"><font style="color:red;">（必须填）</font></span>
                                </div>
                                <div style="display:inline-block; width:48%;">
                                  <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间英文名称:</span>
                                  <input type="text" name="ename" value="<?php echo $showroom['ename'];?>" style="width:240px; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px; margin-left:20px;"/>
                                  <span style="margin-left:20px;">（选填）</span>
                                </div>
                              </div>
                            </div>
                            <div style="display:block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间介绍:</span>
                                <span>样板间介绍将会显示在样板间页面以及meta标签description属性中。（选填）</span>
                              </div>
                              <textarea name="content" value="<?php echo $showroom['content'];?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"><?php echo $showroom['content'];?></textarea>
                            </div>                    
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div> 
                          <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                            <button type="button" onClick="setShowroom($(this).parents('form'))" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- 样板间价目表 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">样板间价目表</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置样板间价目表。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <div style="width:100%; padding: 20px 64px 20px 64px; display:block; text-align:center;">
                          <button type="button" onClick="dialogAddPriceList.show();" style="background-color:#35a6e7; border-radius:10px; padding:5px; padding-left:36px; padding-right:36px; border:none; font-size:18px; color:#FFF;"><?php echo $showroom['priceList'] ? '文本格式价格表' : '请先通过文本格式导入价格表'?></button>
                        </div>                        
                        <?php
                        if ($showroom['priceList']) {
                        ?>
                        <div style="text-align:center;">
                          <div style="display:inline-block; width:650px;">
                            <div style="display:block; text-align:center; margin-left:-19px;">
                              <table align="center" cellpadding="0" cellspacing="0" border="1" style="width:630px; border-color:#FFFFFF;">
                                <thead>
                                  <tr>
                                    <th style="width:33%; border-color:#FFFFFF; background-color:#35a6e7; color:#FFFFFF;">面积 (m<sup>2</sup>)</th>
                                    <th style="width:33%; border-color:#FFFFFF; background-color:#35a6e7; color:#FFFFFF;">户型 (x室x厅x厨x卫)</th>
                                    <th style="width:33%; border-color:#FFFFFF; background-color:#35a6e7; color:#FFFFFF;">总价 (元)</th>
                                  </tr>
                                </thead>
                              </table>
                            </div>
                            <div style="display:block; overflow:auto; max-height:480px; text-align:center;">
                              <table id="PRICELIST_TABLE" align="center" cellpadding="0" cellspacing="0" border="1" style="width:630px; text-align:center; border-color:#FFFFFF;">
                                <tbody>
                                <?php
                                $priceList = $showroom['priceList'];
                                $priceList = explode('%0D%0A', $priceList);
                                for ($i = 0; $i < count($priceList); $i++) {
                                    $priceSpecArea = explode('%09', $priceList[$i]);
                                    $roomStructure = str_split($priceSpecArea[1]);
                                    $roomStructure = $roomStructure[0] . '室' . $roomStructure[1] . '厅' . $roomStructure[2] . '厨' . $roomStructure[3] . '卫';
                                ?>
                                  <tr>
                                    <td data="<?php echo $priceSpecArea[0];?>" style="width:33%; border-color:#FFFFFF; background-color:#d6f0ff;"><?php echo $priceSpecArea[0];?></td>
                                    <td name="structure" data="<?php echo $priceSpecArea[1];?>" style="width:33%; border-color:#FFFFFF; background-color:#d6f0ff;"><?php echo $roomStructure;?></td>
                                    <td data="<?php echo str_replace('%20', '', $priceSpecArea[2]);?>" style="width:33%; border-color:#FFFFFF; background-color:#d6f0ff;"><?php echo str_replace('%20', '', $priceSpecArea[2]);?></td>
                                  </tr>
                                <?php
                                }
                                ?>
                                </tbody>
                              </table>                        
                            </div>
                          </div>
                        </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                    <!-- 样板间封面图设置栏 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">封面图设置</h2>
                        <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置样板间封面图。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; background-color:#FFFFFF; display:none;"> 
                        <div style="width:100%; box-shadow:#888888 0px 3px 10px;">
                          <div style="width:100%; text-align:center; background-color:#EFEFEF; padding-top:16px; padding-bottom:28px;">                     
                            <div style="float:left; display:inline-block; background-color:#35a6e7; color:#ffffff; margin-top:-16px; padding:3px 5px 3px 5px;">预览</div>
                            <div style="box-shadow:#888888 0px 3px 10px; margin-top:8px; display:inline-block; padding:0px; width:640px;">
                            <?php
                            if ($cover) {
                                $action = 'setCover();';
                                $actionTxt = '设置样板间封面图';
                                echo '<img src="' . $cover['path'] . '" style="width:640px; margin:0px; border:none; padding:0px;" />';
                            }
                            else {
                                $action = 'addCover();';
                                $actionTxt = '上传样板间封面图';
                            }
                            ?>
                            </div>
                          </div>
                        </div>
                        <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                          <button type="button" onClick="<?php echo $action;?>" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;"><?php echo $actionTxt;?></button>
                        </div>
                      </div>
                    </div>
                    <!-- 样板间图片管理栏-->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">样板间图片管理</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以管理样板间图片。</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px; display:none;">
                        <ul class="nav nav-tabs" id="myTab">
                          <li class="active"><a href="#living">客厅</a></li>
                          <li><a href="#dining">餐厅</a></li>
                          <li><a href="#kitchen">厨房</a></li>
                          <li><a href="#bathroom">卫生间</a></li>
                          <li><a href="#master">主卧</a></li>
                          <li><a href="#guest">次卧</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <!-- 餐厅图片管理 -->
                          <div class="tab-pane active" id="living">
                          <?php                        
                          if (count($livingPics) > 0) {
                              foreach ($livingPics as $livingPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('living', <?php echo $livingPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('living', <?php echo $livingPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($livingPic['ordnung'] < count($livingPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('living', <?php echo $livingPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($livingPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('living', <?php echo $livingPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $livingPic['folderName'] . '/' . $livingPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $livingPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $livingPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('living');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>
                          <!-- 餐厅图片管理 -->
                          <div class="tab-pane" id="dining">
                          <?php                        
                          if (count($diningPics) > 0) {
                              foreach ($diningPics as $diningPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('dining', <?php echo $diningPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('dining', <?php echo $diningPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($diningPic['ordnung'] < count($diningPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('dining', <?php echo $diningPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($diningPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('dining', <?php echo $diningPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $diningPic['folderName'] . '/' . $diningPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $diningPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $diningPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('dining');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>
                          <!-- 厨房图片管理 -->
                          <div class="tab-pane" id="kitchen">
                          <?php                        
                          if (count($kitchenPics) > 0) {
                              foreach ($kitchenPics as $kitchenPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('kitchen', <?php echo $kitchenPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('kitchen', <?php echo $kitchenPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($kitchenPic['ordnung'] < count($kitchenPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('kitchen', <?php echo $kitchenPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($kitchenPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('kitchen', <?php echo $kitchenPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $kitchenPic['folderName'] . '/' . $kitchenPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $kitchenPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $kitchenPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('kitchen');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>
                          <!-- 卫生间图片管理 -->
                          <div class="tab-pane" id="bathroom">
                          <?php                        
                          if (count($bathroomPics) > 0) {
                              foreach ($bathroomPics as $bathroomPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('bathroom', <?php echo $bathroomPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('bathroom', <?php echo $bathroomPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($bathroomPic['ordnung'] < count($bathroomPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('bathroom', <?php echo $bathroomPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($bathroomPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('bathroom', <?php echo $bathroomPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $bathroomPic['folderName'] . '/' . $bathroomPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $bathroomPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $bathroomPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('bathroom');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>
                          <!-- 主卧图片管理 -->
                          <div class="tab-pane" id="master">
                          <?php                        
                          if (count($masterPics) > 0) {
                              foreach ($masterPics as $masterPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('master', <?php echo $masterPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('master', <?php echo $masterPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($masterPic['ordnung'] < count($masterPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('master', <?php echo $masterPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($masterPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('master', <?php echo $masterPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $masterPic['folderName'] . '/' . $masterPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $masterPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $masterPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('master');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>
                          <!-- 客卧图片管理 -->
                          <div class="tab-pane" id="guest">
                          <?php                        
                          if (count($guestPics) > 0) {
                              foreach ($guestPics as $guestPic) {
                          ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                                <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                                  <a class="icon_button" onClick="deletePicture('guest', <?php echo $guestPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-trash" title="删除"></i></a>
                                  <a class="icon_button" onClick="setPicture('guest', <?php echo $guestPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                                  <?php
                                  if ($guestPic['ordnung'] < count($guestPics)) {
                                  ?>
                                  <a class="icon_button" onClick="moveNextPicture('guest', <?php echo $guestPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                                  <?php
                                  }
                                  if ($guestPic['ordnung'] > 1) {
                                  ?>
                                  <a class="icon_button" onClick="movePrevPicture('guest', <?php echo $guestPic['id'];?>)" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                                  <?php
                                  }
                                  ?>
                                </div>
                              </div>                      
                              <img src="<?php echo $guestPic['folderName'] . '/' . $guestPic['fileName'];?>" style="width:320px; height:240px;">
                              <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px; overflow:hidden;">
                                <span style="width:310px; display:block;">标题：<?php echo $guestPic['head'];?></span>
                                <span style="width:310px; display:block;">介绍：<?php echo $guestPic['content'];?></span>
                              </div>
                            </div>  
                            <?php
                              }
                          }
                            ?>
                            <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                              <a onClick="addPicture('guest');" style="cursor:pointer;">
                                <img src="http://www.mingjugroup.com/charisma/img/wcp/add_showroom_pic.png" style="width:320px; background-color:#c9c9c9;">
                                <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#c9c9c9; padding:5px 5px 5px 5px;">
                                  <span style="position:absolute; width:310px; display:inline-block;"></span>
                                </div>                          
                              </a>
                            </div>                          
                          </div>                        
                        </div>
                      </div>
                    </div>
                    <!-- 酷家乐链接 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">样板间酷家乐全景图链接</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以设置样板间的酷家乐全景图链接</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:0px 0px 24px 0px; overflow:hidden; display:none;">
                        <form>
                          <input type="hidden" name="action" value="set_kujiale"/>
                          <input type="hidden" name="id" value="<?php echo $showroom['id'];?>"/>
                          <input type="hidden" name="number" value="<?php echo $showroom['numberNew'];?>"/>
                          <input type="hidden" name="shop" value="<?php echo $showroom['shop'];?>"/>
                          <input type="hidden" name="name" value="<?php echo $showroom['name'];?>"/>
                          <div style="width:100%; box-shadow:#888888 0px 3px 10px; padding-top:24px;"> 
                            <div style="display:inline-block; width:90%; margin-top:20px; padding:0px 64px 0px 64px;">
                              <div style="display:block; text-align:left;">
                                <span style="color:#35a6e7; font-size:16px; font-weight:bold;">酷家乐全景图链接（选填）:</span>
                              </div>
                              <input name="kujiale" value="<?php echo $showroom['kujiale'];?>" style="width:100%; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                            </div>                    
                            <div style="display:block; margin-top:20px; height:20px;">
                            </div>
                          </div> 
                          <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                            <button type="button" onClick="setKujiale($(this).parents('form'))" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交更改</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- 标签设置 -->
                    <div class="box-inner" style="margin-top:24px;">
                      <div class="box-header well" data-original-title="" onClick="$(this).next('div').slideToggle('slow');" style="cursor:pointer;">
                        <h2 style="display:inline-block;">设置标签</h2><span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以为样板间设置标签</span>
                      </div>
                      <div class="box-content" style="text-align:left; padding:24px 24px 24px 24px; overflow:hidden; display:none;">
                      <?php
                      if ($tagGroups) {
                          $tagGroupKeys = array_keys($tagGroups);
                      ?>
                        <ul class="nav nav-tabs" id="myTab">
                      <?php
                          for ($i = 0; $i < count($tagGroupKeys); $i++) {
                      ?>
                          <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:0px;"><a href="#taggroup_<?php echo $i;?>" class="glyphicon glyphicon-tags"> <?php echo $tagGroupKeys[$i];?></a></li>
                      <?php
                          }
                      ?>                
                        </ul>
                        <div id="myTabContent" class="tab-content">
                      <?php
                          for ($i = 0; $i < count($tagGroupKeys); $i++) {
                      ?>
                          <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="taggroup_<?php echo $i;?>" style="padding:24px;">
                      <?php
                              $tagKeys = array_keys($tagGroups[$tagGroupKeys[$i]]);
                              for ($j = 0; $j < count($tagKeys); $j++) {
                                  if ($tagKeys[$j]) {
                                      $isChecked = false;
                                      foreach ($tagGroups[$tagGroupKeys[$i]][$tagKeys[$j]] as $item) {
                                          if ($item['itemID'] && $item['itemID'] == $showroom['id']) {
                                              $isChecked = true;
                                          }
                                      }
                      ?>
                            <div <?php echo $isChecked ? 'class="checked" ' : ''?>onClick="setTag($(this));" style="display:inline-block; width:240px; padding:14px; text-align:left; height:60px; font-size:22px; margin-top:16px; border-radius:5px; box-shadow:#888888 0px 3px 10px; margin-left:16px; padding-left:16px; text-align:center; cursor:pointer;">
                              <div data-group="<?php echo $tagGroupKeys[$i];?>" data-tag="<?php echo $tagKeys[$j];?>" data-id="<?php echo $showroom['id'];?>">
                                <li class="glyphicon glyphicon-tag"> </li> <?php echo $tagKeys[$j];?>
                              </div>                      
                            </div>
                      <?php
                                  }
                                  else{
                      ?>
                            <a href="wcp_tags.html">还没有创建标签，请点击前往标签管理创建</a>
                      <?php
                                  }
                              }
                      ?>
                          </div>
                      <?php
                          }
                      ?>
                        </div>
                      <?php                  
                      }
                      else {
                      ?>
                        <a href="wcp_tags.html">还没有创建标签组，请点击前往标签管理创建</a>
                      <?php 
                      }
                      ?>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
          </div>
          <!-- #ADD_PRICELIST_DIALOG_DIV 文本格式样板间价格表对话框 -->
          <div id="ADD_PRICELIST_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:800px; padding:00px 0px 20px 0px; overflow:hidden;">
            <form>
              <input type="hidden" name="action" value="set_pricelist"/>
              <input type="hidden" name="id" value="<?php echo $showroom['id'];?>"/>
              <input type="hidden" name="number" value="<?php echo $showroom['numberNew'];?>"/>
              <input type="hidden" name="shop" value="<?php echo $showroom['shop'];?>"/>
              <input type="hidden" name="name" value="<?php echo $showroom['name'];?>"/>
              <div style="display:block; text-align:center;">
                <h2 style="color:#35a6e7;">导入样板间价格表</h2>
              </div>
              <div style="width:100%; box-shadow:#888888 0px 3px 10px;"> 
                <div style="display:inline-block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                  <div style="display:block; width:100%; margin-top:20px; padding:0px 64px 0px 64px;">
                    <div style="display:block; text-align:left;">
                      <span style="color:#35a6e7; font-size:16px; font-weight:bold;">样板间价格表:</span>
                      <span>样板间价格表导入格式<a href="http://www.mingjugroup.com/charisma/img/wcp/pricelist_1_1.txt">样本下载</a>，将样板间价格表编辑为与样本相同格式，复制粘贴到文本框提交。数据表中三列从左到右分别为：房屋面积、户型、总价，户型格式为：n室n厅n厨n卫，如：3室2厅1厨2卫即为 3212</span>
                    </div>
                    <textarea name="priceList" value="<?php echo $showroom['priceList'];?>" style="width:100%; height:200px; font-size:14px;  padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"><?php echo rawurldecode($showroom['priceList']);?></textarea>
                  </div>                    
                  <div style="display:block; margin-top:20px; height:20px;">
                  </div>
                </div>
              </div>
              <div style="display:block; width:100%; margin-top:24px; text-align:center;">
                <button type="button" onClick="addPriceList($(this).parents('form'));" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>
                <button type="button" onClick="dialogAddPriceList.hide();" style="background-color:#35a6e7; border-radius:10px; width:200px; padding:5px; border:none; font-size:22px; color:#FFF; margin-left:24px;">取消</button>
              </div>
            </form>
          </div>
          <!-- #SHOWROOM_PICS_LIST_DIALOG_DIV 样板间图片浏览对话框 -->
          <div id="SHOWROOM_PICS_LIST_DIALOG_DIV" style="border:none; display:none; z-index:200; width:1320px; background-color:rgb(255,255,255,0);">
            <div style="display:block; text-align:center;">
              <h2 style="color:#FFFFFF; margin-top:-24px;">图片列表</h2>
            </div>
            <div style="display:block; overflow:hidden; background-color:#FFFFFF; height:660px; margin-top:24px;">
              <a id="IMGLIST_ARROW_RIGHT" style="display:none;float:right; margin-top:260px; position:absolute; margin-left:1340px; cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/arrow_right.png"/> 
              </a>
              <a id="IMGLIST_ARROW_LEFT" style="display:none;float:left; margin-top:260px; position:absolute; margin-left:-160px; cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/arrow_left.png"/> 
              </a>
              <?php
              $files = glob('../../images/showrooms/' . $showroom['number'] . '_' . $showroom['shop'] . '/*.*g');
              $images = array();
              $pageNum = ceil(count($files) / 18);
              for ($i = 0; $i < count($files); $i++) {
                  $images[$i]['filepath'] = $files[$i];
                  $images[$i]['filename'] = substr($files[$i], (strrpos($files[$i], '/') + 1));
                  $images[$i]['filesize'] = round(filesize($files[$i]) / 1024) . 'KB';
                  $images[$i]['filedimen'] = getimagesize($files[$i]);
                  $images[$i]['filesuffix'] = substr($files[$i], (strrpos($files[$i], '.')));
              }
              echo '<div id="IMG_LIST_IMAGE_BOARD" style="width:' . (1424 * $pageNum) . 'px; display:inline-block; margin-top:16px; position:relative;">';
              for ($i = 0; $i < $pageNum; $i++) {
                  echo '<div style="display:inline-block; padding:20px; height:640px; text-align:left; margin-left:24px; width:1360px;">';
                  for ($j = 0; $j < 18; $j++) {
                      $index = $j + ($i * 18);
                      if (isset($images[$index])) {
                          if (($images[$index]['filedimen'][0] / $images[$index]['filedimen'][1]) < 2.2) {
                              $height = $images[$index]['filedimen'][1] < 600 ? $images[$index]['filedimen'][1] : 600;
                              $width = $height * ($images[$index]['filedimen'][0] / $images[$index]['filedimen'][1]);
                              $dimen = '{\'height\': \'' . $height . 'px\', \'width\':\'' . $width . 'px\'}';
                          }
                          else {
                              $width = $images[$index]['filedimen'][0] < 1320 ? $images[$index]['filedimen'][0] : 1320;
                              $height = $width * ($images[$index]['filedimen'][1] / $images[$index]['filedimen'][0]);
                              $dimen = '{\'width\': \'' . $width . 'px\', \'height\':\'' . $height . 'px\'}';
                          }
                          echo '<a onClick="$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMG_SHOW_SIZE\').val(\'' . $images[$i]['filesize'] . '\');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMG_SHOW_SUFFIX\').val(\'' . $images[$i]['filesuffix'] . '\');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMG_SHOW_WIDTH\').val(' . $images[$index]['filedimen'][0] . ');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMG_SHOW_HEIGHT\').val(' . $images[$index]['filedimen'][1] . ');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMGSHOW_DIALOG_FILENAME_H2\').text(\'' . $images[$index]['filename'] . '\');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMGSHOW_DIALOG_IMG\').attr(\'src\', \'' . $images[$index]['filepath'] . '\');$(\'#IMG_SHOW_DIALOG_DIV\').find(\'#IMGSHOW_DIALOG_IMG\').css(' . $dimen . '); dialogImgShow.show();" style="cursor:pointer;">';
                          echo '<div class="imageList" style="display:inline-block; width:190px; height:180px; margin:6px;">';
                          echo '<table cellpadding="0" cellspacing="0" style="width:100%; height:140px; padding:0px; margin:0px;"><tr>';
                          echo '<td style="width:100%; height:140px; overflow:hidden; vertical-align:middle; text-align:center; padding:8px;">';
                          echo '<div style=" box-shadow: #888888 0px 2px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; display:inline-block">';
                          $iconWidth = $images[$index]['filedimen'][0];
                          $iconHeight = $images[$index]['filedimen'][1];
                          if ($iconWidth > 190) {
                              $iconHeight = ($iconHeight / $iconWidth) * 190;  
                              $iconWidth = 190;                            
                          }
                          if ($iconHeight > 140) {
                              $iconWidth = ($iconWidth / $iconHeight) * 140; 
                              $iconHeight = 140;
                          }
                          echo '<img src="' . $images[$index]['filepath'] . '" style="height:' . $iconHeight . 'px; width:' . $iconWidth . 'px; vertical-align:middle;" />';
                          echo '</div></td></tr></table>';
                          echo '<div style="padding:2px 8px 2px 8px; color:#000000; font-size:10px; margin-bottom:-1px; height:40px; overflow:hidden;">';
                          echo '<span style="display:block;">';
                          echo $images[$index]['filename'];                     
                          echo '</span>';
                          echo '<span style="display:block;">';
                          echo '尺寸：' . $images[$index]['filedimen'][0] . 'x' . $images[$index]['filedimen'][1] . '&nbsp;大小：' . $images[$index]['filesize'];                     
                          echo '</span>';
                          echo '</div>';
                          echo '</div>';
                          echo '</a>';
                      }
                      else {
                         echo '<div style="display:inline-block; width:190px; height:180px; margin:6px; overflow:hidden;"></div>';
                      }
                  }
                  echo '</div>';    
              }
              echo '</div>';
              ?>           
            </div>
            <div style="display:block; text-align:center;">
              <a onClick="dialogShowroomPicsList.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div> 
          </div>
<script type="text/javascript" language="javascript">
<!--//
var dialogAddPriceList = new DIALOG("ADD_PRICELIST_DIALOG_DIV");
var dialogShowroomPicsList = new DIALOG("SHOWROOM_PICS_LIST_DIALOG_DIV");

var tagGroups = <?php echo ($tagGroups ? json_encode($tagGroups) : 'false');?>;
var pictures = <?php echo ($pictures ? json_encode($pictures) : 'false');?>;

// setShowroom(formJQuery) 添加样板间，formJQuery为文本表单所属form标签的JQuery对象
function setShowroom(formJQuery){
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


// addPriceList(formJQuery, notRefresh) 提交样板间价格表数据，formJQuery为文本表单所属form标签的JQuery对象， noRefresh参数可选择是否在提交成功后刷新页面
function addPriceList(formJQuery, notRefresh){
  var priceList = formJQuery.find("textarea").val();
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: formJQuery.serializeArray(),
    dataType: "json",
    success: function(data) { 
      if(!notRefresh){
        alert(data.TEXT);
        reloadPage();
      }
      else{
        formJQuery.find("textarea").val(decodeURIComponent(priceList));
      }
    },
    error: function(data) { 
	  alert("网络错误，请重试，如果仍无法解决请联系管理员。");
    },
  });
}
// editPriceList() 表格模式下修改价格表
function editPriceList(){
  var priceList = "";
  $("#PRICELIST_TABLE").find("tr").each(function(index, element) {
    $(this).find("td").each(function(index, element) {
      priceList += $(this).attr("data") + "%09";   
    });
    priceList = priceList.substring(0, (priceList.length - 3));
    priceList += "%20%0D%0A";
  });
  priceList = priceList.substring(0, (priceList.length - 9));
  $("#ADD_PRICELIST_DIALOG_DIV").find("textarea").val(priceList);
  addPriceList($("#ADD_PRICELIST_DIALOG_DIV").find("form"), true);
}
// touchEdit() 表格模式的touch修改脚本
function touchEdit(){
  $("#PRICELIST_TABLE").find("td").each(function(index, element) {
    $(this).click(function(e) {
      var text = $(this).attr("data");
      $(this).html("<input type='text' value='" + text + "'/>");
      $(this).parents("table").find("td").each(function(index, element) {
        $(this).unbind();  
      });
      $(this).children("input").focus();
      $(this).children("input").focusout(function(e) {
        var value = $(this).val();
        $(this).parent().attr("data", value);
        if($(this).parent().attr("name") == "structure"){
          value = value.split("");
          $(this).parent().html(value[0] + "室" + value[1] + "厅" + value[2] + "厨" + value[3] + "卫");
        }
        else{
          $(this).parent().html(value);
        }
        touchEdit();
        editPriceList();
      });
    });   
  });
}

// setKujiale(formJQuery) 设置样板间酷家乐链接，formJQuery为文本表单所属form标签的JQuery对象
function setKujiale(formJQuery){
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

// 添加封面图片
function addCover(){
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_cover");
  // 设置folder
  formJQuery.children("input").eq(3).val("showrooms/<?php echo $showroom['number'] . '_' . $showroom['shop'];?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $showroom['shopName'] . '，' . $showroom['numberNew'] . '号样板间，' . $showroom['name'];?>封面图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("showroom");
  // 设置component
  formJQuery.children("input").eq(6).val(<?php echo $showroom['number'];?>);
  // 设置folder
  formJQuery.children("input").eq(7).val(<?php echo $showroom['shop'];?>);
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加样板间封面图片:");
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
    dialogShowroomPicsList.show(e, loadImgListWidget("PICS_LIST_DIALOG_DIV"));
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
// 设置封面图片
function setCover(){
  var formJQuery = $("#IMG_FORM");
  // 设置ID
  formJQuery.children("input").eq(0).val(<?php echo $cover['id'];?>);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("<?php echo $cover['component'];?>");
  // 设置folder
  formJQuery.children("input").eq(3).val("showrooms/<?php echo $showroom['number'] . '_' . $showroom['shop'];?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $showroom['shopName'] . '，' . $showroom['numberNew'] . '号样板间，' . $showroom['name'];?>封面图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("showroom");
  // 设置showroomNum
  formJQuery.children("input").eq(6).val(<?php echo $showroom['number'];?>);
  // 设置showroomShop
  formJQuery.children("input").eq(7).val(<?php echo $showroom['shop'];?>);
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置样板间封面图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("<?php echo $cover ? ('文件类型：' . $cover['suffix'] . ' 大小：' . $cover['size'] . ' 图片尺寸：' . $cover['dimen'][0] . ' x ' . $cover['dimen'][1] . 'px') : '';?>");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为640x480px或同比例扩大，文件小于512KB的.jpg或.png格式图片。");      
  // 设置预览图片
  <?php
  if ($cover) {
      echo 'var picPreviewDimen = fixImgSize(' . $cover['dimen'][0] . ', ' . $cover['dimen'][1] . ', 400, 300);';
      echo 'var picPreviewHtml = "<img src=\'' . $cover['path'] . '\' style=\'width:" + picPreviewDimen.width + "px; height:" + picPreviewDimen.height + "px; margin-top:" + picPreviewDimen.marginTop + "px\'/>";';
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
  setField(contentsJQuery.find("#IMG_DIALOG_ALT_DIV"), true, "<?php echo $cover ? $cover['alt'] : '';?>");
  // 隐藏title表单栏
  setField(contentsJQuery.find("#IMG_DIALOG_TITLE_DIV"), false);
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), true, "<?php echo $cover ? $cover['href'] : '';?>");
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), false);
  // 隐藏content信息
  setField(contentsJQuery.find("#IMG_DIALOG_CONTENT_DIV"), false);
  // 隐藏css信息
  setField(contentsJQuery.find("#IMG_DIALOG_CSS_DIV"), false);
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置图片路径信息
  formJQuery.find("input#IMG_PATH").val("<?php echo $cover ? substr($cover['path'], 27) : '';?>");
  // 设置图片路径信息（隐藏）
  formJQuery.find("input#IMG_PATH_HIDDEN").val("<?php echo $cover ? substr($cover['path'], 27) : '';?>");
  
  // ---------------------------------------------------- 分界线 -------------------------------------------------------------
  // 设置上传函数参数
  formJQuery.next().find("#f").unbind();
  formJQuery.next().find("#f").change(function(e) {
    uploadImg($(this), '.JPG,.PNG', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogShowroomPicsList.show(e, loadImgListWidget("SHOWROOM_PICS_LIST_DIALOG_DIV"));
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

// addPicture(room) 添加样板间图片 room 为房间分类（客厅living、餐厅dining、厨房kitchen、卫生间bathroom、主卧master、客卧guest）
function addPicture(room){
  if(!room || (room != "living" && room != "dining" && room != "kitchen" && room != "bathroom" && room != "master" && room != "guest")){
    console.log("错误的房间类型！");
    return false;
  }
  switch(room){
    case "living":
      var roomName = "客厅";
      break; 
    case "dining":
      var roomName = "餐厅";
      break; 
    case "kitchen":
      var roomName = "厨房";
      break; 
    case "bathroom":
      var roomName = "卫生间";
      break; 
    case "master":
      var roomName = "主卧";
      break; 
    case "guest":
      var roomName = "客卧";
      break;    
  }
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val("");
  // 设置action
  formJQuery.children("input").eq(1).val("add_image");
  // 设置component
  formJQuery.children("input").eq(2).val("sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_" + room);
  // 设置folder
  formJQuery.children("input").eq(3).val("showrooms/<?php echo $showroom['number'] . '_' . $showroom['shop'];?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $showroom['shopName'] . '，' . $showroom['numberNew'] . '号样板间，' . $showroom['name'];?>" + roomName + "图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("showroom");
  //alert(formJQuery.children("input").eq(5).attr("name") + "=" + formJQuery.children("input").eq(5).val());
  // 设置component
  formJQuery.children("input").eq(6).val(<?php echo $showroom['number'];?>);
  // 设置folder
  formJQuery.children("input").eq(7).val(<?php echo $showroom['shop'];?>);
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("添加样板间" + roomName + "图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 清空预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为4:3或3:2等比例，文件小于512KB的.jpg或.png格式图片。");   
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
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 清空head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true);
  // 隐藏content信息
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
    uploadImg($(this), '.JPG,.PNG', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogShowroomPicsList.show(e, loadImgListWidget("SHOWROOM_PICS_LIST_DIALOG_DIV"));
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
// setPicture(room, id) 编辑样板间图片 room 为房间分类（客厅living、餐厅dining、厨房kitchen、卫生间bathroom、主卧master、客卧guest）
function setPicture(room, id){
  if(!id || isNaN(parseInt(id))){
    console.log("没有提交ID！");
    return false;
  }
  if(!room || (room != "living" && room != "dining" && room != "kitchen" && room != "bathroom" && room != "master" && room != "guest")){
    console.log("错误的房间类型！");
    return false;
  }
  switch(room){
    case "living":
      var roomName = "客厅";
      break; 
    case "dining":
      var roomName = "餐厅";
      break; 
    case "kitchen":
      var roomName = "厨房";
      break; 
    case "bathroom":
      var roomName = "卫生间";
      break; 
    case "master":
      var roomName = "主卧";
      break; 
    case "guest":
      var roomName = "客卧";
      break;    
  }
  var picture = false;
  for(var i = 0; i < pictures.length; i++){
    if(pictures[i].id == id){
        picture = pictures[i];
    }
  }
  if(!picture){
    console.log("无效ID！");
    return false;
  }
  //var shops = ["", "闵行店", "松江店", "嘉定店", "宝山店"];
  var formJQuery = $("#IMG_FORM");
  // 清空ID
  formJQuery.children("input").eq(0).val(picture.id);
  // 设置action
  formJQuery.children("input").eq(1).val("set_image");
  // 设置component
  formJQuery.children("input").eq(2).val("sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_" + room);
  // 设置folder
  formJQuery.children("input").eq(3).val("showrooms/<?php echo $showroom['number'] . '_' . $showroom['shop'];?>");
  // 设置descript
  formJQuery.children("input").eq(4).val("<?php echo $showroom['shopName'] . '，' . $showroom['numberNew'] . '号样板间，' . $showroom['name'];?>" + roomName + "图片");
  // 设置pageFile
  formJQuery.children("input").eq(5).val("showroom");
  // 设置component
  formJQuery.children("input").eq(6).val(<?php echo $showroom['number'];?>);
  // 设置folder
  formJQuery.children("input").eq(7).val(<?php echo $showroom['shop'];?>);
  // 设置对话框标题
  formJQuery.find("div.DialogTitle").text("设置样板间" + roomName + "第" + picture.ordnung + "张图片:");
  // 清空临时文件路径
  formJQuery.find("#TEMP_UPLOAD_IMG_PATH").val("");
  // 清空临时文件ID
  formJQuery.find("#TEMP_UPLOAD_IMG_ID").val("");
  // 设置预览图片框尺寸
  formJQuery.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css({"width":"400px","height":"300px","display":"inline-block"});
  // 设置预览文件信息
  formJQuery.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + picture.fileName.substring(picture.fileName.indexOf(".")).toUpperCase() + " 大小：" + Math.round(picture.size/10)/100 + "KB 图片尺寸：" + picture.width + " x " + picture.height + "px");
  // 设置图片上传要求
  formJQuery.find("p#TEMP_UPLOAD_IMG_REQUIRE").text("图片尺寸为4:3或3:2等比例，文件小于512KB的.jpg或.png格式图片。"); 
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
  // 设置href信息
  setField(contentsJQuery.find("#IMG_DIALOG_HREF_DIV"), false);
  // 设置head信息
  setField(contentsJQuery.find("#IMG_DIALOG_HEAD_DIV"), true, picture.head);
  // 隐藏content信息
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
    uploadImg($(this), '.JPG,.PNG', 512);
  });
  // 设置浏览图片按钮
  formJQuery.find("button#IMG_SELECT_BUTTON").unbind();
  formJQuery.find("button#IMG_SELECT_BUTTON").click(function(e) {
    dialogShowroomPicsList.show(e, loadImgListWidget("SHOWROOM_PICS_LIST_DIALOG_DIV"));
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
// deletePicture(room, id) 删除样板间图片 room 为房间分类（客厅living、餐厅dining、厨房kitchen、卫生间bathroom、主卧master、客卧guest）
function deletePicture(room, id){
  if(!id || isNaN(parseInt(id))){
    console.log("没有提交ID！");
    return false;
  }
  if(!room || (room != "living" && room != "dining" && room != "kitchen" && room != "bathroom" && room != "master" && room != "guest")){
    console.log("错误的房间类型！");
    return false;
  }
  switch(room){
    case "living":
      var roomName = "客厅";
      break; 
    case "dining":
      var roomName = "餐厅";
      break; 
    case "kitchen":
      var roomName = "厨房";
      break; 
    case "bathroom":
      var roomName = "卫生间";
      break; 
    case "master":
      var roomName = "主卧";
      break; 
    case "guest":
      var roomName = "客卧";
      break;    
  }
  var picture = false;
  for(var i = 0; i < pictures.length; i++){
    if(pictures[i].id == id){
        picture = pictures[i];
    }
  }
  if(!picture){
    console.log("无效ID！");
    return false;
  }
  if(!confirm("确定要删除此样板间图片吗？")){
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "delete_image", "id": id, "component": "sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_" + room},
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
// movePrevPicture(room, id) 前移样板间图片 room 为房间分类（客厅living、餐厅dining、厨房kitchen、卫生间bathroom、主卧master、客卧guest）
function movePrevPicture(room, id){
  if(!id || isNaN(parseInt(id))){
    console.log("没有提交ID！");
    return false;
  }
  if(!room || (room != "living" && room != "dining" && room != "kitchen" && room != "bathroom" && room != "master" && room != "guest")){
    console.log("错误的房间类型！");
    return false;
  }
  var picture = false;
  for(var i = 0; i < pictures.length; i++){
    if(pictures[i].id == id){
        picture = pictures[i];
    }
  }
  if(!picture){
    console.log("无效ID！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_image", "id": id, "component": "sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_" + room},
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
// moveNextPicture(room, id) 后移样板间图片 room 为房间分类（客厅living、餐厅dining、厨房kitchen、卫生间bathroom、主卧master、客卧guest）
function moveNextPicture(room, id){
  if(!id || isNaN(parseInt(id))){
    console.log("没有提交ID！");
    return false;
  }
  if(!room || (room != "living" && room != "dining" && room != "kitchen" && room != "bathroom" && room != "master" && room != "guest")){
    console.log("错误的房间类型！");
    return false;
  }
  var picture = false;
  for(var i = 0; i < pictures.length; i++){
    if(pictures[i].id == id){
        picture = pictures[i];
    }
  }
  if(!picture){
    console.log("无效ID！");
    return false;
  }
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_image", "id": id, "component": "sr_<?php echo $showroom['number'] . '_' . $showroom['shop'];?>_" + room},
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

// setTag(tagJquery) 为样板间设置标签，tagJquery是标签的JQuery对象
function setTag(tagJquery){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "set_item_tag", "tagGroup": tagJquery.children("div").attr("data-group"), "tag": tagJquery.children("div").attr("data-tag"), "itemID": tagJquery.children("div").attr("data-id"), "itemType": 1},
    dataType: "json",
    success: function(data) { 
      if(data.TYPE == 1){
        tagJquery.toggleClass("checked");
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
  touchEdit();
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