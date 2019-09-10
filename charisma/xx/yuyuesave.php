<?php
include(dirname(__FILE__).'/base.php');
$type = _POST("type") ? _POST("type") : null;
if($type=="yuyue"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'type'=>"yuyue",'status'=>"ok",'time'=>time());
}elseif($type=="calc"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'calcstyle'=>_POST("calc-style"),'calcprice'=>_POST("calc-price"),'calcarea'=>_POST("calc-area"),'calctotal'=>_POST("calc-total"),'type'=>"calc",'status'=>"ok",'time'=>time());
}elseif($type=="yangban"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'area'=>_POST("area"),'content'=>_POST("content"),'sid'=>_POST("sid"),'type'=>"yangban",'status'=>"ok",'time'=>time());
}elseif($type=="bottom"){
	$params = array('name'=>_POST("name"),'tel'=>_POST("tel"),'type'=>"bottom",'status'=>"ok",'time'=>time());
}else{
	$params = null;
}
if($params){
	$query = $db->QueryInsUp('yuyue',$params);
}
echo json_encode(array("ret"=>"ok","msg"=>"提交成功。"));
?>