<?php
require_once('init.inc');

require_once('ext/vcs.inc');
VCS::start();
function isMobile(){
    if (isset ($_SERVER['HTTP_USER_AGENT'])){
        $clientkeywords = array ('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile');
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))){
            return true;
        }
        return false;
    } 
}
if (isMobile()){
    $mobilePageMatch = array('about', 'brand', 'contact', 'jg60', 'promotions', 'yangban', 'yuyue' , 'index');
    $redirectRequestUri = "/mobile";
    for ($i = 0; $i < count($mobilePageMatch); $i++){
        $redirectRequestUri .= strpos($_SERVER['REQUEST_URI'], $mobilePageMatch[$i]) !== false ? $_SERVER['REQUEST_URI'] : '';
    }    
    VCS::redirect('top_mobile', $redirectRequestUri);
    header("HTTP/1.1 301 Moved Permanently");
	  header("Location: " . $redirectRequestUri);
}else{
	  header('Content-Type: text/html; charset=utf-8');  
}

require_once('ext/das.inc'); 
$user = getUser();
?>
<!doctype html>
<?php
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '00000arF_db00000')){
    VCS::redirect('top_redirect01', 'promotions.php?/PZ-Pc');
    die("<script type='text/javascript'>window.location.href='promotions.php?/PZ-Pc'</script>");
}
if ($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] == 'www.mingjugroup.com/?/PZ-pc' && isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'https://www.baidu.com/') !== false){
    VCS::redirect('top_redirect02', 'promotions.php?/PZ-Pc');
    die("<script type='text/javascript'>window.location.href='promotions.php?/PZ-Pc'</script>");
}
?>
<html>
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
<script type="text/javascript" src="js/swiper.3.1.2.min.js"></script>
<script type="text/javascript" src="js/vcs.js"></script>