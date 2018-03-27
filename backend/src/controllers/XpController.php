<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 20/02/18
 * Time: 10:52
 */

namespace App\controllers;


class XpController extends BaseController
{

    /**
     * Gestion des points
     * Le but est d'ajouter des points à chaque exercice terminer
     */

    const LEVEL_3XP = 3;
    const LEVEL_2XP = 2;
    const LEVEL_1XP = 1;

    private static $result;

    public static function setXp ($parcours, $user) {

        switch ($parcours->level) {
            case self::LEVEL_1XP :
                self::$result = 10 * self::LEVEL_1XP;
                break;
            case self::LEVEL_2XP :
                self::$result = 10 * self::LEVEL_2XP;
                break;
            case self::LEVEL_3XP :
                self::$result = 10 * self::LEVEL_3XP;
                break;
            default :
                self::$result = 0;
        }

        $user->exp += self::$result;
        return $user;
    }

}