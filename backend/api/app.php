<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 10:16
 */
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
session_start();
try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $container = require_once __DIR__ . '/../src/config/settings.php';

    $app = new Slim\App($container);

    // Fichier d'upload dans le container
    $container = $app->getContainer();
    $container['upload_directory'] = __DIR__ . '/../uploads';

    
    $app->add(function($request, $response, callable $next){
        $response = $response->withHeader('Content-type', 'application/json; charset=utf-8');
        $response = $response->withHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Methods', 'OPTION, GET, POST, PUT, PATCH, DELETE');
        return $next($request, $response);
    });
    require __DIR__.'/../src/services/dependencies.php';
    require __DIR__.'/../src/services/connectDb.php';
    require __DIR__.'/../src/services/routes.php';

    $app->run();

} catch (RuntimeException $e){
    header('Content-type: application/json');
    header('status: 500');
    echo json_encode(array('error' => 'Internal Server Error'));
} catch (\Exception $e){
    echo $e->getMessage();
}
