<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserStatus extends Eloquent
{


    protected $table    = 'users_statuses';
    protected $fillable = ['name','slug','active','created_by','updated_by'];


}
