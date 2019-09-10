<?php
require_once('top1.inc');

$banner = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageID . " AND `component` = '" . $bannerComponent . "'");
$banner = DAS::quickQuery($banner);
$banner = DAS::hasData($banner) ? $banner['data'][0] : false;

$pictures = new Query("*", "`tb_wcp_images`", "", "`status` = 1 AND `pageID` = " . $pageID . " AND `component` = '" . $picturesComponent . "'", "`ordnung`");
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$composes = new Query("*", "`tb_wcp_composes`", "", "`status` = 1 AND `pageID` = " . $pageID, "`id`");
$composes = DAS::quickQuery($composes);
$composes = DAS::hasData($composes) ? $composes['data'] : false;
?> 
  <?php
  // Banner 图片  
  if ($banner) {
  ?>
    <section class="section_banner" style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
        <img src="<?php echo $banner['folderName'] . '/' . $banner['fileName'];?>" style="width:100%;"/>
      </div>
    </section>
  <?php
  }
  ?>
  <?php
  // 图片及插件
  if ($pictures) {
      for ($i = 0; $i < count($pictures); $i++) {
          if ($composes) {
              for ($j = 0; $j < count($composes); $j++) {
                  if ($composes[$j]['ordnung'] == $pictures[$i]['ordnung']) {
                      $columnValues = json_decode($composes[$j]['json'], true);
                      $columns = PLUGIN::$plugIns[$composes[$j]['plugInIndex']]['column'];
                      $dataArray = array();
                      for ($k = 0; $k < count($columns); $k++) {
                          $dataArray[$columns[$k]] = rawurldecode($columnValues[$k]);
                      }
  ?>
    <section class="section_pics" style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
  <?php            
                      echo PLUGIN::setPlugIn($dataArray, $composes[$j]['plugInIndex']);
  ?>    
      </div>      
    </section>
  <?php       
                  }
              }
          }
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
        <img src="<?php echo $pictures[$i]['folderName'] . '/' . $pictures[$i]['fileName'];?>" style="width:100%; margin:0px;"/>
      </div>
    </section>
  <?php  
      }
  }
  if ($composes) {
      for ($i = 0; $i < count($composes); $i++) {
          if ($composes[$i]['ordnung'] == -1) {
              $columnValues = json_decode($composes[$i]['json'], true);
              $columns = PLUGIN::$plugIns[$composes[$i]['plugInIndex']]['column'];
              $dataArray = array();
              for ($j = 0; $j < count($columns); $j++) {
                  $dataArray[$columns[$j]] = rawurldecode($columnValues[$j]);
              }
              if ($composes[$i]['type'] != 'dialog' && $composes[$i]['type'] != 'bar') {    
  ?>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:100%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
  <?php            
                  echo PLUGIN::setPlugIn($dataArray, $composes[$i]['plugInIndex']);
  ?>   
      </div>       
    </section>
  <?php 
              }
              else {
                  echo PLUGIN::setPlugIn($dataArray, $composes[$i]['plugInIndex']);
              }
          }
      }
  }
  ?>
<script type="text/javascript" language="javascript">
<!--//
var dialog = new Array();
<?php
foreach ($composes as $compose) {
    if ($compose['type'] == 'dialog') {
        $columns = PLUGIN::getPlugInsColumns($compose['plugInIndex']);
        $idIndex = -1;
        for ($i = 0; $i < count($columns['column']); $i++) {
            if ($columns['column'][$i] == 'id') {
                $idIndex = $i;
            }
        }
        $columnValues = json_decode($compose['json'], true);
        echo 'dialog.push(new DIALOG("' . rawurldecode($columnValues[$idIndex]) . '"));';
    }
}
?>     
function openDialog(id){
  if(document.getElementById(id)){
    for(var i = 0; i < dialog.length; i++){
      if(dialog[i].id == id){
        dialog[i].show();
      }
    }
  }
}
function closeDialog(id){
  if(document.getElementById(id)){
    for(var i = 0; i < dialog.length; i++){
      if(dialog[i].id == id){
        dialog[i].hide();
      }
    }
  }
}
//-->
</script>
<?php
require_once('bottom1.inc');
?>