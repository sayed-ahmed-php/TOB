<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Condition;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class OrderInfo extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
           'order_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $lang = $this->lang();
        $id = $this->id();
        $order_id = $request->order_id;

        $data['orders'] = Order::where('id', $order_id)->first();
        $data['products'] = Cart::whereIn('id', OrderCart::select('cart_id')->where('order_id', $order_id)->get())
                            ->select('product_id', 'quantity')
                            ->get();

        $data['products']->map(function ($item) use($lang){
            $product = Product::select("name_$lang as name", 'price', 'image')->where('id', $item->product_id)->first();
            $item->name = $product->name;
            $item->price = $product->price;
            $item->image = $product->image;

            unset($item->product_id);
        });

        $condition = Condition::where('id', $data['orders']->condition_id)->select("name_$lang as name")->first();
        $data['orders']->condition = $condition->name;

        $data['orders']->sum = $data['orders']->price - $data['orders']->delivery;
        $data['orders']->total = $data['orders']->price;
        $data['orders']->date = $data['orders']->created_at;

        unset($data['orders']->user_id);
        unset($data['orders']->condition_id);
        unset($data['orders']->updated_at);
        unset($data['orders']->created_at);
        unset($data['orders']->price);

        return $this->successResponse($data);
    }

}
