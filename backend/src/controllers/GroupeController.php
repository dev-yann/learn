<?php

namespace App\controllers;
use App\models\Groupe;
use App\models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class GroupeController extends BaseController
{

	public function getGroupes (Request $request,Response $response) {
		$groupes = Groupe::select()->with("users")->get();
		return Writer::json_output($response,200,$groupes);
	}
	public function getGroupe (Request $request,Response $response, $args) {
		try {
			$groupe = Groupe::where("id","=",$args["id"])->with("users")->firstOrFail();
			return Writer::json_output($response,200,$groupe);
		} catch (ModelNotFoundException $exception){
			$notFoundHandler = $this->container->get('notFoundHandler');
			return $notFoundHandler($request,$response);
		}
	}
	public function createGroupe(Request $request,Response $response) {
		$tab = $request->getParsedBody();
		$groupe = new Groupe();
		try {
			$groupe->name = $tab["name"];
			$groupe->user_id = $tab["user_id"];
			$groupe->save();
			return Writer::json_output($response,201,$groupe);
		} catch (Exception $e) {
			return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
		}



	}
	public function addUserInGroupe (Request $request,Response $response,$args) {
		$tab = $request->getParsedBody();
		try {
			$groupe = Groupe::where("id","=",$args["id"])->firstOrFail();
			$user = User::where("username","=",$tab["username"])->firstOrFail();
			$user->groupes()->attach($args["id"]);
			
			$user->save();
			return Writer::json_output($response,200,$user);
		} catch (Exception $e) {
			return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
		}



	}
}
