<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Workflow  extends Eloquent
{

    protected $table    = 'workflows';
    protected $fillable = ['name','sub_sub_category_id','order','active','created_by','updated_by'];

}
