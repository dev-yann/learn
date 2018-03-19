<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 19/03/2018
 * Time: 16:34
 */

namespace App\models;


use Illuminate\Database\Eloquent\Model;
use App\models\Exercices;

class Fill extends Model
{
    protected $table = 'fill';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function exercice () {
        return $this->belongsTo(Exercices::class);
    }
}