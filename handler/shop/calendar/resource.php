<?php

  $sess = $C->session;
  $shop_id = $sess->login_id('shop');

  if ( isset($_GET['id']) && isset($_GET['action']) ) {
    if ($_GET['id'] && $_GET['action'] == 'delete') {
      $resource = CalendarresourceQuery::create()->findPk($_GET['id']);
      if ($resource->getShopId() == $shop_id) {
        $resource->delete();
      }
      $C->error=0;
      $C->message = "A resource and its relelated calendar has been deleted successfully";
      return;
    } else if ($_GET['id']) {
      $resource = CalendarresourceQuery::create()->findPk($_GET['id']);

      // keep the security in mind
      if (!$resource || $resource->getShopId() != $shop_id) {
        $C->error=1;
        $C->message = "Parameter error 87394";
        return;
      }
    } else {
      $resource = new Calendarresource();
    }

    $resource->setName($_GET['Name']);
    $resource->setShopId($shop_id);
    $resource->save();

    $C->error=0;
    $C->Name=$resource->getName();
    $C->message = "Your update has been saved successfully";
    return;
  }

  $C->resources = CalendarresourceQuery::create()->findByShopId($shop_id)->toArray();
