<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Condition;
use App\Models\Order;
use App\Models\OrderCart;
use App\Models\Setting;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class CreateOrder extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
            'payment' => 'required',
            'address' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $lang = $this->lang();
        $id = $this->id();

        $cart = Cart::where('user_id', $id)->where('status', 1)->get();
        $quantity = 0;
        $money = 0;

        foreach ($cart as $item){
            $quantity = $quantity + $item->quantity;
            $money = $money + $item->price;
        }

        $order = Order::create([
            'address' => $request->address,
            'payment' => $request->payment,
            'quantity' => $quantity,
            'price' => $money,
            'user_id' => $id,
            'condition_id' => Condition::first()->id,
            'delivery' => Setting::first()->delivery,
        ]);

        foreach ($cart as $item){
            $item->status = 2;
            $item->save();

            OrderCart::create([
                'cart_id' => $item->id,
                'order_id' => $order->id,
            ]);
        }

        return $this->successResponse(NULL, __('api.PaymentSuccess'));
    }

}
