<?php
  $sess = $C->session;
  if ( isset($_GET['id']) && isset($_GET['action']) ) {
   $stmt = $C->dbh->prepare(Biz_Query::$pk_setting_override);
   $stmt->execute(array(
     ':login_id' => $C->session->login_id(),
     ':setting_id' => $_GET['id']
   ));
   list($setting) = $stmt->fetchAll(PDO::FETCH_ASSOC);
   // seems hacking
   if (!$setting) {
     $C->error = 1;
     $C->message = "Abnormal error 03845";
     return;
   }

   $key = $setting['Name'];
   $val = $_GET[$key];

   // when no value or same as system
   if ($val == $setting['SysVal'] || $val == '') {
     if ($setting['Id']) {
       SettingoverrideQuery::create()->findPk($setting['Id'])->delete();
     }
     $C->error = 0;
     $C->$key = '';
     $C->message = "Restore to default value";
     return;
   }

   // no change as custom value
   if ($val == $setting['UsrVal']) {
     $C->error = 1;
     $C->message = "No change has been made";
     return;
   }

   // validation
   if (!preg_match($setting['UsrValidator'], $val)) {
     $C->error = 1;
     $C->message = "Incorrect format. See description";
     return;
   }

   if ($setting['Id']) {
     $so = SettingoverrideQuery::create()->findPk($setting['Id']);
   } else {
     $so = new Settingoverride();
   }

   $so->fromArray(array(
       'SettingId' => $setting['SettingId'],
       'RoleTypeId' => $setting['RoleTypeId'],
       'Value' => $val,
   ));
   $so->save();

   $C->message = "Your update has been saved successfully";
   $C->error = 0;
   $C->$key = $so->getValue();
   return;
 }

  // query free slots for given day
  $stmt = $C->dbh->prepare(Biz_Query::$all_setting_override);
  $stmt->execute(array(
    ':login_id' => $C->session->login_id(),
  ));
  $C->setting = $stmt->fetchAll(PDO::FETCH_ASSOC);