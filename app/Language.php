<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Language  extends Eloquent
{


    protected $table    = 'languages';
    protected $fillable = ['name','updated_by','slug','active'];


}
