<?php
// This file generated by Propel 1.6.0 convert-conf target
// from XML runtime conf file /var/www/repairshop.com/application/model/propel/runtime-conf.xml
$conf = array (
  'datasources' => 
  array (
    'repairshop' => 
    array (
      'adapter' => 'mysql',
      'connection' => 
      array (
        'dsn' => 'mysql:host=localhost;dbname=repairshop',
        'user' => 'repairshop',
        'password' => '1qazXSW@',
      ),
    ),
    'default' => 'repairshop',
  ),
  'log' => 
  array (
    'type' => 'file',
    'name' => '/tmp/propel.log',
    'ident' => 'propel-repairshop',
    'level' => '7',
  ),
  'generator_version' => '1.6.0',
);
$conf['classmap'] = include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classmap-repairshop-conf.php');
return $conf;