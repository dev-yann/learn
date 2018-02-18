<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 16/02/18
 * Time: 10:29
 */

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $table = "parcours";
    protected $primaryKey = "id";
    public $timestamps = true;
}