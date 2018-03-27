<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 26/03/18
 * Time: 18:54
 */

namespace App\middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use App\models\User;
use App\controllers\Writer;

class CheckSubscribe
{

    public function __invoke(Request $req, Response $resp, $next)
    {
        $test = false;
        $props = $req->getParsedBody();
        $user = $props['user'];
        $p = $props['parcId'];

        try{
            $user = User::findOrFail($user['id']);
            $req = $req->withAttribute('user',$user);

        } catch (ModelNotFoundException $e){

            return Writer::json_output($resp,401,["message" => "Not found exceptions"]);

        }

        foreach ($user->parcours as $role)
        {
            if($role->pivot->parcours_id === $p){
                $test = true;
                $req = $req->withAttribute('parcours',$role);
                break;
            }
        }


        if($test === true){
            $resp = $next($req,$resp);
            return $resp;
        } else {
            return Writer::json_output($resp,401,["message" => "Vous n'êtes pas inscrit à ce cours"]);
        }
    }
}