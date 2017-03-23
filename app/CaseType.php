<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseType extends Eloquent
{


    protected $table    = 'cases_types';
    protected $fillable = ['name','slug','active'];

}
