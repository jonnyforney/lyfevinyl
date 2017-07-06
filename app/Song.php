<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'songs';

    public static function store(Order $order, $songs)
    {
        
        foreach($songs as $song) {
            $song = (object)$song;

            $existing_song = self::where([
                                            'order_id' => $order->id,
                                            'side' => $song->side,
                                            'track' => $song->track
                                        ])->first();

            $current_song = (!empty($existing_song)) ? $existing_song : new Song;
                        
            $current_song->order_id = $order->id;
            $current_song->path = $song->path;
            $current_song->side = $song->side;
            $current_song->track = $song->track;
            
            $current_song->save();            
        }        

    }
}
