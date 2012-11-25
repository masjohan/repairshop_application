<?php

  $C->login_user = $C->param('login_user');

  if($_POST && $C->acl->matchUrl()) {
    $C->outputType("json");

    $stmt = $C->param('dbh')->prepare(Biz_Query::$login);
    $stmt->execute(array(
      ':email' => $C->login_user['Email'],
      ':passwd' => $_POST['PasswordOld']
    ));
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);

    if (count($rows) == 0) {
      $C->error = 1;
      $C->message = "Current password is incorrect.";
      return;
    }
    Biz_ACL::setPassword($C->login_user['Id'], $_POST['PasswordNew']);
    
    $C->error = 0;
  }
