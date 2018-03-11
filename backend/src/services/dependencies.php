<?php


$container = $app->getContainer();

$container['UserController'] = function ($c){
    return new \App\controllers\UserController($c);
};
$container['ExerciceController'] = function ($c){
    return new \App\controllers\ExerciceController($c);
};
$container['GroupeController'] = function ($c){
    return new \App\controllers\GroupeController($c);
};
$container['ParcoursController'] = function ($c){
    return new \App\controllers\ParcoursController($c);
};
