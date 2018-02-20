<?php


namespace App\controllers;
use App\models\Parcours;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ParcoursController extends BaseController
{

    public function getParcours(Request $request, Response $response, $args){

        // REGEX AU NIVEAU DE L'URL, CE NE PEUT ETRE QU'UNE SUITE DE CHIFFRES ( args id )
        $parcours = Parcours::select()->get();
      return  Writer::json_output($response,201,$parcours]);
    }
    
    public function getParcour (Request $request,Response $response,$args)
    {
    	try {
    		$parcour = Parcours::where('id',"=",$args["id"])->firstOrFail();
    		$exercices  = $parcour->exercices()->get();
    		$result = ["parcours" => $parcour,'exercices' => $exercices];

    		return Writer::json_output($response,201,$result);
    	} catch (ModelNotFoundException $exception){


			$notFoundHandler = $this->container->get('notFoundHandler');
			return $notFoundHandler($request,$response);
		}
		
    	
    }
}