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

    public function Role()
    {
        return $this->hasMany('App\Models\Role');
    }

    public function isRole($role)
    {
        $true = Role::where('admin_id', $this->id)->where('role', $role)->first();
        if ($true)
        {
            return true;
        }
        return false;
    }

    public function hasRole($role)
    {
        $true = Role::where('admin_id', Auth::guard('admin')->user()->id)->where('role', $role)->first();
        if ($true)
        {
            return true;
        }
        return false;
    }
}
