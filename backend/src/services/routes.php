<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:12
 */


$app->post("/adduser[/]","UserController:createUser");
$app->post('/user[/]',"UserController:connectUser");
$app->get('/parcours[/]', "ParcoursController:getParcours");
// Parcours avec la liste des exercices
$app->get('/parcours/{id:[0-9]+}[/]', "ParcoursController:getParcour")->add('GetUser');
$app->get('/parcours/{id: [0-9]+}/posts', "ParcoursController:getPostsOfParcours");
$app->patch('/parcours/{id:[0-9]+}/edit[/]', "ParcoursController:editParcours");
$app->delete('/parcours/{id:[0-9]+}/delete[/]', "ParcoursController:deleteParcours");

$app->post('/parcours[/]',"ParcoursController:createParcours");

// on va couper en deux la création d'exercice

// une route pour les test unitaire
$app->post('/parcours/{id:[0-9]+}/add[/]', "ExerciceController:createExercice");
// une route pour les fill in the blank
$app->post('/parcours/{id:[0-9]+}/add/fill', "ExerciceController:createExerciceFill")->add("CheckForm")->setArgument('fields',["title","description","codeTrue","codeFalse"]);


$app->get('/groupes[/]',"GroupeController:getGroupes");
$app->post('/groupes[/]',"GroupeController:createGroupe");
$app->get('/groupes/{id:[0-9]+}[/]',"GroupeController:getGroupe");
$app->post('/groupes/{id:[0-9]+}/add[/]',"GroupeController:addUserInGroupe");
$app->patch('/groupes/{id:[0-9]+}/edit[/]',"GroupeController:editGroupe");
$app->delete('/groupes/{id:[0-9]+}/delete[/]',"GroupeController:deleteGroupe");

$app->delete('/exercices/{id:[0-9]+}/delete[/]',"ExerciceController:deleteExercice");
$app->patch('/exercices/{id:[0-9]+}/edit[/]',"ExerciceController:editExercice");

$app->post('/sandbox',"SandboxController:Execute");


/**
 * ATTENTION, ON AJOUTE CONNECT DEVANT TOUTES LES ROUTES ICI
 */

$app->group('/connect',function () {

    $this->post('/subscribe[/]', "UserController:subscribeParcoursUser");
    $this->get('/parcours/{id:[0-9]+}/exercice/{ide: [0-9]+}', "ExerciceController:getExercice");
    $this->post('/parcours/{id:[0-9]+}/exercice/{ide: [0-9]+}', "ExerciceController:testExercice" )->add('CheckSubscribe');

})->add('CheckJwt');
