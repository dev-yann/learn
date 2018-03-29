<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 29/03/2018
 * Time: 11:47
 */

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $table = "subject";
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function forums () {
        return $this->belongsTo(Forum::class, 'forums_id');
    }

    public function responsesSubjects () {
        return $this->hasMany(ResponseSubject::class, 'subject_id');
    }
}