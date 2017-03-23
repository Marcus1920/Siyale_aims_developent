<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MeetingFacilitator extends Eloquent
{


    protected $table    = 'meetings_facilitators';
    protected $fillable = ['meeting','facilitator','created_by','updated_by','phonebook'];



}
