<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('mod'=>'gongyi','tag'=>_POST("tag"),'a'=>_POST("a"),'q'=>_POST("q"),'status'=>"ok",'time'=>time());
	if($id){
		$query = $db->QueryInsUp('wenda',$params," `id`='$id' ");
		echo "";
	}else{
		$query = $db->QueryInsUp('wenda',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `wenda` WHERE `id` = '$id'");
$q=isset($dbData['q']) ? $dbData['q'] : null;
$a=isset($dbData['a']) ? $dbData['a'] : null;
$tag=isset($dbData['tag']) ? $dbData['tag'] : null;
	
	
	
	
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
                        <input type="text" class="form-control" name="q" value="<?=$q?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>标签</label>
                        <input type="text" class="form-control" id="tag" name="tag" value="<?=$tag?>" placeholder="多个标签请以空格隔开">
                        请选择：
                        <a onclick="$('#tag').val($('#tag').val()+' '+$(this).text())">无异味</a> 
                        <a onclick="$('#tag').val($('#tag').val()+' '+$(this).text())">效率高</a> 
                        <a onclick="$('#tag').val($('#tag').val()+' '+$(this).text())">很喜欢</a> 
                        <a onclick="$('#tag').val($('#tag').val()+' '+$(this).text())">高品质</a> |
                        <a onclick="$('#tag').val('')">清空标签</a> 
                    </div>
                    <div class="form-group">
                        <label>内容</label><br>
                        <textarea name="a" placeholder="请输入" style="width:700px;height:350px;"><?=$a?></textarea>
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

