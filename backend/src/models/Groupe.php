<?php


namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'groupe';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function users() {
    	return $this->belongsToMany(Parcours::class,"parcours_id");
    }

}