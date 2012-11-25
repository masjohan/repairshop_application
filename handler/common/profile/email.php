<?php

  $C->login_user = $C->param('login_user');

  if (isset($_POST['checkemail'])) {
    $C->outputType("json");

    if ($C->login_user['Email'] == $_POST['checkemail']) {
      $C->error = 1;
      $C->message = "No different from your current email";
      return;
    }

    $C->error = UserQuery::create('u')->where('u.Email=?', $_POST['checkemail'])->count();
    $C->message = "The input email has been taken by other user";
    return;

  } else if($_POST || $C->acl->matchUrl()) {
    $u = UserQuery::create()->findPk($C->login_user['Id']);
    $u->fromArray(array(
        "Email" => $_POST['Email']
    ));
    $u->save();

    $C->outputType("json");
    $C->error = 0;
  }


