<?php require('header.php'); ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 列表</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tuijian_form.html">添加</a> 
                </div>
                <div class="box-header well" data-original-title="">
                    分类：<a href="./tuijian_list.html?type=1">Banner</a> &nbsp;&nbsp;<a href="./tuijian_list.html?type=2">媒体合作</a> &nbsp;&nbsp;<a href="./tuijian_list.html?type=3">业主锦旗</a> &nbsp;&nbsp;<a href="./tuijian_list.html?type=4">业主推荐样板间</a> 
                </div>
                
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>类型</th>
                            <th>标题</th>
                            <th>链接</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$getType = _GET("type");
							if($getType=='1' || $getType=='2' || $getType=='3' || $getType=='4' ){
								$whereType = " AND `tuijian`.`type`='$getType' ";
							}else{
								$whereType = " ";
							}
							$listArr = $db->QueryData("SELECT * FROM `tuijian` WHERE `status` = 'ok' $whereType ","all");
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							
								if($listArr[$i]["type"]=="1"){
									$type = "Banner";
								}elseif($listArr[$i]["type"]=="2"){
									$type = "媒体合作";
								}elseif($listArr[$i]["type"]=="3"){
									$type = "业主锦旗";
								}elseif($listArr[$i]["type"]=="4"){
									$type = "业主推荐样板间";
								}else{
									$type = "其他";
								}
							
							
							
							?>
                        <tr>
                            <td><?=$type?></td>
                            <td><?=$listArr[$i]["title"]?></td>
                            <td class="center"><?=$listArr[$i]["url"]?></td>
                            <td class="center"><?=date("Y-m-d H:i:s",$listArr[$i]["time"])?></td>
                            <td class="center">
                                <a class="btn btn-info" href="tuijian_form.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                                <a class="btn btn-danger" href="tuijian_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
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