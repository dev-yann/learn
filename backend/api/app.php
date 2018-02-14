<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 10:16
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $container = require_once __DIR__ . '/../src/config/settings.php';

    $app = new Slim\App($container);

    require __DIR__.'/../src/services/connectDb.php';
    require __DIR__.'/../src/services/dependencies.php';
    require __DIR__.'/../src/services/routes.php';

    $app->run();

} catch (RuntimeException $e){
    header('Content-type: application/json');
    header('status: 500');
    echo json_encode(array('error' => 'Internal Server Error'));
} catch (\Exception $e){
    echo $e->getMessage();
}
