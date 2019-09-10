<?php
require_once('top.inc');
$kd = kd(5);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 快速预约——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
    <?php require_once('head_codes.inc');?>
	</head>
	<body>
		<?php require_once('body_top.inc');?>
		<?php $nban='images/ban_yuyue.jpg'; ?>	
		<div class="content" >
      <div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>
			  <div class="mainc " >				 
				  <div class="caleft">					   
					  <div class="lxft">
						  <ul>
							  <li>
                  <div class="tu"><img src="images/lxt1.png"></div><div class="wz">地址<br>上海市闵行区颛兴东路1280弄5号楼</div>
                </li>
							  <li>
							   	<div class="tu"><img src="images/lxt2.png"></div>
							   	<div class="wz">二维码<br>点击扫一扫微信公众号</div>
							   	<span class="scancode transition"><img src="images/scancode.png"></span>
							  </li>
							  <li>
                  <div class="tu">
                    <img src="images/lxt3.png">
                  </div>
                  <div class="wz">电话<br>021-33888831 / 021-33888832</div>
                </li>
							</ul>
							<div class="clear"></div>
						</div>
						<div>
						  <div class="lxvtit p-tb-10"><img src="images/yutit.png"></div>
							<div class="lxvwz">为了量身定制你的最爱STYLY，请留下以下信息，工作人员会尽快联系你</div>
						</div>						  
						<form action="" method="post" id="yuyue">
						  <?php
						    if(isset($_GET['sid']) && $_GET['sid']){
						  ?>
						  <input type="hidden" name="type" value="yangban">
              <input type="hidden" name="bultin" value="yuyue_yangban">
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
							<input type="hidden" value="<?php echo $_GET['sid'] . '_new';?>" name="sid">
						  <?php
						    }
                else{
									if(isset($_GET['s']) && $_GET['s']){
							?>
							<input type="hidden" name="type" value="calc">
              <input type="hidden" name="bultin" value="yuyue_calc">
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
							<input type="hidden" value="<?php echo $_GET['s'];?>" name="calc-style">
							<input type="hidden" value="<?php echo (isset($_GET['p']) && $_GET['p']) ? $_GET['p'] : '';?>" name="calc-price">
							<input type="hidden" value="<?php echo (isset($_GET['a']) && $_GET['a']) ? $_GET['a'] : '';?>" name="calc-area">
							<input type="hidden" value="<?php echo (isset($_GET['t']) && $_GET['t']) ? $_GET['t'] : '';?>" name="calc-total">
							<?php
								  }
                  else{
							?>
							<input type="hidden" name="type" value="yuyue">
              <input type="hidden" name="bultin" value="yuyue_yuyue">
              <input type="hidden" name="phpSelf" value="<?php echo $_SERVER['PHP_SELF'];?>"/>
							<?php
								  }
						    }
						  ?>
						  <div class="lytt">
							<ul>
								<li>
                  <input type="text" value="" name="name" placeholder="您的姓名">
                </li>
								<li>
                  <input type="text" value="<?php echo (isset($_GET['mo']) && $_GET['mo']) ? $_GET['mo'] : '';?>" name="tel" placeholder="您的电话">
                </li>
								<li style="float:right;margin-right:0px">
                  <input type="text" value="<?php echo (isset($_GET['a']) && $_GET['a']) ? $_GET['a'] : '';?>" name="area" placeholder="建筑面积">
                </li>
						  </ul>
							<div class="clear"></div>
					  </div>
						<div>
              <textarea name="content" class="lyarc" placeholder="其余备注" ></textarea>
            </div>
						<div class="lysutj">
              <input type="button" id="yuyuebutton" value="确认提交" class="lysubcc">
            </div>
					</form>
					<script type="text/javascript" language="javascript">
          <!--//
		      $("#yuyuebutton").click(function(){
			    //alert($("#yuyue").serialize());
			
          $.ajax({
            type: 'POST',
            url: "yuyuesave.php",
            data: $("#yuyue").serializeArray(),
            dataType: "json",
            success: function(data) { 
              alert(data.TEXT);
            },
            error: function(data) { 
		          alert("网络错误，请重试。");
            },
            });
			      return false;
		      });
          //-->
					</script>
			  </div>
				<div class="caright">
				  <?php require_once('lxright.php');?>
				</div>
				<div class="clear"></div>
		  </div>
		</div>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>
</html>
<?php require_once('bottom.inc');?>
		