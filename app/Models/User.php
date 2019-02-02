<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Storage;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function setPasswordAttribute($value)
    {
        if($value){$this->attributes['password'] = bcrypt($value);}
    }

    public function getImageAttribute($value)
    {
        if($value){
            return asset(Storage::url($value));
        }else{
            return asset(Storage::url("assets/defaults/user.jpg"));
        }
    }
}
