<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

 # --------------------successResponse------------------
 public function successResponse($data, $message = NULL)
 {
      $response = array(
        'status'  => TRUE,
        'message' => $message,
        'data'    => $data
      );
      return response()->json($response, 200);
  }


  # --------------------errorResponse------------------
  public function errorResponse($errors , $data = NULL)
  {
      $response = array(
        'status'  => FALSE,
        'message' => $errors,
        'data'    => $data
      );
      return response()->json($response);
  }



  #------------------ format error----------------
  public function formatErrors($errors)
    {
        $stringError = "";
        for ($i=0; $i < count($errors->all()); $i++) {
          $stringError = $stringError . $errors->all()[$i];
          if($i != count($errors->all())-1){
            $stringError = $stringError . '\n';
          }
        }
        return $stringError;
    }

    #------------------ lang ----------------
    public function lang()
    {
        if (request()->header('lang'))
        {
            return request()->header('lang');
        }
        return 'ar';
    }

    #------------------ Auth ----------------
    public function id()
    {
        if (request()->header('id'))
        {
            return request()->header('id');
        }
        return 0;
    }

# -------------------------------------------------
  public function uploadBase64($base64, $path, $extension = 'jpeg')
  {
      $fileBaseContent = base64_decode($base64);
      $fileName = str_random(10).'_'.time().'.'.$extension;
      $file = $path.'/'.$fileName;
      Storage::put('public/storage/'.$file, $fileBaseContent);
      return 'public/storage/' . $file;
  }




}
