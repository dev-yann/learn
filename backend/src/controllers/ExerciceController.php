<?php

namespace App\controllers;
use App\models\Exercices;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ExerciceController extends BaseController
{

    public function getExercices(Request $request, Response $response, $args){

        // REGEX AU NIVEAU DE L'URL, CE NE PEUT ETRE QU'UNE SUITE DE CHIFFRES ( args id )
        $exercices = Exercices::where('parcours_id','=',$args['id'])->get();
      return  Writer::json_output($response,201,['exercices' => $exercices]);
    }

    public function getExercice (Request $request,Response $response,$args)
    {
    	try {
    		$exercice = Exercices::where('id',"=",$args["id"])->firstOrFail();
    		$parcours=$exercice->parcours()->first();
    		$result = ["exercice" => $exercice,'parcours' => $parcours];

    		return Writer::json_output($response,201,$result);
    	} catch (ModelNotFoundException $exception){


			$notFoundHandler = $this->container->get('notFoundHandler');
			return $notFoundHandler($request,$response);
		}
		
    	
    }

 public function createExercice (Request $request,Response $response,$args) {
    $tab = $request->getParsedBody();
    
    try {
        $exercice = new Exercices();
        $exercice->title = $tab["title"];
        $exercice->parcours_id = $args["id"];
        $exercice->enonce = $tab["enonce"];
        $exercice->save();
        return Writer::json_output($response,201,$exercice);
    } catch (Exception $e) {
        return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
    }
}
}