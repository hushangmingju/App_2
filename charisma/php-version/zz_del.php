<?php require('header.php'); ?>
<?php 
	$id = _GET("id") ? intval(_GET("id")) : null;
	$query = $db->QueryInsUp('tb_zz_yuyue',array('status'=>"del")," `id`='$id' ");
	echo "删除成功";
?>
<?php require('footer.php'); ?>

