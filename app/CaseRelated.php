<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseRelated extends Eloquent
{


    protected $table    = 'related_cases';
    protected $fillable = ['parent','child','created_by','updated_by'];



}
