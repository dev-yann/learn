<?php


namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Exercices extends Model
{
    protected $table = 'exercices';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function parcours() {
    	return $this->belongsTo(Parcours::class,"parcours_id");
    }
       public function users() {
    	 return $this->belongsToMany(User::class, 'user2exercice', 'excercice_id', 'user_id');
    }
    
}