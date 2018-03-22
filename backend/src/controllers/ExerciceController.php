<?php

namespace App\controllers;
use App\models\Exercices;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;
use App\models\Fill;

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

            $exercice = Exercices::where('id',"=",$args["ide"])->firstOrFail();
            // si l'exercice est de type FillIn
            if($exercice->fillinType == 1){

                try{

                    $myFill = $exercice->fillin()->firstOrFail();
                    unset($myFill->codeTrue);
                    unset($myFill->exercices_id);
                    unset($exercice->fillin);
                    $exercice->myFill = $myFill;
                    return Writer::json_output($response,201,["exercice" => $exercice]);


                } catch (ModelNotFoundException $e){

                    $notFoundHandler = $this->container->get('notFoundHandler');
                    return $notFoundHandler($request,$response);
                }
            }


    		return Writer::json_output($response,201,["exercice" => $exercice]);

    	} catch (ModelNotFoundException $exception){

           $notFoundHandler = $this->container->get('notFoundHandler');
           return $notFoundHandler($request,$response);
       }
   }

   public function createExercice (Request $request,Response $response,$args) {


        $params = $request->getParsedBody();


        if($params['type'] == 'fill'){

            try {

                $exercice = new Exercices();
                $exercice->title = $params["title"];
                $exercice->parcours_id = $args["id"];
                $exercice->description = $params["description"];
                $exercice->fillin = true;
                $exercice->save();

                $fillEntity = new Fill();
                $fillEntity->codeTrue = str_replace(' ','', $params['codeTrue']);

                $withoutSpace = trim($params['codeFalse']);
                $withoutBlank = str_replace('[blank]', '_***_', $withoutSpace);

                $fillEntity->codeFalse = $withoutBlank;
                $fillEntity->exercices_id = $exercice->id;
                $fillEntity->save();

                $exercice->fillEntity = $fillEntity;

                return Writer::json_output($response,201,['exercice' => $exercice]);



            } catch (\Exception $e){

                return Writer::json_output($response,500,['type' => 'error', 'error' => 500, 'message' => $e->getMessage()]);
            }

        }

       //return Writer::json_output($response,200,[$test]);



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




/*
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

        }*/




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

    public function testExercice (Request $request,Response $response,$args) {


       $props = $request->getParsedBody();

        if (isset($props['fillin']) && isset($props['userCode'])){

            try {

                $exercice = Exercices::where('id',$args['ide'])->with('fillin')->firstOrFail();

                // J'enleve "php" du code utilisateur
                $withoutPhp = str_replace('<?php','', $props['userCode']);
                // Et aussi les retours à la ligne
                $withoutn = str_replace("\n",'', $withoutPhp);
                // Et enfin les espaces
                $withoutSpace = str_replace(' ','', $withoutn);


                // Et on enleve les retour à la ligne du prof
                $codeProf = str_replace("\n",'',$exercice->fillin->codeTrue);
                if ($codeProf === $withoutSpace) {

                    return Writer::json_output($response,200,"Ok great !");

                }

                return Writer::json_output($response,200,["true" => $codeProf, "false" => $withoutSpace]);


            } catch (ModelNotFoundException $e){

                $notFoundHandler = $this->container->get('notFoundHandler');
                return $notFoundHandler($request,$response);
            }
        }

        // je dois compoarer la string de l'user et celle du prof


    }
}