<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class RemoveCart extends ApiController
{
    public function index(Request $request)
    {
        $rules =  [
            'product_id'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $product_id = $request->product_id;
        $id = $this->id();

        Cart::where('user_id', $id)->where('product_id', $product_id)->where('status', 1)->delete();

        return $this->successResponse(NULL, __('api.RemoveFromCart'));
    }
}
