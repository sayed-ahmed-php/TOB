<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Company;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Carts extends ApiController
{

    public $money = 0;

    public function index(Request $request)
    {
        $lang = $this->lang();
        $id = $this->id();

        $data['products'] = Product::select('id', "name_$lang as name", 'image', 'price')
                            ->whereIn('id', Cart::select('product_id')->where('user_id', $id)->where('status', 1)->get())
                            ->orderBy('created_at', 'DESC')
                            ->get();

        $data['products']->map(function ($item) use ($id, $lang)
        {
            $cart = Cart::select('quantity', 'price')->where('user_id', $id)->where('product_id', $item->id)->where('status', 1)->first();
            $item->quantity = $cart->quantity;
            $this->money = $this->money + $cart->price;
            $item->is_like = $item->IsLiked($id);
        });

        $data['sum'] = $this->money;
        $data['delivery'] = Setting::select('delivery')->first()->delivery;
        $data['total'] = $this->money + $data['delivery'];

        return $this->successResponse($data);
    }

}
