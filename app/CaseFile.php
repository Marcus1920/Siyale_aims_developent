<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseFile extends Eloquent
{


    protected $table    = 'cases_files';
    protected $fillable = ['case_id','user','file','active','addressbook','file_note'];



}
