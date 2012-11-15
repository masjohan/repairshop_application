<?php
    $C->needLogin();
    if(!$_POST || !$C->session->matchUrl()) return;

    TW_DataModel::safeVars($_POST);

	$v = new IcaVehicle();
    $v->fromArray($_POST);
    $v->setPhpbbUsers($C->user)
            ->setCreated(new DateTime())
            ->save();

	$C->SAVED_UserVehicle = 1;
