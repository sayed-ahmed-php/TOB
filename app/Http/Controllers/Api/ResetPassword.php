<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use Auth;

class ResetPassword extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
          'old_password' => 'required',
          'password' => 'required | min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        $lang = $this->lang();
        $id = $this->id();

        $user = User::find($id);

        if (Auth::guard('api')->attempt(['phone' => $user->phone, 'password' => \request('old_password')])) {
            $user->password = $request->password;
            $user->save();

            return $this->successResponse(NULL, __('api.PasswordUpdated'));
        }

        return $this->errorResponse(__('api.PasswordInvalid'));
    }

}
