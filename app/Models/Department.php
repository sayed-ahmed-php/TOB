<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Department extends Model
{
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if($value){
            return asset(Storage::url($value));
        }
        return asset(Storage::url("assets/defaults/classified.jpg"));
    }
}
