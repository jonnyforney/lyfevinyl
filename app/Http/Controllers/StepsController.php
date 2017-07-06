<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class StepsController extends Controller
{
    /**
     * Show the first build screen.
     *
     * @return Response
     */
    public function show()
    {
      return view('steps', ['order' => session('order')]);
    }

    public function save(Request $request)
    {
      $step = ucwords(camel_case($request['step']));

      $class_name = 'App\\Classes\\'.$step;
      $step_class = new $class_name;

      // store to db if logged in, otherwise save in session
      if(Auth::check()) {
        return $step_class->store((object)$request['data']);
      }

      return $step_class->save((object)$request['data']);
    }

    public function action(Request $request)
    {
      $method = $request->method;
      $media = new MediaLibrary;
      $path = $media->$method($request);

      return ['path' => $path];
    }
}
