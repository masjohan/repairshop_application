<?php
  $C->param('session')->logOut();
  header("Location: /", TRUE, 307);
  exit;
