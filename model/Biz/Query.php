<?php
    class Biz_Query {

        const GUESS_ROLE_NAME = 'guest';

        // check if a user has access to given path
        public static $ACL_check_login = <<<SQL
            SELECT COUNT(*)
            FROM User u
                JOIN RoleAction ra
                    ON ra.role_id = u.role_id OR ra.role_id IS NULL
                JOIN Action a
                    ON a.id = ra.action_id
            WHERE u.id = :user
                AND a.path = :path
SQL;
        // check if guest has access to given path
        public static $ACL_check_guest = <<<SQL
            SELECT COUNT(*)
            FROM Role r
                JOIN RoleAction ra
                    ON ra.role_id = r.id OR ra.role_id IS NULL
                JOIN Action a
                    ON a.id = ra.action_id
            WHERE r.name = :role
                AND a.path = :path
SQL;
        // check if guest has access to given path
        public static $login = <<<SQL
            SELECT id
            FROM User
            WHERE email = :email AND passwd = PASSWORD(:passwd)
SQL;
        public static $reset_pwd = <<<SQL
            UPDATE User SET
                passwd = PASSWORD(:passwd),
                recovery_token = NULL,
                recovery_sent = NULL
            WHERE recovery_token = :token
SQL;
        }

