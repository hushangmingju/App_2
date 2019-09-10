<?php
include('../mobile/base.php');

$type = _POST("type") ? _POST("type") : null;
/*
if($type=="yuyue"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'type'=>"yuyue",'status'=>"ok",'time'=>time());
}elseif($type=="calc"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'calcstyle'=>_POST("calc-style"),'calcprice'=>_POST("calc-price"),'calcarea'=>_POST("calc-area"),'calctotal'=>_POST("calc-total"),'type'=>"calc",'status'=>"ok",'time'=>time());
}elseif($type=="calc2"){
	$params = array('tel'=>_POST("tel"),'calcstyle'=>_POST("calc-style"),'calcprice'=>_POST("calc-price"),'calcarea'=>_POST("calc-area"),'calctotal'=>intval(_POST("calc-price"))*intval(_POST("calc-area")),'type'=>"calc2",'status'=>"ok",'time'=>time());
}elseif($type=="yangban"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'sid'=>_POST("sid"),'type'=>"yangban",'status'=>"ok",'time'=>time());
}elseif($type=="bottom"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'type'=>"bottom",'status'=>"ok",'time'=>time());
}elseif($type=="liuyan"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'title'=>_POST("title"),'content'=>_POST("content"),'type'=>"liuyan",'status'=>"ok",'time'=>time());
}elseif($type=="wenda"){
	$params = array('mod'=>'wenda','q'=>_POST("content"),'status'=>"wenda",'time'=>time());
}elseif($type=="expo"){
	$params = array('name'=>$_POST("name"),'tel'=>$_POST("tel"),'ip'=>$_SERVER['REMOTE_ADDR'],'timestamp'=>date('Y-m-d H:i:s'));
}else{
	$params = null;
}*/
if($type=="expo"){
  $params = array('type'=>'yuyue','name'=>_POST("name"),'tel'=>_POST("tel"),'seoPHP'=>$_SESSION['httpReferer'],'seoJS'=>_POST("referer"),'phpSelf'=>$_SESSION['phpSelf'],'ip'=>$_SERVER['REMOTE_ADDR'],'timestamp'=>date('Y-m-d H:i:s'),'status'=>'ok');
  $tab = "tb_expo_yuyue";
}
elseif($type=="calc4"){
  $params = array('type'=>'calc','name'=>_POST("name"),'tel'=>_POST("tel"), 'seoPHP'=>$_SESSION['httpReferer'],'seoJS'=>_POST("referer"), 'phpSelf'=>$_SESSION['phpSelf'],'ip'=>$_SERVER['REMOTE_ADDR'],'timestamp'=>date('Y-m-d H:i:s'),'style'=>_POST("calc-style"),'price'=>_POST("calc-price"),'area'=>_POST("calc-area"),'total'=>intval(_POST("calc-price"))*_POST("calc-area"),'status'=>"ok");
  $tab = "tb_expo_yuyue";
}else{
  $params = null;
}
/*
if($type=="wenda"){
	$tab = "wenda";
}
elseif($type=="expo"){
  $tab = "tb_expo_yuyue";
}
else{
	$tab = "yuyue";
}
echo $tab;
*/
if($params){
	$query = $db->QueryInsUp($tab,$params);
	echo json_encode(array("ret"=>"ok","msg"=>"提交成功！"));
}

?>