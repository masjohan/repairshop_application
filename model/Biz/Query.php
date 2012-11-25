<?php
class Biz_Query {

  const GUESS_ROLE_NAME = 'guest';
  const OWNER_ROLE_ID = 3;
  const CUSTOMER_ROLE_ID = 7;

  // check if a user has access to given path
  public static $ACL_check_login = <<<SQL
    SELECT COUNT(*)
    FROM User u
    JOIN RoleAction ra
      ON ra.role_id = u.role_id
        OR ra.role_id IS NULL
        OR (ra.role_id < 0 AND CAST(-1 * ra.role_id AS UNSIGNED) != u.role_id)
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
      ON ra.role_id = r.id
        OR ra.role_id IS NULL
        OR (ra.role_id < 0 AND CAST(-1 * ra.role_id AS UNSIGNED) != r.id)
    JOIN Action a
      ON a.id = ra.action_id
    WHERE r.name = 'guest'
      AND a.path = :path
SQL;

  public static $ACL_rightActions_login = <<<SQL
    SELECT ac.name AS category, a.path, a.name
    FROM User u
    JOIN RoleAction ra
      ON ra.role_id = u.role_id
        OR ra.role_id IS NULL
        OR (ra.role_id < 0 AND CAST(-1 * ra.role_id AS UNSIGNED) != u.role_id)
    JOIN Action a
      ON a.id = ra.action_id
    JOIN ActionCategory ac
      ON ac.id = a.action_category_id
    WHERE u.id = :user
    ORDER BY ac.nice_level DESC, a.id
SQL;

  public static $ACL_rightActions_guest = <<<SQL
    SELECT ac.name AS category, a.path, a.name
    FROM Role r
    JOIN RoleAction ra
      ON ra.role_id = r.id
        OR ra.role_id IS NULL
        OR (ra.role_id < 0 AND CAST(-1 * ra.role_id AS UNSIGNED) != r.id)
    JOIN Action a
      ON a.id = ra.action_id
    JOIN ActionCategory ac
      ON ac.id = a.action_category_id
    WHERE r.name = 'guest'
    ORDER BY ac.nice_level DESC, a.id
SQL;

  // check if guest has access to given path
  public static $login = <<<SQL
    SELECT id
    FROM User
    WHERE (email = :email OR username = :email) AND passwd = PASSWORD(:passwd)
SQL;

  public static $reset_pwd = <<<SQL
    UPDATE User SET
      passwd = PASSWORD(:passwd),
      recovery_token = NULL,
      recovery_sent = NULL
    WHERE recovery_token = :token
SQL;
  public static $set_pwd = <<<SQL
    UPDATE User SET
      passwd = PASSWORD(:passwd)
    WHERE id = :id
SQL;

  public static $all_shop_user = <<<SQL
    SELECT u.id AS Id,
        u.username AS Username,
        u.recovery_token AS RecoveryToken,
        u.email AS Email,
        r.name AS Role,
        s.name AS Shop,
        (u.passwd IS NOT NULL AND u.recovery_token IS NULL) AS IsActive
    FROM Role r
      JOIN User u ON r.id = u.role_id
      JOIN Shop s ON s.id = u.role_type_id
    WHERE r.type = 'Shop'
SQL;

}

