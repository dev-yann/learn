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
$container['SandboxController'] = function ($c){
    return new \App\controllers\SandboxController($c);
};
$container['CheckJwt'] = function () {
    return new \App\middleware\CheckJwt();
};
$container['CheckForm'] = function (){
    return new \App\middleware\CheckForm();
};
$container['CheckSubscribe'] = function (){
    return new \App\middleware\CheckSubscribe();
};

$container['GetUser'] = function () {
    return new \App\middleware\GetUser();
};