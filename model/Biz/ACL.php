<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Biz_ACL {

    public static function check($action) {
        $C = Controller::getInstance();
        $sess = $C->param('session');
        $dbh = $C->param('dbh');

        if ($sess->is_login()) {
            $stmt = $dbh->prepare(Biz_Query::$ACL_check_login);
            $stmt->execute(array(
                ':user' => $sess->data('user_id'),
                ':path' => $action
            ));
        } else {
            $stmt = $dbh->prepare(Biz_Query::$ACL_check_guest);
            $stmt->execute(array(
                ':role' => Biz_Query::GUESS_ROLE_NAME,
                ':path' => $action
            ));
        }
        list(list($cnt)) = $stmt->fetchAll(PDO::FETCH_NUM);

        // acl usually is mean. Just do redirect
        if ( !$cnt ) {
            if (!$sess->is_login()) {
                $sess->data('redirect', $action);
                $sess->putNext(array(
                    'messager'=>array(
                        'txt' => 'To proceed, please first login!',
                        'cls' => 'alert'
                    )
                ));
                header("Location: /", TRUE, 307);
            } else {
                $sess->putNext(array('messager'=>array(
                    'txt' => 'It seems you are not supposed to view that page',
                    'cls' => 'error'
                )));
                $to = $_SERVER["HTTP_REFERER"] ? $_SERVER["HTTP_REFERER"] : '/';
                header("Location: $to", TRUE, 307);
            }
            exit;
        }

        $C->action = ActionQuery::create('a')->where('a.Path=?', $action)->findOne()->toArray();
        if ($sess->is_login()) {
            $C->login_user = UserQuery::create('u')->findPk($sess->data('user_id'))->toArray();
        }
        return (boolean)$cnt;
    }

    public static function comein($user_id) {
        $C = Controller::getInstance();

        // make the user login
        $sess = $C->param('session');
        $sess->login($user_id);

        $action = $sess->data('redirect');
        if ($action) {
            $sess->data('redirect', NULL, TRUE);
        } else {
            $action = "";
        }

        header("Location: /$action", TRUE, 307);
        exit;
    }

    public static function resetPassword($token, $passwd) {
        $dbh = Controller::getInstance()->param('dbh');

        $stmt = $dbh->prepare(Biz_Query::$reset_pwd);
        $stmt->execute(array(
            ':token' => $token,
            ':passwd' => $passwd
        ));
        return (boolean)$stmt->rowCount();
    }
}

