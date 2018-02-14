<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 17:39
 */


namespace App\middleware;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Firebase\JWT\JWT;
use App\Controllers\Writer;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;

/**
 * Class CheckJwt
 * @package App\Middleware
 */
class CheckJwt
{

    /**
     * @param Request $req
     * @param Response $resp
     * @param $next
     * @return Response|static
     */

    public function check(Request $req, Response $resp, $next){

        if(!$req->hasHeader('Authorization')){

            $resp = $resp->withHeader('WWW-Authenticate', 'Bearer realm="api.learn"');
            return Writer::json_output($resp, 401, ['type' => 'error', 'error' => 401, 'message' => 'No authorization header present']);
        }

        try{

            $header = $req->getHeader('Authorization')[0];
            $mysecret = 'je suis un secret $µ°';
            $tokenString = sscanf($header,"Bearer %s")[0];

            $token = JWT::decode($tokenString,$mysecret,['HS512']);

            // Si l'utilisateur existe
            try{
                $user = User::where('id','=',$token->uid)->firstOrFail();
            } catch (ModelNotFoundException $e){
                return Writer::json_output($resp,401,['error' => "wrong token"]);
            }


        } catch(ExpiredException $e){
            // todo: voir si on doit rajouter du code ds les exceptions
            return Writer::json_output($resp,401,['error' => "wrong token"]);
        } catch (SignatureInvalidException $e){
            return Writer::json_output($resp,401,['error' => "wrong token"]);
        } catch (BeforeValidException $e){
            return Writer::json_output($resp,401,['error' => "wrong token"]);
        } catch (\UnexpectedValueException $e){
            return Writer::json_output($resp,401,['error' => "wrong token"]);
        } catch (\Exception $ex){
            return Writer::json_output($resp,401,['error' => "wrong token"]);
        }

        $resp = $next($req,$resp);
        return $resp;
    }
}