@extends('layouts.index')

@section('content')

    <div id="app" v-cloak>

        <home
            lv_logo_2="{{ asset('imgs/lv-logo-2.png') }}"
            lv_upload_music="{{ asset('imgs/icons/upload-music.png') }}"
            lv_album_art="{{ asset('imgs/icons/lv-album-art.png') }}"
            lv_record="{{ asset('imgs/icons/lv-record.png') }}"
            is_logged_in="{{ Auth::user() }}"
        ></home>

    </div>

@endsection
