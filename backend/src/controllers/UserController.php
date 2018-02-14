<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 17:59
 */
namespace App\controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\models\User;

class UserController extends BaseController
{

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface|static
     */

    public function createUser(Request $request, Response $response){

        // checkformulaire en amont

        $tab = $request->getParsedBody();

        $user = new User();
        $user->username = filter_var($tab["username"],FILTER_SANITIZE_STRING);

        // verification auprès de la base
        $test = User::select('id')->where('username','=',$user->username)->first();

        if(empty($test)){
            $pass = filter_var($tab["password"],FILTER_SANITIZE_STRING);
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $user->password = $pass;

            try{
                $user->save();
                unset($user->password);
                return Writer::json_output($response,201,$user);

            } catch (\Exception $e){
                // revoyer erreur format json
                return Writer::json_output($response,500,['error' => 'Internal Server Error']);
            }
        } else {
            return Writer::json_output($response,401,['error' => "Bad credentials"]);
        }
    }
}