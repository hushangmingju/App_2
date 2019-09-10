<?php
$token = json_decode(file_get_contents('http://www.mingjugroup.com/bd/yd/gettoken.php'), true);
$data = '{"type":"WEB","name":"wxadtest","description":"test"}';
$ch = curl_init("https://api.weixin.qq.com/marketing/user_action_sets/add?version=v1.0&access_token=" . $token['access_token']);
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