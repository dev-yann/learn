<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 16/02/18
 * Time: 11:24
 */

namespace App\controllers;
use App\models\Exercices;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ExerciceController extends BaseController
{

    public function getExercices(Request $request, Response $response, $args){

        // REGEX AU NIVEAU DE L'URL, CE NE PEUT ETRE QU'UNE SUITE DE CHIFFRES ( args id )
        $exercices = Exercices::where('parcours_id','=',$args['id'])->get();
        Writer::json_output($response,201,['exercices' => $exercices]);
    }
}