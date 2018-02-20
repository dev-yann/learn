<?php


namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $table = 'groupes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ["pivot"];

    public function users() {
    	 return $this->belongsToMany(User::class, 'user2groupe', 'groupe_id', 'user_id')->select("id","username");
    }

}