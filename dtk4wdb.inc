<?php
/*-->
  <h1>Develop Tool Kits for Web Database</h1>
	<h3>Version: 4.0.1e</h3>
	<h3>Last Update time: 2018-08-28</h3>
	<h3>Developer: Jun Zhu</h3>
  <h4>Warning: Since version 4.0.1 need extensions mysqli and openssl!</h4>
	
	<ul class="class">
	  <li>
		  <h4>What was fixed after every update:</h4>
	    <ul class="methode">
          <li>
		    <h4>2018-08-28 Version 4.0.1e:</h4>
			<ul class="parameter">
              <li>Add a methode divisionPages into Class DAS: divisionPages is a methode with same interface like methode quickQuery, by handle mass data, divisionPages has more higher performance.</li>
			</ul>
		  </li>
          <li>
		    <h4>2018-08-09 Version 4.0.1d:</h4>
			<ul class="parameter">
              <li>Fixed a bug in methode autoSetValue in Class DML: when value is a NULL value, can not be setted value by update.</li>
			</ul>
		  </li>
          <li>
		    <h4>2018-08-09 Version 4.0.1c:</h4>
			<ul class="parameter">
              <li>Add a valiable "$msgArray" in Class MSG to save and get the last msg, output as a array.</li>
			</ul>
		  </li>
          <li>
		    <h4>2018-08-01 Version 4.0.1b:</h4>
			<ul class="parameter">
              <li>Fixed methode autoSetValue in Class DML, by update only match the columns, what exists in requestArray.</li>
			</ul>
		  </li>
          <li>
		    <h4>2018-06-24 Version 4.0.1a:</h4>
			<ul class="parameter">
              <li>add a argument "$dirPath" for function asm.</li>
              <li>add a valiable "$charset" to set the charset of database.</li>
              <li>change the "sysStatus" methode from private to public.</li>
			</ul>
		  </li>
		  <li>
		      <h4>2018-06-11 Version 4.0.1:</h4>
			    <ul class="parameter">
					  <li>Class SGF updated to full static mode.</li>
            <li>add a security start mode asm() into Class SGF.</li>
            <li>Update Class CML replace the extension mcrypt to extension openssl. Please check the extension openssl actived!</li>
			    </ul>
		    </li>
		    <li>
		      <h4>2018-06-09 Version 4.0.0:</h4>
			    <ul class="parameter">
					  <li>Update the PHP Database extensions from mysql to mysqli.</li>
			    </ul>
		    </li>
		    <li>
		      <h4>2016-06-04 Version 3.0.2:</h4>
			    <ul class="parameter">
					  <li>add new function getClientIP() into Other Tools Kits.</li>
						<li>add new function ip2bin() into Other Tools Kits.</li>
						<li>add new function bin2ip() into Other Tools Kits.</li>
			    </ul>
		    </li>
	    </ul>
		</li>
	</ul>
  <ul class="class">
	  <li>
		  <h2>SGF</h2>
			<p>System Global Functions</p>
<!--*/
class SGF{
	/*-->	
			<ul class="methode">
	<!--*/
  private static $dbHost;
  private static $dbUser;
  private static $dbPass;
  private static $dbName;
  private static $dbCharset = 'utf8';
	private static $dbTimeZone = 'Asia/Shanghai';
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Value: 'SGF'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public static $OBJECTNAME = 'SGF';
	/*-->	
			  <li>
				  <h4>Valiable: $KEY</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Value: a string</li>
					  <li>assign a global AES key (use methode: setAESKey((string) $key))</li>
				  </ul>
				</li>
	<!--*/
	public static $KEY;
	/*-->	
			  <li>
				  <h4>Valiable: $dbCon</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Value: mysqli object</li>
					  <li>A link identifier returned by mysqli_connect() or mysqli_init().</li>
				  </ul>
				</li>
	<!--*/
  public static $dbCon;
	/*-->	
			  <li>
				  <h4>Methode: __construct()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $username]</li>
                <li>[(string) $password]</li>
                <li>[(string) $database]</li>
                <li>[(string) $hostname]</li>
                <li>[(string) $charset]</li>
                <li>[(string) $defaultTimeZone]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>start SGF, return TRUE if session started, else return FALSE;</li>
				  </ul>
				</li>
	<!--*/
	// boolean function __construct([(string) $username[, (string) $password[, (string) $database[, (string) $hostname[, (string) $charset[, (string) $defaultTimeZone]]]]]])
  public function __construct(){
		$tmpArgArr = func_get_args();
	  self::$dbUser = isset($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : '';
	  self::$dbPass = isset($tmpArgArr[1]) && $tmpArgArr[1] != '' ? $tmpArgArr[1] : '';
	  self::$dbName = isset($tmpArgArr[2]) && $tmpArgArr[2] != '' ? $tmpArgArr[2] : '';
	  self::$dbHost = isset($tmpArgArr[3]) && $tmpArgArr[3] != '' ? $tmpArgArr[3] : 'localhost';
	  self::$dbCharset = isset($tmpArgArr[4]) && $tmpArgArr[4] != '' ? $tmpArgArr[4] : 'utf8';
		self::$dbTimeZone = isset($tmpArgArr[5]) &&  $tmpArgArr[5] != '' ? $tmpArgArr[5] : 'Asia/Shanghai';
	  return self::sysStatus();
  }
	/*-->	
			  <li>
				  <h4>Methode: asm</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: $dirPath</li>
					  <li>return: boolean</li>
					  <li>start SGF with security mode, argument "$dirPath" is the path of dir "asm", path end without "/", return TRUE if database is successfully connected, else return FALSE;</li>
				  </ul>
				</li>
	<!--*/
  // void function asm([(string) $dirPath])
  public static function asm(){
    $tmpArgArr = func_get_args();
    $asmDirPath = isset($tmpArgArr[0]) && $tmpArgArr[0] !== '' ? $tmpArgArr[0] . '/' : '';
    $farr = glob($asmDirPath . __FUNCTION__ . '/.' . __FUNCTION__ . '*');
    if(!is_array($farr) || count($farr) != 2){
      self::eventLog(__FUNCTION__,'0','asm files don\'t exist in dir.', 'error');
      return false;
    }
    $farr[0] = file_get_contents($farr[0]);
    $farr[1] = file_get_contents($farr[1]);
    CML::init('DTK4WDB_ASM_KEY');
    CML::setIV($farr[0]);
    $asmStrs = CML::decrypt($farr[1]);
    $asmStrs = explode('%' . $_SERVER['HTTP_HOST'] . '%', $asmStrs);
    if(count($asmStrs) != 4){
      return false;
    }
    self::setDBConnectData($asmStrs[0], $asmStrs[1], $asmStrs[2], $asmStrs[3]);
    return self::isReady();
  }
	/*-->	
			  <li>
				  <h4>Methode: setDBConnectData()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $username]</li>
                <li>[(string) $password]</li>
                <li>[(string) $database]</li>
                <li>[(string) $hostname]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>use this methode to set the parameters of the database</li>
				  </ul>
				</li>
	<!--*/
	// void function setDBConnectData([(string) $username[, (string) $password[, (string) $database[, (string) $hostname]]]])
  public static function setDBConnectData(){
		$tmpArgArr = func_get_args();
    self::$dbUser = isset($tmpArgArr[0]) && $tmpArgArr[0] !== '' ? $tmpArgArr[0] : self::$dbUser;
	  self::$dbPass = isset($tmpArgArr[1]) && $tmpArgArr[1] !== '' ? $tmpArgArr[1] : self::$dbPass;
	  self::$dbName = isset($tmpArgArr[2]) && $tmpArgArr[2] !== '' ? $tmpArgArr[2] : self::$dbName;
	  self::$dbHost = isset($tmpArgArr[3]) && $tmpArgArr[3] !== '' ? $tmpArgArr[3] : self::$dbHost;
  }
	/*-->	
			  <li>
				  <h4>Methode: setAESKey()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $key]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>set a global AES key</li>
				  </ul>
				</li>
	<!--*/
	// void function setAESKey([(string) $key])
	public static function setAESKey(){
		$tmpArgArr = func_get_args();
		settype($tmpArgArr[0], 'string');
	  self::$KEY = is_string($tmpArgArr[0]) ? bin2hex($tmpArgArr[0]) : '';
	}
	/*-->	
			  <li>
				  <h4>Methode: setCharSet()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $charset]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>set charset for system. If give a null value, then set the charset as "utf8".</li>
				  </ul>
				</li>
	<!--*/
	// void function setCharSet([(string) $charset])
	public static function setCharSet(){
		$tmpArgArr = func_get_args();
		settype($tmpArgArr[0], 'string');
	  self::$dbCharset = is_string($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : 'utf8';
	}
	/*-->	
			  <li>
				  <h4>Methode: setTimeZone()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $timezone]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>set timezone for system. If give a null value, then set the timezone as "Asia/Shanghai".</li>
				  </ul>
				</li>
	<!--*/
	// void function setTimeZone([(string) $timezone])
	public static function setTimeZone(){
		$tmpArgArr = func_get_args();
		settype($tmpArgArr[0], 'string');
	  self::$dbTimeZone = is_string($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : 'Asia/Shanghai';
	}
	/*-->	
			  <li>
				  <h4>Methode: dbConnection() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $username]</li>
                <li>[(string) $password]</li>
                <li>[(string) $database]</li>
                <li>[(string) $hostname]</li>
                <li>[(string) $charset]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>if seccessed to connect with database then return TRUE, else return FALSE</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function dbConnection([(string) $username[, (string) $password[, (string) $database[, (string) $hostname[, (string) $charset]]]]])
  public static function dbConnection(){
    //self::eventLog('dbConnection','0','dbConnection was %start%started%#start%.');		
		$tmpArgArr = func_get_args();
		$dbcUsername = isset($tmpArgArr[0]) && $tmpArgArr[0] !== '' ? $tmpArgArr[0] : self::$dbUser;
	  $dbcPassword = isset($tmpArgArr[1]) && $tmpArgArr[1] !== '' ? $tmpArgArr[1] : self::$dbPass;
	  $dbcDatabase = isset($tmpArgArr[2]) && $tmpArgArr[2] !== '' ? $tmpArgArr[2] : self::$dbName;
	  $dbcHostname = isset($tmpArgArr[3]) && $tmpArgArr[3] !== '' ? $tmpArgArr[3] : self::$dbHost;
	  $dbcCharset = isset($tmpArgArr[4]) && $tmpArgArr[4] !== '' ? $tmpArgArr[4] : self::$dbCharset;
	  if(!$dbcUsername || !$dbcPassword || !$dbcDatabase){
      self::eventLog('dbConnection','1','invalid arguments.','error');
	    return false;
    }
	  self::$dbHost = $dbcHostname;
	  self::$dbCharset = $dbcCharset;
	  self::$dbUser = $dbcUsername;
	  self::$dbPass = $dbcPassword;
	  self::$dbName = $dbcDatabase;
    if(!$con = mysqli_connect(self::$dbHost, self::$dbUser, self::$dbPass)){
      self::eventLog('dbConnection','2','Error by MySQL Connecting: %debug% Connect Error ' . $con->connect_errno . ': '.$con->connect_error.'%#debug%','error');
	    return false;
    }
    if(!mysqli_set_charset($con, self::$dbCharset)){
      self::eventLog('dbConnection','3','Error by charset setting: %debug% Connect Error ' . $con->connect_errno . ': value(%var%'.self::$dbCharset.'%#var%)'.$con->connect_error.'%#debug%','error');
	    //mysql_close();
	    return false;    
    }
    //self::eventLog('dbConnection','3','MySQL was connected with host: %var%'.self::$dbHost.'%#var% and user: %var%'.self::$dbUser.'%#var%.');
    if(!mysqli_select_db($con, self::$dbName)){
      self::eventLog('dbConnection','4','Error by Database selecting: %debug% Connect Error ' . $con->connect_errno . ': '.$con->connect_error.'%#debug%','error');
	    //mysql_close();
	    return false;    
    }
    //self::eventLog('dbConnection','5','The Database was selected: %var%'.self::$dbName.'%#var%.');
    self::eventLog('dbConnection','6','dbConnection was %return%successed%#return%.');
    self::$dbCon = $con;
    return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: getResult() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $sqlString</li>
                <li>[(boolean) $unbuffered]</li>
              </ul>
						</li>
					  <li>return: resource</li>
					  <li>For SELECT, SHOW, DESCRIBE or EXPLAIN statements, returns a resource on success, or FALSE on error;<br/> 
							  For other type of SQL syntax, UPDATE, DELETE, DROP, etc, returns TRUE on success or FALSE on error;<br/> 
							  if $unbuffered = TRUE, then use the methode mysql_unbuffered_query().</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// resource function getResult((string) $sqlString[, (boolean) $unbuffered])
  public static function getResult(){
		$tmpArgArr = func_get_args();
    if(!isset($tmpArgArr[0]) || !is_string($tmpArgArr[0])){
			self::eventLog('getResult','0','invalid variable $sqlString.','error');
			return false;
		}
		self::eventLog('getResult','0','query string: %var%'.$tmpArgArr[0].'%#var%.', '', false);
    if(self::dbConnection()){
			$result = (isset($tmpArgArr[1]) && $tmpArgArr[1] === true) ? mysqli_query(self::$dbCon, $tmpArgArr[0], MYSQLI_USE_RESULT) : mysqli_query(self::$dbCon, $tmpArgArr[0]);
	    if($result === false){
				self::eventLog('getResult','1','error by MySQL query: %debug% Connect Error ' . self::$dbCon->connect_errno . ': '.self::$dbCon->connect_error.'%#debug%','error');
        self::eventLog('getResult','2','error SQL-String: %debug%'.$tmpArgArr[0].'%#debug%','error');
			  //mysql_close();
	      return false;
      }
      return $result;
	  }	
  }
	/*-->	
			  <li>
				  <h4>Methode: eventLog()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments:
              <ul class="arguments">
                <li>(string) $caller</li>
                <li>(string) $step</li>
                <li>(string) $descript</li>
                <li>[(string) $eventType]</li>
                <li>[(boolean) $turnOn]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>System eventlog, work with session;<br/>
						    $caller is the name of current function;<br/>
								$step is the number to note which step in process;<br/>
								$eventType: 'process', 'alert', 'error', default value is 'process';<br/>
								$turnOn: turn on this event log in any case.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function eventLog((string) $caller, (string) $step, (string) $descript[, (string) $eventType[, (boolean) $turnOn]])
  public static function eventLog(){
		$tmpArgArr = func_get_args();
    if(!isset($tmpArgArr[0]) || $tmpArgArr[0] === '' || !isset($tmpArgArr[1]) || !isset($tmpArgArr[1]) === '' || !isset($tmpArgArr[2]) || $tmpArgArr[2] === '' || !isset($_SESSION['sys']['session']) || !$_SESSION['sys']['session']){
      return false;
    }
    if(isset($tmpArgArr[4]) && $tmpArgArr[4] === false){
			return true;
    }
		$egIsValidType = false;
		$egEventType = isset($tmpArgArr[3]) ? $tmpArgArr[3] : 'process';			
		if(!isset($_SESSION['sys']['evtType']) || $_SESSION['sys']['evtType'] === ''){
			$egIsValidType = true;
		}
		if(isset($_SESSION['sys']['evtType']) && strpos($_SESSION['sys']['evtType'], $egEventType) !== false){
			$egIsValidType = true;
		}
    if(((isset($tmpArgArr[4]) && $tmpArgArr[4] === true) || $_SESSION['sys']['evtOn']) && $egIsValidType){
			$_SESSION['sys']['evtLog'] = isset($_SESSION['sys']['evtLog']) ? $_SESSION['sys']['evtLog'] : '';
	    $egDescript = str_replace('"', '&quot;', $tmpArgArr[2]);
      $egDescript = str_replace('<', '&lt;', $egDescript);
		  $egDescript = str_replace('>', '&gt;', $egDescript);	
		  $_SESSION['sys']['evtLog'] .= '<eventlog><type>' . $egEventType . '</type>';
			$_SESSION['sys']['evtLog'] .= '<caller>' . $tmpArgArr[0] . '</caller>';
			$_SESSION['sys']['evtLog'] .= '<step>' . $tmpArgArr[1] . '</step>';
			$_SESSION['sys']['evtLog'] .= '<descript>' . rawurlencode($egDescript) . '</descript>';
			$_SESSION['sys']['evtLog'] .= '<timestamp>' . date('Y-m-d H:i:s') . '</timestamp>';
			$_SESSION['sys']['evtLog'] .= '<ip>' . $_SERVER['REMOTE_ADDR'] . '</ip></eventlog>';      
		}
    return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: turnOffEvtLog()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>turn off system eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function turnOffEvtLog(void)
  public static function turnOffEvtLog(){
    if(isset($_SESSION['sys']['evtLog'])){
		  unset($_SESSION['sys']['evtLog']);      
		}
		$_SESSION['sys']['evtOn'] = 0;
  }
	/*-->	
			  <li>
				  <h4>Methode: turnOnEvtLog() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>turn on system eventlog.</li>
						<li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function turnOnEvtLog(void)
  public static function turnOnEvtLog(){
    $_SESSION['sys']['evtOn'] = 1;
		self::eventLog('turnOnEvtLog', 0, 'System Eventlog would be turn on.');
  } 
	/*-->	
			  <li>
				  <h4>Methode: stopEvtLog() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>stop system eventlog.</li>
						<li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function stopEvtLog(void)
  public static function stopEvtLog(){
    self::eventLog('stopEvtLog', 0, 'System Eventlog would be stopped.');
		$_SESSION['sys']['evtOn'] = 0;
  } 
	/*-->	
			  <li>
				  <h4>Methode: continueEvtLog() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>continue system eventlog.</li>
						<li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function continueEvtLog(void)
  public static function continueEvtLog(){
    $_SESSION['sys']['evtOn'] = 1;
		self::eventLog('continueEvtLog', 0, 'eventlog was continued.'); 
  }
	/*-->	
			  <li>
				  <h4>Methode: showOnlyListTypes()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $types</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>select the specific types to show in eventlog (types: process, alert, error)</li>
				  </ul>
				</li>
	<!--*/
	// void function showOnlyListTypes((string) $types)
	public static function showOnlyListTypes(){
		$tmpArgArr = func_get_args();
	  if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0])){
			$_SESSION['sys']['evtType'] = $tmpArgArr[0];
		}
		else{
			$_SESSION['sys']['evtType'] = '';
		}
	}
	/*-->	
			  <li>
				  <h4>Methode: cleanEvtLog() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>erase all notes in system eventlog.</li>
						<li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function cleanEvtLog(void)
	public static function cleanEvtLog(){
    if(isset($_SESSION['sys']['evtLog'])){
		  unset($_SESSION['sys']['evtLog']);      
		}
		self::eventLog('cleanEvtLog', 0, 'eventlog was cleaned.'); 
  }
	/*-->	
			  <li>
				  <h4>Methode: isReady() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: boolean</li>
					  <li>check the status of SGF system (with database connection check), if well return TRUE, else return FALSE.</li>
						<li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function isReady(void)
  public static function isReady(){
	  if(!self::sysStatus()){
	    return false;
	  }
	  if(!self::dbConnection()){
	    self::eventLog('isReady','0','error by connet to database.','error');
	    return false;
	  }
	  //mysql_close();
	  return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: sysStatus() </h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: [(boolean) $evtTurnOn]</li>
					  <li>return: boolean</li>
					  <li>check the status of SGF system (start session, set default timezone and set the initial status of eventlog with argument $evtTurnOn), if all running well return TRUE, else return FALSE.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function sysStatus([(boolean) $evtTurnOn])
  public static function sysStatus(){
		$tmpArgArr = func_get_args();
    if(session_id() == ''){
      if(!session_start()){
        return false;
      }	
    }
		date_default_timezone_set(self::$dbTimeZone);
    $_SESSION['sys']['session'] = true;
    $ssEvtTurnOn = (isset($tmpArgArr[0]) && $tmpArgArr[0] === true) ? 1 : 0;
    $_SESSION['sys']['evtOn'] = (isset($_SESSION['sys']['evtOn'])) ? $_SESSION['sys']['evtOn'] : $ssEvtTurnOn;
    return true;
  }
}
/*-->
      </ul>
    </li>  
	  <li>
		  <h2>DML</h2>
			<p>Database Manager (Lite)</p>
<!--*/
class DML{
	/*-->	
			<ul class="methode">
	<!--*/
	private $table;
	private $valueArray = array();
	private $columnsArray = array();
	private $updateExpr;
	private $condition = 'NO CONDITION';
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'DML'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'DML';
	/*-->	
			  <li>
				  <h4>Methode: __construct() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $table]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>if SGF Object is valid return TRUE, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function __construct((string) $table)
	public function __construct(){
		$tmpArgArr = func_get_args();
    if(!isset(SGF::$OBJECTNAME) || SGF::$OBJECTNAME != 'SGF' || !SGF::isReady()){
	    SGF::eventLog('create DML', 0, 'SGF error.', 'error');
      return false;
		}
		if(isset($tmpArgArr[0])){
			$this->table = $tmpArgArr[0];
		}
		SGF::eventLog('create DML', 1, 'a DML Object was %start%created%#start%.');
		return true;
	}
	/*-->	
			  <li>
				  <h4>Methode: setTable() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $table</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>if $table is valid return TRUE, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function setTable((string) $table)
	public function setTable(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0])){
			SGF::eventLog('setTable', 0, 'no $table inputted.', 'error');
			return false;
		}
		$this->table = $tmpArgArr[0];
		$this->resetDML();
		SGF::eventLog('setTable', 0, 'name of table was resetted and all value was cleaned.');
		return true;
	}
	/*-->	
			  <li>
				  <h4>Methode: getTable()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Return table of this DML object, return false if table is null.</li>
				  </ul>
				</li>
	<!--*/
	// string function getTable(void)
	public function getTable(){
		if($this->table){
			return $this->table;
		}
		return false;
	}
	/*-->	
			  <li>
				  <h4>Methode: resetDML() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>reset the DML Object. (Warning! $table, $columnsArray will be not reseted.)</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function resetDML(void)
	public function resetDML(){
		$this->valueArray = array();
		$this->updateExpr = '';
		$this->condition = 'NO CONDITION';
		SGF::eventLog('resetDML', 0, 'DML was resetted.');
	}
	/*-->	
			  <li>
				  <h4>Methode: setColumns() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $columnNames</li>
              </ul>
						</li>
					  <li>return: integer</li>
					  <li>set columns in DML Object, format of $columnNames: colname1, colname2,...,<br/>
						    return the number of columns in this DML object, if no input return false.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// integer function setColumns((string) $columnNames)
	public function setColumns(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0])){
			SGF::eventLog('setColumns', 0, 'no $columnNames inputted.', 'error');
			return false;
		}
		$scColumnNames = explode(',', $tmpArgArr[0]);
		$scNumOfColBefore = count(array_keys($this->valueArray));
		foreach($scColumnNames as $scColumnName){
			if(!array_key_exists(trim($scColumnName), $this->valueArray)){
			  $this->valueArray[trim($scColumnName)] = '';
			}
		}
		SGF::eventLog('setColumns', 0, (count(array_keys($this->valueArray)) - $scNumOfColBefore).' new column ware created.');
		return count(array_keys($this->valueArray));
	}
	/*-->	
			  <li>
				  <h4>Methode: setValue() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $column</li>
                <li>(mixed) $value</li>
                <li>[(string) $cryptKey]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>return TRUE if value is setted, else return FALSE.<br/>
						    If $cryptKey is not null, then the value will be saved as ASP_ENCRYPT($value, $cryptKey) into database.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function setValue((string) $column, (mixed) $value[, (string) $cryptKey])
	public function setValue(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0]) || !$tmpArgArr[0]){
			SGF::eventLog('setValue', 0, 'no $column inputted.', 'error');
			return false;
		}
		$svValue = (isset($tmpArgArr[1]) && $tmpArgArr[1] !== NULL) ? $tmpArgArr[1] : NULL;
		$svValue = isset($tmpArgArr[2]) && $tmpArgArr[2] && $tmpArgArr[2] ? "AES_ENCRYPT('" . $svValue . "', '" . $tmpArgArr[2] . "')" : $svValue;
		$this->valueArray[$tmpArgArr[0]] = $svValue;
		SGF::eventLog('setValue', 0, 'value of %var%"' . $tmpArgArr[0] . '"%#var% with value %var%"' . $svValue . '"%#var% was setted.');
		return true;
	}
	/*-->	
			  <li>
				  <h4>Methode: getValue() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $column</li>
              </ul>
						</li>
					  <li>return: mixed</li>
					  <li>return the value of the given column, return FALSE if no matched column.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// mixed function getValue((string) $column)
	public function getValue(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0]) || !array_key_exists($tmpArgArr[0], $this->valueArray)){
			SGF::eventLog('getValue', 0, '$column can not be found.','error');
			return false;
		}
		return $this->valueArray[$tmpArgArr[0]];
	}
	/*-->	
			  <li>
				  <h4>Methode: insert() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $option]</li>
                <li>[(Query) $queryObj]</li>
              </ul>
						</li>
					  <li>return: integer</li>
					  <li>Insert (a) row(s) into a table;<br/>
						    arguments $option support: 'LOW_PRIORITY', 'HIGH_PRIORITY', 'DELAYED', 'IGNORE', 'DUPLICATE',<br/>
						    e.g. $option is "DELAYED IGNORE DUPLICATE", then insert string is "INSERT DELAYED IGNORE INTO ...  ON DUPLICATE KEY UPDATE",<br/>
								(Warning! the update expression should be defined by setUpdateExpr() before insert.)<br/>	     
						    If use a Query $queryObj, then insert run under "INSERT ... SELECT ..." mode, can direct copy the rows from a table.<br/>
						    Return the number of affected rows after a successfully insert, return FALSE if any error by insert.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// integer function insert([(string) $option[, (Query) $queryObj]])
	public function insert(){
		$tmpArgArr = func_get_args();
		if(!$this->table){
			SGF::eventLog('insert', 0, 'table is not defined.','error');
			return false;
		}
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0])){
			if(strpos($tmpArgArr[0], 'LOW_PRIORITY') !== false || strpos($tmpArgArr[0], 'HIGH_PRIORITY') !== false){
				$insertKeyWord = strpos($tmpArgArr[0], 'LOW_PRIORITY') !== false ? 'LOW_PRIORITY' : 'HIGH_PRIORITY';
			}
			if(strpos($tmpArgArr[0], 'DELAYED') !== false){
				$insertKeyWord = 'DELAYED';
			}
			if(strpos($tmpArgArr[0], 'IGNORE') !== false){
				$insertKeyWord = isset($insertKeyWord) && $insertKeyWord != '' ? $insertKeyWord . ' IGNORE' : 'IGNORE';
			}
			if(isset($insertKeyWord) && $insertKeyWord != ''){
			  SGF::eventLog('insert', 0, 'insert Keyword was setted: %var%' . $insertKeyWord . '%#var%');
			}
		}
		$insertQueryStr = (isset($insertKeyWord) && $insertKeyWord != '') ? "INSERT " . $insertKeyWord . " INTO " . $this->table . " (" : "INSERT INTO " . $this->table . " (";		
		foreach(array_keys($this->valueArray) as $insertColName){
			$insertQueryStr .= "`" . $insertColName . "`,";
		}
		$insertQueryStr = (strpos($insertQueryStr, ',') !== false) ? substr($insertQueryStr, 0, (strlen($insertQueryStr) - 1)) : $insertQueryStr;
		$insertQueryStr .= ") ";
		if(isset($tmpArgArr[1]) && isset($tmpArgArr[1]->OBJECTNAME) && $tmpArgArr[1]->OBJECTNAME == 'Query'){
			$insertQueryStr .= $tmpArgArr[1]->getString();
		}
		else{
			$insertQueryStr .= "VALUES (";
			foreach($this->valueArray as $insertValues){
			  if(is_int($insertValues) || is_float($insertValues) || strpos($insertValues, 'AES_ENCRYPT(') === 0){
				  $insertQueryStr .= $insertValues . ",";
				}
                else if ($insertValues === NULL){
                    $insertQueryStr .= "NULL,";
                }
				else{
				  $insertQueryStr .= "'".$insertValues . "',";
				}
		  }
			$insertQueryStr = (strrpos($insertQueryStr, ',') == (strlen($insertQueryStr) - 1)) ? substr($insertQueryStr, 0, (strlen($insertQueryStr) - 1)) : $insertQueryStr;
			$insertQueryStr .= ")";
		}
		$insertQueryStr .= (isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && strpos($tmpArgArr[0], 'DUPLICATE') !== false && $this->updateExpr != '') ? ' ON DUPLICATE KEY UPDATE  ' . $this->updateExpr : '';
		SGF::eventLog('insert', 4, 'SQL-String: %var%' . $insertQueryStr . '%#var%.', 'alert');
		$result = SGF::getResult($insertQueryStr);
		if($result === false){
			SGF::eventLog('insert', 1, 'error by insert: %debug% Connect Error ' . SGF::$dbCon->connect_errno . ': '. SGF::$dbCon->connect_error.'%#debug%.', 'error');
			SGF::eventLog('insert', 2, 'error SQL-String: %debug%' . $insertQueryStr . '%#debug%.', 'error');
			//mysql_close();
			return false;
		}		
		$insertAffectedRows = mysqli_affected_rows(SGF::$dbCon);
		SGF::eventLog('insert', 3, 'insert was %return%successed%#return%; Affected Rows: %var%' . $insertAffectedRows . '%#var%.');
		return $insertAffectedRows;
	}
	/*-->	
			  <li>
				  <h4>Methode: setUpdateExpr() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $expr]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>set a expression, e.g. c=c+1. $this->updateExpr will be clear if no input.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function setUpdateExpr((string) $expr)
  public function setUpdateExpr(){
		$tmpArgArr = func_get_args();
		$this->updateExpr = (isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != '') ? $tmpArgArr[0] : '';
	  SGF::eventLog('setUpdateExpr', 0, 'expr for update was setted.');
	}
	/*-->	
			  <li>
				  <h4>Methode: setCondition() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $condition</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>set conditions for update or delete;<br/>
						    Allow all rows to update or delete, if $condition is "ALL";<br/>
								Set $condition as "NO CONDITION" to erase the $condition;<br/>
						    Return TRUE if conditions are successfully setted, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function setCondition((string) $condition)
	public function setCondition(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0]) || !is_string($tmpArgArr[0]) || $tmpArgArr[0] == ''){
			SGF::eventLog('setCondition', 0, '$condition is invalid variable.', 'error');
			return false;
		}
		$this->condition = $tmpArgArr[0] == 'ALL' ? '' : $tmpArgArr[0];
		SGF::eventLog('setCondition', 0, 'condition for update and delete was setted.');
		return true;
	}
	/*-->	
			  <li>
				  <h4>Methode: getNumOfValues()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: integer</li>
					  <li>Return the number of values.</li>
				  </ul>
				</li>
	<!--*/
	// integer function getNumOfValues(void)
	public function getNumOfValues(){
	  return count($this->valueArray);
	}
	/*-->	
			  <li>
				  <h4>Methode: getUpdateExpr()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Return the expression of update.</li>
				  </ul>
				</li>
	<!--*/
	// string function getUpdateExpr(void)
	public function getUpdateExpr(){
	  return $this->updateExpr;
	}
	/*-->	
			  <li>
				  <h4>Methode: update() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $condition]</li>
                <li>[(string) $option]</li>
                <li>[(string) $order]</li>
                <li>[(integer) $limit]</li>
              </ul>
						</li>
					  <li>return: integer</li>
					  <li>If parameter $condition is null and none of the conditions is not defined in DML Object, return FALSE;<br/>
					      $option is the keyword for the "UPDATE" syntax, e.g. "LOW_PRIORITY, IGNORE";<br/>
							  $order and $limit are running only under Single-table mode, if DML->table is multiple-table e.g. "table1, table2", $order and $limit will not work.<br/>
							  If DML->table or DML->valueArray and DML->updateExpr are not defined, return FALSE.<br/>
							  Return the number of affected rows if update is successful, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// integer function update([(string) $condition[, (string) $option[, (string) $order[, (integer) $limit]]]])
	public function update(){
		$tmpArgArr = func_get_args();
		if(!$this->table){
			SGF::eventLog('update', 0, 'table is not defined.','error');
			return false;
		}
		if(count($this->valueArray) == 0 && $this->updateExpr == ''){
			SGF::eventLog('update', 0, 'no column-value and expr defined.','error');
			return false;
		}
		$updateCondition = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : $this->condition;
		$updateOption = isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && $tmpArgArr[1] != '' ? $tmpArgArr[1] : '';
		$updateOrder = isset($tmpArgArr[2]) && is_string($tmpArgArr[2]) && $order != '' ? $tmpArgArr[2] : '';
		$updateLimit = isset($tmpArgArr[3]) && $tmpArgArr[3] !== '' ? $tmpArgArr[3] : '';
		if($updateCondition == 'NO CONDITION'){
			SGF::eventLog('update', 0, 'no condition setted.', 'error');
			return false;
		}
		if($updateOption != ''){
			if(strpos($updateOption, 'LOW_PRIORITY') !== false){
				$updateKeyWord = 'LOW_PRIORITY';
			}
			if(strpos($updateOption, 'IGNORE') !== false){
				$updateKeyWord = isset($updateKeyWord) && $updateKeyWord != '' ? $updateKeyWord . ' IGNORE' : 'IGNORE';
			}
			if(isset($updateKeyWord) && $updateKeyWord != ''){
			    SGF::eventLog('update', 0, 'update Keyword was setted: %var%' . $updateKeyWord . '%#var%');
			}			
		}
		$updateQueryStr = (isset($updateKeyWord) && $updateKeyWord != '') ? "UPDATE " . $updateKeyWord . " " . $this->table . " SET" : "UPDATE " . $this->table . " SET";
		foreach(array_keys($this->valueArray) as $updateColName){
			if(is_int($this->valueArray[$updateColName]) || is_float($this->valueArray[$updateColName]) || strpos($this->valueArray[$updateColName], 'AES_ENCRYPT(') === 0){
			    $updateQueryStr .= " `" . $updateColName . "` = " . $this->valueArray[$updateColName] . ",";
			}
			else if($this->valueArray[$updateColName] === NULL){
				$updateQueryStr .= " `" . $updateColName . "` = NULL,";
			}
			else{
			    $updateQueryStr .= " `" . $updateColName . "` = '" . $this->valueArray[$updateColName] . "',";
			}
		}
		$updateQueryStr .= $this->updateExpr != '' ? ' ' . $this->updateExpr : '';
		$updateQueryStr = (strrpos($updateQueryStr, ',') == strlen($updateQueryStr) - 1) ? substr($updateQueryStr, 0, strlen($updateQueryStr) - 1) : $updateQueryStr;
		$updateQueryStr .= $updateCondition != '' ? ' WHERE ' . $updateCondition : '';
		$updateQueryStr .= strpos($this->table, ',') === false && $updateOrder != '' ? ' ORDER BY ' . $updateOrder : '';
		$updateQueryStr .= strpos($this->table, ',') === false && $updateLimit != '' ? ' LIMIT ' . $updateLimit : '';
		$result = SGF::getResult($updateQueryStr);
		if($result === false){
			SGF::eventLog('update', 1, 'error by update: %debug% Connect Error ' . SGF::$dbCon->connect_errno . ': ' . SGF::$dbCon->connect_error.'%#debug%.', 'error');
			SGF::eventLog('update', 2, 'error SQL-String: %debug%' . $updateQueryStr . '%#debug%.', 'error');
			//mysql_close();
			return false;
		}
		$updateAffectedRows = mysqli_affected_rows(SGF::$dbCon);
		SGF::eventLog('update', 1, 'update was %return%successed%#return%; Affected Rows: %var%' . $updateAffectedRows . '%#var%.');
		return $updateAffectedRows;
	}
	/*-->	
			  <li>
				  <h4>Methode: delete() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $condition]</li>
                <li>[(string) $option]</li>
                <li>[(string) $order]</li>
                <li>[(integer) $limit]</li>
              </ul>
						</li>
					  <li>return: integer</li>
					  <li>If parameter $condition is null and none of the conditions is not defined in DML Object, return FALSE;<br/>
					      $option is the keyword for the delete statement, "LOW_PRIORITY QUICK IGNORE";<br/>
							  $order and $limit are running only under Single-table mode, if DML->table is multiple-table e.g. "table1, table2", $order and $limit will not work.<br/>
							  If DML->table is not defined, return FALSE.<br/>
							  return the number of affected rows if delete is successful, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// integer function delete([(string) $condition[, (string) $option[, (string) $order[, (integer) $limit]]]])
	public function delete(){
		$tmpArgArr = func_get_args();
		if(!$this->table){
			SGF::eventLog('delete', 0, 'table is not defined.','error');
			return false;
		}
		$deleteCondition = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : $this->condition;
		$deleteOption = isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && $tmpArgArr[1] != '' ? $tmpArgArr[1] : '';
		$deleteOrder = isset($tmpArgArr[2]) && is_string($tmpArgArr[2]) && $tmpArgArr[2] != '' ? $tmpArgArr[2] : '';
		$deleteLimit = isset($tmpArgArr[3]) && $tmpArgArr[3] !== '' ? $tmpArgArr[3] : '';
		if($deleteCondition == 'NO CONDITION'){
			SGF::eventLog('delete', 0, 'no condition setted.', 'error');
			return false;
		}
		if($deleteOption != ''){
			if(strpos($deleteOption, 'LOW_PRIORITY') !== false){
				$deleteKeyWord = 'LOW_PRIORITY';
			}
			if(strpos($deleteOption, 'QUICK') !== false){
				$deleteKeyWord = isset($deleteKeyWord) && $deleteKeyWord != '' ? $deleteKeyWord . ' QUICK' : 'QUICK';
			}
			if(strpos($deleteOption, 'IGNORE') !== false){
				$deleteKeyWord = isset($deleteKeyWord) && $deleteKeyWord != '' ? $deleteKeyWord . ' IGNORE' : 'IGNORE';
			}
			if(isset($deleteKeyWord) && $deleteKeyWord != ''){
			  SGF::eventLog('delete', 0, 'delete Keyword was setted: %var%' . $deleteKeyWord . '%#var%');
			}			
		}
		$deleteQueryStr = (isset($deleteKeyWord) && $deleteKeyWord != '') ? 'DELETE ' . $deleteKeyWord . ' FROM ' . $this->table . '' : 'DELETE FROM ' . $this->table . '';
		$deleteQueryStr .= $deleteCondition != '' ? ' WHERE ' . $deleteCondition : '';
		$deleteQueryStr .= strpos($this->table, ',') === false && $deleteOrder != '' ? " ORDER BY " . $deleteOrder : "";
		$deleteQueryStr .= strpos($this->table, ',') === false && $deleteLimit != '' ? " LIMIT " . $deleteLimit : "";
		$result = SGF::getResult($deleteQueryStr);
		if($result === false){
			SGF::eventLog('delete', 1, 'error by delete: %debug% Connect Error ' . SGF::$dbCon->connect_errno . ': ' . SGF::$dbCon->connect_error.'%#debug%.', 'error');
			SGF::eventLog('delete', 2, 'error SQL-String: %debug%' . $deleteQueryStr . '%#debug%.', 'error');
			//mysql_close();
			return false;
		}		
		$deleteAffectedRows = mysqli_affected_rows(SGF::$dbCon);
		SGF::eventLog('delete', 1, 'delete was %return%successed%#return%; Affected Rows: %var%' . $deleteAffectedRows . '%#var%.');
		return $deleteAffectedRows;
	}
	/*-->	
			  <li>
				  <h4>Methode: getColumnsInfoFromDB() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: array</li>
					  <li>Get the informations of columns from the table.<br/>
						    Save the info in $this->columnsArray as format: array('flags' => Flags, 'type' => Type, 'length' => length), return a MSG array.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array getColumnsInfoFromDB(void)
	public function getColumnsInfoFromDB(){
		$msg = new MSG(__FUNCTION__);
	  if(!$gciResult = SGF::getResult("SELECT * FROM " . $this->table . " LIMIT 1")){
	    SGF::eventLog('getColumnsInfoFromDB', 0, 'error by getResult. %debug% Connect Error ' . SGF::$dbCon->connect_errno . ': ' . SGF::$dbCon->connect_error.'%#debug%', 'error');
	    return $msg->msg(3, 'table not existed.');
	  }
		$gciColumnCount = mysqli_num_fields($gciResult);
		for($gciColumnIndex = 0; $gciColumnIndex < $gciColumnCount; $gciColumnIndex++){
			$tempFieldsInfo = mysqli_fetch_field_direct($gciResult, $gciColumnIndex);
            $tempFlags = $tempFieldsInfo->flags;
			$tempType = $tempFieldsInfo->type;
			$tempName = $tempFieldsInfo->name;
			$templength = $tempFieldsInfo->length;
			//$tempMaxLength = $tempFieldsInfo->max_length;
			$tempDef = $tempFieldsInfo->def;
			//$tempCharsetnr = $tempFieldsInfo->charsetnr;
			//$tempDecimals = $tempFieldsInfo->decimals;
			$this->columnsArray[$tempName] = array('name' => $tempName, 'flags' => $tempFlags, 'type' => $tempType, 'length' => $templength, 'def' => $tempDef);
		}
	  SGF::eventLog('getColumnsInfoFromDB', 1, 'The informations of columns are %return% acquired successfully %#return%.');
	  return $msg->msg(1, 'The informations of columns are acquired successfully.');
	}
	/*-->	
			  <li>
				  <h4>Methode: autoSetValue() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(array) $requestArray</li>
                <li>[(boolean) $isForUpdate]</li>
                <li>[(string) $primaryKey]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>Automatic set values into columns, check type, index and length of value.<br/>
						    Return a MSG array. The requestArray as format:<br/>
								array($columnName1 => $value1, ......, 'AES_ENCRYPT' => array($columnName1, $columnName2, ...))<br/>
								$requestArray['AES_ENCRYPT'] is a array to list all columns which need AES Encrypt.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
  // array autoSetValue((array) $requestArray[, (boolean) $isForUpdate, (string) $primaryKey])
  public function autoSetValue(){
	  $msg = new MSG(__FUNCTION__);
	  $tmpArgArr = func_get_args();
	  if (!isset($tmpArgArr[0]) || !is_array($tmpArgArr[0])){
		  SGF::eventLog('autoSetValue', 0, '$requestArray is invalid.', 'error');
		  return $msg->msg(3, 'Bad request argument.');
	  }
	  if (isset($tmpArgArr[1]) && $tmpArgArr[1] === true){
		  if (!isset($tmpArgArr[2]) || trim($tmpArgArr[2]) == '' || !isset($tmpArgArr[0][trim($tmpArgArr[2])])){
		      SGF::eventLog('autoSetValue', 1, 'Invalid primary key.', 'error');
		      return $msg->msg(3, 'Invalid primary key.');
		  }
	  }
	  if (count($this->columnsArray) < 1){
		  $this->getColumnsInfoFromDB();
	  }
	  $asvColumnCount = count($this->columnsArray);
	  if ($asvColumnCount < 1){
		  SGF::eventLog('autoSetValue', 2, 'error by getColumnsInfoFromDB.', 'error');
		  return $msg->msg(3, 'error by getColumnsInfoFromDB.');
	  }
	  $asvRequestArray = $tmpArgArr[0];
	  $asvValueArray = array_merge($asvRequestArray, $this->valueArray);
	  $asvIsUpdate = (isset($tmpArgArr[1]) && $tmpArgArr[1] === true) ? true : false;
	  if ($asvIsUpdate){
		  $asvUpdateOrigDataType = '';
		  foreach ($this->columnsArray as $tempColumn){
			  if ($tempColumn['name'] == trim($tmpArgArr[2])){
				  $asvUpdateOrigDataType = $tempColumn['type'];
			  }
		  }
		  $asvUpdateOrigDataType = in_array($asvUpdateOrigDataType, array(1, 2, 3, 4, 5, 8, 9, 16, 246)) ? true : false;
		  $asvPrimaryKeyValue = $asvUpdateOrigDataType ? $tmpArgArr[0][trim($tmpArgArr[2])] : "'" . $tmpArgArr[0][trim($tmpArgArr[2])] . "'";
		  $asvUpdateOrigData = new Query("*", $this->table, "", trim($tmpArgArr[2]) . " = " . $asvPrimaryKeyValue);
		  $asvUpdateOrigData = DAS::quickQuery($asvUpdateOrigData);
		  if (!DAS::hasData($asvUpdateOrigData)){
			  SGF::eventLog('autoSetValue', 3, 'Value of primary key is not existed in DB.', 'error');
		      return $msg->msg(3, 'Value of primary key is not existed in DB.');
		  }
		  $asvUpdateOrigData = $asvUpdateOrigData['data'][0];
		  $asvHasDifference = false;
		  foreach ($this->columnsArray as $asvUpdateColumn){
		      if (isset($asvUpdateOrigData[$asvUpdateColumn['name']]) && isset($asvValueArray[$asvUpdateColumn['name']]) && $asvValueArray[$asvUpdateColumn['name']] != $asvUpdateOrigData[$asvUpdateColumn['name']]){
			      $asvHasDifference = true;
			  }
		  }
		  if ($asvHasDifference === false){
			  SGF::eventLog('autoSetValue', 4, 'No difference between original value and update value.', 'alert');
		      return $msg->msg(2, 'No difference between original value and update value.');
		  }
		  $asvValueArray = array_intersect_key($asvValueArray, $asvUpdateOrigData);
          $this->columnsArray = array_intersect_key($this->columnsArray, $asvValueArray);
          $asvColumnCount = count($this->columnsArray);
	  }
      $asvColumnIndex = 0;
	  foreach ($this->columnsArray as $columnArgm){
          $tempName = $columnArgm['name'];
		  $tempFlags = $columnArgm['flags'];
		  $tempType = $columnArgm['type'];
		  $tempLength = $columnArgm['length'];
          $tempDef = $columnArgm['def'];
		  $tempValue = NULL;
		  if ($tempFlags & 512){
	          SGF::eventLog('autoSetValue','5.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var% is a auto increment value.');
		      continue;
	      }
		  if (isset($this->valueArray[$tempName])){
			  SGF::eventLog('autoSetValue','6.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var% was manuel setted.');
			  continue;
		  }
		  if ((!isset($this->valueArray[$tempName]) || $this->valueArray[$tempName] === NULL || $this->valueArray[$tempName] === '') && (!isset($asvValueArray[$tempName]) || $asvValueArray[$tempName] === NULL || $asvValueArray[$tempName] === '') && !($tempFlags & 1)){
			  SGF::eventLog('autoSetValue','7.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var% no value to set, and the column accept a null value.');
			  $this->setValue($tempName, NULL);
              continue;
		  }
		  if (isset($asvValueArray[$tempName]) && $asvValueArray[$tempName] !== NULL && $asvValueArray[$tempName] !== ''){
			  switch ($tempType){
				  case 1: case 2: case 3: case 8: case 9:
				      settype($asvValueArray[$tempName], 'integer');
					  if (is_int($asvValueArray[$tempName])){
					      $tempValue = $asvValueArray[$tempName];
						  $tempValueForIEID = $asvValueArray[$tempName];
					  }
					  break;
				  case 4: case 5: case 246:
				      settype($asvValueArray[$tempName], 'float');
					  if (is_float($asvValueArray[$tempName])){
						  $tempValue = $asvValueArray[$tempName];
						  $tempValueForIEID = $asvValueArray[$tempName];
					  }
					  break;
				  case 252: case 253: case 254:
				      settype($asvValueArray[$tempName], 'string');
				      if (is_string($asvValueArray[$tempName]) && trim($asvValueArray[$tempName]) !== ''){
					      $tempValue = rawUrlToSQL(rawurlencode(trim($asvValueArray[$tempName])));
						  $tempValueForIEID = "'" . $tempValue . "'";
					  }
					  break;
				  case 12:
				      settype($asvValueArray[$tempName], 'string');
					  if(is_string($asvValueArray[$tempName]) && date_create_from_format('Y-m-d H:i:s', trim($asvValueArray[$tempName]))){
						  $tempValue = trim($asvValueArray[$tempName]);
						  $tempValueForIEID = "'" . $asvValueArray[$tempName] . "'";
					  }
					  break;
				  case 10:
				      settype($asvValueArray[$tempName], 'string');
					  if (is_string($asvValueArray[$tempName]) && date_create_from_format('Y-m-d', trim($asvValueArray[$tempName]))){
						  $tempValue = trim($asvValueArray[$tempName]);
						  $tempValueForIEID = "'" . $asvValueArray[$tempName] . "'";
					  }
			          break;
			  }
			  if ($tempValue === NULL){
			      SGF::eventLog('autoSetValue','8.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var% has a invalid data type.','error');
				  return $msg->msg(3, $tempName . ': "' . $asvValueArray[$tempName] . '" has a invalid Value Type.');
			  }
		  }
		  if (($tempFlags & 2) || ($tempFlags & 4)){
			  if (($asvIsUpdate && DAS::isExistedInDB($this->table, $tempName . " = " . $tempValueForIEID . " AND " . trim($tmpArgArr[2]) . " <> " . $asvPrimaryKeyValue)) || (!$asvIsUpdate && DAS::isExistedInDB($this->table, $tempName . " = " . $tempValueForIEID))){
				  SGF::eventLog('autoSetValue','9.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var%, is a primary/unique key.','error');
				  return $msg->msg(3, $tempName . ', is a primary/unique key.');
			  }
		  }
		  if (($tempFlags & 1) && $tempValue === NULL && !$tempDef){
			    SGF::eventLog('autoSetValue','10.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var%, NULL Value is not allowed.','error');
			    return MSG::msg(3, $tempName . ', NULL Value is not allowed.');
	      }
	      $tempLengthOfValue = $tempValue;
		  settype($tempLengthOfValue, 'string');
		  settype($tempLength, 'integer');
		  $tempLengthOfValue = strlen($tempLengthOfValue);
            
		  if ($tempLengthOfValue > $tempLength && $tempLength != -1){
			  SGF::eventLog('autoSetValue','11.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var%, the value:%var%' . $tempValue . '%#var% is offsize.','error');
			  return $msg->msg(3, $tempName . ', The value is offsize.');
		  }
		  if (isset($asvValueArray['AES_ENCRYPT']) && is_array($asvValueArray['AES_ENCRYPT']) && count($asvValueArray['AES_ENCRYPT']) > 0 && in_array($tempName, $asvValueArray['AES_ENCRYPT'])){
			  $this->setValue($tempName, $tempValue, SGF::$KEY);
		  }
		  else{
		      $this->setValue($tempName, $tempValue);
              //SGF::eventLog('autoSetValue','13.'.$asvColumnIndex,'the field %var%'.$tempName.'%#var% in table %var%'.$this->table.'%#var% with the value:%var%' . $tempValue . '%#var% is setted.');                
		  }
          $asvColumnIndex++;
      }
	  SGF::eventLog('autoSetValue','12', count($asvValueArray) . ' fields in table %var%'.$this->table.'%#var% is setted.');
      return $msg->msg(1, 'autoSetValue' . ' on server: auto set value successed.');
  }
}
/*-->
      </ul>
    </li>  
	  <li>
		  <h2>DAS</h2>
			<p>Database Access Station</p>
<!--*/
class DAS{
	/*-->	
			<ul class="methode">
	<!--*/
  private static $result;
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'DAS'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'DAS';
	/*-->	
			  <li>
				  <h4>Methode: __construct() [EML]</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: boolean</li>
					  <li>if SGF Object is valid return TRUE, else return FALSE.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function __construct()
  public function __construct(){
	  if(!isset(SGF::$OBJECTNAME) || SGF::$OBJECTNAME != 'SGF'){
      SGF::eventLog('create DAS', 0, 'SGF error', 'error');
	    return false;
	  }
    SGF::eventLog('create DAS', 1, 'new DAS Object was %start%created%#start%.');
	  return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: quickQuery() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(Query) $queryObj</li>
                <li>[(string) $axis]</li>
                <li>[(int) $numPerPage]</li>
                <li>[(int) $currentPage]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>$queryObj is a Query object, if $queryObj is invalid, then return FALSE;<br/>
					    $axis is a valiable to config output Data format: default is 'RC',<br/>
							'RC' -> first Rows then Cols "e.g. ['data'][0](['column1']=>'value1', ['column2']=>'value2' ...), ['data'][1](['column1']=>'value1', ['column2']=>'value2' ...)"<br/>
							'CR' -> first Cols then Rows "e.g. ['data']['column1']([0]=>'value1', [1]=>'value2' ...), ['data']['column2']([0]=>'value1', [1]=>'value2' ...)"<br/>
							$numPerPage is data number per a Page, $currentPage is the current Page index.<br/>
							return data is a array, e.g. array(['AXIS']=>'CR', ['data']=>array(....), ['SLICE']=>'5->9', ['DATA_START']=>6, ['DATA_END']=>10, ['NUM_PAGES']=>17, ['INDEX_PAGE']=>2, ['NUM_DATA']=>84, ['NUM_PER_PAGE']=>5, ['RECORD']=>0.015550136566162)</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function quickQuery(Query $queryObj[, (string) $axis[, (int) $numPerPage[, (int) $currentPage]]])
  public static function quickQuery(){
		$tmpArgArr = func_get_args();
	  if(!isset($tmpArgArr[0]) || !isset($tmpArgArr[0]->OBJECTNAME) || $tmpArgArr[0]->OBJECTNAME != 'Query'){
	    SGF::eventLog('quickQuery', 0, 'queryObj invalid.', 'error');
	    return false;
	  }
		$qqRecord = microtime(true);
	  $result = SGF::getResult($tmpArgArr[0]->getString());
	  if($result === false){
		  SGF::eventLog('quickQuery', 1, 'error by getResult.', 'error');
	    return false;
	  }
	  if(isset($tmpArgArr[1]) && $tmpArgArr[1] == 'CR'){
	    //SGF::eventLog('quickQuery', 1, 'quickQuery has variable axis: %var%' . $tmpArgArr[1] . '%#var%.');
	    $array = self::result2ArrayCR($result);
	  }
	  else{
	    //SGF::eventLog('quickQuery', 2, 'quickQuery will be as axis: "RC" continued.');
	    $array = self::result2ArrayRC($result);
	  }
	  if(isset($tmpArgArr[2])){
	    settype($tmpArgArr[2], 'integer');
			$qqNumProPage = (is_int($tmpArgArr[2]) && $tmpArgArr[2] > 0) ? $tmpArgArr[2] : '';
	    //SGF::eventLog('quickQuery',3,'quickQuery has variants numProPage: %var%'.$numProPage.'%#var%.');
	  }
		else{
			$qqNumProPage = '';
		}
	  if(isset($tmpArgArr[3])){
	    settype($tmpArgArr[3], 'integer');
			$qqCurrentPage = (is_int($tmpArgArr[3]) && $tmpArgArr[3] > 0) ? $tmpArgArr[3] : '';
	    //SGF::eventLog('quickQuery',4,'quickQuery has variants currentPage: %var%'.$currentPage.'%#var%.');
	  }
		else{
			$qqCurrentPage = '';
		}
		if($qqNumProPage != '' || $qqCurrentPage != ''){
		  $array = self::morePages($array, $qqNumProPage, $qqCurrentPage);
		}
		$array['RECORD'] = microtime(true) - $qqRecord;
	  //SGF::eventLog('quickQuery',1,'quickQuery was %return%finished%#return%.');
	  return $array;
  }
	/*-->	
			  <li>
				  <h4>Methode: result2ArrayCR() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(resource) $result</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>get the results to array in "CR" axis, output Data format:<br/>
					      'CR' -> first Cols then Rows e.g. "['data']['column1']([0]=>'value1', [1]=>'value2' ...), ['data']['column2']([0]=>'value1', [1]=>'value2' ...)"<br/>
							  return data is a array as format: array(['AXIS']=>'CR', ['data']=>array())</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function result2ArrayCR((resource) $result)
  public static function result2ArrayCR(){
		$tmpArgArr = func_get_args();
	  if(!isset($tmpArgArr[0]) || !$tmpArgArr[0]){
	    //mysql_close();
			SGF::eventLog('result2ArrayCR', 0, 'result invalid', 'alert');
	    return false;
	  }
	  $data = mysqli_fetch_row($tmpArgArr[0]);
    if($data){
      $rowNum = 1;
    }
		$r2acrNumOfCol = mysqli_num_fields($tmpArgArr[0]);
    for($i = 0; $i < $r2acrNumOfCol; $i++){
      $tempFieldsInfo = mysqli_fetch_field_direct($tmpArgArr[0], $i);
	    $data[$tempFieldsInfo->name][0] = $data[$i];
	    unset($data[$i]);
    }
    while($row = mysqli_fetch_assoc($tmpArgArr[0])){
	    $data = array_merge_recursive($data, $row);
	    $rowNum++;
    }
	  //mysql_close();
    SGF::eventLog('result2ArrayCR', 0, 'num of value: %return%' . $rowNum . '%#return%.');
	  $array['AXIS'] = 'CR';
	  $array['data'] = $data;
    return $array;
  }
	/*-->	
			  <li>
				  <h4>Methode: result2ArrayRC() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(resource) $result</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>get the results to array in "RC" axis, output Data format:<br/>
					      'RC' -> first Rows then Cols e.g. "['data'][0](['column1']=>'value1', ['column2']=>'value2' ...), ['data'][1](['column1']=>'value1', ['column2']=>'value2' ...)"<br/>
							  return data is a array as format: array(['AXIS']=>'RC', ['data']=>array())</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function result2ArrayRC((resource) $result)
  public static function result2ArrayRC(){
		$tmpArgArr = func_get_args();
    if(!isset($tmpArgArr[0]) || !$tmpArgArr[0]){
	    //mysql_close();
	    SGF::eventLog('result2ArrayRC', 0, 'result none input', 'alert');
	    return false;
	  }
	  $data = array();
	  while($row = mysqli_fetch_assoc($tmpArgArr[0])){
	    $data[] = $row;
	  }
	  //mysql_close();
	  SGF::eventLog('result2ArrayRC', 0, 'num of value: %return%' . count($data) . '%#return%.');
    $array['AXIS'] = 'RC';
	  $array['data'] = $data;
    return $array;
  }
	/*-->	
			  <li>
				  <h4>Methode: hasData()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(array) $quickQueryResultArray</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>function to check whether has a array from quickQuery the results</li>
				  </ul>
				</li>
	<!--*/
	// boolean hasData((array) $quickQueryResultArray)
  public static function hasData(){
		$tmpArgArr = func_get_args();
	  if(isset($tmpArgArr[0]['data']) && is_array($tmpArgArr[0]['data']) && count($tmpArgArr[0]['data']) > 0){
			foreach($tmpArgArr[0]['data'] as $tempRow){
				foreach($tempRow as $tempColumn){
					if($tempColumn != NULL){
						return true;
					}
				}
			}
	  }
	  return false;
  }
	/*-->	
			  <li>
				  <h4>Methode: isExistedInDB() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $table</li>
                <li>[(string) $condition]</li>
                <li>[(string) $column]</li>
              </ul>
						</li>
					  <li>return: mixed</li>
					  <li>If $column is given, return a string with all value in  this column and with "," split;<br/>
						    (Warning! Because limit of valuebyte in MySQL, please use columnConcat(), if return mega values.)<br/>
								Default return num of result, return FALSE on no existed.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// mixed function isExistedInDB((string) $table[, (string) $condition[, (string) $column]])
	public static function isExistedInDB(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0])){
			SGF::eventLog('isExistedInDB', 0, 'no $table inputted!', 'error');
			return false;
		}
		$ieidSelect = isset($tmpArgArr[2]) ? "COUNT(*) AS countNum, GROUP_CONCAT(" . $tmpArgArr[2] . ") AS valueGroup" : "COUNT(*) AS countNum";
		$ieidCondition = isset($tmpArgArr[1]) ? $tmpArgArr[1] : "";
		$ieidQuery = new Query($ieidSelect, $tmpArgArr[0], "", $ieidCondition);
		if($ieidResult = SGF::getResult($ieidQuery->getString())){
		  $ieidRow = mysqli_fetch_assoc($ieidResult);
			//mysql_close();
		}
		else{
			return false;
		}
		
		if($ieidRow['countNum'] > 0){
			SGF::eventLog('isExistedInDB', 0, 'existed, ' . $ieidRow['countNum'] . ' results was found.');
			if(isset($tmpArgArr[2])){
				return $ieidRow['valueGroup'];
			}
			return $ieidRow['countNum'];
		}
		SGF::eventLog('isExistedInDB' , 0, 'not existed, return %return%false%#return%.');
		return false;
	}
	/*-->	
			  <li>
				  <h4>Methode: columnConcat() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $table</li>
                <li>(string) $column</li>
                <li>[(string) $condition]</li>
                <li>[(string) $separator]</li>
              </ul>
						</li>
					  <li>return: string</li>
					  <li>this Methode searched the values of the column and return all value in a string.<br/> 
						    Use $separator e.g. "'" to split the values (return 'value1','value2'...), if no $separator given, used default ','.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// string function columnConcat((string) $table, (string) $column[, (string) $condition[, (string) $separator]])
	public static function columnConcat(){
		$tmpArgArr = func_get_args();
		if(!isset($tmpArgArr[0]) || !isset($tmpArgArr[1])){
			SGF::eventLog('columnConcat', 0, 'no $table or $column inputted!', 'error');
			return false;
		}
		$mgcQuery = new Query($tmpArgArr[1], $tmpArgArr[0]);
		if(isset($tmpArgArr[2]) && $tmpArgArr[2] != ''){
			$mgcQuery->setWhere($tmpArgArr[2]);
		}
		if(!$mgcResult = SGF::getResult($mgcQuery->getString())){
		  //mysql_close();
			SGF::eventLog('columnConcat', 1, 'error by getResult', 'alert');
			return false;
		}
		$mgcRow = mysqli_fetch_row($mgcResult);
		$mgcseparator = isset($tmpArgArr[3]) ? $tmpArgArr[3] : ',';
		$mgcString = $mgcseparator != ',' ? $mgcseparator . $mgcRow[0] : $mgcRow[0];
		while($mgcRow = mysqli_fetch_row($mgcResult)){
			$mgcString .= $mgcseparator != ',' ? $mgcseparator . ',' . $mgcseparator . $mgcRow[0] : ',' . $mgcRow[0];
		}
		if($mgcseparator != ','){
			$mgcString .= $mgcseparator;
		}
		//mysql_close();
		SGF::eventLog('columnConcat', 2, 'columnConcat successed!');
		return $mgcString;
	}
	/*-->	
			  <li>
				  <h4>Methode: sliceCRArray() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(array) $array</li>
                <li>(int) $start</li>
                <li>[(int) $length]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>slice a "CR" Array form a specify position with a specify length;<br/>
						    $array is a DAS format data array with "CR" axis.<br/>
								If Array format is invalid or $start failed, return FALSE, else return a sliced "CR" array.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function sliceCRArray((array) $array, (int) $start[, (int) $length])
  public static function sliceCRArray(){
		$tmpArgArr = func_get_args();
	  if(!isset($tmpArgArr[0]) || !isset($tmpArgArr[0]['AXIS']) || $tmpArgArr[0]['AXIS'] != 'CR'){
	    SGF::eventLog('sliceCRArray', 0, 'Axis option invalid.', 'alert');
	    return false;
	  }
	  if(!isset($tmpArgArr[0]['data'])){
	    SGF::eventLog('sliceCRArray', 0, 'no data in array.', 'alert');
	    return false;
	  }
    if(!isset($tmpArgArr[1]) || !is_int($tmpArgArr[1])){
	    SGF::eventLog('sliceCRArray', 0, 'variant Start invalid.', 'alert');
	    return false;
	  }
    $tmpArgArr[2] = isset($tmpArgArr[2]) && is_int($tmpArgArr[2]) ? $tmpArgArr[2] : count(current($tmpArgArr[0]['data'])) - $tmpArgArr[1];
    //SGF::eventLog('sliceCRArray', '4', 'start position: %var%' . $tmpArgArr[1] . '%#var%; slice length: %var%' . $tmpArgArr[2] . '%#var%.');
    if(count(current($tmpArgArr[0]['data'])) < ($tmpArgArr[1] + $tmpArgArr[2])){
      SGF::eventLog('sliceCRArray',1,'oversize.','alert');
	    return false;
    }
    $keys = array_keys($tmpArgArr[0]['data']);
    //SGF::eventLog('sliceCRArray', '6', 'num of keys: %var%' . count($keys) . '%#var%.');
    for($i = 0; $i < count($keys); $i++){
	    $tmpArgArr[0]['data'][$keys[$i]] = array_slice($tmpArgArr[0]['data'][$keys[$i]], $tmpArgArr[1], $tmpArgArr[2]);
    }
    SGF::eventLog('sliceCRArray', 1, 'num of value: %return%' . count($tmpArgArr[0]['data'][$keys[0]]) . '%#return%.');
	  $tmpArgArr[0]['SLICE'] = $tmpArgArr[1] . '->' . ($tmpArgArr[1] + $tmpArgArr[2] - 1);
    return $tmpArgArr[0];
  }
	/*-->	
			  <li>
				  <h4>Methode: sliceRCArray() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(array) $array</li>
                <li>(int) $start</li>
                <li>[(int) $length]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>slice a "RC" Array form a specify position with a specify length.<br/>
						    $array is a DAS format data array with "RC" axis.<br/>
								If Array format is invalid or $start failed, return FALSE, else return a sliced "RC" array.</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function sliceRCArray((array) $array, (int) $start[, (int) $length])
  public static function sliceRCArray(){
		$tmpArgArr = func_get_args();
	  if(!isset($tmpArgArr[0]) || !isset($tmpArgArr[0]['AXIS']) || $tmpArgArr[0]['AXIS'] != 'RC'){
	    SGF::eventLog('sliceRCArray', 0, 'Axis option invalid.', 'alert');
	    return false;
	  }
	  if(!isset($tmpArgArr[0]['data'])){
	    SGF::eventLog('sliceRCArray', 0, 'no data in array.', 'alert');
	    return false;
	  }
    if(!isset($tmpArgArr[1]) || !is_int($tmpArgArr[1])){
	    SGF::eventLog('sliceRCArray', 0, 'variant Start invalid.', 'alert');
	    return false;
	  }
	  $tmpArgArr[2] = isset($tmpArgArr[2]) && is_int($tmpArgArr[2]) ? $tmpArgArr[2] : count($tmpArgArr[0]['data']) - $tmpArgArr[1];
    //SGF::eventLog('sliceRCArray', '4', 'start position: %var%' . $tmpArgArr[1] . '%#var%; slice length: %var%' . $tmpArgArr[2] . '%#var%.');
    if(count($tmpArgArr[0]['data']) < ($tmpArgArr[1] + $tmpArgArr[2])){
      SGF::eventLog('sliceRCArray', 1, 'oversize.', 'alert');
	    return false;
    }
	  $tmpArgArr[0]['data'] = array_slice($tmpArgArr[0]['data'], $tmpArgArr[1], $tmpArgArr[2]);
    SGF::eventLog('sliceRCArray', 1, 'num of value: %return%' . count($tmpArgArr[0]['data']) . '%#return%.');
	  $tmpArgArr[0]['SLICE'] = $tmpArgArr[1] . '->' . ($tmpArgArr[1] + $tmpArgArr[2] - 1);
    return $tmpArgArr[0];
  }
	/*-->	
			  <li>
				  <h4>Methode: morePages() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(array) $array</li>
                <li>[(int) $numPerPage]</li>
                <li>[(int) $currentPage]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>$array is is a DAS format data array, if $array is invalid, then return FALSE;<br/>
							$numPerPage is data number per a Page, $currentPage is the current Page index.<br/>
							return data is a array, e.g. array(['AXIS']=>'CR', ['data']=>array(....), ['SLICE']=>'5->9', ['DATA_START']=>6, ['DATA_END']=>10, ['NUM_PAGES']=>17, ['INDEX_PAGE']=>2, ['NUM_DATA']=>84, ['NUM_PER_PAGE']=>52)</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function morePages((array) $array[, (int) $numPerPage[, (int) $currentPage]])
  public static function morePages(){
		$tmpArgArr = func_get_args();
	  if(!isset($tmpArgArr[0]) || !is_array($tmpArgArr[0]) || !isset($tmpArgArr[0]['AXIS']) || !$tmpArgArr[0]['AXIS'] || !isset($tmpArgArr[0]['data'])){
	    SGF::eventLog('morePages',0,'Array is invalid.','alert');
	    return false;
	  }
	  $data = $tmpArgArr[0]['data'];
	  $axis = $tmpArgArr[0]['AXIS'];
    $num = isset($tmpArgArr[1]) && is_int($tmpArgArr[1]) && $tmpArgArr[1] > 0 ? $tmpArgArr[1] : 10;
    $page = isset($tmpArgArr[2]) && is_int($tmpArgArr[2]) && $tmpArgArr[2] > 0 ? $tmpArgArr[2] : 1;
    SGF::eventLog('morePages','2','axis of array: %var%'.$tmpArgArr[0]['AXIS'].'%#var%; num pro page: %var%'.$num.'%#var%; current page: %var%'.$page.'%#var%.');
    if($tmpArgArr[0]['AXIS'] == 'CR'){
	    $num_data = count(current($data));
	  }
	  else{
	    $num_data = count($data);
	  }
    if($num_data <= $num){
      $tmpArgArr[0]['NUM_PAGES'] = 1;
	    $tmpArgArr[0]['INDEX_PAGE'] = $page;
	    $tmpArgArr[0]['NUM_DATA'] = $num_data;
	    $tmpArgArr[0]['NUM_PER_PAGE'] = $num;
	    $tmpArgArr[0]['DATA_START'] = 1;
	    $tmpArgArr[0]['DATA_END'] = $num_data;
      SGF::eventLog('morePages',1,'num of value: %return%'.$num_data.'%#return%; num of pages: %return%'.$tmpArgArr[0]['NUM_PAGES'].'%#return%.');
      return $tmpArgArr[0];
    }
	  $num_pages = ceil($num_data/$num);
	  if($page == $num_pages){
	    if($axis == 'CR'){
	      $tmpArgArr[0] = self::sliceCRArray($tmpArgArr[0], (($page-1) * $num));
	    }
	    else{
	      $tmpArgArr[0] = self::sliceRCArray($tmpArgArr[0], (($page-1) * $num));
	    }
	    $tmpArgArr[0]['DATA_START'] = (($page-1) * $num) + 1;
	    $tmpArgArr[0]['DATA_END'] = $num_data;
	  }
	  else{
	    if($axis == 'CR'){
		    $tmpArgArr[0] = self::sliceCRArray($tmpArgArr[0], (($page-1) * $num), $num);
      }
	    else{
		    $tmpArgArr[0] = self::sliceRCArray($tmpArgArr[0], (($page-1) * $num), $num);
	    }
	    $tmpArgArr[0]['DATA_START'] = (($page-1) * $num) + 1;
	    $tmpArgArr[0]['DATA_END'] = (($page-1) * $num) + $num;
	  }
	  $tmpArgArr[0]['NUM_PAGES'] = $num_pages;
	  $tmpArgArr[0]['INDEX_PAGE'] = $page;
	  $tmpArgArr[0]['NUM_DATA'] = $num_data;
	  $tmpArgArr[0]['NUM_PER_PAGE'] = $num;
	  SGF::eventLog('morePages',1,'num of value: %return%'.$num_data.'%#return%; num of pages: %return%'.$tmpArgArr[0]['NUM_PAGES'].'%#return%.');
    return $tmpArgArr[0];
  }
  /*-->	
			  <li>
				  <h4>Methode: divisionPages() [EML]</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(Query) $queryObj</li>
                <li>[(string) $axis]</li>
                <li>[(int) $numPerPage]</li>
                <li>[(int) $currentPage]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>$queryObj is a Query object, if $queryObj is invalid, then return FALSE;<br/>
					    $axis is a valiable to config output Data format: default is 'RC',<br/>
							'RC' -> first Rows then Cols "e.g. ['data'][0](['column1']=>'value1', ['column2']=>'value2' ...), ['data'][1](['column1']=>'value1', ['column2']=>'value2' ...)"<br/>
							'CR' -> first Cols then Rows "e.g. ['data']['column1']([0]=>'value1', [1]=>'value2' ...), ['data']['column2']([0]=>'value1', [1]=>'value2' ...)"<br/>
							$numPerPage is data number per a Page, $currentPage is the current Page index.<br/>
							return data is a array, e.g. array(['AXIS']=>'CR', ['data']=>array(....), ['SLICE']=>'5->9', ['DATA_START']=>6, ['DATA_END']=>10, ['NUM_PAGES']=>17, ['INDEX_PAGE']=>2, ['NUM_DATA']=>84, ['NUM_PER_PAGE']=>5, ['RECORD']=>0.015550136566162)</li>
					  <li>[EML] This methode is monitored by eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function divisionPages(Query $queryObj[, (string) $axis[, (int) $numPerPage[, (int) $currentPage]]])
  public static function divisionPages(){
      $tmpArgArr = func_get_args();
	  if (!isset($tmpArgArr[0]) || !isset($tmpArgArr[0]->OBJECTNAME) || $tmpArgArr[0]->OBJECTNAME != 'Query') {
	      SGF::eventLog('quickQuery', 0, 'queryObj invalid.', 'error');
	      return false;
	  }
	  $dpRecord = microtime(true);
      $dpDataCount = SGF::getResult("SELECT COUNT(*) AS NUM_DATA FROM (" . $tmpArgArr[0]->getString() . ") AS temp");
      if ($dpDataCount === false) {
          SGF::eventLog('divisionPages', 1, 'error by getResult.', 'error');
	      return false;
      }
      $dpDataCount = mysqli_fetch_assoc($dpDataCount);
      $dpDataCount = $dpDataCount['NUM_DATA'];
      $dpAxis = trim($tmpArgArr[1]) == 'CR' ? 'CR' : 'RC';
      
      $num = isset($tmpArgArr[2]) && is_int(intval($tmpArgArr[2])) && intval($tmpArgArr[2]) > 0 ? intval($tmpArgArr[2]) : 20;
      $page = isset($tmpArgArr[3]) && is_int(intval($tmpArgArr[3])) && intval($tmpArgArr[3]) > 0 ? intval($tmpArgArr[3]) : 1;
      SGF::eventLog('divisionPages','2','axis of array: %var%'.$tmpArgArr[1].'%#var%; num pro page: %var%'.$num.'%#var%; current page: %var%'.$page.'%#var%.');
      
      $dpResultArray = array();
      
      if ($dpDataCount <= $num) {
          $dpResultArray['NUM_PAGES'] = 1;
	      $dpResultArray['DATA_START'] = 1;
	      $dpResultArray['DATA_END'] = $dpDataCount;
      }
      else {
          $num_pages = ceil($dpDataCount/$num);
          $dpResultArray['NUM_PAGES'] = $num_pages;
          if ($page == $num_pages) {
              $dpResultArray['DATA_START'] = (($page-1) * $num) + 1;
	          $dpResultArray['DATA_END'] = $dpDataCount;
          }
          else {
              $dpResultArray['DATA_START'] = (($page-1) * $num) + 1;
	          $dpResultArray['DATA_END'] = (($page-1) * $num) + $num;
          }
      }
	  $dpResultArray['INDEX_PAGE'] = $page;
	  $dpResultArray['NUM_DATA'] = $dpDataCount;
	  $dpResultArray['NUM_PER_PAGE'] = $num;
      $dpResultArray['SLICE'] = ($dpResultArray['DATA_START'] - 1) . '->' . ($dpResultArray['DATA_END'] - 1);
      
      $tmpArgArr[0]->setLimit(($dpResultArray['DATA_START'] - 1) . "," . $num);
      $dpData = SGF::getResult($tmpArgArr[0]->getString());
	  if ($dpData === false) {
		  SGF::eventLog('divisionPages', 3, 'error by getResult.', 'error');
	      return false;
	  }
      
	  if($dpAxis == 'CR'){
	    $dpData = self::result2ArrayCR($dpData);
	  }
	  else{
	    $dpData = self::result2ArrayRC($dpData);
	  }
      $dpResultArray['AXIS'] = $dpData['AXIS'];
      $dpResultArray['data'] = $dpData['data'];
      $dpResultArray['RECORD'] = microtime(true) - $dpRecord;
	  return $dpResultArray;
  }
}
/*-->
      </ul>
    </li>  
	  <li>
		  <h2>Query</h2>
			<p>Query Object, flexible and quick to generate a MySQL-SELECT-Syntax</p>
<!--*/
class Query{
	/*-->	
			<ul class="methode">
	<!--*/
  private $select;
  private $from;
  private $joinFunc;
  private $where;
  private $order;
  private $group;
  private $limit;
  private $union = array();
  private $globalOrder;
  private $globalLimit;
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'Query'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'Query';
	/*-->	
			  <li>
				  <h4>Methode: __construct()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $select]</li>
                <li>[(string) $from]</li>
                <li>[(string) $join]</li>
                <li>[(string) $where]</li>
                <li>[(string) $order]</li>
                <li>[(string) $group]</li>
                <li>[(string) $limit]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>create a Query object with elements in MySQL-SELECT-Syntax<br/>
						    e.g.(SELECT [$select] FROM [$from] [$join] WHERE [$where] ORDER BY [$order] GROUP BY [$group] LIMIT [$limit])</li>
				  </ul>
				</li>
	<!--*/
	// void function __construct([(string) $select[, (string) $from[, (string) $join[, (string) $where[, (string) $order[, (string) $group[, (string) $limit]]]]]]])
  public function __construct(){
		$tmpArgArr = func_get_args(); 
	  $this->select = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
	  $this->from = isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) ? $tmpArgArr[1] : '';
	  $this->joinFunc = isset($tmpArgArr[2]) && is_string($tmpArgArr[2]) && stripos($tmpArgArr[2], 'JOIN') !== false ? $tmpArgArr[2] : '';
	  $this->where = isset($tmpArgArr[3]) && is_string($tmpArgArr[3]) ? $tmpArgArr[3] : '';
	  $this->order = isset($tmpArgArr[4]) && is_string($tmpArgArr[4]) ? $tmpArgArr[4] : '';
	  $this->group = isset($tmpArgArr[5]) && is_string($tmpArgArr[5]) ? $tmpArgArr[5] : '';
	  $this->limit = isset($tmpArgArr[6]) && $tmpArgArr[6] !== '' ? $tmpArgArr[6] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: setSelect()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $select]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "SELECT" element in self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// void function setSelect([(string) $select])
  public function setSelect(){
		$tmpArgArr = func_get_args();
    $this->select = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: getSelect()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "SELECT" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getSelect(void)
  public function getSelect(){
    return $this->select;
  }
	/*-->	
			  <li>
				  <h4>Methode: setFrom()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $from]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "FROM" element in self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// void function setFrom([(string) $from])
  public function setFrom(){
		$tmpArgArr = func_get_args();
    $this->from = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: getFrom()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "FROM" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getFrom(void)
  public function getFrom(){
    return $this->from;
  }
	/*-->	
			  <li>
				  <h4>Methode: setJoin()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $join]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "JOIN" element in self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// void function setJoin([(string) $join])
  public function setJoin(){
		$tmpArgArr = func_get_args();
    $this->joinFunc = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && stripos($tmpArgArr[0], 'JOIN') !== false ? $tmpArgArr[0] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: getJoin()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "JOIN" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getJoin(void)
  public function getJoin(){
    return $this->joinFunc;
  }
	/*-->	
			  <li>
				  <h4>Methode: setWhere()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $where]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "WHERE" element in self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// void function setWhere([(string) $where])
  public function setWhere(){
		$tmpArgArr = func_get_args();
    $this->where = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: getWhere()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "WHERE" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getWhere(void)
  public function getWhere(){
    return $this->where;
  }
	/*-->	
			  <li>
				  <h4>Methode: setOrder()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $order]</li>
                <li>[(boolean) $isGlobal]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "ORDER BY" element in self Query object.<br/>
						    Use the valiable $isGlobal to decide whether "ORDER BY" element affects global or partial.</li>
				  </ul>
				</li>
	<!--*/
	// void function setOrder([(string) $order[, (boolean) $isGlobal]])
  public function setOrder(){
		$tmpArgArr = func_get_args();
    $this->order = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
		$this->globalOrder = isset($tmpArgArr[1]) && ($tmpArgArr[1] === true || $tmpArgArr[1] === false) ? $tmpArgArr[1] : $this->globalOrder;
  }
	/*-->	
			  <li>
				  <h4>Methode: getOrder()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "ORDER BY" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function setGroup(void)
  public function getOrder(){
    return $this->order;
  }
	/*-->	
			  <li>
				  <h4>Methode: setGroup()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $group]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "GROUP BY" element in self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// void function setGroup([(string) $group])
  public function setGroup(){
		$tmpArgArr = func_get_args();
    $this->group = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) ? $tmpArgArr[0] : '';
  }
	/*-->	
			  <li>
				  <h4>Methode: getGroup()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "GROUP BY" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getGroup(void)
  public function getGroup(){
    return $this->group;
  }
	/*-->	
			  <li>
				  <h4>Methode: setLimit()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $limit]</li>
                <li>[(boolean) $isGlobal]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Fill the contents of the "LIMIT" element in self Query object.<br/>
						    Use the valiable $isGlobal to decide whether "LIMIT" element affects global or partial.</li>
				  </ul>
				</li>
	<!--*/
	// void function setLimit([(string) $limit[, (boolean) $isGlobal]])
  public function setLimit(){
		$tmpArgArr = func_get_args();
    $this->limit = isset($tmpArgArr[0]) && $tmpArgArr[0] !== '' ? $tmpArgArr[0] : '';
		$this->globalLimit = isset($tmpArgArr[1]) && ($tmpArgArr[1] === true || $tmpArgArr[1] === false) ? $tmpArgArr[1] : $this->globalLimit;
  }
	/*-->	
			  <li>
				  <h4>Methode: getLimit()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the contents of the "LIMIT" element from self Query object.</li>
				  </ul>
				</li>
	<!--*/
	// string function getLimit(void)
  public function getLimit(){
    return $this->limit;
  }
	/*-->	
			  <li>
				  <h4>Methode: union()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[Query $queryObj]</li>
                <li>[(string) $property]</li>
                <li>[(boolean) $globalOrder]</li>
                <li>[(boolean) $globalLimit]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>Use this methode to unite two or more Query object;<br/>
						    (Warning! Before use this methode, please sure, all Query objects were complete defined.)<br/>
					      $property is the keyword for "UNION" syntax, e.g. "ALL" or "DISTINCT";<br/>
							  If $globalOrder is true, host Query object's "ORDER BY" expr. will be defined as global "ORDER BY" expr.;<br/>
							  If $globalLimit is true, host Query object's "LIMIT" expr. will be defined as global "LIMIT" expr.;<br/>
							  Return FALSE, if $query invalid or $query already has one or more united childnode; Return TRUE if Query objectsare successfully united.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function union(Query $queryObj[, $property[, $globalOrder[, $globalLimit]]])
  public function union(){
		$tmpArgArr = func_get_args();
    if(!isset($tmpArgArr[0]) || !isset($tmpArgArr[0]->OBJECTNAME) || $tmpArgArr[0]->OBJECTNAME != 'Query' || $tmpArgArr[0]->getNumOfUnion() > 0){
	    return false;
	  }
	  $this->globalOrder = isset($tmpArgArr[2]) ? $tmpArgArr[2] : false;	
	  $this->globalLimit = isset($tmpArgArr[3]) ? $tmpArgArr[3] : false;
		$unionKeyWord = '';
		if(isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && (stripos($tmpArgArr[1], 'ALL') !== false || stripos($tmpArgArr[1], 'DISTINCT') !== false)){
		  $unionKeyWord = stripos($tmpArgArr[1], 'ALL') !== false ? 'ALL' : 'DISTINCT';
		}
    $this->union[] = array('property'=>$unionKeyWord, 'queryObj'=>$tmpArgArr[0]);
	  return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: getNumOfUnion()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: integer</li>
					  <li>Use this methode to get, how many unions are in this Query Object.</li>
				  </ul>
				</li>
	<!--*/
	// integer function getNumOfUnion(void)
  public function getNumOfUnion(){
    return count($this->union);
  }
	/*-->	
			  <li>
				  <h4>Methode: getString()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Return a generated string (MySQL-SELECT-Syntax) from this Query object.</li>
				  </ul>
				</li>
	<!--*/	
	// string function getString(void)
  public function getString(){
    $str = 'SELECT '.(($this->select!=='') ? $this->select : '*');
	  if($this->from){
	    $str .= ' FROM '.$this->from;
	  }
	  if($this->joinFunc){
	    $str .= ' '.$this->joinFunc;
	  }
	  if($this->where){
	    $str .= ' WHERE '.$this->where;
	  }
	  if($this->group){
	    $str .= ' GROUP BY '.$this->group;
	  }
	  if(count($this->union) > 0){
			if(!$this->globalOrder && $this->order){
	      $str .= ' ORDER BY '.$this->order;		
	    }
			if(!$this->globalLimit && $this->limit){
	      $str .= ' LIMIT '.$this->limit;		
	    }
	    $str = '(' . $str . ')';
	    for($i = 0; $i < count($this->union); $i++){
		    $str .= ' UNION '.$this->union[$i]['property'].' ('.$this->union[$i]['queryObj']->getString().')';
		  }
	  }
	  if($this->order && (count($this->union) == 0 || $this->globalOrder)){
	    $str .= ' ORDER BY '.$this->order;
	  }
	  if($this->limit && (count($this->union) == 0 || $this->globalLimit)){
	    $str .= ' LIMIT '.$this->limit;
	  }
    return $str;
  }
}
/*-->
      </ul>
    </li>  
	  <li>
		  <h2>Eventlog</h2>
			<p>A independent Eventlog Object</p>
<!--*/
class Eventlog{
	/*-->	
			<ul class="methode">
	<!--*/
  private $logName;
  private $logArrayKeys;
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'Eventlog'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'Eventlog';
	/*-->	
			  <li>
				  <h4>Methode: __construct()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $logName]</li>
                <li>[(array) $namesOfColumns]</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>If no $logName was given or $logName not a string, set 'eventlog' as default log name;<br/>
					      If no $namesOfColumns was given or $namesOfColumns not a array, set array('name', 'step', 'type', 'descript') as default names of columns;<br/>
							  Return false if Session can not start, return true if Session started.</li>
				  </ul>
				</li>
	<!--*/
	// boolean function __construct([(string) $logName[, (array) $namesOfColumns]])
  public function __construct(){
		$tmpArgArr = func_get_args();
    if(!$this->checkSessionStatus()){
      return false;
    }
    $this->logName = isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != '' ? $tmpArgArr[0] : 'Eventlog';
    $this->logArrayKeys = isset($tmpArgArr[1]) && is_array($tmpArgArr[1]) && count($tmpArgArr[1]) > 0 ? $tmpArgArr[1] : array('name', 'step', 'type', 'descript');
		if(isset($_SESSION[$this->logName])){
      unset($_SESSION[$this->logName]);
    }
		return true;
  }
	/*-->	
			  <li>
				  <h4>Methode: setEventLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $logName]</li>
                <li>[(array) $namesOfColumns]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Use this methode to rename the Eventlog or set new columns in the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function setEventLog([(string) $logName[, (array) $namesOfColumns]])
  public function setEventLog(){
		$tmpArgArr = func_get_args();
    if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
      if($this->logName != $tmpArgArr[0] && isset($_SESSION[$this->logName])){
        $_SESSION[$tmpArgArr[0]] = $_SESSION[$this->logName];
        unset($_SESSION[$this->logName]);
      }
      $this->logName = $tmpArgArr[0];
    }
    if(isset($tmpArgArr[1]) && is_array($tmpArgArr[1]) && count($tmpArgArr[1]) > 0){
      $diffKeys = array_diff($this->logArrayKeys, $tmpArgArr[1]);
      for($i = 0; $i < count($diffkeys); $i++){
        for($j = 0; $j < count($_SESSION[$this->logName]); $j++){
          unset($_SESSION[$this->logName][$j][$diffKeys[$i]]);
        }
      }
      $this->logArrayKeys = $tmpArgArr[1];
    }
  }
	/*-->	
			  <li>
				  <h4>Methode: renameEventLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $logName]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Use this methode to rename the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function renameEventLog([(string) $logName])
  public function renameEventLog(){
		$tmpArgArr = func_get_args();
    if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0])){
      if($this->logName != $tmpArgArr[0] && isset($_SESSION[$this->logName])){
        $_SESSION[$tmpArgArr[0]] = $_SESSION[$this->logName];
        unset($_SESSION[$this->logName]);
      }
      $this->logName = $tmpArgArr[0];
    }
  }
	/*-->	
			  <li>
				  <h4>Methode: addColumns()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(array) $namesOfColumns]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Use this methode to insert new columns in the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function addColumns([(array) $namesOfColumns])
  public function addColumns(){
		$tmpArgArr = func_get_args();
    if(isset($tmpArgArr[0]) && is_array($tmpArgArr[0]) && count($tmpArgArr[0]) > 0){
      foreach($tmpArgArr[0] as $columnName){
        if(!in_array($columnName, $this->logArrayKeys)){
          array_push($this->logArrayKeys, $columnName);
        }
      }
    }
  }
	/*-->	
			  <li>
				  <h4>Methode: deleteColumns()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(array) $namesOfColumns]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Use this methode to delete specific columns in the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function deleteColumns([(array) $namesOfColumns])
  public function deleteColumns(){
		$tmpArgArr = func_get_args();
    if(isset($tmpArgArr[0]) && is_array($tmpArgArr[0]) && count($tmpArgArr[0]) > 0){
      $intersectKeys = array_intersect($this->logArrayKeys, $tmpArgArr[0]);
      for($i = 0; $i < count($intersectKeys); $i++){
        for($j = 0; $j < count($_SESSION[$this->logName]); $j++){
          unset($_SESSION[$this->logName][$j][$intersectKeys[$i]]);          
        }
      }
    }
  }
	/*-->	
			  <li>
				  <h4>Methode: clearEventLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: void</li>
					  <li>Clean all contents of the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// void function clearEventLog(void)
  public function clearEventLog(){
    if(isset($_SESSION[$this->logName])){
      unset($_SESSION[$this->logName]);
    }
  }
	/*-->	
			  <li>
				  <h4>Methode: getNameOfEventLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the name of this Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// string function getNameOfEventLog(void)
  public function getNameOfEventLog(){
    return $this->logName;
  }
	/*-->	
			  <li>
				  <h4>Methode: getNamesOfColumns()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: array</li>
					  <li>Get the names of all columns in the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function getNamesOfColumns(void)
  public function getNamesOfColumns(){
    return $this->logArrayKeys;
  }
	/*-->	
			  <li>
				  <h4>Methode: getEventLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: void</li>
					  <li>return: array</li>
					  <li>Get all contents of the Eventlog.</li>
				  </ul>
				</li>
	<!--*/
	// array function getEventLog(void)
  public function getEventLog(){
    if(isset($_SESSION[$this->logName])){
      return $_SESSION[$this->logName];
    } 
  }
	/*-->	
			  <li>
				  <h4>Methode: wLog()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
					  <li>Arguments: 
              <ul class="arguments">
                <li>(mixed) $col0</li>
                <li>(mixed) $col1</li>
                <li>(mixed) $col2</li>
                <li>(mixed) $col3</li>								
                <li>... ...</li>
              </ul>
						</li>
					  <li>return: boolean</li>
					  <li>Insert a row into the Eventlog;<br/>
						    With values((mixed) $col0, (mixed) $col1, (mixed) $col2, (mixed) $col3, ... ...)</li>
				  </ul>
				</li>
	<!--*/
	// boolean function wLog((mixed) $col0, (mixed) $col1, (mixed) $col2, (mixed) $col3, ... ...)
  public function wLog(){
    $arg_list = func_get_args();
		if(!isset($_SESSION[$this->logName])){
		  $_SESSION[$this->logName] = array();
		}
    $j = count($_SESSION[$this->logName]);
    for($i = 0; $i < count($this->logArrayKeys); $i++){
      $_SESSION[$this->logName][$j][$this->logArrayKeys[$i]] = $arg_list[$i];
    }
  }
	// function checkSessionStatus()
  private function checkSessionStatus(){
    if(session_id() == ''){
      if(!session_start()){
        return false;
      }	
    }
    return true;
  }
}
/*-->
      </ul>
    </li>  
	  <li>
		  <h2>MSG</h2>
			<p>Message Feedback Element</p>
<!--*/
class MSG{
	/*-->	
			<ul class="methode">
			  <li>
				  <h4>Valiable: $functionName</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>The name of the function where message is embedded.</li>
				  </ul>
				</li>
	<!--*/
	public static $functionName;/*-->	
			<ul class="methode">
			  <li>
				  <h4>Valiable: $msgArray</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>
                        The last msg, output as array. Array Structur: array("FUNC"=>..., "TYPE"=>..., "STATUS"=>..., "TEXT"=>..., "DATA"=>...)<br/>
						$type is an integer: (0->MALFUNCTION, 1->OK, 2->WARNING, 3->ERROR)<br/>
						["STATUS"] is a string of the corresponding $type;<br/>
						Use $data valiable to return the message together with data under MSG['DATA'].
                      </li>
				  </ul>
				</li>
	<!--*/
	public static $msgArray;
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'MSG'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'MSG';
	/*-->	
			  <li>
				  <h4>Methode: __construct()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $functionName]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Create a MSG object, $functionName is the name of the function where message is embedded.</li>
				  </ul>
				</li>
	<!--*/
	// void function __construct([(string) $functionName])
	public function __construct(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && function_exists($tmpArgArr[0])){
			self::$functionName = $tmpArgArr[0];
		}
	}
	/*-->	
			  <li>
				  <h4>Methode: init()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $functionName]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Initialize a MSG object, $functionName is the name of the function where message is embedded.<br/>
						    Can use constant "__FUNCTION__" to get the function name, e.g. write "MSG::init(__FUNCTION__)" at first line in function.</li>
				  </ul>
				</li>
	<!--*/
	// void function init([(string) $functionName])
	public static function init(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0])){
			self::$functionName = $tmpArgArr[0];
		}
	}
	/*-->	
			  <li>
				  <h4>Methode: msg()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(int) $type</li>
                <li>(string) $text</li>
                <li>[(mixed) $dataArray]</li>
              </ul>
						</li>
					  <li>return: array</li>
					  <li>Return a message as format: array("FUNC"=>..., "TYPE"=>..., "STATUS"=>..., "TEXT"=>..., "DATA"=>...)<br/>
						    $type is an integer: (0->MALFUNCTION, 1->OK, 2->WARNING, 3->ERROR)<br/>
								["STATUS"] is a string of the corresponding $type;<br/>
								Use $data valiable to return the message together with data under MSG['DATA'].</li>
				  </ul>
				</li>
	<!--*/
	// array function msg((int) $type, (string) $text[, (mixed) $data])
	public static function msg(){
		$tmpArgArr = func_get_args();
		$msgType = (isset($tmpArgArr[0]) && is_int($tmpArgArr[0]) && ($tmpArgArr[0] === 1 || $tmpArgArr[0] === 2 || $tmpArgArr[0] === 3)) ? $tmpArgArr[0] : false;
		$msgText = (isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && $tmpArgArr[1] != '') ? $tmpArgArr[1] : false;
		$msgArray = array();
		$msgStatusArray = array('MALFUNCTION', 'OK', 'WARNING', 'ERROR');
		if($msgType === false || $msgText === false){			
		  $msgArray['FUNC'] = self::$functionName;
		  $msgArray['TYPE'] = 0;
			$msgArray['STATUS']= $msgStatusArray[0];
		  $msgArray['TEXT'] = 'Function ' . self::$functionName . ' (on server): An error occurred by MSG.';
			$msgArray['DATA'] = false;
			return $msgArray;
		}
		$msgArray['FUNC'] = self::$functionName;
		$msgArray['TYPE'] = $msgType;
		$msgArray['STATUS']= $msgStatusArray[$msgType];
		$msgArray['TEXT'] = 'Function ' . self::$functionName . ' (on server): ' . $msgText;
		$msgArray['DATA'] = isset($tmpArgArr[2]) ? $tmpArgArr[2] : false; 
		self::$msgArray = $msgArray;
        return $msgArray;
	}
}
/*-->
      </ul>
    </li>
	  <li>
		  <h2>CML</h2>
			<p>Crypt Machine - Lite</p>
<!--*/
class CML{
	/*-->	
			<ul class="methode">
	<!--*/
  private static $securekey;
	private static $iv;
	/*-->	
			  <li>
				  <h4>Valiable: $OBJECTNAME</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Value: 'CML'</li>
					  <li>This Valiable is a identifition of the class.</li>
				  </ul>
				</li>
	<!--*/
	public $OBJECTNAME = 'CML';
	/*-->	
			  <li>
				  <h4>Methode: __construct()</h4>
					<ul class="parameter">
				    <li>public;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $key]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Create a CML object, $key is a string for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// void function __construct([(string) $key])
  public function __construct(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			self::$securekey = hash('sha256', $tmpArgArr[0], TRUE);
			self::$iv = openssl_random_pseudo_bytes(8);
		}   
  }
	/*-->	
			  <li>
				  <h4>Methode: init()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $key]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Initialize the CML object, $key is a string for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// void function init([(string) $key])
  public static function init(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			self::$securekey = hash('sha256', $tmpArgArr[0], TRUE);
			self::$iv = openssl_random_pseudo_bytes(8);
		}   
  }
	/*-->	
			  <li>
				  <h4>Methode: setKey()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $key]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Set the Key for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// void function setKey([(string) $key])
  public static function setKey(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			self::$securekey = hash('sha256', $tmpArgArr[0], TRUE);
		}   
  }
	/*-->	
			  <li>
				  <h4>Methode: setIV()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>[(string) $iv]</li>
              </ul>
						</li>
					  <li>return: void</li>
					  <li>Set the IV for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// void function setIV([(string) $key])
  public static function setIV(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			self::$iv = $tmpArgArr[0];
		}   
  }
	/*-->	
			  <li>
				  <h4>Methode: getKey()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the Key for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// sting function getKey(void)
  public static function getKey(){
		return self::$securekey;
  }
	/*-->	
			  <li>
				  <h4>Methode: getIV()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: void</li>
					  <li>return: string</li>
					  <li>Get the IV for Crypt.</li>
				  </ul>
				</li>
	<!--*/
	// sting function getIV(void)
  public static function getIV(){
		return self::$iv;
  }	
	/*-->	
			  <li>
				  <h4>Methode: encrypt()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $strToEncrypt</li>
              </ul>
						</li>
					  <li>return: string</li>
					  <li>Encrypt a string.</li>
				  </ul>
				</li>
	<!--*/
	// sting function encrypt((string) $strToEncrypt)
  public static function encrypt(){
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			return openssl_encrypt($tmpArgArr[0], "BF-CBC", self::$securekey, null, self::$iv);
		}
    return false;
  }
	/*-->	
			  <li>
				  <h4>Methode: decrypt()</h4>
					<ul class="parameter">
				    <li>public static;</li>
					  <li>Arguments: 
              <ul class="arguments">
                <li>(string) $strToDecrypt</li>
              </ul>
						</li>
					  <li>return: string</li>
					  <li>Decrypt a string.</li>
				  </ul>
				</li>
	<!--*/
	// sting function encrypt((string) $strToDecrypt)
  public static function decrypt() {
		$tmpArgArr = func_get_args();
		if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0] != ''){
			return trim(openssl_decrypt($tmpArgArr[0], "BF-CBC", self::$securekey, 0, self::$iv));
		}
    return false;
  }
}
/*-->
      </ul>
    </li>
	  <li>
		  <h2>Other Tools</h2>
			<ul class="methode">
		  <li><h4>Methode: urlModify()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>[(array) $getArray]</li>
              <li>[(string) $url]</li>
              <li>[(boolean) $isDelete]</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>Edit a request url.<br/>
					    $getArray is all elements which will be edited in url add/edit/delete, as a array: array(getVarName0=>value0, getVarName1=>value1, ...);<br/>
							$url is the complete request url.
							If $isDelete is true, all elements in $getArray will be deleted in request url.</li>
				</ul>
		  </li>
<!--*/
// string function urlModify([(array) $getArray[, (string) $url[, (boolean) $isDelete]]])
function urlModify(){	
  $tmpArgArr = func_get_args();
	$umUrl = isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && strlen($tmpArgArr[1]) > 0 ? $tmpArgArr[1] : $_SERVER['REQUEST_URI'];
	$umUrl = explode('?', $umUrl, 2);
	$umAddress = $umUrl[0];
	$requestUri = isset($umUrl[1]) && $umUrl[1] != '' ? $umUrl[1] : '';
	$requestUri = $requestUri != '' ? str_replace('&amp;', '&', $requestUri) : '';
	$requestGetArr = $requestUri != '' ? explode('&', $requestUri) : array();
	$requestKeySet = array();
	foreach($requestGetArr as $requestGetItem){
		if(strpos($requestGetItem, '=') !== false){
			$tempArr = explode('=', $requestGetItem);
			$requestKeySet[$tempArr[0]] = $tempArr[1];
		}
	}
	$umIsDelete = isset($tmpArgArr[2]) && $tmpArgArr[2] === true ? true : false;
	$umGetArray = isset($tmpArgArr[0]) && is_array($tmpArgArr[0]) && count($tmpArgArr[0]) > 0 ? $tmpArgArr[0] : array();
	if($umIsDelete === false){
		$requestKeySet = count($umGetArray) == 0 ? array() : array_merge($requestKeySet, $umGetArray);
	}
	else{
		$requestKeySet = array_diff_key($requestKeySet, $umGetArray);
	}
	$requestUri = '';
	while(current($requestKeySet) !== false){
		$requestUri .= strlen($requestUri) > 0 ? '&' . key($requestKeySet) . '=' . current($requestKeySet) : '?' . key($requestKeySet) . '=' . current($requestKeySet);
		next($requestKeySet);
	}
	return $umAddress . $requestUri;
}
/*-->
		  <li><h4>Methode: arrayToXml()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(array) $array</li>
              <li>[(string) $mainKey]</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>Convert a array to a XML Document, return a string as XML format, return FALSE, if $array is invalid.<br/>
					    If $mainKey is assigned, XML by output will be appended a main element <ITEMS_$name></ITEMS_$name>.</li>
				</ul>
		  </li>
<!--*/
// string function arrayToXml((array) $array[, (string) $mainKey])
function arrayToXml(){
	$tmpArgArr = func_get_args();
  if(isset($tmpArgArr[0]) && is_array($tmpArgArr[0]) && count($tmpArgArr[0]) > 0){
		$atxMainKey = isset($tmpArgArr[1]) && $tmpArgArr[1] !== '' ? 'ITEMS_' . $tmpArgArr[1] : 'ITEMS';	  
		$atxXMLStr = '<' . $atxMainKey . '>';
	  $atxKeys = array_keys($tmpArgArr[0]);		
	  foreach($atxKeys as $atxKey){
			$atxIsEmpty = true;
			$atxChildKey = isset($tmpArgArr[1]) && $tmpArgArr[1] !== '' ? 'ITEM_' . $tmpArgArr[1] : 'ITEM';
	    //SGF::eventLog('array2Xml','1','converting key: %var%'.$atxKey.'%#var%...','',false);
			if(is_int($tmpArgArr[0][$atxKey])){
				$atxType = 'integer';
			}
			if(is_float($tmpArgArr[0][$atxKey])){
				$atxType = 'float';
			}
			if(is_string($tmpArgArr[0][$atxKey])){
				$atxType = 'string';
			}
			if(is_array($tmpArgArr[0][$atxKey])){
				$atxType = 'array';
			}
			if(is_bool($tmpArgArr[0][$atxKey])){
				$atxType = 'boolean';
			}
			if(is_object($tmpArgArr[0][$atxKey])){
				$atxType = 'object';
			}
			if(is_null($tmpArgArr[0][$atxKey])){
				$atxType = 'null';
			}
			if(!isset($atxType)){
				$atxType = 'string';
			}
	    $atxXMLStr .= '<' . $atxChildKey . '><KEY>' . $atxKey . '</KEY><TYPE>' . $atxType . '</TYPE><VALUE>';
	    if(is_array($tmpArgArr[0][$atxKey])){
		    $atxXMLStr .= arrayToXml($tmpArgArr[0][$atxKey], $atxKey);
				$atxIsEmpty = false;
	    }
	    else{
		    if(is_object($tmpArgArr[0][$atxKey])){
		      $atxXMLStr .= get_class($tmpArgArr[0][$atxKey]);
					$atxIsEmpty = false;
		    }
		    else{
		      $atxXMLStr .= rawurlencode($tmpArgArr[0][$atxKey]);
					if($tmpArgArr[0][$atxKey] !== NULL){
						$atxIsEmpty = false;
					}
		    }
	    }
			if($atxIsEmpty){
				$atxXMLStr = substr($atxXMLStr, 0, (strlen($atxXMLStr)-1)) . '/></' . $atxChildKey . '>';
			}
			else{
	      $atxXMLStr .= '</VALUE></' . $atxChildKey . '>';
			}
	  }
		$atxXMLStr .=  '</' . $atxMainKey . '>';
	  //SGF::eventLog('array2Xml',0,'array2Xml for array: %return%'.$name.'%#return% was %return%finished%#return%.');
	  return $atxXMLStr;
  }
  return false;
}
/*-->
		  <li><h4>Methode: xmlToArray()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(array) $xml</li>
              <li>[(string) $mainKey]</li>
            </ul>
					</li>
					<li>return: array</li>
					<li>Warning! This methode can be used only if the XML text was converted by arrayToXml().<br/>
					    Convert a XML text to a array, return FALSE, if $xml is invalid.<br/>
					    Use $mainKey if the XML text was converted by arrayToXml(array, $mainKey).</li>
				</ul>
		  </li>
<!--*/
// array function xmlToArray((string) $xml[, (string) $mainKey])
function xmlToArray(){
	$tmpArgArr = func_get_args();
	if(isset($tmpArgArr[0]) && is_string($tmpArgArr[0]) && $tmpArgArr[0]){
	  $xtaXMLDOM = new DOMDocument();
	  if($xtaXMLDOM->loadXML($tmpArgArr[0])){
			$xtaArray = array();
			$xtaChildKey = isset($tmpArgArr[1]) && $tmpArgArr[1] !== '' ? 'ITEM_' . $tmpArgArr[1] : 'ITEM';
			$xtaItems = $xtaXMLDOM->getElementsByTagName($xtaChildKey);
			foreach($xtaItems as $xtaItem){
				$xtaKey = $xtaItem->getElementsByTagName('KEY')->item(0)->nodeValue;
				$xtaType = $xtaItem->getElementsByTagName('TYPE')->item(0)->nodeValue;
				$xtaValue = rawurldecode($xtaItem->getElementsByTagName('VALUE')->item(0)->nodeValue);
				switch($xtaType){
					case 'integer':
					  settype($xtaValue, 'integer');						
						break;
					case 'float':
					  settype($xtaValue, 'float');
						break;
					case 'string':
					  settype($xtaValue, 'string');
						break;
					case 'boolean':
					  settype($xtaValue, 'boolean');
						break;
					case 'null':
					  settype($xtaValue, 'null');
						break;
					case 'object':
					  settype($xtaValue, 'object');
						break;
					case 'array':
					  $xtaValue = xmlToArray($xtaXMLDOM->saveXML($xtaItem->getElementsByTagName('VALUE')->item(0)), $xtaKey);
						break;
				}
				$xtaArray[$xtaKey] = $xtaValue;
			}
			return $xtaArray;
	  }
	}
	return false;
}
/*-->
		  <li><h4>Methode: rawUrlToSQL()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(string) $rawUrlStr</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>Compose a rawurlencode(d) string, so that the string in MySQL database will be light found.</li>
				</ul>
		  </li>
<!--*/
// string rawUrlToSQL((string) $rawUrlStr)
function rawUrlToSQL(){
	$tmpArgArr = func_get_args();
  if(!isset($tmpArgArr[0]) || !$tmpArgArr[0]){
	  return '';
	}
	$tmpArgArr[0] = str_replace('%2C', ',' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%2E', '.' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%20', ' ' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%28', '(' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%29', ')' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%3A', ':' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%0D%0A', ' ' , $tmpArgArr[0]);
	
	$tmpArgArr[0] = str_replace('%D0%90', 'A' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%92', 'B' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%CE%95', 'E' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%95', 'E' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%9A', 'K' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%9C', 'M' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%9D', 'H' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%9E', 'O' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A0', 'P' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A1', 'C' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A2', 'T' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A3', 'Y' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A5', 'X' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%A8', 'W' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%AC', 'b' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%B0', 'a' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%B3', 'r' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%B5', 'e' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%BE', 'o' , $tmpArgArr[0]);
	$tmpArgArr[0] = str_replace('%D0%BF', 'n' , $tmpArgArr[0]);
	return $tmpArgArr[0];
} 
/*-->
		  <li><h4>Methode: intToStrWithSpecStrLength()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(int) integerNumber</li>
              <li>[(int) length]</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>Convert a integer to a string according to specific length,<br/>
					    e.g. intToStrWithSpecStrLength(219, 7): output: 0000219</li>
				</ul>
		  </li>
<!--*/
// string intToStrWithSpecStrLength((int) integerNumber[, (int) length])
function intToStrWithSpecStrLength(){
	$tmpArgArr = func_get_args();
	if(!isset($tmpArgArr[0]) || !is_int($tmpArgArr[0]) || !isset($tmpArgArr[1]) || !is_int($tmpArgArr[1])){
	  return false;
	}
	$itswsslNumber = $tmpArgArr[0] < 0 ? $tmpArgArr[0] * -1 : $tmpArgArr[0];
	$itswsslString = '';
	$itswsslNumberLength = $itswsslNumber > 0 ? floor(log10($itswsslNumber)) + 1 : 1;
	$itswsslZeroLength = $tmpArgArr[1] - $itswsslNumberLength;
	$itswsslZeroLength = $itswsslZeroLength < 0 ? 0 : $itswsslZeroLength;	
	settype($itswsslNumber, 'string');
	for($i = 0; $i < $itswsslZeroLength; $i++){
		$itswsslString .= '0';
	}
	$itswsslString .= $itswsslNumber;
	return $itswsslString;
}
/*-->
		  <li><h4>Methode: array_sort()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(int) integerNumber</li>
              <li>[(int) length]</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>Convert a integer to a string according to specific length,<br/>
					    e.g. intToStrWithSpecStrLength(219, 7): output: 0000219</li>
				</ul>
		  </li>
<!--*/
// string intToStrWithSpecStrLength((array) $array[, (string) $on[, (string) $order]])
function array_sort(){
	$tmpArgArr = func_get_args();
	if(!isset($tmpArgArr[0]) || !is_array($tmpArgArr[0])){
	  return false;
	}
  $new_array = array();
  $sortable_array = array();
  if(count($tmpArgArr[0]) > 0){
    foreach($tmpArgArr[0] as $k => $v){
      if(is_array($v)){
        foreach($v as $k2 => $v2) {
          if(isset($tmpArgArr[1]) && is_string($tmpArgArr[1]) && trim($tmpArgArr[1]) != '' && $k2 == $tmpArgArr[1]){
            $sortable_array[$k] = $v2;
          }
        }
      }
			else{
        $sortable_array[$k] = $v;
      }
    }
    $order = isset($tmpArgArr[2]) && $tmpArgArr[2] == 'DESC' ? 'DESC' : 'ASC';
		switch($order) {
      case 'ASC':
        asort($sortable_array);
        break;
      case 'DESC':
        arsort($sortable_array);
        break;
    }
    foreach ($sortable_array as $k => $v) {
      $new_array[$k] = $tmpArgArr[0][$k];
    }
  }
  return $new_array;
}
/*-->
		  <li><h4>Methode: getClientIP()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: void</li>
					<li>return: string</li>
					<li>get the real ip adresse from client, support IPv4, IPv6</li>
				</ul>
		  </li>
<!--*/
// string getClientIP(void)
function getClientIP(){
  if(@$_SERVER["HTTP_X_FORWARDED_FOR"]){
    $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];	  
	}
  else if(@$_SERVER["HTTP_CLIENT_IP"]){
    $ip = $_SERVER["HTTP_CLIENT_IP"];
	}
  else if(@$_SERVER["REMOTE_ADDR"]){
    $ip = $_SERVER["REMOTE_ADDR"];
	}
  else if(@getenv("HTTP_X_FORWARDED_FOR")){
    $ip = getenv("HTTP_X_FORWARDED_FOR");
	}
  else if(@getenv("HTTP_CLIENT_IP")){
    $ip = getenv("HTTP_CLIENT_IP");
	}
  else if(@getenv("REMOTE_ADDR")){
    $ip = getenv("REMOTE_ADDR");
  }
  else{
    $ip = false;
  }
  return $ip;
}
/*-->
		  <li><h4>Methode: ip2bin()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(string) ip</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>convert a IPv4 or IPv6 address to a bin number, support IPv4, IPv6</li>
				</ul>
		  </li>
<!--*/
// string ip2bin((string) $ip)
function ip2bin($ip){
	$tmpArgArr = func_get_args();
	if(!isset($tmpArgArr[0]) || !is_string($tmpArgArr[0])){
	  return false;
	}
	$ip = $tmpArgArr[0];
	if(strpos($ip, '%') !== false){
		$ip = substr($ip, 0, strpos($ip, '%'));
	}
  if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false){
    return base_convert(ip2long($ip),10,2);
	}
  if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false){
    return false;
	}
  if(($ip_n = inet_pton($ip)) === false){
		return false;
	}
  $bits = 15;
  $ipbin = '';
	while($bits >= 0){
    $bin = sprintf("%08b",(ord($ip_n[$bits])));
    $ipbin = $bin.$ipbin;
    $bits--;
  }
  return $ipbin;
}
/*-->
		  <li><h4>Methode: bin2ip()</h4>
	      <ul class="parameter">
				  <li>public;</li>
					<li>Arguments: 
            <ul class="arguments">
              <li>(string) bin</li>
            </ul>
					</li>
					<li>return: string</li>
					<li>convert a bin number to IPv4 or IPv6 address , support IPv4, IPv6</li>
				</ul>
		  </li>
<!--*/
// string bin2ip((string) $hex)
function bin2ip(){
	$tmpArgArr = func_get_args();
	if(!isset($tmpArgArr[0]) || !is_string($tmpArgArr[0])){
	  return false;
	}
	$bin = $tmpArgArr[0];
  if(strlen($bin) <= 32){
    return long2ip(base_convert($bin,2,10));
  }
  if(strlen($bin) != 128){
    return false;
  }
  $pad = 128 - strlen($bin);
  for($i = 1; $i <= $pad; $i++){
    $bin = "0".$bin;
  }
  $bits = 0;
  $ipv6 = '';
  while($bits <= 7){
    $bin_part = substr($bin,($bits*16),16);
    $ipv6 .= dechex(bindec($bin_part)).":";
    $bits++;
  }
  return inet_ntop(inet_pton(substr($ipv6,0,-1)));
} 
/*-->
    </ul>
	</li>
</ul>
<!--*/
?>