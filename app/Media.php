<?php

namespace App;

use Illuminate\Http\Request;

class Media 
{

    function __construct()
    {
    }

    public function upload(Request $request)
    {
        return $request->user;
    }

    public function remove(Request $request)
    {

    }
}