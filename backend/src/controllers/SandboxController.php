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
  $code = $tab["code"];
 
  try {
     $output = $sandbox->execute($code);
    return Writer::json_output($resp,200 );
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
    $sandbox->setOption('allow_includes',true);
    $sandbox->setOption('allow_namespaces ',true);
    $sandbox->setOption('allow_aliases',true); // ACCEPTE L UTILISATION D ALIAS
$sandbox->setOption('allow_classes',true); // ACCEPTE LES CALSSE
$sandbox->setOption("namespaces",["TestCase"]); // ACCEPTE LE NAME SPACE TEST CASE

$sandbox->whitelistClass("TestCase");
$sandbox->_include("/var/www/uploads/".$filetest->file."");

$code .= '$verify_test = new Verify();';
$code .= 'return $verify_test->exec($'.$filetest->variable_test.');';

return Writer::json_output($resp,200,array("valide"=> $sandbox->execute($code)))  ;

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
}