<?php
require_once('top.inc');
$region = VCS::getRegionByIP();
if (strpos($region['prov'], '福建') !== false) {
    echo '<script language="javascript" type="text/javascript">window.location="zz.php"</script>';
}

$dbData = new Query("*", "`keys`", "", "`key`='huodong'");
$dbData = DAS::quickQuery($dbData);

$title = DAS::hasData($dbData) && $dbData['data'][0]['value1'] ? $dbData['data'][0]['value1'] . ' ' : null;
$pic = DAS::hasData($dbData) && $dbData['data'][0]['value2'] ? $dbData['data'][0]['value2'] : null;
$url = DAS::hasData($dbData) && $dbData['data'][0]['value3'] ? $dbData['data'][0]['value3'] : null;
$text = DAS::hasData($dbData) && $dbData['data'][0]['text1'] ? $dbData['data'][0]['text1'] : null;
$kd = kd(6);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title;?>沪尚茗居 优惠活动——一站式整体家装服务</title>
		<meta name="keywords" content="<?=$kd_k?>" />
		<meta name="description" content="<?=$kd_d?>" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="css/swiper.3.1.2.min.css"/>
		<link rel="stylesheet" type="text/css" href="css/site.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/jquery.pack.js"></script>
		<script type="text/javascript" src="js/jQuery.blockUI.js"></script>
		<script type="text/javascript" src="js/jquery.SuperSlide.js"></script>
        <script type="text/javascript" language="javascript">
        console.log("<?php $region = VCS::getRegionByIP(); echo $region['prov'];?>");
        </script>
    <?php require_once('head_codes.inc');?>
	</head>
	<body>
		<?php require_once('body_top.inc');?>				
		<div class="content" style="position: relative; overflow:hidden;">
			 
			 <a href="<?php echo $url;?>" target="_blank" class="block-center"><img class="img-full block-center" src="<?php echo $pic;?>"></a>
		</div>
		<div class="textinfo"><?php echo $text;?></div>
		<?php require_once('body_bottom.inc');?>
    <?php require_once('body_codes.inc');?>
	</body>
	
	<script>
		$("#hbtn").click(function(){
			
			if($('#hname').val()==""){
				alert('请填写您的姓名');
				return false;
			}else if($('#yyphone').val()==""){
				alert('请填写您的房屋面积');
				return false;
			}else if($('#yyphone').val()==""){
				alert('请填写您的地址');
				return false;
			}else if($('#yyarea').val()==""){
				alert('请填写您的电话');
				return false;
			};
			
			$.ajax({
			  type: 'POST',
			  url: "yuyuesave.php",
			  data: $("#hyuyue").serializeArray(),
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
	</script>
	
</html>
<?php require_once('bottom.inc');?>