<?php require('header.php'); ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 电脑端</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_form.html?ag=1">添加</a>
                    
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>网址</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$listArr = $db->QueryData("SELECT * FROM `banner` WHERE `status` = 'ok' AND `agent` = 1 ORDER BY `id` DESC ","all");
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
                        <tr>
                            <td><?=$listArr[$i]["pic"]?></td>
                            <td class="center"><?=$listArr[$i]["url"]?></td>
                            <td class="center">
                                <a class="btn btn-info" href="banner_form.html?id=<?=$listArr[$i]["id"]?>&ag=<?=$listArr[$i]["agent"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                                <a class="btn btn-danger" href="banner_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                            </td>
                        </tr>
							<?php
							}
							?>
                        
                        
                        
                        </tbody>
                    </table>
                    
                    
                    
                </div>
            </div>
        </div>
        <!--/span-->
        

        
        
        
        

    </div><!--/row-->
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 移动端</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="banner_form.html?ag=2">添加</a>
                    
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>网址</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$listArr = $db->QueryData("SELECT * FROM `banner` WHERE `status` = 'ok' AND `agent` = 2 ORDER BY `id` DESC ","all");
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
                        <tr>
                            <td><?=$listArr[$i]["pic"]?></td>
                            <td class="center"><?=$listArr[$i]["url"]?></td>
                            <td class="center">
                                <a class="btn btn-info" href="banner_form.html?id=<?=$listArr[$i]["id"]?>&ag=<?=$listArr[$i]["agent"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                                <a class="btn btn-danger" href="banner_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                            </td>
                        </tr>
							<?php
							}
							?>
                        
                        
                        
                        </tbody>
                    </table>
                    
                    
                    
                </div>
            </div>
        </div>
        <!--/span-->
        

        
        
        
        

    </div><!--/row-->







<?php require('footer.php'); ?>