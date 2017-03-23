<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CalendarEventType extends Eloquent
{


    protected $table    = 'calendar_events_type';
    protected $fillable = ['name','created_by','updated_by','active','created_at','updated_at'];



}
