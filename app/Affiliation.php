<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Affiliation extends Eloquent
{


    protected $table    = 'affiliations';
    protected $fillable = ['name','slug','active'];



}
