<?php
require_once('init.inc');
$allUserAgents = new Query("userAgent", "tb_vcs_guest", "", "`isSpider` = 0 AND `isRedirect` = 0", "", "userAgent");
$allUserAgents = DAS::quickQuery($allUserAgents);

function parseUserAgent($userAgent){
    if (!isset($userAgent) || !$userAgent) {
        return false;
    }
    $userAgentArray = array('device' => '', 'os' => '', 'version' => '', 'browser' => '', 'userAgent' => $userAgent);
    if (stripos($userAgent, 'iPad') !== false) {
        $userAgentArray['device'] = 'iPad';
    }
    else if(stripos($userAgent, 'iPhone') !== false) {
        $userAgentArray['device'] = 'iPhone';
    }
    else if(stripos($userAgent, 'Android') !== false) {
        $userAgentArray['os'] = 'Android';
        if (stripos($userAgent, 'CMCC') !== false) {
            $userAgentArray['device'] = '移动定制机';
        }
        elseif (stripos($userAgent, 'Coolpad') !== false) {
            $userAgentArray['device'] = '酷派';
        }
        elseif (stripos($userAgent, 'Hisense') !== false) {
            $userAgentArray['device'] = '海信';
        }
        elseif (stripos($userAgent, '; HS-') !== false) {
            $userAgentArray['device'] = '海信';
        }
        elseif (stripos($userAgent, 'HONOR') !== false) {
            $userAgentArray['device'] = '荣耀';
        }
        elseif (stripos($userAgent, 'MediaPad') !== false) {
            $userAgentArray['device'] = '华为平板';
        }
        elseif (stripos($userAgent, 'HUAWEI') !== false) {
            $userAgentArray['device'] = '华为';
        }
        elseif (stripos($userAgent, '; H60-L') !== false) {
            $userAgentArray['device'] = '华为';
        }
        elseif (stripos($userAgent, 'Lenovo') !== false) {
            $userAgentArray['device'] = '联想';
        }
        elseif (stripos($userAgent, 'M A5') === 0) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, 'M1 E') === 0) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, 'm2') === 0) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, 'M5 Note') === 0) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, 'M5s') === 0) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, '; GT-') !== false) {
            $userAgentArray['device'] = '三星';
        }
        elseif (stripos($userAgent, 'HTC') !== false) {
            $userAgentArray['device'] = 'HTC';
        }
        elseif (stripos($userAgent, '; MI ') !== false) {
            $userAgentArray['device'] = '小米';
        }
        elseif (stripos($userAgent, 'Xiaomi') !== false) {
            $userAgentArray['device'] = '小米';
        }
        elseif (stripos($userAgent, '; Nexus') !== false) {
            $userAgentArray['device'] = 'Nexus';
        }
        elseif (stripos($userAgent, '; SHV-') !== false) {
            $userAgentArray['device'] = '三星';
        }
        elseif (stripos($userAgent, '; SCH-') !== false) {
            $userAgentArray['device'] = '三星';
        }
        elseif (stripos($userAgent, '; M353') !== false) {
            $userAgentArray['device'] = '魅族';
        }
        elseif (stripos($userAgent, '; Pioneer ') !== false) {
            $userAgentArray['device'] = '先锋 Pioneer';
        }
        elseif (stripos($userAgent, '; E81t ') !== false) {
            $userAgentArray['device'] = '先锋 Pioneer';
        }
        elseif (stripos($userAgent, '; E91w ') !== false) {
            $userAgentArray['device'] = '先锋 Pioneer';
        }
        elseif (stripos($userAgent, 'Build/HM') !== false) {
            $userAgentArray['device'] = '红米';
        }
        elseif (stripos($userAgent, '; HM NOTE') !== false) {
            $userAgentArray['device'] = '红米 Note';
        }
        elseif (stripos($userAgent, '; HM') !== false) {
            $userAgentArray['device'] = '红米';
        }
        elseif (stripos($userAgent, 'Redmi') !== false) {
            $userAgentArray['device'] = '红米';
        }
        elseif (stripos($userAgent, '; SM-') !== false) {
            $userAgentArray['device'] = '三星';
        }
        elseif (stripos($userAgent, 'SAMSUNG') !== false) {
            $userAgentArray['device'] = '三星';
        }
        elseif (stripos($userAgent, 'vivo') !== false) {
            $userAgentArray['device'] = 'VIVO';
        }
        elseif (stripos($userAgent, 'OPPO') !== false) {
            $userAgentArray['device'] = 'OPPO';
        }
        elseif (stripos($userAgent, 'N5117') !== false) {
            $userAgentArray['device'] = 'OPPO N1 Mini';
        }
        elseif (stripos($userAgent, '; ZTE ') !== false) {
            $userAgentArray['device'] = '中兴';
        }
        elseif (stripos($userAgent, '; NX') !== false) {
            $userAgentArray['device'] = '努比亚';
        }
        elseif (stripos($userAgent, 'Kindle') !== false) {
            $userAgentArray['device'] = 'Kindle';
        }
        elseif (stripos($userAgent, 'C6603') !== false) {
            $userAgentArray['device'] = 'Sony';
        }
        elseif (stripos($userAgent, 'L50t') !== false) {
            $userAgentArray['device'] = 'Sony Z2';
        }
        elseif (stripos($userAgent, 'Nokia') !== false) {
            $userAgentArray['device'] = 'Nokia';
        }
        elseif (stripos($userAgent, 'ONEPLUS') !== false) {
            $userAgentArray['device'] = '一加';
        }
        elseif (stripos($userAgent, 'A0001') !== false) {
            $userAgentArray['device'] = '一加';
        }
        elseif (stripos($userAgent, 'jingxuanlite') !== false) {
            $userAgentArray['device'] = 'jingxuan lite';
        }
        else {
            $userAgentArray['device'] = 'Android';
        }
        
    }
    else {
        $userAgentArray['device'] = 'Computer';
    }
    return $userAgentArray;
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>

<body>
<table>
  <thead>
    <tr>
      <th>Index</th>
      <th>userAgent</th>
      <th>device</th>
      <th>OS</th>
      <th>Version</th>
      <th>browser</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $index = 1;
    for ($i = 0; $i < count($allUserAgents['data']); $i++) {
        $userAgent = parseUserAgent(rawurldecode($allUserAgents['data'][$i]['userAgent']));
        if ($userAgent['device'] == 'Android') {
    ?>
    <tr>
      <td><?php echo $index;?></td>
      <td><?php echo $userAgent['userAgent'];?></td>
      <td><?php echo $userAgent['device'];?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <?php
    $index++;
        }
    }
    ?>
  </tbody>
</table>
</body>
</html>