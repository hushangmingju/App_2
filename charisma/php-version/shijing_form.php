<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('type'=>_POST("type"),'title'=>_POST("title"),'desc'=>_POST("desc"),'yonghu'=>_POST("yonghu"),'pingjia'=>_POST("pingjia"),'pic'=>_POST("pic"),'pic1'=>_POST("pic1"),'pic2'=>_POST("pic2"),'pic3'=>_POST("pic3"),'pic4'=>_POST("pic4"),'pic5'=>_POST("pic5"),'pic6'=>_POST("pic6"),'status'=>"ok",'time'=>time());
	if($id){
		$query = $db->QueryInsUp('shijing',$params," `id`='$id' ");
		echo "";
	}else{
		$query = $db->QueryInsUp('shijing',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `shijing` WHERE `id` = '$id'");
$title=isset($dbData['title']) ? $dbData['title'] : null;
$desc=isset($dbData['desc']) ? $dbData['desc'] : null;
$type=isset($dbData['type']) ? $dbData['type'] : null;
$yonghu=isset($dbData['yonghu']) ? $dbData['yonghu'] : null;
$pingjia=isset($dbData['pingjia']) ? $dbData['pingjia'] : null;
$pic=isset($dbData['pic']) ? $dbData['pic'] : null;
$pic1=isset($dbData['pic1']) ? $dbData['pic1'] : null;
$pic2=isset($dbData['pic2']) ? $dbData['pic2'] : null;
$pic3=isset($dbData['pic3']) ? $dbData['pic3'] : null;
$pic4=isset($dbData['pic4']) ? $dbData['pic4'] : null;
$pic5=isset($dbData['pic5']) ? $dbData['pic5'] : null;
$pic6=isset($dbData['pic6']) ? $dbData['pic6'] : null;
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
                        <label>风格</label>
                        <select name="type" id="type" style="min-width: 150px;min-height:35px;">
                          <option  value="1" <?php if($type==1){ ?> selected="selected"<?php } ?>>现代风格</option>
                          <option  value="2" <?php if($type==2){ ?> selected="selected"<?php } ?>>美式风格</option>
                          <option  value="3" <?php if($type==3){ ?> selected="selected"<?php } ?>>新中式风格</option>
                          <option  value="4" <?php if($type==4){ ?> selected="selected"<?php } ?>>欧式风格</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>说明</label>
                        <input type="text" class="form-control" name="desc" value="<?=$desc?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>用户</label>
                        <input type="text" class="form-control" name="yonghu" value="<?=$yonghu?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>评价</label>
                        <input type="text" class="form-control" name="pingjia" value="<?=$pingjia?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>封面图片</label><?=AjaxUploadFile("pic","$pic")?>
                    </div>
                    <div class="form-group">
                        <label>客厅图片</label><?=AjaxUploadFile("pic1","$pic1")?>
                    </div>
                    <div class="form-group">
                        <label>主卧图片</label><?=AjaxUploadFile("pic2","$pic2")?>
                    </div>
                    <div class="form-group">
                        <label>次卧图片</label><?=AjaxUploadFile("pic3","$pic3")?>
                    </div>
                    <div class="form-group">
                        <label>餐厅图片</label><?=AjaxUploadFile("pic4","$pic4")?>
                    </div>
                    <div class="form-group">
                        <label>厨房图片</label><?=AjaxUploadFile("pic5","$pic5")?>
                    </div>
                    <div class="form-group">
                        <label>卫生间图片</label><?=AjaxUploadFile("pic6","$pic6")?>
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

