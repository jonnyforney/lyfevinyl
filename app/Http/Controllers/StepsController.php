<?php

namespace App\Http\Controllers;

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
      return view('steps');
    }
}
