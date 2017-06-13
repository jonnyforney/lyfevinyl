<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
    /**
     * Show the application home screen.
     *
     * @return Response
     */
    public function show()
    {
      return view('welcome');
    }
}
