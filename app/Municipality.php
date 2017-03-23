<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Municipality extends Eloquent
{


    protected $table    = 'municipalities';
    protected $fillable = ['name','slug','active','district'];



}
