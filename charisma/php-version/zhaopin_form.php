<?php
require_once('init.inc');
function _POST($n) { return isset($_POST[$n]) ? $_POST[$n] : NULL; }
function _GET($n) { return isset($_GET[$n]) ? $_GET[$n] : NULL; }
function _VAR($n,$var) { return isset($n[$var]) ? $n[$var] : NULL; }
function pre($res) {echo "<pre>";print_r($res);echo "</pre>";}
function LogStatus(){
    if (!isset($_SESSION['cms']) || !isset($_SESSION['cms']['userID']) || !$_SESSION['cms']['userID']){
        return false;
    }
    else{
        return $_SESSION['cms'];
    }
}
if (LogStatus()){
    header('Content-Type: text/html; charset=utf-8');
}
else{
    Header("HTTP/1.1 301 Moved Permanently");
	Header("Location: ./zhaopin.html");
	exit();
}

$id = '';
$post = '';
$number = '';
$location = '';
$contents = '';

if (isset($_GET['id']) && intval($_GET['id']) && DAS::isExistedInDB("`tb_mingju_jobs`", "`id` = " . intval($_GET['id']))){
    $action = 'update_job';
    $job = new Query("*", "`tb_mingju_jobs`", "", "`id` = " . intval($_GET['id']));
    $job = DAS::quickQuery($job);
    $id = intval($_GET['id']);
    $post = $job['data'][0]['post'];
    $number = $job['data'][0]['number'];
    $location = $job['data'][0]['location'];
    $contents = $job['data'][0]['contents'];
}
else{
    $action = 'insert_job';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>管理中心 - 招聘信息管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
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
    <link rel="stylesheet" href="./kind/themes/default/default.css" />
  </head>
    <!-- jQuery -->
  <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
  <script src="./kind/kindeditor-all-min.js"></script>
  <script charset="utf-8" src="./kind/lang/zh_CN.js"></script>
  <body> <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">
      <div class="navbar-inner">
        <a class="navbar-brand">管理中心</a>          
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
                <li class="nav-header">管理中心</li>
                <li><a href="zhaopin.html"><i class="glyphicon glyphicon-align-justify"></i><span> 招聘信息列表</span></a></li>                                    
              </ul>                    
            </div>
          </div>
        </div>
        <!-- left menu ends -->
        <div id="content" class="col-lg-5 col-sm-5">
          <div>
            <ul class="breadcrumb">
              <li>
                <a href="#">编辑</a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well" data-original-title="">
                  <h2><i class="glyphicon glyphicon-edit"></i> 编辑</h2>
                </div>
                <div class="box-content">
                  <form id="ZHAOPIN_FORM_01_FORM" role="form" action="" method="post">
                    <input type="hidden" name="action" value="<?php echo $action;?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="form-group">
                      <label>招聘岗位</label>
                      <input type="text" class="form-control" name="post" value="<?php echo rawurldecode($post);?>" placeholder="请输入" style="max-width: 700px;">
                    </div>                    
                    <div class="form-group">
                      <label>人数</label>
                      <input type="text" class="form-control" name="number" value="<?php echo rawurldecode($number);?>" placeholder="请输入" style="max-width: 700px;">
                    </div>                    
                    <div class="form-group">
                      <label>工作地点</label>
                      <input type="text" class="form-control" name="location" value="<?php echo rawurldecode($location);?>" placeholder="请输入" style="max-width: 700px;">
                    </div>
                    <div class="form-group">
                      <label>招聘详情</label>
                      <textarea class="form-control" id="contents" name="contents" style="width:700px;height:350px;visibility:hidden;"><?php echo rawurldecode($contents);?></textarea>
                    </div>
                    <button id="ZHAOPIN_FORM_01_BUTTON" type="submit" class="btn btn-default">提交</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>  
      <footer class="row">
      </footer>
    </div> 
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
var editor;
KindEditor.ready(function(K) {
    editor = K.create("#contents", {
	    resizeType : 1,
		allowPreviewEmoticons : false,
		allowImageUpload : false,
		filterMode: false,
		items : [
		    'source', '|', 'undo', 'redo', '|', 'preview', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 
			'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink'
        ]
	});
});

$("#ZHAOPIN_FORM_01_BUTTON").click(function(){
    editor.sync();
    $.ajax({
        type: 'POST',
        url: "dml_svr.html",
        data: $("#ZHAOPIN_FORM_01_FORM").serializeArray(),
        dataType: "json",
        success: function(data) { 
            alert(data.TEXT);
        },
        error: function(data) { 
		    alert("网络错误，请重试，如果仍无法解决请联系管理员。");
        },
    });
	return false;
});
//-->
</script>
