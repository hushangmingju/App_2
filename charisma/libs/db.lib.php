<?php
class db { 
  public $db; 
  function __construct($dbhost, $dbuser, $dbpwd, $dbname=null) { 
    $this->connect($dbhost, $dbuser, $dbpwd, $dbname); 
  } 
  function __destruct() { 
    $this->close(); 
  } 
  function connect($dbhost, $dbuser, $dbpwd, $dbname=null) { 
    $this->db = @mysqli_init(); 
    @$this->db->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2); 
    $connect = @$this->db->real_connect($dbhost, $dbuser, $dbpwd); 
    if (!$connect) { 
      exit("数据库错误
            \n错误代码：".$this->db->connect_errno."
            \n错误信息：".mb_convert_encoding($this->db->connect_error,'UTF-8','GBK')."\n"); 
      return null; 
    }
    else{ 
      $this->db->set_charset('utf8'); 
    }
    if($dbname){ 
      $this->db->select_db($dbname); 
    } 
    return $this->db; 
  } 
  function select_db($dbname) { 
    return $this->db->select_db($dbname); 
  } 
  function query($sql) { 
    return $this->db->query($sql); 
  } 
  function fetch_all($query) { 
    return $query->fetch_all(MYSQLI_ASSOC); 
  } 
  function fetch_array($query) { 
    return $query->fetch_array(MYSQLI_ASSOC); 
  } 
  function fetch_row($query) { 
    return $query->fetch_row(); 
  } 
  function fetch_assoc($query) { 
    return $query->fetch_assoc(); 
  } 
  function fetch_object($query) { 
    return $query->fetch_object(); 
  } 
  function fetch_num($query) { 
    return mysqli_num_rows($query); 
  } 
  function error() { 
    return $this->db->error; 
  } 
  function errno() { 
    return $this->db->errno; 
  } 
  function close() { 
    return $this->db->close(); 
  } 
  function insert_id() { 
    return $this->db->insert_id; 
  } 
  function field_count() { 
    return $this->db->field_count; 
  } 
  function addslashes($data=null) { 
    return $this->db->real_escape_string($data); 
  } 
  function MakeSql($tab=null,$params=null,$where=null){ 
    if( !$tab || !$params){
      return null;
    } 
    if(!$where){ 
      $keys = ''; 
      $values = ''; 
      foreach($params as $key=>$value) {
        $keys .= "`$key`,"; 
        $values .= "'".$this->addslashes($value)."',";
      } 
      $keys = substr($keys, 0, -1); 
      $values = substr($values, 0, -1); 
      $sql = "INSERT INTO `$tab` ({$keys}) VALUES ({$values}) "; 
    }
    else{ 
      $sql = ''; 
      foreach($params as $key=>$value) {
        $sql .= " `{$key}`='".$this->addslashes($value)."' ,";
      } 
      $sql = substr($sql, 0, -1); 
      if(is_array($where)){ 
        $whereSql = " `{$where[0]}`='{$where[1]}' "; 
      }
      else{ 
        $whereSql = " $where "; 
      } 
      $sql="UPDATE `$tab` SET {$sql} WHERE ".$whereSql; 
    } 
    return $sql; 
  } 
  function QueryInsUp($tab=null,$params=null,$where=null) { 
    return $this->query($this->MakeSql($tab,$params,$where)); 
  } 
  function QueryData($sql=null,$type="assoc") { 
    $query = $this->query($sql);
    if($query){ 
      if($type=="assoc"){ 
        $queryData = $this->fetch_assoc($query); 
      }
      elseif($type=="all"){ 
        $queryData = $this->fetch_all($query); 
      }
      elseif($type=="array"){ 
        $listArr = array(); 
        while ($row = $this->fetch_array($query)) { 
          array_push( $listArr,$row); 
        } 
        $queryData = $listArr; 
      }
      elseif($type=="row"){ 
        $queryData = $this->fetch_row($query); 
      }
      elseif($type=="object"){ 
        $queryData = $this->fetch_object($query); 
      }
      elseif($type=="num"){ 
        $queryData = $this->fetch_num($query); 
      }
      else{ 
        $queryData = $this->fetch_assoc($query); 
      } 
    }
    else{ 
      $queryData = null; 
    } 
    return $queryData; 
  } 
  function test() { 
    return "#return test()#"; 
  } 
} 
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpwd = '*1Hu2Shang3Ming4Ju#';
$dbname = 'mingju';
$db = new db($dbhost, $dbuser, $dbpwd, $dbname );
?>