<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/02/2018
 * Time: 19:37
 */

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $table = "posts";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function parcour (){
        return $this->belongsTo(Parcours::class,'parcours_id');
    }

    public function user () {
        return $this->belongsTo( User::class, 'user_id');
    }

}