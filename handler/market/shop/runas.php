<?php
  $runAsId = isset($_GET['runas']) ? $_GET['runas'] : NULL;
  $sendTkId = isset($_GET['token']) ? $_GET['token'] : NULL;

  if ( $runAsId && $C->acl->matchUrl() ) {
    $C->session->runAs($runAsId);
    return;
  }

  if ( $sendTkId && $C->acl->matchUrl() ) {
    $u = UserQuery::create()->findPk($sendTkId);
    $u->fromArray(Biz_User::getTokenSent());
    $u->save();

    $C->session->messenger("User ,".$u->getEmail()." has been sent token successfully", "ok");
  }

  $C->shopUser = $C->param('dbh')->query(Biz_Query::$all_shop_user)->fetchAll(PDO::FETCH_ASSOC);
