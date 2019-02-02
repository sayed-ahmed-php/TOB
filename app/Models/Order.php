<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function Condition()
    {
        return $this->belongsTo('App\Models\Condition', 'condition_id');
    }

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
