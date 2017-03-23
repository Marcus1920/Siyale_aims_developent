<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class PoiPictureType extends Eloquent
{
     protected $table    = 'poi_pictures_types';
     protected $fillable = ['name','id'];
}
