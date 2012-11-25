<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Biz_User
 *
 * @author tao
 */
class Biz_User extends User{
  //put your code here
  public function setTokenViaEmail($email) {
    $user = UserQuery::create('u')->where('u.Email=?', $email)->findOne();
    if (!$user) return FALSE;

    $user->fromArray($this->getTokenSent());
    $user->save();

    return $token;
  }

  public function getTokenSent() {
    preg_match('/[A-Z].{5}/', strtoupper(md5(uniqid())), $match);
    list($token) = $match;

    return array(
      'RecoveryToken' => $token,
      'RecoverySent'  => new DateTime(),
    );
  }

  public function getShop($RoleTypeId) {
    return ShopQuery::create()->findPk($RoleTypeId);
  }

}

?>
