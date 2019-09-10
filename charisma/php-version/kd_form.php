<?php require('header.php'); ?>
<?php
if(_POST("id")){
	$id = _POST("id") ? intval(_POST("id")) : 0;
}else{
	$id = _GET("id") ? intval(_GET("id")) : 0;
}


if(_POST("post")){
	if($id>0 && $id<50){
		$params = array('text1'=>_POST("keywords"),'text2'=>_POST("description"));
		$query = $db->QueryInsUp('keys',$params," `key`='kd{$id}' ");
		echo "编辑成功";
	}else{
		echo "编辑失败";
	}

}else{
	$dbData = $db->QueryData("SELECT * FROM `keys` WHERE `key`='kd{$id}' ");
	$keywords=isset($dbData['text1']) ? $dbData['text1'] : null;
	$description=isset($dbData['text2']) ? $dbData['text2'] : null;
 ?>
 
<div>
    <pre>PC端位置：<a href="?id=1" <?php if($id==1){echo "style='color:red'";} ?>>首页</a> | <a href="?id=2" <?php if($id==2){echo "style='color:red'";} ?>>3D全景</a> | <a href="?id=3" <?php if($id==3){echo "style='color:red'";} ?>>实景体验</a> | <a href="?id=4" <?php if($id==4){echo "style='color:red'";} ?>>业主推荐</a> | <a href="?id=5" <?php if($id==5){echo "style='color:red'";} ?>>快速预约</a> | <a href="?id=6" <?php if($id==6){echo "style='color:red'";} ?>>优惠活动</a> | <a href="?id=7" <?php if($id==7){echo "style='color:red'";} ?>>家装战略</a> | <a href="?id=8" <?php if($id==8){echo "style='color:red'";} ?>>装修问答</a> | <a href="?id=9" <?php if($id==9){echo "style='color:red'";} ?>>家装6.0</a> | <a href="?id=10" <?php if($id==10){echo "style='color:red'";} ?>>一站式精装呈现</a> | <a href="?id=11" <?php if($id==11){echo "style='color:red'";} ?>>整体工装</a> | <a href="?id=12" <?php if($id==12){echo "style='color:red'";} ?>>关于茗居</a> | <a href="?id=15" <?php if($id==15){echo "style='color:red'";} ?>>新闻资讯</a> | <a href="?id=13" <?php if($id==13){echo "style='color:red'";} ?>>联系我们</a> | <a href="?id=14" <?php if($id==14){echo "style='color:red'";} ?>>招聘信息</a> | <a href="?id=16" <?php if($id==16){echo "style='color:red'";} ?>>家装问答</a></pre>
    <pre>移动端位置：<a href="?id=31" <?php if($id==31){echo "style='color:red'";} ?>>首页</a> | <a href="?id=32" <?php if($id==32){echo "style='color:red'";} ?>>家装6.0</a> | <a href="?id=33" <?php if($id==33){echo "style='color:red'";} ?>>一站式整体装修</a> | <a href="?id=34" <?php if($id==34){echo "style='color:red'";} ?>>实景体验</a> | <a href="?id=35" <?php if($id==35){echo "style='color:red'";} ?>>合作供应商</a> | <a href="?id=36" <?php if($id==36){echo "style='color:red'";} ?>>关于沪尚</a> | <a href="?id=37" <?php if($id==37){echo "style='color:red'";} ?>>品牌历史</a> | <a href="?id=38" <?php if($id==38){echo "style='color:red'";} ?>>联系我们</a></pre>
</div>
 


<?php
if($id){
?>
<!--<div>
    <ul class="breadcrumb">
        <li>
            <a href="#">编辑</a>
        </li>
    </ul>
</div>-->
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
                        <label>keywords</label>
                        <input type="text" class="form-control" name="keywords" value="<?=$keywords?>" placeholder="请输入">
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input type="text" class="form-control" name="description" value="<?=$description?>" placeholder="请输入">
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
<?php
}
 ?>


<?php require('footer.php'); ?>

