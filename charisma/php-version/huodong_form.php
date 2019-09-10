<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$params = array('value1'=>_POST("title"),'value3'=>_POST("url"),'value2'=>_POST("pic"),'text1'=>_POST("text"));
	$query = $db->QueryInsUp('keys',$params," `key`='huodong' ");
	echo "编辑成功";
}else{


$dbData = $db->QueryData("SELECT * FROM `keys` WHERE `key`='huodong' ");
$title=isset($dbData['value1']) ? $dbData['value1'] : null;
$pic=isset($dbData['value2']) ? $dbData['value2'] : null;
$url=isset($dbData['value3']) ? $dbData['value3'] : null;
$text=isset($dbData['text1']) ? $dbData['text1'] : null;
	
	
 ?>
 
		<link rel="stylesheet" href="./kind/themes/default/default.css" />
		<script src="./kind/kindeditor-all-min.js"></script>
		<script charset="utf-8" src="./kind/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="text"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : true,
					uploadJson : './uploader/upload_json.php',
					filterMode: false,
					items : [
						'source', '|', 'undo', 'redo', '|', 'preview', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
						'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
						'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
						'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
						'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 
						'table', 'hr', 'emoticons', 'baidumap', 'pagebreak','anchor', 'link', 'unlink']
				});
			});
			
		</script>
 
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
                        <label>链接</label>
                        <input type="text" class="form-control" name="url" value="<?=$url?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>封面图片</label><?=AjaxUploadFile("pic","$pic")?>
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea class="form-control" id="content" name="text" style="width:700px;height:350px;visibility:hidden;"><?=$text?></textarea>
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

