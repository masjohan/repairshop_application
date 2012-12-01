<?php

// NOW
$dtNow = new DateTime("now");
$C->now_year = $dtNow->format("Y");
$C->now_month = $dtNow->format("n");

// The date we are going to deal with
if (isset($_GET['y'] ) && isset($_GET['m'])) {
  $dt = new DateTime($_GET['y']."-".$_GET['m']."-01");
} else {
  $dt = new DateTime("now");
}

$C->title_month = $dt->format("F Y");
$C->month = $dt->format("n");
$C->year = $dt->format("Y");

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
