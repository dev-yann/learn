<?php

namespace App\controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;
use PHPSandbox\PHPSandbox;
use PHPUnit\Framework\TestCase;
use App\models\Exercices;


class SandboxController extends BaseController
{
 public function execute (Request $req,Response $resp) {
  $tab = $req->getParsedBody();
  $sandbox = new PHPSandbox();
  $sandbox->setOption('Error Level',true);
  try {
    $sandbox->execute($tab["code"]);
    $code=$sandbox->getPreparedCode();
    return Writer::json_output($resp,200,$code);
  }
  catch (\PHPSandbox\Error $e) {
    $error_parser = $e->getPrevious();
    if (empty ($error_parser)) {
      return Writer::json_output($resp,500,array("Message d'erreur "=> $e->getMessage()));
    }
    else  {
      return Writer::json_output($resp,500,array("Message d'erreur "=> $error_parser->getMessage()));

    }  
  }

}
public function verify( Request $req,Response $resp) {
  $tab = $req->getParsedBody();
  $code = $tab["code"];

  try {
      // $exercice = Exercices::where($args["id"],"id")->firstOrFail();
   $sandbox = new PHPSandbox();
   $sandbox->setOption('sandbox_includes',true);
   $sandbox->setOption('allow_includes',true);
   $sandbox->setOption('allow_namespaces ',true);
    $sandbox->setOption('allow_aliases',true); // ACCEPTE L UTILISATION D ALIAS
$sandbox->setOption('allow_classes',true); // ACCEPTE LES CALSSE
$sandbox->setOption("namespaces",["TestCase"]); // ACCEPTE LE NAME SPACE TEST CASE

$sandbox->whitelistClass("TestCase");
$sandbox->_include("/var/www/src/controllers/verify.php");

$code .= '$verify_test = new Verify();';
$code .= 'return $verify_test->exec($t);';

return Writer::json_output($resp,200,array("Reponse "=> $sandbox->execute($code)))  ;

} catch (ModelNotFoundException $e){

  $notFoundHandler = $this->container->get('notFoundHandler');
  return $notFoundHandler($request,$response);
}
catch (\PHPSandbox\Error $e) {
  $error_parser = $e->getPrevious();
  if (empty ($error_parser)) {
   return Writer::json_output($resp,500,array("Message d'erreur "=> $e->getMessage()));
 }
 else  {
  return Writer::json_output($resp,500,array("Message d'erreur "=> $error_parser->getMessage()));

}  
}
}
}