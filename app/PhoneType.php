<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PhoneType extends Eloquent
{


    protected $table    = 'phone_types';
    protected $fillable = ['name','slug','active'];

}
