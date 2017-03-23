<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Position extends Eloquent
{


    protected $table = 'positions';

    protected $fillable = ['name','slug','active'];



}
