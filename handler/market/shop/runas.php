<?php

  $C->shopUser = $C->param('dbh')->query(Biz_Query::$all_shop_user)->fetchAll(PDO::FETCH_ASSOC);


  $runAsId = isset($_GET['id']) ? $_GET['id'] : NULL;

  if ( $runAsId && $C->acl->matchUrl() ) {
    $C->session->runAs($runAsId);
  }
