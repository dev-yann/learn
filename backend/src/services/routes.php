<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:12
 */

/**
 * pour bien controler les abus de connection entre
 * la partie user et prof, l'api devrait controler le nom de domaine expediteur de la requete
 */
$app->post("/adduser[/]","UserController:createUser");
$app->post("/addAuthor[/]","UserController:createAuthor");
$app->post('/user[/]',"UserController:connectUser");

$app->post('/author[/]',"UserController:connectAuthor");

$app->get('/parcours[/]', "ParcoursController:getParcours");
// Parcours avec la liste des exercices
$app->get('/parcours/{id:[0-9]+}[/]', "ParcoursController:getParcour")->add('GetUser');
$app->get('/parcours/{id: [0-9]+}/posts', "ParcoursController:getPostsOfParcours");




// on va couper en deux la création d'exercice

// une route pour les test unitaires
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


$app->post('/sandbox',"SandboxController:execute");

$app->get('/user-forum[/]',"UserController:getForumUser");

$app->get('/forum/subject/{id:[0-9]+}[/]',"ForumController:getSubject");
$app->get('/forum/subject/{id:[0-9]+}/response', "ForumController:getResponse");
$app->post('/parcours/{id}/exercice/{ide}/verify',"SandboxController:verify");

/**
 * ATTENTION, ON AJOUTE CONNECT DEVANT TOUTES LES ROUTES ICI
 */

$app->group('/connect',function () {

	$this->post('/subscribe[/]', "UserController:subscribeParcoursUser");
	$this->get('/parcours/{id:[0-9]+}/exercice/{ide: [0-9]+}', "ExerciceController:getExercice");
	$this->get('/parcours/{id:[0-9]+}[/]', "ParcoursController:getParcour");
	$this->post('/parcours/{id:[0-9]+}/exercice/{ide: [0-9]+}', "ExerciceController:testExercice" )->add('CheckSubscribe');
	$this->get('/dashboard', "UserController:getDashboard");
	$this->get('/author_parcours', "ParcoursController:getAuthorParcours");
	$this->post('/parcours[/]',"ParcoursController:createParcours");
	$this->post('/author_forum[/]', "UserController:addForum");
	$this->get('/forum', "UserController:getForum");
	$this->post('/add_subject[/]',"ForumController:addSubject");
	$this->post('/subject/add_response', "ForumController:addResponse");
	$this->patch('/parcours/{id:[0-9]+}/edit[/]', "ParcoursController:editParcours");
	$this->delete('/parcours/{id:[0-9]+}/delete[/]', "ParcoursController:deleteParcours");

	$this->post('/validate[/]','SandboxController:validate');
	$this->post('/parcours/{id:[0-9]+}/add[/]', "ExerciceController:createExercice");

})->add('CheckJwt');
