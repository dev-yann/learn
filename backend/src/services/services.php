<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 10:11
 */

$container = $app->getContainer();

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

