<?php

    if( isset($_POST['Email']) ) {
        $user = UserQuery::create('u')->where('u.Email=?', $_POST['Email'])->findOne();

        if ( !$user ) {
            $C->outputType("json");
            $C->error = 1;
            $C->message = "We couldn't find associated account";
        } else {
            $email = $user->getEmail();

            $token = strtoupper(substr(uniqid(), 0, 9));

            $user->fromArray(array(
                'RecoveryToken' => $token,
                'RecoverySent'  => new DateTime(),
            ));
            $user->save();

            $headers =  'From: root@localhost.localdomain' . "\r\n" .
                        'Reply-To: root@localhost.localdomain' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            mail($email, 'RepairShop reset password', <<<BOD
Hi there,

To reset your password, please click on the the link below
http://{$_SERVER['HTTP_HOST']}/?{$token}

Repairshop Team.
BOD
                , $headers
            );


            $C->outputType("json");
            $C->error = 0;
            $C->message = "We have sent out the instruction to {$_POST['Email']}. Go check";
        }
    } else if ( preg_match('/^[0-9A-Z]{9}$/', $_SERVER['QUERY_STRING']) ) {
        $token = $_SERVER['QUERY_STRING'];
        $user = UserQuery::create('u')->where('u.RecoveryToken=?', $token)->findOne();

        if ($user) {
            $C->reset_user = $user;
        } else {
            $C->reset_failed = 1;
        }
    } else if (isset($_POST['RecoveryToken']) && isset($_POST['Passwd'])) {
        $res = Biz_ACL::resetPassword($_POST['RecoveryToken'], $_POST['Passwd']);

        if ($res) {
            $C->error = 0;
        } else {
            $C->error = 1;
            $C->message = "It fails to reset your password";
        }
    }

