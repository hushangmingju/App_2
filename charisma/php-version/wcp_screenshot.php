<?php
$x = $_GET['x'];
$y = $_GET['y'];
$format = $_GET['format'];
$site = $_GET['site'];
$surl = 'http://jbxue.com/screenshot_it.php?site='.$site.'&x='.$x.'&y='.$y.'&format='.$format;
if ($_REQUEST['format'] == 'PNG') {
    $ifm = 'png';
} 
else {
    $ifm = 'jpg';
}
$imt = 'image/'.$ifm;
$ifn = 'screenshot.'.$ifm;

header("Content-type: $imt");
header("Content-Disposition: attachment; filename= $ifn");
readfile($surl);
?>
