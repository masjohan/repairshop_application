<?php
    $C->checkLogin();
    if(!$_POST || !$C->session->matchUrl()) return;

	$cus = new Customer();
    $cus->fromArray($_POST);
    $cus->save();

    $C->outputType("json");
	$C->error = 0;
    $C->message = "";
