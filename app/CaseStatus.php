<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseStatus extends Eloquent
{


    protected $table    = 'cases_statuses';
    protected $fillable = ['name','slug','active'];



}
