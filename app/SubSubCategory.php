<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class SubSubCategory extends Eloquent
{


    protected $table    = 'sub_sub_categories';
    protected $fillable = ['name','slug','active','sub_category'];


}
