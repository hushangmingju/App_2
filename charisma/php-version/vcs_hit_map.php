<?php 
require_once('vcs_header.php');

$massPoints = new Query("*", "`tb_vcs_guest`", "", "`coordinate` IS NOT NULL AND `region` LIKE '\%E4\%B8\%8A\%E6\%B5\%B7%'", "id DESC", "", "10000");
$massPoints = DAS::quickQuery($massPoints);
$massPointsStr = '';

if(DAS::hasData($massPoints)){
  $massPoints = $massPoints['data'];
  foreach($massPoints as $massPoint){
    $massPointsStr .= '{lnglat: [' . $massPoint['coordinate'] . '],name: "' . $massPoint['date'] . '",id:"' . $massPoint['guestID'] . '",style:0},';
  }
  $massPointsStr = substr($massPointsStr, 0, (strlen($massPointsStr) - 1));
}
?>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
<div id="content" class="col-lg-14 col-sm-14">
  <div>
    <ul class="breadcrumb">
      <li>
        <h4>网站访问地理位置分布图：</h4>
      </li>
    </ul>
  </div>
  <div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
      <div class="box-header well" data-original-title="">
        <h2>所有有效点击地理位置分布（仅显示上海区域）</h2>
      </div>
      <div class="box-content">
        <div id="container" style="width:100%; height: 670px;"></div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" language="javascript">
<!--//
var data = [<?php echo $massPointsStr;?>];
var map = new AMap.Map('container');
var style = [
    {
    url: 'https://a.amap.com/jsapi_demos/static/images/mass0.png',
    anchor: new AMap.Pixel(3, 3),
    size: new AMap.Size(5, 5)
    },
    {
    url: '//vdata.amap.com/icons/b18/1/2.png',
    anchor: new AMap.Pixel(8, 8),
    size: new AMap.Size(14, 14)
    }
    ];
var mass = new AMap.MassMarks(data, {
    opacity:0.8,
    zIndex: 10,
    cursor:'pointer',
    style:style
    });
mass.setMap(map);
var marker0 = new AMap.Marker({position: [121.418844,31.075336], title: "闵行店", zIndex: 100});
var marker1 = new AMap.Marker({position: [121.248369,31.01918], title: "松江店", zIndex: 100});
var marker2 = new AMap.Marker({position: [121.31987,31.263824], title: "嘉定店", zIndex: 100});
map.add(marker0);
map.add(marker1);
map.add(marker2);
//-->
</script>
<?php require_once('vcs_bottom.inc');?>