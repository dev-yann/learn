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
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Firebase\JWT\JWT;
use App\models\Parcours;

class UserController extends BaseController
{

    /**
     * @param Request $request
     * @param Response $responseonse
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
                     unset($user->id);
                     return Writer::json_output($response,201,$user);

                 } catch (\Exception $e){
                     // revoyer erreur format json
                     return Writer::json_output($response,500,['error' => $e->getMessage()]);
                 }
             } else {
                 return Writer::json_output($response,401,['error' => "Bad credentials"]);
             }
    }

    public function createAuthor (Request $request, Response $response) {

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
            $user->author = 1;

            try{
                $user->save();
                unset($user->password);
                unset($user->id);
                return Writer::json_output($response,201,$user);

            } catch (\Exception $e){
                // revoyer erreur format json
                return Writer::json_output($response,500,['error' => $e->getMessage()]);
            }
        } else {
            return Writer::json_output($response,401,['error' => "Bad credentials"]);
        }

    }

    public function connectUser(Request $request, Response $response){

        // header authorization
       if(!$request->hasHeader('Authorization')){
            // JE RENVOIE LE TYPE D'AUTH NECESSAIRE
            $responseonse = $response->withHeader('WWW-Authenticate', 'Basic realm="api.lbs.local"');
            return Writer::json_output($response, 401, ['type' => 'error', 'error' => 401, 'message' => 'No authorization header present']);
        }

        // https
        if(!$this->container['settings']['production'] && 'http' == $request->getUri()->getScheme()){
            return Writer::json_output($response, 401, ['type' => 'error', 'error' => 401, 'message' => 'insecure']);
        }

        $auth = base64_decode(explode( " ", $request->getHeader('Authorization')[0])[1]);
       list($username, $pass) = explode(':', $auth);

        // Database test
        try {
            $user = User::where('username',$username)->firstOrFail();

            if (!password_verify($pass,$user->password)){
                throw new \Exception("Bad credentials");
            }

        } catch (ModelNotFoundException $e){

            $response = $response->withHeader('WWW-Authenticate', 'Basic realm="api.learn"');
            return Writer::json_output($response,400,['error' => "Ce compte n'éxiste pas"]);

        } catch (\Exception $e){

            $response = $response->withHeader('WWW-Authenticate', 'Basic realm="api.learn"');
            $response = $response->withStatus(401);
            return Writer::json_output($response,401,['error' => $e->getMessage()]);
        }

        // SI ON ARRIVE ICI C'EST QUE TOUT EST BON : ON CREER LE TOKEN JWT
        $mysecret = 'je suis un secret $µ°';

        $token = JWT::encode([
            'iss' => "http://api.learn/user",
            'aud' => "http://api.learn/",
            'iat' => time(),
            'exp' => time()+2000000,
            'uid' => $user->id ],
            $mysecret, 'HS512');

        // Pour renvoyer de bonnes informations user
        unset($user->password);

        return Writer::json_output($response,201,["user" => $user,"token" => $token]);
    }

    // inscription a un  parcours
    public function subscribeParcoursUser (Request $request, Response $response) {

        $tab = $request->getParsedBody();
        // on recoit parcours id et user id
        try {

            // Association dans la table parcours2users
            $user = User::where('id',$tab['userId'])->firstOrFail();
            $user->parcours()->syncWithoutDetaching($tab['parcoursId']);

            return Writer::json_output($response, 201, ['message' => 'Inscription effectuée']);

        } catch (ModelNotFoundException $e) {

            return Writer::json_output($response,400,['error' => "Ce compte n'éxiste pas"]);

        }

    }

    public function connectAuthor (Request $request, Response $response) {

        // header authorization
        if(!$request->hasHeader('Authorization')){
            // JE RENVOIE LE TYPE D'AUTH NECESSAIRE
            $responseonse = $response->withHeader('WWW-Authenticate', 'Basic realm="api.lbs.local"');
            return Writer::json_output($response, 401, ['type' => 'error', 'error' => 401, 'message' => 'No authorization header present']);
        }

        // https
        if(!$this->container['settings']['production'] && 'http' == $request->getUri()->getScheme()){
            return Writer::json_output($response, 401, ['type' => 'error', 'error' => 401, 'message' => 'insecure']);
        }

        $auth = base64_decode(explode( " ", $request->getHeader('Authorization')[0])[1]);
        list($username, $pass) = explode(':', $auth);

        // Database test
        try {
            $user = User::where('username',$username)->firstOrFail();

            if (!password_verify($pass,$user->password)){
                throw new \Exception("Bad credentials");
            }

            if ($user->author == 0) {

                return Writer::json_output($response, 401, ["error" => "Vous n'êtes pas inscrit"]);
            }

        } catch (ModelNotFoundException $e){

            $response = $response->withHeader('WWW-Authenticate', 'Basic realm="api.learn"');
            return Writer::json_output($response,400,['error' => "Ce compte n'éxiste pas"]);

        } catch (\Exception $e){

            $response = $response->withHeader('WWW-Authenticate', 'Basic realm="api.learn"');
            $response = $response->withStatus(401);
            return Writer::json_output($response,401,['error' => $e->getMessage()]);
        }

        // SI ON ARRIVE ICI C'EST QUE TOUT EST BON : ON CREER LE TOKEN JWT
        $mysecret = 'je suis un secret $µ°';

        $token = JWT::encode([
            'iss' => "http://api.learn/user",
            'aud' => "http://api.learn/",
            'iat' => time(),
            'exp' => time()+2000000,
            'uid' => $user->id ],
            $mysecret, 'HS512');

        // Pour renvoyer de bonnes informations user
        unset($user->password);

        return Writer::json_output($response,201,["user" => $user,"token" => $token]);

    }


    // recupere le contenu de la page dashboard
    public function getDashboard (Request $request, Response $response) {

        // recupération de l'utilisateur
        $user = $request->getAttribute('user');

        $parcours = $user->parcours;
        $user->parcours = $parcours;
        return Writer::json_output($response,200, ['data' => $user]);



    }
}
