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

}