<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProductSearch extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
          'text' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $text = $request->text;
        $lang = $this->lang();
        $id = $this->id();

        $data['products'] = Product::select('id', "name_$lang as name", 'image', 'price')
                            ->where(function($query) use($text){
                                $query->Where('name_ar', 'LIKE', '%'.$text.'%')
                                    ->orWhere('name_en', 'LIKE', '%'.$text.'%')
                                    ->orWhere('price', 'LIKE', '%'.$text.'%');
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);

        $data['products']->map(function ($item) use ($id)
        {
            $item->is_like = $item->IsLiked($id);
            $item->has_cart = $item->HasCart($id);
        });

        return $this->successResponse($data);
    }

}
