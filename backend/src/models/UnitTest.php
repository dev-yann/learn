<?php

namespace App\models;


use Illuminate\Database\Eloquent\Model;
use App\models\Exercices;

class UnitTest extends Model
{
    protected $table = 'unit_test';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function exercice () {
        return $this->belongsTo(Exercices::class);
    }
}