<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Biz_ACL {

  public static function getInstance() {
    static $singlton;
    if (!$singlton) $singlton = new Biz_ACL();
    return $singlton;
  }

  private function __construct(){}

  // check if allow access to given action
  public function check($action) {
    $C = Controller::getInstance();
    $sess = $C->param('session');
    $dbh = $C->param('dbh');

    if ($sess->is_login()) {
      $stmt = $dbh->prepare(Biz_Query::$ACL_check_login);
      $stmt->execute(array(
        ':user' => $sess->login_id(),
        ':path' => $action
      ));
    } else {
      $stmt = $dbh->prepare(Biz_Query::$ACL_check_guest);
      $stmt->execute(array(
        ':path' => $action
      ));
    }
    list(list($cnt)) = $stmt->fetchAll(PDO::FETCH_NUM);

    // acl usually is mean. Just do redirect
    if ( !$cnt ) {
      if (!$sess->is_login()) {
        $sess->data('redirect', $action);
        $sess->messenger('To proceed, please first login!', 'alert');
        header("Location: /", TRUE, 307);
      } else {
        $sess->messenger('It seems you are not supposed to view that page', 'error');
        $to = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : '/';
        // HTTP/1.1 204 No Content
        header("Location: $to", TRUE, 307);
      }
      exit;
    }

    $C->param('action', ActionQuery::create('a')->where('a.Path=?', $action)->findOne()->toArray());
    if ($sess->is_login()) {
      $C->param('login_user', UserQuery::create('u')->findPk($sess->data('user_id'))->toArray());
    }
    $customer_id = $sess->data('customer_id');
    if ($customer_id) {
      $C->param('serving_customer', array_merge(
        CustomerQuery::create('c')->findPk($customer_id)->toArray(),
        UserQuery::create('c')
          ->where('c.RoleId=?',  Biz_Query::CUSTOMER_ROLE_ID)
          ->where('c.RoleTypeId=?', $customer_id)
          ->findOne()
          ->toArray()
      ));
    }
    $vehicle_id = $sess->data('vehicle_id');
    if ($vehicle_id) {
      $vehicle = VehicleQuery::create()->findPk($vehicle_id);
      if ($vehicle && $vehicle->getCustomerId() == $customer_id) {
        $C->param('serving_vehicle', $vehicle->toArray());
      } else {
        $sess->data('vehicle_id', NULL, TRUE); //remove vehicle from sesssion, it is wrong
      }
    }

    return (boolean)$cnt;
  }

  // all allowed action, mainly for generate menu
  public function rightActions() {
    $C = Controller::getInstance();
    $sess = $C->param('session');
    $dbh = $C->param('dbh');

    if ($sess->is_login()) {
      $stmt = $dbh->prepare(Biz_Query::$ACL_rightActions_login);
      $stmt->execute(array(
        ':user' => $sess->login_id()
      ));
    } else {
      $stmt = $dbh->prepare(Biz_Query::$ACL_rightActions_guest);
      $stmt->execute();
    }

    $categories = array();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      if (isset($categories[$row['category']])) {
        $categories[$row['category']][] = $row;
      } else {
        $categories[$row['category']] = array($row);
      }
    }
    return $categories;
  }

  // after passwd checked, do this ..
  public function comein($user_id) {
    // make the user login
    $sess = Controller::getInstance()->param('session');
    $sess->login($user_id);

    // if user previously attemp to access a page, try again, no garentee
    $action = $sess->data('redirect');
    if ($action) {
      $sess->data('redirect', NULL, TRUE);
    } else {
      $action = "";
    }

    header("Location: /$action", TRUE, 307);
    exit;
  }

  // reset password by token
  public function resetPassword($token, $passwd) {
    $dbh = Controller::getInstance()->param('dbh');

    $stmt = $dbh->prepare(Biz_Query::$reset_pwd);
    $stmt->execute(array(
      ':token' => $token,
      ':passwd' => $passwd
    ));
    return (boolean)$stmt->rowCount();
  }

  // set password by id
  public function setPassword($id, $passwd) {
    $stmt = Controller::getInstance()->param('dbh')->prepare(Biz_Query::$set_pwd);
    $stmt->execute(array(
      ':id' => $id,
      ':passwd' => $passwd
    ));
    return (boolean)$stmt->rowCount();
  }

  const SIGN_URL = '__s_h';   // jus make it weired
  const SIGN_URL_SALT = 'kl78qw45ew5^$%&RSfas90dfg8q34ASDFLDRYBWY^ER%^WTQW%$Q#5qwioruvqwrupqwv34%E^&%Eysdhawetw$%V^QW%V@#5';

  // if you would trust GET, sign it | php('sign')
  public function signUrl($url = NULL, $isMatch = FALSE) {
    if (!$url) $url = $_SERVER["REQUEST_URI"];

    $parts = parse_url($url);
    $output = array();
    if (isset($parts['query'])) parse_str($parts['query'], $output);

    if (isset($output[self::SIGN_URL])) unset($output[self::SIGN_URL]);
    $signBase = $parts['path']. ($output ? ("?".http_build_query($output)) : '');

    $output[self::SIGN_URL] = sha1($signBase.session_id().$_SERVER['REMOTE_ADDR'].self::SIGN_URL_SALT);

    return $isMatch
      ? (isset($_GET[self::SIGN_URL]) && $output[self::SIGN_URL] == $_GET[self::SIGN_URL])
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

