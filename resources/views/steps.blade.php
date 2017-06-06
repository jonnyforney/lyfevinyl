@extends('layouts.app')

@section('content')

  <div id="app" v-cloak>
    <div id="progress-bar" v-cloak>
      <progress-bar percent="25"></progress-bar>
    </div>
    <div id="steps" v-cloak>
      <steps
        customer_id="{{ session('customer_id') }}"
        is_logged_in="{{ Auth::check() }}"
      ></steps>
    </div>
  </div>

@endsection
