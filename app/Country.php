<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Country extends Eloquent
{


    protected $table    = 'countries';
    protected $fillable = ['name','slug','active'];



}
