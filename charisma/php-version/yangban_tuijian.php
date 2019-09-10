<?php require('header.php'); ?>
<?php 
	$id = _GET("id") ? intval(_GET("id")) : null;
	$tuijian = _GET("tuijian") ? intval(_GET("tuijian")) : 0;
	$query = $db->QueryInsUp('yangban',array('tuijian'=>$tuijian)," `id`='$id' ");
	echo "操作成功";
?>
<?php require('footer.php'); ?>

