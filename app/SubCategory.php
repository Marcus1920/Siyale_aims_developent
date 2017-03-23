<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SubCategory extends Eloquent
{


    protected $table    = 'sub_categories';
    protected $fillable = ['name','slug','active','category'];


}
