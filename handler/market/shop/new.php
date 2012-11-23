<?php
  if( !$_POST ) return;

  // this is json handler
  $C->outputType('json');
  // check email dup
  $isEmailTaken = UserQuery::create('u')->where('u.Email=?', $_POST['Email'])->count();

  if ($isEmailTaken) {
    $C->error = 1;
    $C->message = "The input email has been taken by other user";
    return;
  }

	$shop = new Shop();
  $shop->fromArray(array(
    'Name' => $_POST['Name'],
  ));
  $shop->save();

  $u = new User();

  $ts = Biz_User::getTokenSent();
  $u->fromArray(array_merge(
    array(
          'Email'     => $_POST['Email'],
          'RoleId'    => Biz_Query::OWNER_ROLE_ID,
          'RoleTypeId'=> $shop->getId(),
        ),
    $ts
  ));
  $u->save();

  $res = $C->param('acl')->setPassword($u->getId(), $_POST['Passwd']);

	$C->error = 0;
  $C->shop = $shop->getName();
  $C->email = $u->getEmail();
  $C->token = $u->getRecoveryToken();
  $C->link = "http://{$_SERVER['HTTP_HOST']}/?{$C->token}";

