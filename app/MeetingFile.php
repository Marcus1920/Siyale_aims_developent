<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class MeetingFile extends Eloquent
{


    protected $table    = 'meetings_files';
    protected $fillable = ['meeting_id','user','file','addressbook','file_note','img_url','active'];



}
