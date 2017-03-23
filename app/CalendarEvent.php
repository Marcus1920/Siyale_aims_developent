<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CalendarEvent extends Eloquent
{


    protected $table    = 'calendar_events';
    protected $fillable = ['name','start_date','start_time','end_date','end_time','event_type_id','locked','created_by','updated_by','active'];



}
