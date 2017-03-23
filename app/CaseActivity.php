<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseActivity extends Eloquent
{


    protected $table    = 'cases_activities';
    protected $fillable = ['case_id','user','note','active','addressbook'];



}
