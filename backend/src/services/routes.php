<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:12
 */

$app->post("/user[/]","UserController:createUser")->add( new \App\middleware\CheckForm())->setArguments(['username','password']);

$app->get('/user[/]',"UserController:connectUser");

$app->get('/courses[/]', "CoursesController:getCourses");

$app->get('/courses/{id:[0-9]+}/exercices', "ExerciceController:getExercices");

