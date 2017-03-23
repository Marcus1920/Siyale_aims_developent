<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ward extends Eloquent
{


    protected $table    = 'wards';
    protected $fillable = ['name','municipality','slug','active'];


}
