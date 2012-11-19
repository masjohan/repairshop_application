<?php
Class TW_Session {  //  implements SessionHandlerInterface

    private $dbh;

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

    public function data($key, $val = NULL, $remove = NULL) {
        if ($remove === TRUE) {
            unset($_SESSION[$key]);
        } else if ( $val !== NULL ) {
            $_SESSION[$key] = $val;
        } else {
            return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
        }
    }

    public function login($user_id) {
        $this->data('user_id', $user_id);
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
        $next = $this->data('_NEXT');
        if ($next === NULL) $next = array();
        $this->data('_NEXT', array_merge($next, $assoc));
    }

    public function throwNext() {
        $next = $this->data('_NEXT');
        if ($next === NULL) $next = array();
        $this->data('_NEXT', array());
        return $next;
    }

    const SIGN_URL = '__s_h';   // jus make it weired
    const SIGN_URL_SALT = 'kl78qw45ew5^$%&RSfas90dfg8q34ASDFLDRYBWY^ER%^WTQW%$Q#5qwioruvqwrupqwv34%E^&%Eysdhawetw$%V^QW%V@#5';

    public function signUrl($url = NULL, $isMatch = FALSE) {
        if (!$url) $url = $_SERVER["REQUEST_URI"];

        $parts = parse_url($url);
        $output = array();
        if (isset($parts['query'])) parse_str($parts['query'], $output);

        if (isset($output[self::SIGN_URL])) unset($output[self::SIGN_URL]);
        $signBase = $parts['path']. ($output ? ("?".http_build_query($output)) : '');

        $output[self::SIGN_URL] = sha1($signBase.session_id().$_SERVER['REMOTE_ADDR'].self::SIGN_URL_SALT);

        return $isMatch
            ? ($output[self::SIGN_URL] == $_GET[self::SIGN_URL])
            : ($parts['path'].'?'.http_build_query($output));
    }

    /**
    * @param string $url
    * @return boolean
    */
    public function matchUrl($url = NULL) {
        return $this->signUrl($url, TRUE);
    }
}
