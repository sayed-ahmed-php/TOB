<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Validator;

class ForgetPassword extends ApiController
{

    public function index(Request $request)
    {
        $rules =  [
            'email' => 'required|exists:users,email',
          ];

          $validator = Validator::make($request->all(), $rules);
          $errors = $this->formatErrors($validator->errors());
          if($validator->fails()) {return $this->errorResponse($errors);}

          Password::broker()->sendResetLink(
              $request->only('email')
          );

          $message = __('api.ForgetPasswordMail');

          return $this->successResponse(NULL, $message);
    }
}
