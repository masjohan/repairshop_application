<?php

 $sess = $C->session;

  $select_id = isset($_GET['select_id']) ? $_GET['select_id'] : NULL;
  if ( $select_id && $C->acl->matchUrl() ) {
    $v = VehicleQuery::create()->findPk($select_id);
    if ($v) {
      $sess->data('customer_id', $v->getCustomerId());
      $sess->data('vehicle_id', $v->getId());
      $sess->messenger("Vehicle and its owner has been selected successfully", "ok");
      header("Location: /shop/vehicle/search");
      exit;
    }
  }

  $customer_id = $sess->data('customer_id');
  if ($customer_id) {
    $stmt = $C->param('dbh')->prepare(Biz_Query::$all_customer_vehicle);
    $stmt->execute(array(":customer" => $customer_id));
    $C->cusV= $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  $stmt = $C->param('dbh')->prepare(Biz_Query::$all_shop_vehicle);
  $shop_id = $sess->data('LoginUserShopId');
  $stmt->execute(array(":shop" => $shop_id));

  $C->allV= $stmt->fetchAll(PDO::FETCH_ASSOC);