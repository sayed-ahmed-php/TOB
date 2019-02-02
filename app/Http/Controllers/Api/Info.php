<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Info extends ApiController
{

    public function index(Request $request)
    {
        $lang = $this->lang();
        $id = $this->id();

        $setting = \App\Models\Setting::select("privacy_$lang as privacy")->first();
        return $this->successResponse($setting);
    }

}
