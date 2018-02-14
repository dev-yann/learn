<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 17:40
 */

namespace App\controllers;
use \Psr\Http\Message\ResponseInterface as Response;

class Writer
{

    /**
     * @param Response $resp
     * @param $int
     * @param $data
     * @return Response|static
     */
    static public function json_output(Response $resp, $int, $data = ''){

        $resp = $resp->withHeader('Content-Type','application/json')->withStatus($int);
        $resp->getBody()->write(json_encode($data));
        return $resp;
    }
}