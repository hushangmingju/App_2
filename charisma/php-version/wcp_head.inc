<?php
require_once('init.inc');
require_once('../../mobile/plugins.inc'); 
function LogStatus($key="_key_") {
    if ($key=="_key_") {
        if (empty($_SESSION['admin'])) {
            return false;
        } else {
            return $_SESSION['admin'];
        }
    } elseif ($key=="unset") {
        unset($_SESSION['admin']);
    } else {
        $_SESSION['admin'] = $key;
    }
}

if (!isset($no_visible_elements) || !$no_visible_elements) {
	if(LogStatus()){
		header('Content-Type: text/html; charset=utf-8');
	}else{
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: ./login.html");
		exit();
	}
	$username = LogStatus();
}
$tagGroups = new Query("DISTINCT `tagGroup`", "`tb_wcp_tags`", "", "", "`groupIndex`");
$tagGroups = DAS::quickQuery($tagGroups);
$tagGroups = DAS::hasData($tagGroups) ? $tagGroups['data'] : false;

$globalBackgroundColor = DAS::isExistedInDB("tb_wcp_contents", "pageID = -1 AND component = 'backgroundColor'", "contentChar");
$globalBackgroundColor = $globalBackgroundColor ? $globalBackgroundColor : '#FFFFFF';

$plugInColumns = PLUGIN::getPlugInsColumns();

$imgFolderArray = array(
    'pics' => 'dialogPicsList.show(e, loadImgListWidget("PICS_LIST_DIALOG_DIV"));',
    'icons' => 'dialogIconsList.show(e, loadImgListWidget("ICONS_LIST_DIALOG_DIV"));',
    'shops' => 'dialogShopCoversList.show(e, loadImgListWidget("SHOPCOVERS_LIST_DIALOG_DIV"));',
    't' => 'dialogTuiguangList.show(e, loadImgListWidget("TUIGUANG_LIST_DIALOG_DIV"));'
);

$pages = new Query("*", "`tb_vcs_pages`", "", "`status` = 1", "`id`");
$pages = DAS::quickQuery($pages);
$pages = DAS::hasData($pages) ? $pages['data'] : false;
if ($pages) {
    $platforms = new Query("`platform`, COUNT(`id`) AS pageNumber", "`tb_vcs_pages`", "", "`status` = 1 AND `templet` > 0", "pageNumber DESC", "`platform`");
    $platforms = DAS::quickQuery($platforms);
    $platforms = DAS::hasData($platforms) ? $platforms['data'] : false;
} 
?>


