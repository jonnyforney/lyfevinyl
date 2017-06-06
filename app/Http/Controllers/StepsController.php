<?php

namespace App\Http\Controllers;

use Auth;
use App\Media;
use Storage;
use App\Vinyls;
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

    public function action(Request $request)
    {
      $method = $request->method;
      $media = new Media;
      $path = $media->$method($request);

      return ['path' => $path];
    }

    public function upload(Request $request)
    {
      
      $path = 'testpath';//Storage::disk('s3')->putFile('frontcover', $request->file('file'));

      return ['path' => $path];
    }

    public function remove(Request $request)
    {   
      //$ret = Storage::disk('s3')->delete($request->path);
      return true;//$ret;
    }

    public function save(Request $request)
    {
      $title = $request->input('title');
      
      // session(['vinyl' => $data]);
      var_dump($data);
      
      // echo json_encode(session()->all());
    }

}
