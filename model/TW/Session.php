<?php
Class TW_Session {  //  implements SessionHandlerInterface

  private $dbh;

  const NS = 'user_ns';

  private function __construct() {
    $this->dbh = Controller::getInstance()->param('dbh');
  }
  public static function getInstance() {
    static $singlton;
    if (!$singlton) {
      $singlton = new TW_Session();
      session_set_save_handler(
        array($singlton, 'open'),
        array($singlton, 'close'),
        array($singlton, 'read'),
        array($singlton, 'write'),
        array($singlton, 'destroy'),
        array($singlton, 'gc')
      );
      // the following prevents unexpected effects when using objects as save handlers
      register_shutdown_function('session_write_close');
      session_start();
    }
    return $singlton;
  }

  public function open( $save_path , $session_name ) {
    return TRUE;
  }

  public function read( $session_id ) {
    $stmt = $this->dbh->prepare("SELECT device_key, value FROM _session WHERE session_id=?");
    $stmt->execute(array($session_id));
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // device signature
    $requDevKey = md5( $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'] );

    if ($row) {
      // php list must been given a list
      list($savedDevKey, $value) = array_values($row[0]);
      // failed to validate
      if ($savedDevKey !== $requDevKey) {
      $stmt = $this->dbh->prepare("UPDATE _session SET device_key=?, value='',updated_on=NOW() WHERE session_id=?");
      $stmt->execute(array($requDevKey, $session_id));
      $value = '';
      }
    } else {
      $stmt = $this->dbh->prepare("INSERT INTO _session (session_id,device_key,updated_on) VALUE(?,?,NOW())");
      $stmt->execute(array($session_id, $requDevKey));
      $value = '';
    }

    return $value;
  }

  public function write ($session_id , $session_data ) {
    $stmt = $this->dbh->prepare("UPDATE _session SET value=?, updated_on=NOW() WHERE session_id=?");
    $stmt->execute(array($session_data, $session_id));
    return (boolean)$stmt->rowCount();
  }

  public function close(){
    return true;
  }

  public function destroy($session_id ){
    $stmt = $this->dbh->prepare("DELETE FROM _session WHERE session_id=?");
    $stmt->execute(array($session_id));
    return (boolean)$stmt->rowCount();
  }

  public function gc($maxlifetime) {
    $stmt = $this->dbh->prepare("DELETE FROM _session WHERE updated_on < DATE_ADD(NOW(), INTERVAL ? SECOND)");
    $stmt->execute(array(-1 * $maxlifetime));
    return true;
  }

  // Use this to handle session data, since handle run as
  public function data($key, $val = NULL, $remove = NULL) {
    // user_ is special always at top. WHY? by mistake
    if (preg_match('/^user_(id|stack|once|ns)/', $key)) {
      $sess = &$_SESSION;
    } else if ($this->isRunAs()) {
      $namespace = self::NS.$this->login_id();
      if (!isset($_SESSION[$namespace])) $_SESSION[$namespace] = array();
      $sess = &$_SESSION[$namespace];
    } else {
      $sess = &$_SESSION;
    };

    if ($remove === TRUE) {
      unset($sess[$key]);
    } else if ( $val !== NULL ) {
      $sess[$key] = $val;
    } else {
      return isset($sess[$key]) ? $sess[$key] : NULL;
    }
  }

  public function login($user_id) {
    $this->data('user_id', $user_id);

    // LoginUserType LoginUserCustomerId LoginUserShopId LoginUserMarketId
    $stmt = $this->dbh->prepare(Biz_Query::$all_login_type);
    $stmt->execute(array(":user_id" => $user_id));
    $loginTypes = $stmt->fetch(PDO::FETCH_ASSOC);

    foreach($loginTypes as $k => $v) {
      $this->data($k, $v);
    }
  }

  public function login_id($type = NULL) {
    if (!$type) {
      return $this->data("user_id");
    }

    $LoginUserType = $this->data('LoginUserType');
    if (strcasecmp($type, "type") === 0 ) {
      return strtoupper($LoginUserType);
    } else if ( strcasecmp($type, $LoginUserType) === 0 ) {
      return $this->data("LoginUser{$LoginUserType}Id");
    }
    return NULL;
  }

  public function login_type_id() {
    $LoginUserType = $this->data('LoginUserType');
    return $this->data('LoginUser' + $LoginUserType + 'Id');
  }

  public function is_login() {
    return $this->data('user_id') !== NULL;
  }

  public function logOut() {
    $this->data('user_id', NULL, TRUE);
    $this->destroy(session_id());
  }

  // data put here will all throw out tpl
  public function putNext($assoc) {
    $next = $this->data('user_once');
    if ($next === NULL) $next = array();
    $this->data('user_once', array_merge($next, $assoc));
  }
  public function throwNext() {
    $next = $this->data('user_once');
    if ($next === NULL) $next = array();
    $this->data('user_once', NULL, TRUE);
    return $next;
  }
  public function messenger($msg, $type) {
    $this->putNext(array(
      'messager'=>array(
        'txt' => $msg,
        'cls' => preg_match('/^ok|error$/', $type) ? $type : 'alert'
      )
    ));
  }

  public function runAs($userId) {
    $runAs = $this->data('user_stack');
    if ($runAs === NULL) $runAs = array();
    array_push($runAs, $this->login_id());

    // can NOT loop, no change for any session data
    if (in_array($userId, $runAs)) return FALSE;

    $this->data('user_stack', $runAs);
    $this->login($userId);
    header("Location: /", TRUE, 307);
    exit;
  }

  public function exitRunAs() {
    $runAs = $this->data('user_stack');
    if ($runAs === NULL) return FALSE;

    $namespace = self::NS.$this->login_id();
    $this->data($namespace, NULL, TRUE);

    $userId = array_pop($runAs);
    $this->data('user_stack', $runAs);
    $this->login($userId);
    header("Location: /", TRUE, 307);
    exit;
  }

  public function isRunAs() {
    $runAs = $this->data('user_stack');
    return is_array($runAs) && count($runAs);
  }
}
