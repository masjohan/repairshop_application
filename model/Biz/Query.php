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
    SELECT cr.id AS ResourceID,
      cr.name AS ResourceName,
      cs.id AS SlotID,
      CONCAT(DATE_FORMAT(cs.timeslot, '%l:%i%p')) AS Slot,
      IF(c.id IS NULL, 1, 0) AS IsFree,
      ce.id AS EventId,
      CONCAT(ce.first_name, ' ', ce.last_name) AS EventName,
      ce.phone AS EventPhone,
      ce.Notes AS EventNotes
    FROM CalendarResource cr
    JOIN CalendarSlot cs ON
      cs.timeslot >= DATE_ADD(CAST(:day AS DATETIME), INTERVAL 7 HOUR) -- @todo
      AND cs.timeslot < DATE_ADD(CAST(:day AS DATETIME), INTERVAL 19 HOUR) -- @todo
      AND cs.timeslot >= NOW()
    LEFT JOIN Calendar c
      ON c.resource_id = cr.id
      AND c.slot_id = cs.id
    LEFT JOIN CalendarEvent ce
      ON ce.id = c.event_id
    WHERE cr.shop_id = :shop_id
    ORDER BY cr.id, cs.id
SQL
;

  // given resource and day, get free slots
  public static $day_resource_free_slot = <<<SQL
    SELECT cs.id,
      DATE_FORMAT(cs.timeslot, '%l:%i%p') AS FromSlot,
      DATE_FORMAT(DATE_ADD(cs.timeslot, INTERVAL 30 MINUTE), '%l:%i%p') AS EndSlot
    FROM CalendarSlot cs
    LEFT JOIN Calendar c
      ON c.resource_id = :resource_id
      AND c.slot_id = cs.id
    WHERE cs.timeslot >= NOW()
        AND cs.timeslot >= DATE_ADD(CAST(:day AS DATETIME), INTERVAL 7 HOUR) -- @todo
        AND cs.timeslot < DATE_ADD(CAST(:day AS DATETIME), INTERVAL 19 HOUR) -- @todo
        AND (c.id IS NULL OR event_id = :update_event)
        AND EXISTS(
          SELECT *
          FROM CalendarResource
          WHERE id=:resource_id
            AND shop_id = :shop_id
        )
    ORDER BY cs.id
SQL
;

  // given event, return details
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
      JOIN CalendarResource cr
        ON cr.id = c.resource_id
      WHERE c.event_id = :event
          AND cr.shop_id = :shop_id
      GROUP BY c.event_id
    ) t0
    JOIN CalendarEvent ce
      ON ce.id = t0.event_id
SQL
;

  // given event, return details
  public static $delete_resource_event_calendar = <<<SQL
    DELETE FROM Calendar
    WHERE event_id = :event
      AND resource_id IN (
        SELECT id
        FROM CalendarResource
        WHERE shop_id = :shop_id
      )
SQL
;

}
