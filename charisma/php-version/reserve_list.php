<?php
require_once('top.inc');
?>
<div>
  <pre>
    计算器2来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./reserve_list.html?type=calc2">显示列表</a>
    计算器3来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./reserve_list.html?type=calc3">显示列表</a>
    工地预约来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./reserve_list.html?type=gongdi">显示列表</a>
    页面底部来源显示：姓名+电话+访问页+时间 <a href="./reserve_list.html?type=bottom">显示列表</a>
    预约页面来源显示：姓名+电话+面积+留言+访问页+时间 <a href="./reserve_list.html?type=yuyue">显示列表</a>
    样板房页面来源显示：姓名+电话+面积+留言+样板房+访问页+时间 <a href="./reserve_list.html?type=yangban">显示列表</a>
    首页Banner来源显示：姓名+电话+面积+地址+访问页+时间 <a href="./reserve_list.html?type=banner">显示列表</a>
    优惠活动Banner来源显示：姓名+电话+面积+地址+访问页+时间 <a href="./reserve_list.html?type=yhbanner">显示列表</a>
    留言页面来源显示：姓名+电话+面积+留言+计算+访问页+时间 <a href="./reserve_list.html?type=liuyan">显示列表</a>
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
              <!--<th>操作</th>-->
            </tr>
          </thead>
          <tbody>
		  <?php
          $pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
		  $listArr = new Query("MAX(`id`)", "`tb_mingju_reserves`", "", "","`id` DESC", "`tel`");
							
		  $getType = _GET("type");
		  if ($getType=='yangban' || $getType=='liuyan' || $getType=='bottom' || $getType=='calc' || $getType=='calc2' || $getType=='calc3' || $getType=='yuyue' || $getType=='banner' || $getType=='yhbanner' ) {
		      $listArr->setWhere("`status`='ok' AND `group_table` = 1 AND `type`='" . $getType . "'");
			  $defUrl= "type=".$getType;
		  } else {
              $listArr->setWhere("`status`='ok' AND `group_table` = 1 AND `type` != 'liuyan'");
			  $defUrl= "";
		  }
          $listArr = new Query("*", "`tb_mingju_reserves`", "", "`id` IN (" . $listArr->getString() . ")", "`timestamp` DESC");
          $listArr = DAS::divisionPages($listArr, 'RC', 20, $pageid);
          if (DAS::hasData($listArr)) {
              //print_r($listArr);
              $allCount = $listArr['NUM_DATA'];
              $thisPageCount = $listArr['NUM_PER_PAGE'];
							    $page_len = 10;
							    $defUrl .= "&"; 
                                include_once(dirname(__FILE__)."/page.cls.php");
                                $count = count($listArr['data']);
                                for ($i=0;$i<$count;$i++) {
								    if ($listArr['data'][$i]["type"]=="liuyan") {
									    $laiyuan = "留言页面";
								    } elseif ($listArr['data'][$i]["type"]=="yangban") {
									    $laiyuan = "样板房页面";
								    } elseif ($listArr['data'][$i]["type"]=="gongdi") {
									    $laiyuan = "工地预约";
								    } elseif ($listArr['data'][$i]["type"]=="bottom") {
									    $laiyuan = "页面底部";
								    } elseif ($listArr['data'][$i]["type"]=="calc") {
									    $laiyuan = "计算器";
								    } elseif ($listArr['data'][$i]["type"]=="calc2") {
									    $laiyuan = "计算器2";
								    } elseif ($listArr['data'][$i]["type"]=="calc3") {
									    $laiyuan = "计算器3";
								    } elseif ($listArr['data'][$i]["type"]=="yuyue") {
									    $laiyuan = "预约页面";
								    } elseif ($listArr['data'][$i]["type"]=="banner") {
									    $laiyuan = "首页banner";
								    } elseif ($listArr['data'][$i]["type"]=="yhbanner") {
									    $laiyuan = "优惠活动banner";
								    } else {
									    $laiyuan = "其他";
								    }
                                    $contents = json_decode(rawurldecode($listArr['data'][$i]['contents']), true);
                                ?>
                        <tr>
                            <td><?=$laiyuan?></td>
                            <td><?=rawurldecode($listArr['data'][$i]["name"])?></td>
                            <td class="center"><?=$listArr['data'][$i]["tel"]?></td>
                            <td class="center"><?=$contents["area"]?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="liuyan"){ ?>留言标题：<?=$contents["title"]?><br>留言内容：<?=$contents["content"]?><?php }elseif($listArr['data'][$i]["type"]=="banner" || $listArr['data'][$i]["type"]=="yhbanner"){ ?>地址：<?=$contents["content"]?><?php }else{ ?><?=$contents["content"]?><?php } ?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="yangban"){ ?><a href="../yangban-v.php?id=<?=$contents["sid"]?>" target="_blank"><?=!strpos($contents["sid"], '_new') ? DAS::isExistedInDB("`yangban`", "`id` = " . $contents["sid"], '`title`') : DAS::isExistedInDB("`tb_wcp_showrooms`", "`id` = " . str_replace('_new', '', $contents["sid"]), '`name`')?></a><?php } ?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="calc" || $listArr['data'][$i]["type"]=="calc2" || $listArr['data'][$i]["type"]=="calc3"){ ?>样式：<?=$contents["calcstyle"]?><br>单价：<?=$contents["calcprice"]?><br>面积：<?=$contents["calcarea"]?><br>总价：<?=$contents["calctotal"]?><?php } ?></td>
                            <td class="center" title="<?=rawurldecode($listArr['data'][$i]["url"])?>"><?=(strlen(rawurldecode($listArr['data'][$i]["url"])) >50 ? substr(rawurldecode($listArr['data'][$i]["url"]), 0, 50) . '...' : rawurldecode($listArr['data'][$i]["url"]))?></td>
                            <td class="center"><?=$listArr['data'][$i]["timestamp"]?></td>
                            <!--<td class="center"><a class="btn btn-danger" value=<?=$listArr['data'][$i]["id"]?>><i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td>-->                            
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
                    跳转到第<input id="pageindex" type="text" size="3" value="" />页<input type="button" value="Go" onClick="window.location='reserve_list.html?page='+document.getElementById('pageindex').value;" />
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