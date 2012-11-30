<?php

if (isset($_GET['free_slot'])) {
  $update_event = (isset($_GET['event_id']) && $_GET['event_id']) ? $_GET['event_id'] : 0;
  $resource_id = (isset($_GET['resource_id']) && $_GET['resource_id']) ? $_GET['resource_id'] : 0;

  // query free slots for given day
  $stmt = $C->dbh->prepare(Biz_Query::$day_resource_free_slot);
  $stmt->execute(array(
    ':day' => $_GET['free_slot'],
    ':shop_id' => $C->session->login_id('shop'),
    ':resource_id' => $resource_id,
    ':update_event' => $update_event  // include this event slot
  ));
  $C->slots = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // query event on that given event, typically must be in the day above
  if ( $update_event ) {
    $stmt = $C->dbh->prepare(Biz_Query::$view_calendar_event);
    $stmt->execute(array(
      ':event' => $update_event,
      ':shop_id' => $C->session->login_id('shop'),
    ));
    $C->viewEvent = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  return;

// delete event
} else if (isset($_GET['delete_event']) && $_GET['delete_event']>0 ) {
  $del_event = $_GET['delete_event'];

  $stmt = $C->dbh->prepare(Biz_Query::$delete_resource_event_calendar);
  $stmt->execute(array(
    ':event' => $del_event,
    ':shop_id' => $C->session->login_id('shop'),
  ));

  // event can only be delete when no more calendar reference
  $cal = CalendarQuery::create()->findByEventId($del_event)->count();
  if ($cal === 0) {
    $event = CalendareventQuery::create()->findPk($del_event)->delete();
  }

  $C->error = 0;
  $C->message = "The calendar event has been delete successfully";
  return;
// update calendar event
} else if (isset($_POST['FromSlot']) && isset($_POST['EventId']) && $_POST['EventId']>0 && $C->acl->matchUrl()) {
  $event = CalendareventQuery::create()->findPk($_POST['EventId']);
  $resourceOK = CalendarresourceQuery::create('cr')
          ->where('cr.Id=?', $_POST['ResourceId'])
          ->where('cr.ShopId=?', $C->session->login_id('shop'))
          ->count();
  if (!$event || !$resourceOK) {
    $C->error = 1;
    $C->message = "Parameter error 78563";
  }
  $event->fromArray($_POST);
  $event->save();
  $startSlotId = (int)$_POST['FromSlot'];
  $endSlotId = (int)$_POST['EndSlot'];
  // delete all existing
  CalendarQuery::create()->findByEventId($event->getId())->delete();
  for($i=$startSlotId; $i<=$endSlotId; $i++) {
    $c = new Calendar();
    $c->fromArray(array(
        'ResourceId' => $_POST['ResourceId'],
        'SlotId'  => $i,
        'EventId' => $event->getId()
    ));
    $c->save();
  }

  $C->error = 0;
  $C->message = "The calendar has been updated successfully";
  return;
// new calendar event
} else if (isset($_POST['FromSlot']) && $C->acl->matchUrl()) {

  $ce = new Calendarevent();
  $ce->fromArray($_POST);
  $ce->save();
  $startSlotId = (int)$_POST['FromSlot'];
  $endSlotId = (int)$_POST['EndSlot'];

  for($i=$startSlotId; $i<=$endSlotId; $i++) {
    $c = new Calendar();
    $c->fromArray(array(
        'ResourceId' => $_POST['ResourceId'],
        'SlotId'  => $i,
        'EventId' => $ce->getId()
    ));
    $c->save();
  }

  $C->error = 0;
  $C->message = "The calendar has been created successfully";
  return;
}
