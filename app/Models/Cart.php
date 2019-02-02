<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
