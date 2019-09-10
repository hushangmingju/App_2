<?php require('header.php'); ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 列表</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="yangban_form.html">添加</a>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>样板间编号</th>
                            <th>类型</th>
                            <!--<th>业主推荐</th>-->
                            <th>价格表</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$listArr = $db->QueryData("SELECT * FROM `yangban` WHERE `status` = 'ok'","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							$typeArr = array("","现代风格","美式风格","新中式风格","欧式风格","私人定制",);
							$typeName = isset($typeArr[$listArr[$i]["type"]]) ? $typeArr[$listArr[$i]["type"]] : null;
							?>
                        <tr>
                            <td><?=$listArr[$i]["title"]?></td>
                            <td><?php echo $listArr[$i]["yangbanID"] ? '#' . $listArr[$i]["yangbanID"] : '';?></td>
                            <td class="center"><?=$typeName?></td>
                            <!--<td class="center">
                                <?php
                                if($listArr[$i]["tuijian"]==1){
                                ?>
                                ☑ <a href="yangban_tuijian.html?id=<?=$listArr[$i]["id"]?>&tuijian=0">取消业主推荐</a>
                                <?php
                                }else{
                                ?>
                                ☒ <a href="yangban_tuijian.html?id=<?=$listArr[$i]["id"]?>&tuijian=1">设置业主推荐</a>
                                <?php
                                }
                                ?>
                            </td>-->
                            <td class="center"><?php echo $listArr[$i]["priceList"] ? '<a href="yangban_price_list.html?id=' . $listArr[$i]["id"] . '">一平一价</a>' : $listArr[$i]["price"];?></td>
                            <td class="center"><?=date("Y-m-d H:i:s",$listArr[$i]["time"])?></td>
                            <td class="center">
                                <a class="btn btn-success" href="../yangban-v.php?id=<?=$listArr[$i]["id"]?>" target="_blank"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                <a class="btn btn-info" href="yangban_form.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                                <a class="btn btn-danger" href="yangban_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                                

                                
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