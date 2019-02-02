<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCart extends Model
{
    protected $guarded = [];

    public function Cart()
    {
        return $this->belongsTo('App\Models\Cart', 'cart_id');
    }

    public function Order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}
