<?php

  if( $_REQUEST['username'] &&  $_REQUEST['password']) {
    $stmt = $C->param('dbh')->prepare(Biz_Query::$login);
    $stmt->execute(array(
      ':email' => $_REQUEST['username'],
      ':passwd' => $_REQUEST['password']
    ));
    $rows = $stmt->fetchAll(PDO::FETCH_NUM);

    if (count($rows)) {
      list(list($user_id)) = $rows;
      $C->param('acl')->comein($user_id);
    }
  }

  $C->param('session')->messenger('The username or password you entered is incorrect.', 'error');

	$C->dispatch("/");
