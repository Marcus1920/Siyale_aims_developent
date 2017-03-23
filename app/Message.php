<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent
{

    protected $table    = 'messages';
    protected $fillable = ['from','to','message','active','online','caseID'];

}
