<?php

  $sess = $C->session;

  $select_id = isset($_GET['select_id']) ? $_GET['select_id'] : NULL;
  if ( $select_id && $C->acl->matchUrl() ) {
    $u = UserQuery::create()->findPk($select_id);
    if ($u) {
      $sess->data('customer_id', $u->getRoleTypeId());
      $sess->messenger("Customer ,".$u->getEmail()." has been selected successfully", "ok");
      header("Location: /shop/customer/search");
      exit;
    }
  }

  $stmt = $C->param('dbh')->prepare(Biz_Query::$all_shop_customer);
  $shop_id = $sess->data('LoginUserShopId');
  $stmt->execute(array(":shop" => $shop_id));

  $C->cusUser= $stmt->fetchAll(PDO::FETCH_ASSOC);
