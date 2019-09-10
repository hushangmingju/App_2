<?php 
require_once('vcs_header.php');
// SELECT COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP` FROM `tb_vcs_guest` WHERE `isSpider` = 0 AND `isRedirect` = 0
// SELECT COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, DATE(`timestamp`) AS `date` FROM `tb_vcs_guest` WHERE `isSpider` = 0 AND `isRedirect` = 0 GROUP BY DATE(`timestamp`)
// SELECT `userAgent`, COUNT(*) AS `count` FROM `tb_vcs_guest` WHERE `isSpider` = 1 GROUP BY `userAgent` ORDER BY `count` DESC
// SELECT `hitSite`, COUNT(*) AS `count`, COUNT(DISTINCT `guestID`) AS `sumGuest`, COUNT(DISTINCT `ip`) AS `sumIP` FROM `tb_vcs_guest` WHERE `isSpider` = 0 AND `isRedirect` = 0 GROUP BY `hitSite` ORDER BY `count` DESC
// SELECT `type`, `bultin`, `url`, `gid`, FROM_UNIXTIME(`time`) AS `timestamp` FROM `yuyue` WHERE `time` >= UNIX_TIMESTAMP(DATE(NOW())) GROUP BY `gid` 
// SELECT COUNT(*) AS `count`, COUNT(DISTINCT `gid`) AS `sumGID` FROM `yuyue` WHERE `time` >= UNIX_TIMESTAMP(DATE(NOW()))
// SELECT COUNT(*) AS `count`, `guestID` FROM `tb_vcs_guest` WHERE `isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW()) GROUP BY `guestID` ORDER BY `count` DESC
//$sumHitPoint =  

$condition = '';
$rsvToday = false;

if (isset($_GET['site']) && $_GET['site'] != '' && $_GET['site'] != 'all') {
    if (rawurldecode($_GET['site']) == 'main') {
        $condition = " AND `pageID` IN (" . DAS::isExistedInDB("`tb_vcs_pages`", "`folder` IN ('root', 'mobile')", "`id`") . ")";
    }
    else {
        $condition = " AND `pageID` IN (" . DAS::isExistedInDB("`tb_vcs_pages`", "`folder` = '" . rawurldecode($_GET['site']) . "'", "`id`") . ")";
    }
}

$rsvToday = new Query("COUNT(DISTINCT `gid`) AS `sumRsvGID`, COUNT(DISTINCT `tel`) AS `sumTel`", "`tb_mingju_reserves`", "", "`status` = 'ok' AND `date` = '" . date('Y-m-d') . "'" . $condition);    
$rsvToday = DAS::quickQuery($rsvToday); 

$gidToday = new Query("COUNT(DISTINCT `guestID`) AS `sumGID`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())" . $condition);
$gidToday = DAS::quickQuery($gidToday);

$revisitToday = new Query("`guestID`, COUNT(*) AS `sumHit`, MAX(`timestamp`) AS `lastTimestamp`, COUNT(DISTINCT `date`) AS `sumDate`, COUNT(DISTINCT `coordinate`) AS `sumCoord`, `region`, `isp`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0" . $condition, "", "`guestID` HAVING `sumDate` > 1 AND `lastTimestamp` > DATE(NOW())");
$revisitToday = DAS::quickQuery($revisitToday);

$coodToday = new Query("COUNT(DISTINCT `guestID`) AS `sumCoordGID`", "`tb_vcs_guest`", "", "`coordinate` IS NOT NULL AND `timestamp` > DATE(NOW())" . $condition);
$coodToday = DAS::quickQuery($coodToday);

$regionToday = new Query("COUNT(DISTINCT `guestID`) AS `sumRegionGID`", "`tb_vcs_guest`", "", "`region` IS NOT NULL AND `timestamp` > DATE(NOW())" . $condition);
$regionToday = DAS::quickQuery($regionToday);

$glPage = (isset($_GET['g']) && is_int(intval($_GET['g'])) && intval($_GET['g']) > 0) ? intval($_GET['g']) : 0;
$gidList = new Query("`guestID`, COUNT(`id`) AS `sumHit`, COUNT(DISTINCT `date`) AS `sumDate`, COUNT(`coordinate`) AS `sumCoord`, MAX(`id`) AS `lastId`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0" . $condition, "`timestamp` DESC", "`guestID`");
$gidList = DAS::divisionPages($gidList, '', 20, $glPage);

