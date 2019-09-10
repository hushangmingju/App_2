<?php
require_once('top.inc');
?>
<div>
  <pre>
    计算器  来源显示：姓名+电话+来源+计算+时间 <a href="./reserve_expo_list.html?type=calc">显示列表</a>
    预约页面  来源显示：姓名+电话+来源+时间 <a href="./reserve_expo_list.html?type=yuyue">显示列表</a>
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
              <!--<th>操作</th>-->
            </tr>
          </thead>
          <tbody>
		  <?php
          $pageid = _GET("page") ? (intval(_GET("page"))<=1) ? 1 : intval(_GET("page")) : 1;
		  $listArr = new Query("MAX(`id`)", "`tb_mingju_reserves`", "", "","`id` DESC", "`tel`");
							
		  $getType = _GET("type");
		  if ($getType=='calc' || $getType=='yuyue') {
		      $listArr->setWhere("`status`='ok' AND `group_table` = 2 AND `type`='" . $getType . "'");
			  $defUrl= "type=".$getType;
		  } else {
              $listArr->setWhere("`status`='ok' AND `group_table` = 2");
			  $defUrl= "";
		  }
          $listArr = new Query("*", "`tb_mingju_reserves`", "", "`id` IN (" . $listArr->getString() . ")", "`timestamp` DESC");
          $listArr = DAS::divisionPages($listArr, 'RC', 20, $pageid);
          if (DAS::hasData($listArr)) {
              $allCount = $listArr['NUM_DATA'];
              $thisPageCount = $listArr['NUM_PER_PAGE'];
							    $page_len = 10;
							    $defUrl .= "&"; 
                                include_once(dirname(__FILE__)."/page.cls.php");
                                $count = count($listArr['data']);
                                for ($i=0;$i<$count;$i++) {
                                    if ($listArr['data'][$i]["type"]=="calc") {
									    $laiyuan = "计算器";
								    }
                                    elseif ($listArr['data'][$i]["type"]=="yuyue") {
									    $laiyuan = "预约页面";
								    } else {
									    $laiyuan = "其他";
								    }
                                    $contents = json_decode(rawurldecode($listArr['data'][$i]['contents']), true);
                                ?>
                        <tr>
                            <td><?=$laiyuan?></td>
                            <td><?=rawurldecode($listArr['data'][$i]["name"])?></td>
                            <td class="center"><?=$listArr['data'][$i]["tel"]?></td>
                            <td class="center" title="<?=rawurldecode($listArr['data'][$i]["url"])?>"><?=/*(strlen(rawurldecode($listArr['data'][$i]["url"])) >50 ? substr(rawurldecode($listArr['data'][$i]["url"]), 0, 50) . '...' : */rawurldecode($listArr['data'][$i]["url"])/*)*/?></td>
                            <td class="center"><?=$contents["service"] ? $contents["service"] : ''?></td>
                            <td class="center"><?php if($listArr['data'][$i]["type"]=="calc"){ ?>样式：<?=$contents["style"]?><br>单价：<?=$contents["price"]?><br>面积：<?=$contents["area"]?><br>总价：<?=$contents["total"]?><?php } ?></td>
                            <td class="center"><?=$listArr['data'][$i]["timestamp"]?></td>
                            <td class="center"><?=$listArr['data'][$i]["ip"]?></td>
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
                    跳转到第<input id="pageindex" type="text" size="3" value="" />页<input type="button" value="Go" onClick="window.location='reserve_expo_list.html?page='+document.getElementById('pageindex').value;" />
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