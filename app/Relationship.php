<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Relationship extends Eloquent
{


    protected $table    = 'relationships';
    protected $fillable = ['name','active'];



}
