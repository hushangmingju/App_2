<?php
//require_once('base.php');
require_once('init.inc');
function LogStatus($key="_key_") {if($key=="_key_"){if(empty($_SESSION['admin'])){return false;}else{return $_SESSION['admin'];}}elseif($key=="unset"){unset($_SESSION['admin']);}else{$_SESSION['admin'] = $key;}}

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
$week = array("日","一","二","三","四","五","六");
$sitesArr = new Query("DISTINCT `siteCname`, `folder`", "`tb_vcs_pages`", "", "`siteCname` IS NOT NULL");
$sitesArr = DAS::quickQuery($sitesArr);

function listPageIndex($numOfPages, $numOfIndex, $getValName){    
    if (!isset($numOfPages) || intval($numOfPages) < 1){
        return false;
    }
    $numOfPages = intval($numOfPages);
    $numOfIndex = isset($numOfIndex) && intval($numOfIndex) > 0 ? $numOfIndex : 10;
    $pageIndex = isset($_GET[$getValName]) && intval($_GET[$getValName]) > 0 ? $_GET[$getValName] : 1;
    $start = 0;
    $end = 0;
    if ($numOfPages <= $numOfIndex) {
        $start = 1;
        $end = $numOfPages;
        $type = 1;
    }
    else if (($pageIndex - 1) <= ceil($numOfIndex/2)) {
        $start = 1;
        $end = $numOfIndex;
        $type = 2;
    }
    else if ((($numOfPages - $pageIndex) + 1) <= ceil($numOfIndex/2)) {
        $start = $numOfPages - $numOfIndex;
        $end = $numOfPages;
        $type = 3;
    }
    else {
        $start = $pageIndex - ceil($numOfIndex/2);
        $end = $start + $numOfIndex - 1;
        $type = 4;
    }
    if ($type == 3 || $type == 4) {
        echo '<a href="' . urlModify(array($getValName => 1)) . '">&laquo;</a>&nbsp;&nbsp;';
        echo '<a href="' . urlModify(array($getValName => ($start - 1))) . '">&lt;</a>&nbsp;&nbsp;';
    }
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $pageIndex) {
            echo $i . '&nbsp;&nbsp;';
        }
        else {
            echo '<a href="' . urlModify(array($getValName => $i)) . '">' . $i . '</a>&nbsp;&nbsp;';
        }
    }
    
    if ($type == 2 || $type == 4) {
        echo '<a href="' . urlModify(array($getValName => ($end + 1))) . '">&gt;</a>&nbsp;&nbsp;';
        echo '<a href="' . urlModify(array($getValName => $numOfPages)) . '">&raquo;</a>&nbsp;&nbsp;';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>网站统计数据中心</title>
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
    <script language="javascript" src="../../js/jquery-2.1.4.min.js"></script>
    <script language="javascript" src="../../js/echarts.common.min.js"></script>
    <script language="javascript" type="text/javascript">
    <!--//
	function upClick(id){
        document.getElementById(id).click();
    }
    //-->
    </script>
    <style>
    .form-control{max-width:700px;}
    </style>
  </head>
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
                        <li class="nav-header">网站统计数据中心</li>
                        <li><a href="vcs_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 数据汇总</span></a></li>
                        <li class="accordion">
                          <a href="vcs_hit_list.html"><i class="glyphicon glyphicon-plus"></i><span> 点击数据</span></a>
                          <ul class="nav nav-pills nav-stacked" style="display: none;">
                            <li><a href="vcs_hit_list.html?site=all"><i class="glyphicon glyphicon-globe"></i><span> 全部数据</span></a></li>
                            <li><a href="vcs_hit_list.html?site=main"><i class="glyphicon glyphicon-globe"></i><span> 官网数据</span></a></li>
                            <li><a href="vcs_hit_list.html?site=root"><i class="glyphicon glyphicon-globe"></i><span> 电脑端数据</span></a></li>
                            <li><a href="vcs_hit_list.html?site=mobile"><i class="glyphicon glyphicon-globe"></i><span> 移动端数据</span></a></li>
                            <li class="accordion">
                              <a><i class="glyphicon glyphicon-plus"></i><span> 推广站数据</span></a>
                              <?php
                              if (DAS::hasData($sitesArr)){
                                  $sitesArray = $sitesArr['data'];
                                  echo '<ul class="nav nav-pills nav-stacked" style="display: none;">';                                
                                  foreach($sitesArray as $siteInfo){
                                      if ($siteInfo['folder'] != 'root' && $siteInfo['folder'] != 'mobile') {
                                          echo '<li><a href="vcs_hit_list.html?site=' . rawurlencode($siteInfo['folder']) . '"><i class="glyphicon glyphicon-globe"></i><span> ' . $siteInfo['siteCname'] . ' [' . $siteInfo['folder'] . ']</span></a></li>';
                                      }
                                  }
                                  echo '</ul>';
                              }
                              ?>                              
                            </li>
                            <li><a href="vcs_hit_map.html"><i class="glyphicon glyphicon-globe"></i><span> 地理分布图</span></a></li>
                          </ul>
                        </li>
                        <li class="accordion">
                          <a><i class="glyphicon glyphicon-plus"></i><span> 访客数据</span></a>
                          <ul class="nav nav-pills nav-stacked" style="display: none;">
                            <li><a href="vcs_gid_list.html?site=all"><i class="glyphicon glyphicon-globe"></i><span> 全部访客</span></a></li>
                            <li><a href="vcs_gid_list.html?site=main"><i class="glyphicon glyphicon-globe"></i><span> 官网访客</span></a></li>
                            <li><a href="vcs_gid_list.html?site=root"><i class="glyphicon glyphicon-globe"></i><span> 电脑端访客</span></a></li>
                            <li><a href="vcs_gid_list.html?site=mobile"><i class="glyphicon glyphicon-globe"></i><span> 移动端访客</span></a></li>
                            <li class="accordion">
                              <a><i class="glyphicon glyphicon-plus"></i><span> 推广站访客</span></a>
                              <?php
                              if (DAS::hasData($sitesArr)){
                                  $sitesArray = $sitesArr['data'];
                                  echo '<ul class="nav nav-pills nav-stacked" style="display: none;">';                                
                                  foreach($sitesArray as $siteInfo){
                                      if ($siteInfo['folder'] != 'root' && $siteInfo['folder'] != 'mobile') {
                                          echo '<li><a href="vcs_gid_list.html?site=' . rawurlencode($siteInfo['folder']) . '"><i class="glyphicon glyphicon-globe"></i><span> ' . $siteInfo['siteCname'] . ' [' . $siteInfo['folder'] . ']</span></a></li>';
                                      }
                                  }
                                  echo '</ul>';
                              }
                              ?>
                            </li>
                          </ul>
                        </li>
                        <!--<li><a href="vcs_page_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 页面数据</span></a></li>-->
                        <!--<li><a href="vcs_reserve_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 预约数据</span></a></li>-->
                        <!--<li><a href="vcs_spider_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 爬虫数据</span></a></li>-->
                        <!--<li><a href="vcs_redirect_list.html"><i class="glyphicon glyphicon-align-justify"></i><span> 跳转数据</span></a></li>-->                                    
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->

