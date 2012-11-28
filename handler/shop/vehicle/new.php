<?php

  if(!$_POST) return;

  $sess = $C->session;
  $customer_id = $sess->data('customer_id');

  if (!$customer_id) {
    $sess->messenger('Vehicle can not be created before a customer been created / selected', 'error');
    $C->vehicle = $_POST;
    return;
  }

  if ($C->acl->matchUrl()) {
    $v = new Vehicle();
    $v->fromArray(array_merge(
      $_POST,
      array("CustomerId" => $customer_id)
    ));
    $v->save();

    $sess->data('vehicle_id', $v->getId());
    $sess->messenger('Vehicle has been created successfully! Please continue on RO', 'ok');

    header("Location: /shop/create-ro", TRUE, 307);
    exit;
  }
