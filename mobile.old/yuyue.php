<?php
require_once('top.inc');
$kd = kd(38);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css" />
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
    <?php require_once('head_codes.inc');?>
  </head>
	<body>
    <?php require_once('body_top.inc');?>
		<div class="menu-mask"></div>

		<!--内容-->
		<div class="mybody">

			<div class="contact row">
				
				<div class="title">
					<img src="images/title_yuyue.png"/>
					<h2>请留下以下信息，工作人员会尽快联系你</h2>
				</div>
				
				<div class="content">
					<form id="yuyue">
						
						<?php
						if(isset($_GET["sid"]) && $_GET["sid"]){
						?>
						<input type="hidden" name="type" value="yangban">
            <input type="hidden" name="bultin" value="mobile/yuyue_yangban">
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
						<input type="hidden" value="<?php echo $_GET["sid"];?>" name="sid">
						<?php
						}else{
							if(isset($_GET["s"]) && $_GET["s"]){
						?>
						<input type="hidden" value="calc" name="type">
            <input type="hidden" name="bultin" value="mobile/yuyue_calc">
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
						<input type="hidden" value="<?php echo (isset($_GET["s"]) && $_GET["s"] ? $_GET["s"] : null);?>" name="calc-style">
						<input type="hidden" value="<?php echo (isset($_GET["p"]) && $_GET["p"] ? $_GET["p"] : null);?>" name="calc-price">
						<input type="hidden" value="<?php echo (isset($_GET["a"]) && $_GET["a"] ? $_GET["a"] : null);?>" name="calc-area">
						<input type="hidden" value="<?php echo (isset($_GET["t"]) && $_GET["t"] ? $_GET["t"] : null);?>" name="calc-total">
						<?php
							}else{
						?>
						<input type="hidden" name="type" value="yuyue">
            <input type="hidden" name="bultin" value="mobile/yuyue_yuyue">
            <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
						<?php
							}
						}
						?>
						<div class="myinput"><input type="text" name="name" id="name" value="" placeholder="您的姓名" /></div>
						<div class="myinput"><input type="text" name="tel" id="tel" value="" placeholder="您的电话" /></div>
						<div class="myinput"><input type="text" name="area" id="area" value="" placeholder="建筑面积" /></div>
						<div class="myinput"><textarea name="content" rows="content" cols=""  placeholder="其余备注" ></textarea></div>
						<div class="mybtn"><a class="btn message-send1" id="yuyuebutton">确认提交</a></div>
					</form>
					<script>
					$(document).ready(function() {
						$("#yuyuebutton").click(function(){
							var $name = $('#name').val();
							var $mobile = $('#tel').val();
							var $area = $('#area').val();
							if($name == ""){
								alert('请填写您的姓名');
								return false;
							}else if($area==""){
								alert('请填写建筑面积');
								return false;
							}else if($mobile==""){
								alert('手机号不能为空');
								return false;
							}else if(!$mobile.match(/^(((1[0-9]{2})|159|153)+\d{8})$/)){
								alert("手机号码格式不正确！");
								return false;
							};
							
							
							$.ajax({
								type: 'POST',
								url: "../yuyuesave.php",
								data: $("#yuyue").serializeArray(),
								dataType: "json",
								success: function(data) { 
									alert(data.TEXT);
								},
								error: function(data) { 
									alert("信息提交成功！");
								},
							});
							return false;
						});
					});
					</script>






					<div class="clear"></div>
				</div>
				
				
				<div class="clear"></div>
			</div>
      <?php require_once('body_bottom.inc');?>
      <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>