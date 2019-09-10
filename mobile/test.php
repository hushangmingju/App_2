<?php
require_once('top1.inc');

$styleTag = isset($_GET['style']) && $_GET['style'] ? $_GET['style'] : false;

// 页面参数
$pageInfos = new Query("", "`tb_vcs_pages`", "", "`pageFile` = 'mobile/styles.php' AND `status` = 1");
$pageInfos = DAS::quickQuery($pageInfos);
$pageInfos = DAS::hasData($pageInfos) ? $pageInfos['data'][0] : false;
$bannerComponent = 'm_styles_banner';
$banner = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageInfos['id'] . " AND `component` = '" . $bannerComponent . "'");
$banner = DAS::quickQuery($banner);
$banner = DAS::hasData($banner) ? $banner['data'][0] : false;
$tagGroup = new Query("`t1`.*, `t2`.`number`, `t2`.`shop`, `t2`.`name`, `t2`.`timestamp`, `t3`.`name` AS shopName, `t4`.`folderName`, `t4`.`fileName`", "`tb_wcp_tags` AS `t1`", "LEFT JOIN `tb_wcp_showrooms` AS `t2` ON `t1`.`itemID` = `t2`.`id` LEFT JOIN `tb_wcp_shops` AS `t3` ON `t3`.`id` = `t2`.`shop` LEFT JOIN `tb_wcp_images` AS `t4` ON `t4`.`showroomNum` = `t2`.`number` AND `t4`.`showroomShop` = `t2`.`shop` AND `t4`.`component` LIKE 'sr%cover'", "`t1`.`tagGroup` = '风格' AND `t1`.`itemType` = 1", "`t1`.`tagIndex`, `t1`.`itemIndex`");
$tagGroup = DAS::quickQuery($tagGroup);
$tagGroup = $tagGroup['data'];
$tags = array();
foreach ($tagGroup as $item) {
    if (!isset($tags[$item['tag']])) {
        $tags[$item['tag']] = array();
        if (!isset($tags[$item['tag']])) {
            $tags[$item['tag']] = array();
        }
    }
    $tags[$item['tag']][] = $item;
}
$styles = array_keys($tags);

$showrooms = new Query("`t1`.*, `t2`.`name` AS shopName", "`tb_wcp_showrooms` AS `t1`", "LEFT JOIN `tb_wcp_shops` AS `t2` ON `t1`.`shop` = `t2`.`id`", "`t1`.`status` > 0", "`t1`.`ordnung`, `t1`.`id` DESC, `t1`.`number`");
$showrooms = DAS::quickQuery($showrooms);
$showrooms = DAS::hasData($showrooms) ? $showrooms['data'] : false;

