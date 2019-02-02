<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Condition;
use App\Models\Order;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Orders extends ApiController
{

    public function index(Request $request)
    {
        $lang = $this->lang();
        $id = $this->id();

        $data['orders'] = Order::select('id', "quantity", 'price', 'payment', 'condition_id', 'created_at')
                                ->where('user_id', $id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);

        $data['orders']->map(function ($item) use($lang){
            $condition = Condition::where('id', $item->condition_id)->select("name_$lang as name")->first();
            $item->condition = $condition->name;
            $item->total = $item->price;
            $item->date = $item->created_at;

            unset($item->condition_id);
            unset($item->created_at);
            unset($item->price);
        });

        return $this->successResponse($data);
    }

}
