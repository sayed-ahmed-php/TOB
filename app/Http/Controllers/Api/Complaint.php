<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Complaint extends ApiController
{
    public function index(Request $request)
    {
        $rules =  [
            'name'    => 'required',
            'phone'    => 'required',
            'email'    => 'required|email',
            'msg'    => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        $errors = $this->formatErrors($validator->errors());
        if($validator->fails()) {return $this->errorResponse($errors);}

        \App\Models\Complaint::create($request->all());


        return $this->successResponse(NULL, __('api.Complaint'));
    }
}
