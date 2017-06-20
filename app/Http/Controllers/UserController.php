<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addOrder(Request $request)
    {
        return User::createNewOrder($request);        
    }
}