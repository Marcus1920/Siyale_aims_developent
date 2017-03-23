<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class addressbook extends Eloquent
{


    protected $table    = 'addressbook';
    protected $fillable = ['user','relationship','email','cellphone','first_name','surname'];



}
