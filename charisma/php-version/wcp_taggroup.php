<?php require('wcp_head.inc'); ?>
<?php
if (!isset($_GET['group']) || !DAS::isExistedInDB("`tb_wcp_tags`", "`tagGroup` = '" . $_GET['group'] . "'")) {
    echo '<script type="text/javascript">window.location.href="wcp_tags.html"</script>';
}

$tagGroup = new Query("`t1`.*, `t2`.`id` AS showroomID, `t2`.`number`, `t2`.`shop`, `t2`.`name`, `t2`.`visitCount`, `t2`.`reserveCount`, `t2`.`timestamp`, `t3`.`name` AS shopName, `t4`.`folderName`, `t4`.`fileName`", "`tb_wcp_tags` AS `t1`", "LEFT JOIN `tb_wcp_showrooms` AS `t2` ON `t1`.`itemID` = `t2`.`id` LEFT JOIN `tb_wcp_shops` AS `t3` ON `t3`.`id` = `t2`.`shop` LEFT JOIN `tb_wcp_images` AS `t4` ON `t4`.`showroomNum` = `t2`.`number` AND `t4`.`showroomShop` = `t2`.`shop` AND `t4`.`component` LIKE 'sr%cover'", "`t1`.`tagGroup` = '" . $_GET['group'] . "'", "`t1`.`tagIndex`, `t1`.`itemIndex`");
$tagGroup = DAS::quickQuery($tagGroup);
$tagGroup = $tagGroup['data'];

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

