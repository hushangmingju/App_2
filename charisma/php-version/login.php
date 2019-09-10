<?php
$no_visible_elements = true;
$login = true;
include('header.php'); 


if(_POST("user")){
	$user = _POST("user") ? addslashes(_POST("user")) : null;
	$pwd = _POST("user") ? md5(_POST("pwd")) : null;
	$dbData = $db->QueryData("SELECT * FROM `user` WHERE `user` = '$user'");
	$u=isset($dbData['user']) ? $dbData['user'] : null;
	$p=isset($dbData['pass']) ? $dbData['pass'] : null;

	if($pwd==$p && $p){
		$_SESSION['admin'] = $u;
		echo "<script>window.location.href = \"index.html\";</script>";
		//pre("登录成功");
	}else{
		unset($_SESSION['admin']);
	}
}

?>

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>登录</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                请输入账号密码
            </div>
            <form class="form-horizontal" action="" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="账号">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="pwd" placeholder="密码">
                    </div>
                    <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" class="btn btn-primary">登录</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
<?php require('footer.php'); ?>