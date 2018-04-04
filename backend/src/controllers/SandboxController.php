<?php

namespace App\controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;
use PHPSandbox\PHPSandbox;
use PHPUnit\Framework\TestCase;
use App\models\Exercices;
use App\models\User;
use App\models\Parcours;
use App\controllers\XpController;

class SandboxController extends BaseController
{
 public function execute (Request $req,Response $resp) {
  $tab = $req->getParsedBody();
  $sandbox = new PHPSandbox();
  $sandbox->setOption('Error Level',true);
  $sandbox->setOption('allow_functions',true);
  $sandbox->setOption('capture_output',true);
  $sandbox->whitelistFunc( 'print_r') ;
  $sandbox->whitelistFunc( 'var_dump') ;
  $code = $tab["code"];

  try {
   $output = $sandbox->execute($code);
   return Writer::json_output($resp,200,$output );
 }
 catch (\PHPSandbox\Error $e) {
  $error_parser = $e->getPrevious();
  if (empty ($error_parser)) {
      return Writer::json_output($resp,500,array("erreur"=> $e->getMessage())); // ERREUR AU NIVEAU DU PARSAGE DU TEXTE PHP
    }
    else  {
      return Writer::json_output($resp,500,array("erreur"=> $error_parser->getMessage())); // ERREUR AU NIVEAU DE L EXECUTION DU CODE PHP SELON LES OPTIONS DE LA SANDBOX

    }  
  }

}
public function verify( Request $req,Response $resp,$args) {
  $tab = $req->getParsedBody();
  $code = $tab["code"];


  try {
    $exercice = Exercices::where("id",$args["ide"])->where("parcours_id",$args["id"])->firstOrFail();
    $filetest = $exercice->unittest()->first();
    $sandbox = new PHPSandbox();
    $sandbox->setOption('sandbox_includes',true);
    $sandbox->setOption('allow_functions',true);
    $sandbox->setOption('allow_includes',true);
    $sandbox->setOption('allow_namespaces ',true);
    $sandbox->setOption('allow_aliases',true); // ACCEPTE L UTILISATION D ALIAS
$sandbox->setOption('allow_classes',true); // ACCEPTE LES CALSSE
$sandbox->setOption("namespaces",["TestCase"]); // ACCEPTE LE NAME SPACE TEST CASE
$sandbox->setOption('capture_output',true);
$sandbox->whitelistClass("TestCase");


$code .= '$verify_test = new Verify();';

if ($filetest->type==="fonction") {
 $sandbox->whitelistFunc($filetest->custom) ;
 $code .= 'echo $verify_test->exec();';
}
else {
  $code .= 'echo $verify_test->exec($'.$filetest->custom.');';
}
$sandbox->_include("/var/www/uploads/".$filetest->file."");
$t = $sandbox->execute($code);
$t = substr($t, -1);

return Writer::json_output($resp,200,array("valide"=> $t ))  ;

} catch (ModelNotFoundException $e){

  $notFoundHandler = $this->container->get('notFoundHandler');
  return $notFoundHandler($request,$response);
}
catch (\PHPSandbox\Error $e) {
  $error_parser = $e->getPrevious();
  if (empty ($error_parser)) {
   return Writer::json_output($resp,500,array("erreur"=> $e->getMessage()));
 }
 else  {
  return Writer::json_output($resp,500,array("erreur"=> $error_parser->getMessage()));

}  
}
}
public function validate ($request, $response,$args)
{

  $tab = $request->getParsedBody();
  $parcours = Parcours::where("id",$args["id"])->first();
  $user = User::where("id",$tab["user"])->first();
  try {




            // on ajoute les points si l'exo n'a pas encore été
            // validé par l'utilisateur

    $test = true;
    foreach ($user->exercices as $exercice) {

      if ($exercice->pivot->exercice_id === $id) {
        $test = false;
      }
    }

    if ($test) {
      $user->exercices()->syncWithoutDetaching([$args["ide"]=> ["state" => 1]]);

      $user = XpController::setXp($parcours, $user);
      $user->save();
    }
     return Writer::json_output($response, 200, ["message" => $user]);


  } catch (ModelNotFoundException $e) {

    return Writer::json_output($response, 401, ["message" => "synchronisation échouée"]);
  }
}
}