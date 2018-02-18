<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:23
 */

$container = $app->getContainer();

$container['UserController'] = function ($c){
    return new \App\controllers\UserController($c);
};
$container['CoursesController'] = function ($c){
    return new \App\controllers\CoursesController($c);
};
$container['ExerciceController'] = function ($c){
    return new \App\controllers\ExerciceController($c);
};