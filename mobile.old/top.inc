<?php
require_once('init.inc');
require_once('../ext/das.inc');
require_once('../ext/vcs.inc');

VCS::start(); 
$user = getUser();
?>
<!doctype html>
<html>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
<script type="text/javascript" src="js/swiper.3.1.2.min.js"></script>
<script type="text/javascript" src="../js/vcs.js"></script>
<script type="text/javascript" src="js/site.js" ></script>