$covers = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = -2 AND `component` LIKE 'sr%cover'");
$covers = DAS::quickQuery($covers);
$covers = DAS::hasData($covers) ? $covers['data'] : false;
?>  
    <?php
    if ($banner) {
    ?>
    <section class="section_banner" style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
      <?php
      if ($banner['href']) {
      ?>
        <a href="<?php echo $banner['href'];?>">
          <img class="topImg"  src="<?php echo $banner['folderName'] . '/' . $banner['fileName'];?>" alt="" style="width:100%;">
        </a>
      <?php
      }
      else {
      ?>
        <img class="topImg"  src="<?php echo $banner['folderName'] . '/' . $banner['fileName'];?>" alt="" style="width:100%;">  
      <?php
      }
      ?>
      </div>
    </section> 
    <?php
    }
    ?>
    <section style="text-align:center; margin-top:16px;">
      <div style="height:36px; width:96%;; display:inline-block; border-top:1px #888888 solid; border-bottom:1px #888888 solid; overflow:hidden; vertical-align:middle; max-width:<?php echo $maxWidth;?>;">
        <div style="display:inline-block; overflow-x:auto; height:48px; width:100%; overflow-y:hidden; margin-top:6px;">
        <?php
        if (count($styles) > 4) {
        ?>  
          <div style="display:block; height:100%; width:<?php echo count($styles) * 25?>%; text-align:center;">
          <?php
            foreach ($styles as $style) {
          ?>
            <a href="?style=<?php echo $style;?>" style="width:<?php echo (96/count($styles));?>%; display:inline-block; text-align:center; height:100%;"><?php echo $style;?></a>
          <?php
            }
          ?>
          </div>
        <?php
        }
        else {
        ?>
          <div style="display:block; height:100%; width:100%; text-align:center;">
          <?php
            foreach ($styles as $style) {
          ?>
            <a style="width:<?php echo (100/count($styles) - 2);?>%; display:inline-block; text-align:center; height:100%;"><?php echo $style;?></a>
          <?php
            }
          ?>
          </div>
        <?php
        }
        ?>
        </div>
      </div>
    </section>
    <?php
    $sectSplit = 1;
    if (!$styleTag) {
        for ($i = 0; $i < count($showrooms); $i++) {
            foreach ($covers as $cover) {
                if ($cover['showroomNum'] == $showrooms[$i]['number'] && $cover['showroomShop'] == $showrooms[$i]['shop']) {
                    $showroomCover = $cover;
                }
            }
            if ($sectSplit == 1) {
    ?>
    <section style="text-align:center; margin-top:36px;">
      <div style="width:91%; display:inline-block; text-align:left; max-width:<?php echo $maxWidth;?>;">
        <a href="yangban-v.html?id=<?php echo $showrooms[$i]['id'];?>"> 
          <div class="covers" style="width:47.5%; float:left; display:inline-block; box-shadow: 2px 10px 15px rgba(0, 0, 0, 0.5); background-image:url(<?php echo $showroomCover['folderName'] . '/' . $showroomCover['fileName'];?>); background-size:cover; text-align:center;">
            <div style="display:inline-block; height:50%; width:85%; border-bottom:2px #FFFFFF solid;">
              <div style="display:inline-block; margin-top:28%; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-weight:bold;"> 
                <?php echo $showrooms[$i]['name'];?>
              </div>
            </div>  
            <div style="display:inline-block; height:30%; width:85%;">
              <div style="display:inline-block; margin-top:5px; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-size:smaller;"> 
                了解详情 &raquo;
              </div>
            </div>
          </div>
        </a>
    <?php
            }
            if ($sectSplit == 2) {
    ?>
        <a href="yangban-v.html?id=<?php echo $showrooms[$i]['id'];?>"> 
          <div class="covers" style="width:47.5%; float:right; display:inline-block; box-shadow: 2px 10px 15px rgba(0, 0, 0, 0.5); background-image:url(<?php echo $showroomCover['folderName'] . '/' . $showroomCover['fileName'];?>); background-size:cover; text-align:center;">
            <div style="display:inline-block; height:50%; width:85%; border-bottom:2px #FFFFFF solid;">
              <div style="display:inline-block; margin-top:28%; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-weight:bold;"> 
                <?php echo $showrooms[$i]['name'];?>
              </div>
            </div>  
            <div style="display:inline-block; height:30%; width:85%;">
              <div style="display:inline-block; margin-top:5px; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-size:smaller;"> 
                了解详情 &raquo;
              </div>
            </div>
          </div>
        </a>
      </div>
    </section>
    <?php                
            }
            $sectSplit = $sectSplit == 1 ? $sectSplit + 1 : $sectSplit - 1;
        }
    }
    else {
        $showrooms = $tags[$styleTag];
        for ($i = 0; $i < count($showrooms); $i++) {
            foreach ($covers as $cover) {
                if ($cover['showroomNum'] == $showrooms[$i]['number'] && $cover['showroomShop'] == $showrooms[$i]['shop']) {
                    $showroomCover = $cover;
                }
            }
            if ($sectSplit == 1) {
    ?>
    <section style="text-align:center; margin-top:36px;">
      <div style="width:91%; display:inline-block; text-align:left; max-width:<?php echo $maxWidth;?>;">
        <a href="yangban-v.html?id=<?php echo $showrooms[$i]['id'];?>"> 
          <div class="covers" style="width:47.5%; float:left; display:inline-block; box-shadow: 2px 10px 15px rgba(0, 0, 0, 0.5); background-image:url(<?php echo $showroomCover['folderName'] . '/' . $showroomCover['fileName'];?>); background-size:cover; text-align:center;">
            <div style="display:inline-block; height:50%; width:85%; border-bottom:2px #FFFFFF solid;">
              <div style="display:inline-block; margin-top:28%; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-weight:bold;"> 
                <?php echo $showrooms[$i]['name'];?>
              </div>
            </div>  
            <div style="display:inline-block; height:30%; width:85%;">
              <div style="display:inline-block; margin-top:5px; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-size:smaller;"> 
                了解详情 &raquo;
              </div>
            </div>
          </div>
        </a>
    <?php
            }
            if ($sectSplit == 2) {
    ?>
        <a href="yangban-v.html?id=<?php echo $showrooms[$i]['id'];?>"> 
          <div class="covers" style="width:47.5%; float:right; display:inline-block; box-shadow: 2px 10px 15px rgba(0, 0, 0, 0.5); background-image:url(<?php echo $showroomCover['folderName'] . '/' . $showroomCover['fileName'];?>); background-size:cover; text-align:center;">
            <div style="display:inline-block; height:50%; width:85%; border-bottom:2px #FFFFFF solid;">
              <div style="display:inline-block; margin-top:28%; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-weight:bold;"> 
                <?php echo $showrooms[$i]['name'];?>
              </div>
            </div>  
            <div style="display:inline-block; height:30%; width:85%;">
              <div style="display:inline-block; margin-top:5px; text-shadow:2px 2px 5px #888888; color:#FFFFFF; font-size:smaller;"> 
                了解详情 &raquo;
              </div>
            </div>
          </div>
        </a>
      </div>
    </section>
    <?php                
            }
            $sectSplit = $sectSplit == 1 ? $sectSplit + 1 : $sectSplit - 1;
        }
    }
    ?>
    <section>
      <div style="display:inline-block; width:100%; height:80px;">
      </div>
    </section>
    <script language="javascript" type="text/javascript">
    var tags = <?php echo json_encode($tags);?>;
    var maxWidth = <?php echo intval($maxWidth);?>;
    var clientWidth = $(document).innerWidth();
    var coverWidth = clientWidth < maxWidth ? clientWidth * 0.91 * 0.475 : maxWidth * 0.475;
    var coverHeight = coverWidth * 0.815;
    console.log(clientWidth);
    $(document).ready(function(e) {
      $(".covers").width(coverWidth);
      $(".covers").height(coverHeight);
    });
    </script>
<?php
require_once('bottom1.inc');
?>