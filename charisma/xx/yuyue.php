<?php
include(dirname(__FILE__).'/base.php');
?>
<?php $vvc=3; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>快速预约——一站式整体家装服务</title>
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>

	</head>
	<body>
		<?php include 'top.php';?>
		<?php $nban='images/ban_yuyue.jpg'; ?>
	
		<div class="content" >
		  
           		<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			     <div class="mainc " >
				 
				      <div class="caleft">
					   
					      <div class="lxft">
						     <ul>
							    <li><div class="tu"><img src="images/lxt1.png"></div><div class="wz">地址<br>上海市闵行区颛兴东路1280弄5号楼</div></li>
							    <li>
							    	<div class="tu"><img src="images/lxt2.png"></div>
							    	<div class="wz">二维码<br>点击扫一扫微信公众号</div>
							    	<span class="scancode transition"><img src="images/scancode.png"></span>
							    </li>
							    <li><div class="tu"><img src="images/lxt3.png"></div><div class="wz">电话<br>021-33888832</div></li>
							 </ul>
							 <div class="clear"></div>
						  </div>
						  
						  <div>
						      <div class="lxvtit p-tb-10"><img src="images/yutit.png"></div>
							  <div class="lxvwz">为了量身定制你的最爱STYLY，请留下以下信息，工作人员会尽快联系你</div>
						  </div>
						  
						  <form action="" method="post" id="yuyue">
						       <?php
						       if(_GET("sid")){
						       ?>
						       <input type="hidden" value="yangban" name="type">
										 <input type="hidden" value="<?=_GET("sid")?>" name="sid">
						       <?php
						       }else{
						       
						       
										 if(_GET("s")){
										 ?>
										 <input type="hidden" value="calc" name="type">
										 <input type="hidden" value="<?=_GET("s")?>" name="calc-style">
										 <input type="hidden" value="<?=_GET("p")?>" name="calc-price">
										 <input type="hidden" value="<?=_GET("a")?>" name="calc-area">
										 <input type="hidden" value="<?=_GET("t")?>" name="calc-total">
										 <?php
										 }else{
										 ?>
										 <input type="hidden" value="yuyue" name="type">
										 <?php
										 }
						       }
						       ?>
						       <div class="lytt">
							     <ul>
								   <li><input type="text" value="" name="name" placeholder="您的姓名"></li>
								   <li><input type="text" value="" name="tel" placeholder="您的电话"></li>
								   <li style="float:right;margin-right:0px"><input type="text" value="<?=_GET("a")?>" name="area" placeholder="建筑面积"></li>
								 </ul>
								 <div class="clear"></div>
							   </div>
							   <div ><textarea name="content" class="lyarc" placeholder="其余备注" ></textarea></div>
							   <div class="lysutj"><input type="button" id="yuyuebutton" value="确认提交" class="lysubcc"></div>
					      </form>
					   
					   <script>
		$("#yuyuebutton").click(function(){
			//alert($("#yuyue").serialize());
			
$.ajax({
  type: 'POST',
  url: "yuyuesave.php",
  data: $("#yuyue").serializeArray(),
  dataType: "json",
  success: function(data) { 
   alert(""+data.msg);
  },
  error: function(data) { 
		alert("网络错误，请重试。");
  },
});
			
			
			
			return false;
		});
					   </script>
					   
					   
					   
					   
					   
					  </div>
					  <div class="caright">
					     <?php include 'lxright.php';?>
					  </div>
					  <div class="clear"></div>
				 
				 
				 </div>
			           
				   
				   
			
		</div>
		
		<?php include 'end.php';?>

	</body>
	
	
	
</html>

		