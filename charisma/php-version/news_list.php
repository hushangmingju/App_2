<?php require('header.php'); ?>


    <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> 列表</h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="news_form.html">添加</a>
                </div>
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                        <tr>
                            <th>标题</th>
                            <th>类型</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							
							$pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
							$listArr = $db->QueryData("SELECT COUNT(*) AS `count` FROM `news` WHERE `status` = 'ok' ","assoc");
							$allCount = isset($listArr["count"]) ? intval($listArr["count"]) : 0;
							$thisPageCount = 10;
							$page_len=10;
							$defUrl = "&";
							include_once(dirname(__FILE__)."/page.cls.php");
							$listArr = $db->QueryData("SELECT * FROM `news` WHERE `status` = 'ok' ORDER BY `id` DESC LIMIT ". (($pageid-1) * $thisPageCount) ." , $thisPageCount ","all");
							//pre($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
							$typeArr = array("","官方资讯","活动分享","其他",);
							$typeName = isset($typeArr[$listArr[$i]["type"]]) ? $typeArr[$listArr[$i]["type"]] : null;
							?>
                        <tr>
                            <td><?=$listArr[$i]["title"]?></td>
                            <td class="center"><?=$typeName?></td>
                            <td class="center"><?=date("Y-m-d H:i:s",$listArr[$i]["time"])?></td>
                            <td class="center">
                                <a class="btn btn-success" href="../xinwen.php?id=<?=$listArr[$i]["id"]?>" target="_blank"><i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</a>
                                <a class="btn btn-info" href="news_form.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-edit icon-white"></i>编辑</a>
                                <a class="btn btn-danger" href="news_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a>
                            </td>
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