<?php
require_once('dtk4wdb.inc');
SGF::sysStatus();
if(isset($_GET['action'])){
  switch($_GET['action']){
    case 'clear':
      SGF::cleanEvtLog();
      if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
    case 'stop':
      SGF::stopEvtLog();
      if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
    case 'continue':
      SGF::continueEvtLog();
      if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
    case 'off':
      SGF::turnOffEvtLog();
      if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
    case 'on':
      SGF::turnOnEvtLog();
      if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
		case 'refresh':
		  if(isset($_GET['type'])){
	      SGF::showOnlyListTypes($_GET['type']);
      }
	    die('<script language="javascript" type="text/javascript">window.location="' . $_SERVER['PHP_SELF'] . '"</script>');
			break;
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eventlogs</title>
<style type="text/css">
<!-- 
/* style for event Log */
.process{
  color:#000099;
  border-bottom:#990000 1px dotted;
}
.error{
  color:#990000;
  border-bottom:#990000 1px dotted;
}
.alert{
  color:#CC9900;
  border-bottom:#990000 1px dotted;
}
.var{
  color:#FF33CC;
  font-style:normal;
}
.debug{
  color:#FF6633;
}
.start{
  color:#CC0000;
}
.return{
  color:#009900;
}
.caller{
  font-weight:bold;
  width:240px;
}
.step{
  border-style:solid;
  border-width:1px;
  padding-left:2px;
  padding-right:2px;
  font-style:italic;
  font-size:small;
}
.descript{
  font-family:Arial;
  font-size:small;
}
.timestamp{
  color:#999999;
  font-size:x-small;
}
.ip{
  color:#999999;
  font-size:x-small;
}
/* style for site*/
body{
  padding:0px 14px 0px 14px;;
}
a.global{
  color:#990000;
  text-decoration:none;
}
  a.global:hover{
    text-decoration:underline;
  }
#path{
  display:block;
  position:relative;
  color:#990000;
  font-family:Arial;
  font-size:small;
  border-bottom:#990000 dotted 1px;
  padding-bottom:3px;
  width:100%;
}
#pannel{
  display:block;
  position:relative;
  width:100%;
  text-align:center;
}
#evtLogList{
  width:100%;
  background-color:#DDDDDD;
}
-->
</style>
</head>
<script language="javascript" type="text/javascript">
<!--//
function checkType(){
	var str = 'error';
	if(document.getElementById('showAlert').checked){
	  str += '_' + document.getElementById('showAlert').value;
	}
	if(document.getElementById('showProcess').checked){
	  str += '_' + document.getElementById('showProcess').value;
	}
	return str;
}
//-->
</script>

<body>
<p id="path">Ereignisse:</p>

<p id="pannel">
<input type="button" value="Clear Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=clear&type='+checkType();" />
<input type="button" value="Refresh Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=refresh&type='+checkType();" />
<?php
if($_SESSION['sys']['evtOn'] && isset($_SESSION['sys']['evtLog'])){
?>
<input type="button" value="stop Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=stop&type='+checkType();" />
<input type="button" value="turn off Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=off&type='+checkType();" />
<?php
}
else if(!$_SESSION['sys']['evtOn'] && isset($_SESSION['sys']['evtLog'])){
?>
<input type="button" value="continue Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=continue&type='+checkType();" />
<input type="button" value="turn off Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=off&type='+checkType();" />
<?php
}
else{
?>
<input type="button" value="stop Eventlog" disabled="disabled" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=continue&type='+checkType();" />
<input type="button" value="turn on Eventlog" onclick="window.location='<?php echo $_SERVER['PHP_SELF'];?>?action=on&type='+checkType();" />
<?php
}
?>
<br />
<input type="checkbox" id="showAlert" value="alert" <?php echo (!isset($_SESSION['sys']['evtType']) || $_SESSION['sys']['evtType'] == '') || (isset($_SESSION['sys']['evtType']) && strpos($_SESSION['sys']['evtType'], 'alert') !== false) ? 'checked="checked" ' : ''; ?>/>Achtungen zeigen
<input type="checkbox" id="showProcess" value="process" <?php echo (!isset($_SESSION['sys']['evtType']) || $_SESSION['sys']['evtType'] == '') || (isset($_SESSION['sys']['evtType']) && strpos($_SESSION['sys']['evtType'], 'process') !== false) ? 'checked="checked" ' : ''; ?>/>Prozess zeigen
<?php
if(isset($_SESSION['sys']['evtLog'])){
  $xml = '<eventlogs>' . $_SESSION['sys']['evtLog'] . '</eventlogs>';
  $xmlDOM = new DOMDocument();
  if($xmlDOM->loadXML($xml)){
    $eventlogs = $xmlDOM->getElementsByTagName('eventlog');
	echo '<table id="evtLogList"><tbody>';
	foreach($eventlogs as $eventlog){
	  $type = $eventlog->getElementsByTagName('type')->item(0)->nodeValue;
	  $caller = $eventlog->getElementsByTagName('caller')->item(0)->nodeValue;
	  $step = $eventlog->getElementsByTagName('step')->item(0)->nodeValue;
	  $descript = $eventlog->getElementsByTagName('descript')->item(0)->nodeValue;
	  $timestamp = $eventlog->getElementsByTagName('timestamp')->item(0)->nodeValue;
		if($type){
			if((!isset($_SESSION['sys']['evtType']) || $_SESSION['sys']['evtType'] == '') || (isset($_SESSION['sys']['evtType']) && strpos($_SESSION['sys']['evtType'], $type) !== false)){
				echo '<tr>';
	      echo '<td class="' . $type . '" width="200px">';
	      echo '<span class="caller">' . $caller . '</span></td>';
	      echo '<td class="' . $type . '" width="32px"><span class="step">' . $step . '</span></td>';
	      $descript = rawurldecode($descript);
	      $descript = str_replace('%start%', "<span class='start'>", $descript);
	      $descript = str_replace('%#start%', "</span>", $descript);
	      $descript = str_replace('%return%', "<span class='return'>", $descript);
	      $descript = str_replace('%#return%', "</span>", $descript);
	      $descript = str_replace('%var%', "<span class='var'>", $descript);
	      $descript = str_replace('%#var%', "</span>", $descript);
	      $descript = str_replace('%debug%', "<span class='debug'>", $descript);
	      $descript = str_replace('%#debug%', "</span>", $descript);
	      echo '<td class="' . $type . '"><span class="descript">' . $descript . '</span></td>';
	      echo '<td class="' . $type . '" width="90px"><span class="timestamp">' . $timestamp . '</span></td>';
	      echo '</tr>';
			}		  
		}
	}
	echo '</tbody></table>';
  }
}
?>
</p>
</body>
</html>
