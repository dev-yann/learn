<?php


namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Exercices extends Model
{
    protected $table = 'exercices';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function cours() {
    	return $this->belongsTo(Cours::class,"cours_id");
    }
    public function parcours() {
    	return $this->belongsTo(Parcours::class,"parcours_id");
    }

}