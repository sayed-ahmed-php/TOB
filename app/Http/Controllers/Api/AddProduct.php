<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class AddProduct extends ApiController
{
    public function index(Request $request)
    {
        $rules =  [
            'product_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $id = $this->id();

        $product = Product::findOrFail($request->product_id);
        $item = Cart::where('product_id', $request->product_id)
                        ->where('user_id', $id)
                        ->where('status', 1)
                        ->first();
        $item->quantity = $item->quantity + 1 ;
        $item->price = $item->price + $product->price ;
        $item->save();

        return $this->successResponse(NULL, __('api.CartIncrease'));
    }

}
