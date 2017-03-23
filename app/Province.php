<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Province extends Eloquent
{


    protected $table    = 'provinces';
    protected $fillable = ['name','slug','active'];


}
