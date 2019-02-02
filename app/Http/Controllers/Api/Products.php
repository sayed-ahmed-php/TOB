<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Products extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
          'department_id' => 'exists:departments,id',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $category = $request->category_id;
        $lang = $this->lang();
        $id = $this->id();

        $data['products'] = Product::select('id', "name_$lang as name", 'image', 'price')
                            ->orderBy('created_at', 'DESC')
                            ->when($category, function ($query) use ($category) {return $query->whereIn('dept_id', $category);})
                            ->paginate(10);

        $data['products']->map(function ($item) use ($id)
        {
            $item->is_like = $item->IsLiked($id);
            $item->has_cart = $item->HasCart($id);
        });

        return $this->successResponse($data);
    }

}
