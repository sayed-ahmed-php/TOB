<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Storage;

class updateProfile extends ApiController
{
    public function index(Request $request)
    {
        $lang = $this->lang();
        $id = $this->id();
        $auth = User::find($id);

        $rules =  [
            'f_name'            => 'required',
            'phone'           => 'required|unique:users,phone,'.$id,
            'image'           => 'nullable',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        if($request->image){
            $auth->image = $this->uploadBase64($request->image, 'users', $request->image_extension);
        }

        $auth->f_name  = $request->f_name;
        $auth->l_name  = $request->l_name;
        $auth->phone = $request->phone;
//        $auth->email = $request->email;
        $auth->save();

        return $this->successResponse($auth, 'Updated successfully.');

    }
}
