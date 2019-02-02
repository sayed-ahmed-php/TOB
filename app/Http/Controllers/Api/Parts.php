<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class Parts extends ApiController
{

    public function index(Request $request)
    {
        $lang = $this->lang();
        $data['departments'] = Department::select('id', "name_$lang as name")->orderBy('ordered')->get();

        return $this->successResponse($data);
    }

}
