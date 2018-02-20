<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    protected $table = "parcours";
    protected $primaryKey = "id";
    public $timestamps = true;

    public function exercices (){
    	return $this->hasMany(Exercices::class,'parcours_id');
    }

}