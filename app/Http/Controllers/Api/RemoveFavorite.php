<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Favorite;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class RemoveFavorite extends ApiController
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
        $lang = $this->lang();
        $id = $this->id();

        Favorite::where('user_id', $id)->where('product_id', $product_id)->delete();

        return $this->successResponse(Null, __('api.ProductUnlike'));
    }
}
