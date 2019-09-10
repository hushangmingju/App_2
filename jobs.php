<?php
require_once('top.inc');
$kd = kd(14);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
$jobs = new Query("id, post, userID, location, number, contents, DATE(timestamp) as date", "tb_mingju_jobs", "", "status = 'ok'");
$jobs = DAS::quickQuery($jobs);
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 招聘信息——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <style>
        /*诚聘英才*/
        #rect_content{ padding:55px 0 0 0;}
        /*人才招聘*/
        #job_title{ height:40px; line-height:40px; background-color: #323232; padding:0 30px;}
        #job_title h3{ float:left; height:40px; line-height:40px; font-weight:normal; font-size:15px; color:#FFF;}
        .h3_left{ text-align:left; width:166px;}
        .h3_center{ width:203px; text-align:center;}
        .h3_right{ width:149px; text-align:right;}
        .job_top{ height:40px; line-height:40px; padding:0 30px; cursor:pointer;  border-bottom:1px solid #c6c6c6;}
        .job_top h3{ float:left; height:40px; line-height:40px; font-weight:normal; font-size:13px; color:#3e3e3e;}
        .job_description{ padding:20px; display:none; background:#f8f8f8; border-bottom:1px solid #c6c6c6;}
        .send_email{ margin:20px 0;}
        </style>
	</head>
	<script type="text/javascript" src="js/jquery.pack.js"></script>
	<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
	<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <?php require_once('head_codes.inc');?>

	<body>
		<?php require_once('body_top.inc');?>
		<?php $nban='images/ban_jobs.jpg'; ?>
        <div>
			<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>
			<div class="mainc">			
                <div id="rect_list">
			        <div id="job_list">
						<div id="job_title">
							<h3 class="h3_left">招聘岗位</h3>
							<h3 class="h3_center">人数</h3>
							<h3 class="h3_center">工作地点</h3>
							<h3 class="h3_right">发布时间</h3>
							<div class="float_clear"></div>
						 </div>
                         <?php
                         if (DAS::hasData($jobs)){
                             foreach ($jobs['data'] as $job){
                                 echo '<div class="job_meg" id="' . $job['id'] . '">';
                                 echo '<div class="job_top">';
                                 echo '<h3 class="h3_left">' . rawurldecode($job['post']) . '</h3>';
                                 echo '<h3 class="h3_center">' . rawurldecode($job['number']) . '</h3>';
                                 echo '<h3 class="h3_center">' . rawurldecode($job['location']) . '</h3>';
                                 echo '<h3 class="h3_right">' . date($job['date']) . '</h3>';
                                 echo '</div>';
                                 echo '<div class="float_clear"></div>';
                                 echo '<div class="job_description">';
                                 echo rawurldecode($job['contents']);
                                 echo '</div>';
                                 echo '<div class="float_clear"></div>';
                                 echo '</div>';
                                 
                             }
                         }
                         ?>
					</div>
                </div>
			</div>
		</div>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>

	</body>

</html>

<script>
	<!--
	function setTab(name, cursel, n) {
		for (i = 1; i <= n; i++) {
			var menu = document.getElementById(name + i);
			var con = document.getElementById("con_" + name + "_" + i);
			menu.className = i == cursel ? "hover" : "";
			con.style.display = i == cursel ? "block" : "none";
		}
	}
	//-->
$(function(){
	$(".job_meg").click(function(){
		   var id=$(this).attr("id");
		   $(".job_meg").each(function(){
			      var did=$(this).attr("id");
				  if(did==id){
					  $("#"+did+" .job_description").slideToggle(300);
					  $("#"+did+" .job_top").css("background","#e5e5e5");
				  }else{
					  $("#"+did+" .job_description").slideUp(300);
					  $("#"+did+" .job_top").css("background","none");
				  }
			});
	});
});
	$(document).ready(function() {

		var tabArr = $(".tabs li");
		$(".tabs li").css("width", (100 / tabArr.length) + "%");
	});
</script>
<?php require_once('bottom.inc');?>