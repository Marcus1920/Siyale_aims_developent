<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseSubType extends Eloquent
{


    protected $table    = 'cases_sub_types';
    protected $fillable = ['name','slug','active'];

}