$tags = array();
foreach ($tagGroup as $item) {
    if (!isset($tags[$item['tag']])) {
        $tags[$item['tag']] = array();
        $tempItemType = $item['itemType'] ? $item['itemType'] : 0;
        if (!isset($tags[$item['tag']][$tempItemType])) {
            $tags[$item['tag']][$tempItemType] = array();
        }
    }
    foreach ($reserves as $reserve) {
        if ($item['showroomID'] == $reserve['showroomID']) {
            $item['reserveCount'] = $reserve['reserveCount'];
        }
    }
    $tags[$item['tag']][$tempItemType][] = $item;
}
?>
          <div>
            <ul class="breadcrumb">
              <li><a href="wcp_root.html">网站编辑控制台</a></li>
            </ul>
          </div>
          <!-- 标签内容管理栏 START -->
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well">
                  <h2 style="display:inline-block;"><i class="glyphicon glyphicon-th-large"></i> 标签内容管理</h2>
                  <span style="font-size:12px; margin-left:24px; font-weight:100; color:#888;">此处可以浏览同一标签组内各标签下的内容，并更改各个内容的排列顺序。</span>
                </div>
                <div class="box-content" style="text-align:left; padding:24px 64px 24px 64px;">                  
                  <?php
                  if ($tagGroup[0]['tag']) {
                      $tagKeys = array_keys($tags);
                  ?>
                  <ul class="nav nav-tabs" id="myTab">
                  <?php
                      for ($i = 0; $i < count($tagKeys); $i++) {
                  ?>
                    <li<?php echo $i == 0 ? ' class="active"' : '';?> style="margin-bottom:-2px;"><a href="#tag_<?php echo $i;?>"><?php echo $tagKeys[$i];?></a></li>
                  <?php
                      }
                  ?>                  
                  </ul>
                  <div id="myTabContent" class="tab-content">
                  <?php
                      for ($i = 0; $i < count($tagKeys); $i++) {
                  ?>
                    <div class="tab-pane<?php echo $i == 0 ? ' active' : '';?>" id="tag_<?php echo $i;?>">
                    <?php
                          if ($tags[$tagKeys[$i]][1][0]['itemID']) {
                              for ($j = 0; $j < count($tags[$tagKeys[$i]][1]); $j++) {                                  
                      ?>
                      <div id="item_<?php echo $j;?>" data-tag="<?php echo $tagKeys[$i];?>" data-id="<?php echo $tags[$tagKeys[$i]][1][$j]['itemID'];?>" style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                          <div class="button_bar" style="position:absolute; height:248px; z-index:100; text-align:center; width:320px; margin-bottom:-96px; padding:0px; display:none;">
                            <div style="height:48px; width:100%; padding:8px 8px 8px 8px; background-image:url(http://www.mingjugroup.com/charisma/img/wcp/button_bar_background.png);">
                              <a class="icon_button" href="wcp_showroom.html?id=<?php echo $tags[$tagKeys[$i]][1][$j]['itemID'];?>" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-edit" title="修改"></i></a>
                            <?php
                                if ($tags[$tagKeys[$i]][1][$j]['itemIndex'] < count($tags[$tagKeys[$i]][1])) {
                            ?>
                              <a class="icon_button" onClick="moveNextItem($(this).parents('#item_<?php echo $j;?>'));" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-right" title="后移"></i></a>
                            <?php
                                }
                                if ($tags[$tagKeys[$i]][1][$j]['itemIndex'] > 1) {
                            ?>
                              <a class="icon_button" onClick="movePrevItem($(this).parents('#item_<?php echo $j;?>'));" style="font-size:22px; float:right; margin-right:14px; cursor:pointer;"><i class="glyphicon glyphicon-arrow-left" title="前移"></i></a>
                            <?php
                                }
                            ?>
                            </div>
                          </div>                      
                          <?php
                          if ($tags[$tagKeys[$i]][1][$j]['fileName']) {
                              $coverFile = $tags[$tagKeys[$i]][1][$j]['folderName'] . '/' . $tags[$tagKeys[$i]][1][$j]['fileName'];
                          }
                          else {
                              $coverFile = "http://www.mingjugroup.com/charisma/img/wcp/empty_cover.jpg";
                          }
                          ?>
                          <img src="<?php echo $coverFile;?>" style="width:320px; height:240px;">
                          <div style="display:inline-block; width:320px; height:64px; text-align:left; background-color:#F0F0F0; padding:5px 5px 5px 5px;">
                            <span style="display:block; font-size:16px; font-weight:bolder;"><?php echo $tags[$tagKeys[$i]][1][$j]['name'];?>，<?php echo $tags[$tagKeys[$i]][1][$j]['shopName'];?>，<?php echo $tags[$tagKeys[$i]][1][$j]['number'];?>号样板间</span>
                            <span style="display:block; font-size:12px;">浏览量：<?php echo $tags[$tagKeys[$i]][1][$j]['visitCount'];?>;&nbsp;&nbsp;&nbsp;&nbsp;预约量：<?php echo $tags[$tagKeys[$i]][1][$j]['reserveCount'];?></span>
                            <span style="display:block; font-size:12px;">更新时间：<?php echo $tags[$tagKeys[$i]][1][$j]['timestamp'];?></span>
                          </div>
                        </div> 
                      <?php                                  
                              }
                          }
                          else {
                      ?>
                      <span style="margin-top:20px; display:block;">该标签下目前还没有内容。</span>
                      <?php
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
                  <div style="display:inline-block; width:24%; padding:5px; text-align:left; min-width:330px; margin-top:10px;">
                    <a href="wcp_tags.html">该标签组下目前还没有标签，请点击前往标签管理页添加。</a>
                  </div>
                  <?php 
                  }
                  ?>
                </div>
              </div>                                
            </div>
          </div>
          <!-- #标签内容管理栏 END -->
<script type="text/javascript" language="javascript">
<!--//
//var tags = <?php echo ($tags ? json_encode($tags) : 'false');?>;
//console.log(tags);
// 前移标签内容
function movePrevItem(itemJquery){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "moveprev_item", "tagGroup": "<?php echo $_GET['group'];?>", "tag": itemJquery.attr("data-tag"), "itemID": itemJquery.attr("data-id"), "itemType": 1},
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
// 后移标签内容
function moveNextItem(itemJquery){
  $.ajax({
    url: "wcp_svr.html",
    type: "POST",
    data: {"action": "movenext_item", "tagGroup": "<?php echo $_GET['group'];?>", "tag": itemJquery.attr("data-tag"), "itemID": itemJquery.attr("data-id"), "itemType": 1},
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