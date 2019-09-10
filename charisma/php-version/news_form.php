<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('pic'=>_POST("pic"),'title'=>_POST("title"),'type'=>_POST("type"),'desc'=>_POST("desc"),'content'=>_POST("content"),'status'=>"ok",'newskey'=>_POST("newskey"),'newsdes'=>_POST("newsdes"),'time'=>time());
	if($id){
		$query = $db->QueryInsUp('news',$params," `id`='$id' ");
		echo "";
	}else{
		$query = $db->QueryInsUp('news',$params);
		echo "";
	}
	echo "编辑成功";
}else{


$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `news` WHERE `id` = '$id'");
$title=isset($dbData['title']) ? $dbData['title'] : null;
$pic=isset($dbData['pic']) ? $dbData['pic'] : null;
$desc=isset($dbData['desc']) ? $dbData['desc'] : null;
$type=isset($dbData['type']) ? $dbData['type'] : null;
$content=isset($dbData['content']) ? $dbData['content'] : null;
$newskey=isset($dbData['newskey']) ? $dbData['newskey'] : null;
$newsdes=isset($dbData['newsdes']) ? $dbData['newsdes'] : null;
 ?>
 
		<link rel="stylesheet" href="./kind/themes/default/default.css" />
		<script src="./kind/kindeditor-all-min.js"></script>
		<script charset="utf-8" src="./kind/lang/zh_CN.js"></script>
		<script>
			var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
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
			
//['source', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
//'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
//'insertunorderedlist', '|', 'emoticons', 'image', 'link']
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
                    <input type="hidden" value="<?=$id?>" name="id">
                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" name="title" value="<?=$title?>" placeholder="请输入" style="max-width: 700px;">
                    </div>
                    
                    <div class="form-group">
                        <label>keywords</label>
                        <input type="text" class="form-control" name="newskey" value="<?=$newskey?>" placeholder="请输入" style="max-width: 700px;">
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input type="text" class="form-control" name="newsdes" value="<?=$newsdes?>" placeholder="请输入" style="max-width: 700px;">
                    </div>
                    
                    <div class="form-group">
                        <label>分类</label>
                        <select name="type" id="type" style="min-width: 150px;min-height:35px;">
                          <option  value="1" <?php if($type==1){ ?> selected="selected"<?php } ?>>官方咨询</option>
                          <option  value="2" <?php if($type==2){ ?> selected="selected"<?php } ?>>活动分享</option>
                          <option  value="3" <?php if($type==3){ ?> selected="selected"<?php } ?>>其他</option>
                          <option  value="2" <?php if($type==4){ ?> selected="selected"<?php } ?>>装修知识</option>
                          <option  value="2" <?php if($type==5){ ?> selected="selected"<?php } ?>>装修案例</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>简介</label>
                        <input type="text" class="form-control" name="desc"  value="<?=$desc?>" placeholder="请输入" style="max-width: 700px;">
                    </div>
                    <div class="form-group">
                        <label>封面图</label>
                        <?=AjaxUploadFile("pic","$pic")?>
                    </div>
                    <div class="form-group">
                        <label>新闻内容</label>
                        <textarea class="form-control" id="content" name="content" style="width:700px;height:350px;visibility:hidden;"><?=$content?></textarea>
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

