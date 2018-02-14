<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 09:56
 */

return [
    'settings' => [
        // Slim Settings
        'displayErrorDetails' => true,
        'production' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'learn',
            'username' => 'admin',
            'password' => 'admin',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]
    ]
];

