<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //

    public function test(Request $request)
    {
        var_dump(Auth::user());
    }
}
