<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class AffiliationPositions extends Eloquent
{


    protected $table    = 'positions_affiliations';
    protected $fillable = ['name','affiliation','active','positions'];



}
