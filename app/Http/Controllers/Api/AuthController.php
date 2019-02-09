<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use App\Models\Token;
use App\Models\User;

class AuthController extends ApiController
{

    public function login ()
    {
        $rules =  [
            'email'  => 'required',
            'password'  => 'required',
        ];

        $validator = Validator::make(\request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        if (Auth::guard('api')->attempt(['email' => \request('email'), 'password' => \request('password')]))
        {
            $data['user'] = Auth::guard('api')->user();

            return $this->successResponse($data, __('api.LoginSuccess'));
        }

        return $this->errorResponse(__('api.LoginFail'));
    }

    public function logout()
    {
        return $this->successResponse(NULL, __('api.LogoutSuccess'));
    }

    public function register()
    {
        $rules =  [
            'f_name'      => 'required',
            'email'     => 'required|email|unique:users',
            'phone'     => 'required|unique:users',
            'password'  => 'required|min:6',
            'image'     => 'nullable',
        ];

        $validator = Validator::make(\request()->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $inputs = \request()->except('image');
        if(\request('image')){
            $inputs['image'] = $this->uploadBase64(\request('image'), 'users');
        }

        $data['user'] = User::create($inputs);

        return $this->successResponse($data['user'], __('api.RegisterSuccess'));
    }
}
