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

  public static $all_customer_user = <<<SQL
    SELECT u.id AS Id,
        u.username AS Username,
        u.email AS Email,
        u.recovery_token AS RecoveryToken,
        CONCAT(u.first_name, ' ', u.last_name) AS FullName,
        u.Phone AS Phone,
        s.name AS Shop,
        (u.passwd IS NOT NULL AND u.recovery_token IS NULL) AS IsActive
    FROM Role r
      JOIN User u ON r.id = u.role_id
      JOIN Customer c ON c.id = u.role_type_id
      JOIN Shop s ON s.id = c.shop_id
    WHERE r.type = 'Customer'
SQL;

  public static $all_shop_customer = <<<SQL
    SELECT u.id AS Id,
        u.username AS Username,
        u.email AS Email,
        u.recovery_token AS RecoveryToken,
        (u.passwd IS NOT NULL AND u.recovery_token IS NULL) AS IsActive,
        CONCAT(u.first_name, ' ', u.last_name) AS FullName,
        u.Phone AS Phone
    FROM Role r
      JOIN User u ON r.id = u.role_id
      JOIN Customer c ON c.id = u.role_type_id
    WHERE r.type = 'Customer'
      AND c.shop_id = :shop
SQL;

  public static $all_shop_vehicle = <<<SQL
    SELECT v.id AS Id,
        CONCAT(v.year,'/',v.make,'/',v.model,'/',v.submodel) AS YMMS,
        CONCAT(u.first_name, ' ', u.last_name) AS Customer,
        u.email AS Email,
        u.Phone AS Phone
    FROM Customer c
      JOIN Vehicle v ON v.customer_id = c.id
      JOIN User u ON u.role_type_id=c.id
      JOIN Role r ON r.id = u.role_id
    WHERE c.shop_id = :shop
      AND r.type = 'Customer'
SQL;

  public static $all_customer_vehicle = <<<SQL
    SELECT v.id AS Id,
        CONCAT(v.year,'/',v.make,'/',v.model,'/',v.submodel) AS YMMS,
        CONCAT(u.first_name, ' ', u.last_name) AS Customer,
        u.email AS Email,
        u.Phone AS Phone
    FROM Customer c
      JOIN Vehicle v ON v.customer_id = c.id
      JOIN User u ON u.role_type_id=c.id
      JOIN Role r ON r.id = u.role_id
    WHERE c.id = :customer
      AND r.type = 'Customer'
SQL
;

  public static $all_login_type = <<<SQL
    SELECT
      r.`type` AS LoginUserType,
      IF(r.`type`='Customer', c.id, NULL) AS LoginUserCustomerId,
      IF(r.`type`='Shop', s.id, NULL) AS LoginUserShopId,
      IF(r.`type`='Market', m.id, NULL) AS LoginUserMarketId
    FROM `User` u
    JOIN `Role` r ON r.id = u.role_id
    LEFT JOIN Customer c ON c.id = u.role_type_id
    LEFT JOIN Shop s ON s.id = u.role_type_id
    LEFT JOIN Market m ON m.id = u.role_type_id
    WHERE u.id = :user_id
SQL
;

  public static $day_free_slot = <<<SQL
    SELECT cs.id, CONCAT(DATE_FORMAT(cs.timeslot, '%l:%i%p'),'~',DATE_FORMAT(DATE_ADD(cs.timeslot, INTERVAL 30 MINUTE), '%l:%i%p')) AS slot
    FROM CalendarSlot cs
    LEFT JOIN Calendar c
      ON c.user_id = :login_user
      AND c.slot_id = cs.id
    WHERE cs.timeslot >= NOW()
        AND cs.timeslot >= DATE_ADD(CAST(:day AS DATETIME), INTERVAL 7 HOUR) -- @todo
        AND cs.timeslot < DATE_ADD(CAST(:day AS DATETIME), INTERVAL 19 HOUR) -- @todo
        AND (c.id IS NULL OR event_id = :update_event)
    ORDER BY id
SQL
;
  public static $day_calendar = <<<SQL
    SELECT t0.StartSlot, t0.EndSlot, ce.first_name AS FirstName, ce.last_name AS LastName, ce.phone AS Phone, t0.NumSlots, ce.id AS Id
    FROM (
      SELECT c.event_id, COUNT(*) AS NumSlots, MIN(c.slot_id) AS ord,
        DATE_FORMAT(MIN(cs.timeslot), '%l:%i%p') AS StartSlot,
        DATE_FORMAT(DATE_ADD(MAX(cs.timeslot), INTERVAL 30 MINUTE), '%l:%i %p') AS EndSlot
      FROM CalendarSlot cs
      JOIN Calendar c
        ON c.user_id = :login_user
        AND c.slot_id = cs.id
      WHERE cs.timeslot >= CAST(:day AS DATETIME)
          AND cs.timeslot < DATE_ADD(CAST(:day AS DATETIME), INTERVAL 1 DAY)
      GROUP BY c.event_id
    ) t0
    JOIN CalendarEvent ce
      ON ce.id = t0.event_id
    ORDER BY t0.ord
SQL
;

  public static $view_calendar_event = <<<SQL
    SELECT t0.StartSlot, t0.EndSlot, t0.NumSlots,
      ce.first_name AS FirstName, ce.last_name AS LastName, ce.phone AS Phone,ce.notes AS Notes,
      ce.id AS Id
    FROM (
      SELECT c.event_id,
        MIN(c.slot_id) AS StartSlot,
        MAX(c.slot_id) AS EndSlot,
        COUNT(*) AS NumSlots
      FROM Calendar c
      WHERE c.user_id = :login_user
        AND c.event_id = :event
      GROUP BY c.user_id, c.event_id
    ) t0
    JOIN CalendarEvent ce
      ON ce.id = t0.event_id
SQL
;

}
