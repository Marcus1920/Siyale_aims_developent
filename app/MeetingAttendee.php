<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MeetingAttendee extends Eloquent
{


    protected $table    = 'meetings_attendees';
    protected $fillable = ['meeting','attendee','created_by','updated_by','phonebook','mobile'];



}
