<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseSource extends Eloquent
{


    protected $table    = 'cases_sources';
    protected $fillable = ['name','updated_by','slug','active'];



}
