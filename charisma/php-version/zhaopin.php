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
if (_POST("user")){
	$user = _POST("user") ? addslashes(_POST("user")) : null;
	$pass = _POST("user") ? md5(_POST("pwd")) : null;
	$userID = DAS::isExistedInDB("`user`", "`user` = '" . $user . "' AND `pass` = '" . $pass . "'", "`id`");

	if($userID){
		$_SESSION['cms']['userID'] = $userID;
        $_SESSION['cms']['username'] = $user;
	}else{
		unset($_SESSION['cms']);
	}
}
$jobs = new Query("*", "`tb_mingju_jobs`", "", "`status` = 'ok'");
$jobs = DAS::quickQuery($jobs);
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
  </head>
    <!-- jQuery -->
  <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
  <body>
    <?php
      if(!LogStatus()){
    ?>
    <div class="row">
      <div class="col-md-12 center login-header">
        <h2>登录</h2>
      </div>
    </div>
    <div class="row">
      <div class="well col-md-5 center login-box">
        <div class="alert alert-info">请输入账号密码</div>
        <form class="form-horizontal" action="" method="post">
          <fieldset>
            <div class="input-group input-group-lg">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
              <input type="text" class="form-control" name="user" placeholder="账号">
            </div>
            <div class="clearfix"></div><br/>
            <div class="input-group input-group-lg">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
              <input type="password" class="form-control" name="pwd" placeholder="密码" />
            </div>
            <div class="clearfix"></div>
            <p class="center col-md-5">
              <button type="submit" class="btn btn-primary">登录</button>
            </p>
          </fieldset>
        </form>
      </div>
    </div>
    <?php
      }
      else{
    ?>
    <!-- topbar starts -->
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
        <div id="content" class="col-lg-10 col-sm-10">
          <div class="row">
            <div class="box col-md-12">
              <div class="box-inner">
                <div class="box-header well" data-original-title="">
                  <h2><i class="glyphicon glyphicon-user"></i> 招聘信息列表</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="zhaopin_form.html">添加</a>
                </div>
                <div class="box-content">
                  <table class="table table-striped table-bordered responsive">
                    <thead>
                      <tr>
                        <th>招聘岗位</th>
                        <th>人数</th>
                        <th>工作地</th>
                        <th>发布时间</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                      if (DAS::hasData($jobs)){
                          foreach ($jobs['data'] as $job){
                              echo '<tr>';                              
                              echo '<td>' . rawurldecode($job['post']) . '</td>';                              
                              echo '<td>' . rawurldecode($job['number']) . '</td>';                              
                              echo '<td>' . rawurldecode($job['location']) . '</td>';                              
                              echo '<td>' . $job['timestamp'] . '</td>';
                              echo '<td class="center">';
                              echo '<a class="btn btn-success" onclick="showContents(' . $job['id'] . ');"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>&nbsp;';
                              echo '<a class="btn btn-info" href="zhaopin_form.html?id=' . $job['id'] . '"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>&nbsp;';
                              echo '<a class="btn btn-danger" onclick="deleteJob(' . $job['id'] . ')"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                              echo '</td>';
                              echo '</tr>';
                              echo '<tr id="ZHAOPIN_CONTENTS_TR_' . $job['id'] . '" class="contentslist" style="display:none;">'; 
                              echo '<td colspan=5>' . rawurldecode($job['contents']) . '<a style="float:right" onclick="this.parentNode.parentNode.style.display=\'none\';">&raquo;收起</a></td>';
                              echo '</tr>';
                          }
                      }
                    ?> 
                    </tbody>
                  </table>
                  <style>
                  .xpage{display:inline;white-space: nowrap;}
                  .xpage li{margin:3px;display:inline-block;list-style-type:none;}
                  </style>
                  <ul class="xpage"></ul>                    
                </div>
              </div>
            </div>        
          </div>
        </div>
      </div>
      <footer class="row">
      </footer>
    </div> 
    <?php
      }
    ?>   
  </body>
</html>
<script language="javascript" type="text/javascript">
<!--//
function showContents(id){   
    if (document.getElementById("ZHAOPIN_CONTENTS_TR_" + id)){
        for(var i = 0; i < document.getElementsByClassName("contentslist").length; i++){
            document.getElementsByClassName("contentslist")[i].style.display = "none";
        }
        document.getElementById("ZHAOPIN_CONTENTS_TR_" + id).style.display = "";
    }
}
function deleteJob(id){
    $.ajax({
        type: 'POST',
        url: "dml_svr.html",
        data: {"action": "delete_job", "id": id},
        dataType: "json",
        success: function(data) { 
            alert(data.TEXT);
        },
        error: function(data) { 
		    alert("网络错误，请重试，如果仍无法解决请联系管理员。");
        },
    });
	return false;
}
//-->
</script>