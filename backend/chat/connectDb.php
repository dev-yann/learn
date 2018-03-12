<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/03/2018
 * Time: 21:58
 */

use Illuminate\Database\Capsule\Manager as Capsule;


// Test database connection
/*try {*/

    $capsule = new Capsule;

    // Ici la connection se fais sur un conteneur docker mysql qui ecoute sur le port 3603
    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => 'api.learn',
        'database' => 'learn',
        'username' => 'admin',
        'password' => 'admin',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => 'learn_',
        'port'      => env('DB_PORT', 3603)
    ]);

    $capsule->setAsGlobal();

    $capsule->bootEloquent();

    // Pour débuguer
    // $capsule->connection()->getPdo();

/*} catch (\Exception $e) {

    die("Could not connect to the database.  Please check your configuration.");

}*/
