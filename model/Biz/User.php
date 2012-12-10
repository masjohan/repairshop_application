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

  public function getShopCustomers() {

  }

  public function getShopVehicles() {

  }

  // very tolerent and very rough, make it quick
  public function createCustomer($shop_id, &$args) {
    foreach(array('FirstName','LastName','Phone') as $k) {
      if (!$args[$k]) return NULL;
    }

    if ($args['customer_id']) {
      $cus = CustomerQuery::create()->findPk($args['customer_id']);
      if (!$cus) return NULL;
      $usr = UserQuery::create('u')
              ->where('u.RoleId=?', Biz_Query::CUSTOMER_ROLE_ID)
              ->where('u.RoleTypeId=?', $cus->getId())
              ->findOne();
      if (!$usr) return NULL;
      $isUpdating = TRUE;
    } else {
      $cus = new Customer();
      $usr = new User();
    }

    $cus->fromArray($args);
    $cus->setShopId($shop_id);  // @securiy
    $cus->setNotes($args['CustomerNotes'] ? $args['CustomerNotes'] : $args['Notes']); // mess
    $cus->save();

    $customer_id = $cus->getId();

    // wont fight for dup email
    if ($args['Email'] && UserQuery::create('u')
              ->where('u.Email = ?', $args['Email'])
              ->where('u.Id != ?', $isUpdating ? $usr->getId() : 0)
              ->count()) {
        unset($args['Email']);  // @securiy
    }

    $usr->fromArray(array_merge(
      array(
        'RoleId'    => Biz_Query::CUSTOMER_ROLE_ID, // @securiy
        'RoleTypeId'=> $customer_id,
      ),
      $args
    ));
    $usr->save();

    return $customer_id;
  }

  public function createVehicle($customer_id, &$args) {
    foreach(array('Year','Make','Model') as $k) {
      if (!$args[$k]) return NULL;
    }

    if ($args['vehicle_id']) {
      $v = VehicleQuery::create()->findPk($args['vehicle_id']);
      if (!$v || $v->getCustomerId() != $customer_id) return NULL; // @securiy
      $isUpdating = TRUE;
    } else {
      $v = new Vehicle();
    }

    // wont fight for dup LicensePlate or Vin
    if ($args['LicensePlate'] && VehicleQuery::create('v')
              ->where('v.LicensePlate = ?', $args['LicensePlate'])
              ->where('v.Id != ?', $isUpdating ? $v->getId() : 0)
              ->count()) {
      unset($args['LicensePlate']);
    }
    if ($args['Vin'] && VehicleQuery::create('v')
              ->where('v.Vin = ?', $args['Vin'])
              ->where('v.Id != ?', $isUpdating ? $v->getId() : 0)
              ->count()) {
      unset($args['Vin']);
    }


    $v->fromArray(array_merge(
      $args,
      array("CustomerId" => $customer_id)  // @securiy
    ));
    $v->save();

    return $v->getId();
  }

  public function createRO($vehicleId, &$args) {
    if ($args['repair_order_id']) {
      $v = RepairorderQuery::create()->findPk($args['repair_order_id']);
      if (!$v || $v->getVehicleId() != $vehicleId) return NULL; // @securiy
      $isUpdating = TRUE;
    } else {
      $v = new Repairorder();
    }

    $v->fromArray(array_merge(
      $args,
      array("VehicleId" => $vehicleId)  // @securiy
    ));
    $v->save();

    return $v->getId();
  }
}

?>
