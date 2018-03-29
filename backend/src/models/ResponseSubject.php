<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 29/03/2018
 * Time: 16:37
 */

namespace App\models;


use Illuminate\Database\Eloquent\Model;

class ResponseSubject extends Model
{

    protected $table = "response";
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function subject () {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function user () {
        return $this->belongsTo(User::class, 'user_id');
    }
}