<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Favorite;
use App\Models\Follow;
use App\Models\Product;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;

class AllFavorites extends ApiController
{
    public function index(Request $request)
    {
        $lang = $this->lang();
        $id = $this->id();

        $ids = Favorite::select('product_id')->where('user_id', $id)->get();
        $data['favorites'] = Product::select('id', "name_$lang as name", 'image', 'price')
                            ->whereIn('id', $ids)
                            ->orderBy("created_at", 'DESC')
                            ->get();

        return $this->successResponse($data);
    }
}
