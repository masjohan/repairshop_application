<?php
  $u = $C->param('login_user');
  $C->shop = Biz_User::getShop($u['RoleTypeId']);
  $C->user = $u;

  if(!$_POST || !$C->acl->matchUrl()) return;

  $C->shop->fromArray($_POST);
  $C->shop->save();

  $C->outputType("json");
	$C->error = 0;
  $C->message = "Shop information has been saved successfully.";
