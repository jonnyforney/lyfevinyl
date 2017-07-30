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
        $order = session('order');

        $order->put('sides', $data->sides);

        session(['order' => $order]);

        return ['order_id' => $order['id'], 'status' => 'song(s) saved into session'];
    }
    
    public function store($data)
    {
        foreach($data->sides as $side) {
            $side = (object)$side;  
            foreach($side->songs as $song) {
                $song = (object)$song;
                if(!empty($song->path)) {
                    $existing_song = Song::where([
                                                    'order_id' => $data->order_id,
                                                    'side' => $side->side,
                                                    'track' => $song->track
                                                ])->first();

                    $current_song = (!empty($existing_song)) ? $existing_song : new Song;
                                
                    $current_song->order_id = $data->order_id;
                    $current_song->path = $song->path;
                    $current_song->side = $side->side;
                    $current_song->track = $song->track;
                    
                    $current_song->save();            
                }

            }        
        }

    }

}
