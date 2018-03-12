<?php

namespace App\controllers;
use App\models\Exercices;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;

class ExerciceController extends BaseController
{

    public function getExercices(Request $request, Response $response, $args){

        // REGEX AU NIVEAU DE L'URL, CE NE PEUT ETRE QU'UNE SUITE DE CHIFFRES ( args id )
        $exercices = Exercices::where('parcours_id',$args['id'])->get();
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

    /*    $tab = $request->getParsedBody();
    
    try {
        $exercice = new Exercices();
        $exercice->title = $tab["title"];
        $exercice->parcours_id = $args["id"];
        $exercice->description = $tab["description"];
        $exercice->save();
        return Writer::json_output($response,201,$exercice);
    } catch (\Exception $e) {
        return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
    }*/





        $directory = $this->container['upload_directory'];


        // mes fichiers uplaoder
        $uploadFile = $request->getUploadedFiles();

        // on s'occupe du php

        $myUploadPhp = $uploadFile['file'];

        try{

            if($myUploadPhp->getError() === UPLOAD_ERR_OK){

                try{
                    $filename = UploadedFile::moveUploadedFile($directory,$myUploadPhp);

                    return Writer::json_output($response,201,['SUCCESS UPLOAD' => $filename]);

                } catch (\Exception $e) {

                    return Writer::json_output($response,201,[$e->getMessage()]);
                }

            }

        } catch (\Exception $e) {

            return Writer::json_output($response,201,['if marche pas']);

        }




        // a voir si mettre des verifs

/*
           // création de l'objet finfo
           $infos = new finfo(FILEINFO_MIME);
           //récupération des infos du fichier
           $type = $infos->file($myUploadPhp);
           //extraction du type MIME
           $mime = substr($type, 0, strpos($type, ';'));
           if($mime === 'text/plain'){ // c'est un PDF



           }else{

               return Writer::json_output($response,201,['if marche pas']);
           }
           */

       }


    public function deleteExercice (Request $request,Response $response,$args) {
            try {
                $exercice = Exercice::findOrFail($args['id']);
                $exercice->delete();
                return Writer::json_output($response, 204);
            } catch (ModelNotFoundException $e) {
                $notFoundHandler = $this->container->get('notFoundHandler');
                return $notFoundHandler($request,$response);
            }
    }

public function editExercice (Request $request,Response $response,$args) {
    $tab = $request->getParsedBody();
    try {
        $exercice = Exercices::where("id",$args["id"])->firstOrFail();
        $exercice->description = $tab["description"];
        $exercice->title = $tab["title"];
        $exercice->save();
        return Writer::json_output($response,200,$exercice);
    } catch (ModelNotFoundException $exception){

        $notFoundHandler = $this->container->get('notFoundHandler');
        return $notFoundHandler($request,$response);
    }
}
}