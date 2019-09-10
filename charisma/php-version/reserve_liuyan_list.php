<?php
require_once('top.inc');
?>
<div>
    <pre>    留言页面来源显示：姓名+电话+留言标题和内容+时间</pre>
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
                            <th>时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
							<?php
							$pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
							$listArr = new Query("*", "`tb_mingju_reserves`", "", "`status`='ok' AND `type`='liuyan' AND `group_table`=1","`timestamp` DESC");
                            $listArr = DAS::divisionPages($listArr, 'RC', 20, $pageid);
                            if (DAS::hasData($listArr)) {
                                $allCount = $listArr['NUM_DATA'];
                                $thisPageCount = $listArr['NUM_PER_PAGE'];
							    $page_len = 10;
							    $page_len=10;
							    $defUrl = "&";
							include_once(dirname(__FILE__)."/page.cls.php");
							
							//pre($listArr);
							$count = count($listArr['data']);
							for($i=0;$i<$count;$i++){
								if($listArr[$i]["type"]=="liuyan"){
									$laiyuan = "留言页面";
								}elseif($listArr[$i]["type"]=="yangban"){
									$laiyuan = "样板房页面";
								}elseif($listArr[$i]["type"]=="bottom"){
									$laiyuan = "页面底部";
								}elseif($listArr[$i]["type"]=="calc"){
									$laiyuan = "计算器";
								}elseif($listArr[$i]["type"]=="yuyue"){
									$laiyuan = "预约页面";
								}else{
									$laiyuan = "其他";
								}
                                $contents = json_decode(rawurldecode($listArr['data'][$i]['contents']), true);
							?>
                        <tr>
                            <td><?=$laiyuan?></td>
                            <td><?=$listArr['data'][$i]["name"]?></td>
                            <td class="center"><?=$listArr['data'][$i]["tel"]?></td>
                            <td class="center"><?=$contents["area"]?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="liuyan"){ ?>留言标题：<?=$contents["title"]?><br>留言内容：<?=$contents["content"]?><?php }else{ ?><?=$contents["content"]?><?php } ?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="yangban"){ ?><a href="../yangban-v.php?id=<?=$contents["sid"]?>" target="_blank"><?=DAS::isExistedInDB("`yangban`", "`id` = " . $contents["sid"], '`title`')?></a><?php } ?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="calc"){ ?>样式：<?=$contents["calcstyle"]?><br>单价：<?=$contents["calcprice"]?><br>面积：<?=$contents["calcarea"]?><br>总价：<?=$contents["calctotal"]?><?php } ?></td>
                            <td class="center"><?=$listArr['data'][$i]["timestamp"]?></td>
                            <td class="center"><a class="btn btn-danger" value=<?=$listArr['data'][$i]["id"]?>><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td>
                            
                                
                        </tr>
							<?php
							}
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

<script language="javascript" type="text/javascript">
<!--//
$(document).ready(function(e) {
    $(".btn-danger").click(function(e) {
        var id = $(this).attr("value");
        
        $.ajax({
            type: "POST",
            url: "reserve_svr.html",
            data: {"action":"delReserve", "id":id},
            dataType: "json",
            success: function(data) { 
                alert(data.TEXT);
                reloadPage();
            },
            error: function(data) { 
		        alert("网络错误，请重试。");
            },
        });
    });
});
//-->
</script>






<?php require('footer.php'); ?>