<?php
$token = json_decode(file_get_contents('http://www.mingjugroup.com/zt/yd2/gettoken.php'), true);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/marketing/user_action_sets/add?version=v1.0&access_token=" . $token['access_token']); 
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=WEB&name=test&description=test1');
curl_setopt($ch, CURLOPT_POST,true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$output = curl_exec($ch);
if($output === FALSE ){
  echo "CURL Error:".curl_error($ch);
}
echo $output;

curl_close($ch);
?>