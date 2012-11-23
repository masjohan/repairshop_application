<?php
  if ( preg_match('/^[0-9A-Z]{6}$/', $_SERVER['QUERY_STRING']) ) {
    $C->dispatch('/common/forget');
  }