<!doctype html>
<html>
  <html lang="en">
    <meta charset="utf-8">
    <title>网站编辑控制台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/style.css' rel='stylesheet'>
    <link href='css/simditor.css' rel='stylesheet'>
    <link rel="stylesheet" href="./kind/themes/default/default.css" />
    <!-- jQuery -->
    <script language="javascript" src="../../js/jquery-2.1.4.min.js"></script>
    <script language="javascript" src="../../js/echarts.common.min.js"></script>
    <script language="javascript" src="../../js/agui.js"></script>
    <script src="js/wangEditor.js"></script>
  </head>
  <style>
  a:hover{
    text-decoration:none;
    cursor:pointer;
  }
  a.icon_button{
    color:#ECECEC;
  }
  a.icon_button:hover{
    color:#ffffff;
  }
  a.icon_button2{
    color:#35a6e7;
  }
  a.icon_button2:hover{ 
    color:#666666;
  }
  a.icon_button3{
    background-color:#35a6e7;
    color:#FFFFFF;
  }
  a.icon_button3:hover{ 
    background-color:#666666;
  }

  button:hover{
    box-shadow:#888888 0px 2px 8px;  
  }
  button:active{
    box-shadow:none;
  }
  .gray{
    -webkit-filter:grayscale(100%);
    -moz-filter:grayscale(100%);
    -ms-filter:grayscale(100%);
    -o-filter:grayscale(100%);
    filter:grayscale(100%);
    filter:gray;
  }  
  .compose_block{
    cursor:pointer;
  }
  .compose_checked{
    cursor:pointer;
    border:#FF0000 2px solid;
  }
  .compose_block:hover{
    border:#35a6e7 2px solid;
  }
  
  .button_active{
    background-color:#35a6e7; 
    color:#FFFFFF; 
    border:none; 
    border-radius:3px;
  }
  .button_deactive{
    background-color:#FFFFFF; 
    color:#35a6e7; 
    border:none; 
    border-radius:3px;
  }
  </style>
  <script type="text/javascript" language="javascript">
  <!--//
  // boolean getCookie((string) varname, (mixed) value, (int) expiredays)
  function setCookie(varname,value,expiredays){
	if(!varname||typeof varname!=="string"){
	  return false;
	}
	if(value){
	  var valueStr=varname+"="+escape(value);
	  if(expiredays){
		expiredays=parseInt(expiredays);
		if(!isNaN(expiredays)){
	      var exdate=new Date();
		  exdate=new Date(exdate.getTime() +1000*60*60*24*expiredays);
		  valueStr+=";expires="+exdate.toGMTString()+";";
		}
	  }
	  document.cookie=valueStr;
	}
	else{
	  document.cookie=varname+"=0;expires=Thu, 01-Jan-70 00:00:01 GMT;";
	}
	return true;
  }
  // mixed getCookie((string) varname)
  function getCookie(varname){
	if(!varname||!document.cookie||document.cookie.length===0||document.cookie.indexOf(varname+"=")==-1){
	  return null;
	}
	return unescape(document.cookie.split(varname+"=",2)[1].split(";",2)[0]);
  } 
  //-->
  </script>

  <body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
      <div class="navbar-inner">
        <a class="navbar-brand" href="index.html">&laquo;返回管理中心</a>
      </div>
    </div>
    <!-- topbar ends -->
    <div class="ch-container">
      <div class="row">
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
          <div class="sidebar-nav">
            <div class="nav-canvas">
              <div class="nav-sm nav nav-stacked">
              </div>
              <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">网页编辑控制台</li>
                <?php
                if ($platforms) {
                    for ($i = 0; $i < count($platforms); $i++) {
                ?>
                <li class="accordion">
                  <a style="cursor:pointer;"><i class="glyphicon glyphicon-plus"></i><span> <?php echo $platforms[$i]['platform'];?></span></a>
                  <ul class="nav nav-pills nav-stacked">                  
                  <?php
                        if ($platforms[$i]['platform'] == '官网移动端') {
                  ?>
                    <li><a href="wcp_m_global.html"><i class="glyphicon glyphicon-cog"></i><span> 全局设置</span></a></li>
                  <?php
                        }
                        for ($j = 0; $j < count($pages); $j++) {
                            if ($pages[$j]['platform'] == $platforms[$i]['platform'] && $pages[$j]['templet'] > 0) {
                                if ($pages[$j]['templet'] == 1) {
                                    $href = $pages[$j]['configFile'];
                                }
                                else if ($pages[$j]['templet'] == 2){
                                    $href = "wcp_mobile.html?id=" . $pages[$j]['id'];
                                }
                                else if ($pages[$j]['templet'] == 3){
                                    $href = "wcp_tuiguang.html?id=" . $pages[$j]['id'];
                                }
                  ?>
                    <li><a href="<?php echo $href;?>"><i class="glyphicon glyphicon-globe"></i><span> <?php echo $pages[$j]['pageNameCN'] ? $pages[$j]['pageNameCN'] : $pages[$j]['pageFile'];?></span></a></li>
                  <?php
                            }
                        }
                  ?>  
                  </ul>
                </li> 
                <?php
                    }
                }
                ?>
                <li class="accordion">
                  <a style="cursor:pointer;"><i class="glyphicon glyphicon-plus"></i><span> 数据管理</span></a>
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="wcp_showrooms.html"><i class="glyphicon glyphicon-th-large"></i><span> 样板间管理</span></a></li>
                    <?php
                    if ($tagGroups) {
                    ?>
                    <li class="accordion">
                      <a style="cursor:pointer;"><i class="glyphicon glyphicon-plus"></i><span> 标签组和标签</span></a>
                      <ul class="nav nav-pills nav-stacked" style="display: none;">
                        <li><a href="wcp_tags.html" style="cursor:pointer;"><i class="glyphicon glyphicon-list"></i><span> 标签管理</span></a></li>
                    <?php
                        foreach ($tagGroups as $tagGroup) {
                    ?>
                        <li><a href="wcp_taggroup.html?group=<?php echo $tagGroup['tagGroup'];?>" style="cursor:pointer;"><i class="glyphicon glyphicon-tags"></i><span> <?php echo $tagGroup['tagGroup'];?></span></a></li>
                    <?php
                        }
                    ?>                        
                      </ul>
                    </li>
                    <?php
                    }
                    else {
                    ?>
                    <li><a href="wcp_tags.html"><i class="glyphicon glyphicon-list"></i><span> 标签管理</span></a></li>
                    <?php                    
                    }
                    ?>                    
                    <li><a href="wcp_shops.html"><i class="glyphicon glyphicon-lock"></i><span> 门店管理</span></a></li>
                    <!--<li><a href="wcp_info.html"><i class="glyphicon glyphicon-info-sign"></i><span> 基本信息</span></a></li>-->
                    <li><a href="wcp_pages.html"><i class="glyphicon glyphicon-list-alt"></i><span> 页面管理</span></a></li>
                  </ul>
                </li>                                  
              </ul>                    
            </div>
          </div>
        </div>
        <!--left menu end -->
        <div id="content" class="col-lg-10 col-sm-10">
          <!-- content starts -->
          <!-- #IMG_DIALOG_DIV 图片上传添加编辑对话框-->
          <div id="IMG_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:960px; padding:20px 20px 20px 20px;">
            <!-- #IMG_FORM 图片上传添加编辑表单 -->
            <form id="IMG_FORM">
              <input type="hidden" name="id" value=""/>
              <input type="hidden" name="action" value=""/>
              <input type="hidden" name="component" value=""/>
              <input type="hidden" name="folder" value=""/>
              <input type="hidden" name="descript" value=""/>
              <input type="hidden" name="pageFile" value=""/>
              <input type="hidden" name="showroomNum" value=""/>
              <input type="hidden" name="showroomShop" value=""/>
              <!-- #TEMP_UPLOAD_IMG_PATH 临时上传文件路径 -->
              <input id="TEMP_UPLOAD_IMG_PATH" type="hidden" name="tempPath" value=""/>
              <!-- #TEMP_UPLOAD_IMG_PREVIEW 临时上传文件ID -->
              <input id="TEMP_UPLOAD_IMG_ID" type="hidden" name="tempID" value=""/>
              <!-- .DialogTitle 对话框标题（文本） -->
              <div class="DialogTitle" style="display:block; height:32px; color:#35a6e7; font-size:16px; font-weight:bold; padding-left:10px;"></div>
              <div style="width:400px; padding:0px; border-bottom:none; text-align:center; display:inline-block;"> 
                <table cellpadding="0" cellspacing="0" style="width:100%; padding:0px; margin:0px;">
                  <tr> 
                    <!-- #TEMP_UPLOAD_IMG_PREVIEW_BOARD_TD 图片预览框背板 -->                     
                    <td id="TEMP_UPLOAD_IMG_PREVIEW_TD" valign="middle" style="text-align:center; width:400px;">
                      <!-- #TEMP_UPLOAD_IMG_PREVIEW_DIV 图片预览框 -->
                      <div id="TEMP_UPLOAD_IMG_PREVIEW_DIV" style="background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; box-shadow:#aaa 0px 5px 10px; vertical-align:inherit; overflow:hidden;"></div>
                    </td>
                  </tr>
                </table>
                <!-- #TEMP_UPLOAD_IMG_INFO 图片信息 -->
                <p id="TEMP_UPLOAD_IMG_INFO" style="text-align:left; padding-left:20px; margin-top:20px; height:20px; font-size:11px;"></p>
                <p style="margin-top:20px; text-align:left; padding-left:20px;">图片格式建议：</p>
                <!-- #TEMP_UPLOAD_IMG_REQUIRE 图片上传要求（文本） -->
                <p id="TEMP_UPLOAD_IMG_REQUIRE" style="text-align:left; padding-left:20px;"></p>
                <!-- #IMG_SELECT_BUTTON 浏览图片按钮 -->
                <button type="button" id="IMG_SELECT_BUTTON" style="background-color:#35a6e7; border-radius:10px; width:38%; padding:5px; border:none; font-size:22px; color:#FFFFFF; margin-top:20px;">选择图片</button> 
                <button type="button" onclick="$(this).parents('form').next().children('#f').click();" style="background-color:#35a6e7; border-radius:10px; width:38%; padding:5px; border:none; font-size:22px; color:#FFF; margin-top:20px; margin-left:28px;">上传图片</button>
              </div>
              <div style="padding-left:48px; width:500px; display:inline-block; vertical-align:top;">
                <!-- #IMG_DIALOG_ALT_DIV alt字段表单栏 -->
                <div id="IMG_DIALOG_ALT_DIV" style="display:block; width:100%;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">alt:</span>
                    <span>alt属性是图片的替代文字，可用于爬虫爬取。（选填）</span>
                  </div>
                  <input type="text" name="alt" placeholder="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <!-- #IMG_DIALOG_TITLE_DIV title字段表单栏 -->
                <div id="IMG_DIALOG_TITLE_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">title:</span>
                    <span>tilte属性是鼠标停留在图片上会显示的文字。（选填）</span>
                  </div>
                  <input type="text" name="title" placeholder="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <!-- #IMG_DIALOG_HREF_DIV href字段表单栏 -->
                <div id="IMG_DIALOG_HREF_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">链接:</span>
                    <span>href属性是点击图片后跳转到的网页链接。（选填）</span>
                  </div>
                  <input type="text" name="href" placeholder="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <!-- #IMG_DIALOG_HEAD_DIV head字段表单栏 -->
                <div id="IMG_DIALOG_HEAD_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">标题:</span>
                    <span>图片对应的标题文本。（选填）</span>
                  </div>
                  <input type="text" name="head" placeholder="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
                <!-- #IMG_DIALOG_CONTENT_DIV content字段表单栏 -->
                <div id="IMG_DIALOG_CONTENT_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">内容:</span>
                    <span>图片对应的文本内容。（选填）</span>
                  </div>
                  <textarea name="content" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;">
                  </textarea>
                </div>
                <!-- #IMG_DIALOG_CSS_DIV css字段表单栏 -->
                <div id="IMG_DIALOG_CSS_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">CSS样式:</span>
                    <span>用于自定义图片CSS样式。（选填）</span>
                  </div>
                  <textarea name="css" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;">
                  </textarea>
                </div>
                <!-- #IMG_DIALOG_PATH_DIV path字段表单栏 -->
                <div id="IMG_DIALOG_PATH_DIV" style="display:block; width:100%; margin-top:22px;">
                  <div style="display:block; text-align:left;">
                    <span style="color:#35a6e7; font-size:16px; font-weight:bold;">图片路径:</span>
                  </div>
                  <input id="IMG_PATH" type="text" placeholder="" disabled="disabled" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                  <input id="IMG_PATH_HIDDEN" type="hidden" name="path" placeholder="" style="width:100%; font-size:14px; padding:6px; border-radius:5px; border:1px solid #aaa; margin-top:8px;"/>
                </div>
              </div>
              <div style="display:block; text-align:right; margin-top:20px;">
                <!-- #IMG_SUBMIT_BUTTON 提交图片按钮 -->
                <button type="button" id="IMG_SUBMIT_BUTTON" onclick="" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" onclick="dialogImg.hide();" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">关闭</button>
              </div>
            </form>        
            <form id="FILE_FORM" style="text-align:center;">                      
              <input type="file" id="f" name="f" onchange="" style="display:none"/>
            </form>
          </div>
          <!-- #PICS_LIST_DIALOG_DIV 图片浏览对话框 -->
          <div id="PICS_LIST_DIALOG_DIV" style="border:none; display:none; z-index:200; width:1320px; background-color:rgb(255,255,255,0);">
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
              $files = glob('../../images/pics/*.*');
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
              <a onClick="dialogPicsList.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div> 
          </div>
          <!-- #ICONS_LIST_DIALOG_DIV 图标浏览对话框 -->
          <div id="ICONS_LIST_DIALOG_DIV" style="border:none; display:none; z-index:200; width:1320px; background-color:rgb(255,255,255,0);">
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
              $files = glob('../../images/icons/*.*');
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
              <a onClick="dialogIconsList.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div> 
          </div>
          <!-- #SHOPCOVERS_LIST_DIALOG_DIV 门店图片浏览对话框 -->
          <div id="SHOPCOVERS_LIST_DIALOG_DIV" style="border:none; display:none; z-index:200; width:1320px; background-color:rgb(255,255,255,0);">
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
              $files = glob('../../images/shops/*.*g');
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
              <a onClick="dialogShopCoversList.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div> 
          </div>
          <!-- #TUIGUANG_LIST_DIALOG_DIV 推广端图片浏览对话框 -->
          <div id="TUIGUANG_LIST_DIALOG_DIV" style="border:none; display:none; z-index:200; width:1320px; background-color:rgb(255,255,255,0);">
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
              $files = glob('../../images/t/*.*');
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
              <a onClick="dialogTuiguangList.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div> 
          </div>
          <!-- #IMG_SHOW_DIALOG_DIV 图片选择对话框-->
          <div id="IMG_SHOW_DIALOG_DIV" style="border:none; display:none; z-index:220; width:1320px; max-height:660px; background-color:rgb(255,255,255,0); text-align:center;">
            <input type="hidden" id="IMG_SHOW_WIDTH" value=""/>
            <input type="hidden" id="IMG_SHOW_HEIGHT" value=""/>
            <input type="hidden" id="IMG_SHOW_SUFFIX" value=""/>
            <input type="hidden" id="IMG_SHOW_SIZE" value=""/>
            <div style="display:block; text-align:center;">
              <h2 id="IMGSHOW_DIALOG_FILENAME_H2" style="color:#FFFFFF; margin-top:-24px;"></h2>
            </div>
            <table cellpadding="0" cellspacing="0" style="width:100%;">
              <tr>
                <td valign="middle" align="center" style="display:block; overflow:hidden; margin-top:24px; max-width:1320px; max-height:600px; text-align:center;">
                  <div style="background-image:url(http://www.mingjugroup.com/charisma/img/wcp/transparent_background.jpg); background-repeat:repeat; display:inline-block;">
                    <img id="IMGSHOW_DIALOG_IMG" src=""/>
                  </div>
                </td>
              </tr>
            </table>
            <div style="display:block; text-align:center;">
              <a onClick="dialogImgShow.hide();" style="cursor:pointer;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/close.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
              <a onClick="selectImg($('#IMG_FORM'), $('#IMG_SHOW_DIALOG_DIV').find('#IMGSHOW_DIALOG_IMG').attr('src'));" style="cursor:pointer; margin-left:48px;">
                <img src="http://www.mingjugroup.com/charisma/img/wcp/ok.png" style="position:relative; margin-bottom:-120px; width:64px;"/>
              </a>
            </div>
          </div>
          <!-- #PLUGIN_DIALOG_DIV 插件添加编辑对话框-->
          <div id="PLUGIN_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:960px; padding:20px 20px 20px 20px;">
            <?php
            $files = glob('../img/wcp/plugins/*.*');
            $pageNum = ceil(count($files) / 3);            
            ?>
            <!-- #FORM_FORM 添加编辑表单 -->
            <form id="PLUGIN_FORM">
              <input type="hidden" name="id" value=""/>
              <input type="hidden" name="plugInIndex" value=""/>
              <!-- .DialogTitle 对话框标题（文本） -->
              <div class="DialogTitle" style="display:block; height:32px; color:#35a6e7; font-size:16px; font-weight:bold; padding-left:10px;"></div>
              <div id="PLUGIN_DIALOG_LEFT_DIV" style="width:400px; padding:0px; border-bottom:none; text-align:center; display:inline-block;"> 
                <div style="overflow:hidden; display:inline-block; width:322px; height:620px; padding:0px; background-color:#EEEEEE; border:1px solid #CCCCCC; text-align:center;">
                <a id="PLUGIN_UP" style="display:none; position:fixed; cursor:pointer; z-index:120;">
                  <img src="http://www.mingjugroup.com/charisma/img/wcp/up.png"/> 
                </a>
                <a id="PLUGIN_DOWN" style="display:none; position:fixed; margin-top:590px; cursor:pointer; z-index:120;">
                  <img src="http://www.mingjugroup.com/charisma/img/wcp/down.png"/> 
                </a>
                <?php                
                echo '<div id="PLUGIN_LIST_IMAGE_BOARD" style="height:' . (620 * $pageNum) . 'px; display:inline-block; position:relative; text-align:center; margin-left:10px;">';
                for ($i = 0; $i < $pageNum; $i++) {
                    echo '<div style="display:inline-block; height:620px; text-align:left; width:320px;">';
                    for ($j = 0; $j < 3; $j++) {
                        $index = $j + ($i * 3);
                        if (isset($files[$index])) {
                ?>
                  <a onClick='$("#PLUGIN_LIST_IMAGE_BOARD").find("img").css("box-shadow", "0px 3px 8px #888888");$(this).find("img").css("box-shadow","0px 3px 8px #FF0000");setColumnPlugIn($(this).parents("#PLUGIN_DIALOG_LEFT_DIV").next(), <?php echo $index;?>);'>
                    <img src="<?php echo str_replace('..', 'http://www.mingjugroup.com/charisma', $files[$index]);?>" style="width:300px; height:180px; box-shadow:0px 3px 8px #888888; margin-top:20px;"/>
                  </a>
                <?
                        }
                    }
                    echo '</div>';
                }
                echo '</div>';
                ?>
                </div>
              </div>
              <div id="PLUGIN_DIALOG_RIGHT_DIV" style="padding-left:48px; width:500px; display:inline-block; vertical-align:top; overflow:auto; height:620px;">
              </div>
              <div style="display:block; text-align:right; margin-top:20px;">
                <!-- #IMG_SUBMIT_BUTTON 提交图片按钮 -->
                <button type="button" id="PLUGIN_SUBMIT_BUTTON" onclick="" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" onclick="dialogPlugIn.hide();" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">关闭</button>
              </div>
            </form>
          </div>          
          <!-- #COMPOSE_DIALOG_DIV 排版对话框-->
          <div id="COMPOSE_DIALOG_DIV" style="background-color:#fff; border:1px #999 solid; display:none; z-index:120; width:720px; height:720px; padding:20px 20px 20px 20px;">
            <!-- #COMPOSE_FORM 排版表单 -->
            <form id="COMPOSE_FORM">
              <input type="hidden" name="id" value=""/>
              <input type="hidden" name="ordnung" value=""/>
              <input type="hidden" name="action" value="set_compose"/>
              <!-- .DialogTitle 对话框标题（文本） -->
              <div class="DialogTitle" style="display:block; height:32px; color:#35a6e7; font-size:16px; font-weight:bold; padding-left:10px;">设置插件位置：</div>
              <div id="COMPOSE_DIALOG_LEFT_DIV" style="width:400px; padding:0px; border-bottom:none; text-align:center; display:inline-block;"> 
                <div style="overflow:hidden; display:inline-block; width:322px; height:569px; padding:0px; background-color:#EEEEEE; border:1px solid #CCCCCC; text-align:left;">
                  <div style="overflow:auto; width:342px; height:570px; display:inline-block; padding:0px; margin:0px; text-align:left;">
                    <div id="COMPOSE_PREVIEW_BOARD_DIV" style="display:inline-block; width:320px; padding:0px; margin:0px; text-align:center; vertical-align:top;">
                    </div>
                  </div>
                </div>
              </div>
              <div style="padding-left:0px; width:260px; display:inline-block; vertical-align:top; overflow:auto;">
                <div style="display:block; padding:20px; border:1px #35a6e7 dashed; border-radius:10px;">
                  <h4>使用提示：</h4>
                  <p>新创建的插件会自动排列在最下方。</p>
                  <p>左侧预览图中点击选择想要插入插件的位置，提交后插件将会插入到所选图片前面。</p>
                  <p>如果需要连续排列多个插件，请先按顺序创建这些插件，然后将他们插入到同一图片之前。</p>                  
                  <p>再次点击选中的位置图片，该位置会被取消选中状态，提交后插件将会回到最下方。</p>                 
                  <p>浮动组件和弹出组件不会在排版预览框显示，请参考实际页面调整参数。</p>
                </div>
              </div>
              <div style="display:block; text-align:right; margin-top:20px;">
                <!-- #IMG_SUBMIT_BUTTON 提交图片按钮 -->
                <button type="button" id="COMPOSE_SUBMIT_BUTTON" onclick="" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">提交</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" onclick="dialogCompose.hide();" style="background-color:#35a6e7; border-radius:10px; width:96px; padding:5px; border:none; font-size:22px; color:#FFF;">关闭</button>
              </div>
            </form>
          </div>
          <script language="javascript" type="text/javascript">
          <!--//
          var dialogImg = new DIALOG("IMG_DIALOG_DIV");
          var dialogPicsList = new DIALOG("PICS_LIST_DIALOG_DIV");
          var dialogIconsList = new DIALOG("ICONS_LIST_DIALOG_DIV");
          var dialogShopCoversList = new DIALOG("SHOPCOVERS_LIST_DIALOG_DIV");
          var dialogTuiguangList = new DIALOG("TUIGUANG_LIST_DIALOG_DIV");
          var dialogImgShow = new DIALOG("IMG_SHOW_DIALOG_DIV");
          var dialogPlugIn = new DIALOG("PLUGIN_DIALOG_DIV");
          var dialogCompose = new DIALOG("COMPOSE_DIALOG_DIV");
          
          var plugIns = <?php echo json_encode($plugInColumns);?>;
          
          
          // uploadImg(jQueryObj, type, size) 上传图片文件，jQueryObj为文件上传表单行 <input type="file" id="f"/>， type为允许的文件类型，以','分割如：'.JPG,.PNG'，size为允许的最大文件大小（KB），如512。
          function uploadImg(jQueryObj, type, size){
            var obj = jQueryObj;
            var types = type.split(",");
            var maxSize = size || Infinity;
            maxSize = maxSize * 1024;
            //获取上传的图片名 带//
            var imgName = obj.val(); 
            //分割
            var imgNameArr = imgName.split("\\"); 
            //去掉 // 获取图片名
            var imgFileName = imgNameArr[imgNameArr.length-1]; 
            //获取 . 出现的位置
            var imgSuffix = imgFileName.lastIndexOf("."); 
            //切割 . 获取文件后缀
            imgSuffix = imgFileName.substring(imgSuffix, imgFileName.length).toUpperCase();  
            //获取上传的文件  
            var file = obj.get(0).files[0]; 
            //获取上传的文件大小
            var fileSize = file.size;           
  
            // 判断文件类型是否符合要求
            if(types.length > 0){
              $isValidType = false;
              for(var i = 0; i < types.length; i++){
                if(imgSuffix == types[i].toUpperCase()){
                  $isValidType = true;
                }
              }
              if(!$isValidType){
                alert("文件类型错误,请按要求上传图片类型。");
                return false;
              }
            }
            // 判断文件大小是否符合要求
            if(parseInt(fileSize) > parseInt(maxSize)){
              alert("上传的文件不能超过" + size + "KB。");
              return false;
            }
            // 创建上传对象
            var formData = new FormData();
            formData.append("image", file);
            // 提交表单
            $.ajax({  
              url: "wcp_upload_picture.html", 
              type: "POST",  
              data: formData,  
              dataType: "JSON",  
              cache: false,  
              processData: false,  
              contentType: false
            }).done(function(ret){  
              if(ret["isSuccess"]){
                var maxWidth = parseInt(obj.parent().prev().find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").css("width")) || 400;
                var maxHeight = parseInt(obj.parent().prev().find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").css("height")) || 64;
                var width = ret["width"];
                var height = ret["height"];
                var imgSize = fixImgSize(width, height, maxWidth, maxHeight);      
                var result = "<img src=\"" + ret["f"]  + "\" style=\"width:" + imgSize.width + "px; height:" + imgSize.height + "; margin-top:" + imgSize.marginTop + "px\">";
                obj.parent().prev().find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + imgSuffix + " 大小：" + Math.ceil(parseInt(fileSize) / 1024) + "KB" + " 图片尺寸：" + width + " x " + height + "px");
                obj.parent().prev().find("div#TEMP_UPLOAD_IMG_PREVIEW_DIV").html(result);
                obj.parent().prev().find("input#TEMP_UPLOAD_IMG_PATH").val(ret["f"]);
                obj.parent().prev().find("input#TEMP_UPLOAD_IMG_ID").val(ret["id"]);
                obj.parent().prev().find("input#IMG_PATH").val("");
                obj.parent().prev().find("input#IMG_PATH_HIDDEN").val("");
                console.log("上传成功");
              }
              else{  
                console.log(ret["msg"]);
              }  
            });  
            return false;
          }
          // selectImg(jQueryObj, imgPath) 选择图片 jQueryObj为图片设置主表单的JQuery对象，如：$('#IMG_FORM')，imgPath为图片路径。
          function selectImg(jQueryObj, imgPath){
            var width = $("#IMG_SHOW_DIALOG_DIV").find("#IMG_SHOW_WIDTH").val();
            var height = $("#IMG_SHOW_DIALOG_DIV").find("#IMG_SHOW_HEIGHT").val();
            var maxWidth = $("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css("width");
            var maxHeight = $("#TEMP_UPLOAD_IMG_PREVIEW_DIV").css("height");
            var fixSize = fixImgSize(width, height, maxWidth, maxHeight); 
  
            var imgSize = $("#IMG_SHOW_DIALOG_DIV").find("#IMG_SHOW_SIZE").val();  
            var imgSuffix = $("#IMG_SHOW_DIALOG_DIV").find("#IMG_SHOW_SUFFIX").val(); 
  
            jQueryObj.find("#TEMP_UPLOAD_IMG_PREVIEW_DIV").html("<img src=\"" + imgPath  + "\" style=\"width:" + fixSize.width + "px; height:" + fixSize.height + "px; margin-top:" + fixSize.marginTop + "px\">");
            jQueryObj.find("p#TEMP_UPLOAD_IMG_INFO").text("文件类型：" + imgSuffix.toUpperCase() + " 大小：" + imgSize + " 图片尺寸：" + width + " x " + height + "px");
            jQueryObj.find("input#TEMP_UPLOAD_IMG_PATH").val(imgPath);
            jQueryObj.find("input#TEMP_UPLOAD_IMG_ID").val(-1);
            jQueryObj.find("input#IMG_PATH").val(imgPath.substring(6));
            jQueryObj.find("input#IMG_PATH_HIDDEN").val(imgPath.substring(6));
            dialogImgShow.hide();
            dialogIconsList.hide();
            dialogPicsList.hide();
            dialogShopCoversList.hide(); 
            dialogTuiguangList.hide(); 
            dialogShowroomPicsList.hide();
          }
          // fixImgSize(width, height, maxWidth, maxHeight) 自适应图片尺寸
          function fixImgSize(width, height, maxWidth, maxHeight){
            var width = parseInt(width);
            var height = parseInt(height);
            var maxWidth = parseInt(maxWidth);
            var maxHeight = parseInt(maxHeight);
            if(width > maxWidth){
              height = (height / width) * maxWidth;
              width = maxWidth;
            }
            if(height > maxHeight){
              width = (width / height) * maxHeight;
              height = maxHeight;
            }
            var marginTop = (maxHeight - height) / 2;
            return {width: width, height: height, marginTop: marginTop};
          }
          // setField(jqueryObj, turnOn, value) 设置图片对话框右侧表单栏显示隐藏属性
          function setField(jqueryObj, turnOn, value){
            if(jqueryObj){
              var value = value || "";
              var turnOn = turnOn || false;
              if(turnOn){
                jqueryObj.show();
                jqueryObj.find("input").attr("disabled", false);
                jqueryObj.find("input").val(value);
                jqueryObj.find("textarea").attr("disabled", false);
                jqueryObj.find("textarea").val(value);
                jqueryObj.find("textarea").text(value);
              }
              else{
                jqueryObj.hide();
                jqueryObj.find("input").attr("disabled", "disabled");
                jqueryObj.find("input").val("");
                jqueryObj.find("textarea").attr("disabled", "disabled");
                jqueryObj.find("textarea").val("");
                jqueryObj.find("textarea").text("");
              }
            }
          }
          // loadImgListWidget(elmID) 载入图片浏览器控件, elmID图片浏览器ID
          function loadImgListWidget(elmID){
            var imglistObj = $("#" + elmID);
            if(parseInt(imglistObj.find("#IMG_LIST_IMAGE_BOARD").css("width")) > 1460){
              imglistObj.find("#IMGLIST_ARROW_RIGHT").fadeIn("slow");
            }
            imglistObj.find('#IMG_LIST_IMAGE_BOARD').css("left", "0px");
            imglistObj.find('#IMGLIST_ARROW_LEFT').hide();
            imglistObj.find("#IMGLIST_ARROW_RIGHT").unbind();
            imglistObj.find("#IMGLIST_ARROW_RIGHT").click(function(e) {
              if((parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').css('width'))+parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').position().left)) > 1524){
                imglistObj.find("#IMG_LIST_IMAGE_BOARD").animate({left:"-=1390px"}, "slow", function(e){
                  if((parseInt(imglistObj.find("#IMG_LIST_IMAGE_BOARD").css("width"))+parseInt(imglistObj.find("#IMG_LIST_IMAGE_BOARD").position().left)) > 100){
                    imglistObj.find("#IMGLIST_ARROW_LEFT").fadeIn("slow");
                  }
                  if((parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').css('width'))+parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').position().left)) < 1524){
                    imglistObj.find('#IMGLIST_ARROW_RIGHT').hide();
                  }
                });
              }
            });
            imglistObj.find("#IMGLIST_ARROW_LEFT").unbind();
            imglistObj.find("#IMGLIST_ARROW_LEFT").click(function(e) {
              if((parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').position().left) * -1) > 100){
                $(this).next().animate({left:'+=1390px'}, 'slow', function(e){
                  if((parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').position().left) * -1) < 100){
                    imglistObj.find('#IMGLIST_ARROW_LEFT').hide();
                  }
                  if((parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').css('width'))+parseInt(imglistObj.find('#IMG_LIST_IMAGE_BOARD').position().left)) > 1524){
                    imglistObj.find('#IMGLIST_ARROW_RIGHT').fadeIn('slow');
                  }
                });
              }
            });
          }
          
          // setAContent(formJQuery) 单一文本表单提交，formJQuery为文本表单字段的Form JQuery对象，该功能无法设置ordnung字段
          function setAContent(formJQuery){
            $.ajax({
              url: "wcp_svr.html",
              type: "POST",
              data: formJQuery.serializeArray(),
              dataType: "json",
              success: function(data) { 
                if(data.TYPE == 1){                    
                  alert(data.TEXT);
                  reloadPage();
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
          // setContentsGroup(formJQuery) 群组文本表单提交，formJQuery为文本表单字段的父JQuery对象，该功能无法设置ordnung、href字段
          function setContentsGroup(formJQuery){
            var formParameterJSON = "[";
            formJQuery.find("input").each(function(index, element) {
              formParameterJSON += '"' + $(this).attr("name") + '",';
            });
            formJQuery.find("textarea").each(function(index, element) {
              formParameterJSON += '"' + $(this).attr("name") + '",';
            });
            formJQuery.find("select").each(function(index, element) {
              formParameterJSON += '"' + $(this).attr("name") + '",';
            });
            formJQuery.parents("form").find("#CONTENTS_FORM_PARAMETER").val(formParameterJSON.substring(0, (formParameterJSON.length - 1)) + "]");
            $.ajax({
              url: "wcp_svr.html",
              type: "POST",
              data: formJQuery.parents("form").serializeArray(),
              dataType: "json",
              success: function(data) { 
                if(data.TYPE == 1){                    
                  alert(data.TEXT);
                  reloadPage();
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
          
          // setColumnPlugIn(formJQuery, plugInIndex)
          function setColumnPlugIn(formJQuery, plugInIndex){
            var plugInIndex = plugInIndex || 0;
            if(!formJQuery || !plugIns[plugInIndex]){
              return false;
            }
            var plugIn = plugIns[plugInIndex];
            formJQuery.html("");
            var plugInValues  = false;
            var plugInName = "";
            if($("#PLUGIN_FORM").find("input").eq(0).val()){
              for(var i = 0; i < composes.length; i++){
                if($("#PLUGIN_FORM").find("input").eq(0).val() == composes[i].id && composes[i].plugInIndex == plugInIndex){
                  plugInValues = eval(composes[i].json);
                  plugInName = composes[i].name;
                }
              }
            }            
            $("#PLUGIN_FORM").find("input").eq(1).val(plugInIndex);
            var label = '<div style="display:block; width:100%; height:40px;"><div style="display:block; text-align:left;"><span style="color:#35a6e7; font-size:12px; font-weight:bold;">插件名称</span> <span>自定义一个插件名称</span></div>';
            label += '<input type="text" name="name" value="';
            label += plugInName || "";
            label += '" placeholder="" style="width:100%; font-size:12px; padding:2px; border-radius:5px; border:1px solid #aaa; margin-top:4px; height:24px; padding-left:12px;"/>';
            label += '</div>';
            formJQuery.append(label);
            for(var i = 0; i < plugIn.column.length; i++){
              label = '<div style="display:block; width:100%; height:40px; margin-top:16px;">';
              label += '<div style="display:block; text-align:left;">';
              label += '<span style="color:#35a6e7; font-size:12px; font-weight:bold;">' + plugIn.column[i] + ':</span> <span style="font-size:11px;">' + plugIn.columnDescript[i] + '</span></div>';
              if(plugIn.column[i] == "richText"){
                label += '<div id="richText" style="display:inline-block; width:100%; height:180px; font-size:12px;">';
                if(plugInValues){
                  label += decodeURIComponent(plugInValues[i]);
                }
                else{
                  label += plugIn.defaultValue[i];
                }
                label += '</div>';
                label += '<textarea id="text1" name="richText" style="width:0px; height:0px; visibility:hidden;"></textarea>';
                label += '</div>';
                formJQuery.append(label);
              }
              else{
                label += '<input type="text" name="' + plugIn.column[i] + '" value="" placeholder="" style="width:100%; font-size:12px; padding:2px; border-radius:5px; border:1px solid #aaa; margin-top:4px; height:24px; padding-left:12px;"/>';
                label += '</div>';
                formJQuery.append(label);
                if(plugInValues){
                  formJQuery.find("input:last").val(decodeURIComponent(plugInValues[i]));
                }
                else{
                  formJQuery.find("input:last").val(plugIn.defaultValue[i]);
                }
              }
              if(plugIn.column[i] == "richText"){
                var E = window.wangEditor;
                var editor = new E('#richText');
                editor.customConfig.menus = [
                  'head',  // 标题
                  'bold',  // 粗体
                  'fontSize',  // 字号
                  'fontName',  // 字体
                  'italic',  // 斜体
                  'underline',  // 下划线
                  'foreColor',  // 文字颜色
                  'link',  // 插入链接
                  'list',  // 列表
                  'justify',  // 对齐方式
                  'undo',  // 撤销
                  'redo'
                ];
                editor.customConfig.colors = [
                  '#000000',
                  '#eeece0',
                  '#1c487f',
                  '#4d80bf',
                  '#c24f4a',
                  '#8baa4a',
                  '#7b5ba1',
                  '#46acc8',
                  '#f9963b',
                  '#ffffff'
                ];
                editor.customConfig.fontNames = [
                  '宋体',
                  '微软雅黑',
                  'Arial',
                  'Tahoma',
                  'Verdana'
                ];
                var $text1 = $('#text1');
                editor.customConfig.onchange = function (html) {
                  // 监控变化，同步更新到 textarea
                  $text1.val(html)
                }
                editor.customConfig.pasteFilterStyle = true;
                editor.customConfig.pasteIgnoreImg = true;
                editor.create();
                // 初始化 textarea 的值
                $text1.val(editor.txt.html())
              }
            }        
          }          
          // loadPlugInListWidget() 载入表单浏览器控件
          function loadPlugInListWidget(plugInIndex){
            var plugInIndex = plugInIndex || 0;
            var pageIndex = Math.ceil((plugInIndex + 1) / 3) - 1;
            var imglistObj = $("#PLUGIN_DIALOG_LEFT_DIV");
            imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css("top", "0px");
            if(plugInIndex > -1){
              imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").find("img").css("box-shadow", "0px 3px 8px #888888");
              imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").find("img").eq(plugInIndex).css("box-shadow", "0px 3px 8px #FF0000");
              setColumnPlugIn($("#PLUGIN_DIALOG_RIGHT_DIV"), plugInIndex);
            }
            if(parseInt(imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").css("height")) > 620){
              if(pageIndex > 0){                
                imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").animate({top:"-=" + (pageIndex * 620) + "px"}, "fast", function(e){
                  imglistObj.find("#PLUGIN_UP").fadeIn("slow");
                  if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css('height'))+parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top)) > 720){                    
                    imglistObj.find('#PLUGIN_DOWN').fadeIn('slow');
                  }
                });                
              }
              else{
                imglistObj.find("#PLUGIN_DOWN").fadeIn("slow");
              }
            }            
            imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css("top", "0px");
            imglistObj.find('#PLUGIN_UP').hide();
            imglistObj.find("#PLUGIN_DOWN").unbind();
            imglistObj.find("#PLUGIN_DOWN").click(function(e) {
              if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css('height'))+parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top)) > 720){
                imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").animate({top:"-=620px"}, "slow", function(e){
                  if((parseInt(imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").css("height"))+parseInt(imglistObj.find("#PLUGIN_LIST_IMAGE_BOARD").position().top)) > 100){
                    imglistObj.find("#PLUGIN_UP").fadeIn("slow");
                  }
                  if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css('height'))+parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top)) < 720){
                    imglistObj.find('#PLUGIN_DOWN').hide();
                  }
                });
              }
            });
            imglistObj.find("#PLUGIN_UP").unbind();
            imglistObj.find("#PLUGIN_UP").click(function(e) {
              if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top) * -1) > 100){
                imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').animate({top:'+=620px'}, 'slow', function(e){
                  if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top) * -1) < 100){
                    imglistObj.find('#PLUGIN_UP').hide();
                  }
                  if((parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').css('height'))+parseInt(imglistObj.find('#PLUGIN_LIST_IMAGE_BOARD').position().top)) > 720){
                    imglistObj.find('#PLUGIN_DOWN').fadeIn('slow');
                  }
                });
              }
            });
          }
          
          // setCompose(formJQuery, baseData, bannerPath, pictures, plugIns)
          function setCompose(backgroundColor, bannerPath, pictures, plugIns, plugInID){
            var backgroundColor = backgroundColor || "#FFFFFF";
            var bannerPath = bannerPath || false;
            var pictures = pictures || false;
            var plugIns = plugIns || false;
            var ordnung = -1;
            if(!document.getElementById("COMPOSE_DIALOG_DIV")){
              return false;
            }
            var board = $("#COMPOSE_PREVIEW_BOARD_DIV");
            board.html("");
            var form = $("#COMPOSE_FORM");
            form.find("input").eq(0).val(plugInID);
            board.css("background-color", backgroundColor);
            var htmlStr = '';
            if(bannerPath){
              if(values && values.showBanner && values.showBanner == 1){
                htmlStr = '<section style="margin:0px; padding:0px;"><div style="width:100%; display:inline-block; margin:0px; padding:0px;"><img src="' + bannerPath + '" style="width:100%;"/></div></section>';
              }
            }            
            board.append(htmlStr);
            if(pictures){
              for(var i = 0; i < pictures.length; i++){
                if(plugIns){
                  for(var j = 0; j < plugIns.length; j++){
                    if(plugIns[j].ordnung > 0 && plugIns[j].ordnung == pictures[i].ordnung){                      
                      if(plugIns[j].id == plugInID){
                        ordnung = plugIns[j].ordnung;
                      }
                      $.ajax({
                        url: "wcp_svr.html",
                        type: "POST",
                        data: {"id":plugIns[j].id, "action":"load_plugin", "plugInIndex":plugIns[j].plugInIndex},
                        dataType: "json",
                        success: function(data) { 
                          if(data.TYPE != 1){
                            console.log(data.TEXT);
                          }
                          else{
                            htmlStr = '<section style="margin:0px; padding:0px;">' + data.DATA.HTML + '</section>';
                            board.find("section").each(function(){
                              if($(this).attr("data-ordnung") == data.DATA.ORDNUNG){
                                console.log(data.DATA);
                                $(this).before(htmlStr);
                              }
                            });
                          }
                        },
                        error: function(data) { 
	                      console.log("网络错误，请重试，如果仍无法解决请联系管理员。");
                        },
                      });
                    }
                  }
                }
                if(ordnung == pictures[i].ordnung){
                  htmlStr = '<section class="compose_checked" data-ordnung=' + pictures[i].ordnung + ' onClick="if($(this).attr(\'class\') == \'compose_block\'){$(this).parents(\'form\').find(\'input\').eq(1).val($(this).attr(\'data-ordnung\'));var lastChecked = $(this).parent().find(\'.compose_checked\');lastChecked.removeClass(\'compose_checked\');lastChecked.addClass(\'compose_block\');$(this).removeClass(\'compose_block\');$(this).addClass(\'compose_checked\')}else{$(this).parents(\'form\').find(\'input\').eq(1).val(-1);$(this).removeClass(\'compose_checked\');$(this).addClass(\'compose_block\');}" style="margin:0px; padding:0px;"><div style="width:100%; display:inline-block; margin:0px; padding:0px;"><img src="' + pictures[i].folderName + '/' + pictures[i].fileName + '" style="width:100%;"/></div></section>';
                }
                else{
                  htmlStr = '<section class="compose_block" data-ordnung=' + pictures[i].ordnung + ' onClick="if($(this).attr(\'class\') == \'compose_block\'){$(this).parents(\'form\').find(\'input\').eq(1).val($(this).attr(\'data-ordnung\'));var lastChecked = $(this).parent().find(\'.compose_checked\');lastChecked.removeClass(\'compose_checked\');lastChecked.addClass(\'compose_block\');$(this).removeClass(\'compose_block\');$(this).addClass(\'compose_checked\')}else{$(this).parents(\'form\').find(\'input\').eq(1).val(-1);$(this).removeClass(\'compose_checked\');$(this).addClass(\'compose_block\');}" style="margin:0px; padding:0px;"><div style="width:100%; display:inline-block; margin:0px; padding:0px;"><img src="' + pictures[i].folderName + '/' + pictures[i].fileName + '" style="width:100%;"/></div></section>';
                }
                board.append(htmlStr);
              }
            }
            if(plugIns){
              for(var i = 0; i < plugIns.length; i++){
                if(plugIns[i].ordnung == -1 && plugIns[i].type != "dialog" &&  plugIns[i].type != "bar"){
                  $.ajax({
                    url: "wcp_svr.html",
                    type: "POST",
                    data: {"id":plugIns[i].id, "action":"load_plugin", "plugInIndex":plugIns[i].plugInIndex},
                    dataType: "json",
                    success: function(data) { 
                      if(data.TYPE != 1){
                        console.log(data.TEXT);
                      }
                      else{
                        htmlStr = '<section style="margin:0px; padding:0px;">' + data.DATA.HTML + '</section>';
                        board.append(htmlStr);
                      }
                    },
                    error: function(data) { 
	                  console.log("网络错误，请重试，如果仍无法解决请联系管理员。");
                    },
                  });
                }
              }
            }
            form.find("#COMPOSE_SUBMIT_BUTTON").click(function(e) { 
              $.ajax({
                url: "wcp_svr.html",
                type: "POST",
                data: $(this).parents("form").serializeArray(),
                dataType: "json",
                success: function(data) { 
                  if(data.TYPE != 1){
                    console.log(data.TEXT);
                  }
                  else{
                    alert(data.TEXT);
                    reloadPage();
                  }
                },
                error: function(data) { 
	              alert("网络错误，请重试，如果仍无法解决请联系管理员。");
                },
              });
            });
            dialogCompose.show();
          }
          //-->
          </script>