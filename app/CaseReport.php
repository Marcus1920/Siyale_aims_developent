<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class CaseReport extends Eloquent
{


    protected $table    = 'cases';
    protected $fillable = ['description','user','department','category','sub_category','sub_sub_category','priority','status','gps_lat','gps_lng','img_url','active','severity','source'];



}
