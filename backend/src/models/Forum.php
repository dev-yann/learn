<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/03/2018
 * Time: 21:08
 */

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{

    protected $table = 'forum';
    protected $primaryKey = 'id';
    public $timestamps = false;


    public function parcour() {
        return $this->belongsTo(Parcours::class, "parcours_id");
    }

    public function users() {
        return $this->belongsTo(User::class, "author_id");
    }
}