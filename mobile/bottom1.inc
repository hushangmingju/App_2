    <?php
    if(strpos($_SERVER['PHP_SELF'], 'dialog') === false && strpos($_SERVER['PHP_SELF'], 'gongdi') === false){
    ?>
    <section style="width:100%; padding:0px 0px 0px 0px; background-color:rgba(0, 0, 0, 0); left:0; bottom:0; position:fixed; z-index:100; top:auto; text-align:center;">
      <div style="width:100%; background-color:#4C4C4C; max-width:<?php echo $maxWidth;?>; display:inline-block; text-align:left;">
        <?php
        for ($i = 0; $i < count($globalImages['m_global_bottom']); $i++) {
        ?>
        <a href="<?php echo $globalImages['m_global_bottom'][$i]['href'];?>" style="width:49%; height:48px; display:inline-block;">
          <img src="<?php echo $globalImages['m_global_bottom'][$i]['folderName'] . '/' . $globalImages['m_global_bottom'][$i]['fileName'];?>" style="<?php echo $globalImages['m_global_bottom'][$i]['css'];?>">
          <span style="color:#FFF; font-size:14px; padding-left:10px;"><?php echo $globalImages['m_global_bottom'][$i]['head'];?></span>
        </a>
        <?php
        }
        ?>
      </div>
    </section>
    <?php
    }
    ?>
    <section>
      <div style="height:24px;; text-align:center; background-color:#FFFFFF; width:100%; max-width:<?php echo $maxWidth;?>;">
      </div>
    </section>
    <?php
    if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
        if (isset($globalValues['vcs_status']) && $globalValues['vcs_status'] == '1') {
            if (isset($globalValues['geo_status']) && $globalValues['geo_status'] == '1') {
    ?>
    <div id="GEO_LOCATION" style="display:none;"></div>
    <?php
            }
        }
    }
    if (strpos($_SERVER['REQUEST_URI'], 'isFrame') === false) {
        echo isset($globalValues['body_codes']) ? $globalValues['body_codes'] : '';
    }
    ?>
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
$(document).ready(function(e){
  $("#TOP_MENU_BUTTON").click(function(e){
    if(!document.getElementById("AGUI_SHADOW_BACKGROUND_DIV")){
      addBackgroundShadow(e);
      $("#TOP_MENU").slideDown("slow");
    }
    else{
      $("#TOP_MENU").slideUp("slow", "", function(e){removeBackgroundShadow();});      
    }
    if($(this).attr("src").indexOf("dropup") > 0){
      $(this).attr("src", "<?php echo $globalImages['m_global_dropdown']['folderName'] . '/' . $globalImages['m_global_dropdown']['fileName'];?>");
    }
    else{
      $(this).attr("src", "<?php echo $globalImages['m_global_dropup']['folderName'] . '/' . $globalImages['m_global_dropup']['fileName'];?>");
    }
  });
});    
//-->
</script>

<!-- VCS代码 -->
<script language="javascript" type="text/javascript">
<!--//
<?php
if (!strpos($_SERVER['REQUEST_URI'], 'isFrame')) {
?>
<?php
    if (isset($globalValues['vcs_status']) && $globalValues['vcs_status'] == '1') {
?>
getRegion();
<?php
        if (isset($globalValues['geo_status']) && $globalValues['geo_status'] == '1') {
?>
getCoordinate();
<?php
        }
?>
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();}};
<?php
    }
?>
<?php
}
?>
//-->
</script>