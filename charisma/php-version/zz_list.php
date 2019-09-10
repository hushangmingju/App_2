<?php require('header.php'); ?>
<div>
    <pre>    <!--计算器  来源显示：姓名+电话+来源+计算+时间 <a href="./zz_list.html?type=calc">显示列表</a>
    预约页面  来源显示：姓名+电话+来源+时间 <a href="./zz_list.html?type=yuyue">显示列表</a>-->
    </pre>
</div>
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
                            <th>&nbsp;</th>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>来源</th>
                            <th>服务项目</th>
                            <th>计算</th>
                            <th>时间</th>
                            <th>IP地址</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$getType = _GET("type");
							if($getType=='calc' || $getType=='yuyue'){
								$where = "`status` = 'ok'  AND `type`='$getType' ";
								$defUrl= "type=".$getType;
							}else{
								$where = "`status` = 'ok'";
								$defUrl= "";
							}
							$pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
							$listArr = $db->QueryData("SELECT COUNT(*) AS `count` FROM `tb_zz_yuyue` WHERE $where","assoc");
							$allCount = isset($listArr["count"]) ? intval($listArr["count"]) : 0;
							$thisPageCount = 20;
							$page_len=10;
							include_once(dirname(__FILE__)."/page.cls.php");
							$listArr = $db->QueryData("SELECT * FROM `tb_zz_yuyue` WHERE $where	 ORDER BY `id` DESC LIMIT ". (($pageid-1) * $thisPageCount) ." , $thisPageCount","all");
							$count = count($listArr);
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
								if($listArr[$i]["type"]=="calc"){
									$laiyuan = "计算器";
								}
								elseif($listArr[$i]["type"]=="yuyue"){
									$laiyuan = "预约页面";
								}
								else{
									$laiyuan = "其他";
								}
							?>
                        <tr>
                            <td><?=$laiyuan?></td>
                            <td><?=$listArr[$i]["name"]?></td>
                            <td class="center"><?=$listArr[$i]["tel"]?></td>
                            <td class="center" title="<?=rawurldecode($listArr[$i]["url"])?>"><?=(strlen(rawurldecode($listArr[$i]["url"])) >50 ? substr(rawurldecode($listArr[$i]["url"]), 0, 50) . '...' : rawurldecode($listArr[$i]["url"]))?></td>
                            <td class="center"><?=$listArr[$i]["service"] ? $listArr[$i]["service"] : ''?></td>
                            <td class="center"><?php if($listArr[$i]["type"]=="calc"){ ?>样式：<?=$listArr[$i]["style"]?><br>单价：<?=$listArr[$i]["price"]?><br>面积：<?=$listArr[$i]["area"]?><br>总价：<?=$listArr[$i]["total"]?><?php } ?></td>
                            <td class="center"><?=$listArr[$i]["timestamp"]?></td>
                            <td class="center"><?=$listArr[$i]["ip"]?></td>
                            <td class="center"><a class="btn btn-danger" href="zz_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td>
                            
                                
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