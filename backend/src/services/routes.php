<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:12
 */

$app->post("/user[/]","UserController:createUser")->setArguments(['username','password']);
