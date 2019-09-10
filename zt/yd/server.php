<?php
$token = json_decode(file_get_contents('http://www.mingjugroup.com/zt/yd/gettoken.php'), true);
$data = '{"actions":[{"user_action_set_id":"1108028481","url":"http://www.mingjugroup.com/zt/yd/index.php","action_time":1513077790,"action_type":"COMPLETE_ORDER","trace":{"click_id":"' . $_POST['clickID'] . '"},"action_param":{"value":40}}]}';
$actions = array();
$actions['user_action_set_id'] = 1108028481;
$actions['url'] = 'http://www.mingjugroup.com/zt/yd/index.php';
$actions['action_time'] = time();
$actions['action_type'] = 'RESERVATION';
$actions['trace']['click_id'] = isset($_POST['clickID']) ? $_POST['clickID'] : '';
$actions['action_param']['value'] = 40;
$data = array('actions'=>array($actions));
$data = json_encode($data);
$ch = curl_init("https://api.weixin.qq.com/marketing/user_actions/add?version=v1.0&access_token=" . $token['access_token']);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json; charset=utf-8',"Accept: application/json", "Cache-Control: no-cache", "Pragma: no-cache", 'Content-Length:' . strlen($data)));
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
$output = curl_exec($ch);
curl_close($ch);
?>