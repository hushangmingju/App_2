<?php 
require_once('vcs_header.php');

$condition = '';
if (isset($_GET['site']) && $_GET['site'] != '') {
    if (rawurldecode($_GET['site']) == 'main') {
        $pageIDs = DAS::isExistedInDB("`tb_vcs_pages`", "`folder` IN ('root', 'mobile')", "`id`");
        $condition = " AND `pageID` IN (" . $pageIDs . ")";
    }
    elseif (rawurldecode($_GET['site']) != 'all') {
        $pageIDs = DAS::isExistedInDB("`tb_vcs_pages`", "`folder` = '" . rawurldecode($_GET['site']) . "'", "`id`");
        $condition = " AND `pageID` IN (" . $pageIDs . ")";
    }
}

$currentDayIndex = (isset($_GET['d']) && is_int(intval($_GET['d'])) && intval($_GET['d']) > 0) ? intval($_GET['d']) : 0;
$currentPageIndex = (isset($_GET['p']) && is_int(intval($_GET['p'])) && intval($_GET['p']) > 0) ? intval($_GET['p']) : 0;

$hitByDay = new Query("COUNT(`id`) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, `date`, (DAYOFWEEK(`date`) - 1) AS `day`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0" . $condition, "`date` DESC", "`date`", 30);
$hitByDay = DAS::quickQuery($hitByDay);

$dateConcat = '';

if (DAS::hasData($hitByDay)){
  foreach($hitByDay['data'] as $hitByDayData){
    $dateConcat .= '"' . $hitByDayData['date'] . '",';
  }
  $dateConcat = substr($dateConcat, 0, (strlen($dateConcat) - 1));
}

$spiderByDay = new Query("COUNT(*) AS `sumSpider`, `date`", "`tb_vcs_guest`", "", "`isSpider` = 1 AND `date` IN (" . $dateConcat . ")" . $condition, "`date` DESC", "`date`");
$spiderByDay = DAS::quickQuery($spiderByDay);
$reserveByday = new Query("COUNT(`id`) AS `sumReserve`, COUNT(DISTINCT `gid`) AS `sumRsvGID`, COUNT(DISTINCT `tel`) AS `sumTel`, `date`", "`tb_mingju_reserves`", "", "`status` = 'ok' AND `date` IN (" . $dateConcat . ")" . $condition, "`timestamp` DESC", "`date`");
$reserveByday = DAS::quickQuery($reserveByday);




$dataByDay = false;

if(DAS::hasData($hitByDay)){
  $dataByDay = $hitByDay['data'];
  for($i = 0; $i < count($dataByDay); $i++){
    $dataByDay[$i]['sumRsv'] = 0;
    $hitByDay['data'][$i]['sumRsv'] = 0;
    $dataByDay[$i]['sumRsvGID'] = 0;
    $hitByDay['data'][$i]['sumRsvGID'] = 0;
    $dataByDay[$i]['sumRsvTel'] = 0;
    $hitByDay['data'][$i]['sumRsvTel'] = 0;
    if(DAS::hasData($reserveByday)){
      for($j = 0; $j < count($reserveByday['data']); $j++){
        if($dataByDay[$i]['date'] == $reserveByday['data'][$j]['date']){
          $dataByDay[$i]['sumRsv'] = $reserveByday['data'][$j]['sumReserve'];
          $dataByDay[$i]['sumRsvGID'] = $reserveByday['data'][$j]['sumRsvGID'];
          $dataByDay[$i]['sumRsvTel'] = $reserveByday['data'][$j]['sumTel'];
          $hitByDay['data'][$i]['sumRsv'] = $reserveByday['data'][$j]['sumReserve'];
          $hitByDay['data'][$i]['sumRsvGID'] = $reserveByday['data'][$j]['sumRsvGID'];
          $hitByDay['data'][$i]['sumRsvTel'] = $reserveByday['data'][$j]['sumTel'];
        }
      }
    }
  }
}



$hitToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, HOUR(TIME(`timestamp`)) AS `hour`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())" . $condition, "`timestamp` DESC", "HOUR(TIME(`timestamp`))");
$hitToday = DAS::quickQuery($hitToday);
$spiderToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, HOUR(TIME(`timestamp`)) AS `hour`", "`tb_vcs_guest`", "", "`isSpider` = 1 AND `timestamp` > DATE(NOW())" . $condition, "`timestamp` DESC", "HOUR(TIME(`timestamp`))");
$spiderToday = DAS::quickQuery($spiderToday);
if (!isset($_GET['site']) || $_GET['site'] == '' || $_GET['site'] == 'all'){
    $hitInPieToday = new Query("COUNT(`t1`.`id`) AS `sumHitPoint`, COUNT(DISTINCT `t1`.`guestID`) AS `sumGID`, COUNT(DISTINCT `t1`.`ip`) AS `sumIP`, `t2`.`folder` AS `site`", "`tb_vcs_guest` AS `t1`", "LEFT JOIN `tb_vcs_pages` AS `t2` ON `t1`.`pageID` = `t2`.`id`", "`t1`.`isSpider` = 0 AND `t1`.`isRedirect` = 0 AND `t1`.`timestamp` > DATE(NOW())", "", "`t2`.`folder`");
}
else if($_GET['site'] == 'main'){
    $hitInPieToday = new Query("COUNT(`t1`.`id`) AS `sumHitPoint`, COUNT(DISTINCT `t1`.`guestID`) AS `sumGID`, COUNT(DISTINCT `t1`.`ip`) AS `sumIP`, `t2`.`folder` AS `site`", "`tb_vcs_guest` AS `t1`", "LEFT JOIN `tb_vcs_pages` AS `t2` ON `t1`.`pageID` = `t2`.`id`", "`t1`.`isSpider` = 0 AND `t1`.`isRedirect` = 0 AND `t1`.`timestamp` > DATE(NOW())" . $condition, "", "`t2`.`folder`");
}
else{
    $hitInPieToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, `pageFile` AS `page`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())" . $condition, "`sumGID` DESC", "`pageID`");
}
$hitInPieToday = DAS::quickQuery($hitInPieToday);

$pageHitToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, `pageFile` AS `page`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())" . $condition, "`sumGID` DESC", "`pageID`");
$pageHitToday = DAS::quickQuery($pageHitToday, '', 10, $currentPageIndex);

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
        <div>有效点击</div>
        <div><?php echo ($dataByDay ? $dataByDay[0]['sumHitPoint'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="4 new pro members." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user red"></i>
        <div>访问人数</div>
        <div><?php echo ($dataByDay ? $dataByDay[0]['sumGID'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="#">
        <i class="glyphicon glyphicon-globe red"></i>
        <div>访问IP数</div>
        <div><?php echo ($dataByDay ? $dataByDay[0]['sumIP'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-time green"></i>
        <div>预约次数</div>
        <div><?php echo ($dataByDay ? $dataByDay[0]['sumRsv'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user green"></i>
        <div>预约人数</div>
        <div><?php echo ($dataByDay ? $dataByDay[0]['sumRsvGID'] : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user yellow"></i>
        <div>爬虫次数</div>
        <div><?php echo (DAS::hasData($spiderByDay) ? $spiderByDay['data'][0]['sumSpider'] : '获取数据失败');?></div>
      </a>
    </div>
  </div>
</div>
<div class="row">
  <div class="box col-md-4">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>日访问统计表</h2>
      </div>
      <div class="box-content">
        <div id="HIT_STATUS_BY_HOUR" style="height: 320px;"></div>
        <?php
        $vcsHTHit = '';
        if(DAS::hasData($hitToday)){
          for ($i = 23; $i >= 0; $i--){
              $tempVcsHTHit = $vcsHTHit;
              foreach ($hitToday['data'] as $hitTodayData){
                  if ($hitTodayData['hour'] == $i){
                      $vcsHTHit .= $hitTodayData['sumHitPoint'];
                  }
              }
              $vcsHTHit .= $tempVcsHTHit == $vcsHTHit ? '0' : '';
              $vcsHTHit .= $i > 0 ? ',' : '';
          }
        }
        ?>
        <script type="text/javascript" language="javascript">
        <!--//
        var hsbhChart = echarts.init(document.getElementById("HIT_STATUS_BY_HOUR"));
        var option = {
            title: {
                text: "",
                subtext: ""
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
            },
            legend: {
                data:["有效点击"]
            },
            grid: {
                left: 100
            },
            xAxis: {
                type: 'value',
                boundaryGap: [0, 0.01]
            },
            yAxis: {
                type: 'category',
                scale: true,
                name: "时间",
                data: ["23:00", "22:00", "21:00", "20:00", "19:00", "18:00", "17:00", "16:00", "15:00", "14:00", "13:00", "12:00", "11:00", "10:00", "9:00", "8:00", "7:00", "6:00", "5:00", "4:00", "3:00", "2:00", "1:00", "0:00"]
            },
            series:{
                name: "有效点击",
                type: 'bar',
                data: [<?php echo $vcsHTHit;?>]
            }
        };
        hsbhChart.setOption(option);
        //-->
        </script>
      </div>
    </div>
  </div>
  <div class="box col-md-4">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>日爬虫统计表</h2>
      </div>
      <div class="box-content">
        <div id="SPIDER_STATUS_BY_HOUR" style="height: 320px;"></div>
        <?php
        $vcsHTSpider = '';
        if(DAS::hasData($spiderToday)){
          for ($i = 23; $i >= 0; $i--){
              $tempVcsHTSpider = $vcsHTSpider;
              foreach ($spiderToday['data'] as $spiderTodayData){
                  if ($spiderTodayData['hour'] == $i){
                      $vcsHTSpider .= $spiderTodayData['sumHitPoint'];
                  }
              }
              $vcsHTSpider .= $tempVcsHTSpider == $vcsHTSpider ? '0' : '';
              $vcsHTSpider .= $i > 0 ? ',' : '';
          }
        }
        ?>
        <script type="text/javascript" language="javascript">
        <!--//
        var ssbhChart = echarts.init(document.getElementById("SPIDER_STATUS_BY_HOUR"));
        var option = {
            color: ['#3398DB'],
            title: {
                text: "",
                subtext: ""
            },
            tooltip: {
                trigger: 'axis'
            },
            toolbox: {
            },
            legend: {
                data:["爬虫次数"]
            },
            grid: {
                left: 100
            },
            xAxis: {
                type: 'value',
                boundaryGap: [0, 0.01]
            },
            yAxis: {
                type: 'category',
                scale: true,
                name: "时间",
                data: ["23:00", "22:00", "21:00", "20:00", "19:00", "18:00", "17:00", "16:00", "15:00", "14:00", "13:00", "12:00", "11:00", "10:00", "9:00", "8:00", "7:00", "6:00", "5:00", "4:00", "3:00", "2:00", "1:00", "0:00"]
            },
            series:{
                name: "爬虫次数",
                type: 'bar',
                data: [<?php echo $vcsHTSpider;?>]
            }
        };
        ssbhChart.setOption(option);
        //-->
        </script>
      </div>
    </div>
  </div>
  <div class="box col-md-4">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>分站日访问统计表</h2>
      </div>
      <div class="box-content">
        <div id="SITE_STATUS_IN_PIE" style="height: 320px;"></div>
        <?php
        $legendStr = '';
        $seriesStr = '';
        $siteCnames = new Query("siteCname, folder", "tb_vcs_pages", "", "1", "", "folder");
        $siteCnames = DAS::quickQuery($siteCnames);
        $siteCname = array();
        foreach ($siteCnames['data'] as $siteCnametmp){
            $siteCname[$siteCnametmp['folder']] = $siteCnametmp['siteCname'];
        }
        
        $hitInPieToday = DAS::hasData($hitInPieToday) ? $hitInPieToday['data'] : false;
        if($hitInPieToday){
          for($i = 0; $i < count($hitInPieToday); $i++){
            if(!isset($_GET['site']) || $_GET['site'] == '' || $_GET['site'] == 'all' || $_GET['site'] == 'main'){
                $legendStr .= '"' . $siteCname[$hitInPieToday[$i]['site']] . '"';
                $seriesStr .= '{value:' . $hitInPieToday[$i]['sumGID'] . ', name:"' . $siteCname[$hitInPieToday[$i]['site']] . '"}';
            }
            else{
                $legendStr .= '"' . $hitInPieToday[$i]['page'] . '"';
                $seriesStr .= '{value:' . $hitInPieToday[$i]['sumGID'] . ', name:"' . $hitInPieToday[$i]['page'] . '"}';
            }             
            $legendStr .= $i < count($hitInPieToday) - 1 ? ',' : '';  
            $seriesStr .= $i < count($hitInPieToday) - 1 ? ',' : '';
          }
        }
        ?>
        <script type="text/javascript" language="javascript">
        <!--//
        var ssipChart = echarts.init(document.getElementById("SITE_STATUS_IN_PIE"));
        option = {
            title : {
                text: "",
                subtext: "",
                x:"center"
            },
            tooltip : {
                trigger: "item",
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                //orient: "vertical",
                //left: "left",
                data: [<?php echo $legendStr;?>]
            },
            series : [{
                name: "分站访问",
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[<?php echo $seriesStr;?>],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };
        ssipChart.setOption(option);
        //-->
        </script>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>阶段访问统计表：</h2>
      </div>
      <div class="box-content">
        <?php
        if($dataByDay){
          $vcsHCDate = '';
          $vcsHCHit = '';
          $vcsHCGID = '';
          $vcsHCIP = '';
          $vcsHCSpider = '';
          $vcsHCReserve = '';
          $vcsHCRsvProz = '';
          $vcsHitChartsCount = count($dataByDay);
          $dataByDay = array_reverse($dataByDay);
          for($i = 0; $i < $vcsHitChartsCount; $i++){
            $vcsHCdate .= '"' . $dataByDay[$i]['date'] . ' 周' . $week[$dataByDay[$i]['day']] . '"';
            $vcsHCdate .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCHit .= $dataByDay[$i]['sumHitPoint'];
            $vcsHCHit .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCGID .= $dataByDay[$i]['sumGID'];
            $vcsHCGID .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCIP .= $dataByDay[$i]['sumIP'];
            $vcsHCIP .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCSpider .= $dataByDay[$i]['sumSpider'];
            $vcsHCSpider .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCReserve .= $dataByDay[$i]['sumRsvGID'];
            $vcsHCReserve .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCRsvProz .= (($dataByDay[$i]['sumRsvGID']) / $dataByDay[$i]['sumGID']) * 100;
            $vcsHCRsvProz .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
          }
        }
        ?>
        <div id="main" style="height: 300px;"></div>
        <script type="text/javascript" language="javascript">
        <!--//
        var myChart = echarts.init(document.getElementById("main"));
        var option = {
            title: {
                text: "近30日网站访问数据图表",
                //subtext: "整站数据，分类访问数据请进入点击数据页面查询"
            },
            tooltip: {
            },
            toolbox: {
                show: true,
                feature: {
                    dataView: {readOnly: false}
                }
            },
            legend: {
                data:["预约转换率", "人数", "IP数", "预约人数"]
            },
            xAxis: {
                data: [<?php echo $vcsHCdate;?>]
            },
            yAxis: [
                {
                    type: "value",
                    scale: true,
                    name: "访问量",
                },
                {
                    type: "value",
                    scale: true,
                    name: "转换率",
                }
            ],
            series: [
               /*
                {
                    name: "有效点击",
                    type: 'bar',
                    data: [<?php echo $vcsHCHit;?>]
                },*/
                {
                    name: "人数",
                    type: 'bar',
                    data: [<?php echo $vcsHCGID;?>]
                },
                {
                    name: "IP数",
                    type: 'bar',
                    data: [<?php echo $vcsHCIP;?>]
                },
                {
                    name: "预约人数",
                    type: 'bar',
                    data: [<?php echo $vcsHCReserve;?>]
                },
                {
                    yAxisIndex: 1,
                    name: "预约转换率",
                    type: 'line',
                    data: [<?php echo $vcsHCRsvProz;?>]
                }
            ]
        };
        myChart.setOption(option);
        //-->
        </script>
        <table class="table table-striped table-bordered responsive">
          <thead>
            <tr>
              <th>日期</th>
              <th>有效点击</th>
              <th>访问人数</th>
              <th>访问IP数</th>
              <th>爬虫次数</th>
              <th>预约人数</th>
              <th>提交电话数</th>
              <th>预约次数</th>
            </tr>
          </thead>
          <tbody>    						
            <?php
            if (DAS::hasData($hitByDay) && DAS::hasData($spiderByDay)){
                $hitByDay = DAS::morePages($hitByDay, 10, $currentDayIndex);
                $spiderByDay = DAS::morePages($spiderByDay, 10, $currentDayIndex);
                for ($i = 0; $i < count($hitByDay['data']); $i++){
                    echo '<tr>';
                    echo '<td>' . $hitByDay['data'][$i]['date'] . ' 周' . $week[$hitByDay['data'][$i]['day']] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumHitPoint'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumGID'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumIP'] . '</td>';
                    echo '<td>' . $spiderByDay['data'][$i]['sumSpider'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumRsvGID'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumRsvTel'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumRsv'] . '</td>';
                    echo '</tr>';
                }                
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
          if (DAS::hasData($hitByDay)){
            for ($i = 0; $i < $hitByDay['NUM_PAGES']; $i++){
              if ($hitByDay['INDEX_PAGE'] == ($i + 1)){
                echo ($i + 1) . '&nbsp;&nbsp;';
              }
              else{
                echo '<a href="?d=' . ($i + 1) . '">' . ($i + 1) . '</a>&nbsp;&nbsp;';
              }
            }
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
        <h2>页面访问日排名</h2>
      </div>
      <div class="box-content">
        <table class="table table-striped table-bordered responsive">
          <thead>
            <tr>
              <th>排序</th>
              <th>页面名称</th>
              <th>页面URL</th>
              <th>点击次数</th>
              <th>访问人数</th>
              <th>访问IP数</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (DAS::hasData($pageHitToday)){
              $pageHitTodayData = $pageHitToday['data'];
              for($i = 0; $i < count($pageHitTodayData); $i++){
                  echo '<tr>';
                  echo '<td>' . ($i + 1) . '</td>';
                  echo '<td>' . $pageHitTodayData[$i]['page'] . '</td>';
                  echo '<td><a href="http://www.mingjugroup.com/' . $pageHitTodayData[$i]['page'] . '" target="_blank">http://www.mingjugroup.com/' . $pageHitTodayData[$i]['page'] . '</a></td>';
                  echo '<td>' . $pageHitTodayData[$i]['sumHitPoint'] . '</td>';
                  echo '<td>' . $pageHitTodayData[$i]['sumGID'] . '</td>';
                  echo '<td>' . $pageHitTodayData[$i]['sumIP'] . '</td>';
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
          if (DAS::hasData($pageHitToday)){
            for ($i = 0; $i < $pageHitToday['NUM_PAGES']; $i++){
              if ($pageHitToday['INDEX_PAGE'] == ($i + 1)){
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