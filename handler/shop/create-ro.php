<?php
  $sess = $C->session;

  if ($_GET['reset']) {
    $sess->data('customer_id', '', TRUE);
    $sess->data('vehicle_id', '', TRUE);
    $sess->messenger('Currently you are NOT dealing with any vehicle or customer', 'ok');
    header("Location: /shop/create-ro");
    exit;
  }

  $c = $C->customer = $C->param('serving_customer');
  $v = $C->vehicle = $C->param('serving_vehicle');

  $opts = array();
  foreach(RepairorderstatusQuery::create()->find() as $st) {
    $opts[$st->getId()] = $st->getStatus();
  }
  $C->ROStatus = $opts;

  // if have vehicle in serving, find repair order
  if ($v) {
    $ro = RepairorderQuery::create('ro')
            ->where('ro.VehicleId = ?', $v['Id'])
            ->where('ro.RepairOrderStatusId != ?', Biz_Query::RO_CLOSE_STATUS_ID)
            ->findOne();
    if ($ro) {
      $C->ro = $ro->toArray();
    }
  }

  if ($ro && isset($_GET['RoCodeId']) && $_GET['RoCodeId']) {
    $roi = $_GET['id'] ?  RepairorderitemQuery::create()->findPk($_GET['id']) : new Repairorderitem();
    if (!$roi) {
      $C->error = 1;
      $C->message = "Abnormal error 24223";
      return;
    }

    $roi->fromArray($_GET);
    $roi->setRepaireOrderId($ro->getId());
    $roi->save();

    $C->error = 0;
    $C->row = $roi->toArray();
    $C->message = "RO item has been saved successfully";

    return;
  } else if ($ro && $_GET['id'] && $_GET['action'] === 'delete') {
    $roi = RepairorderitemQuery::create()->findPk($_GET['id']);
    if ($roi->getRepaireOrderId() != $ro->getId()) {
      $C->error = 1;
      $C->message = "Abnormal error 24223";
      return;
    }
    $roi->delete();
    $C->error = 0;
    $C->message = "RO item has been deleted successfully";

  // prepare this for web
  } else if($ro) {
    $roCodeOpts = array();
    $roCodeDescOpts = array();
    foreach(RepairordercodeQuery::create()->find() as $st) {
      $roCodeOpts[$st->getId()] = $st->getCode();
      $roCodeDescOpts[$st->getId()] = $st->getDesc();
    }
    $C->roCodeOpts = $roCodeOpts;
    $C->roCodeDescOpts = $roCodeDescOpts;

    $roItems = array();
    foreach($ro->getRepairorderitems()->toArray() as $i => $row) {
      $roItems[] = array(chr(65+$i), $row['RoCodeId'], $row['Tech'], $row['Desc'], $row['Price'], $row['Id']);
    }
    $C->roItems = $roItems;
  }


  if(!$_POST) return;

  if (isset($_POST['customer_id']) && isset($_POST['vehicle_id'])) {
    $shop_id = $sess->login_id('shop');
    if(!$shop_id) {  // never should happen. in theory
      $sess->messenger('System abnormal 3778','error');
      return;
    } else if ($_POST['customer_id'] && $_POST['customer_id'] != $C->customer['Id']) {  // must editing customer in service
      $sess->messenger('System abnormal 8457','error');
      return;
    } else if ($_POST['vehicle_id'] && $_POST['vehicle_id'] != $C->vehicle['Id']) {  // must editing customer in service
      $sess->messenger('System abnormal 5234','error');
      return;
    }

    $isUpdating = $_POST['vehicle_id'] && $_POST['customer_id'];

    // new custerom and set customer in service
    $customer_id = Biz_User::createCustomer($shop_id, $_POST);
    if (!$customer_id || $customer_id <= 0) return;
    $sess->data('customer_id', $customer_id);

    // new vehicle and set it in serving
    $vehicle_id = Biz_User::createVehicle($customer_id, $_POST);
    if (!$vehicle_id || $vehicle_id <= 0) return;
    $sess->data('vehicle_id', $vehicle_id);

    // messageing
    $sess->messenger('Customer and Vehicle has been '.($isUpdating ? "updated" : "created").' successfully! Please continue on RO', 'ok');
    header("Location: /shop/create-ro?active=3");
    exit;

  } else if (isset($_POST['repair_order_id']) && $_POST['RepairOrderStatusId']) {
    $ro = Biz_User::createRO($C->vehicle['Id'], $_POST);
    $sess->messenger('Repair order has been created. Please continue on detailed item list', 'ok');
    header("Location: /shop/create-ro?active=3");
    exit;
  }
