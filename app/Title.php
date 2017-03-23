<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Title  extends Eloquent
{


    protected $table    = 'titles';
    protected $fillable = ['name','updated_by','slug','active'];


}
