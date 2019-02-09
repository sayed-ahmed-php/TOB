<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Product extends Model
{
    protected $guarded = [];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getImageAttribute($value)
    {
        if($value){
            return asset(Storage::url($value));
        }
        return asset(Storage::url("assets/defaults/classified.jpg"));
    }

    public function Department()
    {
        return $this->belongsTo('App\Models\Department', 'dept_id');
    }

    public function IsLiked($id)
    {
        $item = Favorite::where('user_id', $id)->where('product_id', $this->id)->first();
        if($item){ return TRUE; }
        return FALSE;
    }

    public function HasCart($id)
    {
        $item = Cart::where('user_id', $id)->where('product_id', $this->id)->where('status', 1)->first();
        if($item){ return TRUE; }
        return FALSE;
    }
}
