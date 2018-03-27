<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 14/02/18
 * Time: 18:37
 */

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * @var string
     */
    protected $table = 'user';
    /**
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    public $timestamps = false;

    protected $hidden =["password"];

    public function posts () {
        return $this->hasMany(Posts::class, 'user_id');
    }

    public function parcours () {
        return $this->belongsToMany(Parcours::class, 'parcours2users','user_id','parcours_id')->withPivot(['parcours_id', 'user_id']);
    }

      public function groupes() {
         return $this->belongsToMany(Groupe::class, 'user2groupe', 'user_id', 'groupe_id');
    }
       public function exercices() {
         return $this->belongsToMany(Exercices::class, 'user2exercice', 'user_id', 'exercice_id')->withPivot(['user_id','exercice_id','state']);
    }
}