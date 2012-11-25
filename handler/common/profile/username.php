<?php

  $C->login_user = $C->param('login_user');

  if (isset($_POST['checkusername'])) {
    $C->outputType("json");

    if ($C->login_user['Username'] == $_POST['checkusername']) {
      $C->error = 1;
      $C->message = "No different from your current username";
      return;
    }

    $C->error = UserQuery::create('u')->where('u.Username=?', $_POST['checkusername'])->count();
    $C->message = "The username has been taken by other user";
    return;

  } else if($_POST && $C->acl->matchUrl()) {
    $u = UserQuery::create()->findPk($C->login_user['Id']);
    $u->fromArray(array(
        "Username" => $_POST['Username']
    ));
    $u->save();

    $C->outputType("json");
    $C->error = 0;
  }


