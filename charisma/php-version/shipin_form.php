<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$params = array('value1'=>_POST("title"),'value2'=>_POST("url"));
	$query = $db->QueryInsUp('keys',$params," `key`='shipin' ");
	echo "编辑成功";
}else{


$dbData = $db->QueryData("SELECT * FROM `keys` WHERE `key`='shipin' ");
$title=isset($dbData['value1']) ? $dbData['value1'] : null;
$url=isset($dbData['value2']) ? $dbData['value2'] : null;
	
	
	
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
                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>视频链接</label>
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

