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
    public function posts () {
        return $this->hasMany(Posts::class, 'parcours_id');
    }
    public function author() {
    	return $this->belongsTo(User::class,'author_id')->select("id","username");
    }
    public function users () {
        return $this->belongsToMany(User::class, 'parcours2users','parcours_id','user_id')->withPivot(['parcours_id', 'user_id']);
    }

}