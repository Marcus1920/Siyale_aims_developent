<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseNote extends Eloquent
{


    protected $table    = 'cases_notes';
    protected $fillable = ['case_id','user','note','active'];



}
