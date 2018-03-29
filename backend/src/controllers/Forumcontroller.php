<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 29/03/2018
 * Time: 11:39
 */

namespace App\controllers;


use App\models\ResponseSubject;
use App\models\Subject;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class Forumcontroller extends BaseController
{
    public function getSubject(Request $request, Response $response, $args)
    {

        $id = $args['id'];

        try {

            $subjects = Subject::where('forum_id', $id)->get();
            return Writer::json_output($response, 200, ["data" => $subjects]);

        } catch (ModelNotFoundException $e) {

            return Writer::json_output($response, 404, ["message" => ["error" => "ressource not found"]]);

        } catch (\Exception $e) {

            return Writer::json_output($response, 200, ["message" => $e->getMessage()]);
        }


    }

    public function addSubject(Request $request, Response $response)
    {

        $params = $request->getParsedBody();
        $subject = new Subject();

        try {

            $subject->title = filter_var($params['titre']);
            $subject->description = $params['description'];
            $subject->forum_id = filter_var($params['id_forum'], FILTER_VALIDATE_INT);

            $subject->save();
            unset($subject->id);

            return Writer::json_output($response, 201, ["message" => ["subject" => $subject] ]);

        } catch (\Exception $e) {

            return Writer::json_output($response, 400, ["message" => "Bad request"]);

        }
    }

    public function getResponse (Request $request, Response $response, $args) {

        $myResponses = ResponseSubject::where('subject_id',$args['id'])->with('user')->get();
        return Writer::json_output($response, 200, ['data' => $myResponses]);

    }

    public function addResponse (Request $request, Response $response) {

        $params = $request->getParsedBody();
        $user = $request->getAttribute('user');


        try {

            $myResponse = new ResponseSubject();
            $myResponse->post = $params['post'];
            $myResponse->subject_id = $params['subject_id'];
            $myResponse->user_id = $user->id;
            $myResponse->save();

            unset($myResponse->id);
            return Writer::json_output($response, 201, ['data' => $myResponse]);

        } catch (\Exception $e) {

            return Writer::json_output($response, 400, ["message" => $e->getMessage()]);

        }

    }
}