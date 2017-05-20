<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrderSummary;
use App\User;
use App\Vinyls;
use App\CustomerData;
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
