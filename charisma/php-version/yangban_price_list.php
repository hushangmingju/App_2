<?php 
require('header.php');
require_once('init.inc');
?>

<?php
if (!isset($_GET['id']) || !DAS::isExistedInDB("`yangban`", "`id` = " . intval($_GET['id']) . " AND `priceList` IS NOT NULL")) {
    die("<script type='text/javascript'>window.location.href='yangban_list.html'</script>");
}
?>
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
                            <th>序号</th>
                            <th>面积</th>
                            <th>户型</th>
                            <!--<th>业主推荐</th>-->
                            <th>总价</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
                            $priceList = new Query("`priceList`", "`yangban`", "", "`id` = " . intval($_GET['id']));
							$priceList = DAS::quickQuery($priceList);
                            $priceList = explode('%20%0D%0A', $priceList['data'][0]['priceList']);
							for ($i=0; $i < count($priceList); $i++){
                                $tempPrice = explode('%09', $priceList[$i]);
                                $tempType = preg_split('//', $tempPrice[1]);
							?>
                        <tr>
                            <td><?=$i + 1?></td>
                            <td><?php echo $tempPrice[0];?></td>
                            <td class="center"><?php echo $tempType[1] . '室' . $tempType[2] . '厅' . $tempType[3] . '厨' . $tempType[4] . '卫';?></td>
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
                            <td class="center"><?php echo $tempPrice[2];?></td>
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