<?php
require_once('top.inc');
$jid=isset($_GET['jid']) && intval($_GET['jid']) ? intval($_GET['jid']) : 1;
$kd = kd(9);
$kd_k = $kd["k"];
$kd_d = $kd["d"];
?>
	<head>
		<meta charset="utf-8" />
		<title>沪尚茗居 家装6.0时代——一站式整体家装服务</title>
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
		<div class="content">
             
			       <div class="mainc">
			              <div class="jg6tit p-tb-10"><img src="images/title_01d.png"></div>
				   
							<div id="Tab8">	
								   <div class="Menubox8">
										 <ul>
											 <li id="jobc1" onClick="setTab('jobc',1,8)"  <?php if($jid==1){echo "class='hover'";} ?>><span class="icon bg-red"><img src="images/icon_01.png"/></span></li>
											 <li id="jobc2" onClick="setTab('jobc',2,8)"  <?php if($jid==2){echo "class='hover'";} ?>><span class="icon bg-pink"><img src="images/icon_02.png"/></span></li>
											 <li id="jobc3" onClick="setTab('jobc',3,8)"  <?php if($jid==3){echo "class='hover'";} ?>><span class="icon bg-purple"><img src="images/icon_03.png"/></span></li>
											 <li id="jobc4" onClick="setTab('jobc',4,8)"  <?php if($jid==4){echo "class='hover'";} ?>><span class="icon bg-indigo"><img src="images/icon_04.png"/></span></li>
											 <li id="jobc5" onClick="setTab('jobc',5,8)"  <?php if($jid==5){echo "class='hover'";} ?>><span class="icon bg-blue"><img src="images/icon_05.png"/></span></li>
											 <li id="jobc6" onClick="setTab('jobc',6,8)"  <?php if($jid==6){echo "class='hover'";} ?>><span class="icon bg-green"><img src="images/icon_06.png"/></span></li>
											 <li id="jobc7" onClick="setTab('jobc',7,8)"  <?php if($jid==7){echo "class='hover'";} ?>><span class="icon bg-orange"><img src="images/icon_07.png"/></span></li>
											 <li id="jobc8" onClick="setTab('jobc',8,8)"  <?php if($jid==8){echo "class='hover'";} ?>><span class="icon bg-crimson"><img src="images/icon_08.png"/></span></li>
										 </ul>
								   </div>
							</div> 				   
						   
							<div id="con_jobc_1"  <?php if($jid==1){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz1a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys1">01.实景样板间，1：1呈现</div>
											<div class="wz2">
											  沪尚茗居拥有68套不同风格、不同价位的实景样板间，从中式到西式，从简约到奢华，满足了不同人群的不同需求，完美实现1:1实景复制。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_2"   <?php if($jid==2){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz2a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys2">02.集团化采购</div>
											<div class="wz2">
											  沪尚茗居与百余个一线大品牌建立常年合作。所有产品全部以集团统一采购形式直接从工厂批量进货，节省大额装修成本，直供消费者，价格至少比普通装修公司节省30%。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_3"   <?php if($jid==3){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz3a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys3">03.家装全包，不用您费心</div>
											<div class="wz2">
											  “全包式”套餐，大到家具家电，小到马桶刷都为客户配齐，在为客户省钱的同时，也省去了客户自己选购、比价的时间。同时，沪尚茗居采用的是新的计费方式：一房一价，预算=决算，装修过程中绝不再让消费者多花一分钱。选择沪尚茗居，真正实现拎包入住。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_4"  <?php if($jid==4){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz4a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys4">04.无增项加价，让您更放心</div>
											<div class="wz2">
											  装修花销不再无底洞！一房一价附上套餐配置单，明码标价不增项，绝不再加一分钱。可能你遇到过传统家装黑幕，可能你遭遇过家装过程逐渐加价，但在沪尚茗居绝对不会有，真正让您超省心。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_5"   <?php if($jid==5){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz5a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys5">05.自由选择，您温暖的家</div>
											<div class="wz2">
											  沪尚家装尊重所有消费者的个人喜好，提供了多种不同品牌的产品，可以根据消费者的特定需求任意调换、删减，在保证装修风格协调统一的前提下，打造出属于您的温馨之家！
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_6"   <?php if($jid==6){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz6a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys6">06.绿色环保，让您更安心</div>
											<div class="wz2">
											  选材料是装修的关键一步，材料选的好，装修工程才能算是完美。沪尚茗居通过整合供应链，与百余家知名品牌厂家直接建立合作，精选满足国家环保要求的产品。合理的价格，环保的产品，让您与您的家人享受安全健康的居住环境。辅材有美国联想接线端子、德国的欧松板、环保无碳的石膏板、水电行业领军品牌伟星管线、多乐士安心家乳胶漆等知名品牌产品。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_7"    <?php if($jid==7){echo "class='hover'";}else{echo "style='display:none'";} ?>  >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz7a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys7">07.规范施工，全程质保</div>
											<div class="wz2">
											  沪尚茗居独有家装白皮书，108项施工规范将家装量化到每一个细节。一道工序结束后，必须由客户和质检人员共同确认达到白皮书施工标准后，才能进行下一道工序的施工。如发现不合格项目，必须砸掉重做，费用由沪尚茗居承担。
											</div>
										</div>
										<div class="clear"></div>
									</div>
								
								
							</div>
							<div id="con_jobc_8"    <?php if($jid==8){echo "class='hover'";}else{echo "style='display:none'";} ?> >
							
									<div class="jgncon">
										<div class="jgs1"><img src="images/jz8a.jpg"></div>
										<div class="jgs2">
											<div class="wz1 ys8">08.星级保修，售后无忧</div>
											<div class="wz2">
											  沪尚茗居有着超五星级售后服务，并承诺客户：基础装修保修2年，内部水电隐蔽工程保修10年，防水工程保修5年，终身维护服务。接听来电后24小时内上门解除客户的后顾之忧。
											</div>
										</div>
										<div class="clear"></div>
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
function setTab(name,cursel,n){
for(i=1;i<=n;i++){
  var menu=document.getElementById(name+i);
  var con=document.getElementById("con_"+name+"_"+i);
  menu.className=i==cursel?"hover":"";
  con.style.display=i==cursel?"block":"none";
}
}
//-->
</script>
<?php require_once('bottom.inc');?>