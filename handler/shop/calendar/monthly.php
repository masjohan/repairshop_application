<?php

// NOW
$dtNow = new DateTime("now");
$C->now_year = $dtNow->format("Y");
$C->now_month = $dtNow->format("n");
$C->now_day = $dtNow->format("j");

// The date we are going to deal with
if (isset($_GET['y'] ) && isset($_GET['m'])) {
  $dt = new DateTime($_GET['y']."-".$_GET['m']."-01");
} else {
  $dt = new DateTime($C->now_year."-".$C->now_month."-01");
}

$C->title_month = $dt->format("F Y");
$C->year = $dt->format("Y");
$C->month = $dt->format("n");
$C->day = $dt->format("j");

if ($dt > $dtNow) {
  $C->from_now_month = 1;
} else if ($C->year==$C->now_year && $C->month == $C->now_month) {
  $C->from_now_month = 0;
} else {
  $C->from_now_month = -1;
}

$dtMonthFirst = new DateTime($C->year."-".$C->month."-01");
$C->month_first_wkday = $dtMonthFirst->format("N");

$dtMonthFirst->add(DateInterval::createFromDateString ( '+1 month' ))->add(DateInterval::createFromDateString ( '-1 day' ));
$C->month_num_days = $dtMonthFirst->format("j");
$C->month_week_span = (int)ceil(($C->month_first_wkday % 7 + $dtMonthFirst->format("j")) / 7);
$C->month_last_wkday = $dtMonthFirst->format("N");


$dt->add(DateInterval::createFromDateString ( '+1 month' ));
$C->next_month = $dt->format("n");
$C->next_year = $dt->format("Y");

$dt->add(DateInterval::createFromDateString ( '-2 month' ));
$C->prev_month = $dt->format("n");
$C->prev_year = $dt->format("Y");


// query free slots for this month
$stmt = $C->dbh->prepare(Biz_Query::$month_calendar);
$stmt->execute(array(
  ':day' => $C->year."-".$C->month."-01",
  ':shop_id' => $C->session->login_id('shop')
));

$month_calendar = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $month_calendar[$row['EachDay']][$row['Section']] = $row['NumBooking'];
}
 $C->month_calendar = $month_calendar;
