<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class District extends Eloquent
{


    protected $table    = 'districts';
    protected $fillable = ['name','slug','active','province'];



}
