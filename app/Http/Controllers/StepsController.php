<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Storage;
use Illuminate\Http\Request;
use App\User;
use App\MediaLibrary;

class StepsController extends Controller
{
    /**
     * Show the first build screen.
     *
     * @return Response
     */
    public function show()
    {
      return view('steps');
    }

    public function action(Request $request)
    {
      $method = $request->method;
      $media = new MediaLibrary;
      $path = $media->$method($request);

      return ['path' => $path];
    }
}
