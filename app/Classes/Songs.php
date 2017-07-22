<?php

namespace App\Classes;

use App\Classes\Step;
use App\Song;

class Songs implements Step
{
    function __construct()
    {
    }

    public function save($data)
    {
        $order = collect(session('order'));

        $order->songs = $data->songs;

        session(['order' => $order]);

        return ['order_id' => $order['id'], 'status' => 'saved into session'];
    }
    
    public function store($data)
    {        
        foreach($data->songs as $song) {
            $song = (object)$song;

            $existing_song = Song::where([
                                            'order_id' => $data->order_id,
                                            'side' => $song->side,
                                            'track' => $song->track
                                        ])->first();

            $current_song = (!empty($existing_song)) ? $existing_song : new Song;
                        
            $current_song->order_id = $data->order_id;
            $current_song->path = $song->path;
            $current_song->side = $song->side;
            $current_song->track = $song->track;
            
            $current_song->save();            
        }        
    }

}
