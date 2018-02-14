<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 19:15
 */
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'learn',
        'database' => 'learn',
        'username' => 'admin',
        'password' => 'admin',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'learn_'
]);

$capsule->setAsGlobal();

$capsule->bootEloquent();