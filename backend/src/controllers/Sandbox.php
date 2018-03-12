<?php

namespace App\controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\UploadedFile;
use PHPSandbox\PHPSandbox;


class Sandbox extends BaseController
{
 public function Execute(Request $req,Response $resp) {
  $code = $req->getParsedBody("code");
  $sandbox = new PHPSandbox();
  $sandbox->setOption('Error Level',true);
  try {
    $t=$sandbox->execute($code);
    return Writer::json_output($resp,201,array("message"=>$t));
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