<?php
  if(!$_POST || !$C->acl->matchUrl()) return;

	$cus = new Customer();
  $cus->fromArray($_POST);
  $cus->save();

  $C->outputType("json");
	$C->error = 0;
  $C->message = "";