<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CasePriority extends Eloquent
{


    protected $table    = 'cases_priorities';
    protected $fillable = ['name','slug','active'];

}
