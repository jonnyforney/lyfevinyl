<?php

namespace App\Classes;

use Storage;
use Illuminate\Http\Request;

class MediaLibrary 
{
    protected $is_production;
    
    function __construct()
    {
        $this->is_production = strpos($_SERVER['SERVER_NAME'], '.com');
    }

    public function upload(Request $request)
    {
        //  disable in production for now
        if(env('APP_ENV', 'local') != 'production' || !$this->is_production)
            return false;

        $path = Storage::disk('s3')->putFile('frontcover', $request->file('file'));
        
        return ['path' => $path];
    }

    public function remove(Request $request)
    {
        //  disable in production for now
        if(env('APP_ENV', 'local') != 'production' || !$this->is_production)
            return false;
        
        return Storage::disk('s3')->delete($request->path);
    }
}