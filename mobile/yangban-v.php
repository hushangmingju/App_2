<?php
require_once('top1.inc');

if (!isset($_GET['id']) || !DAS::isExistedInDB("`tb_wcp_showrooms`", "`status` > 0 AND `id` = " . $_GET['id'])) {
    echo '<script type="text/javascript">window.location.href="styles.html"</script>';
}
$showroom = new Query("t1.*, t2.name AS shopName", "`tb_wcp_showrooms` AS t1", "LEFT JOIN `tb_wcp_shops` AS t2 ON t1.shop = t2.id", "t1.`id` = " . $_GET['id']);
$showroom = DAS::quickQuery($showroom);
$showroom = $showroom['data'][0];

$pictures = new Query("*", "`tb_wcp_images`", "", "`pageID` = -2 AND `status` = 1 AND `showroomNum` = " . $showroom['number'] . " AND `showroomShop` = " . $showroom['shop'], 'ordnung');
$pictures = DAS::quickQuery($pictures);
$pictures = DAS::hasData($pictures) ? $pictures['data'] : false;

$shops = new Query("*", "`tb_wcp_shops`", "", "`status` > 0", "`ordnung`, `id`");
$shops = DAS::quickQuery($shops);
$shops = DAS::hasData($shops) ? $shops['data'] : false;

$cover = false;
$livingPics = array();
$diningPics = array();
$kitchenPics = array();
$bathroomPics = array();
$masterPics = array();
$guestPics = array();
if ($pictures) {    
    foreach ($pictures as $picture) {
        switch ($picture['component']) {
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'cover':
                $cover = $picture;
                $cover['path'] = $cover['folderName'] . '/' . $cover['fileName'];
                $cover['suffix'] = strtoupper(substr($cover['fileName'], strrpos($cover['fileName'], '.')));
                $cover['size'] = round(filesize('../../images/showrooms/' . $showroom['number'] . '_' . $showroom['shop'] . '/' . $cover['fileName']) / 1024, 2) . 'KB';
                $cover['dimen'] = getimagesize($cover['path']);
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'living':
                $livingPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'dining':
                $diningPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'kitchen':
                $kitchenPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'bathroom':
                $bathroomPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'master':
                $masterPics[] = $picture;
                break;
            case 'sr_' . $showroom['number'] . '_' . $showroom['shop'] . '_' . 'guest':
                $guestPics[] = $picture;
                break;
        }        
    }                                
}
?>
<style>
nav{
  position:absolute; 
  bottom:0; 
  width:100%; 
  z-index: 500; 
  text-align: center;
}
nav.pagination{
  margin: 0px;
}
nav.pagination .swiper-pagination-bullet{margin: 0 4px; height: 8px; width: 8px; background-color:#b8ae9d; border: 2px solid #fff; opacity: 1;}
nav.pagination .swiper-pagination-bullet.swiper-pagination-bullet-active{background-color: #ff6c00;}
</style>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:91%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>; text-align:left;">
        <h3 style="border-bottom:2px solid #fe4b5b; display:inline-block; padding:5px 0px 5px 0px;">
          <?php echo $showroom['name'] . '&nbsp;&nbsp;' . $showroom['ename'];?>
          <span style="font-size:smaller; font-weight:100;">（<?php echo $showroom['shopName'];?>）</span>
        </h3>
        <!-- VR 图标1 -->
        <?php
        if ($showroom['kujiale']) {
        ?>
        <a href="<?php echo $showroom['kujiale'];?>"><img src="../images/icons/vr_logo1.png" style="width:32px;"/></a>      
        <?php
        }
        ?>
      </div>
    </section>
    <section style="margin:0px; padding:0px; text-align:center; width:100%;">
      <div style="width:91%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>; text-align:left;">
        <?php echo $showroom['content'];?>
      </div>
    </section>
    <section class="section_banner" style="margin:0px; padding:0px; text-align:center; width:100%; margin-top:10px;">
      <div style="width:91%; display:inline-block; margin:0px; padding:0px; max-width:<?php echo $maxWidth;?>;">
        <!-- VR 图标2 -->
        <?php
        if ($showroom['kujiale']) {
        ?>
        <a href="<?php echo $showroom['kujiale'];?>">
          <img src="../images/icons/vr_logo2.png" style="position:absolute; width:40%; margin-left:25%; margin-top:15%;"/>
          <img class="topImg"  src="<?php echo $cover['path'];?>" alt="" style="width:100%;"> 
        </a>
        <?php
        }
        else {
        ?>
        <img class="topImg"  src="<?php echo $cover['path'];?>" alt="" style="width:100%;"> 
        <?php
        }
        ?>
      </div>
    </section>
    <?php
    if (count($livingPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">客厅</h4>
        <div class="living" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($livingPics as $livingPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $livingPic['folderName'] . '/' . $livingPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var livingSwiper = new Swiper (".living .swiper-container", {
	  pagination: '.living .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    if (count($diningPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">餐厅</h4>
        <div class="dining" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($diningPics as $diningPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $diningPic['folderName'] . '/' . $diningPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var diningSwiper = new Swiper (".dining .swiper-container", {
	  pagination: '.dining .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    if (count($kitchenPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">厨房</h4>
        <div class="kitchen" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($kitchenPics as $kitchenPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $kitchenPic['folderName'] . '/' . $kitchenPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var kitchenSwiper = new Swiper (".kitchen .swiper-container", {
	  pagination: '.kitchen .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    if (count($bathroomPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">卫生间</h4>
        <div class="bathroom" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($bathroomPics as $bathroomPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $bathroomPic['folderName'] . '/' . $bathroomPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var bathroomSwiper = new Swiper (".bathroom .swiper-container", {
	  pagination: '.bathroom .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    if (count($masterPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">主卧</h4>
        <div class="master" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($masterPics as $masterPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $masterPic['folderName'] . '/' . $masterPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var bathroomSwiper = new Swiper (".master .swiper-container", {
	  pagination: '.master .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    if (count($guestPics) > 0) {
    ?>
    <section style="text-align:center;">
      <div style="width:91%; display:inline-block; max-width:<?php echo $maxWidth;?>;">
        <h4 style="display:inline-block; border-bottom:2px solid #fe4b5b;; padding:5px 0px 5px 0px;">次卧</h4>
        <div class="guest" style="display:block; height:auto;">
		  <div class="swiper-container">
			<div class="swiper-wrapper">
			<?php
            foreach ($guestPics as $guestPic) {
            ?>
              <div class="swiper-slide">
				<img class="topImg" src="<?php echo $guestPic['folderName'] . '/' . $guestPic['fileName'];?>" class="img-full"/>
			  </div>
            <?php
            }
            ?>                
			</div>
		  </div>
          <nav class="pagination" style="top:-32px; position:relative; z-index:25;"></nav>
		</div>
      </div>
    </section>
    <script type="text/javascript" language="javascript">
    <!--//
	var bathroomSwiper = new Swiper (".guest .swiper-container", {
	  pagination: '.guest .pagination', // 如果需要分页器
	  autoplayDisableOnInteraction : false, //用户操作分页器后不停止
	  paginationClickable: true, //分页器可点击
	  speed:500,
	  autoplay:6000,
	});
    //-->
	</script>
    <?php
    }
    ?>
<?php
require_once('bottom1.inc');
?>