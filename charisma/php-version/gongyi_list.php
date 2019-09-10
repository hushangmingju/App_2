<?php require('header.php'); ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 列表</h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="gongyi_form.html">添加</a>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>内容</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$listArr = $db->QueryData("SELECT * FROM `wenda` WHERE `status` !='del' AND `mod`='gongyi' ORDER BY `id` DESC ","all");
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							?>
                        <tr>
                            <td><?=$listArr[$i]["q"]?></td>
                            <td><?=$listArr[$i]["a"]?></td>
                            <td class="center"><?=date("Y-m-d H:i:s",$listArr[$i]["time"])?></td>
                            <td class="center">
                            <a class="btn btn-info" href="gongyi_form.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                            <a class="btn btn-danger" href="wenda_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
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