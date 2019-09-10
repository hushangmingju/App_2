<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('jiaotong'=>_POST("jiaotong"),'jiache'=>_POST("jiache"),'tel'=>_POST("tel"),'mendian'=>_POST("mendian"),'address'=>_POST("address"),'qq'=>_POST("qq"),'email'=>_POST("email"),'copyright'=>_POST("copyright"));//,'keywords'=>_POST("keywords"),'description'=>_POST("description")
	if(!empty(_POST("pwd"))){
		$params['pass'] = md5(_POST("pwd"));
	}
	$query = $db->QueryInsUp('user',$params," `id`='1' ");
	

	echo "编辑成功";
	
	
	
	
	
	
	echo "编辑成功";
}else{

	
$id = _GET("id") ? intval(_GET("id")) : null;
$dbData = $db->QueryData("SELECT * FROM `user` WHERE `id` = '1'");
$url=isset($dbData['url']) ? $dbData['url'] : null;
$pwd=isset($dbData['pass']) ? $dbData['pass'] : null;
$jiaotong=isset($dbData['jiaotong']) ? $dbData['jiaotong'] : null;
$jiache=isset($dbData['jiache']) ? $dbData['jiache'] : null;
$tel=isset($dbData['tel']) ? $dbData['tel'] : null;
$address=isset($dbData['address']) ? $dbData['address'] : null;
$mendian=isset($dbData['mendian']) ? $dbData['mendian'] : null;
$qq=isset($dbData['qq']) ? $dbData['qq'] : null;
$email=isset($dbData['email']) ? $dbData['email'] : null;
$copyright=isset($dbData['copyright']) ? $dbData['copyright'] : null;

$keywords=isset($dbData['keywords']) ? $dbData['keywords'] : null;
$description=isset($dbData['description']) ? $dbData['description'] : null;
	
	
	
$dbData = $db->QueryData("SELECT * FROM `keys` WHERE `key`='huodong' ");
$title=isset($dbData['value1']) ? $dbData['value1'] : null;
$pic=isset($dbData['value2']) ? $dbData['value2'] : null;
$url=isset($dbData['value3']) ? $dbData['value3'] : null;
$text=isset($dbData['text1']) ? $dbData['text1'] : null;
	
	
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
                    
                    <!--
                    <div class="form-group">
                        <label>关键词</label>（不要输入引号）
                        <input type="text" class="form-control" name="keywords" value="<?=$keywords?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>描述</label>（不要输入引号）
                        <input type="text" class="form-control" name="description" value="<?=$description?>" placeholder="请输入">
                    </div>
                    -->
                    <div class="form-group">
                        <label>地址</label>
                        <input type="text" class="form-control" name="address" value="<?=$address?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>门店地址</label>
                        <input type="text" class="form-control" name="mendian" value="<?=$mendian?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>交通路线</label><br>
                        <textarea style="width:700px;height:80px" name="jiaotong"><?=$jiaotong?></textarea>
                    </div>
                    <div class="form-group">
                        <label>驾车路线</label>
                        <input type="text" class="form-control" name="jiache" value="<?=$jiache?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>电话</label>
                        <input type="text" class="form-control" name="tel" value="<?=$tel?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>邮箱</label>
                        <input type="text" class="form-control" name="email" value="<?=$email?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>QQ</label>
                        <input type="text" class="form-control" name="qq" value="<?=$qq?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>页脚Copyright</label><br>
						<textarea style="width:700px;height:80px" name="copyright"><?=$copyright?></textarea>
                        <!--<input type="text" class="form-control" name="copyright" value="?=$copyright?>" placeholder="请输入">-->
                    </div>
                    <div class="form-group">
                        <label>登录密码</label>
                        <input type="text" class="form-control" name="pwd" value="" placeholder="请输入">
                        如不需要修改密码，可以留空	
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

