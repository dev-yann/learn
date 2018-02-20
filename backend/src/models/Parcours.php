<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Parcours extends Model
{
    protected $table = "parcours";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $hidden = ["author_id"];

    public function exercices (){
    	return $this->hasMany(Exercices::class,'parcours_id');
    }
    public function author() {
    	return $this->belongsTo(User::class,'author_id')->select("id","username");
    }

}