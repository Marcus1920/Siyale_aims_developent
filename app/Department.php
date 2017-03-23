<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Department extends Eloquent
{


    protected $table    = 'departments';
    protected $fillable = ['name','slug','active','created_by','updated_by','acronym'];



}
