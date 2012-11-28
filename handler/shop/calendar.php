<?php

if (isset($_GET['free_slog'])) {
  $update_event = (isset($_GET['event_id']) && $_GET['event_id']) ? $_GET['event_id'] : 0;

  // query free slots for given day
  $stmt = $C->dbh->prepare(Biz_Query::$day_free_slot);
  $stmt->execute(array(
    ':day' => $_GET['free_slog'],
    ':login_user' => $C->session->login_id(),
    ':update_event' => $update_event  // include this event slot
  ));
  $C->slots = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // query event on that given event, typically must be in the day above
  if ( $update_event ) {
    $stmt = $C->dbh->prepare(Biz_Query::$view_calendar_event);
    $stmt->execute(array(
      ':event' => $update_event,
      ':login_user' => $C->session->login_id()
    ));
    $C->viewEvent = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  return;

} else if (isset($_GET['day_calendar'])) {
  $stmt = $C->dbh->prepare(Biz_Query::$day_calendar);
  $stmt->execute(array(
    ':day' => $_GET['day_calendar'],
    ':login_user' => $C->session->login_id()
  ));

  $C->dat_cal = $stmt->fetchAll(PDO::FETCH_ASSOC);
  return;

// delete event
} else if (isset($_GET['delete_event']) && $_GET['delete_event']>0 ) {
  $event = CalendareventQuery::create()->findPk($_GET['delete_event']);
  $belongLogin = CalendarQuery::create('c')
          ->where('c.EventId=?', $_GET['delete_event'])
          ->where('c.UserId=?', $C->session->login_id())
          ->count();
  if (!$event || !$belongLogin) {
    $C->error = 1;
    $C->message = "Parameter error 57688";
  }
  CalendarQuery::create()->findByEventId($event->getId())->delete();
  $event->delete();

  $C->error = 0;
  $C->message = "The calendar event has been delete successfully";
  return;
// update calendar event
} else if (isset($_POST['FromSlot']) && isset($_POST['EventId']) && $_POST['EventId']>0 && $C->acl->matchUrl()) {
  $event = CalendareventQuery::create()->findPk($_POST['EventId']);
  $belongLogin = CalendarQuery::create('c')
          ->where('c.EventId=?', $_POST['EventId'])
          ->where('c.UserId=?', $C->session->login_id())
          ->count();
  if (!$event || !$belongLogin) {
    $C->error = 1;
    $C->message = "Parameter error 78563";
  }
  $event->fromArray($_POST);
  $event->save();
  $startSlotId = (int)$_POST['FromSlot'];
  $endSlotId = (int)$_POST['EndSlot'];
  if (!$endSlotId || !($endSlotId > $startSlotId)) {
    $endSlotId = $startSlotId;
  }
  // delete all existing
  CalendarQuery::create()->findByEventId($event->getId())->delete();
  for($i=$startSlotId; $i<=$endSlotId; $i++) {
    $c = new Calendar();
    $c->fromArray(array(
        'UserId' => $C->session->login_id(),
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
  if (!$endSlotId || !($endSlotId > $startSlotId)) {
    $endSlotId = $startSlotId;
  }
  for($i=$startSlotId; $i<=$endSlotId; $i++) {
    $c = new Calendar();
    $c->fromArray(array(
        'UserId' => $C->session->login_id(),
        'SlotId'  => $i,
        'EventId' => $ce->getId()
    ));
    $c->save();
  }

  $C->error = 0;
  $C->message = "The calendar has been created successfully";
  return;
}
