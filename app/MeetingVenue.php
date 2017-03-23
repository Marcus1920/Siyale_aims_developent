<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MeetingVenue extends Eloquent
{


    protected $table    = 'meetings_venues';
    protected $fillable = ['name','address','created_by','updated_by'];



}
