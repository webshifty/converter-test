<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'sql11.freemysqlhosting.net',
    'database' => 'sql11437529',
    'username' => 'sql11437529',
    'password' => 'N7JLxbwDUy',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$capsule->setAsGlobal();