<?php require('header.php'); ?>
    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 列表</h2>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>电话</th>
                            <th>礼品</th>
                            <th>抽奖时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
							$listArr = $db->QueryData("SELECT COUNT(*) AS `count` FROM `tb_mingju_lotto` WHERE `status` = 'ok'","assoc");
							$allCount = isset($listArr["count"]) ? intval($listArr["count"]) : 0;
							$thisPageCount = 20;
							$page_len=10;
							include_once(dirname(__FILE__)."/page.cls.php");
							$listArr = $db->QueryData("SELECT * FROM `tb_mingju_lotto` WHERE `status` = 'ok' ORDER BY `id` DESC LIMIT ". (($pageid-1) * $thisPageCount) ." , $thisPageCount","all");
							$count = count($listArr);
                            $presents = array("无","全屋窗帘","1888元摆饰","青花瓷碗具","工具箱","大礼包","拖把","凳子","天堂伞");
							for($i=0;$i<$count;$i++){
                                
							?>
                        <tr>
                            <td class="center"><?=$listArr[$i]["tel"]?></td>
                            <td class="center"><?=$presents[$listArr[$i]["present"]]?></td>
                            <td class="center"><?=$listArr[$i]["timestamp"]?></td>
                            <td class="center"><a class="btn btn-danger" href="lotto_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td>
                            
                                
                        </tr>
							<?php
							}
							?>
                        
                        
                        
                        </tbody>
                    </table>
                    <style>
                    .xpage{display:inline;white-space: nowrap;}
                    .xpage li{margin:3px;display:inline-block;list-style-type:none;}
                    </style>
                    <ul class="xpage"><?=$listPageHtml?></ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        

        
        
        
        

    </div><!--/row-->








<?php require('footer.php'); ?>