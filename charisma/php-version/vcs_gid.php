<?php 
require_once('vcs_header.php');
if (!isset($_GET['gid']) || !trim($_GET['gid']) || !DAS::isExistedInDB("`tb_vcs_guest`", "`guestID` = '" . trim($_GET['gid']) . "'")) {
    die("<script type='text/javascript'>window.location.href='vcs_gid_list.html'</script>");
}

$guestData = new Query("`t1`.*, `t2`.`pageFile`", "`tb_vcs_guest` AS `t1`", "LEFT JOIN `tb_vcs_pages` AS `t2` ON `t1`.`pageID` = `t2`.`id`", "`t1`.`guestID` = '" . trim($_GET['gid']) . "'", "`t1`.`timestamp` DESC");
$guestData = DAS::quickQuery($guestData);
$guestStatus = new Query("COUNT(`id`) AS `sumHit`, COUNT(DISTINCT `date`) AS `sumDate`, COUNT(DISTINCT `coordinate`) AS `sumCoord`", "`tb_vcs_guest`", "", "`guestID` = '" . trim($_GET['gid']) . "'");
$guestStatus = DAS::quickQuery($guestStatus);
$reserveData = new Query("*", "`tb_mingju_reserves`", "", "`gid` = '" . trim($_GET['gid']) . "'", "`timestamp` DESC");
$reserveData = DAS::quickQuery($reserveData);

$hitCoords = new Query("`coordinate`, COUNT(*) AS `sumCoord`, MAX(`timestamp`) AS `lastTimestamp`", "`tb_vcs_guest`", "", "`coordinate` IS NOT NULL AND `guestID` = '" . trim($_GET['gid']) . "'", "id DESC", "`coordinate`");
$hitCoords = DAS::quickQuery($hitCoords);

?>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
<div id="content" class="col-lg-14 col-sm-14">
  <div>
    <ul class="breadcrumb">
      <li>
        <h4>GID： <?php echo trim($_GET['gid']);?></h4>
      </li>
    </ul>
  </div>
  <div class="row">
    <div class="box col-md-3">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2>访问统计</h2>
        </div>
        <div class="box-content" style="height:520px;">
          <table>
            <tr>
              <td>访问次数：</td>
              <td><?php echo $guestStatus['data'][0]['sumHit'];?></td>
            </tr>
            <tr>
              <td>访问天数：</td>
              <td><?php echo $guestStatus['data'][0]['sumDate'];?></td>
            </tr>
            <tr>
              <td>预约次数：</td>
              <td><?php echo count($reserveData['data']);?></td>
            </tr>
            <tr>
              <td>最后访问时间：</td>
              <td><?php echo $guestData['data'][0]['timestamp'];?></td>
            </tr>
            <tr>
              <td colspan="2">最后访问页面：</td>
            </tr>
            <tr>
              <td colspan="2"><?php echo '<a href="http://' . rawurldecode(rawurldecode($guestData['data'][0]['hitSite'])) . '" title = "' . rawurldecode(rawurldecode($guestData['data'][0]['hitSite'])) . '">' . (strlen(rawurldecode(rawurldecode($guestData['data'][0]['hitSite']))) > 40 ? substr(rawurldecode(rawurldecode($guestData['data'][0]['hitSite'])), 0, 40) . '...' : rawurldecode(rawurldecode($guestData['data'][0]['hitSite']))) . '</a>';?></td>
            </tr>
            <tr>
              <td>最后访问IP：</td>
              <td><?php echo $guestData['data'][0]['ip'];?></td>
            </tr>            
            <tr>
              <td>最后访问区域：</td>
              <td><?php echo rawurldecode($guestData['data'][0]['region']);?></td>
            </tr>           
            <tr>
              <td>网络运营商：</td>
              <td title="<?php echo rawurldecode($guestData['data'][0]['userAgent']);?>"><?php echo $guestData['data'][0]['isp'];?></td>
            </tr>
            <tr>
              <td>地理位置收集：</td>
              <td><?php echo $guestStatus['data'][0]['sumCoord'];?></td>
            </tr>
            <tr>
              <td>客户端设备：</td>
              <td title="<?php echo rawurldecode($guestData['data'][0]['userAgent']);?>"></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    <div class="box col-md-9">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2>访客地理位置信息</h2>
        </div>
        <div class="box-content">
          <div class="box-content">
            <div id="container" style="width:100%; height: 480px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2>浏览记录</h2>
        </div>
        <div class="box-content">
          <div class="box-content">
            <table>
              <thead>
                <tr>
                  <th>访问时间</th> 
                  <th>访问页面</th> 
                  <th>访问区域</th> 
                  <th>地理位置</th> 
                  <th>访问IP</th>                                    
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="box col-md-12">
      <div class="box-inner">
        <div class="box-header well" data-original-title="">
          <h2>预约记录</h2>
        </div>
        <div class="box-content">
          <div class="box-content">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" language="javascript">
<!--//
var map = new AMap.Map('container');
<?php
if (DAS::hasData($hitCoords)) {
    $hitCoords = $hitCoords['data'];
    for ($i = 0; $i < count($hitCoords); $i++) {
        echo 'var marker' . $i . ' = new AMap.Marker({position: [' . $hitCoords[$i]['coordinate'] . '], title: "共' . $hitCoords[$i]['sumCoord'] . '次, 最后访问：' . $hitCoords[$i]['lastTimestamp'] . '", zIndex: 100});';
        echo 'map.add(marker' . $i . ');';
    }
}

?>
//-->
</script>

<?php require_once('vcs_bottom.inc');?>