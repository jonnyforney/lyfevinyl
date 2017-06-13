<?php

namespace App;

use Illuminate\Http\Request;

class MediaLibrary 
{

    function __construct()
    {
    }

    public function upload(Request $request)
    {
        //  disable in production for now
        if(env('APP_ENV', 'local') == 'production')
            return false;

        $path = Storage::disk('s3')->putFile('frontcover', $request->file('file'));
        
        return ['path' => $path];
    }

    public function remove(Request $request)
    {
        //  disable in production for now
        if(env('APP_ENV', 'local') == 'production')
            return false;
        
        return Storage::disk('s3')->delete($request->path);
    }
}