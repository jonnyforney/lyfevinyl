<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Storage;
use Illuminate\Http\Request;
use App\User;
use App\MediaLibrary;

class StepsController extends Controller
{
    /**
     * Show the first build screen.
     *
     * @return Response
     */
    public function show()
    {
      if (Auth::check())
      {
        //  create order id / retrieve order id
        // $results = (object) DB::select('select * from reserve_next_order_id(:user)', ['user' => Auth::id() || 1])[0];
        // $order_id = $results->reserve_next_order_id;

        $user = Auth::user();


        dd($user);
        
      }

      // return view('steps');
    }

    public function action(Request $request)
    {
      $method = $request->method;
      $media = new MediaLibrary;
      $path = $media->$method($request);

      return ['path' => $path];
    }

    public function save(Request $request)
    {
        $type = $request->input('type') ?? '';
        $title = $request->input('title') ?? '';
        
        $data = [
            'title' => $title
        ];

        //  save to session if set
        if ($type == 'session')
        {
            session(['vinyl' => $data]);
        }

        if (Auth::check())
        {
            //  save to the db

        }
        
        dd($data);
        // echo json_encode(session()->all());
    }

}
