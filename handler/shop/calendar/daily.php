<?php

if (isset($_GET['d'] ) && preg_match('/\d{4}-\d+-\d+/', $_GET['d'], $match)) {
  $dt = new DateTime($match[0]);
} else {
  $dt = new DateTime("now");
}

$C->day = $dt->format("Y-m-d");
$C->month = $dt->format("m");
$C->year = $dt->format("Y");

$dt->add(DateInterval::createFromDateString ( '-1 day' ));
$C->prevDay = $dt->format("Y-m-d");
$dt->add(DateInterval::createFromDateString ( '2 day' ));
$C->nextDay = $dt->format("Y-m-d");

// query free slots for given day
$stmt = $C->dbh->prepare(Biz_Query::$day_free_slot);
$stmt->execute(array(
  ':day' => $C->day,
  ':shop_id' => $C->session->login_id('shop')
));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// foreach resource
foreach($rows as $row) {
  $lnKey = $row['ResourceID'].":".$row['ResourceName'];
  $line[$lnKey][] = $row;
}

// sub for each event
$slots = array();
foreach(array_values($line) as $raw_slot) {
  $slot = array();
  foreach($raw_slot as $sl) {
    if ($sl['IsFree']) {
      $lnKey = $sl['SlotID'].":SlotID";
      $slot[$lnKey] = $sl;
    } else {
      // all booked slots will be merged for each event
      $lnKey = $sl['EventId'].":EventId";
      if ( isset($slot[$lnKey] ) ) {
        $slot[$lnKey]['NumSlots']++;
      } else {
        $slot[$lnKey] = $sl;
        $slot[$lnKey]['NumSlots'] = 1;
      }
    }
  }
  $slots[] = $slot;
}
$C->slots = $slots;

foreach(array_keys($line) as $id_name) {
  list($id, $name) = explode(":", $id_name, 2);
  $resource_ids[] = $id;
  $resource_names[] = $name;
}
$C->resource_ids = $resource_ids;
$C->resource_names = $resource_names;
