<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 16/02/18
 * Time: 10:18
 */

namespace App\controllers;
use App\models\Courses;
use PhpParser\Node\Expr\Cast\Object_;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\controllers\Writer;

class CoursesController extends BaseController
{

    public function getCourses(Request $request, Response $response){

        $request_body = $request->getParsedBody();
        $courses = Courses::select()->get();

        return Writer::json_output($response,201,$courses);
    }


}