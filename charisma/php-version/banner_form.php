<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('pic'=>_POST("pic"),'url'=>_POST("url"),'status'=>"ok",'time'=>time());
	if($id){
		$query = $db->QueryInsUp('banner',$params," `id`='$id' ");
		echo "";
	}else{
    $params['agent'] = _POST("agent");
		$query = $db->QueryInsUp('banner',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;	
$agent = _GET('ag') ? intval(_GET("ag")) : null;	
$dbData = $db->QueryData("SELECT * FROM `banner` WHERE `id` = '$id'");
$url=isset($dbData['url']) ? $dbData['url'] : null;
$pic=isset($dbData['pic']) ? $dbData['pic'] : null;
	
	
	
	
 ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#"><?php echo $id ? '编辑': ($agent == 1 ? '添加电脑端首页图片' : '添加移动端首页图片');?></a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> <?php echo $id ? '编辑': ($agent == 1 ? '添加电脑端首页图片' : '添加移动端首页图片');?></h2>
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <input type="hidden" value="post" name="post">
                    <?php
                    if(!$id){
                        ?>
                        <input type="hidden" value="<?php echo $agent ? $agent : 1;?>" name="agent">
                        <?php
                    }
                    else{
                        ?>
                        <div class="form-group">
                        <label>用户端</label><br />
                        <select name="agent" class="form-control">
                          <option value="1" <?php echo $agent == 1 ? 'selected="selected"' : ''?>>电脑端</option>
                          <option value="2" <?php echo $agent == 2 ? 'selected="selected"' : ''?>>移动端</option>
                        </select>
                        </div>
                        <?php
                    }
                    ?>                    
                    <input type="hidden" value="<?=$id?>" name="id">
                    <div class="form-group">
                        <label>图片</label>
                        <?=AjaxUploadFile("pic","$pic")?>
                    </div>
                    <div class="form-group">
                        <label>跳转网址</label>
                        <input type="text" class="form-control" name="url" value="<?=$url?>" placeholder="请输入">
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>

            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
<?php
}
 ?>


<?php require('footer.php'); ?>

