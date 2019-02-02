<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable
{

    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
        if($value){$this->attributes['password'] = bcrypt($value);}
    }
}
