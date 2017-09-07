<?php

namespace App\Http\Controllers;

use App\Classes\MediaLibrary;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function action(Request $request)
    {    
      try {
        $method = $request->method;
        $media = new MediaLibrary;
        $path = $media->$method($request);

        return ['path' => $path];
      } catch (Exception $e) {
        return 'Caught exception: ' . $e->getMessage();
      }
    }

    public function clearSession()
    {
      session()->forget('order');
    }
}
