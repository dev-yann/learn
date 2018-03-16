<?php


namespace App\controllers;
use App\models\Parcours;
use App\models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ParcoursController extends BaseController
{

    public function getParcours(Request $request, Response $response, $args){

        // REGEX AU NIVEAU DE L'URL, CE NE PEUT ETRE QU'UNE SUITE DE CHIFFRES ( args id )
        $parcours = Parcours::select()->with("author")->get();


        return  Writer::json_output($response,200,["parcours" => $parcours]);
    }
    
    public function getParcour (Request $request,Response $response,$args)
    {

        /**
         * La requete ne marche pas si un parcours existe mais n'a pas d'exercice
         * Il faut donc rendre obligatoire l'existence d'au moins un exercice
         * pour ajouter un parcours ( a voir du coté backoffice )
         */

    	try {
    		$parcour = Parcours::where('id',$args["id"])->with("author")->firstOrFail();
    		$exercices  = $parcour->exercices()->get();

    		if($request->getAttribute('user')){

                // savoir si l'user est associé au parcours
                $user = $request->getAttribute('user');


                if($user->parcours()->wherePivot('parcours_id','=',$args["id"])->first()){

                    $parcour->subscribe = true;

                }
            }

            $result = ["parcours" => $parcour,'exercices' => $exercices];
            return Writer::json_output($response,200,$result);

    	} catch (ModelNotFoundException $exception){
         $notFoundHandler = $this->container->get('notFoundHandler');
         return $notFoundHandler($request,$response);
     }
 }

 public function editParcours(Request $request,Response $response,$args) {
    $tab = $request->getParsedBody();
    try {
        $parcour = Parcours::where('id',$args["id"])->firstOrFail();
        $parcour->description = $tab["description"];
        $parcour->temps = $tab["temps"];
        $parcour->title = $tab["title"];
        $parcour->level = $tab["level"];
        $parcour->save();

        return Writer::json_output($response,200,$parcour);
    } catch (ModelNotFoundException $exception){


     $notFoundHandler = $this->container->get('notFoundHandler');
     return $notFoundHandler($request,$response);
 }

}
public function deleteParcours (Request $request,Response $response,$args) {
    try {
        $parcours = Parcours::findOrFail($args['id']);
        $parcours->delete();
        return Writer::json_output($response, 204);
    } catch (ModelNotFoundException $e) {
        $notFoundHandler = $this->container->get('notFoundHandler');
        return $notFoundHandler($request,$response);
    }
}
public function createParcours (Request $request,Response $response) {
    $tab = $request->getParsedBody();


    /**
     * etant donné que la bdd n'est pas construite avec des valeurs par défault,
     * si un champs est envoyé vide cela provoquera une erreur
     */
    try {
        $parcours = new Parcours();

        $parcours->title = filter_var($tab["title"],FILTER_SANITIZE_SPECIAL_CHARS);
        $parcours->author_id = filter_var( $tab["author_id"],FILTER_SANITIZE_NUMBER_INT) ;
        $parcours->level = filter_var($tab["level"],FILTER_SANITIZE_NUMBER_INT) ;
        $parcours->temps = filter_var($tab["temps"], FILTER_SANITIZE_NUMBER_INT);
        $parcours->description = filter_var($tab["description"], FILTER_SANITIZE_SPECIAL_CHARS);
        $parcours->save();

        unset($parcours->author_id);
        return Writer::json_output($response,201,$parcours);

    } catch (\Exception $e) {
        return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => "Bad request: empty or bad type"]);
    }
}

    public function getPostsOfParcours (Request $request,Response $response, $args) {


        try {

            $parcours = Parcours::where('id',$args['id'])->with('users','posts')->get();

            // Renvoie le parcours avec les users et posts associées
            return Writer::json_output($response,201, ['parcours' => $parcours]);

        } catch (ModelNotFoundException $exception){

           // $notFoundHandler = $this->container->get('notFoundHandler');
            //return $notFoundHandler($request,$response);
            return Writer::json_output($response,500, ['not found']);
        } catch (\Exception $e) {
            return Writer::json_output($response,500, $e->getMessage());

        }
    }
}