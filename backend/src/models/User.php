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

      public function groupes() {
         return $this->belongsToMany(Groupe::class, 'user2groupe', 'user_id', 'groupe_id');
    }
}