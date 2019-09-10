<?php
require_once('top.inc');
?>
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
          $presents = array("无","全屋窗帘","1888元摆饰","青花瓷碗具","工具箱","大礼包","拖把","凳子","天堂伞");
		  
          $listArr = new Query("*", "`tb_mingju_reserves`", "", "`status`='ok' AND `group_table` = 3","`timestamp` DESC");
          $listArr = DAS::divisionPages($listArr, 'RC', 20, $pageid);
          
          if (DAS::hasData($listArr)) {
              $allCount = $listArr['NUM_DATA'];
              $thisPageCount = $listArr['NUM_PER_PAGE'];
			  $page_len = 10;
			  $defUrl .= "&"; 
                                include_once(dirname(__FILE__)."/page.cls.php");
                                $count = count($listArr['data']);
                                for ($i=0;$i<$count;$i++) {
                                    $contents = json_decode(rawurldecode($listArr['data'][$i]['contents']), true);
                                ?>
                        <tr>
                            <td class="center"><?=$listArr['data'][$i]["tel"]?></td>
                            <td class="center"><?=$presents[$contents["present"]]?></td>
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
                    跳转到第<input id="pageindex" type="text" size="3" value="" />页<input type="button" value="Go" onClick="window.location='reserve_lotto_list.html?page='+document.getElementById('pageindex').value;" />
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