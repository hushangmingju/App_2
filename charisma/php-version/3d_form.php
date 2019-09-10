<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('title'=>_POST("title"),'url'=>_POST("url"),'pic'=>_POST("pic"),'status'=>"ok",'time'=>time());
	if($id){
		$query = $db->QueryInsUp('x3d',$params," `id`='$id' ");
		echo "";
	}else{
		$query = $db->QueryInsUp('x3d',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `x3d` WHERE `id` = '$id'");
$title=isset($dbData['title']) ? $dbData['title'] : null;
$url=isset($dbData['url']) ? $dbData['url'] : null;
$pic=isset($dbData['pic']) ? $dbData['pic'] : null;
 ?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">编辑</a>
        </li>
    </ul>
</div>


<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> 编辑</h2>
            </div>
            <div class="box-content">
                <form role="form" action="" method="post">
                    <input type="hidden" value="post" name="post">
                    <input type="hidden" value="<?=$id?>" name="id">

                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>跳转网址</label>
                        <input type="text" class="form-control" name="url" value="<?=$url?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>封面图片</label><?=AjaxUploadFile("pic","$pic")?>
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