SGF::eventLog('gidlist', 1, 'NUM_PAGES: ' . $gidList['NUM_PAGES'] . '; NUM_DATA: ' . $gidList['NUM_DATA']);
?>
<div id="content" class="col-lg-14 col-sm-14">
  <div>
    <ul class="breadcrumb">
      <li>
        <h4>今日数据：</h4>
      </li>
    </ul>
  </div>
  <div class="row">  
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="6 new members." class="well top-block" href="#">
        <i class="glyphicon glyphicon-hand-down red"></i>
        <div>访问人数</div>
        <div><?php echo (DAS::hasData($gidToday) ? $gidToday['data'][0]['sumGID'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user red"></i>
        <div>预约人数</div>
        <div><?php echo (DAS::hasData($rsvToday) ? $rsvToday['data'][0]['sumRsvGID'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
        <i class="glyphicon glyphicon-globe red"></i>
        <div>电话提交</div>
        <div><?php echo (DAS::hasData($rsvToday) ? $rsvToday['data'][0]['sumTel'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-time green"></i>
        <div>回访人数</div>
        <div><?php echo (DAS::hasData($revisitToday) ? count($revisitToday['data']) : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user green"></i>
        <div>坐标定位</div>
        <div><?php echo (DAS::hasData($coodToday) ? $coodToday['data'][0]['sumCoordGID'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user yellow"></i>
        <div>区域定位</div>
        <div><?php echo (DAS::hasData($regionToday) ? $regionToday['data'][0]['sumRegionGID'] : '获取数据失败');?></div>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>访问记录</h2>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered responsive">
          <thead>
            <tr>
              <th>GID</th>
              <th>最新访问页面</th>
              <th>最新访问时间</th>
              <th>访问次数</th>
              <th>访问天数</th>
              <th>所在区域</th>
              <th>运营商</th>
              <th>坐标信息</th>
              <th>IP地址</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (DAS::hasData($gidList)) {
                $gidListData = $gidList['data'];
                $gidLastIDs = '';
                for ($i = 0; $i < count($gidListData); $i++) {
                    $gidLastIDs .= $gidListData[$i]['lastId'] . ',';
                }
                $gidLastIDs = substr($gidLastIDs, 0, (strlen($gidLastIDs) - 1));
                $gidLastData = new Query("`id`, `hitSite`, `timestamp`, `region`, `isp`, `ip`", "`tb_vcs_guest`", "", "`id` IN (" . $gidLastIDs . ")");
                $gidLastData = DAS::quickQuery($gidLastData);
                for ($i = 0; $i < count($gidListData); $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < count($gidLastData['data']); $j++) {
                        if ($gidLastData['data'][$j]['id'] == $gidListData[$i]['lastId']) {
                            echo '<td><a href="vcs_gid.html?gid=' . $gidListData[$i]['guestID'] . '" target="_blank">' . $gidListData[$i]['guestID'] . '</td>';
                            echo '<td><a href="http://' . rawurldecode(rawurldecode($gidLastData['data'][$j]['hitSite'])) . '" title="http://' . rawurldecode(rawurldecode($gidLastData['data'][$j]['hitSite'])) . '" target="_blank">' . (strlen(rawurldecode(rawurldecode($gidLastData['data'][$j]['hitSite']))) > 32 ? substr(rawurldecode(rawurldecode($gidLastData['data'][$j]['hitSite'])), 0, 32) . '...' : rawurldecode(rawurldecode($gidLastData['data'][$j]['hitSite']))) . '</a></td>';
                            echo '<td>' . $gidLastData['data'][$j]['timestamp'] . '</td>';
                            echo '<td>' . $gidListData[$i]['sumHit'] . '</td>';
                            echo '<td>' . $gidListData[$i]['sumDate'] . '</td>';
                            echo '<td>' . rawurldecode($gidLastData['data'][$j]['region']) . '</td>';
                            echo '<td>' . rawurldecode($gidLastData['data'][$j]['isp']) . '</td>';
                            echo '<td>' . $gidListData[$i]['sumCoord'] . '</td>';
                            echo '<td>' . $gidLastData['data'][$j]['ip'] . '</td>';
                        }
                    }
                    echo '</tr>';
                }
            }
            else {
                echo "<tr><td colspan=8>没有访问数据。</td></tr>";
            }
            ?>
          </tbody>
        </table>
        <style>
          .xpage{display:inline;white-space: nowrap;}
          .xpage li{margin:3px;display:inline-block;list-style-type:none;}
        </style>
        <ul class="xpage">
          <?php
          if (DAS::hasData($gidList)){
            listPageIndex($gidList['NUM_PAGES'], 10, 'g');
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>今日回访客户</h2>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered responsive">
          <thead>
            <tr>
              <th>GID</th>
              <th>最新访问时间</th>
              <th>访问次数</th>
              <th>访问天数</th>
              <th>所在区域</th>
              <th>运营商</th>
              <th>位置信息</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (DAS::hasData($revisitToday)){
              $revisitListData = $revisitToday['data'];
              for($i = 0; $i < count($revisitListData); $i++){
                  echo '<tr>';
                  echo '<td><a href="vcs_gid.html?gid=' . $revisitListData[$i]['guestID'] . '" target="_blank">' . $revisitListData[$i]['guestID'] . '</td>';
                  echo '<td>' . $revisitListData[$i]['lastTimestamp'] . '</td>';
                  echo '<td>' . $revisitListData[$i]['sumHit'] . '</td>';
                  echo '<td>' . $revisitListData[$i]['sumDate'] . '</td>';
                  echo '<td>' . rawurldecode($revisitListData[$i]['region']) . '</td>';
                  echo '<td>' . rawurldecode($revisitListData[$i]['isp']) . '</td>';
                  echo '<td>' . $revisitListData[$i]['sumCoord'] . '</td>';
                  echo '</tr>';
              }
            }
            else{
              echo "<tr><td colspan=6>没有访问数据。</td></tr>";
            }
            ?>
          </tbody>
        </table>
        <style>
          .xpage{display:inline;white-space: nowrap;}
          .xpage li{margin:3px;display:inline-block;list-style-type:none;}
        </style>
        <ul class="xpage">
          <?php
          if (DAS::hasData($revisitToday)){
            for ($i = 0; $i < $revisitToday['NUM_PAGES']; $i++){
              if ($revisitToday['INDEX_PAGE'] == ($i + 1)){
                echo ($i + 1) . '&nbsp;&nbsp;';
              }
              else{
                echo '<a href="?p=' . ($i + 1) . '">' . ($i + 1) . '</a>&nbsp;&nbsp;';
              }
            }
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php require_once('vcs_bottom.inc');?>