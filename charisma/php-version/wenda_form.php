<?php require('header.php'); ?>
<?php 
if(_POST("post")){
	$id = _POST("id") ? intval(_POST("id")) : null;
	$params = array('mod'=>'wenda','type'=>_POST("type"),'a'=>_POST("a"),'q'=>_POST("q"),'status'=>"ok",'time'=>time());
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
                        <label>分类</label>
                        <select name="type" id="type" style="min-width: 150px;min-height:35px;">
                          <option  value="1"  selected="selected">一站式整体装修</option>
                          <option  value="2" >品牌评测</option>
                          <option  value="3" >施工注意</option>
                          <option  value="4" >设计风格</option>
                          <option  value="5" >装修需知</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>问</label>
                        <input type="text" class="form-control" name="q" value="<?=$q?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>答</label><br>
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

