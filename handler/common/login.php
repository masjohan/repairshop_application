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
            Biz_ACL::comein($user_id);
        }
    };

    $C->param('session')->putNext(array('messager'=>array(
        'txt' => 'The username or password you entered is incorrect.',
        'cls' => 'error'
    )));

	$C->dispatch("/");
