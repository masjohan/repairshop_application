<?php
  $C->login_user = $C->param('login_user');
  if(!$_POST || !$C->acl->matchUrl()) return;

	$u = UserQuery::create()->findPk($C->login_user['Id']);
  $u->fromArray($_POST);
  $u->save();

  $C->outputType("json");
	$C->error = 0;