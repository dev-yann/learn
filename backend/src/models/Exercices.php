<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 16/02/18
 * Time: 13:50
 */

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Exercices extends Model
{
    protected $table = 'exercices';
    protected $primaryKey = 'id';
    public $timestamps = true;

}