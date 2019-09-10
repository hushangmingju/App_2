/*
VCS JS 使用说明
# 在页面顶部需要加载的JS脚本（可统一加载于top.inc中）：
// AJAX支持
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
// 高德地图定位支持
<script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.8&key=d43b26455fcba9466e49cb2278c10d99"></script>
// VCS方法集
<script type="text/javascript" src="js/vcs.js"></script>

# 在页面中加入一个容器用于创建MAP Object
<div id="GEO_LOCATION" style="display:none;"></div>

# 在页面底部需添加JS代码用于记录页面完成加载的时间点（可统一加载于bottom.inc中）：
<script type="text/javascript" language="javascript">
<!--//
document.onreadystatechange=function(){if(document.readyState=="complete"){fullLoad();getRegion();getCoordinate();}};
//-->
</script>

# 声明一个绝对路径 host，可以统一使用一个vcs_svr.php
*/

var host = "http://www.mingjugroup.com/";
var beatTimer;

function hitPoint(){
  var gid = getCookie("vcs-gid") || false;
  if(gid){
    console.log("Find a vcs-gid:" + gid);
  }
  $.ajax({
    type: "POST",
    url: host + "vcs_svr.php",
    dataType: "json", 
    data:{"action": "hitPoint", "refererJS": encodeURIComponent(document.referrer), "cookie": encodeURIComponent(document.cookie), "gid": gid},
    success: function(data) {
      setCookie("vcs-gid", data.DATA, 30);
      console.log("vcs-gid:" + data.DATA);
      console.log(data.TEXT);
      beat();
		},
		error: function(data) {
      console.log("Function hitPoint (on client): Ajax post error.");
		}
  }); 
}
function beat(){
  var gid = getCookie("vcs-gid") || false;
  if(gid){
    //console.log("Beat a vcs-gid:" + gid);
  }
  else{
    console.log("Error by beat a vcs-gid:" + gid);
    clearTimeout(beatTimer);
    return false;
  }
  $.ajax({
    type: "POST",
    url: host + "vcs_svr.php",
    dataType: "json", 
    data:{"action": "beat"},
    success: function(data) {
      //setCookie("vcs-gid", data.DATA, 30);
      //console.log("vcs-gid:" + data.DATA);
      //console.log(data.TEXT);
    },
	error: function(data) {
      //console.log("Function beat (on client): Ajax post error.");
	}
  }); 
  beatTimer = setTimeout("beat()", 1000);
}
function fullLoad(){
  $.ajax({
    type: "POST",
    url: host + "vcs_svr.php",
    dataType: "json", 
    data:{"action": "fullLoad", "cookie": encodeURIComponent(document.cookie)},
    success: function(data) {
      console.log(data.TEXT);
		},
		error: function(data) {
      console.log("Function fullLoad (on client): Ajax post error.");
		}
  });
}
function leavePoint(){  
  var userAgent = navigator.userAgent.toLowerCase();   
  if(userAgent.indexOf("msie")>-1 || userAgent.indexOf("rv")>-1) { //IE
    $.ajax({ 
      type: 'POST',
      url: host + "vcs_svr.php", 
      crossDomain: true, 
      async: false, 
      dataType: "json", 
      data:{"action": "leavePoint", "cookie": encodeURIComponent(document.cookie)},
      success: function(data) {
			},
			error: function(data) {
			}
    });   
  }
  else{ //FireFox Chrome 
    $.ajax({
      type: "POST",
      url: host + "vcs_svr.php", 
      //async: false, 
      dataType: "json", 
      data:{"action": "leavePoint", "cookie": encodeURIComponent(document.cookie)},
      success: function(data) {
			},
			error: function(data) {
			}
    });   
  }   
} 
// void getCoordinate(void)
function getCoordinate(){
  var map = new AMap.Map("GEO_LOCATION");
  map.plugin("AMap.Geolocation", function() {
    var geolocation = new AMap.Geolocation({
      // 是否使用高精度定位，默认：true
      enableHighAccuracy: true,
      // 设置定位超时时间，默认：无穷大
      timeout: 10000,
    });
    map.addControl(geolocation);
    geolocation.getCurrentPosition();
    AMap.event.addListener(geolocation, 'complete', onComplete)
    AMap.event.addListener(geolocation, 'error', onError)

    function onComplete (data) {
      //console.log("lnglat: " + data.position.toString());
      $.ajax({
        type: "POST",
        url: host + "vcs_svr.php",
        dataType: "json", 
        data:{"action": "getCoordinate", "coordinate": data.position.toString()},
        success: function(data) {
          console.log(data.TEXT);
	  	  },
	  	  error: function(data) {
          console.log("Function fullLoad (on client): Ajax post error.");
	  	  }
      });
    }
    function onError (data) {
      // 定位出错
    }
  });
}
// void getRegion(void)
function getRegion(){
  $.ajax({
    type: "POST",
    url: host + "vcs_svr.php",
    dataType: "json", 
    data:{"action": "getRegion"},
    success: function(data) {
      console.log(data.TEXT);
	},
    error: function(data) {
      console.log("Function fullLoad (on client): Ajax post error.");
	}
  });
}
// boolean getCookie((string) varname, (mixed) value, (int) expiredays)
function setCookie(varname,value,expiredays){
	if(!varname||typeof varname!=="string"){
		return false;
	}
	if(value){
		var valueStr=varname+"="+escape(value);
		if(expiredays){
			expiredays=parseInt(expiredays);
			if(!isNaN(expiredays)){
	      var exdate=new Date();
				exdate=new Date(exdate.getTime() +1000*60*60*24*expiredays);
				valueStr+=";expires="+exdate.toGMTString()+";";
			}
		}
		document.cookie=valueStr;
	}
	else{
		document.cookie=varname+"=0;expires=Thu, 01-Jan-70 00:00:01 GMT;";
	}
	return true;
}
// mixed getCookie((string) varname)
function getCookie(varname){
	if(!varname||!document.cookie||document.cookie.length===0||document.cookie.indexOf(varname+"=")==-1){
		return null;
	}
	return unescape(document.cookie.split(varname+"=",2)[1].split(";",2)[0]);
} 



hitPoint();
window.onbeforeunload = function(){leavePoint();}
