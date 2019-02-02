<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class ProductInfo extends ApiController
{
    public function index(Request $request)
    {
        $rules =  [
            'product_id'    => 'required|exists:products,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $product_id = $request->product_id;
        $lang = $this->lang();
        $id = $this->id();

        $data['products'] = Product::where('id', $product_id)
                        ->select('id', "name_$lang as name", 'image', 'image', 'price', 'dept_id', "desc_$lang as description")
                        ->first();

        $data['products']->has_cart = $data['products']->HasCart($id);
        $data['products']->images = ProductImage::where('product_id', $product_id)->get();
        $data['products']->images->map(function ($item)
        {
            unset($item->id);
            unset($item->product_id);
            unset($item->created_at);
            unset($item->updated_at);
        });

        $data['products']->similar_products = Product::where('dept_id', $data['products']->dept_id)
                                            ->where('id', '!=', $product_id)
                                            ->select('id', "name_$lang as name", 'image', 'price')
                                            ->orderBy('created_at', 'DESC')
                                            ->get();

        $data['products']->similar_products->map(function ($item) use ($id)
        {
            $item->is_like = $item->IsLiked($id);
            $item->has_cart = $item->HasCart($id);
        });

        return $this->successResponse($data);
    }
}
