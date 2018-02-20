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
        $parcours = Parcours::select()->with("author")->get();

        return  Writer::json_output($response,200,$parcours);
    }
    
    public function getParcour (Request $request,Response $response,$args)
    {
    	try {
    		$parcour = Parcours::where('id',"=",$args["id"])->with("author")->firstOrFail();
    		$exercices  = $parcour->exercices()->get();
    		$result = ["parcours" => $parcour,'exercices' => $exercices];

    		return Writer::json_output($response,200,$result);
    	} catch (ModelNotFoundException $exception){


         $notFoundHandler = $this->container->get('notFoundHandler');
         return $notFoundHandler($request,$response);
     }


 }
 public function createParcours (Request $request,Response $response) {
    $tab = $request->getParsedBody();
    
    try {
        $parcours = new Parcours();
        $parcours->title = $tab["title"];
        $parcours->author_id = $tab["author_id"] ;
        $parcours->level = $tab["level"] ;
        $parcours->temps =$tab["temps"];
        $parcours->description = $tab["description"];
        $parcours->save();
        return Writer::json_output($response,201,$parcours);
    } catch (Exception $e) {
        return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
    }
}
}