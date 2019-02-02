<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;

class ProductImage extends Model
{
    protected $guarded = [];

    public function getImageAttribute($value)
    {
        if($value){
            return asset(Storage::url($value));
        }
        return asset(Storage::url("assets/media_samples/grey_image_thumbnail.jpg"));
    }

    public function Product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
