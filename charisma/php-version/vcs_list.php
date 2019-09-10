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
$currentDayIndex = (isset($_GET['d']) && is_int(intval($_GET['d'])) && intval($_GET['d']) > 0) ? intval($_GET['d']) : 0;
$currentPageIndex = (isset($_GET['p']) && is_int(intval($_GET['p'])) && intval($_GET['p']) > 0) ? intval($_GET['p']) : 0;

$hitByDay = new Query("COUNT(`id`) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, `date`, (DAYOFWEEK(`date`) - 1) AS `day`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0", "`date` DESC", "`date`", 30);
$hitByDay = DAS::quickQuery($hitByDay);

$dateConcat = '';

if (DAS::hasData($hitByDay)){
  foreach($hitByDay['data'] as $hitByDayData){
    $dateConcat .= '"' . $hitByDayData['date'] . '",';
  }
  $dateConcat = substr($dateConcat, 0, (strlen($dateConcat) - 1));
}

$spiderByDay = new Query("COUNT(*) AS `sumSpider`, `date`", "`tb_vcs_guest`", "", "`isSpider` = 1 AND `date` IN (" . $dateConcat . ")", "`date` DESC", "`date`");
$spiderByDay = DAS::quickQuery($spiderByDay);
$reserveByday = new Query("COUNT(`id`) AS `sumReserve`, COUNT(DISTINCT `gid`) AS `sumRsvGID`, COUNT(DISTINCT `tel`) AS `sumTel`, `date`", "`yuyue`", "", "`status` = 'ok' AND `date` IN (" . $dateConcat . ")", "`time` DESC", "`date`");
$reserveByday = DAS::quickQuery($reserveByday);
$reserveExpoByday = new Query("COUNT(`id`) AS `sumReserve`, COUNT(DISTINCT `gid`) AS `sumRsvGID`, COUNT(DISTINCT `tel`) AS `sumTel`, `date`", "`tb_expo_yuyue`", "", "`status` = 'ok' AND `date` IN (" . $dateConcat . ")", "`timestamp` DESC", "`date`");
$reserveExpoByday = DAS::quickQuery($reserveExpoByday);
$reserveZZByday = new Query("COUNT(`id`) AS `sumReserve`, COUNT(DISTINCT `gid`) AS `sumRsvGID`, COUNT(DISTINCT `tel`) AS `sumTel`, `date`", "`tb_zz_yuyue`", "", "`status` = 'ok' AND `date` IN (" . $dateConcat . ")", "`timestamp` DESC", "`date`");
$reserveZZByday = DAS::quickQuery($reserveZZByday);

$dataByDay = false;

if(DAS::hasData($hitByDay)){
  $dataByDay = $hitByDay['data'];
  for($i = 0; $i < count($dataByDay); $i++){
    $dataByDay[$i]['sumRsv'] = 0;
    $hitByDay['data'][$i]['sumRsv'] = 0;
    $dataByDay[$i]['sumExpoRsv'] = 0;
    $dataByDay[$i]['sumZZRsv'] = 0;
    $hitByDay['data'][$i]['sumExpoRsv'] = 0;
    $hitByDay['data'][$i]['sumZZRsv'] = 0;
    $dataByDay[$i]['sumRsvGID'] = 0;
    $hitByDay['data'][$i]['sumRsvGID'] = 0;
    $dataByDay[$i]['sumExpoRsvGID'] = 0;
    $dataByDay[$i]['sumZZRsvGID'] = 0;
    $hitByDay['data'][$i]['sumExpoRsvGID'] = 0;
    $hitByDay['data'][$i]['sumZZRsvGID'] = 0;
    $dataByDay[$i]['sumRsvTel'] = 0;
    $hitByDay['data'][$i]['sumRsvTel'] = 0;
    $dataByDay[$i]['sumExpoRsvTel'] = 0;
    $dataByDay[$i]['sumZZRsvTel'] = 0;
    $hitByDay['data'][$i]['sumExpoRsvTel'] = 0;
    $hitByDay['data'][$i]['sumZZRsvTel'] = 0;
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
    if(DAS::hasData($reserveExpoByday)){
      for($k = 0; $k < count($reserveExpoByday['data']); $k++){
        if($dataByDay[$i]['date'] == $reserveExpoByday['data'][$k]['date']){
          $dataByDay[$i]['sumExpoRsv'] = $reserveExpoByday['data'][$k]['sumReserve'];
          $dataByDay[$i]['sumExpoRsvGID'] = $reserveExpoByday['data'][$k]['sumRsvGID'];
          $dataByDay[$i]['sumExpoRsvTel'] = $reserveExpoByday['data'][$k]['sumTel'];
          $hitByDay['data'][$i]['sumExpoRsv'] = $reserveExpoByday['data'][$k]['sumReserve'];
          $hitByDay['data'][$i]['sumExpoRsvGID'] = $reserveExpoByday['data'][$k]['sumRsvGID'];
          $hitByDay['data'][$i]['sumExpoRsvTel'] = $reserveExpoByday['data'][$k]['sumTel'];
        }
      }
    }
    if(DAS::hasData($reserveZZByday)){
      for($k = 0; $k < count($reserveZZByday['data']); $k++){
        if($dataByDay[$i]['date'] == $reserveZZByday['data'][$k]['date']){
          $dataByDay[$i]['sumZZRsv'] = $reserveZZByday['data'][$k]['sumReserve'];
          $dataByDay[$i]['sumZZRsvGID'] = $reserveZZByday['data'][$k]['sumRsvGID'];
          $dataByDay[$i]['sumZZRsvTel'] = $reserveZZByday['data'][$k]['sumTel'];
          $hitByDay['data'][$i]['sumZZRsv'] = $reserveZZByday['data'][$k]['sumReserve'];
          $hitByDay['data'][$i]['sumZZRsvGID'] = $reserveZZByday['data'][$k]['sumRsvGID'];
          $hitByDay['data'][$i]['sumZZRsvTel'] = $reserveZZByday['data'][$k]['sumTel'];
        }
      }
    }
  }
}



$hitToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, HOUR(TIME(`timestamp`)) AS `hour`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())", "`timestamp` DESC", "HOUR(TIME(`timestamp`))");
$hitToday = DAS::quickQuery($hitToday);
$spiderToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, HOUR(TIME(`timestamp`)) AS `hour`", "`tb_vcs_guest`", "", "`isSpider` = 1 AND `timestamp` > DATE(NOW())", "`timestamp` DESC", "HOUR(TIME(`timestamp`))");
$spiderToday = DAS::quickQuery($spiderToday);
$hitInPieToday = new Query("COUNT(`t1`.`id`) AS `sumHitPoint`, COUNT(DISTINCT `t1`.`guestID`) AS `sumGID`, COUNT(DISTINCT `t1`.`ip`) AS `sumIP`, `t2`.`folder` AS `site`", "`tb_vcs_guest` AS `t1`", "LEFT JOIN `tb_vcs_pages` AS `t2` ON `t1`.`pageID` = `t2`.`id`", "`t1`.`isSpider` = 0 AND `t1`.`isRedirect` = 0 AND `t1`.`timestamp` > DATE(NOW())", "", "`t2`.`folder`");
$hitInPieToday = DAS::quickQuery($hitInPieToday);

$pageHitToday = new Query("COUNT(*) AS `sumHitPoint`, COUNT(DISTINCT `guestID`) AS `sumGID`, COUNT(DISTINCT `ip`) AS `sumIP`, `pageFile` AS `page`", "`tb_vcs_guest`", "", "`isSpider` = 0 AND `isRedirect` = 0 AND `timestamp` > DATE(NOW())", "`sumGID` DESC", "`pageID`");
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
        <div><?php echo ($dataByDay ? ($dataByDay[0]['sumRsv'] + $dataByDay[0]['sumExpoRsv'] + $dataByDay[0]['sumZZRsv']) : '获取数据失败');?></div>
      </a>
    </div>
    <div class="col-md-2 col-sm-3 col-xs-6">
      <a data-toggle="tooltip" title="12 new messages." class="well top-block" href="#">
        <i class="glyphicon glyphicon-user green"></i>
        <div>预约人数</div>
        <div><?php echo ($dataByDay ? ($dataByDay[0]['sumRsvGID'] + $dataByDay[0]['sumExpoRsvGID'] + $dataByDay[0]['sumZZRsvGID']) : '获取数据失败');?></div>
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
          $diff = 24 - count($hitToday['data']); 
          for($i = 0; $i < $diff; $i++){
            $vcsHTHit .= '0,';
          }
          for($i = 0; $i < count($hitToday['data']); $i++){
            $vcsHTHit .= $hitToday['data'][$i]['sumHitPoint'];
            $vcsHTHit .= $i < 23 ? ',' : '';
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
          $diff = 24 - count($spiderToday['data']); 
          for($i = 0; $i < $diff; $i++){
            $vcsHTSpider .= '0,';
          }
          for($i = 0; $i < count($spiderToday['data']); $i++){
            $vcsHTSpider .= $spiderToday['data'][$i]['sumHitPoint'];
            $vcsHTSpider .= $i < 23 ? ',' : '';
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
            $legendStr .= '"' . $siteCname[$hitInPieToday[$i]['site']] . '"';
            $legendStr .= $i < count($hitInPieToday) - 1 ? ',' : '';
            $seriesStr .= '{value:' . $hitInPieToday[$i]['sumGID'] . ', name:"' . $siteCname[$hitInPieToday[$i]['site']] . '"}';
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
            $vcsHCReserve .= $dataByDay[$i]['sumRsvGID'] + $dataByDay[$i]['sumExpoRsvGID'] + $dataByDay[$i]['sumZZRsvGID'];
            $vcsHCReserve .= $i < ($vcsHitChartsCount - 1) ? ',' : '';
            $vcsHCRsvProz .= (($dataByDay[$i]['sumRsvGID'] + $dataByDay[$i]['sumExpoRsvGID'] + $dataByDay[$i]['sumZZRsvGID']) / $dataByDay[$i]['sumGID']) * 100;
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
              <th rowspan="2" valign="middle" align="center">日期</th>
              <th rowspan="2" valign="middle" align="center">有效点击</th>
              <th rowspan="2" valign="middle" align="center">访问人数</th>
              <th rowspan="2" valign="middle" align="center">访问IP数</th>
              <th rowspan="2" valign="middle" align="center">爬虫次数</th>
              <th rowspan="2" valign="middle" align="center">预约人数</th>
              <th rowspan="2" valign="middle" align="center">提交电话数</th>
              <th colspan="3" valign="middle" align="center">预约人数</th>
            </tr>
            <tr>
              <th valign="middle" align="center">官网</th>
              <th valign="middle" align="center">推广</th>
              <th valign="middle" align="center">漳州</th>
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
                    echo '<td>' . ($hitByDay['data'][$i]['sumRsvGID'] + $hitByDay['data'][$i]['sumExpoRsvGID'] + $hitByDay['data'][$i]['sumZZRsvGID']) . '</td>';
                    echo '<td>' . ($hitByDay['data'][$i]['sumRsvTel'] + $hitByDay['data'][$i]['sumExpoRsvTel'] + $hitByDay['data'][$i]['sumZZRsvTel']) . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumRsvGID'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumExpoRsvGID'] . '</td>';
                    echo '<td>' . $hitByDay['data'][$i]['sumZZRsvGID'] . '</td>';
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