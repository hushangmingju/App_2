<?php $vvc=5; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>联系我们——一站式整体家装服务</title>
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
		<?php $nban='images/ban_contact.jpg'; ?>
	
		<div class="content" >
		  
           		<div class="nban" style="background:url(<?php echo $nban ;?>) center no-repeat"></div>

			     <div class="mainc mainph" >
				 
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
						      <div class="lxvtit p-tb-10"><img src="images/lytit.png"></div>
							  <div class="lxvwz">感谢您对本站的关心，如有疑问和建议请直接联系我们~</div>
						  </div>
						  
						  <form action="" method="post" >
						       <div class="lytt">
							     <ul>
								   <li><input type="text" value="" name="linkname" placeholder="您的姓名"></li>
								   <li><input type="text" value="" name="telephone" placeholder="您的电话"></li>
								   <li style="float:right;margin-right:0px"><input type="text" value="" name="newsname" placeholder="标题"></li>
								 </ul>
								 <div class="clear"></div>
							   </div>
							   <div ><textarea name="content" class="lyarc" placeholder="其余备注" ></textarea></div>
							   <div class="lysutj"><input type="submit" name="submit"  value="确认提交" class="lysubcc"></div>
					      </form>
					   
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

		