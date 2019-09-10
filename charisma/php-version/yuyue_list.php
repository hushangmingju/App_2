<?php require('header.php'); ?>
<div>
    <pre>    计算器2来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./yuyue_list.html?type=calc2">显示列表</a>
    计算器3来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./yuyue_list.html?type=calc3">显示列表</a>
    页面底部来源显示：姓名+电话+访问页+时间 <a href="./yuyue_list.html?type=bottom">显示列表</a>
    预约页面来源显示：姓名+电话+面积+留言+访问页+时间 <a href="./yuyue_list.html?type=yuyue">显示列表</a>
    样板房页面来源显示：姓名+电话+面积+留言+样板房+访问页+时间 <a href="./yuyue_list.html?type=yangban">显示列表</a>
    首页Banner来源显示：姓名+电话+面积+地址+访问页+时间 <a href="./yuyue_list.html?type=banner">显示列表</a>
    优惠活动Banner来源显示：姓名+电话+面积+地址+访问页+时间 <a href="./yuyue_list.html?type=yhbanner">显示列表</a>
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
                            <th>来源</th>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>面积</th>
                            <th>留言</th>
                            <th>样板房</th>
                            <th>计算</th>
                            <th>访问页</th>
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							
							$getType = _GET("type");
							if($getType=='yangban' || $getType=='liuyan' || $getType=='bottom' || $getType=='calc' || $getType=='calc2' || $getType=='calc3' || $getType=='yuyue' || $getType=='banner' || $getType=='yhbanner' ){
								$whereType = " `yuyue`.`type`='$getType' ";
								$defUrl= "type=".$getType;
							}else{
								$whereType = " `yuyue`.`type`!='liuyan' ";
								$defUrl= "";
							}
							$pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
							$listArr = $db->QueryData("SELECT COUNT(DISTINCT `yuyue`.`tel`) AS `count` FROM `yuyue`   LEFT JOIN  `yangban` ON   `yangban`.`id`=`yuyue`.`sid`  WHERE `yuyue`.`status`='ok' AND $whereType ","assoc");
							$allCount = isset($listArr["count"]) ? intval($listArr["count"]) : 0;
							$thisPageCount = 20;
							$page_len=10;
							$defUrl .= "&"; 
							include_once(dirname(__FILE__)."/page.cls.php");
							$listArr = $db->QueryData("SELECT `yuyue`.*,`yangban`.`title` AS `yangbantitle`    FROM `yuyue`   LEFT JOIN  `yangban` ON   `yangban`.`id`=`yuyue`.`sid`  WHERE `yuyue`.`status`='ok' AND $whereType  GROUP BY `yuyue`.`tel`  ORDER BY `yuyue`.`id` DESC LIMIT ". (($pageid-1) * $thisPageCount) ." , $thisPageCount","all");
							$count = count($listArr);
							for($i=0;$i<$count;$i++){
								if($listArr[$i]["type"]=="liuyan"){
									$laiyuan = "留言页面";
								}elseif($listArr[$i]["type"]=="yangban"){
									$laiyuan = "样板房页面";
								}elseif($listArr[$i]["type"]=="bottom"){
									$laiyuan = "页面底部";
								}elseif($listArr[$i]["type"]=="calc"){
									$laiyuan = "计算器";
								}elseif($listArr[$i]["type"]=="calc2"){
									$laiyuan = "计算器2";
								}elseif($listArr[$i]["type"]=="calc3"){
									$laiyuan = "计算器3";
								}elseif($listArr[$i]["type"]=="yuyue"){
									$laiyuan = "预约页面";
								}elseif($listArr[$i]["type"]=="banner"){
									$laiyuan = "首页banner";
								}elseif($listArr[$i]["type"]=="yhbanner"){
									$laiyuan = "优惠活动banner";
								}else{
									$laiyuan = "其他";
								}
							?>
                        <tr>
                            <td><?=$laiyuan?></td>
                            <td><?=$listArr[$i]["name"]?></td>
                            <td class="center"><?=$listArr[$i]["tel"]?></td>
                            <td class="center"><?=$listArr[$i]["area"]?></td>
                            <td class="center"><?php if($listArr[$i]["type"]=="liuyan"){ ?>留言标题：<?=$listArr[$i]["title"]?><br>留言内容<?=$listArr[$i]["content"]?><?php }elseif($listArr[$i]["type"]=="banner" || $listArr[$i]["type"]=="yhbanner"){ ?>地址：<?=$listArr[$i]["content"]?><?php }else{ ?><?=$listArr[$i]["content"]?><?php } ?></td>
                            <td class="center"><?php if($listArr[$i]["type"]=="yangban"){ ?><a href="../yangban-v.php?id=<?=$listArr[$i]["sid"]?>" target="_blank"><?=$listArr[$i]["yangbantitle"]?></a><?php } ?></td>
                            <td class="center"><?php if($listArr[$i]["type"]=="calc" || $listArr[$i]["type"]=="calc2" || $listArr[$i]["type"]=="calc3"){ ?>样式：<?=$listArr[$i]["calcstyle"]?><br>单价：<?=$listArr[$i]["calcprice"]?><br>面积：<?=$listArr[$i]["calcarea"]?><br>总价：<?=$listArr[$i]["calctotal"]?><?php } ?></td>
                            <td class="center" title="<?=rawurldecode($listArr[$i]["url"])?>"><?=(strlen(rawurldecode($listArr[$i]["url"])) >50 ? substr(rawurldecode($listArr[$i]["url"]), 0, 50) . '...' : rawurldecode($listArr[$i]["url"]))?></td>
                            <td class="center"><?=date("Y-m-d H:i:s",$listArr[$i]["time"])?></td>
                            <td class="center"><a class="btn btn-danger" href="yuyue_del.html?id=<?=$listArr[$i]["id"]?>"><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td>
                            
                                
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
                    跳转到第<input id="pageindex" type="text" size="3" value="" />页<input type="button" value="Go" onClick="window.location='yuyue_list.html?page='+document.getElementById('pageindex').value;" />
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" />
                </div>
            </div>
        </div>
        <!--/span-->
        

        
        
        
        

    </div><!--/row-->








<?php require('footer.php'); ?>