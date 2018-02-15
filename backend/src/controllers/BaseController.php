<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 17:59
 */

namespace App\controllers;


class BaseController
{
    protected $container;

    public function __construct($c)
    {
        $this->container = $c;
    }

}