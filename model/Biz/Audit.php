<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Audit
 *
 * @author tao
 */
class Audit {
    public static function addSessionUser(BaseObject $model) {
        $sess = TW_Session::getInstance();
        if ($sess->is_login()) {

        } else {
            $role = RoleQuery::create()->findOneBy('Name', 'Guess');
            
        }
    }
}


