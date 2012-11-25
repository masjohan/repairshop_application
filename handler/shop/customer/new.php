<?php

  if(!$_POST) return;

  if ($_POST['checkemail']) {
    $C->outputType("json");
    $C->error = UserQuery::create('u')->where('u.Email=?', $_POST['checkemail'])->count();
    $C->message = "The input email has been taken by other user";
    return;
  }

  $u = $C->param('login_user'); // must be shop owner
  $shop = Biz_User::getShop($u['RoleTypeId']);

  if(!$shop) {  // never should happen. in theory
    $sess->putNext(array(
      'messager'=>array(
        'txt' => 'System abnormal 3778',
        'cls' => 'error'
      )
    ));
    trigger_error("User {$u['Id']} creating a customer has no shop associated");
    return;
  };

	$cus = new Customer();
  $cus->fromArray($_POST);
  $cus->setShop($shop);
  $cus->save();

  $usr = new User();
  $usr->fromArray(array_merge(
    array(
      'RoleId'    => Biz_Query::CUSTOMER_ROLE_ID,
      'RoleTypeId'=> $cus->getId(),
    ),
    $_POST
  ));
  $usr->save();

  $C->session->data('customer_id', $usr->getRoleTypeId());

  $C->session->putNext(array(
    'messager'=>array(
      'txt' => 'Customer has been created successfully! Please continue on vehicle',
      'cls' => 'ok'
    )
  ));

  header("Location: /shop/vehicle/new", TRUE, 307);
  exit;

