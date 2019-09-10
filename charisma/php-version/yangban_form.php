<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('yangbanID'=>_POST("yangbanID"),'type'=>_POST("type"),'title'=>_POST("title"),'etitle'=>_POST("etitle"),'desc'=>_POST("desc"),'price'=>_POST("price"),'priceList'=>rawurlencode(_POST("priceList")),'pic'=>_POST("pic"),'pictitle'=>_POST("pictitle"),'piclist'=>_POST("piclist"),'pic'=>_POST("pic"),'pic1'=>_POST("pic1"),'pic2'=>_POST("pic2"),'pic3'=>_POST("pic3"),'pic4'=>_POST("pic4"),'pic5'=>_POST("pic5"),'pic6'=>_POST("pic6"),'label1'=>_POST("label1"),'label2'=>_POST("label2"),'label3'=>_POST("label3"),'label4'=>_POST("label4"),'label5'=>_POST("label5"),'label6'=>_POST("label6"),'status'=>"ok",'time'=>time());
	if($id){
		$query = $db->QueryInsUp('yangban',$params," `id`='$id' ");
		echo "";
	}else{
		$query = $db->QueryInsUp('yangban',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `yangban` WHERE `id` = '$id'");
$yangbanID=isset($dbData['yangbanID']) ? $dbData['yangbanID'] : null;
$title=isset($dbData['title']) ? $dbData['title'] : null;
$pictitle=isset($dbData['pictitle']) ? $dbData['pictitle'] : null;
$priceList=isset($dbData['priceList']) ? $dbData['priceList'] : null;
$etitle=isset($dbData['etitle']) ? $dbData['etitle'] : null;
$desc=isset($dbData['desc']) ? $dbData['desc'] : null;
$type=isset($dbData['type']) ? $dbData['type'] : null;
$price=isset($dbData['price']) ? $dbData['price'] : null;
$pic=isset($dbData['pic']) ? $dbData['pic'] : null;
$piclist=isset($dbData['piclist']) ? $dbData['piclist'] : null;
$pic1=isset($dbData['pic1']) ? $dbData['pic1'] : null;
$pic2=isset($dbData['pic2']) ? $dbData['pic2'] : null;
$pic3=isset($dbData['pic3']) ? $dbData['pic3'] : null;
$pic4=isset($dbData['pic4']) ? $dbData['pic4'] : null;
$pic5=isset($dbData['pic5']) ? $dbData['pic5'] : null;
$pic6=isset($dbData['pic6']) ? $dbData['pic6'] : null;
$label1=isset($dbData['label1']) ? $dbData['label1'] : null;
$label2=isset($dbData['label2']) ? $dbData['label2'] : null;
$label3=isset($dbData['label3']) ? $dbData['label3'] : null;
$label4=isset($dbData['label4']) ? $dbData['label4'] : null;
$label5=isset($dbData['label5']) ? $dbData['label5'] : null;
$label6=isset($dbData['label6']) ? $dbData['label6'] : null;
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
                        <label>样板间编号</label>
                        <input type="text" class="form-control" name="yangbanID" value="<?=$yangbanID?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>风格</label>
                        <select name="type" id="type" style="min-width: 150px;min-height:35px;">
                          <option  value="1" <?php if($type==1){ ?> selected="selected"<?php } ?>>现代风格</option>
                          <option  value="2" <?php if($type==2){ ?> selected="selected"<?php } ?>>美式风格</option>
                          <option  value="3" <?php if($type==3){ ?> selected="selected"<?php } ?>>新中式风格</option>
                          <option  value="4" <?php if($type==4){ ?> selected="selected"<?php } ?>>欧式风格</option>
						  <option  value="5" <?php if($type==5){ ?> selected="selected"<?php } ?>>私人定制</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>英文标题</label>
                        <input type="text" class="form-control" name="etitle" value="<?=$etitle?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>简介</label>
                        <input type="text" class="form-control" name="desc" value="<?=$desc?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>价格</label>
                        <input type="text" class="form-control" name="price" value="<?=$price?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>价格列表</label>
                        <textarea type="text" class="form-control" name="priceList" value="<?=$priceList?>" placeholder="请输入"><?=rawurldecode($priceList)?></textarea>
                    </div>
                    <div class="form-group">
                        <label>封面图片</label><?=AjaxUploadFile("pic","$pic")?>
                    </div>
                    <div class="form-group">
                        <label>封面标题图片</label><?=AjaxUploadFile("pictitle","$pictitle")?>
                    </div>
                    <div class="form-group">
                        <label>展示列表</label><?=AjaxUploadFile("piclist","$piclist",true)?>
                    </div>
                    <div class="form-group">
                        <label>客厅图片列表</label><?=AjaxUploadFile("pic1","$pic1",true)?>
                    </div>
                    <div class="form-group">
                        <label>客厅项目</label>
                        <input type="text" class="form-control" name="label1"value="<?=$label1?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>主卧图片列表</label><?=AjaxUploadFile("pic2","$pic2",true)?>
                    </div>
                    <div class="form-group">
                        <label>主卧项目</label>
                        <input type="text" class="form-control" name="label2" value="<?=$label2?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>次卧图片列表</label><?=AjaxUploadFile("pic3","$pic3",true)?>
                    </div>
                    <div class="form-group">
                        <label>次卧项目</label>
                        <input type="text" class="form-control" name="label3" value="<?=$label3?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>餐厅图片列表</label><?=AjaxUploadFile("pic4","$pic4",true)?>
                    </div>
                    <div class="form-group">
                        <label>餐厅项目</label>
                        <input type="text" class="form-control" name="label4" value="<?=$label4?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>厨房图片列表</label><?=AjaxUploadFile("pic5","$pic5",true)?>
                    </div>
                    <div class="form-group">
                        <label>厨房项目</label>
                        <input type="text" class="form-control" name="label5" value="<?=$label5?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>卫生间图片列表</label><?=AjaxUploadFile("pic6","$pic6",true)?>
                    </div>
                    <div class="form-group">
                        <label>卫生间项目</label>
                        <input type="text" class="form-control" name="label6" value="<?=$label6?>" placeholder="请输入">
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

