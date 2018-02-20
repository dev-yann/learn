<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:12
 */

$app->post("/user[/]","UserController:createUser")->add( new \App\middleware\CheckForm())->setArguments(['username','password']);

$app->get('/user[/]',"UserController:connectUser");

$app->get('/parcours[/]', "ParcoursController:getParcours");
$app->get('/parcours/{id:[0-9]+}[/]', "ParcoursController:getParcour");

$app->post('/parcours/',"ParcoursController:createParcours");
$app->post('/parcours/{id:[0-9]+}/add[/]', "ExerciceController:createExercice");
