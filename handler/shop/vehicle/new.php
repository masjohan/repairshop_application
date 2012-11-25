<?php

  if(!$_POST) return;

  $sess = $C->session;
  $customer_id = $sess->data('customer_id');

  if (!$customer_id) {
    $sess->putNext(array(
      'messager'=>array(
        'txt' => 'Vehicle can not be created before a customer been created / selected',
        'cls' => 'error'
      )
    ));
    $C->vehicle = $_POST;
    return;
  }

	$v = new Vehicle();
  $v->fromArray(array_merge(
    $_POST,
    array("CustomerId" => $customer_id)
  ));
  $v->save();

  $sess->data('vehicle_id', $v->getId());
  $sess->putNext(array(
    'messager'=>array(
      'txt' => 'Vehicle has been created successfully! Please continue on RO',
      'cls' => 'ok'
    )
  ));

  header("Location: /shop/create-ro", TRUE, 307);
  exit;


