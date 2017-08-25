<?php

namespace App\Http\Controllers;

use App\Classes\MediaLibrary;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function action(Request $request)
    {
      $method = (string)$request->method;
      
      if(!empty($method)) {
        $media = new MediaLibrary;
        $path = $media->$method($request);

        return ['path' => $path];
      }

      return 500;
    }

    public function clearSession()
    {
      session()->forget('order');
    }
}
