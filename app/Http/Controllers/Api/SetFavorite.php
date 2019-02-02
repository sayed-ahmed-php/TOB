<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class SetFavorite extends ApiController
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

        Favorite::create([
            'user_id' => $id,
            'product_id' => $product_id
        ]);

        return $this->successResponse(NULL, __('api.ProductLike'));
    }
}
