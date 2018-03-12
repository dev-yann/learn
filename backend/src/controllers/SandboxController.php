<?php

namespace App\controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;
use PHPSandbox\PHPSandbox;


class SandboxController extends BaseController
{
 public function Execute(Request $req,Response $resp) {
  $code = $req->getParsedBody();
  $sandbox = new PHPSandbox();
  $sandbox->setOption('Error Level',true);
  try {
    $sandbox->execute($code["code"]);
    $t=$sandbox->getPreparedCode();
    return Writer::json_output($resp,200,$t);
  }
  catch (\PHPSandbox\Error $e) {
    $error_parser = $e->getPrevious();
    if (empty ($error_parser)) {
      echo $e->getMessage();
    }
    else  {
      echo "<pre>".$error_parser->getMessage()."</pre>";

    }  
 }

}
}