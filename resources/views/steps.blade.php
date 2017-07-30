@extends('layouts.app')

@section('content')

  <div id="app">
    <div id="progress-bar" v-cloak>
      <progress-bar percent="16.667"></progress-bar>
    </div>
    <div id="steps" v-cloak>
      <steps
        customer_id="{{ session('customer_id') }}"
        order="{{ session('order')['id'] }}"
        is_logged_in="{{ Auth::check() }}"
      ></steps>
    </div>
  </div>

@endsection
