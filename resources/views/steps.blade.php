@extends('layouts.app')

@section('content')

  <div id="app">
    <div class="row">
      <div class="col-md-12">
        <div id="progress-bar" v-cloak>
          <progress-bar percent="16.667"></progress-bar>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 margin-top-30 margin-bottom-50">
        <div id="steps" v-cloak>
          <steps
            customer_id="{{ session('customer_id') }}"
            order="{{ session('order')['id'] }}"
            is_logged_in="{{ Auth::check() }}"
            stripe_token="{{ config('services.stripe.key') }}"
          ></steps>
        </div>
      </div>
      <div class="col-md-3 margin-top-30 margin-bottom-50">
        <div class="lvds-info-box">
          <h4 class="lvds-info-box--headline"><i class="material-icons">info</i> Helpful Hints</h4>
          <p class="lvds-info-box--paragraph">The Dark Side of the Moon. Back in Black. Sgt. Pepper's Lonely Hearts Club Band. If an album is great, it's name is something that is remembered alongside the unforgettable songs found on it. Make sure you choose something great!</p>
        </div>
      </div>
    </div>
  </div>

@endsection
