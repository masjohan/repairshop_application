<?php

  if(!$_POST) return;

  if ($_POST['checkemail']) {
    $C->outputType("json");
    $C->error = UserQuery::create('u')
            ->where('u.Email=?', $_POST['checkemail'])
            ->where('u.Id != ?', $_POST['user_id'] ? $_POST['user_id'] : 0)
            ->count();
    $C->message = "The input email has been taken by other user";
    return;
  }

  $u = $C->param('login_user'); // must be shop owner
  $shop = Biz_User::getShop($u['RoleTypeId']);

  if(!$shop) {  // never should happen. in theory
    $sess->messenger('System abnormal 3778','error');
    trigger_error("User {$u['Id']} creating a customer has no shop associated");
    return;
  };

  if ($C->acl->matchUrl()) {
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
    $C->session->messenger('Customer has been created successfully! Please continue on vehicle', 'ok');

    header("Location: /shop/vehicle/new", TRUE, 307);
    exit;
  }
