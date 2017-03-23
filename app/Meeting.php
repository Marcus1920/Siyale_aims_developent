<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Meeting extends Eloquent
{


    protected $table    = 'meetings';
    protected $fillable = ['title','description','name','date','start_time','end_time','facilitator','venue','file_url','created_by','updated_by'];


}
