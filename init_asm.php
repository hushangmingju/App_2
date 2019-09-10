<?php
require_once('dtk4wdb.inc');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>初始化SGF的ASM运行环境</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body class="Main">
<table class="Top" cellpadding="0px" cellspacing="0px">
  <tr>
    <td style="height:20px;"></td>
    <td valign="bottom"></td>
    <td></td>
  </tr>
  <tr>
    <td style="width:5%; min-width:36px; height:80px;"></td>
    <td style="width:90%; min-width:648px;">
      <div class="Top_Title_A" style="width: 160px;">DTK4WDB</div>
      <span class="Top_Subtitle" style="margin-left:24px;">欢迎使用基于SGF的ASM运行环境初始化向导</span>
    </td>
    <td style="width:5%; min-width:36px;"></td>
  </tr>
  <tr style="background-color:#556f9a">
    <td style="height:4px;"></td>
    <td></td>
    <td></td>
  </tr>
</table>
<?php
if(isset(SGF::$OBJECTNAME) && SGF::asm()){
  if(isset($_GET['a']) && $_GET['a'] == 'reset'){
    $farr = glob('asm/.asm*');
    if(count($farr) > 0){
      foreach($farr as $filename){
        unlink($filename);
      }
    }
    die('<script language="javascript" type="text/javascript">alert("ASM运行环境已重置，请重新部署。");window.location="init_asm.php"</script>');
  }
  else{
    $farr = glob('asm/.asm*');
    $farr[0] = file_get_contents($farr[0]);
    $farr[1] = file_get_contents($farr[1]);
    CML::init('DTK4WDB_ASM_KEY');
    CML::setIV($farr[0]);
    $strs = CML::decrypt($farr[1]);
    $strs = explode('%' . $_SERVER['HTTP_HOST'] . '%', $strs);
?>
<table align="center" cellpadding="0px" cellspacing="0px" style="width:100%;">
  <tr>
    <td valign="top" height="750px" style="background-color:#c9d4e4;">
      <table align="center" cellpadding="0px" cellspacing="0px" width="1024px">
        <tr>
          <td>
            <h2>基于SGF的ASM运行环境已正常运行</h2>
            <p>&nbsp;</p>
            <p>如果需要重置ASM设置，请点击<a href="init_asm.php?a=reset">重置</a>，重置后所有ASM参数都会清除。重置前请确保php对asm文件夹有读写权限(chmod -R 777 asm)</p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>  
<?php
  }
}
else{
  if(!isset($_GET['s'])){
?>
<table align="center" cellpadding="0px" cellspacing="0px" style="width:100%;">
  <tr>
    <td valign="top" height="750px" style="background-color:#c9d4e4;">
      <table align="center" cellpadding="0px" cellspacing="0px" width="1024px">
        <tr>
          <td>
            <h2>当前基于SGF的ASM运行环境没有被部署</h2>
            <h4>请跟随初始化向导完成部署</h4>
            <p>首先请在init_asm.php文件同目录下建立一个名为asm文件夹，并确保php程序用户对其拥有读写权限（777权限）</p>
            <p>接下来我们将完成以下工作</p>
            <ul>
              <li><b>提供参数</b> - 提供数据库连接参数: user, password, database name, host;</li>
              <li><b>创建文件</b> - 初始化向导程序会在服务器端创建两个文件.asmtx和.asmvi用于存放加密的数据库连接信息;</li>
              <li><b>测试连接</b> - 最后初始化向导程序将会测试连接数据库;</li>
            </ul>
            <p>测试连接成功后即完成了基于SGF的ASM运行环境的部署，在PHP页面中加入代码：</p>
            <code>
              require_once('dtk4wdb.inc');<br />
              SGF::asm();
            </code>
            <p>即可连接数据库。</p>
            <p>点击"开始"按钮，开始部署</p>
            <a class="button_universal_green" href="init_asm.php?s=1">开始</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>  
<?php
  }
  elseif($_GET['s'] == 1){
?>
<table align="center" cellpadding="0px" cellspacing="0px" style="width:100%;">
  <tr>
    <td valign="top" height="750px" style="background-color:#c9d4e4;">
      <table align="center" cellpadding="0px" cellspacing="0px" width="1024px">
        <tr>
          <td width="240px">&nbsp;</td>
          <td valign="top" style="font-family:arial; font-size:12px; color:#122a4f; padding-top:120px;">
            <h2>请填写正确的数据库连接信息</h2>
            <form id="ASM_FORM" method="post" action="init_asm.php?s=2" target="_self">
              <div style="display:block; padding:5px;">
                <div style="width:72px; display:inline-block;">Username:</div>
                <input type="text" name="user" size="20" />
              </div>
              <div style="display:block; padding:5px;">
                <div style="width:72px; display:inline-block;">Password:</div>
                <input type="password" name="password" size="20" />
              </div>
              <div style="display:block; padding:5px;">
                <div style="width:72px; display:inline-block;">Database:</div>
                <input type="text" name="db" size="20" />
              </div>
              <div style="display:block; padding:5px;">
                <div style="width:72px; display:inline-block;">Hostname:</div>
                <input type="text" name="host" size="20" value="localhost" />
              </div>
              <div style="display:block; padding:5px;">&nbsp;</div>
              <div style="display:block; padding:5px;">
                <div style="width:90px; display:inline-block;"></div>
                <a class="button_universal_green" style="font-size:large;" onClick="document.getElementById('ASM_FORM').submit();">提交</a>
              </div>              
            </form>
          </td>
          <td width="240px">&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<?php
  }
  elseif($_GET['s'] == 2){
    if(isset($_POST['user']) && $_POST['user'] && isset($_POST['password']) && $_POST['password'] && isset($_POST['db']) && $_POST['db']){
      $host = isset($_POST['host']) && $_POST['host'] ? $_POST['host'] : 'localhost';
      SGF::setDBConnectData($_POST['user'], $_POST['password'], $_POST['db'], $_POST['host']);
      if(SGF::isReady()){
        CML::init('DTK4WDB_ASM_KEY');
        $resultTx = file_put_contents('asm/.asmtx', CML::encrypt($_POST['user'] . '%' . $_SERVER['HTTP_HOST'] . '%' . $_POST['password'] . '%' . $_SERVER['HTTP_HOST'] . '%' . $_POST['db'] . '%' . $_SERVER['HTTP_HOST'] . '%' . $host));
        $resultIv = file_put_contents('asm/.asmiv', CML::getIV());
        if($resultTx !== false && $resultIv !== false){
?>
<table align="center" cellpadding="0px" cellspacing="0px" style="width:100%;">
  <tr>
    <td valign="top" height="750px" style="background-color:#c9d4e4;">
      <table align="center" cellpadding="0px" cellspacing="0px" width="1024px">
        <tr>
          <td>
            <h2>用于存放加密的数据库连接信息的文件已被创建</h2>
            <p>点击"测试"按钮，测试ASM运行环境是否已被正确部署。</p>
            <p>出于安全考虑可在此时在服务器中将asm文件夹设为不可写入权限（chmod -R 755 asm）并且在完成测试后删除本ASM初始化安装向导文件init_asm.php。</p>
            <a class="button_universal_green" href="init_asm.php">测试</a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>  
<?php          
        }
        else{
          $farr = glob('.asm*');
          if(count($farr) > 0){
            foreach($farr as $filename){
              unlink($filename);
            }
          }
          die('<script language="javascript" type="text/javascript">alert("创建密文文件时发生错误，向导将返回上一步。");window.location="init_asm.php?s=1"</script>');
        }
      }
      else{
        die('<script language="javascript" type="text/javascript">alert("连接数据库失败，请确认数据库连接信息是否正确，向导将返回上一步。");window.location="init_asm.php?s=1"</script>');
      }
    }
    else{
      die('<script language="javascript" type="text/javascript">alert("输入的数据库连接信息有遗漏，请检查是否正确填写，向导将返回上一步。");window.location="init_asm.php?s=1"</script>');
    }
  }
  else{
    die('<script language="javascript" type="text/javascript">alert("异常错误，返回首页");window.location="init_asm.php"</script>');
  }
}
?>
<table align="center" cellpadding="0px" cellspacing="0px" style="width:100%;">
  <tr>
    <td align="center" style="width:90%; min-width:648px; text-align: center; padding: 5px; height:36px; background-color:#122a4f;">
      <span style="color:#fff; font-size:12px;">Copyright &copy;2009 - 2018 Zentrum für Elektro- und Informationstechnologie: Alle Inhalten sowie(Daten, Code, Aussehen usw.) auf dieser Webseit wurden von Copyright geschutzt.</span>
		</td>
  </tr>
</table>
</body>
</html>
</html>
