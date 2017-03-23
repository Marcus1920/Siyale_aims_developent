<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserRole extends Eloquent
{


    protected $table    = 'users_roles';
    protected $fillable = ['name','slug','active','created_by','updated_by'];


}
