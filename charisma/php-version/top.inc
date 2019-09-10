<?php
require_once('init.inc');
function LogStatus($key="_key_") {
    if($key=="_key_"){
        if(empty($_SESSION['admin'])){
            return false;
        }
        else {
            return $_SESSION['admin'];
        }
    }
    elseif($key=="unset") {
        unset($_SESSION['admin']);
    }
    else {
        $_SESSION['admin'] = $key;
    }
}
if (!isset($no_visible_elements) || !$no_visible_elements) {
	if(LogStatus()){
		header('Content-Type: text/html; charset=utf-8');
	}else{
		Header("HTTP/1.1 301 Moved Permanently");
		Header("Location: ./login.html");
		exit();
	}
	$username = LogStatus();
}
function _POST($n){
    return isset($_POST[$n]) ? $_POST[$n] : NULL;
}
function _GET($n) {
    return isset($_GET[$n]) ? $_GET[$n] : NULL;
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>管理中心</title>
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

    <!-- jQuery -->
    <!--script src="bower_components/jquery/jquery.min.js"></script-->
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/2.0.3/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="./uploader/ajaxfileupload.js"></script>

<script>
	function upClick(id){document.getElementById(id).click();}
	function ajaxFileUpload(fileElementId,inputEleId,list)
	{
		$("#loading"+inputEleId)
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		fileObjName=fileElementId; //'fileToUpload'
		$.ajaxFileUpload({
				url:'./uploader/doajaxfileupload.php', //fileObj
				secureuri:false,
				fileElementId:fileElementId,
				dataType: 'json',
				data:{FileObjName:fileElementId},
				success: function (data, status){
					if(typeof(data.error) != 'undefined'){
						if(data.error != "0" ){
							alert(data.msg);
							if(list =="piclist"){
								$("#"+inputEleId).val(data.pic+"|"+$("#"+inputEleId).val());
							}else{
								$("#"+inputEleId).val(data.pic);
							}
						}else{
							alert(data.msg);
						}
					}
				},
				error: function (data, status, e){
					alert(e);
				}
			}
		)
		return false;
	}
    // void reloadPage(void)
function reloadPage(){
	var rpHref = window.location.href;
	var rpSharpIndex = rpHref.indexOf("#");
	if(rpSharpIndex > 0){
	  rpHref = rpHref.substring(0, rpSharpIndex);
	}
	window.open(rpHref,"_self");
}
</script>
<?php

function AjaxUploadFile($name=null,$pic=null,$x=null){
?>
                        <?php
                        $picId = "pic".mt_rand(100000,999999);
                        ?>
                        <input type="text" class="form-control" name="<?=$name?>" id="<?=$picId?>" value="<?=$pic?>" placeholder="请选择图片">
                        <input type="button" value="选择图片上传..." onclick="upClick('file<?=$picId?>')" style="cursor:pointer;" />
                        <span id="loading<?=$picId?>" style="display:none">图片上传中...</span>
                        <input type="file" id="file<?=$picId?>" name="file<?=$picId?>" style="display:none" onchange="ajaxFileUpload('file<?=$picId?>','<?=$picId?>'<?php if($x){echo ",'piclist'";} ?>);" />
<?php
}

?>

<style>
.form-control{max-width:700px;}
</style>

</head>

<body>
<?php //if (!isset($no_visible_elements) || !$no_visible_elements) { ?>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <a class="navbar-brand" href="index.html">管理中心</a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right" style="display:none">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> admin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="login.html">Logout</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->



        </div>
    </div>
    <!-- topbar ends -->
<?php //} ?>
<div class="ch-container">
    <div class="row">
        <?php //if (!isset($no_visible_elements) || !$no_visible_elements) { ?>

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">管理中心</li>
                        <li><a href="news_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 新闻列表</span></a></li>
                        <li><a href="3d_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 3D列表</span></a></li>
                        <li><a href="huodong_form.html"><i class="glyphicon glyphicon-align-justify"></i><span> 优惠活动</span></a></li>
                        <li><a href="shipin_form.html"><i class="glyphicon glyphicon-align-justify"></i><span> 首页视频</span></a></li>
                        <li><a href="tuijian_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 业主推荐</span></a></li>
                        
                        
                        
                        <!--<li><a href="shijing_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 案例列表</span></a></li>-->
                        <li><a href="yangban_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 实景列表</span></a></li>
                        <li><a href="gongyi_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 整体工艺</span></a></li>
                        <li><a href="reserve_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 预约列表</span></a></li>
                        <li><a href="reserve_liuyan_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 联系我们</span></a></li>
                        <li><a href="wenda_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 问答列表</span></a></li>
                        <li><a href="banner_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 首页图片</span></a></li>
                        <li><a href="kd_form.html"><i class="glyphicon glyphicon-align-justify"></i><span> Keyword</span></a></li>
                        <li><a href="user_form.html"><i class="glyphicon glyphicon-align-justify"></i><span> 资料修改</span></a></li>
                        <li><a href="reserve_expo_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 展会预约</span></a></li>
                        <li><a href="reserve_lotto_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 抽奖活动</span></a></li>
                        <li class="accordion">
                          <a style="cursor:pointer;"><i class="glyphicon glyphicon-plus"></i><span> 漳州预约</span></a>
                          <ul class="nav nav-pills nav-stacked">
                            <li><a href="reserve_zz_main_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 漳州官网</span></a></li>
                            <li><a href="reserve_zz_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 漳州推广</span></a></li>
                          </ul>
                        </li>
                        <li><a href="wcp_root.html"><i class="glyphicon glyphicon-align-justify"></i><span> 页面编辑</span></a></li>
                        <li><a href="vcs_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 页面统计</span></a></li>
                                    
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <?php //} ?>
